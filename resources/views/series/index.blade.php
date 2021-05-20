@extends('layout')

@section('title')
    Lista de séries
@endsection

@section('content')
    @if (!empty($message))
        <div class="alert alert-success">
            {{$message}}
        </div>
    @endif

    <a href="{{ route('create_serie_form') }}" class="btn btn-primary mb-2">Adicionar série</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->name }}

                <form
                    method="POST"
                    action="{{ route('delete_serie' ,['id' => $serie->id]) }}"
                    onsubmit='return confirm("Tem certeza?");'
                >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection

