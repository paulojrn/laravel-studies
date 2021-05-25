<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- JavaScript -->

    <title>@yield('title')</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 d-flex justify-content-between">
            <a href="{{ route('list_series') }}" class="navbar-brand">Home</a>

            @auth
                <a href="/exit" class="text-danger">Sair</a>
            @endauth

            @guest
                <a href="/login" class="text-primary">Entrar</a>
            @endguest
        </nav>

        <div class="container ">
            <div class="bg-light p-4 my-2">
                <h1>@yield('title')</h1>
            </div>
        </div>
    </header>
    
    <main class="container">
        @yield('content')
    </main>
</body>
</html>