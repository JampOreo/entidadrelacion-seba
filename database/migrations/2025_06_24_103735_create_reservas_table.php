<?php

// database/migrations/XXXX_XX_XX_XXXXXX_create_reservas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id(); // ID de la reserva
            $table->string('periodo', 50); // Ej: "1er Cuatrimestre", "Febrero"
            $table->string('turno', 50); // Ej: "Mañana", "Tarde", "Noche"
            $table->string('dia', 20); // Ej: "Lunes", "Martes", etc.
            $table->time('hora_inicio'); // Hora de inicio de la reserva
            $table->time('hora_fin'); // Hora de fin de la reserva
            $table->string('tipo_disponibilidad', 50)->nullable(); // Ej: "Libre", "Ocupado", "Mantenimiento"

            // Claves Foráneas
            $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade'); // Relación con Aula
            // La relación con Horario es "Hace una" (muchos a uno), significa que varias reservas pueden apuntar al mismo horario predefinido.
            // Ojo: Si 'Horario' es más bien el horario específico de una reserva, podríamos prescindir de esta FK y que las horas/días sean propios de Reserva.
            // Por el diagrama, parece que 'Horario' define un patrón.
            $table->foreignId('horario_id')->nullable()->constrained('horarios')->onDelete('set null'); // Relación con Horario

            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};