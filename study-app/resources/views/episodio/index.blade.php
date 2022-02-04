@extends("layout")

@section("header")
<h1>Episódios</h1>
@endsection

@section("content")

@include('mensagem.mensagem', ["mensagem" => $mensagem])

<form action="/temporada/{{$idTemporada}}/episodios/assistir" method="POST">
    @csrf
    <ul class="list-group">
        @foreach ($episodios as $episodio)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Episódio {{$episodio->numero}}
                <input  type="checkbox" 
                        name="episodios[]" 
                        value="{{$episodio->id}}"
                        {{$episodio->assistido ? "checked":""}}>
            </li>
        @endforeach
    </ul>

    <button class="btn btn-primary mt-2">Salvar</button>
</form>
@endsection