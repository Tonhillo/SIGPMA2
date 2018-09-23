<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstanqueAlimentacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estanque_alimentacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estanque')->unsigned();
            $table->integer('id_alimento')->unsigned();
            $table->date('fecha_alimentacion');
            $table->time('hora_alimentacion');
            $table->decimal('peso');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_estanque')->references('id')->on('estanques');
            $table->foreign('id_alimento')->references('id')->on('alimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estanque_alimentacions');
    }
}
