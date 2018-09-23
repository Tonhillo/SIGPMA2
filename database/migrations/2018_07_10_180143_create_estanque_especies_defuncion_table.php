<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstanqueEspeciesDefuncionTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estanque_especies_defuncion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_especie')->unsigned();
            $table->integer('id_estanque')->unsigned();
            $table->string('motivo');
            $table->integer('cantidad');
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_especie')->references('id')->on('especies');
            $table->foreign('id_estanque')->references('id')->on('estanques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estanque_especies_defuncion');
    }
}
