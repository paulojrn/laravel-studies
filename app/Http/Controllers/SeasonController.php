<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index(int $serieId)
    {
        $serie = Serie::find($serieId);
        $seasons = $serie->seasons;

        return view('seasons.index', compact('serie', 'seasons'));
    }
}
