<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class tansporteLugaresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ruta' => $this->faker->randomElement(['Loma-Av. De La Luz','Biblioteca Gómez Morin','Constituyentes','Bernardo Quintana','Pie De La Cuesta','Libramiento Sur Poniente']),
            'cuatrimestre' => $this->faker->randomElement([ 'SEP-DIC 2014', 'SEP-DIC 2015', 'SEP-DIC 2016', 'SEP-DIC 2017', 'SEP-DIC 2018', 'SEP-DIC 2019', 'SEP-DIC 2020', 'SEP-DIC 2021', 'SEP-DIC 2022']),
            'turno'=> $this->faker->randomElement(['Matutino','Vespertino']),
            'lugares_disp'=>$this->faker->numberBetween(0,800),
            'pagados'=>$this->faker->numberBetween(500,750),
        ];
    }
}
