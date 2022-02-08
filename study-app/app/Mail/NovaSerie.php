<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovaSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $qtdTemporada;
    public $qtdEpisodios;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $qtdTemporada, $qtdEpisodios)
    {
        $this->nome = $nome;
        $this->qtdTemporada = $qtdTemporada;
        $this->qtdEpisodios = $qtdEpisodios;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.nova-serie');
    }
}
