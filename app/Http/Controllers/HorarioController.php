<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
// use Illuminate\Http\Response; // Ya no es necesario si solo retornas vistas

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = Horario::all();
        return view('horarios.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('horarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dia_semana' => 'required|string|max:20',
            'hora_inicio' => 'required|date_format:H:i', // Espera HH:MM
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio', // Espera HH:MM y debe ser posterior
            'tipo_horario' => 'nullable|string|max:50',
            'estado' => 'required|string|max:50',
        ]);

        Horario::create($request->all());

        return redirect()->route('horarios.index')
                         ->with('success', 'Horario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        return view('horarios.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        return view('horarios.edit', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'dia_semana' => 'required|string|max:20',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'tipo_horario' => 'nullable|string|max:50',
            'estado' => 'required|string|max:50',
        ]);

        $horario->update($request->all());

        return redirect()->route('horarios.show', $horario->id)
                         ->with('success', 'Horario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()->route('horarios.index')
                         ->with('success', 'Horario eliminado exitosamente.');
    }
}