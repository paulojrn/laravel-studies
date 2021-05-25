@extends('layout')

@section('title')
    Lista de séries
@endsection

@section('content')
    @include('comum/message', ['message' => $message])

    @auth
        <a href="{{ route('create_serie_form') }}" class="btn btn-primary mb-2">Adicionar série</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="serie-name-{{ $serie->id }}">{{ $serie->name }}</span>

                <div id="serie-input-{{ $serie->id  }}" class="input-group w-50" hidden >
                    <input type="text" class="form-control" value="{{ $serie->name }}" />

                    <div class="input-group-append">
                        @csrf
                        <button class="btn btn-primary" onclick="editSerie({{ $serie->id }});">
                            Check
                        </button>
                    </div>
                </div>

                <span class="d-flex">
                    @auth
                        <button class="btn btn-info btn-sm" onclick="toggleInput({{ $serie->id }})">
                            Editar
                        </button>
                    @endauth

                    <a href="{{ route('list-seasons', ['serieId' => $serie->id]) }}" class="btn btn-info btn-sm">
                        Informações
                    </a>

                    @auth
                        <form
                            method="POST"
                            action="{{ route('delete_serie' ,['id' => $serie->id]) }}"
                            onsubmit='return confirm("Tem certeza?");'
                        >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    @endauth
                </span>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleInput(serieId)
        {
            const nameEl = document.getElementById(`serie-name-${serieId}`);
            const inputEl = document.getElementById(`serie-input-${serieId}`);

            if (nameEl.hasAttribute('hidden')) {
                nameEl.removeAttribute('hidden');
                inputEl.hidden = true;

                return;
            }

            nameEl.hidden = true;
            inputEl.removeAttribute('hidden');

            return;
        }

        function editSerie(serieId)
        {
            let formData = new FormData();
            const name = document.querySelector(`#serie-input-${serieId} > input`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            const url = `/series/${serieId}/edit`;

            formData.append('name', name);
            formData.append('_token', token);

            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                document.getElementById(`serie-name-${serieId}`).textContent = name;
                toggleInput(serieId);
            });
        }
    </script>
@endsection

