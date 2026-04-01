<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->dropUsersFechaNacimientoUnique();

        Schema::table('curso_actividades', function (Blueprint $table) {
            if (!Schema::hasColumn('curso_actividades', 'porcentaje')) {
                $table->unsignedInteger('porcentaje')->nullable()->after('hora_entrega');
            }
        });

        DB::statement(
            'UPDATE curso_actividades ca '
                . 'INNER JOIN actividades a ON a.id_actividad = ca.id_actividad '
                . 'SET ca.porcentaje = a.porcentaje '
                . 'WHERE ca.porcentaje IS NULL'
        );

        Schema::table('docente_salon', function (Blueprint $table) {
            if (!Schema::hasColumn('docente_salon', 'id_curso')) {
                $table->foreignId('id_curso')->nullable()->after('id_salon')->constrained('cursos', 'id_curso')->nullOnDelete();
            }
        });

        DB::statement(
            'UPDATE docente_salon ds '
                . 'INNER JOIN users u ON u.id_usuario = ds.id_usuario '
                . 'SET ds.id_curso = u.id_curso '
                . 'WHERE ds.id_curso IS NULL AND u.id_curso IS NOT NULL'
        );

        DB::statement(
            'DELETE ds1 FROM docente_salon ds1 '
                . 'INNER JOIN docente_salon ds2 '
                . 'ON ds1.id_docente_salon > ds2.id_docente_salon '
                . 'AND ds1.id_usuario = ds2.id_usuario '
                . 'AND ds1.id_salon = ds2.id_salon '
                . 'AND ((ds1.id_curso IS NULL AND ds2.id_curso IS NULL) OR ds1.id_curso = ds2.id_curso)'
        );

        Schema::table('docente_salon', function (Blueprint $table) {
            $table->unique(['id_usuario', 'id_salon', 'id_curso'], 'docente_salon_usuario_salon_curso_unique');
        });

        Schema::table('messages', function (Blueprint $table) {
            if (!Schema::hasColumn('messages', 'emisor_tipo')) {
                $table->string('emisor_tipo', 20)->default('user')->after('id_emisor');
            }
            if (!Schema::hasColumn('messages', 'id_emisor_usuario')) {
                $table->foreignId('id_emisor_usuario')->nullable()->after('emisor_tipo')->constrained('users', 'id_usuario')->nullOnDelete();
            }
            if (!Schema::hasColumn('messages', 'id_emisor_alumno')) {
                $table->foreignId('id_emisor_alumno')->nullable()->after('id_emisor_usuario')->constrained('alumnos', 'id_alumno')->nullOnDelete();
            }
            if (!Schema::hasColumn('messages', 'receptor_tipo')) {
                $table->string('receptor_tipo', 20)->nullable()->after('id_receptor');
            }
            if (!Schema::hasColumn('messages', 'id_receptor_usuario')) {
                $table->foreignId('id_receptor_usuario')->nullable()->after('receptor_tipo')->constrained('users', 'id_usuario')->nullOnDelete();
            }
            if (!Schema::hasColumn('messages', 'id_receptor_alumno')) {
                $table->foreignId('id_receptor_alumno')->nullable()->after('id_receptor_usuario')->constrained('alumnos', 'id_alumno')->nullOnDelete();
            }
        });

        DB::statement('UPDATE messages SET emisor_tipo = "user", id_emisor_usuario = id_emisor WHERE id_emisor IS NOT NULL AND id_emisor_usuario IS NULL');
        DB::statement('UPDATE messages SET receptor_tipo = "user", id_receptor_usuario = id_receptor WHERE id_receptor IS NOT NULL AND id_receptor_usuario IS NULL');

        DB::statement('ALTER TABLE messages MODIFY id_curso_salon BIGINT UNSIGNED NULL');

        DB::statement('ALTER TABLE notas MODIFY nota DECIMAL(5,2) NULL');

        if (Schema::hasTable('web__principals')) {
            Schema::drop('web__principals');
        }

        DB::statement('ALTER TABLE anuncios MODIFY fecha_publicacion DATETIME NOT NULL');

        Schema::create('asistencias', function (Blueprint $table) {
            $table->id('id_asistencia');
            $table->foreignId('id_alumno')->constrained('alumnos', 'id_alumno')->cascadeOnDelete();
            $table->foreignId('id_curso_salon')->nullable()->constrained('curso_salon', 'id_curso_salon')->nullOnDelete();
            $table->date('fecha');
            $table->enum('estado', ['presente', 'tarde', 'falta', 'justificado'])->default('presente');
            $table->text('observacion')->nullable();
            $table->timestamps();

            $table->unique(['id_alumno', 'id_curso_salon', 'fecha'], 'asistencias_alumno_curso_fecha_unique');
            $table->index(['fecha', 'estado'], 'asistencias_fecha_estado_index');
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('asistencias')) {
            Schema::drop('asistencias');
        }

        DB::statement('ALTER TABLE anuncios MODIFY fecha_publicacion DATE NOT NULL');
        DB::statement('ALTER TABLE notas MODIFY nota DECIMAL(5,2) NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE messages MODIFY id_curso_salon BIGINT UNSIGNED NOT NULL');

        Schema::table('messages', function (Blueprint $table) {
            foreach (
                [
                    'id_emisor_usuario',
                    'id_emisor_alumno',
                    'id_receptor_usuario',
                    'id_receptor_alumno',
                ] as $column
            ) {
                if (Schema::hasColumn('messages', $column)) {
                    $table->dropConstrainedForeignId($column);
                }
            }

            foreach (['emisor_tipo', 'receptor_tipo'] as $column) {
                if (Schema::hasColumn('messages', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('docente_salon', function (Blueprint $table) {
            $table->dropUnique('docente_salon_usuario_salon_curso_unique');
            if (Schema::hasColumn('docente_salon', 'id_curso')) {
                $table->dropConstrainedForeignId('id_curso');
            }
        });

        Schema::table('curso_actividades', function (Blueprint $table) {
            if (Schema::hasColumn('curso_actividades', 'porcentaje')) {
                $table->dropColumn('porcentaje');
            }
        });
    }

    private function dropUsersFechaNacimientoUnique(): void
    {
        $indexExists = DB::table('information_schema.STATISTICS')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', 'users')
            ->where('INDEX_NAME', 'users_fecha_nacimiento_unique')
            ->exists();

        if ($indexExists) {
            DB::statement('ALTER TABLE users DROP INDEX users_fecha_nacimiento_unique');
        }
    }
};
