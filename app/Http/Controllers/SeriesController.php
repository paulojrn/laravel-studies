<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SeriesController extends Controller
{
    public function index (Request $request): View|Factory
    {
        // $series = Serie::all();
        $series = Serie::query()->orderBy('name')->get();
        $message = $request->session()->get('message');

        return view('series.index', [
            'series' => $series,
            'message' => $message
        ]);
    }

    public function create (): View|Factory
    {
        return view('series.create');
    }

    public function store (SeriesFormRequest $request): Redirector|RedirectResponse
    {
        // $name = $request->name; // $request->get('name')

        $request->validate();

        $serie = Serie::create($request->all()); // Salva todos os dados

        $request->session()->flash(
            'message', "Série {$serie->name} criada com sucesso!"
        );

        // Serie::create([
        //     'name' => null
        // ]);

        // $serie = new Serie();
        // $serie->name = $name;
        // $serie->save();

        return redirect()->route('list_series');
    }

    public function destroy (Request $request)
    {
        Serie::destroy($request->id);

        $request->session()->flash(
            'message', "Série removida com sucesso!"
        );

        return redirect()->route('list_series');
    }
}
