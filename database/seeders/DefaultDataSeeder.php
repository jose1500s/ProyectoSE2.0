<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modules;
use Spatie\Permission\Models\Permission;
use App\Models\Module_Has_Permissions;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DefaultDataSeeder extends Seeder
{
    public function run()
    {
        // Se definen y se crean los modulos necesarios
        $data = [
            ["Ingreso","Modulo de ingreso"],
            ["Matricula","Modulo de matricula"],
            ["Bajas","Modulo de bajas"],
            ["Egresados","Modulo de egresados"],
            ["Titulados","Modulo de titulados"],
            ["Becas","Modulo de becas"],
            ["Transporte","Modulo de transporte"],
            ["Cambio de carrera","Modulo de cambio de carrera"]
        ];

        for($i = 0; $i < count($data); $i++){
            Modules::create([
                'name' => $data[$i][0],
                'description' => $data[$i][1]
            ]);
        }

        // Se definen y se crean los permisos necesarios
        $data = [
            ["consultar_ingreso","registrar_ingreso","editar_ingreso","eliminar_ingreso"],
            ["consultar_matricula","registrar_matricula","editar_matricula","eliminar_matricula"],
            ["consultar_bajas","registrar_bajas","editar_bajas","eliminar_bajas"],
            ["consultar_egresados","registrar_egresados","editar_egresados","eliminar_egresados"],
            ["consultar_titulados","registrar_titulados","editar_titulados","eliminar_titulados"],
            ["consultar_becas","registrar_becas","editar_becas","eliminar_becas"],
            ["consultar_transporte","registrar_transporte","editar_transporte","eliminar_transporte"],
            ["consultar_cambio_de_carrera","registrar_cambio_de_carrera","editar_cambio_de_carrera","eliminar_cambio_de_carrera"]
        ];
        
        for($i = 0; $i < count($data); $i++){
            for($j = 0; $j < count($data[$i]); $j++){
                Permission::create([
                    "name" => $data[$i][$j]
                ]);
            }
        }

        // Se obtienen los modulos y permisos
        $modules = Modules::all();
        $permissions = Permission::all();

        // Se iteran los IDs de los modulos y permisos para relacionarlos en una tabla
        foreach($modules as $module){
            foreach($permissions as $permission){
                if(strpos($permission->name, str_replace(' ', '_', strtolower($module->name)))){
                    Module_Has_Permissions::create([
                        "module_id" => $module->id,
                        "permission_id" => $permission->id
                    ]);
                }
            }
        }

        // Se crea el usuario administrador
        $user = User::create([
            "name" => "Administrador",
            "email" => "admin@gmail.com",
            "password" => bcrypt("adminSE2023"),
        ]);

        // Se crea el rol Administrador
        $role = Role::create([
            "name" => "Administrador",
            "description" => "Rol administrador"
        ]);

        // Se asigna el rol administrador y todos los permisos existentes al usuario Administrador
        $user->assignRole($role);

        $permissions = Permission::all();

        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }
    }
}
