<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_egresados;
use App\Models\tb_egresados_totales;
use App\Models\tb_egresados_totales_generacion;

class EgresadosController extends Controller
{
    public function egresados(){
        $egresados = tb_egresados::all();
        $egresados_totales = tb_egresados_totales::all();
        $egresados_totales_generacion = tb_egresados_totales_generacion::all();
        return Inertia::render('menusComponentes/Egresados/TabMenuEgre',['egresados'=>$egresados,'totales'=>$egresados_totales,'totalesgene'=>$egresados_totales_generacion]);
     }

     // ------------------------------ INICIO EGRESADOS ----------------------------

      // ruta para guardar un nuevo egreso del indicador egresados
      function registrarEgresados(Request $request) {
        $carrera = $request->input('carrera');
        $generacion = $request->input('generacion');
        $año_egreso = $request->input('año_egreso');
        $cuatrimestre = $request->input('cuatrimestre');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $titulados = $request->input('titulados');
        $egresados = $hombres + $mujeres;
        $no_titulados = $egresados - $titulados;
        $periodoconaño = $cuatrimestre . " " . strval($año_egreso);
        // crear un nuevo registro en la tabla egresados
        $egresado = new tb_egresados();
        $egresado->carrera = $carrera;
        $egresado->generacion = $generacion;
        $egresado->egresados = $egresados;
        $egresado->titulados = $titulados;
        $egresado->no_titulados = $no_titulados;
        $egresado->año_egreso = $año_egreso;
        $egresado->cuatrimestre= $cuatrimestre;
        $egresado->hombres= $hombres;
        $egresado->mujeres= $mujeres;
        $egresado->periodo_con_año = $periodoconaño;
        $egresado->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.egresados');
     }

     function eliminarEgresados(Request $request) {
        $id = $request->id;
        $egresado = tb_egresados::whereIn('id', $id);
        $egresado->delete();
        return redirect()->route('usuario.egresados');
     }

     function eliminarEgreso(Request $request) {
        $id = $request->input('id');
     $egresado = tb_egresados::findOrFail($id);
     $egresado->delete(); 
     return redirect()->route('usuario.egresados');
     }

     function editarEgreso(Request $request){
     $id = $request->input('id');
     $carrera = $request->input('carrera');
     $generacion = $request->input('generacion');
     $año_egreso = $request->input('año_egreso');
     $cuatrimestre = $request->input('cuatrimestre');
     $hombres = $request->input('hombres');
     $mujeres = $request->input('mujeres');
     $titulados = $request->input('titulados');
     $egresados = $hombres + $mujeres;
     $no_titulados = $egresados - $titulados;
     $periodoconaño = $cuatrimestre . " " . strval($año_egreso);

     // actualizar el registro
     $egresado = tb_egresados::find($id);
     $egresado->carrera = $carrera;
     $egresado->generacion = $generacion;
     $egresado->egresados = $egresados;
     $egresado->titulados = $titulados;
     $egresado->no_titulados = $no_titulados;
     $egresado->año_egreso = $año_egreso;
     $egresado->cuatrimestre= $cuatrimestre;
     $egresado->hombres= $hombres;
     $egresado->mujeres= $mujeres;
     $egresado->periodo_con_año = $periodoconaño;
     $egresado->save();

     // retornar a la vista ingreso
     return redirect()->route('usuario.egresados');
     }

     public function importarDataExcelEgresados(Request $request) {
        $datosExcel = $request->input('datos');
    
        foreach ($datosExcel as $fila) {
           $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
           $egresado = new tb_egresados();
           $egresado->carrera = $fila['carrera'];
           $egresado->generacion = $fila['generacion'];
           $egresado->egresados = $fila['egresados'];
           $egresado->titulados = $fila['titulados'];
           $egresado->cuatrimestre = $fila['periodo'];
           $egresado->no_titulados = $fila['no_titulados'];
           $egresado->año_egreso = $fila['año'];
           $egresado->hombres = $fila['hombres'];
           $egresado->mujeres = $fila['mujeres'];
           $egresado->periodo_con_año = $periodoconaño;
           $egresado->save();
        }
    
          return redirect()->route('usuario.egresados');
    }

//-------------------------------- EGRESADOS TOTALES CARRERAS ------------------------------------

     function registrarEgresadosTotales(Request $request){
        $carrera = $request->input('carrera');
        $año_egreso = $request->input('anio');
        $cuatrimestre = $request->input('cuatrimestre');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $titulados = $request->input('titulados');
        $egresados = $hombres + $mujeres;
        $no_titulados = $egresados - $titulados;
        $periodoconaño = $cuatrimestre . " " . $año_egreso;
        // crear un nuevo registro en la tabla egresados
        $egresadoTotal = new tb_egresados_totales();
        $egresadoTotal->carrera = $carrera;
        $egresadoTotal->egresados = $egresados;
        $egresadoTotal->año = $año_egreso;
        $egresadoTotal->periodo= $cuatrimestre;
        $egresadoTotal->hombres= $hombres;
        $egresadoTotal->mujeres= $mujeres;
        $egresadoTotal->titulados= $titulados;
        $egresadoTotal->no_titulados = $no_titulados;
        $egresadoTotal->periodo_con_año = $periodoconaño;
        $egresadoTotal->save();
        return redirect()->route('usuario.egresados');
     }
     
     function eliminarEgresoTotales(Request $request){
        $id = $request->input('id');
        $egresadoTotal = tb_egresados_totales::findOrFail($id);
        $egresadoTotal->delete(); 
        return redirect()->route('usuario.egresados');
     }

     function eliminarEgresosTotales(Request $request){
        $id = $request->id;
        $egresadoTotal = tb_egresados_totales::whereIn('id', $id);
        $egresadoTotal->delete();
        return redirect()->route('usuario.egresados');
     }

     function editarEgresoTotales(Request $request){
        $id = $request->input('id');
        $carrera = $request->input('carrera');
        $año_egreso = $request->input('anio');
        $cuatrimestre = $request->input('cuatrimestre');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $titulados = $request->input('titulados');
        $egresados = $hombres + $mujeres;
        $no_titulados = $egresados - $titulados;
        $periodoconaño = $cuatrimestre . " " . $año_egreso;

     // actualizar el registro
        $egresadoTotal = tb_egresados_totales::find($id);
        $egresadoTotal->carrera = $carrera;
        $egresadoTotal->egresados = $egresados;
        $egresadoTotal->año = $año_egreso;
        $egresadoTotal->periodo= $cuatrimestre;
        $egresadoTotal->hombres= $hombres;
        $egresadoTotal->mujeres= $mujeres;
        $egresadoTotal->titulados= $titulados;
        $egresadoTotal->no_titulados = $no_titulados;
        $egresadoTotal->periodo_con_año = $periodoconaño;
        $egresadoTotal->save();

     // retornar a la vista ingreso
        return redirect()->route('usuario.egresados');
     }

     public function importarDataExcelEgresadosTotales(Request $request) {
        $datosExcel = $request->input('datos');
    
        foreach ($datosExcel as $fila) {
           $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
           $egresado = new tb_egresados_totales();
           $egresado->carrera = $fila['carrera'];
           $egresado->egresados = $fila['egresados'];
           $egresado->titulados = $fila['titulados'];
           $egresado->periodo = $fila['periodo'];
           $egresado->no_titulados = $fila['no_titulados'];
           $egresado->año = $fila['año'];
           $egresado->hombres = $fila['hombres'];
           $egresado->mujeres = $fila['mujeres'];
           $egresado->periodo_con_año = $periodoconaño;
           $egresado->save();
        }
    
          return redirect()->route('usuario.egresados');
    }

     //-------------------------------- EGRESADOS TOTALES GENERACIONES ------------------------------------

     function registrarEgresadosTotalesGeneracion(Request $request){
        $generacion = $request->input('generacion');
        $año_egreso = $request->input('anio');
        $cuatrimestre = $request->input('cuatrimestre');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $titulados = $request->input('titulados');
        $egresados = $hombres + $mujeres;
        $no_titulados = $egresados - $titulados;
        $periodoconaño = $cuatrimestre . " " . $año_egreso;
        // crear un nuevo registro en la tabla egresados
        $egresadoTotal = new tb_egresados_totales_generacion();
        $egresadoTotal->generacion = $generacion;
        $egresadoTotal->egresados = $egresados;
        $egresadoTotal->año = $año_egreso;
        $egresadoTotal->periodo= $cuatrimestre;
        $egresadoTotal->hombres= $hombres;
        $egresadoTotal->mujeres= $mujeres;
        $egresadoTotal->titulados= $titulados;
        $egresadoTotal->no_titulados = $no_titulados;
        $egresadoTotal->periodo_con_año = $periodoconaño;
        $egresadoTotal->save();
        return redirect()->route('usuario.egresados');
     }
     
     function eliminarEgresoTotalesGeneracion(Request $request){
        $id = $request->input('id');
        $egresadoTotal = tb_egresados_totales_generacion::findOrFail($id);
        $egresadoTotal->delete(); 
        return redirect()->route('usuario.egresados');
     }

     function eliminarEgresosTotalesGeneracion(Request $request){
        $id = $request->id;
        $egresadoTotal = tb_egresados_totales_generacion::whereIn('id', $id);
        $egresadoTotal->delete();
        return redirect()->route('usuario.egresados');
     }

     function editarEgresoTotalesGeneracion(Request $request){
        $id = $request->input('id');
        $generacion = $request->input('generacion');
        $año_egreso = $request->input('anio');
        $cuatrimestre = $request->input('cuatrimestre');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $titulados = $request->input('titulados');
        $egresados = $hombres + $mujeres;
        $no_titulados = $egresados - $titulados;
        $periodoconaño = $cuatrimestre . " " . $año_egreso;

     // actualizar el registro
        $egresadoTotal = tb_egresados_totales_generacion::find($id);
        $egresadoTotal->generacion = $generacion;
        $egresadoTotal->egresados = $egresados;
        $egresadoTotal->año = $año_egreso;
        $egresadoTotal->periodo= $cuatrimestre;
        $egresadoTotal->hombres= $hombres;
        $egresadoTotal->mujeres= $mujeres;
        $egresadoTotal->titulados= $titulados;
        $egresadoTotal->no_titulados = $no_titulados;
        $egresadoTotal->periodo_con_año = $periodoconaño;
        $egresadoTotal->save();

     // retornar a la vista ingreso
        return redirect()->route('usuario.egresados');
     }

     public function importarDataExcelEgresadosGeneracion(Request $request) {
        $datosExcel = $request->input('datos');
    
        foreach ($datosExcel as $fila) {
           $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
           $egresado = new tb_egresados_totales_generacion();
           $egresado->generacion = $fila['generacion'];
           $egresado->egresados = $fila['egresados'];
           $egresado->titulados = $fila['titulados'];
           $egresado->periodo = $fila['periodo'];
           $egresado->no_titulados = $fila['no_titulados'];
           $egresado->año = $fila['año'];
           $egresado->hombres = $fila['hombres'];
           $egresado->mujeres = $fila['mujeres'];
           $egresado->periodo_con_año = $periodoconaño;
           $egresado->save();
        }
    
          return redirect()->route('usuario.egresados');
    }

// ------------------------------ FIN EGRESADOS ----------------------------
}
