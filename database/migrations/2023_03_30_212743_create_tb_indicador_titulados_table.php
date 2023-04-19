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
        Schema::create('tb_indicador_titulados', function (Blueprint $table) {
            $table->id();
            $table->string('generacion', 50);
            $table->string('carrera', 50);
            $table->integer('total');
            $table->string('fecha_titulacion', 50);
            $table->integer('cedula');
            $table->integer('titulo_electronico');
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
        Schema::dropIfExists('tb_indicador_titulados');
    }
};
