<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['periodo', 'turno', 'dia', 'hora_inicio', 'hora_fin', 'tipo_disponibilidad', 'aula_id'];

    // Relación con Aula (Muchos a Uno: Una Reserva pertenece a un Aula)
    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
	public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}