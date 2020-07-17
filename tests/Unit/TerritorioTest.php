<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CriadorTerritorio;
use App\Territorios;

//use DateTime;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;

class TerritorioTest extends TestCase
{

    public function testCriarTerritorio() 
    {
        // DADOS TERRITORIO
        $condominio = 'Edifício Teste';
        $endereco = 'R. Laravel, 750';
        $revisao = '2020-07-15';

        $criadorTerritorio = new CriadorTerritorio;
        $territorio = $criadorTerritorio->criarTerritorio (
            $condominio, $endereco, $revisao
        );

        $this->assertInstanceOf(Territorios::class, $territorio);
        $this->assertDatabaseHas('territorios', ['condominio'=> $condominio]);
        $this->assertDatabaseHas('territorios', ['id' => $territorio->id]);
    }


}
