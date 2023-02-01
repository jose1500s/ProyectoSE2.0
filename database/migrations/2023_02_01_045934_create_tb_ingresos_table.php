<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\tb_ingreso;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('carrera', 50);
            $table->integer('aspirantes'); // admite numeros de 0 a 2147483647
            $table->integer('examinados'); 
            $table->integer('admitidos');
            $table->integer('rechazados');
            $table->integer('inscritos');
            $table->integer('inscritos presentados');
            $table->string('Proceso');
            $table->string('fecha');
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
        Schema::dropIfExists('tb_ingresos');
    }
};
