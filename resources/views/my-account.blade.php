@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-white fs-2 py-3">
                    Bem vindo(a), <br> {{ $data->name }}
                </h2>
                <h3 class="text-white fs-1 text-center py-3">
                    Meus filmes
                </h3>
            </div>
            @if (count($data->movies) < 0)
            @foreach ($data->movies as $movie)
            <div class="col-md-4">
                <div class="card">
                    <img src={{!empty($movie->image) ? $movie->image :
                    'https://via.placeholder.com/400x400.png?text=Imagem+n%C3%A3o+dispon%C3%ADvel' }}
                    class="card-img-top img-fluid" alt={{$movie->name}}>
                    <div class="card-body">
                        <h2 class="card-title fw-bold">{{$movie->name}}</h2>
                        <p>
                            Ano de lançamento: {{$movie->year}}
                        </p>
                        <p>
                            Gênero: {{$movie->genre}}
                        </p>
                        <p>
                            Recomendado por: {{$movie->recommended}} pessoas
                        </p>
                        <p>
                            Não recomendado por: {{$movie->notRecommended}} pessoas
                        </p>
                        @if ($movie->ended_at)
                        <p>
                            Encerrado em: {{ $movie->ended_at }}
                        </p>
                        @endIf
                        <div class="text-center">
                            <button type="button" class="btn btn-warning my-1 w-100"
                                onclick="confirmEndMovie({{$movie->id}})">Encerrar recomendação
                            </button>
                            <button type="button" class="btn btn-danger my-1 w-100"
                            onclick="confirmDelMovie({{$movie->id}})">
                                Deletar recomendação
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12 py-5">
                <h3 class="text-white text-center fs-3 text-decoration-underline">
                    Nenhum filme para exibir
                </h3>
            </div>
            @endIf
            <form action="{{route('endMovie')}}" id="end-movie" method="POST">
                @csrf
                <input type="hidden" name="id" id="input-end-movie" value="">
            </form>
            <form action="{{route('delMovie')}}" id="del-movie" method="POST">
                @csrf
                <input type="hidden" name="id" id="input-del-movie" value="">
            </form>
        </div>
    </div>
</main>

@endsection
@section('js-includes')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection
@section('js-scripts')
<script>
    function confirmEndMovie(movieId) {
        var form = document.getElementById('end-movie')
        var id = document.getElementById('input-end-movie')
        Swal.fire({
            title: 'Deseja encerrar este pedido de recomendação?',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                id.value = movieId
                form.submit()
            }
        })
    }

    function confirmDelMovie(movieId) {
        var form = document.getElementById('del-movie')
        var id = document.getElementById('input-del-movie')
        Swal.fire({
            title: 'Deseja apagar este pedido de recomendação?',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                id.value = movieId
                form.submit()
            }
        })
    }
</script>
@endsection