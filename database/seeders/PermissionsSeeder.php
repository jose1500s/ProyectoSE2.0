<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ["consultar_ingreso","registrar_ingreso","editar_ingreso","eliminar_ingreso"],
            ["consultar_bajas","registrar_bajas","editar_bajas","eliminar_bajas"],
            ["consultar_egresados","registrar_egresados","editar_egresados","eliminar_egresados"],
            ["consultar_titulados","registrar_titulados","editar_titulados","eliminar_titulados"],
            ["consultar_matricula","registrar_matricula","editar_matricula","eliminar_matricula"],
            ["consultar_becas","registrar_becas","editar_becas","eliminar_becas"],
            ["consultar_transporte","registrar_transporte","editar_transporte","eliminar_transporte"],
            ["consultar_equivalencias","registrar_equivalencias","editar_equivalencias","eliminar_equivalencias"],
            ["consultar_cambio_de_carrera","registrar_cambio_de_carrera","editar_cambio_de_carrera","eliminar_cambio_de_carrera"]
        ];

        for($i = 0; $i < count($data); $i++){
            for($j = 0; $j < count($data); $j++){
                Permission::create([
                    "name" => $data[$i][$j]
                ]);
            }
        }
    }
}