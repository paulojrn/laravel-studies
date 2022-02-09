<?php

namespace App\Listeners;

use App\Events\NovaSerieEvent;
use App\Mail\NovaSerie;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerieListener
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
     * @param  \App\Events\NovaSerieEvent  $event
     * @return void
     */
    public function handle(NovaSerieEvent $event)
    {
        // $user = $request->user();
        $users = User::all();

        foreach ($users as $index => $user) {
            $mult = $index + 1;
            $email = new NovaSerie(
                $event->nomeSerie,
                $event->qtdTemporadas,
                $event->qtdEpisodios
            );

            $email->subject = "Nova série adicionada!";

            //send, queue, later
            // $when = now()->addSecond($mult * 5);
            // Mail::to($user)->later($when, $email);
            
            // Mail::to($user)->send($email);
        }
    }
}
