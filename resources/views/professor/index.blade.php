@extends('templates.main', ['titulo' => "Professores", 'tag' => "prof"])

@section('titulo') Professores @endsection

@section('conteudo')

<div>
    <button class="btn btn-primary btn-block" onClick="criar()">
        <b>Cadastrar Novo Professor</b>
    </button>
</div>
<br>
<x-tablelist :header="['Nome','Email', 'Eventos']" :data="$professor" :tag="['professor']"/>
<div class="modal fade" tabindex="-1" role="dialog" id="modalProf">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formProf">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Novo Professor</b></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <input type="hidden" id="id_prof" class="form-control">
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
        $('#modalProf').modal().find('.modal-title').text("Cadastrar Professor");
        $("#nome").val('');
        $("#email").val('');
        $('#modalProf').modal('show');
    }

    function editar(id) {
        $('#modalProf').modal().find('.modal-title').text("Alterar Professor");

        $.getJSON('/api/professor/' + id, function(data) {
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#email').val(data.email);
            $('#modalProf').modal('show');
        });
    }
    $("#formProf").submit(function(event) {

        event.preventDefault();

        if ($("#id").val() != '') {
            update($("#id").val());
        } else {
            insert();
        }

        $("#modalProf").modal('hide');
    });

    function insert() {

        professor = {
            nome: $("#nome").val(),
            email: $("#email").val(),
        };
        $.post("/api/professor", professor, function(data) {
            novoProf = JSON.parse(data);
            linha = getLin(novoProf);
            $('#tabela>tbody').append(linha);

        });
    }

    function update(id) {

        professor = {
            nome: $("#nome").val(),
            email: $("#email").val(),
        };
        $.ajax({
            type: "PUT",
            url: "/api/professor/" + id,
            context: this,
            data: professor,
            success: function(data) {
                linhas = $("#tabela>tbody>tr");
                e = linhas.filter(function(i, e) {
                    return e.cells[0].textContent == id;
                });
                if (e) {
                    e[0].cells[1].textContent = professor.nome;
                }
            },
            error: function(error) {
                alert(error);
            }
        });
    }

    function getLin(professor) {
        var linha =
            "<tr style='text-align: center'>" +
            "<td style='display:none;'>"+professor.id+"</td>" +
            "<td>" + professor.nome + "</td>" +
            "<td>" + professor.email + "</td>" +
            "<td>" +
            "<a nohref style='cursor:pointer' onClick='editar(" + professor.id + ")'><img src={{ asset('img/icons/edit.svg') }}></a>" +
            "</td>" +
            "</tr>";

        return linha;
    }


</script>

@endsection