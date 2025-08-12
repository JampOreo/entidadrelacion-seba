<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_actividad_academicas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actividad_academicas', function (Blueprint $table) {
            $table->id(); // ID de la actividad académica
            $table->string('nombre', 255); // Nombre/Descripción de la actividad
            $table->date('fecha'); // Fecha de la actividad
            $table->string('estado', 50)->default('Programada'); // Estado (ej: Programada, Realizada, Cancelada)
            $table->string('tipo_actividad', 100); // Ej: "Examen", "Clase Magistral", "Evento"
            $table->boolean('requiere_mantenimiento')->default(false); // Si la actividad requiere algún mantenimiento específico
            // Si el diagrama quiere decir que una actividad puede tener un horario, la FK es aquí
            $table->foreignId('horario_id')->nullable()->constrained('horarios')->onDelete('set null'); // Relación con Horario

            // Relación con Aula (si una actividad académica se realiza en un aula específica)
            $table->foreignId('aula_id')->nullable()->constrained('aulas')->onDelete('set null'); // Relación con Aula

            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actividad_academicas');
    }
};