<?php

namespace App\Http\Controllers\Ingreso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_admision;
class admisionGraficasController extends Controller
{
    function filtrarDatosCarreras(Request $request) { 
        $request->carrera;
        
        // seleccionar de la tabla tb_admisions los registros que coincidan con la carrera 
        $datosCarrerasFiltro = tb_admision::where('carrera', $request->carrera)->get();
        $admisiones = tb_admision::all();
        // retornar CON JSON
        return response()->json([
            'datosCarrerasFiltro' => $datosCarrerasFiltro
        ]);
  
     }
}
