<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObservacionEspeciesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacion_especies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_especie')->unsigned();
            $table->integer('id_observacion')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_especie')->references('id')->on('especies');
            $table->foreign('id_observacion')->references('id')->on('observacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('observacion_especies');
    }
}
