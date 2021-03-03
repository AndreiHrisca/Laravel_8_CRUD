<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProveedorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Obliga al usuario logearse pidiendo el login primero.
 */
Route::get('/', function () {
    return view('auth.login');
});


Route::resource('empleado', EmpleadoController::class)->middleware('auth');

//Auth::routes(['register'=>false,'reset'=>false]);
Auth::routes(['reset'=>false]); //Quita la opcion de "olvidar contraseña". 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 

/**
 * Una vez logueado te redirige a index.
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


 /* ---- ---- ---- ---- CLIENTES ---- ---- ---- ---- */


/**
 * Permite acceder a todas las url de ClientesController.
 * php artisan route:list
 */
Route::resource('cliente', ClientesController::class);

/* ---- ---- ---- ---- PROVEEDORES ---- ---- ---- ---- */


/**
 * Permite acceder a todas las url de ProveedorController.
 * php artisan route:list
 */
Route::resource('proveedor', ProveedorController::class);


