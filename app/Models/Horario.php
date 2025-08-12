<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['dia_semana', 'hora_inicio', 'hora_fin', 'tipo_horario', 'estado'];

    // Relación con Reserva (Uno a Muchos: Un Horario puede tener muchas Reservas)
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Relación con ActividadAcademica (Uno a Muchos: Un Horario puede tener muchas Actividades Académicas)
    // Asumiendo que la FK 'horario_id' está en la tabla 'actividad_academicas'
    public function actividadesAcademicas()
    {
        return $this->hasMany(ActividadAcademica::class);
    }
}