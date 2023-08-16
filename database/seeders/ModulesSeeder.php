<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modules;

class ModulesSeeder extends Seeder
{
    
    public function run()
    {
        $data = [
            ["Ingreso","Modulo de ingreso"],
            ["Bajas","Modulo de bajas"],
            ["Egresados","Modulo de egresados"],
            ["Titulados","Modulo de titulados"],
            ["Matricula","Modulo de matricula"],
            ["Becas","Modulo de becas"],
            ["Transporte","Modulo de transporte"],
            ["Equivalencias","Modulo de equivalencias"],
            ["Cambio de carrera","Modulo de cambio de carrera"]
        ];

        for($i = 0; $i < count($data); $i++){
            Modules::create([
                'name' => $data[$i][0],
                'description' => $data[$i][1]
            ]);
        }
    }
}