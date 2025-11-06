<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('servicio_id')->nullable()->after('email');

            // 🔹 Si ya tenías una columna llamada 'servicio' tipo texto, elimínala
            if (Schema::hasColumn('users', 'servicio')) {
                $table->dropColumn('servicio');
            }

            // 🔹 Llave foránea (opcional pero recomendable)
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['servicio_id']);
            $table->dropColumn('servicio_id');
            $table->string('servicio')->nullable();
        });
    }
};
