<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class tansporteSolicitudesSeleccionadosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'solicitudes' => $this->faker->numberBetween(100,200),
            'seleccionados' => $this->faker->numberBetween(0,50),
            'carrera' => $this->faker->randomElement(['Automotriz', 'Manufactura', 'Mecatrónica', 'Negocios', 'Administración', 'Redes', 'Sistemas']),
            'ruta' => $this->faker->randomElement(['Loma-Av. De La Luz','Biblioteca Gómez Morin','Constituyentes','Bernardo Quintana','Pie De La Cuesta','Libramiento Sur Poniente']),
            'cuatrimestre' => $this->faker->randomElement([ 'SEP-DIC 2014', 'SEP-DIC 2015', 'SEP-DIC 2016', 'SEP-DIC 2017', 'SEP-DIC 2018', 'SEP-DIC 2019', 'SEP-DIC 2020', 'SEP-DIC 2021', 'SEP-DIC 2022']),
            'turno'=> $this->faker->randomElement(['Matutino','Vespertino']),
        ];
    }
}
