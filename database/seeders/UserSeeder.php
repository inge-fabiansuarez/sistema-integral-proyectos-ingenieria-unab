<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Fabian Enrique Suarez Carvajal',
            'email' => 'fsuarez120@unab.edu.co',
            'password' => Hash::make('secret'),
            'phone' => '3229243184',
            'location' => 'Calle 10 # 21-67 apt 602',
            'about_me' => 'Ingeniero de sistemas, Docente programa de ingenieria de sistemas',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Eliana Galvis',
            'email' => 'fonoeliana22@gmail.com',
            'password' => Hash::make('secret'),
            'phone' => '3229243184',
            'location' => 'Calle 10 # 21-67 apt 602',
            'about_me' => 'Ingeniero de mecanica',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
