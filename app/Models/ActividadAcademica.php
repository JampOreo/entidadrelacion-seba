<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadAcademica extends Model
{
    use HasFactory;

    // Nombre de la tabla si no sigue la convención de pluralización de Laravel
    protected $table = 'actividad_academicas'; // Aseguramos el nombre de la tabla

    protected $fillable = [
        'nombre',
        'fecha',
        'estado',
        'tipo_actividad',
        'requiere_mantenimiento',
        'horario_id',
        'aula_id'
    ];

    // Relación con Horario (Muchos a Uno: Una Actividad Académica pertenece a un Horario)
    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    // Relación con Aula (Muchos a Uno: Una Actividad Académica se asocia a un Aula)
    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}