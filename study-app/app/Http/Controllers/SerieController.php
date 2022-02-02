<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Response
    {
        $series = Serie::query()
            ->orderBy("nome", "ASC")
            ->get();

        $message = $request->session()->get("message");

        return new Response(view("serie.index", [
            "series" => $series,
            "message" => $message
        ]));

        // $series = Serie::all();
        // $request->session()->remove("message");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return new Response(view("serie.create"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        $serie = Serie::create($request->all());
        
        $request->session()->flash(
            "message",
            "Série [{$serie->id}] {$serie->nome} adicionada com sucesso!"
        );

        return new Response();

        // $nome = $request->get("nome");
        // $serie = new Serie();
        // $serie->nome = $nome;
        // $serie->save();

        // $request->session()->put(
        //     "message",
        //     "Série {$serie->id}:{$serie->nome} adicionada com sucesso!"
        // );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): Response
    {
        return new Response();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): Response
    {
        return new Response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): Response
    {
        return new Response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        return new Response();
    }
}
