<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ActividadAcademicaController;
use App\Http\Controllers\InformaticoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\FocoController;
use App\Http\Controllers\AireAcondicionadoController;
use App\Http\Controllers\SensorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider y todas ellas
| serán asignadas al grupo de middleware "web". ¡Crea algo genial!
|
*/

// Ruta principal para la página de bienvenida, nombrada como 'welcome'
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas de recurso para todas las secciones de tu aplicación
Route::resource('materias', MateriaController::class);
Route::resource('docentes', DocenteController::class);
Route::resource('cursos', CursoController::class);
Route::resource('aulas', AulaController::class);
Route::resource('reservas', ReservaController::class);
Route::resource('horarios', HorarioController::class);
Route::resource('actividades-academicas', ActividadAcademicaController::class);
Route::resource('informaticos', InformaticoController::class);
Route::resource('mantenimientos', MantenimientoController::class);
Route::resource('focos', FocoController::class);
Route::resource('aires', AireAcondicionadoController::class);

// Nueva ruta para la vista de sensores
Route::get('/sensores', [SensorController::class, 'index'])->name('sensores.index');