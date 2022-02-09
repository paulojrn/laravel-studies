<?php

namespace App\Listeners;

use App\Events\SerieApagadaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class ExcluirCapaSerieListener implements ShouldQueue
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
     * @param  \App\Events\SerieApagadaEvent  $event
     * @return void
     */
    public function handle(SerieApagadaEvent $event)
    {
        $serie = $event->serie;
        
        if ($serie->capa) {
            Storage::disk("public")->delete("serie/".$serie->capa);
        }
    }
}
