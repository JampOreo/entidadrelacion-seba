<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Informatico; // Necesitamos el modelo Informatico para el formulario
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::with('informatico')->get(); // Cargar relaciones para mostrar
        return view('mantenimientos.index', compact('mantenimientos')); //
    }

    public function create()
    {
        $informaticos = Informatico::all(); // Obtener todos los informáticos para el dropdown
        return view('mantenimientos.create', compact('informaticos')); //
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required|string|max:50',
            'tipo_mantenimiento' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
            'informatico_id' => 'required|exists:informaticos,id',
        ]);

        Mantenimiento::create($request->all());

        return redirect()->route('mantenimientos.index') //
                         ->with('success', 'Mantenimiento creado exitosamente.'); //
    }

    public function show(Mantenimiento $mantenimiento)
    {
        $mantenimiento->load('informatico'); // Cargar relaciones para mostrar
        return view('mantenimientos.show', compact('mantenimiento')); //
    }

    public function edit(Mantenimiento $mantenimiento)
    {
        $informaticos = Informatico::all(); // Obtener informáticos para el dropdown
        return view('mantenimientos.edit', compact('mantenimiento', 'informaticos')); //
    }

    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required|string|max:50',
            'tipo_mantenimiento' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
            'informatico_id' => 'required|exists:informaticos,id',
        ]);

        $mantenimiento->update($request->all());

        return redirect()->route('mantenimientos.show', $mantenimiento->id) //
                         ->with('success', 'Mantenimiento actualizado exitosamente.'); //
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index') //
                         ->with('success', 'Mantenimiento eliminado exitosamente.'); //
    }
}