<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('registro', [App\Http\Controllers\HomeController::class, 'index'])->name('registro')->middleware('auth');
Route::post('registro', [App\Http\Controllers\RegisterController::class, 'create'])->name('registro')->middleware('auth');

Route::get('roles', [App\Http\Controllers\ControllerRol::class, 'index'])->name('roles')->middleware('auth');

Route::get('categorias', [App\Http\Controllers\ControllerCategoriaArticulo::class, 'index'])->name('categorias')->middleware('auth');
Route::get('categorias/{categoria}', [App\Http\Controllers\ControllerCategoriaArticulo::class, 'show'])->name('categorias')->middleware('auth');

Route::get('perfil', [App\Http\Controllers\HomeController::class, 'index'])->name('perfil')->middleware('auth');

Route::get('pagos', [App\Http\Controllers\HomeController::class, 'index'])->name('pagos')->middleware('auth');
Route::post('pagos', [App\Http\Controllers\PagoController::class, 'store'])->name('pagos')->middleware('auth');

Route::get('detalle_pagos', [App\Http\Controllers\DetallePagoController::class, 'index'])->name('detalle_pagos')->middleware('auth');
Route::get('detalle_pagos/{CODBANCO}', [App\Http\Controllers\PagoController::class, 'show'])->name('detalle_pagos')->middleware('auth');
Route::post('detalle_pagos', [App\Http\Controllers\DetallePagoController::class, 'store'])->name('detalle_pagos')->middleware('auth');

Route::get('catalogo_pagos', [App\Http\Controllers\ControllerCatalogoPagos::class, 'index'])->name('pagos')->middleware('auth');

Route::get('estudiantes', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get('lista_estudiantes', [App\Http\Controllers\ControllerEstudiante::class, 'index'])->name('estudiantes')->middleware('auth');
Route::get('estudiantes/{estudiante}', [App\Http\Controllers\ControllerEstudiante::class, 'show'])->name('estudiantes')->middleware('auth');
Route::delete('estudiantes', [App\Http\Controllers\ControllerEstudiante::class, 'destroy'])->name('estudiantes')->middleware('auth');
Route::post('estudiantes', [App\Http\Controllers\ControllerEstudiante::class, 'store'])->name('estudiantes')->middleware('auth');
Route::put('estudiantes/{id}', [App\Http\Controllers\ControllerEstudiante::class, 'update'])->name('estudiantes')->middleware('auth');

Route::get('articulos', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get('lista_articulos', [App\Http\Controllers\ControllerArticulo::class, 'index'])->name('articulos')->middleware('auth');
Route::post('articulo', [App\Http\Controllers\ControllerArticulo::class, 'create'])->middleware('auth');
Route::put('articulos/{id}', [App\Http\Controllers\ControllerArticulo::class, 'update'])->name('articulos')->middleware('auth');



Route::post('detalle_asignacion', [App\Http\Controllers\ControllerDetalleAsignacion::class, 'create'])->middleware('auth');
Route::post('transferencia', [App\Http\Controllers\ControllerTransferencia::class, 'create'])->middleware('auth');
Route::post('detalle_transferencia', [App\Http\Controllers\ControllerDetalleTransferencia::class, 'create'])->middleware('auth');


Route::get('ubicacion', [App\Http\Controllers\ControllerUbicacion::class, 'index'])->middleware('auth');
Route::get('empleados', [App\Http\Controllers\ControllerEmpleado::class, 'index'])->middleware('auth');

