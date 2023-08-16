<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_admision;
use App\Models\tb_maestria;
use App\Models\tb_equivalencia;
use App\Models\tb_nuevo_ingreso;
use App\Models\tb_re_ingreso;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
class main extends Controller
{
   public function ingreso()
   {
      // Recuperar el usuario de la sesión actual
      $usuario = Auth::user();
      // $roles = $usuario->roles->pluck('name')->toArray();
      $roles = $usuario->roles;

      $permisos = [];
      foreach($roles as $rol){
         foreach($rol->permissions as $permiso){
            array_push($permisos, $permiso->name);
         }
      }
      
      $roles = Role::all();

      // traer de la tabla tb_admision todos los registros
      $ingresos = tb_admision::all();
      $maestrias = tb_maestria::all();
      $equivalencias = tb_equivalencia::all();
      $ningresos = tb_nuevo_ingreso::all();
      $reingresos = tb_re_ingreso::all();
      // retornar con Inertia a menusComponentes/TabMenu y pasarle los registros
      return Inertia::render('menusComponentes/Ingreso/TabMenu', ['usuario ' => $usuario, 'roles' => $roles, 'permisos' => $permisos,'maestrias' => $maestrias,'ingresos' => $ingresos, 'equivalencias' => $equivalencias, 'ningresos' => $ningresos, 'reingresos' => $reingresos]);
   }

   public function bajas() {
      $roles = Auth::user()->roles;

      foreach($roles as $rol){
         $rol->permissions;
      }
      
      return Inertia::render('menusComponentes/Bajas');
   }

   public function matricula(){
      $roles = Auth::user()->roles;

      foreach($roles as $rol){
         $rol->permissions;
      }
      
      return Inertia::render('menusComponentes/Matricula');
   }

   public function egresados(){
      $roles = Auth::user()->roles;

      foreach($roles as $rol){
         $rol->permissions;
      }
      
      return Inertia::render('menusComponentes/Egresados');
   }

   public function titulados(){
      $roles = Auth::user()->roles;

      foreach($roles as $rol){
         $rol->permissions;
      }
      
      return Inertia::render('menusComponentes/Titulados');
   }

   public function becas(){
      $roles = Auth::user()->roles;

      foreach($roles as $rol){
         $rol->permissions;
      }
      
      return Inertia::render('menusComponentes/Becas');
   }

   public function transporte(){
      $roles = Auth::user()->roles;

      foreach($roles as $rol){
         $rol->permissions;
      }
      
      return Inertia::render('menusComponentes/Transporte');
   }

   public function cambioDeCarrera(){
      $roles = Auth::user()->roles;

      foreach($roles as $rol){
         $rol->permissions;
      }
      
      return Inertia::render('menusComponentes/CambioDeCarrera');
   }
}