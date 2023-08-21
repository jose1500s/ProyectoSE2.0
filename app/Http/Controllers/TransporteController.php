<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_transporte_lugares;
use App\Models\tb_transporte_solicitudes_seleccionados;

class TransporteController extends Controller
{
    public function transporte()
    {
        $solicitudes = tb_transporte_solicitudes_seleccionados::all();
        $rutas = tb_transporte_lugares::all();
        return Inertia::render('menusComponentes/Transporte/TabMenu', ['solicitudes' => $solicitudes, 'rutas' => $rutas]);
    }

    //---------------TRANSPORTE----------------//

    function registrarTranspSolicitudes(Request $request)
    {
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
    function eliminarTranspSolicitudes(Request $request)
    {
        $id = $request->id;
        $nuevo_ingreso = tb_transporte_solicitudes_seleccionados::whereIn('id', $id);
        $nuevo_ingreso->delete();
        return redirect()->route('usuario.transporte');
    }

    function eliminarTranspSolicitud(Request $request)
    {
        $id = $request->input('id');
        $nuevo_ingreso = tb_transporte_solicitudes_seleccionados::findOrFail($id);
        $nuevo_ingreso->delete();
        return redirect()->route('usuario.transporte');
    }

    function eliminarTranspRuta(Request $request)
    {
        $id = $request->input('id');
        $nuevo_ingreso = tb_transporte_lugares::findOrFail($id);
        $nuevo_ingreso->delete();
        return redirect()->route('usuario.transporte');
    }

    function registrarTranspRutas(Request $request)
    {
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
    function eliminarTranspRutas(Request $request)
    {
        $id = $request->id;
        $nuevo_ingreso = tb_transporte_lugares::whereIn('id', $id);
        $nuevo_ingreso->delete();
        return redirect()->route('usuario.transporte');
    }

    function editarTranspSolicitudes(Request $request)
    {
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
    function editarTranspRutas(Request $request)
    {
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
    }
    public function importarDataExcelSolicitudes(Request $request)
    {
        $datosExcel = $request->input('datos');

        foreach ($datosExcel as $fila) {

            $transpSolicit = new tb_transporte_solicitudes_seleccionados();
            $transpSolicit->solicitudes = $fila['solicitudes'];
            $transpSolicit->seleccionados = $fila['seleccionados'];
            $transpSolicit->hombres = $fila['hombres'];
            $transpSolicit->mujeres = $fila['mujeres'];
            $transpSolicit->carrera = $fila['carrera'];
            $transpSolicit->ruta = $fila['ruta'];
            $transpSolicit->cuatrimestre = $fila['cuatrimestre'];
            $transpSolicit->turno = $fila['turno'];
            $transpSolicit->save();
        }
    }

    public function importarDataExcelRutas (Request $request)
    {
        $datosExcel = $request->input('datos');
        
        foreach ($datosExcel as $fila) {
            $transpRutas = new tb_transporte_lugares();
            $transpRutas->ruta = $fila['ruta'];
            $transpRutas->cuatrimestre = $fila['cuatrimestre'];
            $transpRutas->turno = $fila['turno'];
            $transpRutas->lugares_disp = $fila['lugares_disp'];
            $transpRutas->pagados = $fila['pagados'];
            $transpRutas->save();   
        }
    }
    //-------------------------FIN TRANSPORTE-----------------------------
}
