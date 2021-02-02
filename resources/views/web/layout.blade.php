<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    {!! $head ?? '' !!}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset(mix('backend/assets/css/adminlte.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('frontend/assets/css/style.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('frontend/assets/css/lightbox.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('backend/assets/fontawesome-free/css/all.min.css')) }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

    @hasSection('css')
        @yield('css')
    @endif
</head>
<body>

<header>
    <nav class="address navbar navbar-dark bg-dark">
        <div class="container text-center">
            <div class="col-lg-4 d-flex align-items-center justify-content-center">
                <i class="fa fa-location-arrow mr-2 fa-2x"></i>
                <p class="mb-0">Vila União, 28, Praça Santo Antônio <br>Varzéa Alegre - CE</p>
            </div>
            <div class="col-lg-4 d-flex align-items-center justify-content-center">
                <i class="fa fa-clock mr-2 fa-2x"></i>
                <p class="mb-0">Seg a Sex, 07:00 - 17:00
            </div>
            <div class="col-lg-4 d-flex align-items-center justify-content-center">
                <i class="fa fa-envelope mr-2 fa-2x"></i>
                <p class="mb-0">imobiliaria@gmail.com <br>(88) 99302-2038</p>
            </div>
        </div>
    </nav>

    <nav class="main-menu navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="{{route('web.home')}}">
            <img src="{{asset('frontend/assets/img/imobiliaria.png')}}" class="img-logo" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav text-center">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('web.home')}}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('web.propertyCategory',['type'=>'alugar'])}}">Alugar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('web.propertyCategory',['type'=>'venda'])}}">Comprar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('web.contact')}}">Contato</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="content">
    @yield('content')
</main>

{{--FOOTER--}}
<footer>
    <div class="container d-flex">
        <div class="col-lg-3 ">
            <h2>Acesso Rápido</h2>
            <ul class="list-unstyled">
                <li><a href=""><i class="fa fa-link"></i> Início</a></li>
                <li><a href=""><i class="fa fa-link"></i> Destaque</a></li>
                <li><a href=""><i class="fa fa-link"></i> Alugar</a></li>
                <li><a href=""><i class="fa fa-link"></i> Comprar</a></li>
                <li><a href=""><i class="fa fa-link"></i> Contato</a></li>
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Nos Conheça!</h2>
            <p>Nossa maior satisfação é lhe ajudar a encontrar seu imóvel dos sonhos.</p>
            <h2>Quer Investir?</h2>
            <p>Entre em contato com a nossa equipe e vamos lhe informar sempre sobre os melhores negócios.</p>
        </div>
        <div class="col-lg-3">
            <h2>Mídias</h2>
            <ul class="list-unstyled d-flex justify-content-around">
                <li><a href=""><i class="fab fa-facebook-square fa-2x"></i></a></li>
                <li><a href=""><i class="fab fa-instagram-square fa-2x"></i></a></li>
                <li><a href=""><i class="fa fa-envelope fa-2x"></i></a></li>
                <li><a href=""><i class="fab fa-whatsapp-square fa-2x"></i></a></li>
            </ul>
        </div>
    </div>
</footer>
<nav class="nav navbar navbar-dark bg-dark flex-column p-3">
    <small>&copy; Todos os Direitos Reservados - Feito com <i class="fa fa-heart" style="color: #dc3545"></i> por
        <a target="_blank" href="https://edsonlimaweb.com.br" style="color: white"><strong>Edson Lima</strong></a></small>
</nav>

<!-- jQuery -->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('frontend/assets/js/lightbox.js') }}"></script>
<script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
<script>
    $(function () {
        $('.selectpicker').selectpicker();
    })
</script>
@hasSection('js')
    @yield('js')
@endif
</body>
</html>
