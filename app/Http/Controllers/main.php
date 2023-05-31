<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_indicador_equivalencia;
use App\Models\tb_transporte_lugares;
use App\Models\tb_transporte_solicitudes_seleccionados;

class main extends Controller
{

   public function matricula(){
      return Inertia::render('menusComponentes/Matricula');
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
}