<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;

class SensorController extends Controller
{
    /**
     * Store a new sensor reading.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
	 
    public function index()
    {
        $sensores = Sensor::orderBy('created_at', 'desc')->paginate(20);
        return view('sensores.index', compact('sensores'));
    }
    public function store(Request $request)
    {
        // Validación básica de los datos de entrada
        $request->validate([
            'tipo' => 'required|string|max:50',
            'valor' => 'required|numeric',
        ]);
        
        // Crea una nueva instancia del modelo Sensor
        $sensor = new Sensor();
        $sensor->tipo = $request->tipo;
        $sensor->valor = $request->valor;
        $sensor->save();
        
        // Retorna una respuesta JSON de éxito
        return response()->json(['message' => 'Dato guardado con éxito'], 201);
		
    }
}