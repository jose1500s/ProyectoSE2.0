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
        //
        Schema::create('tb_transportes', function (Blueprint $table) {
            $table->id();
            $table->integer('no_solicitudes');
            $table->integer('no_seleccionados');
            $table->string('carrera', 50);
            $table->string('ruta',50);
            $table->string('cuatrimestre', 50);
            $table->string('turno', 20);
            $table->integer('lugares_disponibles');
            $table->integer('pagados');
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
        //
    }
};
