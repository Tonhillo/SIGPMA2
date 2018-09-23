<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateestanquesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estanques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_estanque');
            $table->integer('id_recinto')->unsigned();
            $table->integer('volumen');
            $table->string('tipo_agua');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_recinto')->references('id')->on('recintos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estanques');
    }
}
