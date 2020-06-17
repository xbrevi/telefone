<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarTelefoneFormRequest;
use App\Telefone;
use App\Territorios;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Services\CriarTelefone;

class TelefoneController extends Controller {

    public function show(Request $request, int $territorio_id) : View {
        $territorio = Territorios::find($territorio_id);
        $telefones = $territorio->telefones;
        $mensagem = $request->session()->get('mensagem');
        return view ('telefones.index', [
            'topico' => 'Território ' . $territorio->id . ' ' . $territorio->condominio,
            'telefones' => $telefones,
            'mensagem' => $mensagem,
            'territorioId' => $territorio_id
        ]); 
    }

    public function create(int $territorioId) : View
    {

        $territorio = Territorios::find($territorioId);
        $condominio = 'Território ' . $territorio->condominio;

        return view('telefones.create', [
            'titulo' => 'Cadastro de Telefones',
            'topico' => $condominio,
            'territorioId' => $territorioId,
        ]);
    }

    public function store(CriarTelefoneFormRequest $request, int $territorioId, CriarTelefone $criarTelefone) {
        $telefone = $criarTelefone->criarTel(
            $territorioId,
            $request->selectUnidade,
            $request->inputNumero,
            $request->inputTel
        );
        $request->session()
        ->flash(
            'mensagem',
            "Telefone {$telefone->telefone} adicionado com sucesso!"
        );
        return redirect()->route('form_listar_telefones', ['id' => $territorioId]);
    }    

}
