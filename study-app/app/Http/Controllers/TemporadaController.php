<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Http\Request;

class TemporadaController extends Controller
{
    public function index($id)
    {
        $serie = Serie::find($id);
        $temporadas = $serie->temporadas;        

        return view(
            "temporada.index",
            compact("serie", "temporadas"));
    }
}
