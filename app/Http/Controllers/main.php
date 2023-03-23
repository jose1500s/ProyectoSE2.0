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
use App\Models\equivalencias2;
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
      return Inertia::render('menusComponentes/Egresados');
   }

   public function titulados(){
      return Inertia::render('menusComponentes/Titulados');
   }

   public function becas(){
      return Inertia::render('menusComponentes/Becas');
   }

   public function transporte(){
      return Inertia::render('menusComponentes/Transporte');
   }

   public function cambioDeCarrera(){
      return Inertia::render('menusComponentes/CambioDeCarrera');
   }

   public function equivalencia(){
      $equivalencias2 = equivalencias2::all();
      return Inertia::render('menusComponentes/Equivalencia/TabMenuEqui', ['equivalencias' => $equivalencias]);
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

   //  --------------------- TAB NUEVO EQUIVALENCIA2 -----------------------
   // ruta para guardar una nueva equivalencia del indicador ingreso en la equivalencia
  function registrarEquivalencia2(Request $request) {
   $carrera = $request->input('carreras');
   $aspirantes = $request->input('aspirantes');
   $examinados = $request->input('examinados');
   $no_admitidos = $request->input('noAdmitidos');
   $periodo = $request->input('periodos');

   // crear un nuevo registro en la tabla tb_equivalencia
   $admision = new equivalencias2();
   $admision->carrera = $carrera;
   $admision->aspirantes = $aspirantes;
   $admision->examinados = $examinados;
   $admision->no_admitidos = $no_admitidos;
   $admision->periodo = $periodo;
   $admision->save();

   // retornar a la vista ingreso
   return redirect()->route('usuario.equivalencia');

} 

// ruta para editar una equivalencia
function editarEquivalencia2(Request $request) {
   // obtener los datos dle form y luego actualizar el registro
   $id = $request->input('id');
   $carrera = $request->input('carrera');
   $aspirantes = $request->input('aspirantes');
   $examinados = $request->input('examinados');
   $no_admitidos = $request->input('no_admitidos');
   $periodo = $request->input('periodo');

   // actualizar el registro
   $admision = equivalencias2::find($id);
   $admision->carrera = $carrera;
   $admision->aspirantes = $aspirantes;
   $admision->examinados = $examinados;
   $admision->no_admitidos = $no_admitidos;
   $admision->periodo = $periodo;
   $admision->save();

   // retornar a la vista ingreso
   return redirect()->route('usuario.equivalencia');
  }

  function eliminarEquivalencia2(Request $request) {
   $id = $request->input('id');
   $equivalencia2 = equivalencias2::findOrFail($id);
   $equivalencia2->delete(); 
   return redirect()->route('usuario.equivalencia');
}

function eliminarEquivalencias2(Request $request) {
   $id = $request->id;
   $equivalencia2 = equivalencias2::whereIn('id', $id);
   $equivalencia2->delete();
   return redirect()->route('usuario.equivalencia');
}
}
