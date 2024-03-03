<?php

namespace Database\Seeders;

use App\Models\Rubric;
use App\Models\RubricCriterion;
use App\Models\RubricLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RubricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Insertar datos en la tabla rubrics
        DB::statement("
          INSERT INTO public.rubrics (name, description, total_rating, created_at, updated_at) VALUES
          ('Rubrica de evaluación', 'Rubrica para evaluar', 5.0, '2024-03-03 04:55:30', '2024-03-03 04:55:30');
      ");

        // Insertar datos en la tabla rubric_criteria
        DB::statement("
          INSERT INTO public.rubric_criteria (name, rubrics_id, created_at, updated_at) VALUES
          ('Originalidad de la idea central.', 1, '2024-03-03 04:55:50', '2024-03-03 04:55:50'),
          ('Elaboración de las ideas secundarias.', 1, '2024-03-03 04:57:18', '2024-03-03 04:57:18'),
          ('Redacción, cohesión y coherencia.', 1, '2024-03-03 04:58:31', '2024-03-03 04:58:31');
      ");

        // Insertar datos en la tabla rubric_levels
        DB::statement("
          INSERT INTO public.rubric_levels (name, points, rubric_criteria_id, created_at, updated_at) VALUES
          ('Insuficiente. No entrega el trabajo.', 0.0, 1, '2024-03-03 04:56:01', '2024-03-03 04:56:01'),
          ('Bien. La idea central es interesante, pero no es novedosa o podría mejorar', 4.0, 1, '2024-03-03 04:56:32', '2024-03-03 04:56:32'),
          ('Muy bien. La idea central es interesante y novedosa.', 6.0, 1, '2024-03-03 04:56:46', '2024-03-03 04:56:46'),
          ('Excelente. La idea central es muy interesante y muy novedosa.', 8.0, 1, '2024-03-03 04:57:01', '2024-03-03 04:57:01'),
          ('Insuficiente. No entrega el trabajo', 0.0, 2, '2024-03-03 04:57:29', '2024-03-03 04:57:29'),
          ('Bien. Las ideas secundarias se relacionan con la idea central.', 5.0, 2, '2024-03-03 04:57:45', '2024-03-03 04:57:45'),
          ('Excelente. Las ideas secundarias son interesantes y originales y se relacionan con la idea central.', 10.0, 2, '2024-03-03 04:57:59', '2024-03-03 04:57:59'),
          ('Insuficiente. No entrega el trabajo.', 0.0, 3, '2024-03-03 04:58:42', '2024-03-03 04:58:42'),
          ('Excelente. La argumentación, la puntuación, la cohesión y la coherencia se destacan.', 10.0, 3, '2024-03-03 04:58:55', '2024-03-03 04:58:55');
      ");

        // Insertar datos en la tabla rubrics
        DB::statement("
            INSERT INTO public.rubrics (name, description, total_rating, created_at, updated_at) VALUES
            ('Otra rubrica', 'Otra descripción', 6.0, '2024-03-04 05:00:00', '2024-03-04 05:00:00'),
            ('Rubrica de ejemplo', 'Descripción de la rubrica de ejemplo', 7.0, '2024-03-05 06:00:00', '2024-03-05 06:00:00'),
            ('Rubrica 4', 'Descripción de la rubrica 4', 8.0, '2024-03-06 07:00:00', '2024-03-06 07:00:00'),
            ('Rubrica 5', 'Descripción de la rubrica 5', 9.0, '2024-03-07 08:00:00', '2024-03-07 08:00:00');
        ");

        // Obtener las nuevas rubricas
        $rubrics = Rubric::whereIn('name', ['Otra rubrica', 'Rubrica de ejemplo', 'Rubrica 4', 'Rubrica 5'])->get();

        // Asignar criterios y niveles a las nuevas rubricas
        $rubrics->each(function ($rubric) {
            // Insertar datos en la tabla rubric_criteria
            $criterionData = [
                ['name' => 'Criterio 1', 'rubrics_id' => $rubric->id, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Criterio 2', 'rubrics_id' => $rubric->id, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Criterio 3', 'rubrics_id' => $rubric->id, 'created_at' => now(), 'updated_at' => now()]
            ];
            DB::table('rubric_criteria')->insert($criterionData);

            // Obtener los criterios insertados
            $criteria = RubricCriterion::where('rubrics_id', $rubric->id)->get();

            // Asignar niveles a los criterios
            $criteria->each(function ($criterion) {
                $levelData = [
                    ['name' => 'Nivel 1', 'points' => 1, 'rubric_criteria_id' => $criterion->id, 'created_at' => now(), 'updated_at' => now()],
                    ['name' => 'Nivel 2', 'points' => 2, 'rubric_criteria_id' => $criterion->id, 'created_at' => now(), 'updated_at' => now()],
                    ['name' => 'Nivel 3', 'points' => 3, 'rubric_criteria_id' => $criterion->id, 'created_at' => now(), 'updated_at' => now()]
                ];
                DB::table('rubric_levels')->insert($levelData);
            });
        });


        $faker = Faker::create();

        // Insertar datos en la tabla rubrics
        for ($i = 0; $i < 25; $i++) {
            $rubric = new Rubric();
            $rubric->name = $faker->sentence;
            $rubric->description = $faker->paragraph;
            $rubric->total_rating = $faker->randomFloat(1, 1, 10);
            $rubric->save();

            // Insertar datos en la tabla rubric_criteria
            for ($j = 0; $j < 3; $j++) {
                $criterion = new RubricCriterion();
                $criterion->name = $faker->sentence;
                $criterion->rubrics_id = $rubric->id;
                $criterion->save();

                // Insertar datos en la tabla rubric_levels
                for ($k = 0; $k < 3; $k++) {
                    $level = new RubricLevel();
                    $level->name = $faker->sentence;
                    $level->points = $faker->randomFloat(1, 1, 10);
                    $level->rubric_criteria_id = $criterion->id;
                    $level->save();
                }
            }
        }
    }
}
