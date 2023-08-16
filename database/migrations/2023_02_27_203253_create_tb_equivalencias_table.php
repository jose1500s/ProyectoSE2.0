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
        Schema::create('tb_equivalencias', function (Blueprint $table) {
            $table->id();
            $table->string('carrera', 50);
            $table->integer('aspirantes');
            $table->integer('examinados');
            $table->integer('hombres');
            $table->integer('mujeres');
            $table->integer('admitidos');
            $table->integer('no_admitidos');
            $table->string('periodo', 50);
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
        Schema::dropIfExists('tb_equivalencias');
    }
};
