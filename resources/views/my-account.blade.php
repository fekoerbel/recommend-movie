@extends('layouts.app')

@section('content')
<header class="border-bottom bg-light">
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-end">
                @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                    <a href="{{ route('my-account') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Minha conta
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Sair
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Entrar</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Registrar</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    Meus filmes
                </h2>
            </div>
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
                        <button type="button" class="btn btn-danger my-1"
                            onclick="confirmDelete({{$movie->id}})">Apagar recomendação</button>
                    </div>
                </div>
            </div>
            @endforeach
            <form action="{{route('delMovie')}}" id="del-movie" method="POST">
                @csrf
                <input type="hidden" name="id" id="input-recommend" value="">
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
        function confirmDelete() {
        var form = document.getElementById('del-movie')
        Swal.fire({
            title: 'Deseja apagar este pedido de recomendação?',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                form.submit()
            }
        })
    }
</script>
@endsection