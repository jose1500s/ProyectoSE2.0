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
use App\Models\tb_indicador_equivalencia;
use App\Models\tb_indicador_titulados;
use App\Models\tb_transporte_lugares;
use App\Models\tb_transporte_solicitudes_seleccionados;
use App\Models\tb_egresados;
use App\Models\tb_egresados_totales;
use App\Models\tb_titulados_totales;
use App\Models\tb_egresados_totales_generacion;
use App\Models\tb_titulados_totales_carreras;

class main extends Controller
{
   public function ingreso()
   {
      // traer de la tabla tb_admision todos los registros
      $ingresos = tb_admision::all();
      $maestrias = tb_maestria::all();
      $equivalencias = tb_equivalencia::all();
      $ningresos = tb_nuevo_ingreso::all();
      $reingresos = tb_re_ingreso::all();
      // retornar con Inertia a menusComponentes/TabMenu y pasarle los registros
      return Inertia::render('menusComponentes/Ingreso/TabMenu', ['maestrias' => $maestrias,'ingresos' => $ingresos, 'equivalencias' => $equivalencias, 'ningresos' => $ningresos, 'reingresos' => $reingresos]);
   }


   public function bajas() {
      return Inertia::render('menusComponentes/Bajas');
   }

   public function matricula(){
      return Inertia::render('menusComponentes/Matricula');
   }

   public function egresados(){
      $egresados = tb_egresados::all();
      $egresados_totales = tb_egresados_totales::all();
      $egresados_totales_generacion = tb_egresados_totales_generacion::all();
      return Inertia::render('menusComponentes/Egresados/TabMenuEgre',['egresados'=>$egresados,'totales'=>$egresados_totales,'totalesgene'=>$egresados_totales_generacion]);
   }

   public function titulados(){
      // traer de la tabla tb_indicador_titulados todos los registros
      $titulados = tb_indicador_titulados::all();
      $titulados_totales = tb_titulados_totales::all();
      $titulados_totales_carreras = tb_titulados_totales_carreras::all();

      // retornar con Inertia a menusComponentes/TabMenu y pasarle los registros
      return Inertia::render('menusComponentes/Titulo/TabMenuTitu', ['titulados' => $titulados,'totales'=>$titulados_totales,'totalescarreras'=>$titulados_totales_carreras]);
   }

   public function becas(){
      return Inertia::render('menusComponentes/Becas');
   }

   public function transporte(){
      $solicitudes = tb_transporte_solicitudes_seleccionados::all();
      $rutas = tb_transporte_lugares::all();
      return Inertia::render('menusComponentes/Transporte/TabMenu',['solicitudes'=> $solicitudes,'rutas'=>$rutas]);
   }

   public function cambioDeCarrera(){
      return Inertia::render('menusComponentes/CambioDeCarrera');
   }

   public function equivalencia(){
      // traer de la tabla tb_admision todos los registros
      $equiva = tb_indicador_equivalencia::all();
      return Inertia::render('menusComponentes/Equivalencia/TabMenuEqui', ['equiva' => $equiva]);
   }

   public function importarDataExcelAdmisiones(Request $request) {
    $datosExcel = $request->input('datos');

    foreach ($datosExcel as $fila) {
      $admision = new tb_admision();
      $admision->carrera = $fila['carrera'];
      $admision->aspirantes = $fila['aspirantes'];
      $admision->examinados = $fila['examinados'];
      $admision->no_admitidos = $fila['no_admitidos'];
      $admision->periodo = $fila['periodo'];
      $admision->save();
    }

      return redirect()->route('usuario.ingreso');
}



   // ruta para guardar una nueva admision del indicador ingreso en la admision
   function registrarAdmision(Request $request) {
      $carrera = $request->input('carreras');
      $aspirantes = $request->input('aspirantes');
      $examinados = $request->input('examinados');
      $no_admitidos = $request->input('noAdmitidos');
      $periodo = $request->input('periodos');

      // crear un nuevo registro en la tabla tb_admision
      $admision = new tb_admision();
      $admision->carrera = $carrera;
      $admision->aspirantes = $aspirantes;
      $admision->examinados = $examinados;
      $admision->no_admitidos = $no_admitidos;
      $admision->periodo = $periodo;
      $admision->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.ingreso');
   
  }

   





   //  --------------------- TAB ADMISION -----------------------

  // ruta para editar una admision
  function editarAdmision(Request $request) {
   // obtener los datos dle form y luego actualizar el registro
   $id = $request->input('id');
   $carrera = $request->input('carrera');
   $aspirantes = $request->input('aspirantes');
   $examinados = $request->input('examinados');
   $no_admitidos = $request->input('no_admitidos');
   $periodo = $request->input('periodo');

   // actualizar el registro
   $admision = tb_admision::find($id);
   $admision->carrera = $carrera;
   $admision->aspirantes = $aspirantes;
   $admision->examinados = $examinados;
   $admision->no_admitidos = $no_admitidos;
   $admision->periodo = $periodo;
   $admision->save();

   // retornar a la vista ingreso
   return redirect()->route('usuario.ingreso');
  }

  function eliminarAdmision(Request $request) {
   $id = $request->input('id');
   $admision = tb_admision::findOrFail($id);
   $admision->delete(); 
   return redirect()->route('usuario.ingreso');
  }

  function eliminarAdmisiones(Request $request) {
   $id = $request->id;
   $admision = tb_admision::whereIn('id', $id);
   $admision->delete();
   return redirect()->route('usuario.ingreso');
  }

  //  --------------------- FIN TAB ADMISION -----------------------

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

  //  --------------------- TAB NUEVO INGRESO -----------------------

  function registrarNIngreso(Request $request) {
   $carrera = $request->input('carrera');
   $total_ingresos = $request->input('totalIngresos');
   $sexo = $request->input('sexo');
   $generacion = $request->input('generacion');
   $admitidos = $request->input('admitidos');
   $inscritos = $request->input('inscritos');
   $proceso = $request->input('procesos');
   $periodo = $request->input('periodos');

   // crear un nuevo registro en la tabla tb_nuevo_ingreso
   $nuevo_ingreso = new tb_nuevo_ingreso();
   $nuevo_ingreso->carrera = $carrera;
   $nuevo_ingreso->total_ingresos = $total_ingresos;
   $nuevo_ingreso->sexo = $sexo;
   $nuevo_ingreso->generacion = $generacion;
   $nuevo_ingreso->admitidos = $admitidos;
   $nuevo_ingreso->inscritos = $inscritos;
   $nuevo_ingreso->proceso = $proceso;
   $nuevo_ingreso->periodo = $periodo;
   $nuevo_ingreso->save();


   // retornar a la vista ingres-o
   return redirect()->route('usuario.ingreso');
  }

  function eliminarNIngresos(Request $request) {
   $id = $request->id;
   $nuevo_ingreso = tb_nuevo_ingreso::whereIn('id', $id);
   $nuevo_ingreso->delete();
   return redirect()->route('usuario.ingreso');
  }

  function eliminarNIngreso(Request $request) {
   $id = $request->input('id');
   $nuevo_ingreso = tb_nuevo_ingreso::findOrFail($id);
   $nuevo_ingreso->delete(); 
   return redirect()->route('usuario.ingreso');
  }

  function editarNIngreso(Request $request) {
      // recibir los datos del form
      $id = $request->input('id');
      $carrera = $request->input('carrera');
      $total_ingresos = $request->input('totalIngresos');
      $sexo = $request->input('sexo');
      $generacion = $request->input('generacion');
      $admitidos = $request->input('admitidos');
      $inscritos = $request->input('inscritos');
      $proceso = $request->input('procesos');
      $periodo = $request->input('periodos');

      // actualizar el registro
      $nuevo_ingreso = tb_nuevo_ingreso::find($id);
      $nuevo_ingreso->carrera = $carrera;
      $nuevo_ingreso->total_ingresos = $total_ingresos;
      $nuevo_ingreso->sexo = $sexo;
      $nuevo_ingreso->generacion = $generacion;
      $nuevo_ingreso->admitidos = $admitidos;
      $nuevo_ingreso->inscritos = $inscritos;
      $nuevo_ingreso->proceso = $proceso;
      $nuevo_ingreso->periodo = $periodo;
      $nuevo_ingreso->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.ingreso');
  }

   //  --------------------- TAB NUEVO RE INGRESO -----------------------

   function registrarRIngreso(Request $request) {
      $carrera = $request->input('carrera');
      $cuatrimestre = $request->input('cuatrimestre');
      $generacion = $request->input('generacion');
      $tipo_baja = $request->input('bajas');
      $periodo = $request->input('periodo');

      // crear un nuevo registro en la tabla tb_re_ingreso
      $re_ingreso = new tb_re_ingreso();
      $re_ingreso->carrera = $carrera;
      $re_ingreso->cuatrimestre = $cuatrimestre;
      $re_ingreso->generacion = $generacion;
      $re_ingreso->tipo_baja = $tipo_baja;
      $re_ingreso->periodo = $periodo;
      $re_ingreso->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.ingreso');

   }

   function editarRIngresos(Request $request) {
      // recibir los datos del form
      $id = $request->input('id');
      $carrera = $request->input('carrera');
      $cuatrimestre = $request->input('cuatrimestre');
      $generacion = $request->input('generacion');
      $tipo_baja = $request->input('bajas');
      $periodo = $request->input('periodo');

      // actualizar el registro
      $re_ingreso = tb_re_ingreso::find($id);
      $re_ingreso->carrera = $carrera;
      $re_ingreso->cuatrimestre = $cuatrimestre;
      $re_ingreso->generacion = $generacion;
      $re_ingreso->tipo_baja = $tipo_baja;
      $re_ingreso->periodo = $periodo;
      $re_ingreso->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.ingreso');
   }

   function eliminarRIngreso(Request $request) {
      $id = $request->input('id');
      $re_ingreso = tb_re_ingreso::findOrFail($id);
      $re_ingreso->delete(); 
      return redirect()->route('usuario.ingreso');
   }

   function eliminarRIngresos(Request $request) {
      $id = $request->id;
      $re_ingreso = tb_re_ingreso::whereIn('id', $id);
      $re_ingreso->delete();
      return redirect()->route('usuario.ingreso');
   }

   
   //  --------------------- TAB NUEVO EQUIVALENCIA -----------------------
   // ruta para guardar una nueva equivalencia del indicador ingreso en la equivalencia
  function registrarEquivalencia(Request $request) {
   $carrera = $request->input('carreras');
   $aspirantes = $request->input('aspirantes');
   $examinados = $request->input('examinados');
   $no_admitidos = $request->input('noAdmitidos');
   $periodo = $request->input('periodos');

   // crear un nuevo registro en la tabla tb_equivalencia
   $admision = new tb_equivalencia();
   $admision->carrera = $carrera;
   $admision->aspirantes = $aspirantes;
   $admision->examinados = $examinados;
   $admision->no_admitidos = $no_admitidos;
   $admision->periodo = $periodo;
   $admision->save();

   // retornar a la vista ingreso
   return redirect()->route('usuario.ingreso');

} 

// ruta para editar una equivalencia
function editarEquivalencia(Request $request) {
   // obtener los datos dle form y luego actualizar el registro
   $id = $request->input('id');
   $carrera = $request->input('carrera');
   $aspirantes = $request->input('aspirantes');
   $examinados = $request->input('examinados');
   $no_admitidos = $request->input('no_admitidos');
   $periodo = $request->input('periodo');

   // actualizar el registro
   $admision = tb_equivalencia::find($id);
   $admision->carrera = $carrera;
   $admision->aspirantes = $aspirantes;
   $admision->examinados = $examinados;
   $admision->no_admitidos = $no_admitidos;
   $admision->periodo = $periodo;
   $admision->save();

   // retornar a la vista ingreso
   return redirect()->route('usuario.ingreso');
  }

  function eliminarEquivalencia(Request $request) {
   $id = $request->input('id');
   $equivalencia = tb_equivalencia::findOrFail($id);
   $equivalencia->delete(); 
   return redirect()->route('usuario.ingreso');
}

function eliminarEquivalencias(Request $request) {
   $id = $request->id;
   $equivalencia = tb_equivalencia::whereIn('id', $id);
   $equivalencia->delete();
   return redirect()->route('usuario.ingreso');
}

//  --------------------- TAB NUEVO MAESTRIAS -----------------------
   // ruta para guardar una nueva MAESTRIA del indicador ingreso en la maestria

   function registrarMaestria(Request $request) {
      $carrera = $request->input('carreras');
      $aspirantes = $request->input('aspirantes');
      $examinados = $request->input('examinados');
      $no_admitidos = $request->input('noAdmitidos');
      $periodo = $request->input('periodos');

      // crear un nuevo registro en la tabla tb_equivalencia
      $admision = new tb_maestria();
      $admision->carrera = $carrera;
      $admision->aspirantes = $aspirantes;
      $admision->examinados = $examinados;
      $admision->no_admitidos = $no_admitidos;
      $admision->periodo = $periodo;
      $admision->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.ingreso');

   }

   // ruta para editar una maestria
   function editarMaestria(Request $request) {
      // obtener los datos dle form y luego actualizar el registro
      $id = $request->input('id');
      $carrera = $request->input('carrera');
      $aspirantes = $request->input('aspirantes');
      $examinados = $request->input('examinados');
      $no_admitidos = $request->input('no_admitidos');
      $periodo = $request->input('periodo');

      // actualizar el registro
      $admision = tb_maestria::find($id);
      $admision->carrera = $carrera;
      $admision->aspirantes = $aspirantes;
      $admision->examinados = $examinados;
      $admision->no_admitidos = $no_admitidos;
      $admision->periodo = $periodo;
      $admision->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.ingreso');
   }

   function eliminarMaestria(Request $request) {
      $id = $request->input('id');
      $maestria = tb_maestria::findOrFail($id);
      $maestria->delete(); 
      return redirect()->route('usuario.ingreso');
   }

   function eliminarMaestrias(Request $request) {
      $id = $request->id;
      $maestria = tb_maestria::whereIn('id', $id);
      $maestria->delete();
      return redirect()->route('usuario.ingreso');
   }

//  --------------------- Fin Maestrias -----------------------//

//---------------TRANSPORTE----------------//

   function registrarTranspSolicitudes(Request $request) {
      $carrera = $request->input('carrera');
      $ruta = $request->input('ruta');
      $solicitudes = $request->input('solicitudes');
      $hombres = $request->input('hombres');
      $mujeres = $request->input('mujeres');
      $seleccionados = $hombres + $mujeres;
      $cuatrimestre = $request->input('cuatrimestre');
      $turno = $request->input('turno');
      
   
      // crear un nuevo registro en la tabla tb_transporte_solicit...
      $transpSolicit = new tb_transporte_solicitudes_seleccionados();
      $transpSolicit->solicitudes = $solicitudes;
      $transpSolicit->seleccionados = $seleccionados;
      $transpSolicit->hombres = $hombres;
      $transpSolicit->mujeres = $mujeres;
      $transpSolicit->carrera = $carrera;
      $transpSolicit->ruta = $ruta;
      $transpSolicit->cuatrimestre = $cuatrimestre;
      $transpSolicit->turno = $turno;
      $transpSolicit->save();

   
   
      // retornar a la vista ingres-o
      return redirect()->route('usuario.transporte');
     }
     function eliminarTranspSolicitudes(Request $request) {
      $id = $request->id;
      $nuevo_ingreso = tb_transporte_solicitudes_seleccionados::whereIn('id', $id);
      $nuevo_ingreso->delete();
      return redirect()->route('usuario.transporte');
     }

     function eliminarTranspSolicitud(Request $request) {
      $id = $request->input('id');
      $nuevo_ingreso = tb_transporte_solicitudes_seleccionados::findOrFail($id);
      $nuevo_ingreso->delete(); 
      return redirect()->route('usuario.transporte');
     }

     function eliminarTranspRuta(Request $request) {
      $id = $request->input('id');
      $nuevo_ingreso = tb_transporte_lugares::findOrFail($id);
      $nuevo_ingreso->delete(); 
      return redirect()->route('usuario.transporte');
     }

     function registrarTranspRutas(Request $request) {
      $ruta = $request->input('ruta');
      $lugares = $request->input('lugares_disp');
      $pagados = $request->input('pagados');
      $cuatrimestre = $request->input('cuatrimestre');
      $turno = $request->input('turno');
      
   
      // crear un nuevo registro en la tabla tb_transporte_solicit...
      $transpRutas = new tb_transporte_lugares();
      $transpRutas->ruta = $ruta;
      $transpRutas->cuatrimestre = $cuatrimestre;
      $transpRutas->turno = $turno;
      $transpRutas->lugares_disp = $lugares;
      $transpRutas->pagados = $pagados;
      $transpRutas->save();

   
   
      // retornar a la vista ingres-o
      return redirect()->route('usuario.transporte');
     }
     function eliminarTranspRutas(Request $request) {
      $id = $request->id;
      $nuevo_ingreso = tb_transporte_lugares::whereIn('id', $id);
      $nuevo_ingreso->delete();
      return redirect()->route('usuario.transporte');
     }

     function editarTranspSolicitudes(Request $request) {
      // recibir los datos del form
      $id = $request->input('id');
      $carrera = $request->input('carrera');
      $ruta = $request->input('ruta');
      $solicitudes = $request->input('solicitudes');
      $hombres = $request->input('hombres');
      $mujeres = $request->input('mujeres');
      $seleccionados = $hombres + $mujeres;
      $cuatrimestre = $request->input('cuatrimestre');
      $turno = $request->input('turno');

      // actualizar el registro
      $transpSolicit = tb_transporte_solicitudes_seleccionados::find($id);
      $transpSolicit->solicitudes = $solicitudes;
      $transpSolicit->hombres = $hombres;
      $transpSolicit->mujeres = $mujeres;
      $transpSolicit->seleccionados = $seleccionados;
      $transpSolicit->carrera = $carrera;
      $transpSolicit->ruta = $ruta;
      $transpSolicit->cuatrimestre = $cuatrimestre;
      $transpSolicit->turno = $turno;
      $transpSolicit->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.transporte');
  }
  function editarTranspRutas(Request $request) {
   // recibir los datos del form
   $id = $request->input('id');
   $ruta = $request->input('ruta');
   $lugares = $request->input('lugares_disp');
   $pagados = $request->input('pagados');
   $cuatrimestre = $request->input('cuatrimestre');
   $turno = $request->input('turno');

   // actualizar el registro
   
   $transpRutas = tb_transporte_lugares::find($id);
      $transpRutas->ruta = $ruta;
      $transpRutas->cuatrimestre = $cuatrimestre;
      $transpRutas->turno = $turno;
      $transpRutas->lugares_disp = $lugares;
      $transpRutas->pagados = $pagados;
      $transpRutas->save();

   // retornar a la vista ingreso
   return redirect()->route('usuario.transporte');

//-------------------------FIN TRANSPORTE-----------------------------

   }
   function eliminarEquivalencias2(Request $request) {
      $id = $request->id;
      $equiva = tb_indicador_equivalencia::whereIn('id', $id);
      $equiva->delete();
      return redirect()->route('usuario.equivalencia');
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