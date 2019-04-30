<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas');

              $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');


            $table->string("descripcion")->nullable();

            $table->unsignedBigInteger("desde")->nullable();
            $table->foreign('desde')->references('id')->on('users');

            $table->unsignedBigInteger("hacia")->nullable();
            $table->foreign('hacia')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pases');
    }
}
