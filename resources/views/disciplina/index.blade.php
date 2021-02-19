@extends('templates.main', ['titulo' => "Disciplinas", 'tag' => "disc"])

@section('titulo') Disciplinas @endsection

@section('conteudo')

<div>
    <button class="btn btn-primary btn-block" onClick="criar()">
        <b>Cadastrar Novo Disciplina</b>
    </button>
</div>
<br>
<x-tablelist :header="['Nome','Curso','Professor', 'Eventos']" :data="$disciplinas" :tag="['disciplina']" />
<div class="modal fade" tabindex="-1" role="dialog" id="modalDisciplina">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formDisciplina">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Nova Disciplina</b></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <input type="hidden" id="id_disc" class="form-control">
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-sm-12'>
                                <label><b>Nome</b></label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class='col-sm-12'>
                                <label> <b> Curso </b></label>
                                <select name='curso_id' id="curso_id" class="form-control" required>
                                <option selected> </option>
                                    @foreach($cursos as $item)
                                    <option value="{{$item->id}}"> {{$item->nome}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class='col-sm-12'>
                                <label> <b> Professor </b></label>
                                <select name='professor_id' id="professor_id" class="form-control" required>
                                    <option selected> </option>
                                    @foreach($professor as $item)
                                    <option value="{{$item->id}}" > {{$item->nome}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function criar() {
        $('#modalDisciplina').modal().find('.modal-title').text("Cadastrar Disciplina");
        $("#nome").val('');
        $("#curso_id").val('');
        $("#professor_id").val('');
        $('#modalDisciplina').modal('show');
    }

    function editar(id) {
        $('#modalDisciplina').modal().find('.modal-title').text("Alterar Disciplina");

        $.getJSON('/api/disciplina/' + id, function(data) {
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#curso_id').val(data.curso.nome);
            $('#professor_id').val(data.professor.nome);
            $('#modalDisciplina').modal('show');
        });
    }
    $("#formDisciplina").submit(function(event) {

        event.preventDefault();

        if ($("#id").val() != '') {
            update($("#id").val());
        } else {
            insert();
        }

        $("#modalDisciplina").modal('hide');
    });

    function insert() {

        disciplina = {
            nome: $("#nome").val(),
            curso_id: $("#curso_id").val(),
            professor_id: $("#professor_id").val(),
        };
        $.post("/api/disciplina", disciplina, function(data) {
            novaDisciplina = JSON.parse(data);
            linha = getLin(novaDisciplina);
            $('#tabela>tbody').append(linha);

        });
    }

    function update(id) {

        disciplina = {
            nome: $("#nome").val(),
            curso_id: $("#curso_id").val(),
            professor_id: $("#professor_id").val(),
        };
        $.ajax({
            type: "PUT",
            url: "/api/disciplina/" + id,
            context: this,
            data: disciplina,
            success: function(data) {
                linhas = $("#tabela>tbody>tr");
                e = linhas.filter(function(i, e) {
                    return e.cells[0].textContent == id;
                });
                if (e) {
                    e[0].cells[1].textContent = disciplina.nome;
                }
            },
            error: function(error) {
                alert(error.textContent);
            }
        });
    }

    function getLin(disciplina) {
        var linha =
            "<tr style='text-align: center'>" +
            "<td style='display:none;'>"+disciplina.id+"</td>" +
            "<td>" + disciplina.nome + "</td>" +
            "<td>" + disciplina.curso.nome + "</td>" +
            "<td>" + disciplina.professor.nome + "</td>" +
            "<td>" +
            "<a nohref style='cursor:pointer' onClick='editar(" + disciplina.id + ")'><img src={{ asset('img/icons/edit.svg') }}></a>" +
            "</td>" +
            "</tr>";

        return linha;
    }

    
</script>

@endsection