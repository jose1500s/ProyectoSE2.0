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
        Schema::create('tb_transporte_lugares', function (Blueprint $table) {
            $table->id();
            $table->string('ruta',50);
            $table->string('cuatrimestre',50);
            $table->string('turno',50);
            $table->integer('lugares_disp');
            $table->integer('pagados');
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
        Schema::dropIfExists('tb_transporte_lugares');
    }
};
