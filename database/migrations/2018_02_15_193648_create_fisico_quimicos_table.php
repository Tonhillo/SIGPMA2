<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFisicoQuimicosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fisico_quimicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('temperatura')->nullable();
            $table->decimal('pH');
            $table->integer('nitritos');
            $table->decimal('nitratos');
            $table->integer('salinidad');
            $table->decimal('amonio');
            $table->decimal('oxigeno');
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
        Schema::drop('fisico_quimicos');
    }
}
