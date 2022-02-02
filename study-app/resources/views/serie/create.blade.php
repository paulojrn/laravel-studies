@extends("layout")

@section("header")
<h1>Adicionar série</h1>
@endsection

@section("content")
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST">
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
