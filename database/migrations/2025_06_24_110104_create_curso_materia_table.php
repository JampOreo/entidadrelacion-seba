<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_curso_materia_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curso_materia', function (Blueprint $table) {
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
            $table->timestamps(); // Opcional
            $table->primary(['curso_id', 'materia_id']);
            // Puedes añadir atributos adicionales aquí
            // Ej: $table->string('semestre')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_materia');
    }
};