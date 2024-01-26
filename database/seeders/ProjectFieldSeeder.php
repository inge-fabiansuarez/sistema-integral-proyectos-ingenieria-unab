<?php

namespace Database\Seeders;

use App\Models\ProjectField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Objetivo general',
            'Objetivos específicos',
            'Marco Teórico',
            'Marco Conceptual',
            'Marco Metodológico',
            'Alcance',
            'Cronograma',
            'Presupuesto',
            'Recursos',
            'Equipo de Proyecto',
            'Manual',
            'Repositorio Github',
            'Documento Final',
        ];

        foreach ($data as $order => $fieldName) {
            ProjectField::create(['name' => $fieldName, 'type_field' => 1, 'order' => $order + 1]);
        }
    }
}
