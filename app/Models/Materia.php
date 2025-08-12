<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    // ¡IMPORTANTE: Añadir 'aula_id' aquí!
    protected $fillable = [
        'nombre',
        'tipo_contenido',
        'estado',
        'aula_id' // <-- Asegúrate de que esta línea esté presente
    ];

    // Relación con Docente (Muchos a Muchos - Dicta)
    public function docentes()
    {
        // materia_docente es la tabla pivote, Laravel busca por defecto los nombres singulares y orden alfabético
        return $this->belongsToMany(Docente::class, 'docente_materia');
    }

    // Relación con Curso (Muchos a Muchos - Tiene)
    public function cursos()
    {
        // curso_materia es la tabla pivote
        return $this->belongsToMany(Curso::class, 'curso_materia');
    }

    // Relación con Aula (Muchos a Uno: Una Materia pertenece a un Aula)
    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}