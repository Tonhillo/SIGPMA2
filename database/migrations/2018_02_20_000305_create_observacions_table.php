<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateobservacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estanque')->unsigned();
            $table->string('descripcion', 550);
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::drop('observacions');
    }
}
