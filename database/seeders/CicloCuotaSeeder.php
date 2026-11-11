<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciclo;
use App\Models\Cuota;
use App\Models\NivelEducativo;
use App\Models\Turno;

/**
 * Crea los ciclos de COLEGIO (modalidad 1) por nivel y turno,
 * cada uno con su concepto "Matrícula". Es idempotente: se puede
 * ejecutar varias veces sin duplicar registros.
 *
 * php artisan db:seed --class=CicloCuotaSeeder
 */
class CicloCuotaSeeder extends Seeder
{
    private const MONTO_MATRICULA_COLEGIO = 350.00;
    private const ANIO = 2027;

    public function run(): void
    {
        $turnos = Turno::whereIn('nombre', ['mañana', 'tarde'])->get();

        foreach (NivelEducativo::orderBy('orden')->get() as $nivel) {
            foreach ($turnos as $turno) {
                $codigo = sprintf('COL_%s_T%d_%d', strtoupper(substr($nivel->nombre, 0, 3)), $turno->id_turno, self::ANIO);

                $ciclo = Ciclo::firstOrCreate(
                    ['codigo' => $codigo],
                    [
                        'nombre' => sprintf('Año Escolar %d - %s (%s)', self::ANIO, ucfirst($nivel->nombre), ucfirst($turno->nombre)),
                        'fecha_inicio' => self::ANIO . '-03-01',
                        'fecha_fin' => self::ANIO . '-12-18',
                        'id_modalidad' => 1,
                        'id_sede' => 1,
                        'id_entorno' => 1,
                        'id_turno' => $turno->id_turno,
                        'id_nivel' => $nivel->id,
                        'activo' => 1,
                    ]
                );

                Cuota::firstOrCreate(
                    ['id_ciclo' => $ciclo->id_ciclo, 'nombre' => 'Matrícula'],
                    [
                        'numero' => 1,
                        'monto' => self::MONTO_MATRICULA_COLEGIO,
                        'fecha_vencimiento' => self::ANIO . '-02-28',
                        'orden' => 0,
                    ]
                );
            }
        }
    }
}
