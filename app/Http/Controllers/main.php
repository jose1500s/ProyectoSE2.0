<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_admision;
class main extends Controller
{
   public function ingreso()
   {
      // traer de la tabla tb_ingreso todos los registros
      $ingresos = tb_admision::all();
      // retornar con Inertia a menusComponentes/TabMenu y pasarle los registros
      return Inertia::render('menusComponentes/Ingreso/TabMenu', ['ingresos' => $ingresos]);
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

   public function seguroFacultativo(){
      return Inertia::render('menusComponentes/SeguroFacultativo');
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
   
  }
}
