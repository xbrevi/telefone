<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaOcorrencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function(Blueprint $table) {
            $table->increments('id')->required();
            $table->date('data')->required();

            $table->integer('publicador')->unsigned()->required();
            $table->integer('telefone')->unsigned()->required();

            $table->string('observacao')->nullable();;
            $table->foreign('publicador')->references('id')->on('publicadores');
            $table->foreign('telefone')->references('id')->on('telefones');
            $table->unique(['data', 'telefone']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('ocorrencias');
    }
}
