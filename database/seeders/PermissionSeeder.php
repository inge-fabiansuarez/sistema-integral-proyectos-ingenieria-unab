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

        $userSuperAdmin = User::find(1);
        $userProfesor = User::find(2);

        $roleSuperAdmin = Role::create([
            'name' => 'SuperAdmin'
        ]);
        $roleEstudiante = Role::create([
            'name' => 'Estudiante'
        ]);
        $roleProfesor = Role::create([
            'name' => 'Profesor'
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

        $permissionProyectosAEvaluar = Permission::create([
            'name' => 'projectToEvaluate',
            'description' => 'Entrar a la sección de proyectos a evaluar'
        ]);
        $permissionRubric = Permission::create([
            'name' => 'rubrics',
            'description' => 'CRUD Rubricas'
        ]);
        $permissionEvents = Permission::create([
            'name' => 'events',
            'description' => 'CRUD Eventos'
        ]);
        $roleSuperAdmin->givePermissionTo([
            $permisionUsers,
            $permisionEventNormal,
            $permissionProjectFields,
            $permissionProjects,
            $permissionProyectosAEvaluar,
            $permissionRubric,

        ]);
        $roleProfesor->givePermissionTo([
            $permissionProyectosAEvaluar,
            $permissionRubric,
            $permissionEvents,
            $permisionEventNormal
        ]);
        $roleEstudiante->givePermissionTo([
            $permissionProjects,
        ]);
        $userSuperAdmin->assignRole($roleSuperAdmin);
        $userProfesor->assignRole($roleProfesor);
    }
}
