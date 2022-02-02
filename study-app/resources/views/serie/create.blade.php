@extends("layout")

@section("header")
<h1>Adicionar série</h1>
@endsection

@section("content")
<form method="POST" action="">
    @csrf
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" class="form-control">
    </div>
    <hr>
    <button class="btn btn-primary">
        Adicionar
    </button>
</form>
@endsection
