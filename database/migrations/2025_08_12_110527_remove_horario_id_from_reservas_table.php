<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            // Elimina la clave foránea y luego la columna
            $table->dropForeign(['horario_id']);
            $table->dropColumn('horario_id');
        });
    }

    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            // Para revertir, se recrea la columna y la clave foránea
            $table->foreignId('horario_id')->nullable()->constrained()->onDelete('set null');
        });
    }
};