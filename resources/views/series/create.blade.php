@extends('layout')

@section('title')
    Adicionar série
@endsection

@section('content')
    @include('comum/errors', ['errors' => $errors])

    <form method="POST">
        @csrf
        
        <div class="row mb-2">
            <div class="col-8">
                <label for="name">Nome:</label>
                <input id="name" name="name" type="text" class="form-control"/>
            </div>
            <div class="col-2">
                <label for="seasons_qtt">N° temporadas:</label>
                <input id="seasons_qtt" name="seasons_qtt" type="text" class="form-control"/>
            </div>
            <div class="col-2">
                <label for="episodes_qtt">N° episódios</label>
                <input id="episodes_qtt" name="episodes_qtt" type="text" class="form-control"/>
            </div>
        </div>
        

        <button class="btn btn-success">Adicionar</a>
    </form>
@endsection