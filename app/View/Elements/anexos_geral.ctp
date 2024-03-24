<script type="text/javascript">
    $(document).ready(function () {
//        $("#excluirAnexo").on("click", function () { 
        $('.autocomplete-def').select2({

        });

        $(".excluirAnexo").on("click", function () { 
            if (confirm('Deseja realmente excluir o arquivo ?') == true) {
                $(this).parents('tr').remove();
            }
        });
        $("#Anexo0TipoAnexoId").on("change", function () {
            var outro = $(this).val();
            if (outro === '6') {
                $(".outro").show();
            } else {
                $(".outro").hide();
            }
        });
    });
    function excluirAnexoBanco(model, id) {
        $.ajax({
            url: "<?php echo $this->webroot; ?>anexos/removeAnexo/" + model + '/' + id + '/true' + '?trs=1',
            success: function () {
                $('#loading').fadeOut();
                $("#resAnexos").load();
            }
        });
    }
</script>
<html>
    <body>
        <?php 
        if(isset($edit) && $edit){
            echo $this->Form->create('Assistido', array('id' => 'formAssistido', "class" => 'formValidate', 'url' => array('action' => 'add')));
            $idForm = 'formAssistido';
        }    
            ?>
        <?php
        echo $this->Html->script('jquery/jquery.form');
        $this->Util->setaValorPadrao($anexos, null);
        $this->Util->setaValorPadrao($excluiAnexo, false);
        if (count($anexos) > 0) { // Mostra os anexos do model 
            ?>
            <table id="tabelaAnexos" class="table-striped table table-bordered">
                <thead>
                    <tr>
                        <th width="25%">Arquivo Anexado</th>
                        <th width="20%">Tipo Anexo</th>
                        <th width="16%">Descrição</th>
                        <th width="17%">Cadastrado por</th>
                        <th width="12%">Dt Cadastro</th>
                        <th width="20%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($anexos as $key => $value) { $entidade = $value['Model']; ?>
                        <tr>
                            <td align="center"><?php echo $value['Anexo']['filename']; ?></td>
                            <?php 
                            $this->Util->setaValorPadrao($idTipoAnexoOutro, null);
                            if (isset($value['Anexo']['tipo_anexo_id']) && $value['Anexo']['tipo_anexo_id'] == $idTipoAnexoOutro) { ?>
                                <td align="center"><?php echo $this->Util->setaValorPadrao($value['TipoAnexo']['nome']) . ": " . $this->Util->setaValorPadrao($value['Anexo']['outro']); ?></td>
                            <?php } else { ?>
                                <td align="center"><?php echo $this->Util->setaValorPadrao($value['TipoAnexo']['nome']); ?></td>                    
                            <?php } ?>
                            <td align="center"><?php echo $this->Util->setaValorPadrao($value['Anexo']['descricao']); ?></td>
                            <td align="center"><?php echo $value['Pessoa']['nome']; ?></td>
                            <td align="center"><?php echo $this->Util->aammddHis($value['Anexo']['dt_cadastro']); ?></td>
                            <td align="center">
                                <?php echo $this->Html->link($this->Html->image('mimetypes/application-pdf.png', array('title' => 'Baixar', 'escape' => false)), array('controller' => 'anexos', 'action' =>"view/$model/" . $value['Anexo']['id'] . '?trs=1'), array('target' => '_blank', 'escape' => false)); ?>
                                <?php echo ($value['Funcionario']['id'] == $dadosLogado['funcionario_id'] || $excluiAnexo == true) ? $this->Html->link($this->Html->image("icones24/delete.png", array("title" => 'Excluir o arquivo', 'id' => 'excluirAnexo')), "javascript: excluirAnexoBanco('$entidade'," . $value['Anexo']['id'] . ")", array("class" => 'xFile excluirAnexo', "escape" => false)) : " " ?>
                            </td>                    
                        </tr>
                    <?php } ?>
                </tbody>
            </table><br />
            <div id="resAnexos"></div>
        <?php } ?>
        <!-- Novo -->
        <?php //echo $this->Form->create('Anexo', array('id' => 'formAnexo', 'enctype' => "multipart/form-data")); ?>
        <table id="resFile" class="table-striped table table-bordered">
            <thead>
                <tr>
                    <th class="col-md-4 col-xl-4 col-xs-4">Descrição</th>
                    <th class="col-md-2 col-xl-2 col-xs-2">Tipo do Anexo</th>
                    <th class="outro" style="display: none;">Outro Tipo*</th>
                    <?php if(isset($listaDefensores) && $listaDefensores){ ?>
                    <th class="col-md-3 col-xl-3 col-xs-3">Notificar defensor(a)/funcionario(a) por e-mail</th>
                    <?php } ?>
                    <th class="col-md-1 col-xl-1 col-xs-1">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center"><?php echo $this->Form->input("Anexo.0.descricao", array("size" => 35, "maxlength" => 120, "label" => false, 'class' => 'form-control input-sm')) ?></td>
                    <td align="center"><?php
                        $args = array(
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Anexo.0.tipo_anexo_id", $tipoAnexos, $args)
                        ?></td>
                    <td align="center" class="outro" style="display: none;"><?php echo $this->Form->input("Anexo.0.outro", array("size" => 25, "maxlength" => 120, "label" => false)) ?></td>        
                    <?php if(isset($listaDefensores) && $listaDefensores){ ?>
                    <td align="center">
                        <div class="form-group">
                                    <?php 
                                    echo $this->Form->select("Anexo.0.defensor_notificado_id", $listaDefensores, array(
                                        'empty' => 'Selecione',
//                                        'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
                                        'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
                                        'multiple'=>'multiple'
                                    )) ?>
                                    </div>
                    </td>
                    <?php } ?>
                    <td align="center"><?php echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upFile btn btn-default', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'img-up-1')); ?></td>
                </tr>
                <tr>
                    <td style="text-align: right">Arquivo:</td>
                    <td colspan="3"><?php echo $this->Form->file('Anexo.0.arquivo', array("class" => 'btn btn-default', 'type' => 'file', 'multiple')); ?></td>
                </tr>
            </tbody>
        </table>
        <?php 
        if(isset($atos)){ 
            $url = Configure::read('URL_ACESSO_PAINEL');
        ?>
        <table class="table-striped table table-bordered">
            <thead>
                <tr>
                    <th>Processo</th>
                    <th>Observação</th>
                    <th>Arquivo</th>
                    
                </tr>
            </thead>
            <tbody>
                
        <?php
            foreach($atos as $key => $value){ ?>
                <tr>
                    <td><?= $value['Processo']['numeracao_unica'] ?></td>
                    <td><?= $value['AtoPraticadoProcesso']['observacao'] ?></td>
                    <td><a download="asdsad" href=<?= $url. "/files/upload/AtoPraticadoProcessos/" . $value['AtoPraticadoProcesso']['nome_arquivo'] ?> onclick='' target="blank">
                            <span class="glyphicon glyphicon-download" style="color:#0d582d">
                                <!--<img src="/img/icons/glyphicons-201-download.png" >-->
                            </span></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php } ?>
            
        <br>
        <sub class="label label-danger">Arquivos permitidos: .pdf ("Tamanho máximo 10MB")</sub>
        <br />
        <div id="message"></div>
        <div id="result"></div>
        <div id="lista_anexos" style="margin-top: 15px"></div>
        <input type="submit" id="save_file_submit" style="display: none;" />
        <?php 
        if(isset($edit) && $edit){
            echo $this->Form->end(); 
        }
        ?>
        <br />
        <!-- Novo -->
        
        <script type="text/javascript">

var downlod_anexos_em_lote = [];
        var idAnexo = "";
        var idFuncionarioCorrente = "";
        var listaDadosFuncionarios = [];
        var dadosAnexoSigilosos = "";
        var idUsuarioCorrente = "";

        function get_id_anexo_download(checkboxElem) {

            try {

                if (checkboxElem.checked) {
                    downlod_anexos_em_lote.push(checkboxElem.value);
                } else {
                    downlod_anexos_em_lote = jQuery.grep(downlod_anexos_em_lote, function(value) {
                        return value != checkboxElem.value;
                    });

                }
            } catch (error) {
                console.log(error);
            }
            //console.log(downlod_anexos_em_lote);
        }

        function download_lote() {

            try {

                if (!downlod_anexos_em_lote.length) {

                    alert('Nenhum arquivo selecionado');
                    return false;
                }

                $.ajax({
                    url: '/anexos/anexo_download_lote/?trs=1',
                    dataType: 'text',
                    data: {
                        // idAnexo: $('.downlod-anexos-em-lote').val()
                        idAnexo: downlod_anexos_em_lote
                    },
                    success: function(response) {
                        if (response) {
                            location.href = '/anexos/open_zip/' + response + '?trs=1';
                        }
                    }
                });

            } catch (error) {

                console.log(error);

            }

        }
            $(document).ready(function () {
                $('.upFile').click(function () {
                    var form = document.getElementById('<?php echo $idForm; ?>');
                    var formData = new FormData(form);
                    if ($('#Anexo0Arquivo').val() === '') {
                        alert('Selecione um arquivo');
                        return false;
                    }
                    if ($('#Anexo0TipoAnexoId').val() === '') {
                        alert('Selecione o tipo de anexo');
                        return false;
                    }
                    $.ajax({
                        url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'upload', $model, '?' => array('trs' => 1)), true) ?>",
                        type: 'POST',
                        beforeSend: showRequest,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $('#lista_anexos').html(data);
                        }
                    });
                });
            });

            // Exclui um anexo
            $("body").delegate(".deleteAnexo", "click", function (e) {
                e.preventDefault();
                var teste = $(this).parents(".name-file").text();
                $(this).parents("tr").remove();
            });

            function atualizaListaUpload() {
                var nameFile = $('#Anexo0Arquivo').val();
                var descricao = $('#Anexo0Descricao').val();
                if (descricao == '') {
                    descricao = '-';
                }
                var newLine = "<tr><td><span class='label'>" + descricao + "</td><td><span class='label name-file'>" + nameFile + "</td><td align='center'>" + '<?php echo $this->Html->link($this->Html->image("icones16/delete16.png", array("border" => 0, "alt" => 'Excluir', "title" => 'Excluir anexo')), "javascript: void(0)", array("class" => 'deleteAnexo', "escape" => false)); ?>' + "</td></tr>";
                $('#Anexo0Descricao').val('');
                $('#Anexo0Arquivo').val('');
                $("#resFile tr:last").after(newLine);
            }

            function showRequest(formData, jqForm, options) {
                var fileToUploadValue = $('#Anexo0Arquivo').fieldValue();
                var meuPDF = document.getElementById('Anexo0Arquivo');
                if (meuPDF.files[0].size > 10485760) {
                    document.getElementById('message').innerHTML = '<span style="color:red;"><b>Selecione um documento menor que 10MB.</b>';
                    return false;
                } else if (!fileToUploadValue[0]) {
                    document.getElementById('message').innerHTML = '<span style="color:red;"><b>Selecione um documento.</b>';
                    return false;
                }

                return true;
            }

            function excluiAnexo(model, id) {
                $.ajax({
                    url: "<?php echo $this->webroot; ?>anexos/removeAnexo/" + model + '/' + id + '?trs=1',
                    success: function (data) {
                        $('#lista_anexos').html(data);
                    }
                });
            }
        </script>
    </body>
</html> 