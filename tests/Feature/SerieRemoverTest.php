<?php

namespace Tests\Feature;

use App\Services\SerieCreator;
use App\Services\SerieRemover;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SerieRemoverTest extends TestCase
{
    use RefreshDatabase;

    private $serie;

    protected function setUp(): void
    {
        parent::setUp();

        $serieCreator = new SerieCreator();

        $this->serie = $serieCreator->createSerie('serie a', 3, 4);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRemoveSerie()
    {
        $serieRemover = new SerieRemover();

        $this->assertDatabaseHas('serie', ['id' => $this->serie->id]);
        
        $serieName = $serieRemover->removeSerie($this->serie->id);

        $this->assertIsString($serieName);
        $this->assertEquals('serie a', $this->serie->name);
        $this->assertDatabaseMissing('serie', ['id' => $this->serie->id]);
    }
}
