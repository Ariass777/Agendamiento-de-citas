<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('empleado_id')->constrained('users')->onDelete('cascade');
            $table->string('servicio');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->integer('duracion_minutos');
            $table->enum('estado', ['Pendiente', 'Confirmada', 'Cancelada', 'Completada'])->default('Pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
