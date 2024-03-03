<?php

namespace App\Http\Controllers;

use App\Models\usuarios;
use Illuminate\Http\Request;

class ControladorUsuarios extends Controller
{
public function obtenerUsuarios(){
    return usuarios::all();//
}
}
