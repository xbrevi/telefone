<?php

namespace App\Http\Controllers;

use App\Jobs\CadastrarOcorrencia;
use App\Jobs\CadastrarInativos;
use App\Jobs\ContarOcorrencias;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Territorios;
use App\Telefone;
use App\Publicador;
use App\Http\Requests\OcorrenciasRequest;
use DB;
use Illuminate\Support\Carbon;


class OcorrenciasController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    // INDEX - PAGINA PRINCIPAL DE CADASTRO
    public function index(Request $request, int $territorio_id) : View {
        $territorio = Territorios::find($territorio_id);
        $publicadores = Publicador::query()->orderBy('nome') ->get();

        $telefones = Telefone::where('territorios_id', $territorio_id)
        ->where('status', '1')
        ->orderByRaw('CAST(numero_unidade as UNSIGNED) ASC')
        ->paginate(30);

        $mensagem = $request->session()->get('mensagem');
        return view ('ocorrencias.index', [
            'topico' => 'Território ' . $territorio->id . ' ' . $territorio->condominio,
            'telefones' => $telefones,
            'mensagem' => $mensagem,
            'territorio_id' => $territorio_id,
            'publicadores' => $publicadores
        ]); 
    }

    public function store(OcorrenciasRequest $request) {

        // PERMITE VER TODOS OS CAMPOS RECEBIDOS DO FORMULARIO
        //$inputs = $request->all();
        //dd($inputs);

        // VAR PARA CONTROLAR MENSAGEM CASO NADA SEJA CADASTRADO
        $processamento = false;
        // VARIAVEIS FIXAS
        $territorio_id = $request->territorio_id;
        $publicador = $request->publicador;
        $data = $request->data;
        // ARRAY COM IDS DE TELEFONES MARCADOS COMO INATIVOS
        $inativos = $request->inativos;
        // ARRAY COM IDS DE TELEFONES QUE DEVEM TER UMA OCORRENCIA REGISTRADA
        $ocorrencias = $request->ocorrencias;
        // TODAS OS CAMPOS DE OBSERVACOES
        $observacoes = $request->observacoes;
        // MAPEAMENTO OBSERVAÇÕES VS IDS DE TELEFONES
        $obs_mapa = $request->obs_mapa;

        // OBTENDO A POSIÇÃO DA OBSERVAÇÃO PARA ESTE ID
        //$indice = array_search('170', $obs_mapa);
        // OBTENDO A OBSERVAÇÃO PARA O ID MARCADO
        //echo $observacoes[$indice];

        // INATIVOS - CRIA JOBS PARA CADASTRAR OCORRENCIAS CASO EXISTAM
        if(isset($inativos)) {
            $processamento = true;
            foreach($inativos as $id_telefone) {
                $indice = array_search($id_telefone, $obs_mapa);
                $observacao = $observacoes[$indice];
                CadastrarInativos::dispatch(
                    $data, 
                    $publicador, 
                    $id_telefone,           
                    $observacao
                );
            }
        }

        // OCORRENCIAS - CRIA JOBS PARA CADASTRAR OCORRENCIAS CASO EXISTAM
        if(isset($ocorrencias)) {
            $processamento = true;
            foreach($ocorrencias as $id_telefone) {
                $indice = array_search($id_telefone, $obs_mapa);
                $observacao = $observacoes[$indice];
                CadastrarOcorrencia::dispatch(
                    $data, 
                    $publicador, 
                    $id_telefone,           
                    $observacao
                );
            }
        }

        // CONTAGEM DE OCORRENCIAS - COLOCA EM FILA
        // SE UM TELEFONE DO TERRITORIO TEM AGORA 3 OU MAIS OCORRENCIAS
        // DEVE SER INATIVADO
        ContarOcorrencias::dispatch($territorio_id);

        // RECONTAGEM DE TELEFONES ATIVOS DO TERRITÓRIO E ATUALIZA DATA REVISÃO
        $territorio = Territorios::find($territorio_id);
        $territorio->revisao = Carbon::now();
        $total = $territorio->telefones->where('status', 1)->count();
        $territorio->total_apartamentos = $total;
        $territorio->save();

        // MENSAGEM SUCESSO
        if($processamento) {
            $request->session()
            ->flash(
                'mensagem',
                "Ocorrencias processadas com sucesso!"
            );
        }       

        // RETORNA TELA PRNCIPAL - LISTAGEM DE TERRITORIOS
        return redirect()->route('form_listar_territorios');
    }



}
