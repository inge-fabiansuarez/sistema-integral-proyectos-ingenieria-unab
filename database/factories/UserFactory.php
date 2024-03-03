<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber,
            'location' => $this->faker->city,
            'about_me' => $this->faker->city,
            'last_login_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'), // Genera una fecha y hora aleatoria dentro del rango especificado
            'updated_at' => $this->faker->dateTimeBetween('-3 months', 'now'), // Genera una fecha y hora aleatoria dentro del rango especificado

        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Asignar un rol al usuario

            // Verificar si el rol ya existe
            $roleEstudiante = Role::where('name', 'Estudiante')->first();

            // Si el rol no existe, créalo
            if (!$roleEstudiante) {
                $roleEstudiante = Role::create(['name' => 'Estudiante']);
            }

            $user->assignRole($roleEstudiante);
        });
    }
}
