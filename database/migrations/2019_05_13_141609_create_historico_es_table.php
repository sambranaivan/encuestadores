<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_es', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('encuesta_id');
            $table->foreign('encuesta_id')->references('id')->on('encuestas');
            //

            $table->integer('listado');
            $table->integer('cantidad')->nullable();
            $table->integer('vivienda')->default(0);
            //
            $table->boolean('efectivo');//efectiva - no efectiva
            // $table->boolean('montos_completos');// estan los montos completos? si no estan completos no se cargan
            //
            $table->string('tipo_no_efectiva')->nullable();///si es no efectiva decir el tipo
            $table->string('detalle_no_efectiva')->nullable();//el detalle de la no efectiva

            $table->string('estado');// ingresada - en espera

            $table->mediumText('comentarios')->nullable();
            $table->integer('revision')->default(0);// revision
            $table->integer('hogar')->default(1);
            $table->string('otros_motivos')->nullable();
            $table->string('supersuper')->nullable();
            $table->string('comentario_supervisor')->nullable();
            $table->string('comentario_admin')->nullable();
            $table->string('revisado')->nullable();
            $table->string('listo')->nullable();
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
        Schema::dropIfExists('historico_es');
    }
}
