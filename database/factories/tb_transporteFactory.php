<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tb_ingreso>
 */
class tb_transporteFactory extends Factory
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
             'no_solicitudes' => $this->faker->numberBetween(0,500),
             'no_seleccionados' => $this->faker->numberBetween(0, 300),
             'carrera' => $this->faker->randomElement(['Automotriz', 'Manufactura', 'Mecatrónica', 'Negocios', 'Administración', 'Redes', 'Sistemas']),
             'ruta' => $this->faker->randomElement(['Loma-Av. De La Luz','Biblioteca Gómez Morin','Constituyentes','Bernardo Quintana','Pie De La Cuesta','Libramiento Sur Poniente']),
             'cuatrimestre' => $this->faker->randomElement([ 'SEP-DIC 2014', 'SEP-DIC 2015', 'SEP-DIC 2016', 'SEP-DIC 2017', 'SEP-DIC 2018', 'SEP-DIC 2019', 'SEP-DIC 2020', 'SEP-DIC 2021', 'SEP-DIC 2022']),
             'turno'=> $this->faker->randomElement(['Matutino','Vespertino']),
             'lugares_disponibles' => $this->faker->numberBetween(100, 110),
             'pagados' => $this->faker->numberBetween(0, 110),
             // proceso opciones: '1er proceso', '2do proceso', '3er proceso'
             'total'=> $this->faker->numberBetween(0,800),
            // fechas opciones de 'SEP-DIC 2013', 'SEP-DIC 2014', 'SEP-DIC 2015', 'SEP-DIC 2016', 'SEP-DIC 2017', 'SEP-DIC 2018', 'SEP-DIC 2019', 'SEP-DIC 2020', 'SEP-DIC 2021', 'SEP-DIC 2022'
            
        ];
    }
}