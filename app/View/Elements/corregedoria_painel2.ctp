<Style>
 .box-enviar {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: flex-end;
    margin-top: 25px;
 }

.table-box-corr{
    border: 2px solid #CCCCCC;
    margin-top: 20px;
    
}
.table-box-corr-child{
    background-color: #d5d5d5;
    padding: 10px;
    color: #136938;
    margin-bottom: 10px;
}
.table-box-corr-child2{
    padding: 10px;
}
.table-box-max {
    display: flex;
    width: 100%;
    justify-content: end;
}
.table-box2 {
    display: flex;
    margin-left: 20px;
    justify-content: end;
}
.btnTabCor {
    background-color: #5CB661;
    border: none;
    border-radius: 5px;
    padding: 4px 16px;
    margin-bottom: 7px;
    color: #fff
}
.add-movimentacao{
    cursor: pointer;
}
.clicable {
    cursor: pointer;
    color: green;
}

.eye-box {
    display: flex;
    width: 100%;
    height: 100%;
    justify-content: center;
}
#corpoMainCorrTable {
    display: none;
    transition: display 0.5s ease; /* Adjust the transition duration and timing function as needed */
}
</style>
<div class="table-box-max">
    <div class="table-box2">
        <a class="btn btn-success" href="/assistidos/lista_corregedoria/?trs=1">OCORRÊNCIAS</a>
    </div>
    <div class="table-box2">
        <button type="button" id="showDivButton" class="btn btn-primary">Novo Atendimento</button>
    </div>
</div>



<?php

?>
<div class="table-box-corr">
    <div class="table-box-corr-child">
        Histórico de atendimento da corregedoria
    </div>
    <div class="table-box-corr-child2">
        <?php
        if(!empty($cgdObservacoes)):
           
        foreach ($cgdObservacoes  as $key => $aviso) :
            
        ?>  

            <table class="table table-bordered table-striped" style="margin-bottom: 5px">
           
                <thead style="background-color: #359D54; color: white;">
                    <tr>
                        <th style="vertical-align: middle;width: 100px;text-align: center;">Número</th>
                        <th style="vertical-align: middle;width: auto;text-align: center;">Autor do atendimento</th>
                        <th style="vertical-align: middle;width: auto;text-align: center;">Exibir atendimentos</th>
                    </tr>
                </thead>
                <tbody id="corpoMainCorr">

                    <tr>
                        <td style="vertical-align: middle;text-align: center;">
                            <p style='font-size: 12px; margin: 0px;'>
                                <?= $aviso['id'] ?>
                            </p>
                        </td>
                        <td style="vertical-align: middle;">
                            <p style='font-size: 12px; margin: 0px;text-align: center;'>
                                <?= $aviso['cgdh'][0]['nome'] ?>
                            </p>
                        </td>
                        <td style="vertical-align: middle;">
                            <p  style='font-size: 12px; margin: 0px;text-align: center;'>
                                <div onclick="toggleTableVisibility('<?= $aviso['id'] ?>')"  class=" eye-box glyphicon glyphicon-eye-open clicable"></div>
                            </p>
                        </td>
                    
                    </tr>


                </tbody>
            </table>

            <table class="table table-bordered table-striped" id="corpoMainCorrTable<?= $aviso['id'] ?>" style="margin-bottom: 25px">
           
                <thead style="background-color: #fff; color: green;">
                    <tr>
                        <th style="vertical-align: middle;width: 100px;text-align: center;">Data</th>
                        <th style="vertical-align: middle;width: auto;text-align: center;width: 107px;">Ato praticado</th>
                        <th style="vertical-align: middle;width: auto;text-align: center;">Detalhamento</th>
                        <th style="vertical-align: middle; text-align: center; ">ações</th>
                    </tr>
                </thead>
                <tbody id="corpoMainCorr">
                        <?php
                        
                        foreach ($aviso['cgdh']  as $key2 => $aviso2) :

                        ?>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <p style='font-size: 12px; margin: 0px;'>
                                        <?=$this->Util->ddmmaa2($aviso2['data_ocorrencia'])?>
                                    </p>
                                </td>
                                <td style="vertical-align: middle;">
                                    <p style='font-size: 12px; margin: 0px;'>
                                    <?php if(isset($aviso2['atos'])): ?>
                                        <?php foreach ($aviso2['atos']  as $key3 => $aviso3) : ?>
                                          <p>  <?= $key3+1 .") ". $aviso3 ?></p>
                                        <?php  endforeach;?>
                                    <?php endif?>
                                    <?php if(!isset($aviso2['atos'])):?>
                                        <?= "ND" ?>
                                    <?php endif?>
                                    </p>
                                </td>
                                <td style="vertical-align: middle;">
                                    <p style='font-size: 12px; margin: 0px;'>
                                        <?= $aviso2['observacao'] ?>
                                    </p>
                                </td>
                                <td class = "classOcultar" style="vertical-align: middle; text-align: center;">
                                <div style="cursor: pointer;color: green" class="glyphicon glyphicon-list-alt" title="Opções de anexo" onclick="verAnexo('<?=$aviso2['id']?>','<?=$_SERVER['REQUEST_URI']?>')"></div>
                                    <div style="cursor: pointer;color: green" class="glyphicon glyphicon-edit" title="editar" onclick="Edicao('<?=$aviso2['id']?>','<?=$_SERVER['REQUEST_URI']?>')"></div>
                                        <?php if ($key2 == 0): ?>
                                            <div style="cursor: pointer;color: green" class="glyphicon glyphicon-trash" title="Apagar primeiro atendimento e todo o cadastro" onclick="ApagarAll('<?=$aviso2['id']?>','<?=$_SERVER['REQUEST_URI']?>')"></div>
                                        <?php else: ?>
                                            <div style="cursor: pointer;color: green" class="glyphicon glyphicon-trash" title="Apagar" onclick="Apagar('<?=$aviso2['id']?>','<?=$_SERVER['REQUEST_URI']?>')"></div>
                                        <?php endif; ?>
                                </td>
                            </tr>
 
                            <?php
                        endforeach;

                    ?>
                        <tr>
                            <td colspan="4" style="vertical-align: middle;text-align: center;"  onclick="movimentacao('<?=$aviso['id']?>',this)">
                                <a style='font-size: 12px; margin: 0px;' class="add-movimentacao">
                                    <?= "Adicionar movimentação ao atendimento" ?>
                                </a>
                            </td>
                        </tr>
                </tbody>
            </table>

        <?php
        endforeach; ?>
        <?php else:?>
       
        <p>Não há atendimentos registrados.</p>
        <?php endif; ?>
    </div>

</div>

<div>
    <table id="tblCorregedoria_anexos" class="table table-bordered table-striped" style="margin-top: 20px; display: none;">
        <caption><strong>Tabela de Anexos</strong></caption>   
        <thead style="background-color: #4BB246; color: white;">
        
            <tr>
                <th style="vertical-align: middle;">Data</th>
                <th style="vertical-align: middle;">Autor</th>
                <th style="vertical-align: middle;">Descrição do documento</th>
                <th  style="vertical-align: middle; text-align: center;">Opções</th>

            </tr>
        </thead>
        <tbody id="corpoAnexoCorr">
        </tbody>
    </table>
</div>

<div class="table-box-corr" id="hiddenDiv" style="display: none;" >

    <div class="table-box-corr-child" id="headerBoxCorr">
            Formulario de adição do atendimento
    </div>
    <div class="table-box-corr-child2">
        <?php echo $this->Form->create('Anexo2', array('id' => 'formAnexo2', 'enctype' => "multipart/form-data")); ?>

        <?php echo $this->Form->input('Anexo2.id', array('type' => 'hidden', 'value' => '', 'id' => 'btnHiddenCorr')); ?>

        <?php echo $this->Form->input('Anexo2.referencia_id', array('type' => 'hidden', 'value' => '', 'id' => 'btnHiddenRefCorr')); ?>

        <?php echo $this->Form->input('Assistido.id', array('type' => 'hidden', 'value' => $idAssistido)); ?>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                <span style="color: red;">*</span>
                        <label>Data da ocorrência</label>
                        <?php echo $this->Form->text('Anexo2.data_inicio2', array('class' => 'data form-control input-sm')); ?>
            
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <span style="color: red;">*</span>
                        <label>Ato Praticado</label>
                        <?php 
                            $args = array(
                            'class' => 'form-control input-sm selectMultiplo set-width-multiselect',
                            'empty' => 'Selecionar',
                            'multiple' => 'multiple',
                            //'default' => $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') != "" ? $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') : "",
                            //'disabled' => $this->Session->read('dadosAnexoSigilosos') != "" ? true : false
                            );
                        echo $this->Form->select("Anexo2.ato_praticado",  $cgdTipoAtos, $args);?>
            
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <span style="color: red;">*</span>
                    <label>Observação</label>
                    <?php echo $this->Form->textarea('Anexo2.descricao_restrita2', array('rows'	=>	'3', 'class' => 'form-control', 'label'	=>	false, 'id'	=>	'desc_restrita2',));?>
            
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <table class="table-striped table table-bordered" style="margin-top: 20px">
                
                    <thead>
                        <tr>
                            <th colspan="2" style="width: 50%;"><span style="color: red;">* </span>Selecionar o documento</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="CampoAnexoArquivo">
                                <label>Anexo</label>
                                <?php echo $this->Form->file('Anexo2.arquivo.', array("class" => 'multiple btn btn-default', 'multiple')); ?>
                            </td>
                            <td>
                            <label>Descrição do documento</label>
                                <?php echo $this->Form->input("Anexo2.descricao2", array("size" => 35, "maxlength" => 120, "label" => false, 'class' => 'form-control input-sm')) ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>
        <div class="row">
            <div class="col-md-2" style=" float: right;">
                <div class="box-enviar">
                    <button class="btn btn-primary" id="enviarCorregedoria">Enviar</button>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>


<script>
    let ffuncionarioId =  <?= $dadosPessoaLogado['funcionario_id']  ?>

    $('#Anexo2DataInicio2').val($.datepicker.formatDate( "dd/mm/yy", new Date()))  

    $('#enviarCorregedoria').click(function() {
        event.preventDefault();

        var form2 = document.getElementById('formAnexo2');
        // var model = document.getElementById('AnexoModel');
        var formData2 = new FormData(form2);
        var tamanho = $('#Anexo2Arquivo').val().length;
        var objText1 = document.getElementById("Anexo2Arquivo");          

        if ($('#desc_restrita2').val() === '') {
            alert('Adicione uma Observação antes de enviar');

            return false;
        }
        

       /*
        if ($('#AnexoTipoAnexoId').val() == null || $('#AnexoTipoAnexoId').val() == '') {
            alert('Selecione o tipo de anexo');
            return false;
        }
        if ($('#AnexoDescricao').val() === '') {
            alert('Adicione uma Descrição');

            return false;
        }
        */

        //Verifica se existe a mesma quantidade de arquivos para a quantidade de arquivos
        var qntArquivos = $("#Anexo2Arquivo")[0].files.length; // retorna a quantidade int 1,2,3 ou 0
        
        console.log(qntArquivos)

        if(qntArquivos > 0){
            if ($('#Anexo2Descricao2').val() === '') {
                alert('Adicione uma descrição do documento para o anexo do arquivo.');

                return false;
            }
        }

        //Para verificar se o tamanho do arquivo é maior que 10MB
        for (var i = 0; i < qntArquivos; i++) {
            var tamanho = $("#Anexo2Arquivo")[0].files[i].size;
            if (tamanho > 10485760) {
                alert("Selecione arquivo menor que 10MB.");
                return false;
            }
            
            var nome_origem = $("#Anexo2Arquivo")[0].files[i].name;
            var arquivoOriginal = $("#Anexo2Arquivo")[0].files[i];
            if ( /[^A-Za-z\d]/.test(nome_origem)) {
                var remove = /[^a-z0-9|\.]/gi; 
                var nome_novo = nome_origem.replace(remove, "");
                
                var fileName = document.getElementById('Anexo2Arquivo');
                
                Object.defineProperty(arquivoOriginal, 'name', {
                writable: true,
                value: nome_novo
                }); 

                Object.defineProperty(arquivoOriginal, 'tmp_name', {
                writable: true,
                value: nome_novo
                });           
            
                /*
                alert("O nome do arquivo não pode ter caracter especial."); */
                //return false;                   
            }
            
        }

        $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'upload_multiplos_anexos_corregedoria', '?' => array('trs' => 1)), true) ?>",
            type: 'POST',
            //beforeSend: showRequest,
            data: formData2,
            processData: false,
            contentType: false,
            success: function(result) {

                var d = JSON.stringify(eval("(" + result + ")"));
                var dados = JSON.parse(d);

                if (dados.retorno) {
                    alert('Observação enviada com sucesso.')
                    // Get the current URL
                    var currentURL = window.location.href;
                    
                    if (currentURL.indexOf('inst=3') == -1) {
                        // Add '&inst=2' to the URL if it doesn't already exist

                        var currentURL = window.location.href;
                        var newURL = currentURL.split('?')[0] + '?inst=3';
                        window.location.href = newURL;
                        return;
                    }
                    window.location.href = currentURL;
                    location.reload()

                } else {
                    alert('Houve um erro no envio do documento da corregedoria')
                    location.reload();
                }

                //$('#lista_anexos').html(data);
            }
        });
    });

    function Edicao(id, requestURI) {
        // Make an AJAX call to the CakePHP 2 backend
        cleanForm()
        $.ajax({
            url: `/CgdAssistidos/getCgdByIdAjax/${id}`, // Your CakePHP 2 controller action URL to handle the AJAX request
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.overrideMimeType("application/x-www-form-urlencoded")
            },
            success: function(response) {
                $("#hiddenDiv").show();
                let de = JSON.stringify(eval("(" + response + ")"));
                let resp = JSON.parse(de);
                console.log("resp")
                console.log(resp)
                
                $("#enviarCorregedoria").text("Editar");

                
                $('#btnHiddenCorr').val(resp[0].CgdAssistidoHistoricos.id);
                $('#desc_restrita2').val(resp[0].CgdAssistidoHistoricos.observacao);

                const formattedDate = formatDate(resp[0].CgdAssistidoHistoricos.data_ocorrencia);

                $('#Anexo2DataInicio2').val(formattedDate);

                // Assuming resp is an array of objects and you want to iterate over it
                // Assuming resp is an array of objects and you want to iterate over it
                if(resp[0].cgd_assistido_atos.id != null){
                    const simpleArray = resp.map(item => {
                        return [
                            item.cgd_assistido_atos.cgd_tipo_ato_id
                        ]
                    });

                    $('#Anexo2AtoPraticado').val(simpleArray); 
                    $('#Anexo2AtoPraticado').trigger('change'); 
                    console.log("entrou")
                }

            },
            error: function(xhr, textStatus, errorThrown) {
            // Handle error if the AJAX request fails
            console.error('Error:', errorThrown);
            }
        });
    }

    function eraseFile(cgdAnexosid, requestURI) {

        event.preventDefault();


        if (!confirm('Você tem certeza que deseja excluir esse item ?')) {
            return; // User canceled the delete operation
        }
        // Make an AJAX call to the CakePHP 2 backend to delete the item
        $.ajax({
            url: `/CgdAssistidos/apagarAnexo/${cgdAnexosid}`, // Append the id to the URL for the delete action
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.overrideMimeType("application/x-www-form-urlencoded")
            },
            success: function(response) {
                let de = JSON.stringify(eval("(" + response + ")"));
                let resp = JSON.parse(de);

                if(resp.status == "success"){
                    alert('Registro deletado com sucesso!');
                    console.log(response)
                    // Get the current URL
                    var currentURL = window.location.href;
                    
                    if (currentURL.indexOf('inst=3') === -1) {
                        // Add '&inst=2' to the URL if it doesn't already exist
                        var currentURL = window.location.href;
                        var newURL = currentURL.split('?')[0] + '?inst=3';
                        window.location.href = newURL;
                        return;

                    }
                    window.location.href = currentURL;
                    location.reload()
                }else{
                    alert('Falha ao deletar o registro. Por favor, contate o suporte');
                }

            },
            error: function(xhr, textStatus, errorThrown) {
            // Handle error if the AJAX request fails
            console.error('Error:', errorThrown);
            alert('Falha ao deletar o registro. Por favor, contate o suporte');
            }
        });

    }

    function Apagar(id, requestURI) {
        // Confirm with the user before proceeding with the delete operation
        if (!confirm('Você tem certeza que deseja excluir esse item ? Qualquer anexo vinculado será apagado.')) {
            return; // User canceled the delete operation
        }

        // Make an AJAX call to the CakePHP 2 backend to delete the item
        $.ajax({
            url: `/CgdAssistidos/apagarCgdByIdAjax/${id}`, // Append the id to the URL for the delete action
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.overrideMimeType("application/x-www-form-urlencoded")
            },
            success: function(response) {
                let de = JSON.stringify(eval("(" + response + ")"));
                let resp = JSON.parse(de);

                if(resp.status == "success"){
                    alert('Registro deletado com sucesso!');
                    console.log(response)
                    // Get the current URL
                    var currentURL = window.location.href;
                    
                    if (currentURL.indexOf('inst=3') === -1) {
                        // Add '&inst=2' to the URL if it doesn't already exist
                        var currentURL = window.location.href;
                        var newURL = currentURL.split('?')[0] + '?inst=3';
                        window.location.href = newURL;
                        return;

                    }
                    window.location.href = currentURL;
                    location.reload()
                }else{
                    alert('Falha ao deletar o registro. Por favor, contate o suporte');
                }

            },
            error: function(xhr, textStatus, errorThrown) {
            // Handle error if the AJAX request fails
            console.error('Error:', errorThrown);
            alert('Falha ao deletar o registro. Por favor, contate o suporte');
            }
        });
    }

    function ApagarAll(id, requestURI) {
        // Confirm with the user before proceeding with the delete operation
        if (!confirm('Você tem certeza que deseja excluir esse item ? Qualquer anexo vinculado será apagado.')) {
            return; // User canceled the delete operation
        }

        // Make an AJAX call to the CakePHP 2 backend to delete the item
        $.ajax({
            url: `/CgdAssistidos/apagarAllCgdByIdAjax/${id}`, // Append the id to the URL for the delete action
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.overrideMimeType("application/x-www-form-urlencoded")
            },
            success: function(response) {
                let de = JSON.stringify(eval("(" + response + ")"));
                let resp = JSON.parse(de);

                if(resp.status == "success"){
                    alert('Registro deletado com sucesso!');
                    console.log(response)
                    // Get the current URL
                    var currentURL = window.location.href;
                    
                    if (currentURL.indexOf('inst=3') === -1) {
                        // Add '&inst=2' to the URL if it doesn't already exist
                        var currentURL = window.location.href;
                        var newURL = currentURL.split('?')[0] + '?inst=3';
                        window.location.href = newURL;
                        return;

                    }
                    window.location.href = currentURL;
                    location.reload()
                }else{
                    alert('Falha ao deletar o registro. Por favor, contate o suporte');
                }

            },
            error: function(xhr, textStatus, errorThrown) {
            // Handle error if the AJAX request fails
            console.error('Error:', errorThrown);
            alert('Falha ao deletar o registro. Por favor, contate o suporte');
            }
        });
    }

    function verAnexo(id, requestURI) {
        // Make an AJAX call to the CakePHP 2 backend
        event.preventDefault();

        let dataLoaded = true;

        // Check if data is loaded
        if (dataLoaded) {
            // Show the table
            $('#tblCorregedoria_anexos').show();
        }

        $.ajax({
            url: `/CgdAssistidos/getAnexoCgdByIdAjax/${id}`, // Your CakePHP 2 controller action URL to handle the AJAX request
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.overrideMimeType("application/x-www-form-urlencoded")
            },
            success: function(response) {

                let de = JSON.stringify(eval("(" + response + ")"));
                let resp = JSON.parse(de);

                console.log(resp)
                console.log("resp")
                var tbody = $('#corpoAnexoCorr');
                tbody.empty(); // Clear existing table rows

                if (Array.isArray(resp) && resp.length === 0) {
                    // If resp is an empty array, append a row saying "This table has no information"
                    var noInfoRow = $('<tr><td colspan="5" style="text-align: center;">Não houve anexos a essa observação. </td></tr>');
                    tbody.append(noInfoRow);
                } else {
                    // Iterate over the data and populate table rows
                    resp.forEach(function(item) {
                        var row = $('<tr>');
                        row.append('<td>' + formatDateTime(item.CgdAssistidoAnexos.data_insert) + '</td>');
                        row.append('<td>' + item.pe.nome + '</td>');
                        row.append('<td>' + item.anexos.descricao + '</td>');

                        // row.append('<td style="text-align: center;">download eraser </td>'); // modify

                        // Download link

                        if(ffuncionarioId ==item.anexos.funcionario_id ){
                            row.append('<td style="text-align: center;"><a class="glyphicon glyphicon-eye-open" title="Visualizar Anexo" href="/CgdAssistidos/view/' + item.CgdAssistidoAnexos.id  + '" target="_blank" ></a>'+
                        '<a class="glyphicon glyphicon-download-alt" style="margin-left: 10px;margin-right: 10px;" title="Download Anexo" href="/CgdAssistidos/download/' + item.CgdAssistidoAnexos.id  + '" download></a>'+
                        '<a class="glyphicon glyphicon-remove"  title="remover Anexo" href="#" onclick="eraseFile(' + item.CgdAssistidoAnexos.id  + ')"></a></td>');

                        }else{
                            row.append('<td style="text-align: center;"><a class="glyphicon glyphicon-eye-open" title="Visualizar Anexo" href="/CgdAssistidos/view/' + item.CgdAssistidoAnexos.id  + '" target="_blank" ></a>'+
                        '<a class="glyphicon glyphicon-download-alt" style="margin-left: 10px;margin-right: 10px;" title="Download Anexo" href="/CgdAssistidos/download/' + item.CgdAssistidoAnexos.id  + '" download></a></td>');

                        }
                        tbody.append(row);
                    });

                }
                
            },
            error: function(xhr, textStatus, errorThrown) {
            // Handle error if the AJAX request fails
            console.error('Error:', errorThrown);
            }
        });
    }

    function formatDate(inputDate) {
        const date = new Date(inputDate);
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are 0-based
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    function formatDateTime(inputDateTime) {
        const parts = inputDateTime.split(' ');
        const datePart = parts[0];
        const timePart = parts[1];

        const dateParts = datePart.split('-');
        const year = dateParts[0];
        const month = dateParts[1];
        const day = dateParts[2];

        return `${day}-${month}-${year}`;
    }
    function movimentacao(param, button) {
        cleanForm()
        $("#hiddenDiv").show();
        $("#btnHiddenRefCorr").val(param);
        $("#headerBoxCorr").css("background-color", "#80C683");
        $(button).css("background-color", "#80C683");
    }
    function cleanForm() {
        $('#Anexo2AtoPraticado').val(0).trigger('change');
        $("#btnHiddenCorr").val('');
        $("#btnHiddenRefCorr").val('');
        $("#desc_restrita2").val('')

    }

    function toggleTableVisibility(id) {
        let name = "#corpoMainCorrTable" + id;
        $(name).toggle();
    }

    $("#showDivButton").click(function() {
      //  $("#btnHiddenCorr").val('');
      //  $("#btnHiddenRefCorr").val('');
      cleanForm()
        $("#hiddenDiv").show();
    });
</script>