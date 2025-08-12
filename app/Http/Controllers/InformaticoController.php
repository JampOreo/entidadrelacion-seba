<?php

namespace App\Http\Controllers;

use App\Models\Informatico;
use Illuminate\Http\Request;

class InformaticoController extends Controller
{
    public function index()
    {
        $informaticos = Informatico::all();
        return view('informaticos.index', compact('informaticos')); //
    }

    public function create()
    {
        return view('informaticos.create'); //
    }

    public function store(Request $request)
	{
		$request->validate([
			'nombre' => 'required|string|max:100',
			'dni' => 'required|string|max:100|unique:informaticos,dni', // <-- CAMBIO
			'ubicacion' => 'required|string|max:100',
			'especialidad' => 'required|string|max:50', // <-- CAMBIO
			'disponibilidad' => 'nullable|string|max:50', // <-- CAMBIO
		]);
	
		Informatico::create($request->all());
	
		return redirect()->route('informaticos.index')
						->with('success', 'Recurso Informático creado exitosamente.');
	}


    public function show(Informatico $informatico)
    {
        return view('informaticos.show', compact('informatico')); //
    }

    public function edit(Informatico $informatico)
    {
        return view('informaticos.edit', compact('informatico')); //
    }

    public function update(Request $request, Informatico $informatico)
	{
		$request->validate([
			'nombre' => 'required|string|max:100',
			'dni' => 'required|string|max:100|unique:informaticos,dni,' . $informatico->id, // <-- CAMBIO
			'ubicacion' => 'required|string|max:100',
			'especialidad' => 'required|string|max:50', // <-- CAMBIO
			'disponibilidad' => 'nullable|string|max:50', // <-- CAMBIO
		]);
	
		$informatico->update($request->all());
	
		return redirect()->route('informaticos.show', $informatico->id)
						->with('success', 'Recurso Informático actualizado exitosamente.');
	}

    public function destroy(Informatico $informatico)
    {
        $informatico->delete();
        return redirect()->route('informaticos.index') //
                         ->with('success', 'Recurso Informático eliminado exitosamente.'); //
    }
}