<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['ubicacion', 'capacidad'];

    // Relación con Materia (Muchos a Muchos - Tiene)
    public function materias()
    {
        // curso_materia es la tabla pivote
        return $this->belongsToMany(Materia::class, 'curso_materia');
    }
}