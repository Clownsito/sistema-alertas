<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planes_licencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('cantidad_licencias');
            $table->integer('precio');
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planes_licencias');
    }
};
