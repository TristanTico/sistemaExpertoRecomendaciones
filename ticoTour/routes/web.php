<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PlayaController;
use App\Http\Controllers\MontañaController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\PreferenciaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get("/Registro", "App\Http\Controllers\ControladorUsuarios@obtenerUsuarios" );

Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::view('/registros', 'auth.register')->name('registros');

Route::post('/login', [LoginController::class, 'store'])->name('logear');
Route::view('/', 'auth.login')->name('login');//se carga la vista de login

Route::middleware('auth')
->group(function () {
    //Route::view('/home', 'home')->name('Home');
    Route::get('/playa', [PlayaController::class, 'index'])->name('playa');
    Route::get('/montaña', [MontañaController::class, 'index'])->name('montaña');
    Route::get('/ciudad', [CiudadController::class, 'index'])->name('ciudad');
    Route::get('/logout',[LoginController::class, 'destroy'])->name('logout');
    Route::get('/editarPreferencia', [PreferenciaController::class, 'index'])->name('editar');
    Route::get('/home',[HomeController::class, 'getRecomendacionesPreferencias'])->name('Home');
    Route::post('/guardar-preferencias', [HomeController::class, 'guardarPreferencias'])->name('guardar.preferencias');
    Route::post('/preferencias/actualizar', [PreferenciaController::class, 'actualizarPreferencias'])->name('preferencias.actualizar');




});


    // Route::get("/usuarios", function () {
    //     return "Todos los usuarios";
    // });
