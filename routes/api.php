<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importa tus controladores aquí
use App\Http\Controllers\AulaController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InformaticoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HorarioController; // Aunque esté vacío, lo declaramos para la ruta
use App\Http\Controllers\ActividadAcademicaController; // Aunque esté vacío, lo declaramos para la ruta
// Dentro de routes/api.php, después de los imports

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para tus recursos de la API
Route::apiResource('aulas', AulaController::class);
Route::apiResource('materias', MateriaController::class);
Route::apiResource('docentes', DocenteController::class);
Route::apiResource('cursos', CursoController::class);
Route::apiResource('informaticos', InformaticoController::class);
Route::apiResource('mantenimientos', MantenimientoController::class);
Route::apiResource('reservas', ReservaController::class);

// Para Horarios y Actividades Academicas, aunque estén vacíos los métodos,
// es buena práctica definir la ruta si sabes que los usarás.
Route::apiResource('horarios', HorarioController::class);
Route::apiResource('actividades-academicas', ActividadAcademicaController::class);