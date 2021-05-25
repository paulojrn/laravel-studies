@extends('layout')

@section('title')
    Registrar-se  
@endsection

@section('content')
    <form method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary mt-3">
            Entrar
        </button>
    </form>
@endsection