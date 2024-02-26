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
        // Crear cada registro directamente con el método create
        ProjectField::create(['name' => 'Objetivo general', 'type_field' => 1, 'order' => 1]);
        ProjectField::create(['name' => 'Objetivos específicos', 'type_field' => 1, 'order' => 2]);
        ProjectField::create(['name' => 'Marco Teórico', 'type_field' => 1, 'order' => 3]);
        ProjectField::create(['name' => 'Marco Conceptual', 'type_field' => 1, 'order' => 4]);
        ProjectField::create(['name' => 'Marco Metodológico', 'type_field' => 1, 'order' => 5]);
        ProjectField::create(['name' => 'Alcance', 'type_field' => 1, 'order' => 6]);
        ProjectField::create(['name' => 'Cronograma', 'type_field' => 2, 'order' => 7]);
        ProjectField::create(['name' => 'Presupuesto', 'type_field' => 2, 'order' => 8]);
        ProjectField::create(['name' => 'Recursos', 'type_field' => 2, 'order' => 9]);
        ProjectField::create(['name' => 'Equipo de Proyecto', 'type_field' => 1, 'order' => 10]);
        ProjectField::create(['name' => 'Manual', 'type_field' => 2, 'order' => 11]);
        ProjectField::create(['name' => 'Repositorio Github', 'type_field' => 1, 'order' => 12]);
        ProjectField::create(['name' => 'Documento Final', 'type_field' => 2, 'order' => 13]);
    }
}
