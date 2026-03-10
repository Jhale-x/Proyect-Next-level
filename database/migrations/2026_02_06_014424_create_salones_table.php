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
        Schema::create('salones', function (Blueprint $table) {
            $table->id('id_salon');

            $table->foreignId('id_nivel')->constrained('niveles', 'id_nivel');
            $table->foreignId('id_grado')->nullable()->constrained('grados','id_grado');
            $table->foreignId('id_seccion')->nullable()->constrained('secciones','id_seccion');
            $table->foreignId('id_facultad')->nullable()->constrained('facultades','id_facultad');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salones');
    }
};
