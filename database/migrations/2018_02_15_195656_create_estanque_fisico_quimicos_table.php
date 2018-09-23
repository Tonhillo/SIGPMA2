<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstanqueFisicoQuimicosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estanque_fisico_quimicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estanque')->unsigned();
            $table->integer('id_fisicoQuimico')->unsigned();
            $table->date('fecha');
            $table->time('hora');
            $table->string('observacion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_estanque')->references('id')->on('estanques');
            $table->foreign('id_fisicoQuimico')->references('id')->on('fisico_quimicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estanque_fisico_quimicos');
    }
}
