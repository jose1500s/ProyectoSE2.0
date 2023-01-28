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

   // ruta para administrador
   public function administrador()
   {
      return Inertia::render('menusComponentes/Administrador');
   }
}
