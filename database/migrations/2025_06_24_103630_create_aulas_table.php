<?php
// database/migrations/XXXX_XX_XX_XXXXXX_create_aulas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id(); // ID del aula
            $table->string('ubicacion', 100); // Ubicación del aula (ej: Edificio C, Planta 2, Aula 10)
            $table->integer('capacidad'); // Capacidad de personas del aula
            $table->string('tipo', 50)->nullable(); // Tipo de aula (ej: Aula, Laboratorio, Auditorio)
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};