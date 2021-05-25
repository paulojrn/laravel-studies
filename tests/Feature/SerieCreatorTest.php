<?php

namespace Tests\Feature;

use App\Models\Episode;
use App\Models\Serie;
use App\Services\SerieCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SerieCreatorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSerie()
    {
        $serieCreator = new SerieCreator();

        $serieName = 'serie 1';
        $qttSerieSeasons = 2;
        $qttSerieEpisodes = 3;
        $qttTotalSerieEpisodes = $qttSerieSeasons * $qttSerieEpisodes;

        $serie = $serieCreator->createSerie($serieName, $qttSerieSeasons, $qttSerieEpisodes);

        $this->assertInstanceOf(Serie::class, $serie);
        $this->assertDatabaseHas('serie', ['name' => $serieName]);
        $this->assertDatabaseHas('seasons', ['serie_id' => $serie->id, 'number' => $qttSerieSeasons]);
        $this->assertDatabaseHas('episodes', ['number' => $qttSerieEpisodes]);
        $this->assertCount($qttTotalSerieEpisodes, Episode::all());
    }
}
