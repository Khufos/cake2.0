<div id="resolExtra">
    
    <?php
    $simNao = array(0 => 'Não', 1 => 'Sim');
    if (!empty($this->data['ResolucaoExtrajudicialSaude'])) {

        ?>
        <?php
        foreach ($this->data['ResolucaoExtrajudicialSaude'] as $key => $value) {
//            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                   
            <?php
            echo $this->Js->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-minus-sign')), array(
                'controller' => 'ResolucaoExtrajudicialSaudes', 'action' => "novaResolExtrajud/$key/$idForm/?trs=1"), array(
                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                'update' => '#resolExtra',
                'id' => "bt-remove$key",
                'complete' => 'refreshJquery();',
                'method' => 'POST',
                'async' => true,
                'class' => 'oculto',
                'dataExpression' => true,
                'title' => 'Remover',
                'escape' => false
                    )
            );
            echo $this->Js->writeBuffer();
            ?>
            <script type="text/javascript">
            $( document ).ready(function() {
                $('#close<?php echo $key; ?>').click(function () {
                    $("#bt-remove<?php echo $key; ?>").click();
                })
            });
            </script>
            <button type="button" class="close" id="close<?php echo $key; ?>" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                    
                    <?php echo $key+1 ?>ª Resolução Extrajudicial444444444</div>
                <div class="panel-body">
                    <div class="row">
                    <div class="col-xs-6 col-md-3 form-group">
                            <label>Forma Contato:</label>
                    <?php echo $this->Form->select("ResolucaoExtrajudicialSaude.$key.forma_contato", $formaContato, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                    </div>
                    <div class="col-xs-6 col-md-3 form-group">
                        <label>Data Contato:</label>
                        <?php echo $this->Form->input("ResolucaoExtrajudicialSaude.$key.data_contato", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                    </div>
                    <div class="col-xs-6 col-md-3 form-group">
                            <label>Órgão Destinatário:</label>
                            <?php echo $this->Form->select("ResolucaoExtrajudicialSaude.$key.orgao_destinatario", $orgaoDest, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm orgaoDest', 'num' => $key)); ?>
                        <?php
                        if (!empty($municipio)) {
                            $idCidade = key($municipio);
                            $cidades = array_map("utf8_encode", $municipio);
                        }
                        $args = array(
                                        'class' => 'form-control input-sm',
                                        'empty' => 'Selecione',
                                        'label' => false
                                    ); 
                        ?>
                    </div>
                    <div class="col-md-3 form-group">
                    <?php $exibirMun = (isset($value['orgao_destinatario']) && (($value['orgao_destinatario'] == 28) || ($value['orgao_destinatario'] == 29) )) ? 'display: block' : 'display: none'; ?>
                        <div  id="<?= $key . 'cidadeOrgDest'; ?>" style="<?php echo $exibirMun; ?>">
                        <label>Cidade:</label>
                        <?php
                        //$cidades = $this->Util->setaValorPadrao($dadosAssistido['cidade'], null);
                        if (!empty($municipio)) {
                            $idCidade = key($municipio);
                            $cidades = array_map("utf8_encode", $municipio);
                        }
                        $args = array(
                            'class' => 'form-control input-sm',
                            'empty' => 'Selecione',
                            'label' => false
                        );
                        echo $this->Form->select("ResolucaoExtrajudicialSaude.$key.cidade_id", $cidades, $args);
                        ?>
                        </div>
                    </div>
                        
                    <?php
                    $this->request->data['ResolucaoExtrajudicialSaude'][$key]['id'] = isset($this->data['ResolucaoExtrajudicialSaude'][$key]['id']) ? $this->request->data['ResolucaoExtrajudicialSaude'][$key]['id'] : NULL;
//                    echo $this->Form->text("Enfermidade.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['id'], "")));
                    echo $this->Form->input("ResolucaoExtrajudicialSaude.$key.id", array('type' => 'hidden', 'value' => $this->data['ResolucaoExtrajudicialSaude'][$key]['id']));
                    ?>
                </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-3">
                        <label>Houve Resolução?</label>
                        <?php echo $this->Form->select("ResolucaoExtrajudicialSaude.$key.resolucao", $simNao, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <label>Ação Proposta?</label>
                        <?php echo $this->Form->select("ResolucaoExtrajudicialSaude.$key.acao_proposta", $simNao, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                    </div>
                   <!-- <div class="col-xs-6 col-md-3">
                        <label>Observacao</label>
                        <?php // echo $this->Form->textarea("ResolucaoExtrajudicialSaude.$key.observacao", array('class' => 'form-control input-sm')); ?>
                    </div> -->
                    </div>
                </div>
            </div>
        <?php } ?>


    <?php } else { ?>
        <div class="panel panel-default">
            <div class="panel-heading">1ª Resolução Extrajudicial</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-md-3 form-group">
                        <label>Forma Contato:</label>
                        <?php echo $this->Form->select("ResolucaoExtrajudicialSaude.0.forma_contato", $formaContato, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                    </div>
                    <div class="col-xs-6 col-md-3 form-group">
                        <label>Data Contato:</label>
                        <?php echo $this->Form->input("ResolucaoExtrajudicialSaude.0.data_contato", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                    </div>
                    <div class="col-xs-6 col-md-3 form-group">
                            <label>Órgão Destinatário:</label>
                            <?php echo $this->Form->select("ResolucaoExtrajudicialSaude.0.orgao_destinatario", $orgaoDest, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm orgaoDest', 'num' => 0)); ?>
                        <?php
                        if (!empty($municipio)) {
                            $idCidade = key($municipio);
                            $cidades = array_map("utf8_encode", $municipio);
                        }
                        $args = array(
                                        'class' => 'form-control input-sm',
                                        'empty' => 'Selecione',
                                        'label' => false
                                    ); 
                        ?>
                    </div>
                    <div class="col-md-3 form-group">
                    <?php $exibirMun = (isset($this->data['ResolucaoExtrajudicialSaude'][0]['orgao_destinatario']) && (($this->data['ResolucaoExtrajudicialSaude'][0]['orgao_destinatario'] == 28) || ($this->data['ResolucaoExtrajudicialSaude'][0]['orgao_destinatario'] == 29) )) ? 'display: block' : 'display: none'; ?>
                        
                        <div  id="0cidadeOrgDest" style="<?php echo $exibirMun; ?>">
                        <label>Cidade:</label>
                        <?php
                        //$cidades = $this->Util->setaValorPadrao($dadosAssistido['cidade'], null);
                        if (!empty($municipio)) {
                            $idCidade = key($municipio);
                            $cidades = array_map("utf8_encode", $municipio);
                        }
                        $args = array(
                            'class' => 'form-control input-sm',
                            'empty' => 'Selecione',
                            'label' => false
                        );
                        echo $this->Form->select('ResolucaoExtrajudicialSaude.0.cidade_id', $cidades, $args);
                        ?>
                        <div class="exibe-cidade"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-3 form-group">
                        <label>Houve Resolução?</label>
                        <?php //echo $this->Form->input('AcaoHistorico.id', array('type' => 'hidden')); ?>
                        <?php echo $this->Form->select("ResolucaoExtrajudicialSaude.0.resolucao", $simNao, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                    </div>
                    <div class="col-xs-6 col-md-3 form-group">
                        <label>Ação Proposta?</label>
                        <?php echo $this->Form->select("ResolucaoExtrajudicialSaude.0.acao_proposta", $simNao, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                    </div>
                    <!-- <div class="col-xs-6 col-md-3 form-group">
                        <label>Observação:</label>
                        <?php // echo $this->Form->textarea("ResolucaoExtrajudicialSaude.0.observacao", array('class' => 'form-control input-sm')); ?>
                    </div> -->
                </div>
            </div>
        </div>
    <?php } ?>
    
</div>
<!--<div style="float:right;">-->
<?php
echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
    'controller' => 'resolucao_extrajudicial_saudes',
    'action' => "novaResolExtrajud/-1/$idForm/" . $this->params['controller'] . "?trs=1"
        ), array(
    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
    'before' => $this->Js->get('#loading')->effect('show'),
    'success' => $this->Js->get('#loading')->effect('hide'),
    'div' => false,
    'complete' => 'refreshJquery();runEffect();',
    'update' => '#resolExtra',
    'method' => 'POST',
    'async' => true,
    'dataExpression' => true,
    'title' => 'Adicionar Resolução Extrajudicial',
    'class' => 'btn btn-default',
    'escape' => false
));
?>
<!--</div>-->
<script>
$(document).ready(function(){
//    $('#ResolExtrajud0OrgaoDestinatarioId').on("change", function () {
//            if($(this).val() == 1 || $(this).val() == 3){
//                $("#cidadeOrgDest").css("display", "block");
//            }else{
//                $("#cidadeOrgDest").css("display", "none");
//            }
//        });
    
    $('.orgaoDest').on("change", function () {
            var num = $(this).attr('num');
            var nome = +num+'cidadeOrgDest';
            
            if($(this).val() == 28 || $(this).val() == 29){
                $("#"+nome).css("display", "block");
                $("div.exibe-cidade").html('<input type="hidden" name="ResolExtrajud['+num+'][exibe-cidade]" id="ResolExtrajud'+num+'exibe-cidade" value="1">');
            }else{
                $("#"+nome).css("display", "none");
            }
        });
        
    
});
</script>

