<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_horarios_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id(); // ID del horario
            $table->string('dia_semana', 20); // Ej: "Lunes", "Martes"
            $table->time('hora_inicio'); // Hora de inicio del bloque horario
            $table->time('hora_fin'); // Hora de fin del bloque horario
            $table->string('tipo_horario', 50)->nullable(); // Ej: "Clase", "Reunión", "Libre"
            $table->string('estado', 50)->default('Activo'); // Ej: "Activo", "Inactivo"

            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};