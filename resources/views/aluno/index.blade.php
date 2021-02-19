@extends('templates.main', ['titulo' => "Aluno", 'tag' => "aluno"])

@section('titulo') Aluno @endsection

@section('conteudo')

<div>
    <button class="btn btn-primary btn-block" onClick="criar()">
        <b>Cadastrar Novo Aluno</b>
    </button>
</div>
<br>
<x-tablelist :header="['Nome', 'Email','Curso','Diciplina','Eventos']" :data="$alunos" :tag="['aluno']" />
<div class="modal fade" tabindex="-1" role="dialog" id="modalAluno">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formAluno">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Novo Aluno</b></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <input type="hidden" id="id_aluno" class="form-control">
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-sm-12'>
                                <label><b>Nome</b></label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <label><b>Email</b></label>
                                <input type="text" class="form-control" name="email" id="email" required>
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
        $('#modalAluno').modal().find('.modal-title').text("Cadastrar Aluno");
        $("#nome").val('');
        $("#email").val('');
        $("#curso_id").val('');
        $('#modalAluno').modal('show');
    }

    function editar(id) {
        $('#modalAluno').modal().find('.modal-title').text("Alterar Aluno");

        $.getJSON('/api/aluno/' + id, function(data) {
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#email').val(data.email);
            $('#curso_id').val(data.curso_id);
            $('#modalAluno').modal('show');
        });
    }
    $("#formAluno").submit(function(event) {

        event.preventDefault();

        if ($("#id").val() != '') {
            update($("#id").val());
        } else {
            insert();
        }

        $("#modalAluno").modal('hide');
    });

    function insert() {

        aluno = {
            nome: $("#nome").val(),
            email: $("#email").val(),
            curso_id: $("#curso_id").val(),
        };
        $.post("/api/aluno", aluno, function(data) {
            novoAluno = JSON.parse(data);
            linha = getLin(novoAluno);
            $('#tabela>tbody').append(linha);

        });
    }

    function update(id) {

        aluno = {
            nome: $("#nome").val(),
            email: $("#email").val(),
            curso_id: $("#curso_id").val(),
        };
        $.ajax({
            type: "PUT",
            url: "/api/aluno/" + id,
            context: this,
            data: aluno,
            success: function(data) {
                linhas = $("#tabela>tbody>tr");
                e = linhas.filter(function(i, e) {
                    return e.cells[0].textContent == id;
                });
                if (e) {
                    e[0].cells[1].textContent = aluno.nome;
                }
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function getLin(aluno) {
        var linha =
            "<tr style='text-align: center'>" +
            "<td style='display:none;'>" + aluno.id + "</td>" +
            "<td>" + aluno.nome + "</td>" +
            "<td>" + aluno.email + "</td>" +
            "<td>" + aluno.curso.nome + "</td>" +
            "<td><select >" +
            "</select></td>" +
            "<td>" +
            "<a nohref style='cursor:pointer' onClick='editar(" + aluno.id + ")'><img src={{ asset('img/icons/edit.svg') }}></a>" +
            "<a nohref style='cursor:pointer' href='{{ route('matricula.index').'?aluno_id='." + aluno.id + "}}'><img src='{{ asset('img/icons/settings.svg') }}'></a> " +
            "</td>" +
            "</tr>";

        return linha;
    }
</script>

@endsection