<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_bajas_temporales;
use App\Models\tb_bajas_voluntarias;
use App\Models\tb_bajas_academicas;
use App\Models\tb_bajas_administrativas;

class BajasController extends Controller
{
    public function bajas() {
        $temporales = tb_bajas_temporales::all();
        $voluntarias = tb_bajas_voluntarias::all();
        $academicas = tb_bajas_academicas::all();
        $administrativas = tb_bajas_administrativas::all();
        return Inertia::render('menusComponentes/Bajas/TabMenu', ['temporal'=>$temporales,'voluntaria'=>$voluntarias,'academica'=>$academicas,'administrativa'=>$administrativas]);
     }

     public function registrarTemporal(Request $request){
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        //crear un nuevo registro en la tabla
        $temporal = new tb_bajas_temporales();
        $temporal->periodo = $periodo;
        $temporal->año = $año;
        $temporal->periodo_con_año = $periodoconaño;
        $temporal->carrera = $carrera;
        $temporal->hombres = $hombres;
        $temporal->mujeres = $mujeres;
        $temporal->total = $total;
        $temporal->save();
        //se retorna la vista
        return redirect()->route('usuario.bajas');
     }
     public function editarTemporal(Request $request){
        // obtener los datos dle form y luego actualizar el registro
        $id = $request->input('id');
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        // actualizar el registro
        //$admision = tb_admision::find($id);
        $temporal = tb_bajas_temporales::find($id);
        $temporal->periodo = $periodo;
        $temporal->año = $año;
        $temporal->periodo_con_año = $periodoconaño;
        $temporal->carrera = $carrera;
        $temporal->hombres = $hombres;
        $temporal->mujeres = $mujeres;
        $temporal->total = $total;
        $temporal->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.bajas');
     }
     public function eliminarTemporal(Request $request){
        $id = $request->input('id');
        $temporal = tb_bajas_temporales::findOrFail($id);
        $temporal->delete();
        return redirect()->route('usuario.bajas');
     }
     public function eliminarTemporales(Request $request){
        $id = $request->id;
        $temporal = tb_bajas_temporales::whereIn('id', $id);
        $temporal->delete();
        return redirect()->route('usuario.bajas');
     }
     public function importarDataExcelBajas(Request $request){
      $excel = $request->input('datos');
      foreach($excel as $fila){
         $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
         $total = $fila['hombres'] + $fila['mujeres'];
         if ($fila['tipo_baja'] == "temporal"){
            $baja = new tb_bajas_temporales();
         }
         elseif ($fila['tipo_baja'] == "voluntaria"){
            $baja = new tb_bajas_voluntarias();
         }
         elseif ($fila['tipo_baja'] == "academica"){
            $baja = new tb_bajas_academicas();
         }
         elseif ($fila['tipo_baja'] == "administrativa"){
            $baja = new tb_bajas_administrativas();
         }
         $baja->periodo = $fila['periodo'];
         $baja->año = $fila['año'];
         $baja->periodo_con_año = $periodoconaño;
         $baja->carrera = $fila['carrera'];
         $baja->hombres = $fila['hombres'];
         $baja->mujeres = $fila['mujeres'];
         $baja->total = $total;
         $baja->save();
      }
      return redirect()->route('usuario.bajas');
     }

     public function registrarVoluntaria(Request $request){
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        //crear un nuevo registro en la tabla
        $temporal = new tb_bajas_voluntarias();
        $temporal->periodo = $periodo;
        $temporal->año = $año;
        $temporal->periodo_con_año = $periodoconaño;
        $temporal->carrera = $carrera;
        $temporal->hombres = $hombres;
        $temporal->mujeres = $mujeres;
        $temporal->total = $total;
        $temporal->save();
        //se retorna la vista
        return redirect()->route('usuario.bajas');
     }
     public function editarVoluntaria(Request $request){
        // obtener los datos dle form y luego actualizar el registro
        $id = $request->input('id');
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        // actualizar el registro
        //$admision = tb_admision::find($id);
        $temporal = tb_bajas_voluntarias::find($id);
        $temporal->periodo = $periodo;
        $temporal->año = $año;
        $temporal->periodo_con_año = $periodoconaño;
        $temporal->carrera = $carrera;
        $temporal->hombres = $hombres;
        $temporal->mujeres = $mujeres;
        $temporal->total = $total;
        $temporal->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.bajas');
     }
     public function eliminarVoluntaria(Request $request){
        $id = $request->input('id');
        $temporal = tb_bajas_voluntarias::findOrFail($id);
        $temporal->delete();
        return redirect()->route('usuario.bajas');
     }
     public function eliminarVoluntarias(Request $request){
        $id = $request->id;
        $temporal = tb_bajas_voluntarias::whereIn('id', $id);
        $temporal->delete();
        return redirect()->route('usuario.bajas');
     }

     public function registrarAcademica(Request $request){
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        //crear un nuevo registro en la tabla
        $temporal = new tb_bajas_academicas();
        $temporal->periodo = $periodo;
        $temporal->año = $año;
        $temporal->periodo_con_año = $periodoconaño;
        $temporal->carrera = $carrera;
        $temporal->hombres = $hombres;
        $temporal->mujeres = $mujeres;
        $temporal->total = $total;
        $temporal->save();
        //se retorna la vista
        return redirect()->route('usuario.bajas');
     }
     public function editarAcademica(Request $request){
        // obtener los datos dle form y luego actualizar el registro
        $id = $request->input('id');
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        // actualizar el registro
        //$admision = tb_admision::find($id);
        $temporal = tb_bajas_academicas::find($id);
        $temporal->periodo = $periodo;
        $temporal->año = $año;
        $temporal->periodo_con_año = $periodoconaño;
        $temporal->carrera = $carrera;
        $temporal->hombres = $hombres;
        $temporal->mujeres = $mujeres;
        $temporal->total = $total;
        $temporal->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.bajas');
     }
     public function eliminarAcademica(Request $request){
        $id = $request->input('id');
        $temporal = tb_bajas_academicas::findOrFail($id);
        $temporal->delete();
        return redirect()->route('usuario.bajas');
     }
     public function eliminarAcademicas(Request $request){
        $id = $request->id;
        $temporal = tb_bajas_academicas::whereIn('id', $id);
        $temporal->delete();
        return redirect()->route('usuario.bajas');
     }

     public function registrarAdministrativa(Request $request){
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        //crear un nuevo registro en la tabla
        $temporal = new tb_bajas_administrativas();
        $temporal->periodo = $periodo;
        $temporal->año = $año;
        $temporal->periodo_con_año = $periodoconaño;
        $temporal->carrera = $carrera;
        $temporal->hombres = $hombres;
        $temporal->mujeres = $mujeres;
        $temporal->total = $total;
        $temporal->save();
        //se retorna la vista
        return redirect()->route('usuario.bajas');
     }
     public function editarAdministrativa(Request $request){
        // obtener los datos dle form y luego actualizar el registro
        $id = $request->input('id');
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        // actualizar el registro
        //$admision = tb_admision::find($id);
        $temporal = tb_bajas_administrativas::find($id);
        $temporal->periodo = $periodo;
        $temporal->año = $año;
        $temporal->periodo_con_año = $periodoconaño;
        $temporal->carrera = $carrera;
        $temporal->hombres = $hombres;
        $temporal->mujeres = $mujeres;
        $temporal->total = $total;
        $temporal->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.bajas');
     }
     public function eliminarAdministrativa(Request $request){
        $id = $request->input('id');
        $temporal = tb_bajas_administrativas::findOrFail($id);
        $temporal->delete();
        return redirect()->route('usuario.bajas');
     }
     public function eliminarAdministrativas(Request $request){
        $id = $request->id;
        $temporal = tb_bajas_administrativas::whereIn('id', $id);
        $temporal->delete();
        return redirect()->route('usuario.bajas');
     }
}
