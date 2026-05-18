<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CursoSalon;
use App\Models\Course;
use App\Models\Salon;

class CursoSalonSeeder extends Seeder
{
    public function run(): void
    {
        $cursos = Course::pluck('id_curso')->toArray();
        $salones = Salon::pluck('id_salon')->toArray();

        if (empty($cursos) || empty($salones)) {
            $this->command->warn('❌ No hay cursos o salones');
            return;
        }

        foreach ($cursos as $id_curso) {

            // 🔥 SOLO UN salón por ejecución (no varios)
            $salon = collect($salones)->random();

            CursoSalon::firstOrCreate([
                'id_curso' => $id_curso,
                'id_salon' => $salon
            ]);

            $this->command->info("✔ Curso {$id_curso} → Salón {$salon}");
        }

        $this->command->info('✅ Seeder ejecutado sin duplicados');
    }
}
