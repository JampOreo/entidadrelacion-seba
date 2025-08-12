<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docente_materia', function (Blueprint $table) {
            $table->foreignId('docente_id')->constrained()->onDelete('cascade');
            $table->foreignId('materia_id')->constrained()->onDelete('cascade');
            $table->primary(['docente_id', 'materia_id']); // Clave primaria compuesta
            $table->timestamps(); // Opcional, pero recomendado
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente_materia');
    }
};