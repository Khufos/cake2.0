<script type="text/javascript">
    $(document).ready(function () {
        $("#openerManifestacao").click(function () {
            showContentModal(250, 680, '#dialogManifestacao', 'Hist�rico', '#openerManifestacao');
        });
        $("#btnModeloManifestacao").click(function () {
            $("#nowLoading").ajaxStart(function () {
                $(this).css("z-index", 99999);
                $(this).show();
            });

            var index = $(this).attr("index");
            var controller = $(this).attr("controller");
            $.ajax({
                url: "<?php echo $this->webroot ?>documentos/addDoc/<?php echo $idForm ?>/Manifestacao/" + controller + "/?trs=1&index=" + $(this).attr("index"),
                type: "POST",
                cache: false,
                data: $("#<?php echo $idForm; ?>").serializeArray(),
                success: function (data) {
                    $("#ManifestacaoContent" + index).empty().html(data).show();
                },
                error: function (data) {
                    alert(index);
                }
            });
            $("#nowLoading").ajaxStop(function () {
                $(this).hide();
            });
        });
    });
</script>
<div id="manif">
    <?php
    $tipoManifestacao = $this->Session->read('tipoManifestacao');

    if (!empty($manifestacoes)) {
        FireCake::info($manifestacoes, "\$manifestacoes");
        ?>
        <?php
        foreach ($manifestacoes as $key => $value) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $key+1 ?>ª Manifestação</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Provid&ecirc;ncias:</label>
                                <?php
                                echo $this->Form->select("Manifestacao.$key.tipo_manifestacao_id", $tipoManifestacao, array(
                                    'default' => $value['tipo_manifestacao_id'],
                                    'class' => 'form-control input-sm',
                                    'empty' => 'Selecione'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Data:</label>
                                <?php
                                echo $this->Form->input("Manifestacao.$key.data_manifestacao", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $this->Util->ddmmaa($value['data_manifestacao'])));
                                echo $this->Form->text("$modelAssocManif.$key.id", array('type' => 'hidden', 'value' => $value[$modelAssocManif]['id']));
                                echo $this->Form->text("Manifestacao.$key.id", array('type' => 'hidden', 'value' => $value['id']));
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--                <div class="col-xs-6 col-md-4">
                                        <div class="form-group">
                                            <label>Documento:</label>
                    <?php
//                        if (!empty($value['documento_id'])) { // Existe documento associado?
//                            echo $this->Html->link($this->Html->image("icones32/page_search.png", array("alt" => "Visualizar", "border" => 0)), array("controller" => 'documentos', "action" => "gerarPdf/" . $value['documento_id']), array('escape' => false, "target" => '_blank'));
//                            // ID Oculto do documento
//                        } else {
//                            echo $this->Form->button('Modelo de Documento', array("class" => 'btnModeloManifestacao', "id" => $key, "controller" => $this->params['controller']));
//                            echo $this->Form->input("Manifestacao.$key.modelo_documento_id", array('type' => 'hidden'));
//                            echo $this->Form->input("Manifestacao.$key.conteudo", array('type' => 'hidden'));
//                        }
//                        echo $this->Form->input("Manifestacao.$key.documento_id", array('value' => $value['documento_id'], 'type' => 'hidden'));
                    ?>
                                        </div>
                                    </div>-->
                    <div class="row">
                        <div class="col-xs-6 col-md-12">
                            <div class="form-group">
                                <div id="ManifestacaoContent<?php echo $key ?>">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


    <?php } else { ?>
        <div class="panel panel-default">
            <div class="panel-heading">Manifestação</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Provid&ecirc;ncias:</label>
                            <?php echo $this->Form->select("Manifestacao.0.tipo_manifestacao_id", $tipoManifestacao, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Data:</label>
                            <?php echo $this->Form->input("Manifestacao.0.data_manifestacao", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                        </div>
                    </div>
                </div>          
                <!--            <div class="col-xs-6 col-md-4">
                                <div class="form-group">
                                    <label>Documento:</label>
                                    <br>
                <?php
//                    echo $this->Form->button('Modelo de Documento', array('class' => 'btn btn-default', "id" => 'btnModeloManifestacao', "index" => 0, 'controller' => $this->params['controller']));
//                    echo $this->Form->input("Manifestacao.0.modelo_documento_id", array('type' => 'hidden'));
//                    echo $this->Form->input("Manifestacao.0.conteudo", array('type' => 'hidden'));
                ?>
                                </div>
                            </div>-->
                <div class="row">
                    <div class="col-xs-6 col-md-12">
                        <div class="form-group">
                            <div id="ManifestacaoContent0">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
    'controller' => 'manifestacoes',
    'action' => "novaManifestacao/-1/$idForm/$modelAssocManif/" . $this->params['controller'] . "?trs=1"
        ), array(
    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
    'before' => $this->Js->get('#loading')->effect('show'),
    'success' => $this->Js->get('#loading')->effect('hide'),
    'div' => false,
    'complete' => 'refreshJquery();runEffect();',
    'update' => '#manif',
    'method' => 'POST',
    'async' => true,
    'dataExpression' => true,
    'title' => 'Novo',
    'class' => 'btn btn-default',
    'escape' => false
));
?>


<!--<div class="demo">
    <div id="dialogManifestacao"></div>
<?php
//ESSE BOTÃO FOI COMENTADO POIS O FUNCINAMENTO DELE ALÉM DE ESTA DANDO ERRO NA QUERY, PARECE QUE ESTÁ INCOMPLETO
//TODO: REVER ESSA FUNCIONANLIDADE
//    $this->Util->setaValorPadrao($edit, false);
//    if ($edit) {
//        echo $this->Html->link($this->Html->div('glyphicon glyphicon-list-alt', ''), array(
//            'controller' => 'manifestacoes',
//            'action' => "historico/$model?trs=1"
//                ), array(
//            'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
//            'complete' => 'refreshJquery();',
//            'class' => 'link-modal',
//            'data-target' => "#modal",
//            'data-toggle' => "modal",
//            'escape' => false
//        ));
//    }
?>
</div>-->

