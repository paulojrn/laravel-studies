@extends("layout")

@section("header")
<h1>Series</h1>
@endsection

@section("content")
@if (isset($message) && !empty($message))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<a href="{{ route('form_create') }}" class="btn btn-success mb-2">
    Adicionar
</a>
<ul class="list-group">
    @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $serie->nome }}

            <form   method="POST" 
                    action="{{ route('do_delete', ['id' => $serie->id]) }}"
                    onsubmit="return confirm('Remover {{ addslashes($serie->nome) }}?');">
                @csrf
                @method("DELETE")
                
                <button class="btn btn-sm btn-danger">
                    Excluir
                </button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
