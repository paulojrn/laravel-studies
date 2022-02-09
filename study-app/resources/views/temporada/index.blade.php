@extends("layout")

@section("header")
<h1>Temporadas de {{ $serie->nome }}</h1>
@endsection

@section("content")
@if ($serie->capa)
    <div class="text-center">
        <a  href="{{$serie->capa_url}}" 
            target="_blank">
                <img    src="{{$serie->capa_url}}" 
                    class="img-fluid img-thumbnail" 
                    alt="..." 
                    height="200px" 
                    width="200px">
        </a>
    </div>
@endif
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