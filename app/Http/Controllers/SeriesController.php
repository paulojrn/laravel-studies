<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Services\{SerieCreator, SerieRemover};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Http\{Request, RedirectResponse};
use Illuminate\Routing\Redirector;

class SeriesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request): View|Factory
    {
        $series = Serie::query()->orderBy('name')->get();
        $message = $request->session()->get('message');
        
        return view('series.index', [
            'series' => $series,
            'message' => $message
        ]);
    }

    public function create(): View|Factory
    {
        return view('series.create');
    }

    public function store(
        SeriesFormRequest $request,
        SerieCreator $serieCreator
    ): Redirector|RedirectResponse {        
        $serie = $serieCreator->createSerie($request->name, $request->seasons_qtt, $request->episodes_qtt);

        $request->session()->flash(
            'message', "Série {$serie->name}, temporadas e episódios criados com sucesso!"
        );

        return redirect()->route('list_series');
    }

    public function destroy(Request $request, SerieRemover $serieRemover): RedirectResponse
    {
        $serieName = $serieRemover->removeSerie($request->id);

        $request->session()->flash(
            'message', "Série {$serieName} foi removida com sucesso!"
        );

        return redirect()->route('list_series');
    }

    public function edit(int $seriesId, Request $request)
    {
        $newName = $request->name;
        $serie = Serie::find($seriesId);
        $serie->name = $newName;
        $serie->save();
    }
}

// $series = Serie::all();
// $serie = Serie::create($request->all());
// $name = $request->name; // $request->get('name')
// Serie::create([
        //     'name' => null
        // ]);

        // $serie = new Serie();
        // $serie->name = $name;
        // $serie->save();
