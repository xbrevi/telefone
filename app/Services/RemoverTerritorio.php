<?php

namespace App\Services;

use App\Territorios;
use App\Telefone;
use Illuminate\Support\Facades\DB;

class RemoverTerritorio 
{
    public function removerTerritorio (int $territorioId) {

        $condominio = '';
        DB::transaction( function () use ($territorioId, &$condominio) {
            $territorio = Territorios::find($territorioId);
            $condominio = $territorio->condominio;
            $this->removerTelefone($territorio);
            $territorio->delete();
        }); 

        return $condominio;
    }

    public function removerTelefone(Territorios $territorio) : void
    {
        $territorio->telefones->each(function(Telefone $telefone) {
            $telefone->delete();
         });
         
    }

}