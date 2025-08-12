<?php

namespace App\Http\Controllers;

use App\Models\ActividadAcademica;
use App\Models\Horario; // Necesitamos el modelo Horario para el formulario
use App\Models\Aula; // Necesitamos el modelo Aula para el formulario
use Illuminate\Http\Request;

class ActividadAcademicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = ActividadAcademica::with('horario', 'aula')->get();
        return view('actividades-academicas.index', compact('actividades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horarios = Horario::all();
        $aulas = Aula::all();
        return view('actividades-academicas.create', compact('horarios', 'aulas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:50',
            'tipo_actividad' => 'required|string|max:100',
            'requiere_mantenimiento' => 'boolean',
            'horario_id' => 'nullable|exists:horarios,id',
            'aula_id' => 'nullable|exists:aulas,id',
        ]);

        ActividadAcademica::create($request->all());

        return redirect()->route('actividades-academicas.index')
                         ->with('success', 'Actividad Académica creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActividadAcademica  $actividadAcademica
     * @return \Illuminate\Http\Response
     */
    public function show(ActividadAcademica $actividadAcademica)
    {
        $actividadAcademica->load('horario', 'aula');
        return view('actividades-academicas.show', compact('actividadAcademica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActividadAcademica  $actividadAcademica
     * @return \Illuminate\Http\Response
     */
    public function edit(ActividadAcademica $actividadAcademica)
    {
        $horarios = Horario::all();
        $aulas = Aula::all();
        return view('actividades-academicas.edit', compact('actividadAcademica', 'horarios', 'aulas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActividadAcademica  $actividadAcademica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActividadAcademica $actividadAcademica)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:50',
            'tipo_actividad' => 'required|string|max:100',
            'requiere_mantenimiento' => 'boolean',
            'horario_id' => 'nullable|exists:horarios,id',
            'aula_id' => 'nullable|exists:aulas,id',
        ]);

        $actividadAcademica->update($request->all());

        return redirect()->route('actividades-academicas.show', $actividadAcademica->id)
                         ->with('success', 'Actividad Académica actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActividadAcademica  $actividadAcademica
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActividadAcademica $actividadAcademica)
    {
        $actividadAcademica->delete();

        return redirect()->route('actividades-academicas.index')
                         ->with('success', 'Actividad Académica eliminada exitosamente.');
    }
}