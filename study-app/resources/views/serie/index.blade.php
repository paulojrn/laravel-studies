@extends("layout")

@section("header")
<h1>Series</h1>
@endsection

@section("content")
<a href="/serie/create" class="btn btn-success mb-2">
    Adicionar
</a>
<ul class="list-group">
    @foreach ($series as $serie)
        <li class="list-group-item">{{ $serie->nome }}</li>
    @endforeach
</ul>
@endsection
