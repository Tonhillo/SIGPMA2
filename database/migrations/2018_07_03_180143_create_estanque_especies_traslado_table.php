<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstanqueEspeciesTrasladoTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estanque_especies_traslado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_especie')->unsigned();
            $table->integer('id_estanque_origen')->unsigned();
            $table->integer('id_estanque_destino')->unsigned();
            $table->string('motivo');
            $table->integer('cantidad');
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_especie')->references('id')->on('especies');
            $table->foreign('id_estanque_origen')->references('id')->on('estanques');
            $table->foreign('id_estanque_destino')->references('id')->on('estanques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estanque_especies_traslado');
    }
}
