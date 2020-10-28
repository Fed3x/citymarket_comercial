<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPdiTrabajosEjecutados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdi_trabajos_ejecutados', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_trabajo');
            $table->foreign('id_trabajo')->references('id')->on('pdi_trabajos');
            
            $table->string('serial', 32)->unique();
            $table->boolean('confirmed')->default(false);
            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('pdi_trabajos_ejecutados');
    }
}
