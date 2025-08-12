<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_materias_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id(); // ID de la materia
            $table->string('nombre', 100); // Nombre de la materia
            $table->string('tipo_contenido', 50)->nullable(); // Tipo de contenido (ej: Teórico, Práctico). Puede ser nulo.
            $table->string('estado', 50)->default('Activa'); // Estado de la materia (ej: Activa, Inactiva)
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
