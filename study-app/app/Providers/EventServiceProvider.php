<?php

namespace App\Providers;

use App\Events\NovaSerieEvent;
use App\Events\SerieApagadaEvent;
use App\Listeners\EnviarEmailNovaSerieListener;
use App\Listeners\ExcluirCapaSerieListener;
use App\Listeners\LogNovaSerieListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NovaSerieEvent::class => [
            EnviarEmailNovaSerieListener::class,
            LogNovaSerieListener::class
        ],
        SerieApagadaEvent::class => [
            ExcluirCapaSerieListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
