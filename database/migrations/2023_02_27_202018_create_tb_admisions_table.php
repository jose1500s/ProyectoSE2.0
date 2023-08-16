<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\tb_admision;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_admisions', function (Blueprint $table) {
            $table->id();
            $table->string('carrera', 50);
            $table->integer('aspirantes');
            $table->integer('examinados');
            $table->integer('admitidos');
            $table->integer('hombres');
            $table->integer('mujeres');
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
        Schema::dropIfExists('tb_admisions');
    }
};
