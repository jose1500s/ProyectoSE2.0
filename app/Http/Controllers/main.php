<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class main extends Controller
{
   public function ingreso()
   {
      return Inertia::render('menusComponentes/Ingreso');
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
      return Inertia::render('menusComponentes/Equivalencia');
   }
}
