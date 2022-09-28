<?php

use App\Http\Controllers\CasadosController;
use App\Http\Controllers\PersonasController;
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
    return view('welcome');
});

Route::controller(PersonasController::class)->group(function () {
    Route::get('vista/visualizar/personas', 'vistaVisualizarPersonas');
    Route::get('vista/registrar/persona', 'vistaRegistrarPersona');
    Route::post('registrar/persona', 'registrarPersona');
    Route::delete('vista/visualizar/personas/{id}','borrar');
    Route::post('editar/persona', 'editarPersona');
    Route::get('editar/persona/{id}','vistaEditar');
});

Route::controller(CasadosController::class)->group(function () {
    Route::get('vista/ver/casados', 'vistaVerCasados');
    Route::get('vista/casar', 'vistaCasar');
    Route::post('casar', 'casar');
});
