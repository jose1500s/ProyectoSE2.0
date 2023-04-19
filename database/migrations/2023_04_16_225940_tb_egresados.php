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
        Schema::create('tb_egresados', function (Blueprint $table) {
            $table->id();
            $table->string('carrera', 50);
            $table->string('generacion', 2);
            $table->integer('egresados');
            $table->string('año_egreso', 4);
            $table->string('cuatrimestre');
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
        Schema::dropIfExists('tb_egresados');
    }
};
