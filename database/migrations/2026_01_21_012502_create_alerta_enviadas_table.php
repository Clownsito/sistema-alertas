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
        Schema::create('alertas_enviadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suscripcion_id')
                  ->constrained('suscripciones')
                  ->onDelete('cascade');

            $table->string('tipo_alerta'); // 3_dias, 1_dia, vencimiento
            $table->date('fecha_alerta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas_enviadas');
    }
};
