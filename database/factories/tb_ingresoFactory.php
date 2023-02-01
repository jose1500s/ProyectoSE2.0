<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tb_ingreso>
 */
class tb_ingresoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
             // carrera  que sean cualquiera de estas: 'Automotriz', 'Manufactura', 'Mecatrónica', 'Negocios', 'Administracion, 'Redes', 'Sistemas'
             'carrera' => $this->faker->randomElement(['Automotriz', 'Manufactura', 'Mecatrónica', 'Negocios', 'Administracion', 'Redes', 'Sistemas']),
             'aspirantes' => $this->faker->numberBetween(0, 300),
             'examinados' => $this->faker->numberBetween(0, 260),
             'admitidos' => $this->faker->numberBetween(0, 200,),
             'rechazados' => $this->faker->numberBetween(0, 60),
             'inscritos' => $this->faker->numberBetween(0, 190),
             // proceso opciones: '1er proceso', '2do proceso', '3er proceso'
            'proceso' => $this->faker->randomElement(['1erProceso', '2doProceso', '3erProceso']),
            // fechas opciones de 'SEP-DIC 2013', 'SEP-DIC 2014', 'SEP-DIC 2015', 'SEP-DIC 2016', 'SEP-DIC 2017', 'SEP-DIC 2018', 'SEP-DIC 2019', 'SEP-DIC 2020', 'SEP-DIC 2021', 'SEP-DIC 2022'
            'fecha' => $this->faker->randomElement(['SEP-DIC 2013', 'SEP-DIC 2014', 'SEP-DIC 2015', 'SEP-DIC 2016', 'SEP-DIC 2017', 'SEP-DIC 2018', 'SEP-DIC 2019', 'SEP-DIC 2020', 'SEP-DIC 2021', 'SEP-DIC 2022']),
        ];
    }
}
