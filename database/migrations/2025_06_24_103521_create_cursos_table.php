<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_cursos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id(); // ID del curso
            $table->string('ubicacion', 100)->nullable(); // Ubicación del curso (ej: Edificio A)
            $table->integer('capacidad')->nullable(); // Capacidad de alumnos del curso
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};