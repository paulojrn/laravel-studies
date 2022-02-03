@extends("layout")

@section("header")
<h1>Temporadas de {{ $serie->nome }}</h1>
@endsection

@section("content")
<ul class="list-group">
    @foreach ($temporadas as $temporada)
        <li class="list-group-item">
            Temporada {{ $temporada->numero }}
        </li>
    @endforeach
</ul>
@endsection