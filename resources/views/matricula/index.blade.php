@extends('templates.main', ['titulo' => "Matricula", 'tag' => "matr"])

@section('titulo') Matricula @endsection

@section('conteudo')

<div class="d-flex justify-content-between">
    <div>
        <a href="{{ route('aluno.index') }}"><button type="button" class="btn btn-dark btn-lg">Voltar</button></a>

    </div>
    <div class="d-flex justify-content-between alert alert-secondary">
    <input type="hidden" id="id"  value="{{$aluno->id}}" class="form-control">
        <img height="35px" width="35px" src="{{ asset('img/icons/disc.png') }}" alt="DISCIPLINA">
        <h4 class="text-uppercase align-middle">{{$aluno->curso->nome}}</h4>
    </div>
    <div class=" d-flex justify-content-between alert alert-secondary">
        <img height="35px" width="35px" src="{{ asset('img/icons/student.png') }}" alt="ALUNO">
        <h2 class="text-uppercase align-middle">{{$aluno->nome}}</h2>
    </div>
</div>
<br>
<div class="d-flex justify-content-center alert alert-info">
    <img height="35px" width="35px" src="{{ asset('img/icons/matr.png') }}" alt="MATRICULA">
    <h3 class="text-center">Matriculas do aluno</h3>
</div>
<hr>

@foreach($disciplinas as $disciplina)
<div class="form-check">
    <input id="disciplina_id" nome="disciplina_id" value="{{$disciplina->id}}" class="form-check-input" type="checkbox"@if(!is_null($aluno->disciplina->find($disciplina->id))) checked @endif>
    <label class="form-check-label" for="disciplina_id">
        {{$disciplina->nome}}
    </label>
</div>
<hr>
@endforeach
<button onClick="insert()" class="btn btn-primary btn-block btn-lg">Confirmar matricula</button>
@endsection

@section('script')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });


    function insert() {

        matricula = {
            aluno_id: $("#id").val(),
            disciplina_id: $("#disciplina_id").val(),
        };
        $.post("/api/matricula", matricula, function(data) {
            

        });
    }

    
</script>

@endsection