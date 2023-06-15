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
        Schema::create('tb_bajas_totales_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('periodo');
            $table->integer('año');
            $table->string('periodo_con_año');
            $table->string('tipo_baja');
            $table->integer('hombres');
            $table->integer('mujeres');
            $table->integer('total');
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
        Schema::dropIfExists('tb_bajas_totales_tipos');
    }
};
