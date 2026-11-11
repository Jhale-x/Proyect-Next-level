<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Completa las tablas del módulo de matrícula.
 * Usa hasColumn() porque la BD fue creada a mano (sin migraciones previas).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {
            if (!Schema::hasColumn('matriculas', 'id_ciclo')) {
                $table->integer('id_ciclo')->nullable()->after('id_alumno')->index();
            }
            if (!Schema::hasColumn('matriculas', 'codigo')) {
                $table->string('codigo', 30)->nullable()->unique()->after('id_ciclo');
            }
            if (!Schema::hasColumn('matriculas', 'monto_total')) {
                $table->decimal('monto_total', 10, 2)->default(0)->after('turno');
            }
            if (!Schema::hasColumn('matriculas', 'estado')) {
                $table->string('estado', 20)->default('pendiente')->after('monto_total')->index();
            }
            if (!Schema::hasColumn('matriculas', 'fecha_expiracion')) {
                $table->timestamp('fecha_expiracion')->nullable()->after('fecha_registro');
            }
        });

        // Las matrículas antiguas no tenían código: se les genera uno.
        DB::table('matriculas')->whereNull('codigo')->orderBy('id_matricula')->get(['id_matricula', 'fecha_registro'])
            ->each(function ($m) {
                $anio = $m->fecha_registro ? date('Y', strtotime($m->fecha_registro)) : date('Y');
                DB::table('matriculas')->where('id_matricula', $m->id_matricula)->update([
                    'codigo' => 'NL-' . $anio . '-' . str_pad($m->id_matricula, 6, '0', STR_PAD_LEFT),
                ]);
            });

        Schema::table('apoderados', function (Blueprint $table) {
            if (!Schema::hasColumn('apoderados', 'telefono')) {
                $table->string('telefono', 15)->nullable()->after('dni');
            }
            if (!Schema::hasColumn('apoderados', 'correo')) {
                $table->string('correo', 100)->nullable()->after('telefono');
            }
            if (!Schema::hasColumn('apoderados', 'fecha_nacimiento')) {
                $table->date('fecha_nacimiento')->nullable()->after('correo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {
            foreach (['fecha_expiracion', 'estado', 'monto_total', 'codigo', 'id_ciclo'] as $col) {
                if (Schema::hasColumn('matriculas', $col)) {
                    if ($col === 'codigo') {
                        $table->dropUnique(['codigo']);
                    }
                    $table->dropColumn($col);
                }
            }
        });

        Schema::table('apoderados', function (Blueprint $table) {
            foreach (['fecha_nacimiento', 'correo', 'telefono'] as $col) {
                if (Schema::hasColumn('apoderados', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
