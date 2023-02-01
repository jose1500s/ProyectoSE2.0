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
      return Inertia::render('menusComponentes/Ingreso', ['ingresos' => $ingresos]);
   }

   public function bajas() {
      return Inertia::render('menusComponentes/Bajas');
   }
}
