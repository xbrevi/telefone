<?php

namespace Tests\Unit;

use App\Territorios;
use App\Services\RemoverTerritorio;
use Tests\TestCase;
use App\Services\CriadorTerritorio;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemoverTerritorioTest extends TestCase
{

    /** @var Territorios */
    private $territorio = Territorios::class;

    protected function setUp() : void
    {
        parent::setUp();

        // DADOS TERRITORIO
        $condominio = 'Edifício Excluído';
        $endereco = 'R. Laravel, 0';
        $revisao = '2020-06-10';

        $criadorTerritorio = new CriadorTerritorio;
        $this->territorio = $criadorTerritorio->criarTerritorio (
            $condominio, $endereco, $revisao
        );
    }

    public function testRemoverTerritorio()
    {
        $this->assertDatabaseHas('territorios', ['condominio' => 'Edifício Excluído']);

        $removedorTerritorio = new RemoverTerritorio; 
        $condominio = $removedorTerritorio->removerTerritorio($this->territorio->id);
        
        $this->assertIsString($condominio);
        $this->assertEquals('Edifício Excluído', $this->territorio->condominio);
        $this->assertDatabaseMissing('territorios', ['condominio' => $condominio]);

    }
}
