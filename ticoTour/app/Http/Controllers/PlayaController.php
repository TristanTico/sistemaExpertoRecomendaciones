<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categorias;
use App\Models\Contador;
use App\Models\Playa;
use App\Models\Destinos;
use Illuminate\Support\Facades\Auth;

class PlayaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();

        // Obtener el ID de la categoría "playa"
        $playaCategory = Categorias::where('Nombre', 'Playa')->first();
    
        // Actualizar el campo last_category del usuario con el ID de la categoría "playa"
        $user->update(['lastCategory' => $playaCategory->id]);
    
        // Lógica para el contador
        $contador = Contador::where('user_id', $user->id)->first();
    
        if ($contador) {
            // El usuario ya tiene un registro en el contador, actualizar campos
            $contador->increment('playaCont');
        } else {
            // El usuario no tiene un registro en el contador, crear uno nuevo
            Contador::create([
                'user_id' => $user->id,
                'playaCont' => 1,  // Comenzar con 1 al ser la primera visita a la categoría
                'montañaCont' => 0,
                'ciudadCont' => 0,
            ]);
        }
        $playas = Destinos::where('tipoCategoria', 1)->get();
        return view('playa', compact('playas'));
    }

}
