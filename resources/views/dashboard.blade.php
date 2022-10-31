@extends('layouts.app')

@section('content')
<header class="border-bottom bg-light">
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-end">
                @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Log out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log
                        in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
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
            <div class="col-12 title my-3">
                <h1 class="text-center text-uppercase">
                    Você recomenda?
                </h1>
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
                        <button type="button" class="btn btn-success my-1"
                            onclick="confirmRecommend({{$movie->id}})">Recomendar</button>

                        <button type="button" class="btn btn-danger my-1" onclick="confirmNotRecommend({{$movie->id}})">Não recomendar</button>
                    </div>
                </div>
            </div>
            @endforeach
            <form action="{{route('recommendMovie')}}" id="recommend-movie" method="POST">
                @csrf
                <input type="hidden" name="id" id="input-recommend" value="">
            </form>
            <form action="{{route('notRecommendMovie')}}" id="not-recommend-movie" method="POST">
                @csrf
                <input type="hidden" name="id" id="input-not-recommend" value="">
            </form>
            <div class="col-12 text-center mt-4">
                
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Pedir recomendação
                    </button>
                
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title fs-5" id="exampleModalLabel">Pedir recomendação</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('createMovie') }}" id="new-movie-form" method="POST">
                        @csrf
                        <div class="my-2"><label for="name">Nome:</label> <input type="text" name="name" class="w-100"></div>
                        <div class="my-2"><label for="year">Ano:</label> <input type="number" min="1900" max="2099" step="1" value="" name="year" class="w-100" />
                        <div class="my-2"><label for="genre">Gênero:</label> <input type="text" name="genre" class="w-100"></div>
                        <div class="my-2"><label for="image">Imagem (URL):</label> <input type="text" name="image" class="w-100" placeholder="https://via.placeholder.com/400x400"></div>
                        <button type="button" class="btn btn-success" onclick="confirmNewMovie()">Confirmar</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </div>
</main>
@endsection
@section('js-includes')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection
@section('js-scripts')
<script>
        function confirmNewMovie() {
        var form = document.getElementById('new-movie-form')
        Swal.fire({
            title: 'Deseja pedir a recomendação deste filme?',
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
    function confirmRecommend(id) {
        var form = document.getElementById('recommend-movie')
        Swal.fire({
            title: 'Deseja recomendar este filme?',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var input = document.getElementById('input-recommend')
                input.value = id
                form.submit()
            }
        })
    }
    function confirmNotRecommend(id) {
        var form = document.getElementById('not-recommend-movie')
        Swal.fire({
            title: 'Deseja não recomendar este filme?',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var input = document.getElementById('input-not-recommend')
                input.value = id
                form.submit()
            }
        })
    }

</script>
@endsection