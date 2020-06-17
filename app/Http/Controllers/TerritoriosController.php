<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TerritoriosFormRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Territorios;
use App\Services\RemoverTerritorio;

class TerritoriosController extends Controller 
{

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
        $territorio = new Territorios();
        $territorio->condominio = $request->condominio;
        $territorio->endereco = $request->endereco;
        $territorio->revisao = $request->data_revisao;
        $territorio->save();

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
        $territorio->save();         

        $request->session()
        ->flash(
            'mensagem',
            "Território {$request->condominio} atualizado com sucesso!"
        );
   
        return redirect()->route('form_listar_territorios');
   
    }

    
}