<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categorias;
use App\Models\Contador;
use App\Models\Destinos;
use Illuminate\Support\Facades\Auth;

class CiudadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Obtener el ID de la categoría "playa"
        $user = Auth::user();

        // Obtener el ID de la categoría "playa"
        $playaCategory = Categorias::where('Nombre', 'Ciudad')->first();

        // Actualizar el campo last_category del usuario con el ID de la categoría "playa"
        $user->update(['lastCategory' => $playaCategory->id]);

        // Lógica para el contador
        $contador = Contador::where('user_id', $user->id)->first();

        if ($contador) {
            // El usuario ya tiene un registro en el contador, actualizar campos
            $contador->increment('ciudadCont');
        } else {
            // El usuario no tiene un registro en el contador, crear uno nuevo
            Contador::create([
                'user_id' => $user->id,
                'playaCont' => 0,  // Comenzar con 1 al ser la primera visita a la categoría
                'montañaCont' => 0,
                'ciudadCont' => 1,
            ]);
        }

        $ciudades = Destinos::where('tipoCategoria', 3)->get();
       return view('ciudad', compact('ciudades'));
    }
}
