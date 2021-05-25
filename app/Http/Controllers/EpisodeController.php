<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index(Season $season, Request $request)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'seasonId' => $season->id,
            'message' => $request->session()->get('message')
        ]);
    }

    public function watch(Season $season, Request $request)
    {
        $watchedEpisodes = $request->episodes;
        
        $season->episodes->each(function($episode) use ($watchedEpisodes) {
            $episode->viewed = in_array($episode->id, $watchedEpisodes);
        });

        $season->push(); // save all modifications (including for season)
        $request->session()->flash('message', 'Episódios marcados como assistidos');

        return redirect()->back();
    }
}
