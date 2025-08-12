<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_docentes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id(); // ID del docente
            $table->string('nombre', 100); // Nombre completo del docente
            $table->string('especialidad', 100)->nullable(); // Especialidad del docente
            $table->string('dni', 20)->unique(); // DNI del docente, debe ser único
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};