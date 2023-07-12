<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_egresados_totales', function (Blueprint $table) {
            $table->id();
            $table->string('carrera');
            $table->integer('hombres');
            $table->integer('mujeres');
            $table->integer('egresados');
            $table->integer('titulados');
            $table->integer('no_titulados');
            $table->string('periodo');
            $table->integer('año');
            $table->string('periodo_con_año');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_egresados_totales');
    }
};
