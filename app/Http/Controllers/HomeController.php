<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra la página principal con enlaces a los CRUD de la API.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('welcome'); // Laravel por defecto ya usa welcome.blade.php
                                // Si quieres otro nombre de archivo, cambia 'welcome' por 'tu_nuevo_archivo'
    }
}