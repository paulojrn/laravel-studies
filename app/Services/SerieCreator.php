<?php

namespace App\Services;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class SerieCreator
{
    public function createSerie(string $name, int $seasons_qtt, int $episodes_qtt): ?Serie
    {
        $serie = null;

        try {
            DB::beginTransaction();
            $serie = Serie::create(['name' => $name]);
            SerieCreator::createSeasonsBySerie($serie, $seasons_qtt, $episodes_qtt);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return $serie;
    }

    private static function createSeasonsBySerie(Serie $serie, int $seasons_qtt, int $episodes_qtt): void
    {
        for ($i = 1; $i <= $seasons_qtt; $i++) {
            $season = $serie->seasons()->create(['number' => $i]);
            SerieCreator::createEpisodesBySeason($season, $episodes_qtt);
        }
    }

    private static function createEpisodesBySeason(Season $season, int $episodes_qtt): void
    {
        for ($j=1; $j <= $episodes_qtt; $j++) {
            $season->episodes()->create(['number' => $j]);
        }
    }
}
