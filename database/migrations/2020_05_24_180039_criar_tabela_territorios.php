<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

class CriarTabelaTerritorios extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('territorios', function(Blueprint $table) {
            $table->increments('id')->unique();
            $table->date('revisao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('condominio');
            $table->string('endereco');
            $table->integer('total_apartamentos')->default(0);
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::drop('lista');
    }
}
