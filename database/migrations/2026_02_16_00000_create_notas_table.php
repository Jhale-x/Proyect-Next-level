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
        Schema::create('notas', function (Blueprint $table) {

            $table->id('id_nota');

            $table->foreignId('id_alumno')
                ->constrained('alumnos', 'id_alumno')
                ->cascadeOnDelete();

            $table->foreignId('id_curso_actividad')
                ->constrained('curso_actividades', 'id_curso_actividad')
                ->cascadeOnDelete();

            $table->decimal('nota', 5, 2)->default(0);

            $table->timestamps();
            
            $table->unique([
                'id_alumno',
                'id_curso_actividad'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
