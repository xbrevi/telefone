<?php

namespace App\Services;

use App\Publicador;

class CriadorPublicador {

    public function criarPublicador(string $nome) {
        
        $publicador = Publicador::create([
            'nome' => $nome
        ]);

        return $publicador;
    }
}
