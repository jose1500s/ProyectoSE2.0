<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_cambio_carrera;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;

class CambioCarreraController extends Controller
{
    //Traer todos los registros de la tabla tb_cambio_carrera
    public function cambioDeCarrera(){
        $roles = Auth::user()->roles;
        
        foreach($roles as $rol){
            $rol->permissions;
        }

        $cambioCarrera = tb_cambio_carrera::all();
        return Inertia::render('menusComponentes/CambioCarrera/TabMenuCC', ['dataCambioCarreras' => $cambioCarrera]);
    }

    //Registrar un nuevo registro en la tabla tb_cambio_carrera
    public function registrarCambioCarrera(Request $request){
        $periodo = $request->input('periodos');
        $year = $request->input('year');
        $nombre = $request->input('nombres');
        $matricula = $request->input('matriculas');
        $carrera_actual = $request->input('carrera_actual');
        $carrera_nueva = $request->input('carrera_nueva');
        $dictamen = $request->input('dictamen');
        $grupo = $request->input('grupos');
        $carga_kardex = $request->input('carga_kardex');
        
        //crear un nuevo registro en la tabla tb_cambio_carrera
        $cambioCarrera = new tb_cambio_carrera();
        $cambioCarrera->periodo = $periodo;
        $cambioCarrera->year = $year;
        $cambioCarrera->nombre = $nombre;
        $cambioCarrera->matricula = $matricula;
        $cambioCarrera->carrera_actual = $carrera_actual;
        $cambioCarrera->carrera_nueva = $carrera_nueva;
        $cambioCarrera->dictamen = $dictamen;
        $cambioCarrera->grupo = $grupo;
        $cambioCarrera->carga_kardex = $carga_kardex;
        $cambioCarrera->save();

        return redirect()->route('usuario.cambio_de_carrera');
    }

    //Eliminar un registro de la tabla tb_cambio_carrera

    public function eliminarCambioCarrera(Request $request){
        $id = $request->input('id');
        $cambioCarrera = tb_cambio_carrera::find($id);
        $cambioCarrera->delete();
        return redirect()->route('usuario.cambio_de_carrera');
    }


    //Actualizar un registro de la tabla tb_cambio_carrera
    public function editarCambioCarrera(Request $request){
        $id = $request->input('id');
        $periodo = $request->input('periodo');
        $year = $request->input('year');
        $nombre = $request->input('nombres');
        $matricula = $request->input('matricula');
        $carrera_actual = $request->input('carrera_actual');
        $carrera_nueva = $request->input('carrera_nueva');
        $dictamen = $request->input('dictamen');
        $grupo = $request->input('grupos');
        $carga_kardex = $request->input('carga_kardex');

        $cambioCarrera = tb_cambio_carrera::find($id);
        $cambioCarrera->periodo = $periodo;
        $cambioCarrera->year = $year;
        $cambioCarrera->nombre = $nombre;
        $cambioCarrera->matricula = $matricula;
        $cambioCarrera->carrera_actual = $carrera_actual;
        $cambioCarrera->carrera_nueva = $carrera_nueva;
        $cambioCarrera->dictamen = $dictamen;
        $cambioCarrera->grupo = $grupo;
        $cambioCarrera->carga_kardex = $carga_kardex;
        $cambioCarrera->save();

        return redirect()->route('usuario.cambio_de_carrera');
    }


    public function importarDataExcelCambioCarrera(Request $request) {
        $datosExcel = $request->input('datos');
        
        foreach ($datosExcel as $fila) {
            $periodo = $fila['periodo'];
            $year = $fila['year'];
            $nombre = $fila['nombre'];
            $matricula = $fila['matricula'];
            $carrera_actual = $fila['carrera_actual'];
            $carrera_nueva = $fila['carrera_nueva'];
            $dictamen = $fila['dictamen'];
            $grupo = $fila['grupo'];
            $carga_kardex = $fila['carga_kardex'];

            $cambioCarrera = new tb_cambio_carrera();
            $cambioCarrera->periodo = $periodo;
            $cambioCarrera->year = $year;
            $cambioCarrera->nombre = $nombre;
            $cambioCarrera->matricula = $matricula;
            $cambioCarrera->carrera_actual = $carrera_actual;
            $cambioCarrera->carrera_nueva = $carrera_nueva;
            $cambioCarrera->dictamen = $dictamen;
            $cambioCarrera->grupo = $grupo;
            $cambioCarrera->carga_kardex = $carga_kardex;
            $cambioCarrera->save();
        }
        
        return redirect()->route('usuario.cambio_de_carrera');
    }
}