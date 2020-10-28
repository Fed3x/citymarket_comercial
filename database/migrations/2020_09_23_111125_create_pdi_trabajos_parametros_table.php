<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdiTrabajosParametrosTable extends Migration
{

    public function up()
    {
        Schema::create('pdi_trabajos_parametros', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('id_trabajo')->unsigned();
            $table->foreign('id_trabajo')->references('id')->on('pdi_trabajos');
            $table->bigInteger('id_parametro')->unsigned();
            $table->foreign('id_parametro')->references('id')->on('pdi_parametros');

            $table->string('created_by');
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pdi_trabajos_parametros');
    }
}
