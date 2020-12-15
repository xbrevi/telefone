<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TerritoriosFormRequest;
use App\Services\CriadorTerritorio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Territorios;
use App\Telefone;
use App\Services\RemoverTerritorio;


class TerritoriosController extends Controller 
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function listarTerritorios(Request $request) : View {
        $territorios = Territorios::query()->orderBy('id') ->get();
        $mensagem = $request->session()->get('mensagem');

        return view ('index', [
            'topico' => 'Territórios Freguesia do Ó',
            'territorios' => $territorios,
            'mensagem' => $mensagem
        ]); 
    }

    public function create(Request $request)
    {
        return view('territorios.create', [
            'topico' => 'Cadastro de Territórios'
        ]);
    }

    public function store(TerritoriosFormRequest $request) {

        $criadorTerritorio = new CriadorTerritorio;

        $territorio = $criadorTerritorio->criarTerritorio (
            $request->condominio,
            $request->endereco,
            $request->data_revisao
        );

        $request->session()
        ->flash(
            'mensagem',
            "Território {$territorio->condominio} criado com sucesso!"
        );

        //return redirect()->route('$telefone->telefone', ['territorioId' => $territorioId]);
        return redirect()->route('form_listar_territorios');

    }

    public function destroy(Request $request, int $territorioId, RemoverTerritorio $removedorTerritorio)
    {
      $nomeCondominio = $removedorTerritorio->removerTerritorio($territorioId);
 
      $request->session()
      ->flash(
          'mensagem',
          "Território {$nomeCondominio} excluído com sucesso!"
      );

      return redirect()->route('form_listar_territorios');
    }

    public function edit(int $id)
    {
        $territorio = Territorios::find($id);

        return view ('territorios.update', [
            'topico' => "Território: $territorio->condominio",
            'territorio' => $territorio
        ]); 
    }

    public function update(TerritoriosFormRequest $request, int $id)
    {
        $territorio = Territorios::find($id);

        $territorio->condominio = $request->condominio;
        $territorio->endereco = $request->endereco;
        $territorio->revisao = $request->data_revisao;
        $total = $territorio->telefones->where('status', 1)->count();
        $territorio->total_apartamentos = $total;
        $territorio->save();         

        $request->session()
        ->flash(
            'mensagem',
            "Território {$request->condominio} atualizado com sucesso!"
        );
   
        return redirect()->route('form_listar_territorios');
    }

    public function print(int $id)
    {
        $territorio = Territorios::find($id);

//        $telefones = $territorio->telefones->where('status', 1);

        $telefones = Telefone::where('territorios_id', $territorio->id)
        ->where('status', 1)
        ->orderByRaw('CAST(numero_unidade as UNSIGNED) ASC')
        ->get();

        return view ('territorios.print', [
            'territorio' => $territorio,
            'telefones' => $telefones
        ]); 
    }


    
}