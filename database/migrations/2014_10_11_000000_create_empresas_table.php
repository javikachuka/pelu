<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            //el nombre del enlace de la empresa debe ser unico por ejemplo wwww.Pelu.com/SLUG
            $table->string('slug')->unique();
            $table->string('email');
            $table->string('telefono');
            //cantidad de personas que puede atender el local a la vez
            $table->integer('cantidadPersonas');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
