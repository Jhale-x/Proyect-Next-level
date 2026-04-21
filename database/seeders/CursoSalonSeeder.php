<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CursoSalon;
use App\Models\Course;
use App\Models\Salon;

class CursoSalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener primeros 3 cursos
        $cursos = Course::limit(3)->pluck('id_curso')->toArray();

        // Obtener primeros 5 salones
        $salones = Salon::limit(5)->pluck('id_salon')->toArray();

        if (empty($cursos) || empty($salones)) {
            $this->command->warn('❌ No hay cursos o salones en la BD');
            return;
        }

        // Asociar cada curso con 2-3 salones
        foreach ($cursos as $id_curso) {
            $salonesToAsign = array_slice($salones, 0, rand(2, 3));

            foreach ($salonesToAsign as $id_salon) {
                CursoSalon::firstOrCreate(
                    ['id_curso' => $id_curso, 'id_salon' => $id_salon],
                    ['id_curso' => $id_curso, 'id_salon' => $id_salon]
                );
            }
        }

        $this->command->info('✅ CursoSalon seeder ejecutado correctamente');
    }
}
