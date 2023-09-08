<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckPermissions
{
    public function handle(Request $request, Closure $next, $permiso)
    {
        // $permiso = $request->route('permiso');
        // $permiso = 'consultar_ingreso';

        $usuario = Auth::user();

        $roles = $usuario->roles;

        $permisos_usuario = $roles[0]->permissions;

        foreach($permisos_usuario as $permiso_usuario){
            
            // echo "*****************************************" . $permiso_usuario->name . "\n";
            // echo $permiso . "\n";

            if($permiso_usuario->name == $permiso){

                // echo "hola";

                return $next($request);
            }
        }

        abort(403); 
    }
}
