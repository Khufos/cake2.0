<?php
if (empty($this->data['Acao']['id'])) {
?>
    <p>&nbsp;</p>
    <div class="alert alert-warning" role="alert">
        <strong>Aviso!</strong> Salve esta Ação para poder incluir Pendências aqui.
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
<?php
} else {
?>
    <style>
        #formEditPendencia {
            display: none;
        }
    </style>
    <script>
        $(function() {
            // EXIBE LISTAGEM DE PENDENCIAS
            list_pendencias();

            // ATIVA CAMPO DATEPICKER
            $("#data_pendencia_form_add, #data_pendencia_form_edit, #prazo_pendencia_form_add, #prazo_pendencia_form_edit").datepicker({
                dateFormat: 'dd-mm-yy'
            });

        });

        // CRIA NOVA PENDENCIA
        function incluirPendencia() {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller' => 'pendencias', 'action' => 'create'), true) ?>",
                data: {
                    acao_id: <?= $this->data['Acao']['id'] ?>,
                    assistido_id: <?= $this->data['Acao']['assistido_id'] ?>,
                    desc_pendencia: $('#formAddPendencia #desc_pendencia').val(),
                    data_pendencia: $('#formAddPendencia #data_pendencia_form_add').val(),
                    prazo_pendencia: $('#formAddPendencia #prazo_pendencia_form_add').val(),
                    status: $('#formAddPendencia input[type=radio][name=statusPendencia_form_add]:checked').val()
                },
                success: function(response) {
                    $('#formAddPendencia #desc_pendencia').val('');
                    const d = new Date();
                    $('#formAddPendencia #data_pendencia_form_add').val(d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear());
                    $('#formAddPendencia #prazo_pendencia_form_add').val('');
                    $('#formAddPendencia input[name=statusPendencia_form_add][value=1]').prop('checked', true);
                    list_pendencias();
                    alert(response);
                }
            });
        };

        // CRIA NOVA PENDENCIA A PARTIR DO TEXTAREA "Informações do Atendimento"
        function incluirObservacaoComoPendencia(descricao) {
            const d = new Date();
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller' => 'pendencias', 'action' => 'create'), true) ?>",
                data: {
                    acao_id: <?= $this->data['Acao']['id'] ?>,
                    assistido_id: <?= $this->data['Acao']['assistido_id'] ?>,
                    desc_pendencia: descricao,
                    data_pendencia: d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear(),
                    prazo_pendencia: '',
                    status: 1,
                },
                success: function(response) {
                    return response;
                }
            });
        };

        // LISTA PENDENCIAS
        function list_pendencias() {
            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'pendencias', 'action' => 'listar'), true) ?>",
                type: "POST",
                data: {
                    acao_id: <?= $this->data['Acao']['id'] ?>,
                },
                beforeSend: function(xhr) {
                    xhr.overrideMimeType("application/x-www-form-urlencoded")
                },
            }).success(function(response) {
                var d = JSON.stringify(eval("(" + response + ")"));
                var dados = JSON.parse(d);
                var datatablePendencias = $("#tabela-pendencias").DataTable({
                    "destroy": true,
                    "data": dados,
                    "order": [
                        [0, "desc"]
                    ],
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "searching": false,
                    "language": {
                        url: "/js/datatable/Portuguese-Brasil.json"
                    },
                    "columns": [{
                        "data": "data_pendencia",
                        "render": function(data, type, row, meta) {
                            dataArr = data.substr(0, 10).split('-');
                            data_pendencia_sem_hora = dataArr[2] + '-' + dataArr[1] + '-' + dataArr[0];
                            return data_pendencia_sem_hora;
                        },
                    }, {
                        "data": "nome",
                    }, {
                        "data": "desc_pendencia",
                        "render": function(data, type, row, meta) {
                            return (data + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + '<br/>' + '$2');
                        }
                    }, {
                        "data": "prazo_pendencia",
                        "render": function(data, type, row, meta) {
                            if (data) {
                                prazoArr = data.substr(0, 10).split('-');
                                prazo_pendencia_sem_hora = prazoArr[2] + '-' + prazoArr[1] + '-' + prazoArr[0];
                                return prazo_pendencia_sem_hora;
                            } else
                                return '-';
                        },
                    }, {
                        "data": "status",
                        "render": function(data, type, row, meta) {
                            if (data == 1)
                                return "<span style='color: red'>Pendente</span>";
                            else
                                return "<span style='color: green'>Resolvido</span>";
                        }
                    }, {
                        "data": "id",
                        "render": function(data, type, row, meta) {
                            id = row['id'];
                            data_pendencia = row['data_pendencia'];
                            if (row['prazo_pendencia'] !== null)
                                prazo_pendencia = row['prazo_pendencia'];
                            else
                                prazo_pendencia = '';
                            desc_pendencia = row['desc_pendencia'].replace(/\n/g, "\\n");
                            status = row['status'];
                            if (row['funcionario_id'] == '<?= $_SESSION['Funcionario']['id'] ?>') {
                                var retorno = '';
                                retorno += '<a title="editar..." style="cursor:pointer" ';
                                retorno += 'onclick="exibeFormEditarPendencia(' + id + ',\'' + data_pendencia + '\',\'' + prazo_pendencia + '\',\'' + desc_pendencia + '\',' + status + ')"';
                                retorno += '><div class="glyphicon glyphicon-edit"></div></a>';
                            } else if (row['defensor_id'] == '<?= isset($listaDefensorIdString) ? $listaDefensorIdString : '' ?>'){
                                var retorno = '';
                                retorno += '<a title="editar2..." style="cursor:pointer" ';
                                retorno += 'onclick="exibeFormEditarPendencia(' + id + ',\'' + data_pendencia + '\',\'' + prazo_pendencia + '\',\'' + desc_pendencia + '\',' + status + ')"';
                                retorno += '><div class="glyphicon glyphicon-edit"></div></a>';
                            } else {
                                retorno = '<div class="glyphicon glyphicon-edit" style="color: lightgrey"></div>';
                            }
                            return retorno;
                        },
                    }, {
                        "data": "id",
                        "render": function(data, type, row, meta) {
                            if (row['funcionario_id'] == '<?= $_SESSION['Funcionario']['id'] ?>'){
                                return '<a title="excluir..." style="cursor:pointer" onclick="if (confirm(\'Confirma excluir a pendência?\')) delPendencia(' + data + ')" ><div class="glyphicon glyphicon-trash"></div></a>'
                            }else if(row['defensor_id'] == '<?= isset($listaDefensorIdString) ? $listaDefensorIdString : '' ?>'){
                                return '<a title="excluir...2" style="cursor:pointer" onclick="if (confirm(\'Confirma excluir a pendência?\')) delPendencia(' + data + ')" ><div class="glyphicon glyphicon-trash"></div></a>'
                            } else{
                                return '<div class="glyphicon glyphicon-trash" style="color: lightgrey"></div>';
                            }                      
                               
                        },
                    }]
                });
            });
        }

        // EDITA PENDENCIA
        function updatePendencia() {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller' => 'pendencias', 'action' => 'update'), true) ?>",
                data: {
                    id: $('#formEditPendencia #id_pendencia').val(),
                    desc_pendencia: $('#formEditPendencia #desc_pendencia').val(),
                    data_pendencia: $('#formEditPendencia #data_pendencia_form_edit').val(),
                    prazo_pendencia: $('#formEditPendencia #prazo_pendencia_form_edit').val(),
                    status: $('#formEditPendencia input[type=radio][name=statusPendencia_form_edit]:checked').val()
                },
                success: function(response) {
                    list_pendencias();
                    alert(response);
                    exibeFormIncluirPendencia();
                }
            });
        }

        // EXCLUI PENDENCIA
        function delPendencia(id) {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller' => 'pendencias', 'action' => 'del'), true) ?>",
                data: {
                    id: id,
                },
                success: function(response) {
                    list_pendencias();
                    alert(response);
                    exibeFormIncluirPendencia();
                }
            });
        }

        // EXIBE FORM PARA EDITAR PENDENCIA
        function exibeFormEditarPendencia(id, data_pendencia, prazo_pendencia, desc_pendencia, status) {
            $('#formEditPendencia #id_pendencia').val(id);
            $('#formEditPendencia #desc_pendencia').val(desc_pendencia);

            dataArr = data_pendencia.substr(0, 10).split('-');
            data_pendencia_sem_hora = dataArr[2] + '-' + dataArr[1] + '-' + dataArr[0];
            $('#formEditPendencia #data_pendencia_form_edit').val(data_pendencia_sem_hora);

            if (prazo_pendencia) {
                prazoArr = prazo_pendencia.substr(0, 10).split('-');
                prazo_pendencia_sem_hora = prazoArr[2] + '-' + prazoArr[1] + '-' + prazoArr[0];
                $('#formEditPendencia #prazo_pendencia_form_edit').val(prazo_pendencia_sem_hora);
            } else {
                $('#formEditPendencia #prazo_pendencia_form_edit').val('');
            }

            if (status == '1')
                $('#formEditPendencia .pend_form_edit').attr('checked', 'checked');
            else if (status == '0')
                $('#formEditPendencia .reso_form_edit').attr('checked', 'checked');

            $('#formAddPendencia').hide();
            $('#formEditPendencia').hide();
            $('#formEditPendencia').show('fast');
        }

        // EXIBE FORM PARA INCLUIR PENDENCIA
        function exibeFormIncluirPendencia() {
            $('#formAddPendencia .pend_form_add').attr('checked', 'checked');
            $('#formEditPendencia').hide();
            $('#formAddPendencia').show('fast');
        }
    </script>

    <!-- LISTA DE PENDÊNCIAS -->
    <div style="padding: 0px; margin: 20px;">
        <table id="tabela-pendencias" class="table table-condensed display" style="width: 100%;">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Criada por</th>
                    <th>Descrição</th>
                    <th>Prazo</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- FORM DE INCLUSÃO -->
    <div style="background-color: lightgrey; padding: 20px; margin: 20px;" id="formAddPendencia">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label>Nova Pendência:</label>
                    <textarea rows="12" class="form-control input-sm" id="desc_pendencia" placeholder="Digite aqui a descrição da nova pendência..."></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            &nbsp;<br />
                            <label>Data:</label><br />
                            <input id="data_pendencia_form_add" type="text" value="<?= date('d-m-Y') ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Prazo:</label><br />
                            <input id="prazo_pendencia_form_add" type="text" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Status:</label><br />
                            <input type="radio" name="statusPendencia_form_add" class="pend_form_add" value="1" checked="checked"> Pendente &nbsp;
                            <input type="radio" name="statusPendencia_form_add" class="reso_form_add" value="0"> Resolvido
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <button onclick="incluirPendencia()" type="button" class="btn btn-primary btn-sm" style="float:none">Incluir Pendência</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM DE EDIÇÃO -->
    <div style="background-color: lightgrey; padding: 20px; margin: 20px;" id="formEditPendencia">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label>Editar Pendência:</label>
                    <textarea rows="12" class="form-control input-sm" id="desc_pendencia" placeholder="Digite aqui a descrição da pendência..."></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            &nbsp;<br />
                            <label>Data:</label><br />
                            <input id="data_pendencia_form_edit" class="" type="text" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Prazo:</label><br />
                            <input id="prazo_pendencia_form_edit" class="" type="text" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Status:</label><br />
                            <input type="radio" name="statusPendencia_form_edit" class="pend_form_edit" value="1"> Pendente &nbsp;
                            <input type="radio" name="statusPendencia_form_edit" class="reso_form_edit" value="0"> Resolvido
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" id="id_pendencia" value="">
                            <button onclick="updatePendencia()" type="button" class="btn btn-primary btn-sm" style="float:none">Salvar</button> &nbsp;
                            <button onclick="exibeFormIncluirPendencia()" type="button" class="btn btn-primary btn-sm" style="float:none">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>