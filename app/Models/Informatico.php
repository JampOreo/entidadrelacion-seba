<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informatico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'dni',
        'ubicacion',
        'especialidad',
        'disponibilidad',
    ];

    // Relación con Mantenimiento (Uno a Muchos: Un Informático tiene muchos Mantenimientos)
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}