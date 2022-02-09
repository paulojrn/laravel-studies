<?php

namespace App\Services;

use App\Events\SerieApagadaEvent;
use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SerieService
{
    public static function createSerie(?Request $request): ?Serie
    {
        $serie = null;
        $data = [];
        $data["nome"] = $request->nome;
        
        if ($request->hasFile("capa")) {
            $path = $request->file("capa")->store("public/serie");
            
            $data["capa"] = last(explode("/", $path));
        }

        DB::beginTransaction();

        try {
            $serie = Serie::create($data);

            $qntTemporadas = $request->qnt_temporadas;
            $qntEpPorTemporada = $request->ep_por_temporada;
            
            for ($i = 1; $i <= $qntTemporadas; $i++) { 
                $temporada = $serie->temporadas()->create(["numero" => $i]);

                for ($j = 1; $j <= $qntEpPorTemporada; $j++) {
                    $episodio = $temporada->episodios()->create(["numero" => $j]);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        
        return $serie;
    }

    public static function createSerie2($nome, $qntTemporadas, $qntEpPorTemporada): ?Serie
    {
        $serie = null;
        DB::beginTransaction();

        try {
            $serie = Serie::create(["nome" => $nome]);
            
            for ($i = 1; $i <= $qntTemporadas; $i++) { 
                $temporada = $serie->temporadas()->create(["numero" => $i]);

                for ($j = 1; $j <= $qntEpPorTemporada; $j++) {
                    $episodio = $temporada->episodios()->create(["numero" => $j]);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        
        return $serie;
    }

    public static function destroySerie(int $id)
    {
        DB::beginTransaction();

        try {
            $serie = Serie::find($id);
            $serie->temporadas()->each(function (Temporada $temporada) {
                $temporada->episodios()->each(function (Episodio $episodio) {
                    $episodio->delete();
                });

                $temporada->delete();
            });

            $serie->delete();

            $evento = new SerieApagadaEvent($serie);
            event($evento);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        
    }
}
