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
        Schema::create('tb_cambio_carreras', function (Blueprint $table) {
            $table->id();
            $table->string('periodo');
            $table->integer('year');
            $table->string('nombre');
            $table->string('matricula');
            $table->string('carrera_actual');
            $table->string('carrera_nueva');
            $table->string('dictamen');
            $table->string('grupo');
            $table->string('carga_kardex');
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
        Schema::dropIfExists('tb_cambio_carreras');
    }
};
