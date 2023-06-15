<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_bajas_temporales;
use App\Models\tb_bajas_voluntarias;
use App\Models\tb_bajas_academicas;
use App\Models\tb_bajas_administrativas;
use App\Models\tb_bajas_totales_periodos;
use App\Models\tb_bajas_totales_tipos;
use App\Models\tb_bajas_totales;

class BajasController extends Controller
{
    public function bajas() {
        $temporales = tb_bajas_temporales::all();
        $voluntarias = tb_bajas_voluntarias::all();
        $academicas = tb_bajas_academicas::all();
        $administrativas = tb_bajas_administrativas::all();
        return Inertia::render('menusComponentes/Bajas/TabMenu', 
        ['temporal'=>$temporales,
        'voluntaria'=>$voluntarias,
        'academica'=>$academicas,
        'administrativa'=>$administrativas,
         'totalesTipos'=>tb_bajas_totales_tipos::all(),
         'totalesCarreras'=>tb_bajas_totales_periodos::all(),
         'totales'=>tb_bajas_totales::all()]);
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

     public function importarExcelBajasTipos(Request $request){
      $excel = $request->input('datos');
      foreach($excel as $fila){
         $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
         $total = $fila['hombres'] + $fila['mujeres'];
         $baja = new tb_bajas_totales_tipos();
         $baja->periodo = $fila['periodo'];
         $baja->año = $fila['año'];
         $baja->periodo_con_año = $periodoconaño;
         $baja->tipo_baja = $fila['tipo_baja'];
         $baja->hombres = $fila['hombres'];
         $baja->mujeres = $fila['mujeres'];
         $baja->total = $total;
         $baja->save();
      }
      return redirect()->route('usuario.bajas');
     }

     public function importarExcelBajasTotalesCarrreras(Request $request){
      $excel = $request->input('datos');
      foreach($excel as $fila){
         $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
         $total = $fila['hombres'] + $fila['mujeres'];
         $baja = new tb_bajas_totales_tipos();
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

     public function importarExcelBajasTotales(Request $request){
      $excel = $request->input('datos');
      foreach($excel as $fila){
         $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
         $total = $fila['hombres'] + $fila['mujeres'];
         $baja = new tb_bajas_totales();
         $baja->periodo = $fila['periodo'];
         $baja->año = $fila['año'];
         $baja->periodo_con_año = $periodoconaño;
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

     public function registrarBajasTotalTipos(Request $request){
      $periodo = $request->input('periodo');
      $año = $request->input('año');
      $periodoconaño = $periodo . " " . strval($año);
      $tipo_baja = $request->input('tipo_baja');
      $hombres = $request->input('hombres');
      $mujeres = $request->input('mujeres');
      $total = $hombres + $mujeres;
      //crear un nuevo registro en la tabla
      $totalTipos = new tb_bajas_totales_tipos();
      $totalTipos->periodo = $periodo;
      $totalTipos->año = $año;
      $totalTipos->periodo_con_año = $periodoconaño;
      $totalTipos->tipo_baja = $tipo_baja;
      $totalTipos->hombres = $hombres;
      $totalTipos->mujeres = $mujeres;
      $totalTipos->total = $total;
      $totalTipos->save();
      //se retorna la vista
      return redirect()->route('usuario.bajas');
   }
   public function editarBajasTotalTipos(Request $request){
      // obtener los datos dle form y luego actualizar el registro
      $id = $request->input('id');
      $periodo = $request->input('periodo');
      $año = $request->input('año');
      $periodoconaño = $periodo . " " . strval($año);
      $tipo_baja = $request->input('tipo_baja');
      $hombres = $request->input('hombres');
      $mujeres = $request->input('mujeres');
      $total = $hombres + $mujeres;
      // actualizar el registro
      //$admision = tb_admision::find($id);
      $totalTipos = tb_bajas_totales_tipos::find($id);
      $totalTipos->periodo = $periodo;
      $totalTipos->año = $año;
      $totalTipos->periodo_con_año = $periodoconaño;
      $totalTipos->tipo_baja = $tipo_baja;
      $totalTipos->hombres = $hombres;
      $totalTipos->mujeres = $mujeres;
      $totalTipos->total = $total;
      $totalTipos->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.bajas');
   }
   public function eliminarBajaTotalTipos(Request $request){
      $id = $request->input('id');
      $totalTipos = tb_bajas_totales_tipos::findOrFail($id);
      $totalTipos->delete();
      return redirect()->route('usuario.bajas');
   }
   public function eliminiarBajasTotalesTipos(Request $request){
      $id = $request->id;
      $totalTipos = tb_bajas_totales_tipos::whereIn('id', $id);
      $totalTipos->delete();
      return redirect()->route('usuario.bajas');
   }

   public function registrarBajasTotalCarreras(Request $request){
      $periodo = $request->input('periodo');
      $año = $request->input('año');
      $periodoconaño = $periodo . " " . strval($año);
      $carrera = $request->input('carrera');
      $hombres = $request->input('hombres');
      $mujeres = $request->input('mujeres');
      $total = $hombres + $mujeres;
      //crear un nuevo registro en la tabla
      $totalCarrera = new tb_bajas_totales_periodos();
      $totalCarrera->periodo = $periodo;
      $totalCarrera->año = $año;
      $totalCarrera->periodo_con_año = $periodoconaño;
      $totalCarrera->carrera = $carrera;
      $totalCarrera->hombres = $hombres;
      $totalCarrera->mujeres = $mujeres;
      $totalCarrera->total = $total;
      $totalCarrera->save();
      //se retorna la vista
      return redirect()->route('usuario.bajas');
   }
   public function editarBajasTotalCarreras(Request $request){
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
      $totalCarrera = tb_bajas_totales_periodos::find($id);
      $totalCarrera->periodo = $periodo;
      $totalCarrera->año = $año;
      $totalCarrera->periodo_con_año = $periodoconaño;
      $totalCarrera->carrera = $carrera;
      $totalCarrera->hombres = $hombres;
      $totalCarrera->mujeres = $mujeres;
      $totalCarrera->total = $total;
      $totalCarrera->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.bajas');
   }
   public function eliminarBajaTotalCarreras(Request $request){
      $id = $request->input('id');
      $totalCarrera = tb_bajas_totales_periodos::findOrFail($id);
      $totalCarrera->delete();
      return redirect()->route('usuario.bajas');
   }
   public function eliminarBajasTotalesCarreras(Request $request){
      $id = $request->id;
      $totalCarrera = tb_bajas_totales_periodos::whereIn('id', $id);
      $totalCarrera->delete();
      return redirect()->route('usuario.bajas');
   }

   public function registrarBajaTotal(Request $request){
      $periodo = $request->input('periodo');
      $año = $request->input('año');
      $periodoconaño = $periodo . " " . strval($año);
      $hombres = $request->input('hombres');
      $mujeres = $request->input('mujeres');
      $total = $hombres + $mujeres;
      //crear un nuevo registro en la tabla
      $totalCarrera = new tb_bajas_totales();
      $totalCarrera->periodo = $periodo;
      $totalCarrera->año = $año;
      $totalCarrera->periodo_con_año = $periodoconaño;
      $totalCarrera->hombres = $hombres;
      $totalCarrera->mujeres = $mujeres;
      $totalCarrera->total = $total;
      $totalCarrera->save();
      //se retorna la vista
      return redirect()->route('usuario.bajas');
   }
   public function editarBajaTotal(Request $request){
      // obtener los datos dle form y luego actualizar el registro
      $id = $request->input('id');
      $periodo = $request->input('periodo');
      $año = $request->input('año');
      $periodoconaño = $periodo . " " . strval($año);
      $hombres = $request->input('hombres');
      $mujeres = $request->input('mujeres');
      $total = $hombres + $mujeres;
      // actualizar el registro
      //$admision = tb_admision::find($id);
      $totalCarrera = tb_bajas_totales::find($id);
      $totalCarrera->periodo = $periodo;
      $totalCarrera->año = $año;
      $totalCarrera->periodo_con_año = $periodoconaño;
      $totalCarrera->hombres = $hombres;
      $totalCarrera->mujeres = $mujeres;
      $totalCarrera->total = $total;
      $totalCarrera->save();

      // retornar a la vista ingreso
      return redirect()->route('usuario.bajas');
   }
   public function eliminarBajaTotal(Request $request){
      $id = $request->input('id');
      $totalCarrera = tb_bajas_totales::findOrFail($id);
      $totalCarrera->delete();
      return redirect()->route('usuario.bajas');
   }
   public function eliminarBajasTotales(Request $request){
      $id = $request->id;
      $totalCarrera = tb_bajas_totales::whereIn('id', $id);
      $totalCarrera->delete();
      return redirect()->route('usuario.bajas');
   }
}
