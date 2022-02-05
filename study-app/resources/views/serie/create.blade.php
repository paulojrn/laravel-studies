@extends("layout")

@section("header")
<h1>Adicionar série</h1>
@endsection

@section("content")
@include('subviews.erros', ['errors' => $errors])

<form method="POST" action="{{ route('do_create') }}">
    @csrf
    <div class="row">
        <div class="col-8">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control">
        </div>
        <div class="col-2">
            <label for="qnt_temporadas">N° temporadas</label>
            <input type="number" id="qnt_temporadas" name="qnt_temporadas" class="form-control">
        </div>
        <div class="col-2">
            <label for="ep_por_temporada">Episódios por temporada</label>
            <input type="number" id="ep_por_temporada" name="ep_por_temporada" class="form-control">
        </div>
    </div>
    <hr>
    <button class="btn btn-primary">
        Adicionar
    </button>
</form>
@endsection
