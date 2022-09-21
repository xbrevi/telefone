<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Telefone;
use App\Ocorrencia;

class CadastrarInativos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $publicador;
    public $data;
    public $id_telefone;
    public $observacao;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $publicador, $id_telefone, $observacao)
    {
        $this->data = $data;
        $this->publicador = $publicador;    
        $this->id_telefone = $id_telefone;
        $this->observacao = $observacao;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // GRAVA TELEFONE INATIVO
        $telefone = Telefone::find($this->id_telefone);
        $telefone->status = 0;
        $telefone->save();

        // CRIA JOB PARA CADASTRAR OCORRENCIA
        CadastrarOcorrencia::dispatch(
            $this->data, 
            $this->publicador, 
            $this->id_telefone,           
            $this->observacao
        );

    }
}
