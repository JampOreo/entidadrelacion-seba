<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ActividadAcademicaController;
use App\Http\Controllers\InformaticoController;
use App\Http\Controllers\MantenimientoController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('materias', MateriaController::class);
Route::resource('docentes', DocenteController::class);
Route::resource('cursos', CursoController::class);
Route::resource('aulas', AulaController::class);
Route::resource('reservas', ReservaController::class);
Route::resource('horarios', HorarioController::class);
Route::resource('actividades-academicas', ActividadAcademicaController::class);
Route::resource('informaticos', InformaticoController::class);
Route::resource('mantenimientos', MantenimientoController::class);
Route::get('/', [HomeController::class, 'index']);
use App\Http\Controllers\FocoController;
//...
Route::resource('focos', FocoController::class);
use App\Http\Controllers\AireAcondicionadoController;
//...
Route::resource('aires', AireAcondicionadoController::class);