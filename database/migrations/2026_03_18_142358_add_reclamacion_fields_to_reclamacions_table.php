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
        Schema::table('reclamacions', function (Blueprint $table) {
            $table->string('sede');
            $table->string('nivel');
            $table->string('nombres');
            $table->string('genero');
            $table->string('dni');
            $table->string('correo');
            $table->string('celular');
            $table->string('grado');
            $table->string('direccion');
            $table->string('tipo');
            $table->text('detalle');
            $table->text('pedido');
            $table->decimal('monto', 10, 2)->nullable();
            $table->text('detalle_reclamo')->nullable();
            $table->text('declaracion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reclamacions', function (Blueprint $table) {
            $table->dropColumn([
                'sede',
                'nivel',
                'nombres',
                'genero',
                'dni',
                'correo',
                'celular',
                'grado',
                'direccion',
                'tipo',
                'detalle',
                'pedido',
                'monto',
                'detalle_reclamo',
                'declaracion',
            ]);
        });
    }
};

