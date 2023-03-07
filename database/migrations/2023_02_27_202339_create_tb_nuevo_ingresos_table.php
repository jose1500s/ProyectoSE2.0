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
        Schema::create('tb_nuevo_ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('carrera', 50);
            $table->integer('total_ingresos');
            $table->enum('sexo', ['masculino', 'femenino']);
            $table->integer('generacion');
            $table->integer('admitidos');
            $table->integer('inscritos');
            $table->string('proceso', 50);
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
        Schema::dropIfExists('tb_nuevo_ingresos');
    }
};
