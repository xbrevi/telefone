<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefones', function (Blueprint $table) {
            $table->increments('id')->required()->unique();
            $table->unsignedInteger('territorios_id');
            $table->string('unidade', 16)->required();
            $table->string('numero_unidade', 60);
            $table->string('telefone', 14)->required()->unique();
            $table->boolean('status')->required();

            $table->foreign('territorios_id')->references('id')->on('territorios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefones');
    }
}
