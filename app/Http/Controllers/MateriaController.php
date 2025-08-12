<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Aula;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materias = Materia::with('docentes', 'cursos', 'aula')->get();
        return view('materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $docentes = Docente::all();
        $cursos = Curso::all();
        $aulas = Aula::all();
        return view('materias.create', compact('docentes', 'cursos', 'aulas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo_contenido' => 'nullable|string|max:50',
            'estado' => 'required|string|max:50',
            'aula_id' => 'required|exists:aulas,id',
            'docentes' => 'nullable|array',
            'docentes.*' => 'exists:docentes,id',
            'cursos' => 'nullable|array',
            'cursos.*' => 'exists:cursos,id',
        ]);

        $materia = Materia::create($request->all());

        if ($request->has('docentes')) {
            $materia->docentes()->sync($request->input('docentes'));
        }

        if ($request->has('cursos')) {
            $materia->cursos()->sync($request->input('cursos'));
        }

        return redirect()->route('materias.index')
                         ->with('success', 'Materia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        $materia->load('docentes', 'cursos', 'aula');
        return view('materias.show', compact('materia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materia $materia)
    {
        $docentes = Docente::all();
        $cursos = Curso::all();
        $aulas = Aula::all();
        $materia->load('docentes', 'cursos', 'aula');
        return view('materias.edit', compact('materia', 'docentes', 'cursos', 'aulas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo_contenido' => 'nullable|string|max:50',
            'estado' => 'required|string|max:50',
            'aula_id' => 'required|exists:aulas,id',
            'docentes' => 'nullable|array',
            'docentes.*' => 'exists:docentes,id',
            'cursos' => 'nullable|array',
            'cursos.*' => 'exists:cursos,id',
        ]);

        $materia->update($request->all());

        if ($request->has('docentes')) {
            $materia->docentes()->sync($request->input('docentes'));
        } else {
            $materia->docentes()->detach();
        }

        if ($request->has('cursos')) {
            $materia->cursos()->sync($request->input('cursos'));
        } else {
            $materia->cursos()->detach();
        }

        return redirect()->route('materias.show', $materia->id)->with('success', 'Materia actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente.');
    }
}