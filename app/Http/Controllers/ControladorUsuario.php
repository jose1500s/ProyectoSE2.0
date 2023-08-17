<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ControladorUsuario extends Controller
{
    //

    public function createAdminUser(){

        // Asignación de permisos
        $permisos = array('editar_ingreso', 'editar_bajas','editar_egresados','editar_titulados','editar_matricula','editar_becas','editar_transporte','editar_equivalencias','editar_cambio_carrera',
        'consultar_ingreso', 'consultar_bajas','consultar_egresados','consultar_titulados','consultar_matricula','consultar_becas','consultar_transporte','consultar_equivalencias','consultar_cambio_carrera');

        for($i = 0; $i < count($permisos); $i++){
            if(!Permission::where(["name" => $permisos[$i]])->exists()){
                $permiso = Permission::create(["name" => $permisos[$i]]);
            }
        }

        // if(!Permission::where(["name" => 'editar_ingreso'])->exists()){
        //     $editar_ingreso = Permission::create(["name" => "editar_ingreso"]);
        // }

        // if(!Permission::where(["name" => 'editar_bajas'])->exists()){
        //     $editar_bajas = Permission::create(["name" => "editar_bajas"]);
        // }

        // if(!Permission::where(["name" => 'editar_egresados'])->exists()){
        //     $editar_egresados = Permission::create(["name" => "editar_egresados"]);
        // }
        
        // if(!Permission::where(["name" => 'editar_titulados'])->exists()){
        //     $editar_titulados = Permission::create(["name" => "editar_titulados"]);
        // }
        
        // if(!Permission::where(["name" => 'editar_matricula'])->exists()){
        //     $editar_matricula = Permission::create(["name" => "editar_matricula"]);
        // }
        
        // if(!Permission::where(["name" => 'editar_becas'])->exists()){
        //     $editar_becas = Permission::create(["name" => "editar_becas"]);
        // }
        
        // if(!Permission::where(["name" => 'editar_transporte'])->exists()){
        //     $editar_transporte = Permission::create(["name" => "editar_transporte"]);
        // }

        // if(!Permission::where(["name" => 'editar_equivalencias'])->exists()){
        //     $editar_equivalencias = Permission::create(["name" => "editar_equivalencias"]);
        // }
        
        // if(!Permission::where(["name" => 'editar_cambio_carrera'])->exists()){
        //     $editar_cambio_carrera = Permission::create(["name" => "editar_cambio_carrera"]);
        // }

        $editar_ingreso = Permission::where(["name" => 'editar_ingreso'])->first();
        $editar_bajas = Permission::where(["name" => 'editar_bajas'])->first();
        $editar_egresados = Permission::where(["name" => 'editar_egresados'])->first();
        $editar_titulados = Permission::where(["name" => 'editar_titulados'])->first();
        $editar_matricula = Permission::where(["name" => 'editar_matricula'])->first();
        $editar_becas = Permission::where(["name" => 'editar_becas'])->first();
        $editar_transporte = Permission::where(["name" => 'editar_transporte'])->first();
        $editar_equivalencias = Permission::where(["name" => 'editar_equivalencias'])->first();
        $editar_cambio_carrera = Permission::where(["name" => 'editar_cambio_carrera'])->first();

        // Asignación de roles
        $roles = array('rol_admin','rol_ingreso', 'rol_bajas','rol_egresados','rol_titulados','rol_matricula','rol_becas','rol_transporte','rol_equivalencias','rol_cambio_carrera');
        for($i = 0; $i < count($roles); $i++){
            if(!Role::where(["name" => $roles[$i]])->exists()){
                $rol = Role::create(["name" => $roles[$i]]);
            }
        }

        // if(!Role::where(["name" => 'administrador'])->exists()){
        //     $rol_admin = Role::create(['name' => 'administrador']);    
        // }
        
        // if(!Role::where(["name" => 'consulta'])->exists()){
        //     $rol_consulta = Role::create(['name' => 'consulta']);
        // }

        $rol_ingreso = Role::where(["name" => 'rol_ingreso'])->first();
        $rol_bajas = Role::where(["name" => 'rol_bajas'])->first();
        $rol_egresados = Role::where(["name" => 'rol_egresados'])->first();
        $rol_titulados = Role::where(["name" => 'rol_titulados'])->first();
        $rol_matricula = Role::where(["name" => 'rol_matricula'])->first();
        $rol_becas = Role::where(["name" => 'rol_becas'])->first();
        $rol_transporte = Role::where(["name" => 'rol_transporte'])->first();
        $rol_equivalencias = Role::where(["name" => 'rol_equivalencias'])->first();
        $rol_cambio_carrera = Role::where(["name" => 'rol_cambio_carrera'])->first();
        $rol_admin = Role::where(['name' => 'rol_admin'])->first();

        if(!$rol_ingreso->hasPermissionTo('editar_ingreso')){
            $rol_ingreso->givePermissionTo($editar_ingreso);
        }

        if(!$rol_bajas->hasPermissionTo('editar_bajas')){
            $rol_bajas->givePermissionTo($editar_bajas);
        }

        if(!$rol_egresados->hasPermissionTo('editar_egresados')){
            $rol_egresados->givePermissionTo($editar_egresados);
        }
        
        if(!$rol_titulados->hasPermissionTo('editar_titulados')){
            $rol_titulados->givePermissionTo($editar_titulados);
        }

        if(!$rol_matricula->hasPermissionTo('editar_matricula')){
            $rol_matricula->givePermissionTo($editar_matricula);
        }

        if(!$rol_becas->hasPermissionTo('editar_becas')){
            $rol_becas->givePermissionTo($editar_becas);
        }

        if(!$rol_transporte->hasPermissionTo('editar_transporte')){
            $rol_transporte->givePermissionTo($editar_transporte);
        }
        
        if(!$rol_equivalencias->hasPermissionTo('editar_equivalencias')){
            $rol_equivalencias->givePermissionTo($editar_equivalencias);
        }
        
        if(!$rol_cambio_carrera->hasPermissionTo('editar_cambio_carrera')){
            $rol_cambio_carrera->givePermissionTo($editar_cambio_carrera);
        }

        for($i = 0; $i < count($permisos); $i++){

            $permiso = Permission::where(["name" => $permisos[$i]])->first();

            if(!$rol_admin->hasPermissionTo($permisos[$i])){
                $rol_admin->givePermissionTo($permiso);
            }
        }
        
        for($i = 0; $i < count($permisos) / 2; $i++){
            $permiso = Permission::where(["name" => $permisos[(count($permisos) / 2) + $i]])->first();

            if(!$rol_admin->hasPermissionTo($permisos[(count($permisos) / 2) + $i])){
                $rol_admin->givePermissionTo($permiso);
            }
        }

        // Asignación de usuarios
        $usuarios = array(
            array('Usuario Admin','admin@gmail.com','1234'),
            array('Usuario Ingreso','ingreso@gmail.com','1234'),
            array('Usuario Bajas','bajas@gmail.com','1234'),
            array('Usuario Egresados','egresados@gmail.com','1234'),
            array('Usuario Titulados','titulados@gmail.com','1234'),
            array('Usuario Matricula','matricula@gmail.com','1234'),
            array('Usuario Becas','becas@gmail.com','1234'),
            array('Usuario Transporte','transporte@gmail.com','1234'),
            array('Usuario Equivalencias','equivalencia@gmail.com','1234'),
            array('Usuario Cambio Carrera','cambiocarrera@gmail.com','1234')
        );

        for($i = 0; $i < count($usuarios); $i++){
            if(!User::where(["name" => $usuarios[$i][0]])->exists()){
                $usuario = User::create([
                    "name" => $usuarios[$i][0],
                    "email" => $usuarios[$i][1],
                    "password" => bcrypt($usuarios[$i][2])
                ]);
            }
        }

        // if(!User::where(["name" => "Usuario Admin"])->exists()){
        //     $usuario_admin = User::create([
        //         'name' => 'Admin',
        //         'email' => 'admin@gmail.com',
        //         // 'password' => '1234',
        //         'password' => bcrypt('1234'),
        //     ]);
        // }

        // $ingreso_user = User::create([
        //     "name" => "Usuario Ingreso",
        //     "email" => "ingreso@gmail.com",
        //     "password" => bcrypt('1234')
        // ]);

        // if(!$ingreso_user->hasPermission('editar_ingreso')){
        //     $ingreso_user->assignPermission();
        // }

        // $bajas_user = User::create([
        //     'name' => 'Usuario Bajas',
        //     'email' => 'bajas@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        // $egresados_user = User::create([
        //     'name' => 'Usuario Egresados',
        //     'email' => 'egresados@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        // $titulados_user = User::create([
        //     'name' => 'Usuario Titulados',
        //     'email' => 'titulados@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        // $matricula_user = User::create([
        //     'name' => 'Usuario Matricual',
        //     'email' => 'matricula@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        // $becas_user = User::create([
        //     'name' => 'Usuario Becas',
        //     'email' => 'becas@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        // $transporte_user = User::create([
        //     'name' => 'Usuario Transporte',
        //     'email' => 'transporte@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        // $equivalencias_user = User::create([
        //     'name' => 'Usuario Equivalencias',
        //     'email' => 'equivalencia@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        // $cambio_carrera_user = User::create([
        //     'name' => 'Usuario Cambio Carrera',
        //     'email' => 'cambiocarrera@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        for($i = 0; $i < count($roles); $i++){

            $usuario = User::where(["name" => $usuarios[$i]])->first();
            $rol = Role::where(["name" => $roles[$i]])->first();

            if(!$usuario->hasRole($roles[$i])){
                $usuario->assignRole($rol);
            }
        }

        // $usuario_admin = User::where(["name" => "Usuario Admin"])->first();

        // if(!$usuario_admin->hasRole($rol_admin->name)){
        //     $usuario_admin->assignRole($rol_admin);
        // }

        // $ingreso_user = User::where(["name" => "Usuario Ingreso"])->first();

        // if(!$ingreso_user->hasPermission('editar_ingreso')){
        //     $ingreso_user->assignPermission($editar_ingreso);
        // }


    }

    public function recuperarPermisos(){
        $usuario = User::find(1);

        $roles = $usuario->roles; // recuperar los roles del usuario

        $permisos = [];
        foreach($roles as $rol){
           foreach($rol->permissions as $permiso){
              array_push($permisos, $permiso->name);
           }
        }
        
        for($i = 0; $i < count($permisos); $i++){
            echo $permisos[$i];
        }
    }
}
