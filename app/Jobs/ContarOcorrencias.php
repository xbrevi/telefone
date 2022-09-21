<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use App\Territorios;
use App\Telefone;
use App\Ocorrencia;

class ContarOcorrencias implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $territorio_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($territorio_id)
    {
        $this->territorio_id = $territorio_id;    
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // RECUPERA IDS DE TELEFONES DESTE TERRITORIO
        $telefones = DB::table('telefones')->where('territorios_id', $this->territorio_id)->get('id');

        // CONTA OCORRENCIAS DO TELEFONE, SE MAIOR QUE 2, INATIVA
        foreach($telefones as $telefone) {
            $contagem_ocorrencias = DB::table('ocorrencias')->where('telefone', $telefone->id)->count();
            if($contagem_ocorrencias > 2) { 
                $registro = Telefone::find($telefone->id);
                $registro->status = 0;
                $registro->save();
            }
        }

    }
}



