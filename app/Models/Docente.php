<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'especialidad', 'dni'];

    // Relación con Materia (Muchos a Muchos - Dicta)
    public function materias()
    {
        // docente_materia es la tabla pivote
        return $this->belongsToMany(Materia::class, 'docente_materia');
    }
}