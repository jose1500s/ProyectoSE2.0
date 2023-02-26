<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_ingreso;
class main extends Controller
{
   public function ingreso()
   {
      // traer de la tabla tb_ingreso todos los registros
      $ingresos = tb_ingreso::all();
      // retornar con Inertia a menusComponentes/Ingreso y pasarle los registros
      return Inertia::render('menusComponentes/Ingreso/Ingreso', ['ingresos' => $ingresos]);
   }

   // public function inicio()
   // {
   //    $ingresos = tb_ingreso::all();
   //    //retornar el dashboard con inertia
   //    return Inertia::render('Welcome', ['ingresos' => $ingresos]);
   // }

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
}
