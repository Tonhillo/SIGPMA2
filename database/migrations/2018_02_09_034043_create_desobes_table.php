<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatedesobesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desobes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_huevos_total');
            $table->integer('num_huevos_no_viables');
            $table->integer('num_huevos_viables');
            $table->decimal('porcentaje_viabilidad');
            $table->decimal('diametro_huevo');
            $table->decimal('diametro_gota');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('id_estanque')->unsigned();
            $table->foreign('id_estanque')->references('id')->on('estanques');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('desobes');
    }
}
