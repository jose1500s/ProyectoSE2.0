<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_becas_excelencia_academica;
use App\Models\tb_becas_apoyo_cardenals;
use App\Models\tb_becas_por_proyectos;
use App\Models\tb_becas_cardenal_azuls;

class BecasController extends Controller
{
    public function becas()
    {
        $excelencias = tb_becas_excelencia_academica::all();
        $apoyos = tb_becas_apoyo_cardenals::all();
        $proyectos = tb_becas_por_proyectos::all();
        $azules = tb_becas_cardenal_azuls::all();
        return Inertia::render('menusComponentes/Becas/TabMenuBecas', ['excelencia'=>$excelencias,'apoyo'=>$apoyos,'proyecto'=>$proyectos,'azul'=>$azules]);
    }

    public function registrarBecaEA(Request $request)
    {
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        //crear un nuevo registro en la tabla
        $excelencia = new tb_becas_excelencia_academica();
        $excelencia->periodo = $periodo;
        $excelencia->año = $año;
        $excelencia->periodo_con_año = $periodoconaño;
        $excelencia->carrera = $carrera;
        $excelencia->hombres = $hombres;
        $excelencia->mujeres = $mujeres;
        $excelencia->total = $total;
        $excelencia->save();
        //se retorna la vista
        return redirect()->route('usuario.becas');
    }

    public function editarBecaEA(Request $request)
    {
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
        $excelencia = tb_becas_excelencia_academica::find($id);
        $excelencia->periodo = $periodo;
        $excelencia->año = $año;
        $excelencia->periodo_con_año = $periodoconaño;
        $excelencia->carrera = $carrera;
        $excelencia->hombres = $hombres;
        $excelencia->mujeres = $mujeres;
        $excelencia->total = $total;
        $excelencia->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.becas');
    }

    public function eliminarBecaEA(Request $request)
    {
        $id = $request->input('id');
        $excelencia = tb_becas_excelencia_academica::findOrFail($id);
        $excelencia->delete();
        return redirect()->route('usuario.becas');
    }

    public function eliminarBecaEAs(Request $request)
    {
        $id = $request->id;
        $excelencia = tb_becas_excelencia_academica::whereIn('id', $id);
        $excelencia->delete();
        return redirect()->route('usuario.becas');
    }
    
    public function importarDataExcelBecas(Request $request)
    {
      $excel = $request->input('datos');
      foreach($excel as $fila)
      {
         $periodoconaño = $fila['periodo'] . " " . strval($fila['año']);
         $total = $fila['hombres'] + $fila['mujeres'];
         if ($fila['tipo_beca'] == "excelencia"){
            $beca = new tb_becas_excelencia_academica();
         }
         elseif ($fila['tipo_beca'] == "apoyo"){
            $beca = new tb_becas_apoyo_cardenals();
         }
         elseif ($fila['tipo_beca'] == "proyecto"){
            $beca = new tb_becas_por_proyectos();
         }
         elseif ($fila['tipo_beca'] == "azul"){
            $beca = new tb_becas_cardenal_azuls();
         }
         $beca->periodo = $fila['periodo'];
         $beca->año = $fila['año'];
         $beca->periodo_con_año = $periodoconaño;
         $beca->carrera = $fila['carrera'];
         $beca->hombres = $fila['hombres'];
         $beca->mujeres = $fila['mujeres'];
         $beca->total = $total;
         $beca->save();
      }
      return redirect()->route('usuario.becas');
    }

    public function registrarBecaAC(Request $request)
    {
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        //crear un nuevo registro en la tabla
        $apoyo = new tb_becas_apoyo_cardenals();
        $apoyo->periodo = $periodo;
        $apoyo->año = $año;
        $apoyo->periodo_con_año = $periodoconaño;
        $apoyo->carrera = $carrera;
        $apoyo->hombres = $hombres;
        $apoyo->mujeres = $mujeres;
        $apoyo->total = $total;
        $apoyo->save();
        //se retorna la vista
        return redirect()->route('usuario.becas');
    }
     
    public function editarBecaAC(Request $request)
    {
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
        $apoyo = tb_becas_apoyo_cardenals::find($id);
        $apoyo->periodo = $periodo;
        $apoyo->año = $año;
        $apoyo->periodo_con_año = $periodoconaño;
        $apoyo->carrera = $carrera;
        $apoyo->hombres = $hombres;
        $apoyo->mujeres = $mujeres;
        $apoyo->total = $total;
        $apoyo->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.becas');
    }

    public function eliminarBecaAC(Request $request)
    {
        $id = $request->input('id');
        $apoyo = tb_becas_apoyo_cardenals::findOrFail($id);
        $apoyo->delete();
        return redirect()->route('usuario.becas');
    }
     
    public function eliminarBecaACs(Request $request)
    {
        $id = $request->id;
        $apoyo = tb_becas_apoyo_cardenals::whereIn('id', $id);
        $apoyo->delete();
        return redirect()->route('usuario.becas');
    }

     
    public function registrarBecaPP(Request $request)
    {
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        //crear un nuevo registro en la tabla
        $proyecto = new tb_becas_por_proyectos();
        $proyecto->periodo = $periodo;
        $proyecto->año = $año;
        $proyecto->periodo_con_año = $periodoconaño;
        $proyecto->carrera = $carrera;
        $proyecto->hombres = $hombres;
        $proyecto->mujeres = $mujeres;
        $proyecto->total = $total;
        $proyecto->save();
        //se retorna la vista
        return redirect()->route('usuario.becas');
    }
     
    public function editarBecaPP(Request $request)
    {
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
        $proyecto = tb_becas_por_proyectos::find($id);
        $proyecto->periodo = $periodo;
        $proyecto->año = $año;
        $proyecto->periodo_con_año = $periodoconaño;
        $proyecto->carrera = $carrera;
        $proyecto->hombres = $hombres;
        $proyecto->mujeres = $mujeres;
        $proyecto->total = $total;
        $proyecto->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.becas');
    }
     
    public function eliminarBecaPP(Request $request)
    {
        $id = $request->input('id');
        $proyecto = tb_becas_por_proyectos::findOrFail($id);
        $proyecto->delete();
        return redirect()->route('usuario.becas');
    }
     
    public function eliminarBecaPPs(Request $request)
    {
        $id = $request->id;
        $proyecto = tb_becas_por_proyectos::whereIn('id', $id);
        $proyecto->delete();
        return redirect()->route('usuario.becas');
    }

     
    public function registrarBecaCA(Request $request)
    {
        $periodo = $request->input('periodo');
        $año = $request->input('año');
        $periodoconaño = $periodo . " " . strval($año);
        $carrera = $request->input('carrera');
        $hombres = $request->input('hombres');
        $mujeres = $request->input('mujeres');
        $total = $hombres + $mujeres;
        //crear un nuevo registro en la tabla
        $azul = new tb_becas_cardenal_azuls();
        $azul->periodo = $periodo;
        $azul->año = $año;
        $azul->periodo_con_año = $periodoconaño;
        $azul->carrera = $carrera;
        $azul->hombres = $hombres;
        $azul->mujeres = $mujeres;
        $azul->total = $total;
        $azul->save();
        //se retorna la vista
        return redirect()->route('usuario.becas');
    }
     
    public function editarBecaCA(Request $request)
    {
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
        $azul = tb_becas_cardenal_azuls::find($id);
        $azul->periodo = $periodo;
        $azul->año = $año;
        $azul->periodo_con_año = $periodoconaño;
        $azul->carrera = $carrera;
        $azul->hombres = $hombres;
        $azul->mujeres = $mujeres;
        $azul->total = $total;
        $azul->save();

        // retornar a la vista ingreso
        return redirect()->route('usuario.becas');
    }
     
    public function eliminarBecaCA(Request $request)
    {
        $id = $request->input('id');
        $azul = tb_becas_cardenal_azuls::findOrFail($id);
        $azul->delete();
        return redirect()->route('usuario.becas');
    }
     
    public function eliminarBecaCAs(Request $request)
    {
        $id = $request->id;
        $azul = tb_becas_cardenal_azuls::whereIn('id', $id);
        $azul->delete();
        return redirect()->route('usuario.becas');
    }
}
