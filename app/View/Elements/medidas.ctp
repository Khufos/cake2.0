<?php
$tipoMedidas = $this->Session->read('tipoMedidas');
$tpResultMedida = $this->Session->read('tpResultMedida');

$this->Util->setaValorPadrao($exibirResultado, 1);
?>
<div id="medidas">
    <?php
    //FireCake::info($medidas, "\$medidas");
    if (!empty($medidas)) {
        foreach ($medidas as $key => $med) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Medida</div>
                <div class="panel-body">
                    <div class="row" id="MedidaContent<?php echo $key; ?>">
                        <div class="col-md-3">  
                            <div class="form-group">
                                <label>Tipo de Medida:</label>
                                <?php
                                $args = array('class' => 'form-control input-sm');

                                if (isset($med['Medida']['tipo_medida_id']))
                                    $args['default'] = $this->Util->ddmmaa($med['Medida']['tipo_medida_id']);

                                echo $this->Form->select("Medida.$key.tipo_medida_id", $tipoMedidas, $args);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-2">  
                            <div class="form-group">
                                <label>Data:</label>
                                <?php
                                $args = array(
                                    'class' => 'form-control input-sm data',
                                    'data-date-format' => 'DD/MM/YYYY',
                                    'label' => false
                                );
                                if (isset($med['Medida']['data_medida']))
                                    $args['default'] = $this->Util->ddmmaa($med['Medida']['data_medida']);

                                echo $this->Form->text("Medida.$key.data_medida", $args);
                                ?>                            
                            </div>
                        </div>
                        <?php if ($exibirResultado == 1) { ?>
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label>Resultado:</label>
                                    <?php
                                    $args = array(
                                        'class' => 'form-control input-sm',
                                        'label' => false
                                    );
                                    if (isset($med['Medida']['Resultado']['tipo_resultado_id'])) {
                                        $args['default'] = $med['Medida']['Resultado']['tipo_resultado_id'];
                                    }

                                    echo $this->Form->select("Resultado.$key.tipo_resultado_id", $tpResultMedida, $args);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-2">  
                                <div class="form-group">
                                    <label>Data:</label>
                                    <?php
                                    $args = array(
                                        'class' => 'form-control input-sm data',
                                        'data-date-format' => 'DD/MM/YYYY',
                                        'label' => false
                                    );

                                    if (isset($med['Medida']['Resultado']['data_resultado']))
                                        $args['default'] = $this->Util->ddmmaa($med['Medida']['Resultado']['data_resultado']);

                                    echo $this->Form->text("Resultado.$key.data_resultado", $args);
                                    echo $this->Form->input("Resultado.$key.id", array('value' => $med['Medida']['Resultado']['id'], 'type' => 'hidden'));
                                    ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
//                if (!empty($med['Medida']['documento_id'])) { // Existe documento associado?
//                    echo $this->Html->link($this->Html->image("icones32/page_search.png", array("alt" => "Visualizar", "border" => 0)), array("controller" => 'documentos', "action" => "gerarPdf/" . $med['Medida']['documento_id']), array('escape' => false, "target" => '_blank'));
//                    // ID Oculto do documento
//                } else {
//                    echo $this->Form->button('Modelo de Documento', array("class" => 'btnModeloMedida', "id" => $key, "controller" => $this->params['controller']));
//                    echo $this->Form->hidden("Medida.$key.modelo_documento_id");
//                    echo $this->Form->hidden("Medida.$key.conteudo");
//                }
                        echo $this->Form->hidden("$modelAssociaMedida.$key.id", array('value' => $med[$modelAssociaMedida]['id']));
                        echo $this->Form->hidden("Medida.$key.id", array('value' => $med['Medida']['id']));
//                echo $this->Form->hidden("Medida.$key.documento_id", array('value' => $med['Medida']['documento_id'])); // Id do documento associado
                        ?>

                    </div>
                </div>
            </div>
        <?php } ?>

        <?php
    } else {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Medida</div>
            <div class="panel-body">
                <div class="row" id="MedidaContent0">
                    <div class="col-md-3">  
                        <div class="form-group">
                            <label>1º Tipo de Medida:</label>
                            <?php echo $this->Form->select('Medida.0.tipo_medida_id', $tipoMedidas, array('class' => 'form-control input-sm')); ?>
                        </div>
                    </div>
                    <div class="col-md-2">  
                        <div class="form-group">
                            <label>Data:</label>
                            <?php
                            $args = array(
                                'class' => 'form-control input-sm data',
                                'data-date-format' => 'DD/MM/YYYY',
                                'label' => false
                            );
                            echo $this->Form->text('Medida.0.data_medida', $args);
                            ?>
                        </div>
                    </div>
                    <?php if ($exibirResultado == 1) { ?>
                        <div class="col-md-3">  
                            <div class="form-group">
                                <label>Resultado:</label>
                                <?php echo $this->Form->select('Resultado.0.tipo_resultado_id', $tpResultMedida, array('class' => 'form-control input-sm')); ?>
                            </div>
                        </div>
                        <div class="col-md-2">  
                            <div class="form-group">
                                <label>Data:</label>
                                <?php
                                $args = array(
                                    'class' => 'form-control input-sm data',
                                    'data-date-format' => 'DD/MM/YYYY',
                                    'label' => false
                                );
                                echo $this->Form->text('Resultado.0.data_resultado', $args);
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
<div class="row">
    <div class="col-xs-6 col-md-4">
        <div class="form-group">
            <?php
            echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
                'controller' => 'medidas',
                'action' => "novaMedida/-1/$model/$exibirResultado" . "?trs=1"), array(
                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                'complete' => 'refreshJquery();',
                'update' => '#medidas',
                'div' => false,
                'method' => 'POST',
                'async' => true,
                'class' => 'btn btn-default',
                'title' => 'Nova Medida',
                'dataExpression' => true,
                'escape' => false)
            );
            ?>
        </div>
    </div>
</div>
