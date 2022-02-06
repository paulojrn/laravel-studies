<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Services\SerieService;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SerieTest extends TestCase
{
    use RefreshDatabase;

    private $creator;

    public function setUp(): void
    {
        $this->creator = new SerieService();
        parent::setUp();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_criar_serie()
    {
        $nomeSerie = "Nome teste";

        
        $serie = $this->creator->createSerie2($nomeSerie, 1, 1);

        $this->assertInstanceOf(Serie::class, $serie);
        // $this->assertDatabaseHas("serie", ["nome" => $nomeSerie]);
        // $this->assertDatabaseHas("temporadas", [
        //     "serie_id" => $serie->id,
        //     "numero" => 1
        // ]);
        // $this->assertDatabaseHas("episodios", ["numero" => 1]);
    }

    public function test_remover_serie()
    {
        $nomeSerie = "test";
        $serie = $this->creator->createSerie2($nomeSerie, 1, 1);
        $id = $serie->id;

        // $this->assertDatabaseHas("serie", ["id" => $id]);
        $nome = $this->creator->destroySerie($serie->id);

        $this->assertIsString($nome);
        $this->assertEquals($nomeSerie, $nome);
        // $this-> assertDatabaseMissing("serie", ["id" => $id]);
    }
}
