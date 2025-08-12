<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'estado',
        'tipo_mantenimiento',
        'descripcion',
        'informatico_id'
    ];

    // **AÑADE ESTO**
    protected $casts = [
        'fecha' => 'date', // O 'datetime' si también almacenas la hora
    ];

    // Relación con Informatico (Muchos a Uno: Un Mantenimiento pertenece a un Informático)
    public function informatico()
    {
        return $this->belongsTo(Informatico::class);
    }
}