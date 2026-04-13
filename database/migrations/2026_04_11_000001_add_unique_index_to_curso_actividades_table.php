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
        Schema::table('curso_actividades', function (Blueprint $table) {
            $table->unique(['id_curso', 'id_actividad'], 'curso_actividades_curso_actividad_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curso_actividades', function (Blueprint $table) {
            $table->dropUnique('curso_actividades_curso_actividad_unique');
        });
    }
};
