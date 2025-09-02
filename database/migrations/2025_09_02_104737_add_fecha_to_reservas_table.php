<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            // Agregar la nueva columna 'fecha'
            // Puedes usar after('id') para colocarla después de la columna 'id'
            $table->date('fecha')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            // Eliminar la columna si se revierte la migración
            $table->dropColumn('fecha');
        });
    }
};