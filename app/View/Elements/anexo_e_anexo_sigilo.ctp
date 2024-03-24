<style>
    /*.set-width-multiselect {
  width: 275px;
}*/
    .select2-container .select2-selection {}

    /*.select2 {
        width:100%!important;
    }*/
    /* .select2-container {
  position: relative;
  z-index: 2;
  float: left;
  width: 100%;
  margin-bottom: 0;
  display: table;
  table-layout: fixed;
}*/



    /*.select2-selection__rendered {
    width: 700px !important;
}*/

    .conteudo-tabela-sigiloso{

    color: #FF0000;
    font-weight: 500;

    }


    .paragrafo-icon{

    font-size: 11px;
    font-weight: 600;

    }

    .conteudo-acoes{

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

    }

    .conteudo-acoes a{

    text-decoration: none;
    color: inherit;
    cursor: pointer;

    }

    #conteudo-tabela{

    font-size: 14px;

    }

</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('.autocomplete-def').select2({
            width: '100%',
        });
        $('.pesquisa-select').select2({
            //		theme: "bootstrap",
            //		placeholder: "PESQUISAR TIPO AÇÃO",
            dropdownAutoWidth: true,
            allowClear: true,
            placeholder: 'PESQUISAR',

            maximumSelectionLength: 3,

            language: {
                noResults: function() {
                    return "NENHUM RESULTADO ENCONTRADO.";
                }
            }
        });

        $("#Anexo0TipoAnexoId").on("change", function() {
            var outro = $(this).val();
            if (outro === '6') {
                $(".outro").show();
            } else {
                $(".outro").hide();
            }
        });
    });

    function excluirAnexoSigiloso(model, id) {
        $.ajax({
            url: "<?php echo $this->webroot; ?>anexos/removeAnexoSigilo/" + model + '/' + id + '?trs=1',
            success: function(data) {

                $('#lista_anexos').html(data);
            }
        });
    }
</script>
<html>

<body>

    <!-- Modal -->
    <div class="modal fade" id="modalObterAutorizacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solicitação de acesso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Para ter acesso a este anexo é necessário ter permissão. Caso queira solicitar acesso clique no botão "Solicitar autorização".
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>&nbsp;
                    <button type="button" class="btn btn-primary" id="solicitarAutorizacao">Solicitar autorização</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Modal -->

    <!-- Modal -->
    <div class="modal fade" id="modalTornarAnexoSigiloso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solicitação de acesso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseja tornar o anexo sigiloso?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>&nbsp;
                    <button type="button" class="btn btn-primary" id="tornarAnexoSigiloso">Sim</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Modal -->

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
                    <th width="18%">Tipo Anexo</th>
                    <th width="16%">Descrição</th>
                    <th width="17%">Cadastrado por</th>
                    <th width="12%">Data do Cadastro</th>
                    <th width="22%">Ações</th>
                    <th width="20%">Download<br />Em Lote</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //$dadosLogado['funcionario_id'] = 1000;
                //$dadosLogado['comarca_id'] = 316;
                //$dadosLogado['perfil_usuario_id'] =  77;
                //print("<pre>" . print_r($dadosLogado, true) . "</pre>");
                ?>
                <?php //print("<pre>" . print_r($anexos, true) . "</pre>");
                ?>
                <?php //print("<pre>" . print_r($anexosSigilosos, true) . "</pre>");
                ?>
                <?php //print("<pre>" . print_r($this->Session->read('dadosAnexoSigilosos'), true) . "</pre>");
                ?>

                <?php 
                    foreach ($anexos as $key => $value) { 
                        // Controle da nomeclatura da classe para anexos sigilosos
                        if(isset($value['Anexo']['id']) && $value['Anexo']['sigiloso'] == "1"){
                            $classeColor = 'conteudo-tabela-sigiloso';
                            
                        } else {
                            $classeColor = '';
                        }

                        ?>

                        <tr class=<?php echo $key + 1; ?> id="conteudo-tabela">
                            <td align="center" class="<?php echo $classeColor; ?>"><?php echo $value['Anexo']['filename']; ?></td>
                            <?php
                            $this->Util->setaValorPadrao($idTipoAnexoOutro, null);
                            if (isset($value['Anexo']['tipo_anexo_id']) && $value['Anexo']['tipo_anexo_id'] == $idTipoAnexoOutro) { ?>
                                <td align="center" class="<?php echo $classeColor; ?>" ><?php echo $this->Util->setaValorPadrao($value['TipoAnexo']['nome']) . ": " . $this->Util->setaValorPadrao($value['Anexo']['outro']); ?></td>
                            <?php } else { ?>
                                <td align="center" class="<?php echo $classeColor; ?>" ><?php echo $this->Util->setaValorPadrao($value['TipoAnexo']['nome']); ?></td>
                            <?php } ?>
                            <td align="center" class="<?php echo $classeColor; ?>" ><?php echo $this->Util->setaValorPadrao($value['Anexo']['descricao']); ?></td>
                            <td align="center" class="<?php echo $classeColor; ?>" ><?php echo $value['Pessoa']['nome']; ?></td>
                            <td align="center" class="<?php echo $classeColor; ?>"><?php echo $this->Util->aammddHis($value['Anexo']['dt_cadastro']); ?></td>
                            <td align="center" class="conteudo-acoes" >

                            <?php //echo ($value['Funcionario']['id'] == $dadosLogado['funcionario_id'] || $excluiAnexo == true) ? $this->Html->link($this->Html->image('mimetypes/application-pdf.png', array('title' => 'Baixar', 'escape' => false)), array('controller' => 'anexos', 'action' => "view/$model/" . $value['Anexo']['id'] . '?trs=1'), array('target' => '_blank', 'escape' => false)) : $this->Html->image('mimetypes/application-pdf.png', array('title' => 'Você não tem permissão!'));
                            if(isset($anexosSigilosos)){                                
                                $controleAnexoNaoSigiloso = false;
                                $controleAnexoNaoSigilosoEdicaoExclusao = false;
                                $controleSolicitarAcesso = false;
                                $controleAcessoLiberado = false;
                                $controleCheckBoxDownloadLote = false;

                                foreach ($anexosSigilosos as $chave => $valor) {
                                    if ($value['Anexo']['id'] == $valor['Anexo']['id']) {
                                        //O anexo é sigiloso?
                                        if ($valor['Anexo']['sigiloso'] == 1) {
                                            if ($value['Funcionario']['id'] == $dadosLogado['funcionario_id']) {
                                                $controleAcessoLiberado = true;
                                                $controleCheckBoxDownloadLote = true;
                                            } else {
                                                if ($valor['Anexo']['tipo_permissao_id'] == 2) {
                                                    $achou = array_search($valor['AnexoSigiloso']['perfil_id'], $perfilUsu);
                                                    //debug($perfilUsu);
                                                    //debug($valor['AnexoSigiloso']['perfil_id']);
                                                    if ($achou) {

                                                        $controleAcessoLiberado = true;
                                                        $controleCheckBoxDownloadLote = true;


                                                        $controleAnexoNaoSigiloso = false;
                                                        $controleAnexoNaoSigilosoEdicaoExclusao = false;
                                                        $controleSolicitarAcesso = false;
                                                        break;
                                                    } else {
                                                        $controleSolicitarAcesso = true;
                                                    }
                                                }
                                                if ($valor['Anexo']['tipo_permissao_id'] == 1) {
                                                    if ($valor['AnexoSigiloso']['comarca_id'] == $dadosLogado['comarca_id']) {


                                                        $controleAcessoLiberado = true;
                                                        $controleCheckBoxDownloadLote = true;


                                                        $controleAnexoNaoSigiloso = false;
                                                        $controleAnexoNaoSigilosoEdicaoExclusao = false;
                                                        $controleSolicitarAcesso = false;
                                                        break;
                                                    } else {
                                                        $controleSolicitarAcesso = true;
                                                    }
                                                }
                                                if ($valor['Anexo']['tipo_permissao_id'] == 3) {
                                                    if ($valor['AnexoSigiloso']['funcionario_id'] == $dadosLogado['funcionario_id']) {

                                                        $controleAcessoLiberado = true;
                                                        $controleCheckBoxDownloadLote = true;

                                                        $controleAnexoNaoSigiloso = false;
                                                        $controleAnexoNaoSigilosoEdicaoExclusao = false;
                                                        $controleSolicitarAcesso = false;

                                                        //if ($value['Funcionario']['id'] == $dadosLogado['funcionario_id']) {


                                                        // if($valor['AnexoSigiloso']['anexo_id'] == 468030){

                                                        // }
                                                        //$controleDeExclusaoEdica = true;
                                                        //}
                                                        //if ($valor['AnexoSigiloso']['funcionario_id'] == $dadosLogado['funcionario_id']) {

                                                        //$controleDeExibicao = true;

                                                        //if ($valor['AnexoSigiloso']['nivel_permissao'] == 1) {
                                                        //$controleAcessoLiberado = true;
                                                        //$controleDeExclusaoEdica = true;
                                                        //}

                                                        break;
                                                    } else {
                                                        $controleSolicitarAcesso = true;
                                                    }
                                                }
                                            }
                                        } else {
                                            $controleCheckBoxDownloadLote = true;
                                            /*
                                                O usuário corrente foi o mesmo que anexou o arquivo a ação?
                                            */
                                            if ($value['Funcionario']['id'] == $dadosLogado['funcionario_id'] || $excluiAnexo == true) {

                                                $controleAnexoNaoSigiloso = true;
                                                $controleAnexoNaoSigilosoEdicaoExclusao = true;
                                            } else {
                                                $controleAnexoNaoSigiloso = true;
                                            }
                                        }
                                    }
                                }
                                if ($controleAnexoNaoSigiloso) {
                                    
                                    
                                    echo $this->Html->div('anexo-pdf', (
                                        $this->Html->link($this->Html->image("file-pdf.png", array('title' => 'Abrir anexo', 'escape' => false)). 
                                            $this->Html->tag('p', 'Abrir anexo', ['class' => 'paragrafo-icon']), array('controller' => 'anexos', 'action' => "view/$model/" . $value['Anexo']['id'] . '?trs=1'), array(
                                            'target' => '_blank', 'escape' => false
                                        ))
                                    ));
                                    
                                    
                                    if ($controleAnexoNaoSigilosoEdicaoExclusao) {

                                        echo $this->Html->div('editar-sigilo', (
                                            $this->Html->tag('a href="javascript:void(0)"', $this->Html->image("editar.png", array('style' => 'font-size: 20px; top: 5px;')). 
                                                $this->Html->tag('p', 'Editar sigilo', ['class' => 'paragrafo-icon']), array(
                                                "data-toggle" =>  "modal", "title" => "Editar sigilo do anexo.", "url" => "javascript:void(0)",
                                                "onclick='setValoresTornarAnexoSigiloso(" . $value['Anexo']['id'] . ",\"" . $dadosLogado['funcionario_id'] . "\")'",
                                            ))
                                            
                                        ));
                                        
                                        echo $this->Html->div('excluir-arquivo', (
                                            $this->Html->link($this->Html->image("delete-file.png", array("title" => 'Excluir o arquivo')). 
                                                $this->Html->tag('p', 'Excluir arquivo', ['class' => 'paragrafo-icon']), "javascript: excluirAnexoBanco('$model'," . $value['Anexo']['id'] . ", " . ++$key . ")", array(
                                                "class" => 'xFile', "escape" => false
                                            ))
                                        ));

                                    } else {

                                        echo $this->Html->div('editar-sigilo', (
                                            $this->Html->tag('a href="javascript:void(0)"', $this->Html->image("editar.png", array('style' => 'font-size: 20px; top: 5px;')). 
                                                $this->Html->tag('p', 'Editar sigilo', ['class' => 'paragrafo-icon']), array(
                                                "data-toggle" =>  "modal", "title" => "Solicitar permissão ao anexo sigiloso.", "url" => "javascript:void(0)",
                                                "onclick='setValoresEnvioEmail(" . $value['Anexo']['id'] . ",\"" . $dadosLogado['funcionario_id'] . "\")'"
                                            ))
                                            
                                        ));

                                        echo $this->Html->div('excluir-arquivo', (
                                            $this->Html->tag('a href="javascript:void(0)"', $this->Html->image("delete-file.png"). 
                                                $this->Html->tag('p', 'Excluir arquivo', ['class' => 'paragrafo-icon']), array(
                                                "data-toggle" =>  "modal", "title" => "Solicitar permissão ao anexo sigiloso.", "url" => "javascript:void(0)",
                                                "onclick='setValoresEnvioEmail(" . $value['Anexo']['id'] . ",\"" . $dadosLogado['funcionario_id'] . "\")'"
                                            ))                         
                                        ));

                                    }

                                } else if ($controleSolicitarAcesso) {
                                    
                                    echo $this->Html->div('anexo-pdf', (
                                        $this->Html->tag('a href="javascript:void(0)"', $this->Html->image('file-pdf.png', array('title' => 'Solicitar permissão ao anexo sigiloso')). 
                                            $this->Html->tag('p', 'Abrir anexo', ['class' => 'paragrafo-icon']),  array(
                                            "data-toggle" =>  "modal", "title" => "Solicitar permissão ao anexo sigiloso.", "url" => "javascript:void(0)",
                                            "onclick='setValoresEnvioEmail(" . $value['Anexo']['id'] . ",\"" . $dadosLogado['funcionario_id'] . "\")'"
                                        ))
                                        
                                    ));


                                    echo $this->Html->div('editar-sigilo', (
                                        $this->Html->tag('a href="javascript:void(0)"', $this->Html->image("editar.png", array('style' => 'font-size: 20px; top: 5px;')).
                                            $this->Html->tag('p', 'Editar sigilo', ['class' => 'paragrafo-icon']), array(
                                            "data-toggle" =>  "modal", "title" => "Solicitar permissão ao anexo sigiloso.", "url" => "javascript:void(0)",
                                            "onclick='setValoresEnvioEmail(" . $value['Anexo']['id'] . ",\"" . $dadosLogado['funcionario_id'] . "\")'"
                                        ))
                                    ));


                                    echo $this->Html->div('excluir-arquivo', (
                                        $this->Html->tag('a href="javascript:void(0)"', $this->Html->image("delete-file.png"). 
                                            $this->Html->tag('p', 'Excluir arquivo', ['class' => 'paragrafo-icon']) , array(
                                            "data-toggle" =>  "modal", "title" => "Solicitar permissão ao anexo sigiloso.", "url" => "javascript:void(0)",
                                            "onclick='setValoresEnvioEmail(" . $value['Anexo']['id'] . ",\"" . $dadosLogado['funcionario_id'] . "\")'"
                                        ))

                                    ));


                                    echo $this->Html->div('arquivo-bloqueado', (

                                        $this->Html->tag('a href="javascript:void(0)"', $this->Html->image("lock.png", array( "title" => "Clique para solicitar permissão de acesso.")). 
                                            $this->Html->tag('p', 'Acesso negado', ['class' => 'paragrafo-icon']), array(
                                            "data-toggle" =>  "modal", "title" => "Arquivo Bloqueado.", "url" => "javascript:void(0)",
                                            "onclick='setValoresEnvioEmail(" . $value['Anexo']['id'] . ",\"" . $dadosLogado['funcionario_id'] . "\")'"
                                        ))
                                    ));

                                    
                                } else if ($controleAcessoLiberado) {
                                    
                                    echo $this->Html->div('anexo-pdf', (
                                        $this->Html->link($this->Html->image("file-pdf.png", array('title' => 'Abrir anexo', 'escape' => false)). 
                                            $this->Html->tag('p', 'Abrir anexo', ['class' => 'paragrafo-icon']), array(
                                            'controller' => 'anexos', 'action' => "view/$model/" . $value['Anexo']['id'] . '?trs=1'), array('target' => '_blank', 'escape' => false
                                        ))
                                    ));

                                    //echo $this->Html->link($this->Html->div('glyphicon glyphicon-edit', '', array('style' => 'font-size: 20px; top: 5px;')), array("controller" => 'anexos', "action" => "getDadosAnexoSigiloso/" . $value['Anexo']['id'] . "/" . $value['AcoesAnexo']['acao_id'] . '?trs=1'), array("escape" => false, 'title' => 'Editar sigilo do anexo'));                                    
                                   
                                    echo $this->Html->div('editar-sigilo', (
                                        $this->Html->link($this->Html->image("editar.png", array('style' => 'font-size: 20px; top: 5px;')). 
                                            $this->Html->tag('p', 'Editar sigilo', ['class' => 'paragrafo-icon']),"javascript: editarAnexoSigiloso(" . $value['Anexo']['id'] . "," . $valor[$tabelaDependenteAnexo][$chaveEstrangeiraTabelaDependenteAnexo] . ")", array(
                                            "escape" => false, 'title' => 'Editar sigilo do anexo'
                                        ))
                                    ));
                                    
                                    echo $this->Html->div('excluir-arquivo', (
                                        $this->Html->link($this->Html->image("delete-file.png", array("title" => 'Excluir o arquivo', 'id' => 'excluirAnexo')). 
                                            $this->Html->tag('p', 'Excluir arquivo', ['class' => 'paragrafo-icon']), "javascript: excluirAnexoBanco('$model'," . $value['Anexo']['id'] . ", " . ++$key . ")", array(
                                            "class" => 'xFile', "escape" => false
                                        ))  
                                    ));

                                    echo $this->Html->div('arquivo-desbloqueado', (
                                        $this->Html->image("padlock.png").
                                        $this->Html->tag('p', 'Acesso liberado', ['class' => 'paragrafo-icon'])
                                    ));
                                
                                }

                                ?>


                                <?php


                                ?>

                                <?php //echo ($value['Funcionario']['id'] == $dadosLogado['funcionario_id'] || $excluiAnexo == true) ? $this->Html->link($this->Html->image("icones24/delete.png", array("title" => 'Excluir o arquivo', 'id' => 'excluirAnexo')), "javascript: excluirAnexoBanco('$model'," . $value['Anexo']['id'] . ")", array("class" => 'xFile', "escape" => false)) : $this->Html->image('mimetypes/application-pdf.png', array('title' => 'Você não tem permissão!')); 
                                ?>
                            <td align="center">
                            <input align='center' class='anexo' type='checkbox' id='<?php echo $key ?>' value='<?php echo $value['Anexo']['id'];  ?>' <?php echo $controleCheckBoxDownloadLote == true ? 'onclick="get_id_anexo_download(this)"' : 'onclick="return false;"';  ?>>
                            <!-- <input align='center' type='checkbox' id='<?php //echo $key 
                                                                            ?>' value='<?php //echo $value['Anexo']['id'] 
                                                                                        ?>' onclick='get_id_anexo_download(this)'> -->
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
        <div class="row">
            <div id="resAnexos" style="text-align:right">

                <div class="col-md-9">
                    <div class="form-group">
                        <?php
                        //Este botão só é exibido na tela do edit e quando o usuário clica no ícone de editar o anexo. Ele serve para dar um refresh na tela e excluir os dados da sessão para assim os campos não fiquem disable                                                
                        echo $this->Form->button('Cancelar', array('id' => 'cancelarManipulacao', 'type' => 'button', 'class' => 'btn btn-primary'));
                        //echo $this->Session->read('dadosAnexoSigilosos') != "" ? $this->Html->link("Novo Anexo", array('controller' => 'acoes', 'action' => "edit/" . $idAcao), array("class" => 'btn btn-primary', "escape" => false)) : "";
                        ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div id='downlod-anexos-em-lote'> 
                            <div id="selecionarTodos" 
                            style="font-size: 12;
                            display: flex;
                            padding-right: 30px;
                            padding-bottom: 20px;
                            justify-content: flex-end;
                            align-items: center;">
                            </div>
                            <!-- <button class=" btn btn-primary" style="width:300px;" onclick="download_lote()">Download Em Lote</button> &nbsp;-->
                            <input style="width:300px;" class="btn btn-primary" type="button" value="Download Em Lote" onclick="download_lote()">&nbsp;
                            <span title="Funcionalidade Permite Realizar Download de Anexos Selecionados de uma Única Vez" class="glyphicon glyphicon-exclamation-sign"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Novo -->
    <?php echo $this->Form->create('Anexo', array('id' => 'formAnexo', 'enctype' => "multipart/form-data"));
    ?>
    <!-- <table id="resFile" class="table-striped table table-bordered" style="margin-top: 2%;">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Tipo do Anexo</th>
                <th style="display: none;" class="outro">Outro Tipo*</th>
                <?php //if (isset($listaDefensores) && $listaDefensores) { 
                ?>
                    <th>Notificar defensor(a)/funcionario(a) por e-mail</th>
                <?php //} 
                ?>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center" class="col-md-4 col-xl-4 col-xs-4"><?php //echo $this->Form->input("Anexo.0.descricao", array("size" => 35, "maxlength" => 120, "label" => false, 'class' => 'form-control input-sm')) 
                                                                        ?></td>
                <td align="center" class="col-md-2 col-xl-2 col-xs-2">
                    <!--<div class="col-md-3 col-xl-3 col-xs-3">-->
    <?php
    // $args = array(
    //     'empty' => 'Selecione',
    //     'class' => 'form-control input-sm'
    // );
    // echo $this->Form->select("Anexo.0.tipo_anexo_id", $tipoAnexos, $args)
    ?>
    <!--</div>-->
    <!-- </td>
                <td align="center" class="outro col-md-2 col-xl-2 col-xs-2" style="display: none;"><?php //echo $this->Form->input("Anexo.0.outro", array("size" => 25, "maxlength" => 120, "label" => false)) 
                                                                                                    ?></td>
                <?php //if (isset($listaDefensores) && $listaDefensores) { 
                ?>

                    <td align="center" class="col-md-3 col-xl-3 col-xs-3">

                        <div class="form-group"> -->
    <?php
    // echo $this->Form->select("Anexo.0.defensor_notificado_id", $listaDefensores, array(
    //     'empty' => 'Selecione',
    //     //                                        'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
    //     'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
    //     'multiple' => 'multiple'
    // )) 
    ?>
    <!-- </div>
                        </div>

                    </td> -->
    <?php //} 
    ?>
    <!-- <td align="center" class="col-md-1 col-xl-1 col-xs-1"><?php //echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upFile btn btn-default', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'img-up-1')); 
                                                                ?></td>
            </tr>
            <tr>
                <td style="text-align: right">Arquivo:</td>
                <td colspan="3"><?php //echo $this->Form->file('Anexo.0.arquivo', array("class" => 'btn btn-default')); 
                                ?></td>
            </tr>
        </tbody>
    </table>  -->
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <span style="color: red;">*</span>
                <label>Descrição</label>
                <?php echo $this->Form->input(
                    "Anexo.descricao",
                    array(
                        "size" => 35,
                        "maxlength" => 120,
                        "label" => false,
                        'class' =>
                        'form-control input-sm',
                        'placeholder' =>
                        'Digite a descrição',
                        //'value' => $this->Session->read('dadosAnexoSigilosos.descricao') != "" ? $this->Session->read('dadosAnexoSigilosos.descricao') : "",
                        //'disabled' => $this->Session->read('dadosAnexoSigilosos.descricao') != "" ? true : false
                    )
                ) ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <span style="color: red;">*</span>
                <label>Tipo do Anexo</label>
                <?php
                $args = array(
                    'class' => 'form-control input-sm',
                    'empty' => 'Selecionar'
                    //'multiple' => 'multiple',
                    //'default' => $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') != "" ? $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') : "",
                    //'disabled' => $this->Session->read('dadosAnexoSigilosos') != "" ? true : false
                );
                echo $this->Form->select("Anexo.tipo_anexo_id", $tipoAnexos, $args)
                ?>
            </div>
        </div>
        <?php if (isset($listaDefensores) && $listaDefensores) { ?>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Notificar defensor(a)/funcionario(a) por e-mail</label>                    
                        <?php
                        echo $this->Form->select("Anexo.defensor_notificado_id", $listaDefensores, array(
                            //                                        'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
                            'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
                            'multiple' => 'multiple',
                            //'value' => $this->Session->read('dadosAnexoSigilosos.funcionario_idEmail') != "" ? $this->Session->read('dadosAnexoSigilosos.funcionario_idEmail') : "",
                            //'disabled' => $this->Session->read('dadosAnexoSigilosos') != "" ? true : false
                        )) ?>                
                </div>
        </div>
        <?php } ?>           
       
    </div>
        <div class="AnexoSigiloso">
            <span style="color: red;"><i>=> Antes de enviar o arquivo informe se ele será sigiloso ou não.</i></span>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <span style="color: red;">*</span>
                        <label>Arquivo Sigiloso?</label>
                        <?php echo $this->Form->radio(
                            'Anexo.sigilo',
                            array(1 => "Sim", 0 => "Não"),
                            array(
                                'legend' => false, 'class' => 'AnexoSigiloso', 'separator' => '&nbsp;&nbsp;',
                                //'value' => !empty($this->Session->read('dadosAnexoSigilosos')) == true ? 1 : "",
                                //'disabled' => !empty($this->Session->read('dadosAnexoSigilosos')) != "" ? true : false
                            )
                        ); ?>
                    </div>                   
                </div>
            </div>
        </div>         
          
    <div id="controleSigilo">
        <span style="color: blue;"><i>=> Agora informe o motivo do sigilo e o tipo de permissão.</i></span>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Motivo</label>
                    <?php echo $this->Form->textarea('Anexo.motivo', array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Digite o motivo',
                        'id' => 'configMotivo',
                        //'value' => $this->Session->read('dadosAnexoSigilosos.motivo') != "" ? $this->Session->read('dadosAnexoSigilosos.motivo') : "",
                    )); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tipo de Permissão</label>
                    <?php
                    $args = array(
                        'class' => 'form-control input-sm',
                        'empty' => 'Selecionar',
                        'label' => false,
                        //'default' => $this->Session->read('dadosAnexoSigilosos.tipo_permissao_id') != "" ? $this->Session->read('dadosAnexoSigilosos.tipo_permissao_id') : "",
                        //'disabled' => $this->Session->read('dadosAnexoSigilosos.tipo_permissao_id') != "" ? true : false
                    );
                    echo $this->Form->select('Anexo.tipoPermissao', $tipoPermissao, $args);
                    ?>

                </div>
            </div>
            <div id="controleComarca">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Comarca(s)</label>
                            <?php //echo $this->Form->input('Anexo.comarca', array('class' => 'form-control input-sm', 'options' => $comarcas, 'empty' => 'selecione', 'label' => false)); 

                            $args = array(

                                'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
                                'multiple' => 'multiple',
                                'id' => 'comarcaConfig',
                                //'value' => $this->Session->read('dadosAnexoSigilosos.listaComarca') != "" ? $this->Session->read('dadosAnexoSigilosos.listaComarca') : "",
                            );
                            echo $this->Form->select("Anexo.comarca", $comarcas, $args);
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div id="controleGrupo">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Grupo(s)</label>
                            <?php //echo $this->Form->input('Anexo.comarca', array('class' => 'form-control input-sm', 'options' => $comarcas, 'empty' => 'selecione', 'label' => false)); 
                            array_walk(
                                $perfis,
                                function (&$entry) {
                                    $entry = iconv('Windows-1250', 'UTF-8', $entry);
                                }
                            );
                            $args = array(
                                'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
                                'multiple' => 'multiple',
                                'id' => 'getDescricaoPerfilGrupo',
                                //'value' => $this->Session->read('dadosAnexoSigilosos.listaPerfilGrupo') != "" ? $this->Session->read('dadosAnexoSigilosos.listaPerfilGrupo') : "",
                            );
                            echo $this->Form->select("Anexo.perfis", $perfis, $args);
                            ?>
                        </div>
                    </div>
                    <!-- <div id="controleDescricaoGrupo">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Descrição do Grupo</label>
                            <?php //echo $this->Form->input('Anexo.comarca', array('class' => 'form-control input-sm', 'options' => $comarcas, 'empty' => 'selecione', 'label' => false)); 

                            ?>
                            <span id="listaDescricaoPerfilGrupo"></span>
                        </div>

                    </div>
                </div> -->
                </div>
            </div>
        </div>

        <div id="controleFuncionario">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4">

                        <label>Funcionário</label>
                        <input id="buscarNome" class="form-control" name="search_by_name" placeholder="Digite o nome do funcionário" />
                        <span id="autocompleteFuncionarioContainer">

                        </span>
                    </div>
                </div>

                <?php
                //echo $this->Html->link($this->Html->div('glyphicon glyphicon-plus', ''), "javascript:adicionarFuncionario()", array('escape' => false, 'title' => 'Adionar funcionário', 'style' => 'margin-top: 32px; color:blue'));
                ?>
                <div id="controleTabelaFuncionarios">
                    <div class="col-md-8" style="margin-top: 9px;">
                        <table id="tabelaFuncionariosModoTabela" cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="52%">Nome</th>
                                    <th width="42%">Permissão</th>
                                    <th width="6%">Excluir</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>

            </div>
        </div>


        <div class="form-group" id="controleBotaoSalvar">
            <div class="col-md-6" style="text-align:right">
                
                <?php

                // Este botão só é exibido na tela do edit e quando o usuário clica no ícone de editar o anexo. Ele serve para dar um refresh na tela e excluir os dados da sessão para assim os campos não fiquem disable                

                echo $this->Html->link("Salvar", "javascript: void(0)", array("class" => 'btn btn-primary', "escape" => false, 'title' => 'Salvar as informações do funcionário', 'id' => 'salvarDadosEditAnexo'));
                ?>
                <input type="submit" id="save_file_submit" style="display: none;" />
            </div>
        </div>
    </div>
    <br>

    <div id="controleuploadArquivo">
        <sub class="label label-danger">Arquivos permitidos: .pdf ("Tamanho máximo 10MB")</sub>

        <div class="row">
            <div class="col-md-8">
                <table id="resFile" class="table-striped table table-bordered" style="margin-top: 2%;">
                    <thead>
                        <tr>
                            <th style="width: 80%;">Selecionar o documento</th>
                            <th>Associar o documento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php //echo $this->Form->file('Anexo.arquivo', array("class" => 'btn btn-default')); ?> 

                                <input type="file" id="AnexoArquivo" class="btn btn-default" name="data[Anexo][arquivo]"/>

                            </td>
                            <td>
                                <?php
                                //if (isset($anexosSigilosos)) {
                                //echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upload File btn btn-primary', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'anexarDocumentoEdit'));
                                //} else {
                                echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upload File btn btn-primary', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'anexarDocumento'));
                                //}
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Selecionar o Arquivo</label>
                    <?php //echo $this->Form->file('Anexo.arquivo', array("class" => 'btn btn-default')); 
                    ?>
                    <?php //echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upFile btn btn-default', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'img-up-1')); 
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Anexar o Arquivo</label>
                    <br>
                    <?php //echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upload File btn btn-default', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'anexarDocumento'));
                    ?>
                </div>
            </div>
        </div> -->
    </div>



    <br />
    <div id="message"></div>
    <div id="result"></div>
    <div id="lista_anexos" style="margin-top: 15px"></div>
    <input type="submit" id="save_file_submit" style="display: none;" />
    <?php //echo $this->Form->end(); 
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
            // função para selecionar todos anexos
            if ($('#selectAll').length === 0) {
                $("#selecionarTodos").append('<label style="margin-top:10px; margin-right:5px">Selecionar todos anexos</label><input for="selectAll" id="selectAll" type="checkbox">'); 
            
                $("#selectAll").click(function() {
                    if ($(this).prop("checked")) {
                        $("input.anexo[type=checkbox]").prop("checked", $(this).prop("checked"));
                        $("input.anexo[type=checkbox]").click(function() {
                            $("#selectAll").prop("checked", false)
                        });
                        $("input.anexo:checked").each(function() {
                            get_id_anexo_download(this);
                        });
                    } else{
                        $("input.anexo[type=checkbox]").prop("checked", false);
                        $("input.anexo").each(function() {
                            get_id_anexo_download(this);
                        });
                    }  
                });
            }

        $(document).ready(function() {
            //dadosAnexoSigilosos = <?php //echo json_encode(!empty($_SESSION['dadosAnexoSigilosos']) ? $_SESSION['dadosAnexoSigilosos'] : ""); 
                                    ?>;
            idUsuarioCorrente = <?php echo json_encode(!empty($dadosLogado['funcionario_id']) ? $dadosLogado['funcionario_id'] : ""); ?>;
            //const model = <?php //echo json_encode(!empty($model)? $model : ""); 
                            ?>;            

            // Esta funcionalidade trata do controle de exibição dos componentes quanto ao anexo sigiloso. 
            // Quando o usuário estiver trabalhando com Atendimento Pleno o model será ação.
            //if(model === 'Acao'){
            // $("#controleuploadArquivo").hide();
            // $(".AnexoSigiloso").show();
            // }
            // else{
            //     $("#controleuploadArquivo").show();
            //     $(".AnexoSigiloso").hide();
            // }


            $("#controleSigilo").hide();

            // Verifica o valor do campo Tipo de Permissão salvo para o respectivo anexo selecionado
            // id 1 => Comarca 
            // id 2 => Grupo 
            // id 3 => Individual 
            // if (dadosAnexoSigilosos['tipo_permissao_id'] == 1) {
            //     $("#controleComarca").show();
            //     $("#controleGrupo").hide();
            //     $("#controleFuncionario").hide();

            //     if ($("#comarcaConfig").val() != null) {
            //         $("#controleBotaoSalvar").show();
            //     } else {
            //         $("#controleBotaoSalvar").hide();
            //     }
            // } else if (dadosAnexoSigilosos['tipo_permissao_id'] == 2) {
            //     $("#controleComarca").hide();
            //     $("#controleGrupo").show();
            //     $("#controleFuncionario").hide();

            //     if (dadosAnexoSigilosos['listaPerfilGrupo'] != "") {
            //         $("#controleBotaoSalvar").show();
            //     } else {
            //         $("#controleBotaoSalvar").hide();
            //     }
            // } else if (dadosAnexoSigilosos['tipo_permissao_id'] == 3) {
            //     $("#controleComarca").hide();
            //     $("#controleGrupo").hide();
            //     $("#controleFuncionario").show();
            //     $("#controleTabelaFuncionarios").show();

            //     if (dadosAnexoSigilosos['tipo_permissao_id'] != "") {
            //         $("#controleBotaoSalvar").show();
            //     } else {
            //         $("#controleBotaoSalvar").hide();
            //     }

            //     montarTabelaFuncionarioEdit(dadosAnexoSigilosos);
            //     // } else if (dadosAnexoSigilosos['tipo_permissao_id'] == null) {
            //     //     $("#controleComarca").show();
            //     //     $("#controleGrupo").show();
            //     //     $("#controleFuncionario").show();

            // } else {
            //     $("#controleComarca").hide();
            //     $("#controleGrupo").hide();
            //     $("#controleFuncionario").hide();
            //     $("#controleSigilo").hide();
            // }






            $(".AnexoSigiloso").on("change", function() {

                var val = $("#AnexoSigilo1").is(":checked");

                // O valor será true para Arquivo sigiloso
                if (val) {
                    $("#controleSigilo").show();
                    $("#AnexoTipoPermissao").show();
                    $("#controleFuncionario").hide();
                    $("#controleComarca").hide();
                    $("#controleTabelaFuncionarios").hide();
                    $("#controleGrupo").hide();
                    //$("#controleDescricaoGrupo").hide();
                    $("#controleBotaoSalvar").hide();
                    $("#controleuploadArquivo").hide();


                } else {
                    $("#controleSigilo").hide();
                    $("#controleuploadArquivo").show();
                }



            });

            // $("#AnexoTipoAnexoId").on("change", function() {
            //     console.log(jQuery(this).val());

            //     //$("#AnexoTipoAnexoId").
            //     $("#AnexoTipoAnexoId").val(null).trigger("change");
            // });

            $("#controleuploadArquivo").hide();
            $(".AnexoSigiloso").show();

            $("#cancelarManipulacao").hide();
            $("#AnexoTipoPermissao").on("change", function() {

                // id 1 => Comarca 
                // id 2 => Grupo 
                // id 3 => Individual 
                var val = jQuery(this).val();

                if (val == 1) {
                    alert("Ao escolher a comarca qualquer usuário da comarca poderá acessar as informações");
                    $("#controleComarca").show();
                    $("#controleGrupo").hide();
                    $("#controleFuncionario").hide();

                    if ($("#comarcaConfig").val() != null) {
                        if (dadosAnexoSigilosos == "") {
                            $("#controleuploadArquivo").show();
                        } else {
                            $("#controleBotaoSalvar").show();
                        }
                    } else {
                        $("#controleBotaoSalvar").hide();
                        $("#controleuploadArquivo").hide();
                    }

                } else if (val == 2) {
                    $("#controleComarca").hide();
                    $("#controleGrupo").show();
                    $("#controleFuncionario").hide();
                    if ($("#getDescricaoPerfilGrupo").val() != null) {
                        if (dadosAnexoSigilosos == "") {
                            $("#controleuploadArquivo").show();
                        } else {
                            $("#controleBotaoSalvar").show();
                        }
                    } else {
                        $("#controleBotaoSalvar").hide();
                        $("#controleuploadArquivo").hide();
                    }
                } else if (val == 3) {
                    $("#controleComarca").hide();
                    $("#controleGrupo").hide();
                    $("#controleFuncionario").show();

                    if (listaDadosFuncionarios.length > 0) {
                        $("#controleBotaoSalvar").show();
                        if (dadosAnexoSigilosos == "") {
                            $("#controleuploadArquivo").show();
                        } else {
                            $("#controleBotaoSalvar").show();
                        }
                    } else {
                        $("#controleBotaoSalvar").hide();
                        $("#controleuploadArquivo").hide();
                    }
                    if (dadosAnexoSigilosos != "") {
                        $("#controleBotaoSalvar").show();
                    } else {
                        $("#controleBotaoSalvar").hide();
                    }
                } else {
                    $("#controleComarca").hide();
                    $("#controleGrupo").hide();
                    $("#controleFuncionario").hide();
                    $("#controleBotaoSalvar").hide();
                    $("#controleuploadArquivo").hide();
                }

            });

            $('#anexarDocumento').click(function() {
                var form = document.getElementById('<?php echo $idForm; ?>');
                var formData = new FormData(form);
                if ($('#AnexoArquivo').val() === '') {
                    alert('Selecione um arquivo');
                    return false;
                }

                if ($('#AnexoDescricao').val() === '') {
                    alert('Selecione uma descrição para o anexo');
                    return false;
                }

                if ($('#AnexoTipoAnexoId').val() === '') {
                    alert('Selecione o tipo de anexo');
                    return false;
                }

                if ($('.AnexoSigiloso:checked').val() == 1) {

                    var result = verificarCamposSigilosos();

                    /* SE HOUVER RETURN INDEPENDENTE SE FOR FALSE OU TRUE IRÁ IMPEDIR DE PROSSEGUIR */
                    if (result == false) {
                        return false;
                    }

                }

                $.ajax({
                    url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'uploadAnexo', $model, '?' => array('trs' => 1)), true) ?>",
                    type: 'POST',
                    beforeSend: showRequest,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#lista_anexos').html(data);
                        //limparCampos();
                    }
                });
            });

            // function verificarPermissaoEditarAnexoSigiloso() {
            //     if (dadosAnexoSigilosos != "") {
            //         $("#controleSigilo").show();


            //         var verificadorPermissaoUsuario = false;

            //         // Anexo do tipo individual (tipo_permissao_id == 3)?
            //         if (dadosAnexoSigilosos['tipo_permissao_id'] == 3) {

            //             // O usuário que criou o anexo é o mesmo usuário corrente?
            //             if (dadosAnexoSigilosos['funcionario_id'] != idUsuarioCorrente) {
            //                 for (var i = 0; i < dadosAnexoSigilosos['Funcionarios'].length; i++) {
            //                     // O usuário tem acesso ao anexo sigiloso?
            //                     if (dadosAnexoSigilosos['Funcionarios'][i]['Funcionario']['id'] == idUsuarioCorrente) {
            //                         // O usuário tem permissão para editar? 1 para sim e 0 para não
            //                         if (dadosAnexoSigilosos['Funcionarios'][i]['AnexosSigiloso']['nivel_permissao'] == 1) {
            //                             verificadorPermissaoUsuario = true;
            //                         }
            //                     }
            //                 }
            //                 // O usuário tem permissão para acessar ao anexo, contudo somente para visualizar
            //                 if (!verificadorPermissaoUsuario) {
            //                     $("#configMotivo").attr("disabled", true);
            //                     $("#AnexoTipoPermissao").attr("disabled", true);
            //                     $("#buscarNome").attr("disabled", true);
            //                     $("#tabelaFuncionariosModoTabela").attr("disabled", true);
            //                     $("#controleBotaoSalvar").hide();
            //                 }
            //             } else {
            //                 $("#controleBotaoSalvar").show();

            //             }
            //         }


            //     } else {
            //         $("#controleSigilo").hide();
            //     }

            // }
        });



        // Exclui um anexo
        $("body").delegate(".deleteAnexo", "click", function() {
            var teste = $(this).parents(".name-file").text();
            $(this).parents("tr").remove();
        });

        function atualizaListaUpload() {
            var nameFile = $('#AnexoArquivo').val();
            var descricao = $('#AnexoDescricao').val();
            if (descricao == '') {
                descricao = '-';
            }

            var newLine =
                "<tr><td><span class='label'>" + descricao + "</td>" +
                "<td><span class='label name-file'>" + nameFile + "</td>" +
                "<td align='center'>" + '<?php echo $this->Html->link($this->Html->image("icones16/delete16.png", array("border" => 0, "alt" => 'Excluir', "title" => 'Excluir anexo')), "javascript: void(0)", array("class" => 'deleteAnexo', "escape" => false)); ?>' + "</td>" +
                "</tr>";
            $('#AnexoDescricao').val('');
            $('#AnexoArquivo').val('');
            $("#resFile tr:last").after(newLine);
        }

        function showRequest(formData, jqForm, options) {
            var fileToUploadValue = $('#AnexoArquivo').fieldValue();
            var meuPDF = document.getElementById('AnexoArquivo');

            if (meuPDF.files[0].size > 10485760) {
                document.getElementById('message').innerHTML = '<span style="color:red;"><b>Selecione um documento menor que 10MB.</b>';
                return false;
            } else if (!fileToUploadValue[0]) {
                document.getElementById('message').innerHTML = '<span style="color:red;"><b>Selecione um documento.</b>';
                return false;
            }

            return true;
        }

        function showInfoFuncionario(id, nome) {            
            $('#autocompleteFuncionarioContainer').html("");
            $("#controleTabelaFuncionarios").show();
            $("#tabelaFuncionariosModoTabela").show();
            $("#buscarNome").val('');


            listaDadosFuncionarios.push({
                'id': id,
                'nome': nome
            });
            
            // Se a ação for add entra aqui
            if (dadosAnexoSigilosos == "") {
                $("#controleuploadArquivo").show();
                montarTabelaFuncionario();
            }
            // Se a ação for edit entra aqui
            else {
                // Entra aqui caso queira tornar o anexo não sigiloso em sigiloso
                if (dadosAnexoSigilosos['Funcionarios'] == null) {
                    dadosAnexoSigilosos['Funcionarios'] = [];
                    dadosAnexoSigilosos['Funcionarios']['id'] = id;
                    dadosAnexoSigilosos['Funcionarios']['nome'] = nome;
                }
                dadosAnexoSigilosos['Funcionarios'].push({
                    AnexosSigiloso: {
                        nivel_permissao: ""
                    },
                    Funcionario: {
                        id: id
                    },
                    Pessoa: {
                        nome: nome
                    }
                });
                $("#controleBotaoSalvar").show();
                montarTabelaFuncionarioEdit(dadosAnexoSigilosos);
            }

            //$('#nomeAssistido').html(nome);
        }

        $(document).on('keyup', '#buscarNome', function() {

            //var uri = "<?php //echo $this->Html->url(array('controller' => 'amparo_vitimas', 'action' => 'delete')) 
                            ?>" +'/'+ id.substring(1);

            //$.post(uri, function(data){

            var uri = "<?php echo $this->Html->url(array('controller' => 'assistidos', 'action' => 'buscarFuncionario')) ?>" + '/' + $(this).val();

            //if ($(this).val().length > 2) $.get("/assistidos/buscarFuncionario/"+$(this).val(), {}, function (data) {
            if ($(this).val().length > 2) $.get(uri, function(data) {


                data = JSON.parse(data.trim());
                if (data.length > 0) {
                    $('#autocompleteFuncionarioContainer').html(printAutocompleteFuncionario(data));
                } else {
                    $('#autocompleteFuncionarioContainer').html("<span class='text-danger'>Funcionário não encontrado!</span>");
                }

            });
        });

        function printAutocompleteFuncionario(data) {
            var ul = "<ul class='autocomplete_live'>";
            for (var i = 0; i < data.length; i++) {

                ul += "<li> <a href='javascript:void(0)' onclick='showInfoFuncionario(" + data[i]['Funcionario']['id'] + ",\"" + data[i]['Pessoa']['nome'] + "\")'>" + data[i]['Pessoa']['nome'] + "</a> </li>";
            }
            ul += "</ul>";
            return ul;
        }

        function montarTabelaFuncionario() {
            var table_row = '';
            $("#tabelaFuncionariosModoTabela > tbody").html("");
            table_row = '<tbody>';
            for (var i = 0; i < listaDadosFuncionarios.length; i++) {
                table_row += '<tr>';
                table_row += '<td style="height: 30px;">' +
                    '<input type="hidden" name="Anexo[funcionario][' + [i] + '][id]" value="' + listaDadosFuncionarios[i]['id'] + '">' + listaDadosFuncionarios[i]['nome'] +
                    '</td>';
                table_row += '<td style="height: 30px;">' +
                    '<div class="form-group">' +
                    '<input type="radio"  name="Anexo[funcionario][' + [i] + '][nivel_permissao]" value="1" class="Anexo[funcionario][' + [i] + ']"/>' +
                    '<label>Pode alterar</label> &nbsp;&nbsp;' +
                    '<input type="radio"  name="Anexo[funcionario][' + [i] + '][nivel_permissao]" value="0" class="Anexo[funcionario][' + [i] + ']" />' +
                    '<label>Visualizar somente</label>' +
                    '</td>';
                table_row += '<td align=center  style="height: 30px;">' +
                    '<a href=javascript:void(0) onclick="DeletarFuncionarioSelecionado(' + listaDadosFuncionarios[i]['id'] + ')">' +
                    '<div class="glyphicon glyphicon-remove-circle"></div>' +
                    '</a>';
                table_row += '</tr>';
            }
            table_row += '</tbody>';

            $("#tabelaFuncionariosModoTabela").append(table_row);
        }

        function montarTabelaFuncionarioEdit(dadosAnexoSigilosos) {
            var table_row = '';
            $("#tabelaFuncionariosModoTabela > tbody").html("");
            table_row = '<tbody>';
            for (var i = 0; i < dadosAnexoSigilosos['Funcionarios'].length; i++) {
                //console.log(listaDadosFuncionarios[i]);
                var nivel_permissao1 = dadosAnexoSigilosos['Funcionarios'][i]['AnexosSigiloso']['nivel_permissao'] == 1 ? "checked" : "";
                var nivel_permissao0 = dadosAnexoSigilosos['Funcionarios'][i]['AnexosSigiloso']['nivel_permissao'] == 1 ? "" : "checked";

                if (dadosAnexoSigilosos['Funcionarios'][i]['AnexosSigiloso']['nivel_permissao'] == "") {
                    nivel_permissao1 = "";
                    nivel_permissao0 = "";
                } else if (nivel_permissao1 = dadosAnexoSigilosos['Funcionarios'][i]['AnexosSigiloso']['nivel_permissao'] == 1) {
                    nivel_permissao1 = "checked";
                    nivel_permissao0 = "";
                } else {
                    nivel_permissao1 = "";
                    nivel_permissao0 = "checked";
                }

                table_row += '<tr style="height: 30px;">';
                table_row += '<td style="height: 30px;">' +
                    '<input type="hidden" name="Anexo[funcionario][' + [i] + '][id]" value="' + dadosAnexoSigilosos['Funcionarios'][i]['Funcionario']['id'] + '">' + dadosAnexoSigilosos['Funcionarios'][i]['Pessoa']['nome'] +
                    '</td>';
                table_row += '<td style="height: 30px;">' +
                    '<div class="form-group">' +
                    '<input type="radio"  name="Anexo[funcionario][' + [i] + '][nivel_permissao]" value="1" ' + nivel_permissao1 + ' class="Anexo[funcionario][' + [i] + ']"/>' +
                    '<label>Pode alterar</label> &nbsp;&nbsp;' +
                    '<input type="radio"  name="Anexo[funcionario][' + [i] + '][nivel_permissao]" value="0" ' + nivel_permissao0 + ' class="Anexo[funcionario][' + [i] + ']" />' +
                    '<label>Visualizar somente</label>' +
                    '</td>';
                table_row += '<td align=center  style="height: 30px;">' +
                    '<a href=javascript:void(0) onclick="DeletarFuncionarioSelecionadoEdit(' + dadosAnexoSigilosos['Funcionarios'][i]['Funcionario']['id'] + ')">' +
                    '<div class="glyphicon glyphicon-remove-circle"></div>' +
                    '</a>';
                table_row += '</tr>';
            }
            table_row += '</tbody>';

            $("#tabelaFuncionariosModoTabela").append(table_row);
        }

        function DeletarFuncionarioSelecionado(id) {

            // Pecorre o array para excluir o funcionário selecionado em add            
            if (listaDadosFuncionarios.length > 0) {
                for (var i = 0; i < listaDadosFuncionarios.length; i++) {
                    if (listaDadosFuncionarios[i].id == id) {
                        listaDadosFuncionarios.splice(i, 1);
                        break;
                    }
                }
            }


            montarTabelaFuncionario();
            if (listaDadosFuncionarios.length > 0) {
                $("#controleuploadArquivo").show();
                $("#controleTabelaFuncionarios").show();

            } else {
                $("#controleuploadArquivo").hide();
                $("#controleTabelaFuncionarios").hide();
            }

        }

        function DeletarFuncionarioSelecionadoEdit(id) {

            // Pecorre o array para excluir o funcionário selecionado no edit            
            if (dadosAnexoSigilosos['Funcionarios'].length > 0) {
                for (var i = 0; i < dadosAnexoSigilosos['Funcionarios'].length; i++) {
                    if (dadosAnexoSigilosos['Funcionarios'].length > 0) {
                        if (dadosAnexoSigilosos['Funcionarios'][i]['Funcionario']['id'] == id) {
                            dadosAnexoSigilosos['Funcionarios'].splice(i, 1);
                        }

                    }
                }
            }

            montarTabelaFuncionarioEdit(dadosAnexoSigilosos);
            if (dadosAnexoSigilosos['Funcionarios'].length > 0) {
                $("#controleTabelaFuncionarios").show();
                $("#controleBotaoSalvar").show();
            } else {
                $("#controleTabelaFuncionarios").hide();
                $("#controleBotaoSalvar").hide();
            }
        }

        function excluirAnexoBanco(model, id, numeroElemento) {

            if (confirm('Deseja realmente excluir o arquivo ?') == true) {
            $.ajax({
                url: "<?php echo $this->webroot; ?>anexos/removeAnexo/" + model + '/' + id + '/' + true + '?trs=1',
                success: function() {
                    // Pecorre as linhas da tabela em busca do nome da classe na própria linha, caso o nome da classe seja encontrada então a linha será removida
                    var table = document.getElementById("tabelaAnexos");
                        for (var i = 1, row; row = table.rows[i]; i++) {
                            if (numeroElemento == row.className) {
                                row.parentNode.removeChild(row);
                            }
                        }
                }
            });
        }

        }

        function excluiAnexo(model, id) {
            $.ajax({
                url: "<?php echo $this->webroot; ?>anexos/removeAnexo/" + model + '/' + id + '?trs=1',
                success: function(data) {

                    $('#lista_anexos').html(data);
                }
            });
        }

        // Caso tenha sido marcado anexo sigiloso, então é realizado uma seŕie de verificaçãoes        
        function verificarCamposSigilosos() {

            resultado = true;
            // id 1 => Comarca 
            // id 2 => Grupo 
            // id 3 => Individual 
            if ($("#AnexoTipoPermissao").val() == 1) {
                var valor = $("#comarcaConfig").val();

                if (valor == null) {
                    alert("Selecione alguma comarca para associar ao anexo.");
                    resultado = false;
                }

            } else if ($("#AnexoTipoPermissao").val() == 2) {
                var valor = $("#getDescricaoPerfilGrupo").val();
                if (valor == null) {
                    alert("Selecione algum perfil para associar ao anexo.");
                    resultado = false;
                }

            } else if ($("#AnexoTipoPermissao").val() == 3) {

                // Vai entrar aqui caso a ação seja edit                
                if (dadosAnexoSigilosos != "") {
                    // Faz um loop verificando se foi marcado permissão para os funcionários adicionados                    
                    for (var i = 0; i < dadosAnexoSigilosos['Funcionarios'].length; i++) {
                        var radio = $("input[type=radio][name='Anexo[funcionario][" + i + "][nivel_permissao]']").filter(":checked")[0];
                        if (!radio) {
                            alert('permissão não adicionada para ' + dadosAnexoSigilosos['Funcionarios'][i]['Pessoa']['nome']);
                            resultado = false;
                        }
                    }

                    // Vai entrar aqui caso a ação seja add                    
                } else {
                    if (listaDadosFuncionarios.length < 1) {
                        alert("Selecione o funcionário a dar permissão ao anexo.");
                        resultado = false;
                    } else {

                        // Faz um loop verificando se foi marcado permissão para os funcionários adicionados                        
                        for (var i = 0; i < listaDadosFuncionarios.length; i++) {

                            var radio = $("input[type=radio][name='Anexo[funcionario][" + i + "][nivel_permissao]']").filter(":checked")[0];
                            if (!radio) {
                                alert('permissão não adicionada para ' + listaDadosFuncionarios[i]['nome']);
                                resultado = false;
                            }
                        }
                    }
                }

            } else {
                alert("Selecione o Tipo de permissão.");
                resultado = false;
            }

            return resultado;
        }

        function setValoresEnvioEmail(idAnexo_, idFuncionarioCorrente_) {
            idAnexo = idAnexo_;
            idFuncionarioCorrente = idFuncionarioCorrente_;

            $('#modalObterAutorizacao').modal();
        }


        // Solicitar autorização para os funcionários para ter acesso ao anexo
        $("#solicitarAutorizacao").on("click", function() {
            try {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'solicitarAcessoAnexoSigilosoViaEmail',  '?' => array('trs' => 1)), true) ?>",
                    type: 'POST',
                    data: {
                        "data": [{
                            "idAnexo": idAnexo,
                            "idFuncionarioCorrente": idFuncionarioCorrente
                        }]
                    },

                    success: function(data) {
                        $("#modalObterAutorizacao").modal('hide');
                        alert("E-mail enviado com sucesso.");
                    }
                });
            } catch (error) {
                console.log(error);
            }

        });

        function setValoresTornarAnexoSigiloso(idAnexoSigilo_, idFuncionarioAnexo_) {
            idAnexoSigilo = idAnexoSigilo_;
            idFuncionarioAnexo = idFuncionarioAnexo_;

            $('#modalTornarAnexoSigiloso').modal();
        }

        $("#tornarAnexoSigiloso").on("click", function() {
            try {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'getDadosAnexoParaEditSigilo',  '?' => array('trs' => 1)), true) ?>",
                    type: 'POST',
                    data: {
                        "data": [{
                            "idAnexoSigilo": idAnexoSigilo,
                            "idFuncionarioAnexo": idFuncionarioAnexo
                        }]
                    },

                    success: function(data) {

                        var d = JSON.stringify(eval("(" + data + ")"));
                        var dados = JSON.parse(d);

                        limparCampos();
                        controleExibicaoModoEdit()
                        preencherCamposSigiloModoEdit(dados);
                        desabilitarCamposSigiloModoEdit();

                        dadosAnexoSigilosos = dados;

                        $('#controleBotaoSalvar').hide();
                        $('#modalTornarAnexoSigiloso').modal("hide");

                    }
                });
            } catch (error) {
                console.log(error);
            }


        });

        function editarAnexoSigiloso(idAnexo, idAcao) {

            try {

                $.ajax({
                    url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'getDadosAnexoSigiloso',  '?' => array('trs' => 1)), true) ?>",
                    type: 'POST',
                    data: {
                        "data": [{
                            "idAnexo": idAnexo,
                            "idAcao": idAcao
                        }]
                    },

                    success: function(data) {
                        var d = JSON.stringify(eval("(" + data + ")"));
                        var dados = JSON.parse(d);

                        limparCampos();
                        controleExibicaoModoEdit()
                        preencherCamposSigiloModoEdit(dados);
                        desabilitarCamposSigiloModoEdit();
                        carregarCamposAnexoSigiloso(dados);

                        dadosAnexoSigilosos = dados;


                    }
                });
            } catch (error) {
                console.log(error);
            }

        };

        function preencherCamposSigiloModoEdit(dados) {
            // Extrai exatamente os ids necessários para preencher os campos
            var dadosNotificacaoAbstraido = dados.FuncionariosNotificacao;

            let idFuncionariosEmail = dadosNotificacaoAbstraido.map(a => a.AnexosFuncionario.funcionario_id);

            $("#AnexoDescricao").val(dados.Anexo.descricao);
            $("#AnexoTipoAnexoId").val(dados.Anexo.tipo_anexo_id).trigger("change");
            $("#AnexoDefensorNotificadoId").val(idFuncionariosEmail).trigger("change");

            $("#AnexoSigilo1").prop("checked", true);
            $("#AnexoSigilo0").prop("checked", false);
        }

        function desabilitarCamposSigiloModoEdit() {
            $("#AnexoDescricao").prop("disabled", true);
            $("#AnexoTipoAnexoId").prop("disabled", true);
            $("#AnexoDefensorNotificadoId").prop("disabled", true);
            $("#AnexoSigilo1").prop("disabled", true);
            $("#AnexoSigilo0").prop("disabled", true);
        }

        function habilitarCamposSigiloModoEdit() {
            $("#AnexoDescricao").prop("disabled", false);
            $("#AnexoTipoAnexoId").prop("disabled", false);
            $("#AnexoDefensorNotificadoId").prop("disabled", false);
            $("#AnexoSigilo1").prop("disabled", false);
            $("#AnexoSigilo0").prop("disabled", false);
        }

        function controleExibicaoModoEdit() {
            $("#controleSigilo").show();
            $("#cancelarManipulacao").show();
            $("#controleComarca").hide();
            //$("#controleDescricaoGrupo").hide();
            $("#controleGrupo").hide();
            $("#controleuploadArquivo").hide();


        }

        function carregarCamposAnexoSigiloso(dados) {

            $("#configMotivo").val(dados.Anexo.motivo);
            $("#AnexoTipoPermissao").val(dados.Anexo.tipo_permissao_id);

            var tipoPermissao = dados.Anexo.tipo_permissao_id;

            if (tipoPermissao == 1) {
                let comarcaID = dados.AnexoSigiloso.map(a => a.Anexo_Sigiloso.comarca_id);
                $("#controleComarca").show();
                $("#comarcaConfig").val(comarcaID).trigger("change");
                $("#controleuploadArquivo").hide();
            } else if (tipoPermissao == 2) {
                let perfilID = dados.AnexoSigiloso.map(a => a.Anexo_Sigiloso.perfil_id);
                $("#controleGrupo").show();
                $("#getDescricaoPerfilGrupo").val(perfilID).trigger("change");
                $("#controleuploadArquivo").hide();
            } else if (tipoPermissao == 3) {
                montarTabelaFuncionarioEdit(dados);
                $("#controleFuncionario").show();
                $("#controleTabelaFuncionarios").show();
            }
            $("#controleBotaoSalvar").show();
        }

        $(document).on('keyup', '#buscarNome', function() {

            var uri = "<?php echo $this->Html->url(array('controller' => 'assistidos', 'action' => 'buscarFuncionario')) ?>" + '/' + $(this).val();

            if ($(this).val().length > 2) $.get(uri, function(data) {


                data = JSON.parse(data.trim());
                if (data.length > 0) {
                    $('#autocompleteFuncionarioContainer').html(printAutocompleteFuncionario(data));
                } else {
                    $('#autocompleteFuncionarioContainer').html("<span class='text-danger'>Funcionário não encontrado!</span>");
                }

            });
        });


        $(document).on('change', '#getDescricaoPerfilGrupo', function() {

            var valor = $(this).val();

            if (valor != null) {

                // A variável dadosAnexoSigilosos será null quando a ação modo Add, caso contrário o modo é Edit
                if (dadosAnexoSigilosos == "") {
                    $("#controleuploadArquivo").show();
                } else {
                    $("#controleBotaoSalvar").show();
                }

            } else {
                $("#controleuploadArquivo").hide();
                $("#controleBotaoSalvar").hide();
            }

        });


        $(document).on('change', '#comarcaConfig', function() {

            var valor = $(this).val();

            if (valor != null) {
                // A variável dadosAnexoSigilosos será null quando a ação modo Add, caso contrário o modo é Edit
                if (dadosAnexoSigilosos == "") {
                    $("#controleuploadArquivo").show();
                } else {
                    $("#controleBotaoSalvar").show();
                }
            } else {
                $("#controleuploadArquivo").hide();
                $("#controleBotaoSalvar").hide();
            }
        });

        $("#salvarDadosEditAnexo").on("click", function() {
            var form = document.getElementById('<?php echo $idForm; ?>');
            var formData = new FormData(form);

            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'salvarDadosAnexoSigilosoEdit')) ?>" + "/" + dadosAnexoSigilosos.Anexo.id,
                type: 'POST',

                data: formData,
                beforeSend: verificarCamposSigilosos,
                processData: false,
                contentType: false,
                success: function(data) {
                    alert("Dados salvos com sucesso");
                    //dadosAnexoSigilosos = "";
                    //limparCampos();
                    document.location.reload(true);
                }

            });
        });


        function limparCampos() {
            $("#tabelaFuncionariosModoTabela > tbody").html("");
            listaDadosFuncionarios = [];
            $("#AnexoTipoPermissao").val("");
            $("#configMotivo").val("");
            $(".AnexoSigiloso").prop("checked", false);
            $("#AnexoDescricao").val("");
            $("#AnexoTipoAnexoId").val(null).trigger("change");
            $("#AnexoDefensorNotificadoId").val(null).trigger("change");
            $("#AnexoSigilosoTipoAnexoId").val(null).trigger("change");
            $("#AnexoSigilosoDefensorNotificadoId").val(null).trigger("change");
            $("#comarcaConfig").val(null).trigger("change");
            $("#getDescricaoPerfilGrupo").val(null).trigger("change");
            comarcaConfig
            $("#controleSigilo").hide();
            $("#controleFuncionario").hide();
            $("#controleComarca").hide();
            $("#controleuploadArquivo").hide();
            $("#controleTabelaFuncionarios").hide();
            $("#controleGrupo").hide();
            $("#cancelarManipulacao").hide();

            habilitarCamposSigiloModoEdit();
        }

        $('#cancelarManipulacao').click(function() {
            limparCampos();
        });
    </script>

</body>

</html>
