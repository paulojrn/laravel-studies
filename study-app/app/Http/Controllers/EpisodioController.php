<?php

namespace App\Http\Controllers;

use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodioController extends Controller
{
    public function index(int $id, Request $request)
    {
        $episodios = Temporada::find($id)->episodios;

        return view("episodio.index", [
            "episodios" => $episodios,
            "idTemporada" => $id,
            "mensagem" => $request->session()->get("mensagem")
        ]);
    }

    public function assistir($id, $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada = Temporada::find($id);
        $episodios = $temporada->episodios;

        $episodios->each(function ($episodio) use ($episodiosAssistidos) {
            $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
        });

        $temporada->push();

        $request->session()
            ->flash("mensagem", "Episódios marcados como assistidos");

        return redirect()->back();
    }
}
