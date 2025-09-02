<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Aula;
use App\Models\Horario; // ¡IMPORTANTE: Añade esta línea!
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        // Cargar las relaciones 'aula' y 'horario' para evitar N+1 queries
        $reservas = Reserva::with('aula', 'horario')->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $aulas = Aula::all();
        $horarios = Horario::all(); // <-- Obtener todos los horarios
        return view('reservas.create', compact('aulas', 'horarios')); // <-- Pasa los horarios a la vista
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'aula_id' => 'required|exists:aulas,id',
            'horario_id' => 'required|exists:horarios,id', // Validar el ID del horario
            'tipo_disponibilidad' => 'nullable|string|max:50',
        ]);

        // Obtener el horario seleccionado
        $horario = Horario::find($request->horario_id);

        // Crear la reserva utilizando los datos del formulario y del horario
        $reserva = Reserva::create([
            'fecha' => $request->fecha,
            'hora_inicio' => $horario->hora_inicio, // Sincroniza la hora de inicio
            'hora_fin' => $horario->hora_fin,     // Sincroniza la hora de fin
            'dia' => $horario->dia_semana,          // Sincroniza el día
            'aula_id' => $request->aula_id,
            'horario_id' => $request->horario_id,
            'tipo_disponibilidad' => $request->tipo_disponibilidad,
        ]);

        return redirect()->route('reservas.index')
                         ->with('success', 'Reserva creada exitosamente.');
    }

    public function show(Reserva $reserva)
    {
        return view('reservas.show', compact('reserva'));
    }

    public function edit(Reserva $reserva)
    {
        $aulas = Aula::all();
        $horarios = Horario::all(); // <-- Obtener todos los horarios
        return view('reservas.edit', compact('reserva', 'aulas', 'horarios')); // <-- Pasa los horarios a la vista
    }

    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'fecha' => 'required|date',
            'aula_id' => 'required|exists:aulas,id',
            'horario_id' => 'required|exists:horarios,id', // Validar el ID del horario
            'tipo_disponibilidad' => 'nullable|string|max:50',
        ]);

        // Obtener el horario seleccionado
        $horario = Horario::find($request->horario_id);

        // Actualizar la reserva
        $reserva->update([
            'fecha' => $request->fecha,
            'hora_inicio' => $horario->hora_inicio, // Sincroniza la hora de inicio
            'hora_fin' => $horario->hora_fin,     // Sincroniza la hora de fin
            'dia' => $horario->dia_semana,          // Sincroniza el día
            'aula_id' => $request->aula_id,
            'horario_id' => $request->horario_id,
            'tipo_disponibilidad' => $request->tipo_disponibilidad,
        ]);

        return redirect()->route('reservas.show', $reserva->id)
                         ->with('success', 'Reserva actualizada exitosamente.');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')
                         ->with('success', 'Reserva eliminada exitosamente.');
    }
}