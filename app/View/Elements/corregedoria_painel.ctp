<Style>
 .box-enviar {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: flex-end;
    margin-top: 25px;
 }

</style>

    <?php echo $this->Form->create('Anexo2', array('id' => 'formAnexo2', 'enctype' => "multipart/form-data")); ?>

    <?php echo $this->Form->input('Anexo2.id', array('type' => 'hidden', 'value' => '', 'id' => 'btnHiddenCorr')); ?>

    <?php echo $this->Form->input('Assistido.id', array('type' => 'hidden', 'value' => $idAssistido)); ?>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
            <span style="color: red;">*</span>
                    <label>Data da ocorrência</label>
                    <?php echo $this->Form->text('Anexo2.data_inicio2', array('class' => 'data form-control input-sm')); ?>
           
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

<table id="tblCorregedoria" class="table table-bordered table-striped" style="margin-bottom: 0px;">
    <caption><strong>Tabela de Observações</strong></caption>
    <thead style="background-color: #4BB246; color: white;">

        <tr>
            <th style="vertical-align: middle;width: 100px;text-align: center;">Data</th>
            <th style="vertical-align: middle;width: auto;text-align: center;">Autor</th>
            <th style="vertical-align: middle;width: auto;text-align: center;">Número</th>
            <th style="vertical-align: middle; text-align: center; width: 60%;">Observação</th>
            <th style="vertical-align: middle; text-align: center;width: 120px;">Anexo</th>
            <th style="vertical-align: middle; text-align: center;">Edição</th>
        </tr>
    </thead>
    <tbody id="corpoMainCorr">
        <?php
            
            foreach ($cgdObservacoes  as $key => $aviso) :

            ?>
                <tr>
                    <td style="vertical-align: middle;">
                        <p style='font-size: 12px; margin: 0px;'>
                            <?=$this->Util->ddmmaa2($aviso['cgd']['data_ocorrencia'])?>
                        </p>
                    </td>
                    <td style="vertical-align: middle;">
                        <p style='font-size: 12px; margin: 0px;'>
                            <?=$aviso['pe']['nome']?>
                        </p>
                    </td>
                    <td style="vertical-align: middle; text-align: center;">
                        <p style='font-size: 12px; margin: 0px;'>
                            <?=$aviso['cgd']['id']?>
                        </p>
                    </td>
                    <td style="vertical-align: middle;">
                        <?=$aviso['cgd']['observacao']?>
                    </td>

                    <td style="vertical-align: middle; text-align: center;">

                        <?php if ($aviso['cgda']['id'] != null ): ?>
                        <a  onclick="verAnexo('<?=$aviso['cgd']['id']?>','<?=$_SERVER['REQUEST_URI']?>')" href="">Gerenciar Anexo</a>
                        <?php else: ?>
                            <a  href="#"> - </a>
                        <?php endif; ?>

                    </td>

                    <td class = "classOcultar" style="vertical-align: middle; text-align: center;">
                    <?php if ($aviso['cgd']['funcionario_id'] == $dadosPessoaLogado['funcionario_id'] ): ?>
                        <div style="cursor: pointer;color: green" class="glyphicon glyphicon-edit" title="editar" onclick="Edicao('<?=$aviso['cgd']['id']?>','<?=$_SERVER['REQUEST_URI']?>')"></div>
                        <div style="cursor: pointer;color: green" class="glyphicon glyphicon-trash" title="Apagar" onclick="Apagar('<?=$aviso['cgd']['id']?>','<?=$_SERVER['REQUEST_URI']?>')"></div>
                        <?php else: ?>
                            <div  class="glyphicon glyphicon-edit" title="editar" ></div>
                            <div  class="glyphicon glyphicon-trash" title="Apagar"></div>
                        <?php endif; ?>
                    </td>

                    
                </tr><?php
            endforeach;
        ?>

    </tbody>
</table>

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
    
        $.ajax({
            url: `/CgdAssistidos/getCgdByIdAjax/${id}`, // Your CakePHP 2 controller action URL to handle the AJAX request
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.overrideMimeType("application/x-www-form-urlencoded")
            },
            success: function(response) {

                let de = JSON.stringify(eval("(" + response + ")"));
                let resp = JSON.parse(de);
                console.log("resp")
                console.log(resp)

                $("#enviarCorregedoria").text("Editar");

                $('#btnHiddenCorr').val(resp.CgdAssistidos.id);
                $('#desc_restrita2').val(resp.CgdAssistidos.observacao);

                const formattedDate = formatDate(resp.CgdAssistidos.data_ocorrencia);


                $('#Anexo2DataInicio2').val(formattedDate);
                
                
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
                        row.append('<td>' + item.CgdAssistidoAnexos.data_insert + '</td>');
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
</script>