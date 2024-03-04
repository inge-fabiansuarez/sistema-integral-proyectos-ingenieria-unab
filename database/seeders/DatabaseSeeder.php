<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Rubric;
use App\Models\RubricCriterion;
use App\Models\RubricLevel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Whoops\Run;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
        ]);
        $this->call([
            PermissionSeeder::class,
            ProjectFieldSeeder::class,
            DataFakeSeeder::class,
        ]);
        $this->call([

        ]);
    }
}
