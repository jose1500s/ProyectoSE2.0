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
        Schema::create('tb_titulados_totales', function (Blueprint $table) {
            $table->id();
            $table->integer('generacion');
            $table->integer('hombres');
            $table->integer('mujeres');
            $table->integer('total');
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
        Schema::dropIfExists('tb_titulados_totales');
    }
};
