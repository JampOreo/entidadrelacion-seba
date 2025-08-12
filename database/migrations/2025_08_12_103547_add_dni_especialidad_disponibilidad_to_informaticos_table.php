<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informaticos', function (Blueprint $table) {
            $table->string('dni', 100)->after('nombre')->unique();
            $table->string('especialidad', 50)->after('ubicacion');
            $table->string('disponibilidad', 50)->after('especialidad')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('informaticos', function (Blueprint $table) {
            $table->dropColumn(['dni', 'especialidad', 'disponibilidad']);
        });
    }
};