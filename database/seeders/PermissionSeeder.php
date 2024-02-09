<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Camilo Salazar Perez',
            'email' => 'fabian280999@gmail.com',
            'password' => Hash::make('secret'),
            'phone' => '3229243184',
            'location' => 'Calle 10 # 21-67 apt 602',
            'about_me' => 'Ingeniero de mecanica',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $userSuperAdmin = User::find(1);
        $userEstudiante = User::find(2);

        $roleSuperAdmin = Role::create([
            'name' => 'SuperAdmin'
        ]);
        $roleEstudiante = Role::create([
            'name' => 'Estudiante'
        ]);
        $permisionUsers = Permission::create([
            'name' => 'users',
            'description' => 'Gestionar Usuarios y Roles de la aplicación'
        ]);
        $permisionEventNormal = Permission::create([
            'name' => 'event',
            'description' => 'Permiso para crear y eliminar eventos propios creados por el usuario.'
        ]);
        $permissionProjectFields = Permission::create([
            'name' => 'projectFields',
            'description' => 'CRUD campo de proyectos'
        ]);
        $permissionProjects = Permission::create([
            'name' => 'projects',
            'description' => 'CRUD Proyectos'
        ]);
        $roleSuperAdmin->givePermissionTo([
            $permisionUsers,
            $permisionEventNormal,
            $permissionProjectFields,
            $permissionProjects
        ]);
        $userEstudiante->assignRole($roleEstudiante);
        $userSuperAdmin->assignRole($roleSuperAdmin);
    }
}
