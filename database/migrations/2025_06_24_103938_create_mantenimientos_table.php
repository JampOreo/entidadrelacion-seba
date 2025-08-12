<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_mantenimientos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id(); // ID del mantenimiento
            $table->date('fecha'); // Fecha en que se realizó el mantenimiento
            $table->string('estado', 50)->default('Pendiente'); // Estado del mantenimiento (ej: Pendiente, Realizado, Cancelado)
            $table->string('tipo_mantenimiento', 100)->nullable(); // Ej: "Preventivo", "Correctivo", "Software", "Hardware"
            $table->text('descripcion')->nullable(); // Una descripción detallada del mantenimiento

            // Clave Foránea
            $table->foreignId('informatico_id')->constrained('informaticos')->onDelete('cascade'); // Relación con Informatico

            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};