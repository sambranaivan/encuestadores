<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('individual_id');
            $table->foreign('individual_id')->references('id')->on('individuals');
            //

                $table->string('sexo');
                $table->integer('edad');
                //
                $table->string('laboral')->nullable();//trabaja - no trabaja - no busca
                // $table->boolean('busca')->nullable();//trabaja - no trabaja - no busca
                //
                $table->integer('ingreso_laboral')->nullable();
                $table->integer('ingreso_no_laboral')->nullable();
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
        Schema::dropIfExists('historicos');
    }
}
