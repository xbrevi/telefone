<?php

namespace App\Services;

use App\Telefone;

class CriarTelefone {

    public function criarTel(
        int $territorioId,
        string $unidade,
        string $numeroUnidade,
        string $numeroTelefone,
        string $situacao) : Telefone
    {
        $telefone = Telefone::create([
            'territorios_id' => $territorioId,
            'unidade' => $unidade,
            'numero_unidade' => $numeroUnidade,
            'telefone' => $numeroTelefone,
            'status' => boolval($situacao),
        ]);
        return $telefone;
    }
}

