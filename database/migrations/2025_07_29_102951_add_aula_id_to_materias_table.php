<?php

use Illuminate\Database\Migrations\Migration;
// database/migrations/YYYY_MM_DD_HHMMSS_add_aula_id_to_materias_table.php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('materias', function (Blueprint $table) {
            // Agregar la columna aula_id
            $table->foreignId('aula_id')->nullable()->constrained('aulas')->onDelete('set null');
            // ^ Esto asume que tienes una tabla 'aulas' y que 'aula_id' puede ser nulo.
            // Si siempre debe tener un aula, elimina `->nullable()`
            // Si quieres que se borre la materia cuando se borra el aula: onDelete('cascade')
            // Si quieres que no se borre el aula si tiene materias: onDelete('restrict') o no poner onDelete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materias', function (Blueprint $table) {
            // Eliminar la clave foránea antes de eliminar la columna
            $table->dropConstrainedForeignId('aula_id'); // Laravel 8+ para FKs convencionales
            // $table->dropForeign(['aula_id']); // Para Laravel 7 o si la FK no sigue convenciones
            $table->dropColumn('aula_id');
        });
    }
};