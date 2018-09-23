<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateespeciesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_comun', 100);
            $table->string('nombre_cientifico', 150);
            $table->string('familia', 150);
            $table->string('nombre_comun_en', 100);
            $table->string('descripcion_es', 550);
            $table->string('descripcion_en', 550);
            $table->string('imagen_url', 550);
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
        Schema::drop('especies');
    }
}
