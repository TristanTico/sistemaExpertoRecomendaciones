<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorias;
use App\Models\Preferencias;

class PreferenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
       // Obtener el usuario autenticado
       $user = Auth::user();

       // Obtener las preferencias del usuario
       $preferencia = Preferencias::where('user_id', $user->id)->first();

       // Obtener todas las categorías disponibles
       $categorias = Categorias::all();

       return view('editar', [
           'preferencia' => $preferencia,
           'categorias' => $categorias,
       ]);
    }

    public function actualizarPreferencias(Request $request)
    {
        $user = Auth::user();

        // Obtener la categoría seleccionada por el usuario
        $categoria = $request->input('categoria_seleccionada');

        // Actualizar las preferencias en la base de datos
        Preferencias::updateOrCreate(
            ['user_id' => $user->id],
            [
                'playa' => ($categoria === 'Playa') ? 1 : 0,
                'montaña' => ($categoria === 'Montaña') ? 1 : 0,
                'ciudad' => ($categoria === 'Ciudad') ? 1 : 0,
            ]
        );

        return response()->json(['success' => true, 'message' => 'Preferencia actualizada correctamente']);
    }

}

