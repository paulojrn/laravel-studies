<?php

namespace Tests\Unit;

use App\Models\Episodio;
use App\Models\Temporada;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    
    private $temporada;

    protected function setUp(): void
    {
        $temporada = new Temporada();

        $episodio1 = new Episodio();
        $episodio1->numero = 1;
        $episodio1->assistido = true;
        $episodio2 = new Episodio();
        $episodio1->numero = 2;
        $episodio2->assistido = false;
        $episodio1->numero = 3;
        $episodio3 = new Episodio();
        $episodio3->assistido = true;

        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;

        parent::setUp();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_busca_episodios_assistidos()
    {
        $epAssistidos = $this->temporada->getEpisodiosAssistidos();
        
        $this->assertCount(2, $epAssistidos);

        foreach ($epAssistidos as $episodio) {
            $this->assertTrue($episodio->assistido);
        }
    }

    public function test_busca_todos_episodios()
    {
        $episodios = $this->temporada->episodios;

        $this->assertCount(3, $episodios);
    }
}
