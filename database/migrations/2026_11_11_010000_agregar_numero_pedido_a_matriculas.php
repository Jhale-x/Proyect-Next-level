<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Niubiz exige un "número de pedido" (purchaseNumber, máx. 12 dígitos) único por cada
 * intento de pago. Se guarda el del último intento para validarlo al autorizar.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {
            if (!Schema::hasColumn('matriculas', 'numero_pedido')) {
                $table->string('numero_pedido', 12)->nullable()->unique()->after('id_transaccion');
            }
        });
    }

    public function down(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {
            if (Schema::hasColumn('matriculas', 'numero_pedido')) {
                $table->dropUnique(['numero_pedido']);
                $table->dropColumn('numero_pedido');
            }
        });
    }
};
