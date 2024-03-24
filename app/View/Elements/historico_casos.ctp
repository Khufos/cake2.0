<style>
    .margin-bottom {

        margin-bottom: 10px;
        box-shadow: 0px 1px 0px #091e4240;
    }

</style>
<?php echo $this->Html->css('notificacao'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        printHistorico();
        $('.historicoCasos').click(function () { // exibe tabela de supensão       
            $('#tableHistoricoCasos').slideToggle('slow');
        });

        $('#ExibeCampoAnexo').click(function () { // exibe tabela de supensão       
            document.getElementById('envioAnexos').style.display = 'block';
        });

        $('#Imprimir').click(function () {
            var checado = false;
            $(".printHistorico tr").find(".cbAcao").each(function (index) {
                if ($(this).is(':checked'))
                    checado = true;

            });

            if (!checado) {
                alert("Deve ser selecionado uma ação");
                return false;
            }
        });
    });

    $(document).ready(function () {
        $('.informarAssitido').on('click', function(){            
            $(this).off()
            $(".printHistorico tr").not(":first").click(function () {
                $('#observacaoInfo').val($(this).find('.content')[0].textContent);
                $('#IdHistorico').val($(this).find('.idHistoricoModal')[0].textContent)

            });
        })        

        $('.AnexoDelected').on('click',function(){
            $('.inserirNovoAnexo').hide();
        })

        $('.AnexoSelected').on('click',function(){
            $('.inserirNovoAnexo').show();
        })

        $('.sendEmail').on('click',function(){            
//          var idAcaoHistorico = $('.informarAssitido').attr('id');
            var idAcaoHistorico = $('#IdHistorico').val();    //        
//          idAcaoHistorico = idAcaoHistorico.substring(2);
            let idtipox = $("#ab"+idAcaoHistorico).val();    // 
            var idAssistido = <?= isset($idAssistido) ? $idAssistido :'' ?>;//
            var url = $('#NotificacaoUrl').val();//

            $.post("/notifica_assistidos/informar", 
            {
                idAssistido: idAssistido, 
                idAcaoHistorico: idAcaoHistorico, 
                url: url,
                idtipox: idtipox,
                idAnexo: downlod_anexos_em_lote
            }, 
            function( data ) {
                if(data != 0){
                    $('#ModalInformarAssitido').modal('toggle');
                    $('#email-alert-success').show(800).delay(800).hide(800);
                    setTimeout(alert("E-mail enviado com sucesso!", 2000));
                }else{
                    $('#ModalInformarAssitido').modal('toggle');
                    $('#email-alert-danger').show(800).delay(800).hide(800);
                    setTimeout(alert("Não foi possível enviar o e-mail", 2000));
                }
                $('#notificadoSimNao').text('Sim');
            });
        })        

        $('#anexarDocumentoModal').click(function() {
                var form = document.getElementById('testeForm');
                var formData = new FormData(form);

                $.ajax({
                    url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'uploadAnexo', $model, '?' => array('trs' => 1)), true) ?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#lista_anexos').html(data);                        
                        $("#lista").load(window.location.href + " #lista" );
                        $("#UpFile").load(window.location.href + " #UpFile" );
                        alert('Arquivo adicionado com sucesso!');                        
                        //$("#AnexoArquivoInfoAssistido").empty();
                    }
                });
            });
    });

</script>

<!-- Modal -->
<div class="modal fade" id="ModalInformarAssitido" tabindex="-1" role="dialog" aria-labelledby="InformarAssitidoLabel" aria-hidden="true">
<div class="modal-dialog" role="document" style="width: 50%; scroll-behavior: auto; ">
    <div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title"><center>Encaminhar e-mail para o assistido</center></h3>
    </div>
    <div class="modal-body">        
        <form id="testeForm">
<!--        <h4>Dados de envio</h4>  -->
            <div style="backgroud: #FFFFFF; border-radius: 8px; display:flex;flex-direction: column;">
                <!--
                <p style="color: red;"> ATENÇÃO! Os anexos carregados aqui devem ser apenas informativos pois os dados que serão atribuídos não serão sigilosos.</p> -->
                
                <input id='IdAcao' name="IdAcao" value="<?php echo isset($idAcao) ? $idAcao : '' ?>" style="display: none;"/>
                <h4>Observação selecionada:</h4>
                <textarea id="observacaoInfo" disabled style="resize: none; border: 1px #c4c4c4; padding: 4px; background-color: Silver;">
                </textarea>
                <input id='IdHistorico' name="IdHistorico" value="" style="display: none;"/>                
                </p>
                <div class="col-md-2 col-xl-4" style=" margin-left: 40px;">
                <button type="button" id="ExibeCampoAnexo" class="btn btn-success btn-sm">Anexar um documento</button>  
                </div>              
                <div id="envioAnexos" style="display: none;">
                    <br><center>Para encaminhar apenas a observação, deixe o campo de anexo desmarcado e clique em "Enviar" no final desta tela.</center></p>
                        
                    <div class="row inserirNovoAnexo" >
                        <div class="col-md-12">
                            <table id="resFile" class="table-striped table table-bordered" style="margin-top: 2%;">
                                <thead>
                                    <tr>
                                        <th style="width: 80%;">Cadastrar novo anexo</th>
                                        <th>Associar o documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="UpFile">
                                            <?php echo $this->Form->file('Anexo.arquivoInfoAssistido', array("class" => 'btn btn-default')); ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upload File btn btn-primary', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'anexarDocumentoModal'));
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <span><center>Selecione um ou mais anexos da lista abaixo para encaminhar junto com a observação.</center></span><br>
                    <div id="lista"> 
                        <table id="tabelaAnexos" class="table-striped table table-bordered">
                            <thead>
                                <tr>
                                    <th width="25%">Arquivo Anexado</th>
                                    <th width="18%">Tipo Anexo</th>
                                    <th width="16%">Descrição</th>
                                    <th width="17%">Cadastrado por</th>
                                    <th width="12%">Dt Cadastro</th>
                                    <th width="12%">Anexo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($anexos as $key => $value) { ?>
                                    <tr class=<?php echo $key + 1; ?>>
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
                                            <td align="center"><input align='center' type='checkbox' value='<?php echo $value['Anexo']['id'];  ?>' onclick="get_id_anexo_download(this)"/></td>
                                        </td>
                                    </tr>
                                    <?php }
                                 ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary sendEmail">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 10px;">Fechar</button>
    </div>
    </div>
</div>
</div>

<!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalInformarAssitido">
    Launch demo modal
  </button> -->


<div id="dialog-confirm" title='Informar o assistido' style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Deseja enviar a informação para o e-mail do assistido? Uma vez confirmada, a operação não poderá ser desfeita.</p>
</div>

<div class="alert alert-success" role="alert" id="email-alert-success" style="display:none;position:relative;width:auto;">
	E-mail enviado com sucesso.
</div>
<div class="alert alert-danger" role="alert" id="email-alert-danger" style="display:none;position:relative;width:auto;">
	Não foi possível enviar o e-mail.
</div>
<?php
if (!empty($historicos)) { // Existir histórico
    echo $this->Form->create('acaoHistorico', array('id' => 'formAcaoHistorico', "action" => 'imprimir', "target" => '_blank'));
    ?>   
    <h4>Histórico de manipulação da especializada</h4>
    <?php if($this->Util->setaValorPadrao($dados['email']) == 'ND'){ ?>
        <h6 align="right">Obs.: A ferramenta de notificação será habilitada se o assisto apresentar e-mail cadastrado.</h6>
    <?php } ?>
    <div class="well">     
        
        <h3> <?php $this->Util->setaValorPadrao($numero) ?></h3>
        <div class="scroll-area" id="tableHistoricoCasosBox" >
            <table class="table historico printHistorico" id="tableHistoricoCasos" >   
                <tr>
                    <th><?php echo $this->Form->checkbox('check', array("class" => 'checked', 'hiddenField' => false)); ?></th>
                    <th with="150px">DEFENSOR/SERVIDOR</th>
                    <th>OBSERVA&Ccedil;&Atilde;O</th>
                    <th>DATA</th>
                    <th>EDITAR</th>
                    <?php if($this->Util->setaValorPadrao($dados['email']) != 'ND'){ ?>
                        <th>ASSISTIDO INFORMADO</th>
                        <th><center>INFORMAR O ASSISTIDO</center></th>
                    <?php } ?>
                </tr>
                <?php
                $i = 0;
                $key = 0;

                foreach ($historicos as $historico):
                    if ($historico['AcaoHistorico']['observacao'] != '' || isset($historico['AcaoHistorico']['data3'])
                     ||  isset($historico['AcaoHistorico']['data4']) || isset($historico['AcaoHistorico']['data5'] )):

                     if(isset($historico['AcaoHistorico']['data4'])){
                        /*
                        if($historico['AcaoHistorico']['atos_praticados'] == 'Atendimento ao público caso novo' || $historico['AcaoHistorico']['atos_praticados'] == 'Atendimento ao público caso retorno'){
                            continue;
                        }
                        */
                     }
                    ?>
                    
                    <tr>
                        <td align="justify"><?php 
                        if(isset($historico['AcaoHistorico']['id'])){
                            if (isset($historico['AcaoHistorico']['data2'])) {
                                echo $this->Form->checkbox('id' . $i, array('hiddenField' => false, "value" => $historico['AcaoHistorico']['id'], "name" => 'data[AcaoHistorico][idObservacao]['.$i.']', 'class' => 'validade[required] cbAcao')); 
                            } elseif (isset($historico['AcaoHistorico']['data3'])) {
                                echo $this->Form->checkbox('id' . $i, array('hiddenField' => false, "value" => $historico['AcaoHistorico']['id'], "name" => 'data[AcaoHistorico][idAtoProcessual]['.$i.']', 'class' => 'validade[required] cbAcao'));
                            } elseif (isset($historico['AcaoHistorico']['data4'])) {
                                echo $this->Form->checkbox('id' . $i, array('hiddenField' => false, "value" => $historico['AcaoHistorico']['id'], "name" => 'data[AcaoHistorico][idAtExtra]['.$i.']', 'class' => 'validade[required] cbAcao'));
                            } elseif (isset($historico['AcaoHistorico']['data5'])) {
                                echo $this->Form->checkbox('id' . $i, array('hiddenField' => false, "value" => $historico['AcaoHistorico']['id'], "name" => 'data[AcaoHistorico][idAtExtra]['.$i.']', 'class' => 'validade[required] cbAcao'));
                            }
                            // echo $this->Form->checkbox('id' . $i, array('hiddenField' => false, "value" => $historico['AcaoHistorico']['id'], "name" => 'data[AcaoHistorico][id]['.$i.']', 'class' => 'validade[required] cbAcao'));
                        }else{
                            echo $this->Form->checkbox('id' . $i, array('hiddenField' => false, "value" => '', "name" => '', 'class' => 'validade[required] cbAcao'));
                        }
                        ?>                           
                        </td>

                        <td align="justify" width="300px;">
                            <?php
                            if($historico['Funcionario']['tipo_funcionario'] == '4'){
                                echo 'DEF. '.trim($historico['Funcionario']['nome']); 
                            }else{
                                echo trim($historico['Funcionario']['nome']);
                            }?>
                                
                        </td>
                        <?php
                        if(isset($historico['AcaoHistorico']['data2'])){
                        ?>
                        <td class="content" style="text-align: justify; ">
                            <b class='badge margin-bottom' style='background-color: #dc3545;'> Observação</b><br/>
                            <?php echo "• " . nl2br(wordwrap($historico['AcaoHistorico']['observacao'], 73, ' ', true)); ?>
                        </td>          
                        <?php
                        }elseif(isset($historico['AcaoHistorico']['data3'])){
                            echo  "<td class='content' style='text-align: justify;white-space: pre-line;'>";
                            echo  "<b class='badge margin-bottom' style='background-color: #28a745;' > Atos Processuais:</b><br/>";
                            foreach ($historico['AcaoHistorico']['atos_praticados'] as $key => $value) {
                        ?>
                                <?php echo ($key+1).") ". $value ."<br/>"; ?>
                        <?php
                            }
                            if($historico['AcaoHistorico']['observacao']){
                                echo "<br/>" ;
                                echo "• " . $historico['AcaoHistorico']['observacao'];
                                echo  "</td>";
                            }else{
                                echo  "</td>";
                            }
                        }elseif(isset($historico['AcaoHistorico']['data4'])){
                            echo  "<td class='content' style='text-align: justify; white-space: pre-line;'>";
                            echo  "<b class='badge margin-bottom' style='background-color: #007bff;'> Atos Extrajudiciais:</b><br/>";
                            echo  "1) " .$historico['AcaoHistorico']['atos_praticados']."<br/>";

                            if($historico['AcaoHistorico']['observacao']){
                                echo "<br/>" ;
                                echo "• " . $historico['AcaoHistorico']['observacao'];
                                echo  "</td>";
                            }else{
                                echo  "</td>";
                            }
                        }elseif(isset($historico['AcaoHistorico']['data5'])){
                            echo  "<td class='content' style='text-align: justify;white-space: pre-line;'>";
                            echo  "<b class='badge margin-bottom' style='background-color: #17a2b8;'> Atos Extrajudiciais Plantão/Mutirão:</b><br/>";
                            echo  "1) " .$historico['AcaoHistorico']['atos_praticados']."<br/>";

                            if($historico['AcaoHistorico']['observacao']){
                                echo "<br/>" ;
                                echo "• " . $historico['AcaoHistorico']['observacao'];
                                echo  "</td>";
                            }else{
                                echo  "</td>";
                            }
                        }
                        ?>
                        <td class="idHistoricoModal" style="display: none"><?php echo $historico['AcaoHistorico']['id']; ?></td>
                        <?php
                        if(isset($historico['AcaoHistorico']['data3'])){
                        ?>      
                            <td width="100px;"><?php echo substr($historico['AcaoHistorico']['data'], 0, -8);  ?></td>
                        <?php
                        }elseif(isset($historico['AcaoHistorico']['data4'])){
                        ?>      
                            <td width="100px;"><?php echo substr($historico['AcaoHistorico']['data4'], 0, -8);  ?></td>
                        <?php
                        }elseif(isset($historico['AcaoHistorico']['data5'])){
                        ?>      
                            <td width="100px;"><?php echo substr($historico['AcaoHistorico']['data5'], 0, -8);  ?></td>
                        <?php
                        }else{
                        ?>
                        <td width="100px;"><?php echo $historico['AcaoHistorico']['data']; ?></td>
                        <?php
                        }
                        ?>
                         
                        <td>
                            <?php
                            if(isset($historico['AcaoHistorico']['data3'])){
                                if ($idFunc == $historico['AcaoHistorico']['funcionario_id']) {
                                echo "<div class='glyphicon glyphicon-edit' style='color: green; cursor: pointer;' onclick='atosProcHistEdit(" . $historico['AcaoHistorico']['id'] . ")'></div>" ;
                                 } else{
                                    echo "-";
                                }
                            }elseif (isset($historico['AcaoHistorico']['data4'])) {
                                if ($idFunc == $historico['AcaoHistorico']['funcionario_id']) {
                                 echo "<div class='glyphicon glyphicon-edit' style='color: green; cursor: pointer;' onclick='atosExtrHistEdit(" . $historico['AcaoHistorico']['id'] . ")'></div>" ;
                                } else{
                                    echo "-";
                                }
                            }elseif (isset($historico['AcaoHistorico']['data5'])) {
                                if ($idFunc == $historico['AcaoHistorico']['funcionario_id']) {
                                 echo "<div class='glyphicon glyphicon-edit' style='color: green; cursor: pointer;' onclick='atosMutHistEdit(" . $historico['AcaoHistorico']['id'] . ")'></div>" ;
                                } else{
                                    echo "-";
                                }
                            }elseif ($idFunc == $historico['AcaoHistorico']['funcionario_id']) {
                                if (!empty($fromHistoricoAgendamento)) {
                                    if ($idAcao) {
                                        echo $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), array(
                                            'controller' => 'acoes',
                                            'action' => 'edit', $historico['AcaoHistorico']['acao_id']
                                                ), array(
                                            'escape' => false,
                                            'target' => '_blank',
                                            "id" => $historico['AcaoHistorico']['id'])
                                        );
                                    } else if ($idConciliacao) {
                                        echo $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), array(
                                            'controller' => 'conciliacoes',
                                            'action' => 'edit', $historico['AcaoHistorico']['conciliacao_id']
                                                ), array(
                                            'escape' => false,
                                            'target' => '_blank',
                                            "id" => $historico['AcaoHistorico']['id'])
                                        );
                                    }
                                } else {
                                    echo ($idFunc == $historico['AcaoHistorico']['funcionario_id']) ? $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), "javascript: return false;", array('escape' => false, "id" => $historico['AcaoHistorico']['id'])) : "-";
                                }
                                
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <!-- Exibir ferramenta de notificação se o assistido apresentar e-mail cadastrado. -->
                       
                        <?php 
                        if($this->Util->setaValorPadrao($dados['email']) != 'ND'){ 
                            if(!(isset($historico['AcaoHistorico']['data3']) 
                            || isset($historico['AcaoHistorico']['data4']) 
                            || isset($historico['AcaoHistorico']['data5']) 
                            )){
                        ?>
                        
                            <td width="10px;">
                                <div id="notificadoSimNao">
                                <?php if(isset($listaNotificacoes[$historico['AcaoHistorico']['id']])){ ?>
                                            Sim
                                <?php  }else{ ?>
                                            Não
                                <?php } ?>
                                </div>
                            </td>
                        
                            <?php 
                            if(isset($listaNotificacoes[$historico['AcaoHistorico']['id']])) {
                             ?>
                                <td width="30px;" >
                                    <?php if ($idFunc == $historico['AcaoHistorico']['funcionario_id'] && $historico['AcaoHistorico']['observacao'] != '') { ?>
                                    <button type="button" id='<?php echo 'ac' . $historico['AcaoHistorico']['id'] ?>' style='float:left;' class='btn btn-primary informarAssitido' data-toggle="modal" data-target="#ModalInformarAssitido">Informar novamente</button>

                                    <?php }else{ 
                                        echo '<center>'. $this->Html->image('icons/glyphicons-129-message-lock.png', array(
                                            'title' => 'Apenas o autor tem permissão para enviar a notificação.', 'style'=>'cursor:help;')).'</center>';
                                     } ?>
                                </td>
                            <?php }else{ ?>
                                <td width="30px;">
                                    <?php if ($idFunc == $historico['AcaoHistorico']['funcionario_id'] && $historico['AcaoHistorico']['observacao'] != '') { ?>
                                    <button type="button" id='<?php echo 'ac' . $historico['AcaoHistorico']['id'] ?>' style='float:left;' class='btn btn-primary informarAssitido' data-toggle="modal" data-target="#ModalInformarAssitido">Informar o Assistido</button>

                                    <?php }else{                                     
                                        echo '<center>'. $this->Html->image('icons/glyphicons-129-message-lock.png', array(
                                            'title' => 'Apenas o autor tem permissão para enviar a notificação.', 'style'=>'cursor:help;')).'</center>';
                                     } ?>
                                </td>
                            <?php } ?>
                        <?php }else{
                            
                                if($idFunc == $historico['AcaoHistorico']['funcionario_id']){
                                    if(isset($historico['AcaoHistorico']['na'])){
                                        echo  "<td id='notificadoSimNao'>Sim</td>";
                                        $idf= 'ac' . $historico['AcaoHistorico']['id'] ;
                                        $idf2= 'ab' . $historico['AcaoHistorico']['id'] ;
                                        $idtipo = $historico['AcaoHistorico']['tipo'] ;
                                        echo  "<input type='hidden'  id=$idf2 name=$idf2 value= '$idtipo' >";
                                        echo  "<td >";
                                        echo  "<button type='button' id=$idf  style='float:left;' class='btn btn-primary informarAssitido' data-toggle='modal' data-target='#ModalInformarAssitido'>Informar Novamente</button>";
                                        echo "</td>";
                                        }else{
                                        echo   "<td id='notificadoSimNao' >Não</td>";
                                        $idf= 'ac' . $historico['AcaoHistorico']['id'] ;
                                        $idf2= 'ab' . $historico['AcaoHistorico']['id'] ;
                                        $idtipo = $historico['AcaoHistorico']['tipo'] ;
                                        echo  "<input type='hidden'  id=$idf2 name=$idf2 value= '$idtipo' >";
                                        echo  "<td >";
                                        echo  "<button type='button' id=$idf  style='float:left;' class='btn btn-primary informarAssitido' data-toggle='modal' data-target='#ModalInformarAssitido'>Informar o Assistido</button>";
                                        echo "</td>";
                                    }
                                }else{
                                    if(isset($historico['AcaoHistorico']['na'])){echo  "<td id='notificadoSimNao'>Sim</td>";}else{echo   "<td id='notificadoSimNao' >Não</td>";}
                                        echo  "<td >";
                                            echo '<center>'. $this->Html->image('icons/glyphicons-129-message-lock.png', array(
                                                'title' => 'Apenas o autor tem permissão para enviar a notificação.', 'style'=>'cursor:help;')).'</center>';
                                        echo "</td>";
                                    }
                                }
                        
                        }?>
                    </tr>
                    <?php
                    $key++;
                    $i++;
                endif;
                endforeach;
                
                ?>
            </table>
        </div>
        <div style="float: left;">
            <label>
                <span class="label_bold">Exibir Defensor/Servidor na impressão?</span>&nbsp;
            </label>
            <?php
            echo $this->Form->radio('AcaoHistorico.exibe_func', array(1 => 'Sim', 0 => 'Não'), array('default' => 0, 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
            ?>
        </div>
        <div style="float: right;">			
            
			<?php 
					echo $this->Form->input('AcaoHistorico.assistido_id', array('type' => 'hidden', 'value' => key($assistido)));
                    echo $this->Form->input('AcaoHistorico.acao_id', array('type' => 'hidden', 'value' => $idAcao));
            ?>
				
			<?php
            echo $this->Form->submit('Imprimir', array(
                'id' => 'Imprimir',
                'class' => 'btn btn-default marginbottom10'));
            echo $this->Form->end();
            ?>
        </div>
        <div class="clearfix"></div>
    </div> 
<!--
<?php } ?>

    <?php echo $this->Html->script('notificacao/botao_notificacao'); ?> -->