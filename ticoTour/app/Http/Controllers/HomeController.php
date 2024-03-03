<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Destinos;
use App\Models\Preferencias;
use App\Models\Contador;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getRecomendacionesPreferencias()
{
    $categorias = Categorias::all();

    // Verificar si el usuario autenticado tiene una preferencia
    $user = Auth::user();
    $preferenciaElegida = Preferencias::where('user_id', $user->id)->first();

    // Obtener el nombre de preferencia si existe
    $nombrePreferencia = $preferenciaElegida ? $this->obtenerNombrePreferencia($preferenciaElegida) : null;

    // Obtener el tipo de categoría según el nombre de preferencia o establecer como null
    $tipoCategoriaPreferencia = $nombrePreferencia ? Categorias::where('nombre', $nombrePreferencia)->value('id') : null;

    // Obtener los destinos según la preferencia o no mostrar nada si no hay preferencia
    $preferencias = $tipoCategoriaPreferencia ? Destinos::where('tipoCategoria', $tipoCategoriaPreferencia)->get() : collect();

    // Obtener la categoría recomendada según el contador más alto
    $categoriaRecomendada = $this->obtenerCategoriaRecomendada($user);

    // Obtener los destinos según la categoría recomendada
    $tipoCategoriaRecomendada = $categoriaRecomendada ? Categorias::where('nombre', $categoriaRecomendada)->value('id') : null;
    $recomendaciones = $tipoCategoriaRecomendada ? Destinos::where('tipoCategoria', $tipoCategoriaRecomendada)->get() : collect();

     // Obtener el contador del usuario
     $contador = Contador::where('user_id', $user->id)->first();

    return view('home', [
        'categorias' => $categorias,
        'preferencias' => $preferencias,
        'recomendaciones' => $recomendaciones,
        'preferenciaElegida' => $preferenciaElegida,
        'contador' => $contador,
    ]);
}


private function obtenerCategoriaRecomendada($user)
{
    // Obtener el contador del usuario
    $contador = Contador::where('user_id', $user->id)->first();

    // Verificar si el contador es null
    if ($contador === null) {
        // Si es null, establecer un contador predeterminado
        $contador = (object) ['playaCont' => 0, 'montañaCont' => 0, 'ciudadCont' => 0];
    }

    // Verificar si todos los contadores son iguales
    $todosIguales = $contador->playaCont == $contador->montañaCont && $contador->montañaCont == $contador->ciudadCont;

    if ($todosIguales) {
        // Obtener la categoría a partir de lastCategory
        $categoriaRecomendada = Categorias::where('id', $user->lastCategory)->value('nombre');
    } else {
        // Obtener el nombre de la categoría con el contador más alto
        $categoriaRecomendada = collect(['playaCont', 'montañaCont', 'ciudadCont'])
            ->reduce(function ($recomendada, $categoria) use ($contador) {
                return $contador->$categoria > $contador->$recomendada ? $categoria : $recomendada;
            }, 'playaCont');

        // Eliminar 'Cont' del nombre de la categoría
        $categoriaRecomendada = str_replace('Cont', '', $categoriaRecomendada);
    }

    return ucfirst($categoriaRecomendada);
}

    


private function obtenerNombrePreferencia($preferencia)
{
    foreach (['playa', 'montaña', 'ciudad'] as $tipo) {
        if ($preferencia->$tipo == 1) {
            return ucfirst($tipo);
        }
    }

    return null; // Devuelve null si no se encuentra ninguna preferencia
}

    public function guardarPreferencias(Request $request){
        
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Obtener la categoría seleccionada por el usuario
        $categoria = $request->input('categoria_seleccionada');
    
        // Asignar valores a las preferencias
        $preferencias = [
            'user_id' => $user->id,
            'playa' => ($categoria === 'Playa') ? 1 : 0,
            'montaña' => ($categoria === 'Montaña') ? 1 : 0,
            'ciudad' => ($categoria === 'Ciudad') ? 1 : 0,
        ];
    
        // Actualizar las preferencias en la base de datos
        Preferencias::create($preferencias);
    
        // Devolver una respuesta JSON
        return response()->json(['success' => true, 'message' => 'Preferencia guardada correctamente']);
    }
    
}
