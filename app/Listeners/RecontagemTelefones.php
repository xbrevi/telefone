<?php

namespace App\Listeners;

use App\Events\NovoTelefone;
use App\Territorios;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecontagemTelefones implements ShouldQueue
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
        $total = $territorio->telefones->where('status', 1)->count();
        $territorio->total_apartamentos = $total;
        $territorio->save();         
    }
}




