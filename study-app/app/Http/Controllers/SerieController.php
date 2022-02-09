<?php

namespace App\Http\Controllers;

use App\Http\Requests\SerieFormRequest;
use App\Mail\NovaSerie;
use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use App\Models\User;
use App\Services\SerieService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

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
     * @param SerieFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SerieFormRequest $request): Response
    {
        $serie = SerieService::createSerie($request);

        $user = $request->user();
        $users = User::all();

        foreach ($users as $index => $user) {
            $mult = $index + 1;
            $email = new NovaSerie(
                $serie->nome,
                $request->qnt_temporadas,
                $request->ep_por_temporada
            );

            $email->subject = "Nova série adicionada!";
            $when = now()->addSecond($mult * 5);

            Mail::to($user)->later($when, $email); //send, queue, later
        }

        $request->session()->flash(
            "message",
            "Série {$serie->nome} seus episódios e temporadas criada com sucesso!"
        );

        return new Response();
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
    public function edit(int $id, Request $request): Response
    {
        $serie = Serie::find($id);
        $serie->nome = $request->nome;
        $serie->save();

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
    public function destroy(Request $request): Response
    {
        SerieService::destroySerie($request->id);
        
        $request->session()->flash(
            "message",
            "A série removida com sucesso"
        );

        return new Response();
    }
}
