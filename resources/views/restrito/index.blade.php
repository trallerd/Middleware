@extends('templates.main', ['titulo' => "Negado", 'tag' => "neg"])

@section('titulo') Acesso Negado @endsection

@section('conteudo')
<br>
<h1 class="d-flex JUSTIFY-CONTENT-CENTER">Acesso Restrito!</h1>
<br>
<div class="container d-flex JUSTIFY-CONTENT-CENTER">
<img src="{{ asset('img/icons/restrito.png') }}" alt="NEGADO">
</div>
<br>
@endsection