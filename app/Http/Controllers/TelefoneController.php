<?php

namespace App\Http\Controllers;

use App\Telefone;
use App\Territorios;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Services\CriarTelefone;
use App\Http\Requests\CriarTelefoneFormRequest;

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
            $request->inputTel,
            $request->Radio
        );
        $request->session()
        ->flash(
            'mensagem',
            "Telefone {$telefone->telefone} adicionado com sucesso!"
        );
        return redirect()->route('form_listar_telefones', ['id' => $territorioId]);
    }
    
    public function edit(int $telefoneId)
    {
       $telefone = Telefone::find($telefoneId);
       $territorio = $telefone->territorio;

       return view ('telefones.update', [
        'titulo' => 'Editar Telefone',  
        'topico' => "$territorio->condominio",
        'telefone' => $telefone,
        'territorioId' => $territorio->id
       ]); 
    }

    public function update(CriarTelefoneFormRequest $request, int $id)
    {
        $telefone = Telefone::find($id);

        $telefone->unidade = $request->selectUnidade;
        $telefone->numero_unidade = $request->inputNumero;
        $telefone->telefone = $request->inputTel;
        $telefone->status = $request->Radio;
        $telefone->save();

        $request->session()
        ->flash(
            'mensagem',
            "Telefone id: {$id} atualizado com sucesso!"
        );
   
        return redirect()->route('form_listar_telefones', ['territorioId' => $telefone->territorios_id]);
  
    }



}
