<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Aula;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with('aula')->get();
        // CAMBIO CRUCIAL: Ahora se retorna una vista, no un JSON.
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aulas = Aula::all();
        return view('reservas.create', compact('aulas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'periodo' => 'required|string|max:50',
            'turno' => 'required|string|max:50',
            'dia' => 'required|string|max:20',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'tipo_disponibilidad' => 'nullable|string|max:50',
            'aula_id' => 'required|exists:aulas,id',
        ]);

        Reserva::create($request->all());

        return redirect()->route('reservas.index')
                         ->with('success', 'Reserva creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        $reserva->load('aula');
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        $aulas = Aula::all();
        return view('reservas.edit', compact('reserva', 'aulas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'periodo' => 'required|string|max:50',
            'turno' => 'required|string|max:50',
            'dia' => 'required|string|max:20',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'tipo_disponibilidad' => 'nullable|string|max:50',
            'aula_id' => 'required|exists:aulas,id',
        ]);
        
        $reserva->update($request->all());

        return redirect()->route('reservas.index')
                         ->with('success', 'Reserva actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        return redirect()->route('reservas.index')
                         ->with('success', 'Reserva eliminada exitosamente.');
    }
}