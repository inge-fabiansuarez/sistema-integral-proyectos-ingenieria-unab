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
        $superAdmin = User::find(1);
        $role = Role::create([
            'name' => 'SuperAdmin'
        ]);
        $permisionUsers = Permission::create([
            'name' => 'users',
            'description' => 'Gestionar Usuarios y Roles de la aplicación'
        ]);
        $superAdmin->assignRole($role);
    }
}
