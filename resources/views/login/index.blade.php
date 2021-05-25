@extends('layout')

@section('title')
    Login
@endsection

@section('content')
    @include('comum/errors', ['errors' => $errors])

    <form method="POST">
        @csrf

        <div class="form-group">
            <label for="email">E-mail</label>

            <input
                id="email"
                name="email"
                type="email"
                class="form-control"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            
            <input
                id="password"
                name="password"
                type="password"
                class="form-control"
                min="3"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Entrar
        </button>

        <a href="/register" class="btn btn-secondary mt-3">
            Registrar-se
        </a>
    </form>
@endsection