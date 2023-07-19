<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\tb_matricula;
use Illuminate\Console\View\Components\Alert;

class MatriculaController extends Controller
{
    //Traer todos los registros de la tabla tb_matricula
    public function matricula(){
        $matriculas = tb_matricula::all();
        return Inertia::render('menusComponentes/Matricula/TabMenuMa', ['dataMatriculas' => $matriculas]);
    }

    //Registrar un nuevo registro en la tabla tb_matricula
    public function registrarMatricula(Request $request){
        $carrera = $request->input('carreras');
        $matriculaNew = $request->input('matriculas');
        $periodo = $request->input('periodos');
        $year = $request->input('year');

        //traer todos los registros de la tabla tb_matricula donde el periodo y year sean iguales a los que se estan ingresando
        $matriculas = tb_matricula::where('periodo', $periodo)->where('year', $year)->get();

        //sumar el total de matriculas que se encuentran en la tabla tb_matricula
        $totalMatriculas = 0;
        foreach($matriculas as $matricula){
            $totalMatriculas += $matricula->matricula;
        }
        $totalMatriculas += $matriculaNew;


        if(count($matriculas) > 0){
            for($i = 0; $i < count($matriculas); $i++){
                $editMatriculas = tb_matricula::find($matriculas[$i]->id);
                //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $porcentaje = ($matriculas[$i]->matricula * 100) / $totalMatriculas;
                //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $editMatriculas->porcentaje = $porcentaje;
                //actualizar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $editMatriculas->save();
            }
        }

        //sacar el porcentaje unicamente de la matricula que se esta ingresando
        $porcentaje = ($matriculaNew * 100) / $totalMatriculas;

        //crear un nuevo registro en la tabla tb_matricula
        $matricula = new tb_matricula();
        $matricula->carrera = $carrera;
        $matricula->matricula = $matriculaNew;
        $matricula->porcentaje = $porcentaje;
        $matricula->periodo = $periodo;
        $matricula->year = $year;
        $matricula->save();

        return redirect()->route('usuario.matricula');

    }

    //Eliminar un registro de la tabla tb_matricula
    public function eliminarMatricula(Request $request)
    {
        $id = $request->input('id');
        $matricula = tb_matricula::findOrFail($id);
        $matricula->delete();

        $matriculas = tb_matricula::where('periodo', $matricula->periodo)->where('year', $matricula->year)->get();

        $totalMatriculas = 0;
        foreach($matriculas as $matriculaSuma){
            $totalMatriculas += $matriculaSuma->matricula;
        }
        for($i = 0; $i < count($matriculas); $i++){
            $editMatriculas = tb_matricula::find($matriculas[$i]->id);
            //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
            $porcentaje = ($matriculas[$i]->matricula * 100) / $totalMatriculas;
            //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
            $editMatriculas->porcentaje = $porcentaje;
            //actualizar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
            $editMatriculas->save();
        }

        return redirect()->route('usuario.matricula');
    }

    //Editar un registro de la tabla tb_matricula
    public function editarMatricula(Request $request){
        $id = $request->input('id');
        $matricula = $request->input('matriculas');
        $periodo = $request->input('periodo');
        $year = $request->input('year');

        $matriculaAntigua = tb_matricula::findOrFail($id);
        
            $matriculasAntiguas = tb_matricula::where('periodo', $matriculaAntigua->periodo)->where('year', $matriculaAntigua->year)->whereNotIn('id', [$id])->get();
        
        

            $totalMatriculasAntiguas = 0;

            foreach($matriculasAntiguas as $matriculaSuma){
                $totalMatriculasAntiguas += $matriculaSuma->matricula;
            }
            //Actualizar el porcentaje de las matriculas relacionadas a la matricula que se esta editando
            if(count($matriculasAntiguas) > 0){
                for($i = 0; $i < count($matriculasAntiguas); $i++){
                    $editMatriculas = tb_matricula::find($matriculasAntiguas[$i]->id);
                    //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                    $porcentajeNew = ($matriculasAntiguas[$i]->matricula * 100) / $totalMatriculasAntiguas;

                    //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                    $editMatriculas->porcentaje = $porcentajeNew;
                    //actualizar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                    $editMatriculas->save();
                }
            }

        
        //Actualizar el porcentaje de la matricula que se esta editando
        if($matriculaAntigua->periodo == $periodo && $matriculaAntigua->year == $year){
            $matriculas = tb_matricula::where('periodo', $periodo)->where('year', $year)->whereNotIn('id', [$id])->get();
        }else{
            $matriculas = tb_matricula::where('periodo', $periodo)->where('year', $year)->get();
        }
        
        $totalMatriculas = 0;
        foreach($matriculas as $matriculaSuma){
            $totalMatriculas += $matriculaSuma->matricula;
        }
        $totalMatriculas += $matricula;
        
        


        if(count($matriculas) > 0){
            for($i = 0; $i < count($matriculas); $i++){
                $editMatriculas = tb_matricula::find($matriculas[$i]->id);
                //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $porcentaje = ($matriculas[$i]->matricula * 100) / $totalMatriculas;
                //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $editMatriculas->porcentaje = $porcentaje;
                //actualizar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $editMatriculas->save();
            }
        }

        $porcentaje = ($matricula * 100) / $totalMatriculas;

        $matriculaEdit = tb_matricula::findOrFail($id);
        $matriculaEdit->matricula = $matricula;
        $matriculaEdit->porcentaje = $porcentaje;
        $matriculaEdit->periodo = $periodo;
        $matriculaEdit->year = $year;
        $matriculaEdit->save();


        return redirect()->route('usuario.matricula');
    }

    //Importar datos de excel a la tabla tb_matricula
    public function importarDataExcelMatriculas(Request $request) {
        $datosExcel = $request->input('datos');

        foreach ($datosExcel as $fila) {
            $matricula = new tb_matricula();
            $matricula->carrera = $fila['carrera'];
            $matricula->matricula = $fila['matricula'];
            $matricula->porcentaje = $fila['porcentaje'];
            $matricula->periodo = $fila['periodo'];
            $matricula->year = $fila['year'];
            $matricula->save();
        }

        return redirect()->route('usuario.matricula');
    }

    public function eliminarMatriculas(Request $request) {
        $id = $request->id;

        for($i = 0; $i < count($id); $i++){
            $matriculaSearch = tb_matricula::findOrFail($id[$i]);
            $matriculas = tb_matricula::where('periodo', $matriculaSearch->periodo)->where('year', $matriculaSearch->year)->whereNotIn('id', [$id[$i]])->get();

            

            $totalMatriculas = 0;
            foreach($matriculas as $matriculaSuma){
                $totalMatriculas += $matriculaSuma->matricula;
            }

            for($j = 0; $j < count($matriculas); $j++){
                $editMatriculas = tb_matricula::find($matriculas[$j]->id);
                //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $porcentajeGuardar = ($matriculas[$j]->matricula * 100) / $totalMatriculas;
                //sacar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $editMatriculas->porcentaje = $porcentajeGuardar;
                //actualizar el porcentaje de matriculas que se encuentran en la tabla tb_matricula
                $editMatriculas->save();
            }
        }

        $matricula = tb_matricula::whereIn('id', $id);
        $matricula->delete();

        return redirect()->route('usuario.matricula');
    }
}