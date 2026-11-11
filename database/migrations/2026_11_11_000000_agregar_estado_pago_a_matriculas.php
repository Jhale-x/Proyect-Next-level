<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Control del pago en línea (webhook de la pasarela):
 *  - matriculas: estado_pago, monto_pagado, id_transaccion, fecha_pago, correo_enviado_at.
 *  - webhook_eventos: registro de cada notificación recibida (auditoría y evita procesar dos veces).
 *
 * "estado" sigue siendo el estado de la matrícula (pendiente/pagada/cancelada);
 * "estado_pago" es el resultado del pago (pendiente/pagado/fallido).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {
            if (!Schema::hasColumn('matriculas', 'estado_pago')) {
                $table->string('estado_pago', 20)->default('pendiente')->after('estado')->index();
            }
            if (!Schema::hasColumn('matriculas', 'monto_pagado')) {
                $table->decimal('monto_pagado', 10, 2)->nullable()->after('monto_total');
            }
            if (!Schema::hasColumn('matriculas', 'id_transaccion')) {
                $table->string('id_transaccion', 100)->nullable()->unique()->after('estado_pago');
            }
            if (!Schema::hasColumn('matriculas', 'fecha_pago')) {
                $table->timestamp('fecha_pago')->nullable()->after('fecha_registro');
            }
            if (!Schema::hasColumn('matriculas', 'correo_enviado_at')) {
                $table->timestamp('correo_enviado_at')->nullable()->after('fecha_pago');
            }
            if (!Schema::hasColumn('matriculas', 'ultimo_error_pago')) {
                $table->string('ultimo_error_pago', 255)->nullable()->after('id_transaccion');
            }
        });

        // Las matrículas ya pagadas quedan como "pagado".
        DB::table('matriculas')->where('estado', 'pagada')->update(['estado_pago' => 'pagado']);

        if (!Schema::hasTable('webhook_eventos')) {
            Schema::create('webhook_eventos', function (Blueprint $table) {
                $table->id();
                $table->string('pasarela', 30)->default('culqi');
                $table->string('id_evento', 100)->unique();
                $table->string('tipo', 100)->nullable();
                $table->string('id_objeto', 100)->nullable()->index();
                $table->unsignedBigInteger('id_matricula')->nullable()->index();
                $table->string('resultado', 30)->default('recibido');
                $table->string('detalle', 255)->nullable();
                $table->json('payload')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('webhook_eventos');

        Schema::table('matriculas', function (Blueprint $table) {
            if (Schema::hasColumn('matriculas', 'id_transaccion')) {
                $table->dropUnique(['id_transaccion']);
            }
            foreach (['estado_pago', 'monto_pagado', 'id_transaccion', 'fecha_pago', 'correo_enviado_at', 'ultimo_error_pago'] as $col) {
                if (Schema::hasColumn('matriculas', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
