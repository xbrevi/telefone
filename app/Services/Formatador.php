<?php

namespace App\Services;

class Formatador 
{
    public static function formataTelefone(string $telefone) : string {
        $sizeTel = strlen($telefone);

        if($sizeTel == 8) {
            $telefone = substr($telefone , 0, 4) . '.' .
            substr ($telefone , 4, 4);
        }
        if($sizeTel == 9) {
            $telefone = substr($telefone , 0, 1) . '.' .
            substr($telefone , 1, 4) . '.' .
            substr($telefone , 4, 4);
        }
        return $telefone;
    }

}
