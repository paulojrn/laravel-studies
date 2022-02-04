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
            <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

            <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                <input type="text" class="form-control" value="{{ $serie->nome }}">
                <div class="input-group-append">
                    <button class="btn btn-secondary" onclick="editarSerie({{ $serie->id }})">
                        OK
                    </button>
                    @csrf
                </div>
            </div>

            <span class="d-flex">
                <button class="btn btn-primary btn-sm" 
                        style="margin-right: 10px"
                        onclick="toggleInput({{ $serie->id }})">
                    Editar
                </button>
                <a  href="{{ route('show_temporadas', ['id' => $serie->id]) }}"
                    class="btn btn-info btn-sm"
                    style="margin-right: 10px">

                    Info
                </a>
                <form   method="POST" 
                        action="{{ route('do_delete', ['id' => $serie->id]) }}"
                        onsubmit="return confirm('Remover {{ addslashes($serie->nome) }}?');">
                    @csrf
                    @method("DELETE")
                    
                    <button class="btn btn-sm btn-danger">
                        Excluir
                    </button>
                </form>
            </span>
        </li>
    @endforeach
</ul>
<script>
    function toggleInput(id) {
        let nomeSerieEl = document.getElementById(`nome-serie-${id}`);
        let inputSerieEl = document.getElementById(`input-nome-serie-${id}`);

        if (nomeSerieEl.hasAttribute("hidden")) {
            inputSerieEl.hidden = true;
            nomeSerieEl.removeAttribute("hidden");
        } else {
            inputSerieEl.removeAttribute("hidden");
            nomeSerieEl.hidden = true;
        }
    }

    function editarSerie(id) {
        let formData = new FormData();
        const token = document.querySelector("input[name='_token']").value;
        const nome = document.querySelector(`#input-nome-serie-${id} > input`).value;
        const url = `/serie/${id}/edit-name`;

        formData.append("nome", nome);
        formData.append("_token", token);

        fetch(url, {
            body: formData,
            method: "POST"
        }).then(() => {
            toggleInput(id);
            document.getElementById(`nome-serie-${id}`).textContent = nome;
        });
    }
</script>
@endsection
