<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        $aulas = Aula::all();
        return view('aulas.index', compact('aulas')); //
    }

    public function create()
    {
        return view('aulas.create'); //
    }

    public function store(Request $request)
    {
        $request->validate([
            'ubicacion' => 'required|string|max:100',
            'capacidad' => 'required|integer',
            'tipo' => 'nullable|string|max:50',
        ]);

        Aula::create($request->all());

        return redirect()->route('aulas.index') //
                         ->with('success', 'Aula creada exitosamente.'); //
    }

    public function show(Aula $aula)
    {
        return view('aulas.show', compact('aula')); //
    }

    public function edit(Aula $aula)
    {
        return view('aulas.edit', compact('aula')); //
    }

    public function update(Request $request, Aula $aula)
    {
        $request->validate([
            'ubicacion' => 'required|string|max:100',
            'capacidad' => 'required|integer',
            'tipo' => 'nullable|string|max:50',
        ]);

        $aula->update($request->all());

        return redirect()->route('aulas.show', $aula->id) //
                         ->with('success', 'Aula actualizada exitosamente.'); //
    }

    public function destroy(Aula $aula)
    {
        $aula->delete();
        return redirect()->route('aulas.index') //
                         ->with('success', 'Aula eliminada exitosamente.'); //
    }
}