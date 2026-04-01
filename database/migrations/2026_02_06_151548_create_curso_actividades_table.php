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
        Schema::create('curso_actividades', function (Blueprint $table) {
            $table->id('id_curso_actividad');

            $table->foreignId('id_curso')->constrained('cursos', 'id_curso');
            $table->foreignId('id_actividad')->constrained('actividades', 'id_actividad');
            $table->date('fecha_entrega');
            $table->time('hora_entrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_actividades');
    }
};
