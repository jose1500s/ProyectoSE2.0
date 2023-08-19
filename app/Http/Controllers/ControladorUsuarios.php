<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Modules;
use App\Models\Module_Has_Permissions;
use App\Models\tb_admision;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPassword;

class ControladorUsuarios extends Controller
{
    public function registrarUsuario(Request $request){
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $rol = $request->input('rol');

        $contra = bin2hex(random_bytes(12));

        Mail::to($email)->send(new SendPassword($contra));

        $usuario = User::create([
            "name" => $nombre,
            "email" => $email,
            "password" => bcrypt($contra)
        ]);

        $rol = Role::where(["name" => $rol])->first();
        
        $usuario->assignRole($rol);

        return redirect()->route('usuario.usuarios');
    }

    public function editarUsuario(Request $request){
        $id = $request->id;
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $rol = $request->input('rol');

        $usuario = User::find($id);
        $usuario->name = $nombre;
        $usuario->email = $email;

        $rol = Role::where(["name" => $rol])->first();

        $usuario->roles()->detach();
        $usuario->assignRole($rol);

        $usuario->save();

        return redirect()->route('usuario.usuarios');
    }

    public function eliminarUsuario(Request $request){
        $id = $request->input('id');

        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuario.usuarios');
    }

    public function eliminarUsuarios(Request $request){
        $id = $request->input('id');

        $usuario = User::whereIn('id', $id);
        $usuario->delete();

        return redirect()->route('usuario.usuarios');
    }

    public function registrarRol(Request $request){
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $rol = Role::create([
            "name" => $nombre,
            "description" => $descripcion,
        ]);

        return redirect()->route('usuario.usuarios');
    }

    public function editarRol(Request $request){
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $rol = Role::find($id);

        $rol->name = $nombre;
        $rol->description = $descripcion;

        $rol->save();

        return redirect()->route('usuario.usuarios');
    }

    public function eliminarRol(Request $request){
        $id = $request->input('id');

        $rol = Role::findOrFail($id);
        $rol->delete();

        return redirect()->route('usuario.usuarios');
    }

    public function eliminarRoles(Request $request){
        $id = $request->id;

        $rol = Role::whereIn('id', $id);
        $rol->delete();

        return redirect()->route('usuario.usuarios');
    }

    public function verificarRol(Request $request){
        $id = $request->id;

        $rol = Role::find($id);

        $usuarios_asociados = $rol->users;

        if($usuarios_asociados->isEmpty()){
            return True;
        } else {
            return false;
        }
    }

    public function agregarPermiso(Request $request){
        $id_rol = $request->input('id_rol');
        $id_permiso = $request->input('id_permiso');

        $rol = Role::find($id_rol);
        $permiso = Permission::find($id_permiso);
        $rol->givePermissionTo($permiso);

        return redirect()->route('usuario.usuarios');
    }

    public function removerPermiso(Request $request){
        $id_rol = $request->input('id_rol');
        $id_permiso = $request->input('id_permiso');

        $rol = Role::find($id_rol);
        $permiso = Permission::find($id_permiso);
        $rol->revokePermissionTo($permiso);

        return redirect()->route('usuario.usuarios');
    }

    public function usuarios(){
        $roles = Auth::user()->roles;

        foreach($roles as $rol){
            $rol->permissions;
        }

        $usuarios = User::all();

        $cont = 0;
        foreach($usuarios as $usuario){
            $user = User::find($usuario["id"]);
            $roles = $user->getRoleNames();
            foreach($roles as $rol){
                $usuarios[$cont]['rol'] = $rol;
            }
            $cont++;
        }

        $roles = Role::all();

        for($i = 0; $i < count($roles); $i++){
            $roles[$i]["code"] = $roles[$i]["name"];
        }

        return Inertia::render('menusComponentes/Usuarios/MenuUsuarios', ['usuarios' => $usuarios, 'roles' => $roles]);
    }

    public function obtenerPermisos(Request $request){
        $id = $request->input('id');

        $rol = Role::find($id);
        $permisos_activos = $rol->permissions->pluck('name')->toArray();

        $modulos = Modules::all();
        $mhps = Module_Has_Permissions::all();

        $count = 0;
        foreach($modulos as $modulo){

            foreach($mhps as $mhp){

                if($modulo->id == $mhp->module_id){

                    $permiso = Permission::find($mhp->permission_id);

                    if(strpos($permiso->name, "registrar") !== false){

                        $modulos[$count]["registrar"] = ["id" => $permiso->id, "name" => $permiso->name, "estado" => false];

                        foreach($permisos_activos as $permiso_activo){

                            if($permiso_activo == $permiso->name && strpos($permiso_activo, "registrar") !== false && strpos($permiso_activo, str_replace(' ','_', strtolower($modulo->name))) !== false){
                                $modulos[$count]["registrar"] = ["id" => $permiso->id, "name" => $permiso->name, "estado" => true];
                            }
                        }

                    } else if(strpos($permiso->name, "consultar") !== false){

                        $modulos[$count]["consultar"] = ["id" => $permiso->id, "name" => $permiso->name, "estado" => false];

                        foreach($permisos_activos as $permiso_activo){

                            if($permiso_activo == $permiso->name && strpos($permiso_activo, "consultar") !== false && strpos($permiso_activo, str_replace(' ','_', strtolower($modulo->name))) !== false){
                                $modulos[$count]["consultar"] = ["id" => $permiso->id, "name" => $permiso->name, "estado" => true];
                            } 
                        }

                    } else if(strpos($permiso->name, "editar") !== false){

                        $modulos[$count]["editar"] = ["id" => $permiso->id, "name" => $permiso->name, "estado" => false];

                        foreach($permisos_activos as $permiso_activo){

                            if($permiso_activo == $permiso->name && strpos($permiso_activo, "editar") !== false && strpos($permiso_activo, str_replace(' ','_', strtolower($modulo->name))) !== false){
                                $modulos[$count]["editar"] = ["id" => $permiso->id, "name" => $permiso->name, "estado" => true];
                            } 
                        }

                    } else if(strpos($permiso->name, "eliminar") !== false){

                        $modulos[$count]["eliminar"] = ["id" => $permiso->id, "name" => $permiso->name, "estado" => false];

                        foreach($permisos_activos as $permiso_activo){

                            if($permiso_activo == $permiso->name && strpos($permiso_activo, "eliminar") !== false && strpos($permiso_activo, str_replace(' ','_', strtolower($modulo->name))) !== false){
                                $modulos[$count]["eliminar"] = ["id" => $permiso->id, "name" => $permiso->name, "estado" => true];
                            } 
                        }

                    }
                }
            }
            $count++;
        }

        return $modulos;
    }
}
