<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstanqueDesobesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estanque_desobes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estanque')->unsigned();
            $table->integer('id_desobe')->unsigned();
            $table->date('fecha');
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_estanque')->references('id')->on('estanques');
            $table->foreign('id_desobe')->references('id')->on('desobes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estanque_desobes');
    }
}
