<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateoxigenosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oxigenos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estanque')->unsigned();
            $table->decimal('valor');
            $table->date('fecha');
            $table->time('hora');
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
        Schema::drop('oxigenos');
    }
}
