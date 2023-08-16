<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminAccountSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            "name" => "Administrador",
            "email" => "admin@gmail.com",
            "password" => bcrypt("adminSE2023"),
        ]);

        $role = Role::create([
            "name" => "Administrador",
            "description" => "Rol administrador"
        ]);

        $user->assignRole($role);

        $permissions = Permission::all();

        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }
    }
}
