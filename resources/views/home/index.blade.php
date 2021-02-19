@extends('templates.main', ['titulo' => "Home", 'tag' => "home"])

@section('titulo') Home @endsection

@section('conteudo')

<div class="d-flex justify-content-center">
    <div class="card" style="width: 15rem;">
        <a href="{{route('curso.index')}}">
            <img src="{{asset('img/icons/curso500.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text h1 text-center">Curso</p>
            </div>
        </a>
    </div>
    <div class="card" style="width: 15rem;">
        <a href="{{route('disciplina.index')}}">
            <img src="{{asset('img/icons/disc500.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text h1 text-center">Disciplina</p>
            </div>
        </a>
    </div>
    <div class="card" style="width: 15rem;">
        <a href="{{route('professor.index')}}">
            <img src="{{asset('img/icons/prof500.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text h1 text-center">Professor</p>
            </div>
        </a>
    </div>
    <div class="card " style="width: 15rem;">
        <a href="{{route('aluno.index')}}">
            <img src="{{asset('img/icons/student500.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text h1 text-center">Aluno</p>
            </div>
        </a>
    </div>
</div>
@endsection