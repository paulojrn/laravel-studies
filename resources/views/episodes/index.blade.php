@extends('layout')

@section('title')
    Episódios
@endsection

@section('content')
    @include('comum/message', ['message' => $message])

    <form action="{{ route('watch-episodes', ['season' => $seasonId]) }}" method="POST">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episode->number }}

                    <input
                        type="checkbox"
                        name="episodes[]"
                        value="{{ $episode->id }}"
                        {{ $episode->viewed ? 'checked' : '' }}/>
                </li>
            @endforeach
        </ul>

        <button class="btn btn-primary my-2">Salvar</button>
    </form>
@endsection