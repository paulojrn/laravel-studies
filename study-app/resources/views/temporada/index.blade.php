@extends("layout")

@section("header")
<h1>Temporadas de {{ $serie->nome }}</h1>
@endsection

@section("content")
<ul class="list-group">
    @foreach ($temporadas as $temporada)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="/temporada/{{ $temporada->id }}/episodios">
                Temporada {{ $temporada->numero }}
            </a>
            <span class="">
                {{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count() }}
            </span>
        </li>
    @endforeach
</ul>
@endsection