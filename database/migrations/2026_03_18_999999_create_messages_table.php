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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_emisor');
            $table->unsignedBigInteger('id_receptor')->nullable();
            $table->foreignId('id_curso')->constrained('cursos', 'id_curso')->cascadeOnDelete();
            $table->foreignId('id_curso_salon')->constrained('curso_salon', 'id_curso_salon')->cascadeOnDelete();
            $table->text('contenido');
            $table->timestamps();

            $table->index('id_emisor');
            $table->index('id_receptor');
            $table->index('id_curso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
