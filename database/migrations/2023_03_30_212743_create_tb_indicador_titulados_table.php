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
            $table->string('Generacion', 50);
            $table->string('Carrera', 50);
            $table->integer('Total');
            $table->string('fecha_titulacion', 50);
            $table->boolean('cedula');
            $table->boolean('titulo_electronico');
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
