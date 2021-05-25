<?php

namespace App\Services;

use App\Models\{Episode, Season, Serie};
use Illuminate\Support\Facades\DB;

class SerieRemover
{
    public function removeSerie(int $serieId): string
    {
        $serieName = "";

        DB::transaction(function() use ($serieId, &$serieName) {
            $serie = Serie::find($serieId);
            $serieName = SerieRemover::removeSeasonsBySerie($serie);
        });

        return $serieName;
    }

    private static function removeSeasonsBySerie(Serie $serie): string
    {
        $serie->seasons->each(function(Season $season) {
            SerieRemover::removeEpisodesBySeason($season);
            $season->delete();
        });

        $serieName = $serie->name;
        $serie->delete();

        return $serieName;
    }

    private static function removeEpisodesBySeason(Season $season): void
    {
        $season->episodes->each(function(Episode $episode) {
            $episode->delete();
        });
    }
}
