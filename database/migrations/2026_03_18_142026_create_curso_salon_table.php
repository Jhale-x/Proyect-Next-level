<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curso_salon', function (Blueprint $table) {
            $table->id('id_curso_salon');

            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_salon');

            $table->timestamps();

            $table->foreign('id_curso')
                ->references('id_curso')
                ->on('cursos')
                ->onDelete('cascade');

            $table->foreign('id_salon')
                ->references('id_salon')
                ->on('salones')
                ->onDelete('cascade');

            $table->unique(['id_curso', 'id_salon']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_salon');
    }
};