<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas');
            //
            $table->integer('listado');
            $table->integer('vivienda')->default(0);
            //
            $table->boolean('efectivo');//efectiva - no efectiva
            $table->boolean('montos_completos');// estan los montos completos? si no estan completos no se cargan
            //
            $table->string('tipo_no_efectiva')->nullable();///si es no efectiva decir el tipo
            $table->string('detalle_no_efectiva')->nullable();//el detalle de la no efectiva

            $table->string('estado');// ingresada - en espera

            $table->mediumText('comentarios')->nullable();
            $table->integer('revision')->default(0);// revision
            //
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
        Schema::dropIfExists('encuestas');
    }
}
