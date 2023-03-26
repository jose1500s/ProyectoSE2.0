<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tb_transporte_solicitudes_seleccionados;

class tansporteSolicitudesSeleccionadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tb_transporte_solicitudes_seleccionados::factory()->count(50)->create();
    }
}
