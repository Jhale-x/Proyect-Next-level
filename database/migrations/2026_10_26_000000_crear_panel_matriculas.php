<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Panel de matrículas separado de la intranet:
 *  - personal_matricula: cuentas propias del panel (secretaría / caja).
 *  - pagos.verificado_por: quién verificó cada pago, para auditoría.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('personal_matricula')) {
            Schema::create('personal_matricula', function (Blueprint $table) {
                $table->id('id_personal');
                $table->string('nombre', 120);
                $table->string('usuario', 50)->unique();
                $table->string('password');
                $table->boolean('activo')->default(true);
                $table->timestamp('ultimo_acceso')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('pagos', 'verificado_por')) {
            Schema::table('pagos', function (Blueprint $table) {
                $table->string('verificado_por', 150)->nullable()->after('estado');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pagos', 'verificado_por')) {
            Schema::table('pagos', function (Blueprint $table) {
                $table->dropColumn('verificado_por');
            });
        }

        Schema::dropIfExists('personal_matricula');
    }
};
