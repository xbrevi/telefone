<?php

namespace App\Providers;

use App\Events\NovoTelefone;
use App\Listeners\RecontagemTelefones;
use App\Listeners\AtualizaRevisaoTerritorio;
//use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        NovoTelefone::class => [
            RecontagemTelefones::class,
            AtualizaRevisaoTerritorio::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
