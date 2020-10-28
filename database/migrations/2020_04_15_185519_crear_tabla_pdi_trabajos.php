<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPdiTrabajos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdi_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 50);
            $table->string('area_trabajo', 50);
            $table->string('trabajo', 50);
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('pdi_trabajos');
    }
}
