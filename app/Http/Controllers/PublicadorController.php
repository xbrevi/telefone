<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Publicador;
use App\Services\CriadorPublicador;

class PublicadorController extends Controller
{
    // AUTENTICAÇÃO
    public function __construct() {
        $this->middleware('auth');
    }

    // INDEX    
    public function index(Request $request) : View {
        $publicadores = Publicador::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');

        return view ('publicadores.index', [
            'topico' => 'Publicadores',
            'publicadores' => $publicadores,
            'mensagem' => $mensagem
        ]); 
    }

    // STORE - GRAVA PUBLICADOR
    public function store(Request $request) {

        $criadorPublicador = new CriadorPublicador;

        $publicador = $criadorPublicador->criarPublicador (
            $request->inputNome
        );

        $request->session()
        ->flash(
            'mensagem',
            "Publicador: {$publicador->nome} incluído com sucesso!"
        );
        
        return redirect()->route('form_index_publicadores');
    }

    // EDITAR NOME RECEBE VIA FETCH JAVASCRIPT DE 
    public function edit(int $publicador, Request $request) {
        $novoNome = $request->nome;
        $publicador = Publicador::find($publicador);
        $publicador->nome = $novoNome;
        $publicador->save();
    }

}






