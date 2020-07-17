<?php

namespace App\Services;

use App\Territorios;
use DateTime;

class CriadorTerritorio
{

    public function criarTerritorio(
        String $condominio,
        String $endereco,
        String $data_revisao) : Territorios
    {
        $territorio = Territorios::create([
            'condominio' => $condominio,
            'endereco' => $endereco,
            'revisao' => $data_revisao,
            'total_apartamentos' => 0
        ]);

        return $territorio;
    }



}