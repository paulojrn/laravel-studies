<?php

namespace Tests\Feature;

use App\Models\{Season, Episode};
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Tests\TestCase;

class SeasonTest extends TestCase
{
    private $season;

    protected function setUp(): void
    {
        parent::setUp();

        $season = new Season();
        $episode1 = new Episode();
        $episode2 = new Episode();
        $episode3 = new Episode();

        $episode1->viewed = true;
        $episode2->viewed = false;
        $episode3->viewed = true;

        $season->episodes->add($episode1);
        $season->episodes->add($episode2);
        $season->episodes->add($episode3);

        $this->season = $season;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testViewedEpisodes()
    {

        $qttViewedEpisodes = 2;
        $viewedEpisodes = $this->season->viewedEpisodes();

        $this->assertCount($qttViewedEpisodes, $viewedEpisodes);
    }

    public function testEpisodes()
    {
        $qttEpisodes = 3;

        $this->assertCount($qttEpisodes, $this->season->episodes);
    }
}
