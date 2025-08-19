<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = ['ubicacion', 'capacidad', 'tipo'];

    // Relación con Reserva (Uno a Muchos: Un Aula tiene muchas Reservas)
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Relación con ActividadAcademica (Uno a Muchos: Un Aula puede tener muchas Actividades Académicas)
    // Asumiendo que la FK 'aula_id' está en la tabla 'actividad_academicas'
    public function actividadesAcademicas()
    {
        return $this->hasMany(ActividadAcademica::class);
    }
	// Dentro del modelo Aula
	public function focos()
	{
    return $this->hasMany(Foco::class);
	}
	// Dentro del modelo Aula
	public function airesAcondicionados()
	{
    return $this->hasMany(AireAcondicionado::class);
	}
}
