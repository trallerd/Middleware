@extends('templates.main', ['titulo' => "Curso", 'tag' => "cur"])

@section('titulo') Curso @endsection

@section('conteudo')

<div>
    <button class="btn btn-primary btn-block" onClick="criar()">
        <b>Cadastrar Novo Curso</b>
    </button>
</div>
<br>
<x-tablelist :header="['Nome', 'Eventos']" :data="$cursos" :tag="['curso']" />
<div class="modal fade" tabindex="-1" role="dialog" id="modalCurso">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formCurso">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Novo Curso</b></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <input type="hidden" id="id_curso" class="form-control">
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-sm-12'>
                                <label><b>Nome</b></label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
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
        $('#modalCurso').modal().find('.modal-title').text("Cadastrar Curso");
        $("#nome").val('');
        $('#modalCurso').modal('show');
    }

    function editar(id) {
        $('#modalCurso').modal().find('.modal-title').text("Alterar Curso");

        $.getJSON('/api/curso/' + id, function(data) {
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#modalCurso').modal('show');
        });
    }
    $("#formCurso").submit(function(event) {

        event.preventDefault();

        if ($("#id").val() != '') {
            update($("#id").val());
        } else {
            insert();
        }

        $("#modalCurso").modal('hide');
    });

    function insert() {

        curso = {
            nome: $("#nome").val(),
        };
        $.post("/api/curso", curso, function(data) {
            novoCurso = JSON.parse(data);
            linha = getLin(novoCurso);
            $('#tabela>tbody').append(linha);

        });
    }

    function update(id) {

        curso = {
            nome: $("#nome").val(),
        };
        $.ajax({
            type: "PUT",
            url: "/api/curso/" + id,
            context: this,
            data: curso,
            success: function(data) {
                linhas = $("#tabela>tbody>tr");
                e = linhas.filter(function(i, e) {
                    return e.cells[0].textContent == id;
                });
                if (e) {
                    e[0].cells[1].textContent = curso.nome;
                }
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function getLin(curso) {
        var linha =
            "<tr style='text-align: center'>" +
            "<td style='display:none;'>"+curso.id+"</td>" +
            "<td>" + curso.nome + "</td>" +
            "<td>" +
            "<a nohref style='cursor:pointer' onClick='editar(" + curso.id + ")'><img src={{ asset('img/icons/edit.svg') }}></a>" +
            "</td>" +
            "</tr>";

        return linha;
    }

    
</script>

@endsection