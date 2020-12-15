<?php

namespace App\Listeners;

use App\Events\NovoTelefone;
use App\Territorios;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class AtualizaRevisaoTerritorio implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovoTelefone  $event
     * @return void
     */
    public function handle(NovoTelefone $event)
    {
        $territorio = Territorios::find($event->territorioId);
        $territorio->revisao = Carbon::now();
        $territorio->save();         
    }
}
