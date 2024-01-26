<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $role = Role::create([
            'name' => 'SuperAdmin'
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
        $role->givePermissionTo([
            $permisionUsers,
            $permisionEventNormal,
            $permissionProjectFields
        ]);
        $userSuperAdmin->assignRole($role);
    }
}
