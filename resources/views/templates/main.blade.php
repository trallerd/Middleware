<html>

<head>
    <title>SISAR - @yield('titulo')</title>
    <meta charset="UTF-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            padding: 30px;
        }

        .navbar {
            margin-bottom: 30px;
        }

        .card {
            margin: 20px;
        }

        .card-header {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark d-flex justify-content-between ">
            <div class="d-flex ">
                @if($tag=='neg')
                <img width="45" height="45" src="{{ asset('img/icons/restrito.png') }}" alt="NEGADO">
                @elseif($tag=='cur')
                <img src="{{ asset('img/icons/curso.png') }}" alt="CURSO">
                @elseif($tag=='home')
                <img src="{{ asset('img/icons/home.png') }}" alt="HOME">
                @elseif($tag=='aluno')
                <img src="{{ asset('img/icons/student.png') }}" alt="ALUNO">
                @elseif($tag=='disc')
                <img src="{{ asset('img/icons/disc.png') }}" alt="DISCIPLINA">
                @elseif($tag=='prof')
                <img src="{{ asset('img/icons/prof.png') }}" alt="PROFESSOR">
                @elseif($tag=='matr')
                <img src="{{ asset('img/icons/matr.png') }}" alt="MATRICULA">
                @endif
                <h2 style="color: white; ">{{$titulo}}</h2>
            </div>
            <a class="navbar-brand" href="/"><b class="h1">SISAR - Sistama de Avaliação Remota</b></a>
            <div>
                <a style="color: white;" href="/">
                    <h3>[HOME]</h3>
                </a>
            </div>
        </nav>
        <div>
            @yield('conteudo')
        </div>
        <hr>

</body>
<footer>
    <b>&copy;2020 - Jéss Gonçalves.</b>
</footer>

<script src="{{asset('js/app.js')}}" type="text/javascript"></script>

@yield('script')
</div>

</html>