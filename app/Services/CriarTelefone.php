<?php

namespace App\Services;

use App\Events\NovoTelefone;
use App\Telefone;

class CriarTelefone {

    public function criarTel(
        int $territorioId,
        string $unidade,
        string $numeroUnidade,
        string $numeroTelefone,
        string $situacao) : Telefone
    {
        $numeroTelefone = Formatador::soNumeros($numeroTelefone);
        
        $telefone = Telefone::create([
            'territorios_id' => $territorioId,
            'unidade' => $unidade,
            'numero_unidade' => $numeroUnidade,
            'telefone' => $numeroTelefone,
            'status' => boolval($situacao),
        ]);

        $eventNovoTelefone = new NovoTelefone($telefone->territorios_id);
        event($eventNovoTelefone);

        return $telefone;
    }
}

