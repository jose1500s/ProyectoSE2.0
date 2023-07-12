<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_indicador_titulados;
use App\Models\tb_titulados_totales;
use App\Models\tb_titulados_totales_carreras;

class TituladosController extends Controller
{
    public function titulados(){
        // traer de la tabla tb_indicador_titulados todos los registros
        $titulados = tb_indicador_titulados::all();
        $titulados_totales = tb_titulados_totales::all();
        $titulados_totales_carreras = tb_titulados_totales_carreras::all();
  
        // retornar con Inertia a menusComponentes/TabMenu y pasarle los registros
        return Inertia::render('menusComponentes/Titulo/TabMenuTitu', ['titulados' => $titulados,'totales'=>$titulados_totales,'totalescarreras'=>$titulados_totales_carreras]);
     }

     // ---------------------- TAB TITULADOS --------------------------

   function registrarTitulacion(Request $request) {
      
    $generacion = $request->input('generacion');
    $carrera = $request->input('carrera');
    $hombre = $request->input('hombre');
    $mujer = $request->input('mujer');
    $total = $hombre + $mujer;
    $periodo = $request->input('periodo');
    $año = $request->input('año');
    $periodoconaño = $periodo . " " . strval($año);

    // crear un nuevo registro en la tabla tb_indicador_titulados
    $titulacion = new tb_indicador_titulados();
    $titulacion->carrera = $carrera;
    $titulacion->generacion = $generacion;
    $titulacion->total = $total;
    $titulacion->hombre = $hombre;
    $titulacion->mujer = $mujer;
    $titulacion->periodo = $periodo;
    $titulacion->año = $año;
    $titulacion->periodo_con_año = $periodoconaño;
    $titulacion->save();

    // retornar a la vista ingreso
    return redirect()->route('usuario.titulados');

 }

  // ruta para editar una admision
  function editarTitulacion(Request $request) {
    // obtener los datos dle form y luego actualizar el registro
    $id = $request->input('id');
    $carrera = $request->input('carrera');
    $generacion = $request->input('generacion');
    $hombre = $request->input('hombre');
    $mujer = $request->input('mujer');
    $total = $hombre + $mujer;
    $periodo = $request->input('periodo');
    $año = $request->input('año');
    $periodoconaño = $periodo . " " . strval($año);
 
    // actualizar el registro
    $titulacion = tb_indicador_titulados::find($id);
    $titulacion->carrera = $carrera;
    $titulacion->generacion = $generacion;
    $titulacion->hombre = $hombre;
    $titulacion->mujer = $mujer;
    $titulacion->periodo = $periodo;
    $titulacion->año = $año;
    $titulacion->periodo_con_año = $periodoconaño;
    $titulacion->total = $total;
    $titulacion->save();
 
    // retornar a la vista ingreso
    return redirect()->route('usuario.titulados');
   }
 
   function eliminarTitulacion(Request $request) {
    $id = $request->input('id');
    $titulacion = tb_indicador_titulados::findOrFail($id);
    $titulacion->delete(); 
    return redirect()->route('usuario.titulados');
   }
 
   function eliminarTitulaciones(Request $request) {
    $id = $request->id;
    $titulacion = tb_indicador_titulados::whereIn('id', $id);
    $titulacion->delete();
    return redirect()->route('usuario.titulados');
   }

   public function importarDataExcelTitulados(Request $request) {
    $datosExcel = $request->input('datos');

    foreach ($datosExcel as $fila) {
       $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
       $titulacion = new tb_indicador_titulados();
       $titulacion->carrera = $fila['carrera'];
       $titulacion->generacion = $fila['generacion'];
       $titulacion->total = $fila['total'];
       $titulacion->periodo = $fila['periodo'];
       $titulacion->año = $fila['año'];
       $titulacion->hombre = $fila['hombres'];
       $titulacion->mujer = $fila['mujeres'];
       $titulacion->periodo_con_año = $periodoconaño;
       $titulacion->save();
    }

      return redirect()->route('usuario.titulados');
}

   //------------------------ TITULADOS TOTALES GENERACIONES ---------------------------

   function registrarTitulacionTotal(Request $request) {
    
    $generacion = $request->input('generacion');
    $hombre = $request->input('hombre');
    $mujer = $request->input('mujer');
    $total = $hombre + $mujer;
    $periodo = $request->input('periodo');
    $año = $request->input('año');
    $periodoconaño = $periodo . " " . strval($año);

    // crear un nuevo registro en la tabla tb_indicador_titulados
    $titulacion = new tb_titulados_totales();
    $titulacion->generacion = $generacion;
    $titulacion->total = $total;
    $titulacion->hombres = $hombre;
    $titulacion->mujeres = $mujer;
    $titulacion->periodo = $periodo;
    $titulacion->año = $año;
    $titulacion->periodo_con_año = $periodoconaño;
    $titulacion->save();

    // retornar a la vista ingreso
    return redirect()->route('usuario.titulados');

 }

  // ruta para editar una admision
  function editarTitulacionTotal(Request $request) {
    // obtener los datos dle form y luego actualizar el registro
    $id = $request->input('id');
    $generacion = $request->input('generacion');
    $hombre = $request->input('hombre');
    $mujer = $request->input('mujer');
    $total = $hombre + $mujer;
    $periodo = $request->input('periodo');
    $año = $request->input('año');
    $periodoconaño = $periodo . " " . strval($año);
 
    // actualizar el registro
    $titulacion = tb_titulados_totales::find($id);
    $titulacion->generacion = $generacion;
    $titulacion->hombres = $hombre;
    $titulacion->mujeres = $mujer;
    $titulacion->periodo = $periodo;
    $titulacion->año = $año;
    $titulacion->total = $total;
    $titulacion->periodo_con_año = $periodoconaño;
    $titulacion->save();
 
    // retornar a la vista ingreso
    return redirect()->route('usuario.titulados');
   }
 
   function eliminarTitulacionTotal(Request $request) {
    $id = $request->input('id');
    $titulacion = tb_titulados_totales::findOrFail($id);
    $titulacion->delete(); 
    return redirect()->route('usuario.titulados');
   }
 
   function eliminarTitulacionesTotal(Request $request) {
    $id = $request->id;
    $titulacion = tb_titulados_totales::whereIn('id', $id);
    $titulacion->delete();
    return redirect()->route('usuario.titulados');
   }

   public function importarDataExcelTituladosGeneraciones(Request $request) {
    $datosExcel = $request->input('datos');

    foreach ($datosExcel as $fila) {
       $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
       $titulacion = new tb_titulados_totales();
       $titulacion->generacion = $fila['generacion'];
       $titulacion->total = $fila['total'];
       $titulacion->periodo = $fila['periodo'];
       $titulacion->año = $fila['año'];
       $titulacion->hombres = $fila['hombres'];
       $titulacion->mujeres = $fila['mujeres'];
       $titulacion->periodo_con_año = $periodoconaño;
       $titulacion->save();
    }

      return redirect()->route('usuario.titulados');
}

   //------------------------ TITULADOS TOTALES CARRERAS ---------------------------

   function registrarTitulacionTotalCarreras(Request $request) {
    
    $carrera = $request->input('carrera');
    $hombre = $request->input('hombre');
    $mujer = $request->input('mujer');
    $total = $hombre + $mujer;
    $periodo = $request->input('periodo');
    $año = $request->input('año');
    $periodoconaño = $periodo . " " . strval($año);

    // crear un nuevo registro en la tabla tb_indicador_titulados
    $titulacion = new tb_titulados_totales_carreras();
    $titulacion->carrera = $carrera;
    $titulacion->total = $total;
    $titulacion->hombres = $hombre;
    $titulacion->mujeres = $mujer;
    $titulacion->periodo = $periodo;
    $titulacion->año = $año;
    $titulacion->periodo_con_año = $periodoconaño;
    $titulacion->save();

    // retornar a la vista ingreso
    return redirect()->route('usuario.titulados');

 }

  // ruta para editar una admision
  function editarTitulacionTotalCarreras(Request $request) {
    // obtener los datos dle form y luego actualizar el registro
    $id = $request->input('id');
    $carrera = $request->input('carrera');
    $hombre = $request->input('hombre');
    $mujer = $request->input('mujer');
    $total = $hombre + $mujer;
    $periodo = $request->input('periodo');
    $año = $request->input('año');
    $periodoconaño = $periodo . " " . strval($año);
 
    // actualizar el registro
    $titulacion = tb_titulados_totales_carreras::find($id);
    $titulacion->carrera = $carrera;
    $titulacion->total = $total;
    $titulacion->hombres = $hombre;
    $titulacion->mujeres = $mujer;
    $titulacion->periodo = $periodo;
    $titulacion->año = $año;
    $titulacion->periodo_con_año = $periodoconaño;
    $titulacion->save();
 
    // retornar a la vista ingreso
    return redirect()->route('usuario.titulados');
   }
 
   function eliminarTitulacionTotalCarreras(Request $request) {
    $id = $request->input('id');
    $titulacion = tb_titulados_totales_carreras::findOrFail($id);
    $titulacion->delete(); 
    return redirect()->route('usuario.titulados');
   }
 
   function eliminarTitulacionesTotalCarreras(Request $request) {
    $id = $request->id;
    $titulacion = tb_titulados_totales_carreras::whereIn('id', $id);
    $titulacion->delete();
    return redirect()->route('usuario.titulados');
   }

   public function importarDataExcelTituladosCarreras(Request $request) {
    $datosExcel = $request->input('datos');

    foreach ($datosExcel as $fila) {
       $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
       $titulacion = new tb_titulados_totales_carreras();
       $titulacion->carrera = $fila['carrera'];
       $titulacion->total = $fila['total'];
       $titulacion->periodo = $fila['periodo'];
       $titulacion->año = $fila['año'];
       $titulacion->hombres = $fila['hombres'];
       $titulacion->mujeres = $fila['mujeres'];
       $titulacion->periodo_con_año = $periodoconaño;
       $titulacion->save();
    }

      return redirect()->route('usuario.titulados');
}

// ---------------------- FIN TAB TITULADOS ----------------------
}
