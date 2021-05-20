@extends('layout')

@section('title')
    Adicionar série
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST">
        @csrf
        
        <div class="form-group mb-2">
            <label for="name">Nome:</label>
            <input id="name" name="name" type="text" class="form-control"/>
        </div>

        <button class="btn btn-success">Adicionar</a>
    </form>
@endsection