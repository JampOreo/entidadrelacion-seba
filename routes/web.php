<?php

use Illuminate\Support\Facades\Route;

// Importar los controladores para cada entidad
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

// Ruta de inicio (opcional, puedes tener una vista principal o redirigir)
Route::get('/', function () {
    return view('welcome'); // O return response()->json(['message' => 'Welcome to the API']);
});


// Rutas de Recurso para cada entidad
// Esto generará las 7 rutas RESTful estándar (index, create, store, show, edit, update, destroy)
// Si solo es una API, puedes usar ->except(['create', 'edit']) para eliminar las rutas de formularios
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

// Si en algún momento decides que algunas entidades no necesitan todas las operaciones (por ejemplo,
// si las reservas solo se crean y listan, pero no se "editan" directamente),
// puedes usar `->except()` o `->only()`:
// Route::resource('reservas', ReservaController::class)->except(['create', 'edit']);
// Route::resource('mantenimientos', MantenimientoController::class)->only(['index', 'show']);