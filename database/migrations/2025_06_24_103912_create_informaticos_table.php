<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_informaticos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informaticos', function (Blueprint $table) {
            $table->id(); // ID del recurso informático
            $table->string('nombre', 100); // Nombre o identificador del equipo
            $table->string('geter', 100)->nullable(); // ¿Qué significa Geter? Si es un identificador o marca, dejarlo string.
            $table->string('ubicacion', 100); // Ubicación física del equipo
            $table->string('tipo', 50); // Ej: "PC", "Proyector", "Servidor", "Red"
            $table->string('velocidad', 50)->nullable(); // Ej: "Core i7", "100Mbps", "SSD 500GB"
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informaticos');
    }
};
