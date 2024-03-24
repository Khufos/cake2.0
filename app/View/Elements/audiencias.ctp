<?php
$this->Util->setaValorPadrao($condAudiencias, false);
if (($condAudiencias)) {
    $style = "Style='margin-top:-12px'";
} else {
    $style = true;
}

$tipoAudiencias = $this->Session->read('tipoAudiencias');

$tpResultAudiencia = $this->Session->read('tpResultAudiencia');
?>

<div id="audiencias">
    <?php
    $qtd = 1;
    if (!empty($audiencias)) {
        
        ?>
        <?php
        foreach ($audiencias as $key => $value) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    if (empty($value['Audiencia']['id'])) {
                        echo $this->Js->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-minus-sign')), array(
                            'controller' => 'audiencias',
                            'action' => "novaAudiencia/$key/$modelAssociacao/$idForm/$model?trs=1"), array(
                            'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                            'update' => '#audiencias',
                            'id' => "bt-remove$key",
                            'method' => 'POST',
                            'async' => true,
                            'class' => 'oculto',
                            'dataExpression' => true,
                            'title' => 'Remover',
                            'escape' => false
                        ));
                        echo $this->Js->writeBuffer();
                        ?>
                        <script type="text/javascript">
                            $('#close<?php echo $key; ?>').click(function () {
                                $("#bt-remove<?php echo $key; ?>").click();
                            })
                        </script>
                        <button type="button" class="close" id="close<?php echo $key; ?>" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php
                    }
                    ?>
                    <h3 class="panel-title">Audiência <?php echo $qtd ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo Audiências:</label>
                                <?php
                                $args = array(
                                    'default' => $value['Audiencia']['tipo_audiencia_id'],
                                    'empty' => false,
                                    'class' => 'form-control input-sm'
                                );
                                echo $this->Form->select("Audiencia.$key.tipo_audiencia_id", $tipoAudiencias, $args);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo $key + 1; ?>° Audiência:</label>
                                <?php
                                echo $this->Form->input("Audiencia.$key.data", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $this->Util->ddmmaa($this->Util->setaValorPadrao($value['Audiencia']['data']))));
                                echo $this->Form->text("Audiencia.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['Audiencia']['id'], null)));
                                echo $this->Form->text("$modelAssociacao.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value[$modelAssociacao]['id'], null)));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Resultado:</label>
                                <?php
                                $this->Util->setaValorPadrao($value['Resultado']['tipo_resultado_id'], null);
                                $args = array(
                                    'default' => $value['Resultado']['tipo_resultado_id'],
                                    'class' => 'form-control input-sm'
                                );
                                echo $this->Form->select("Audiencia.$key.Resultado.tipo_resultado_id", $tpResultAudiencia, $args);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data:</label>
                                <?php
                                $dataResultadoAudiencia = '';
                                if ((!empty($value['Resultado']['data_resultado'])) && ($value['Resultado']['data_resultado'] != '0000-00-00')) {
                                    $dataResultadoAudiencia = $this->Util->ddmmaa($value['Resultado']['data_resultado']);
                                }
                                echo $this->Form->input("Audiencia.$key.Resultado.data_resultado", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $dataResultadoAudiencia));
                                echo $this->Form->input("Audiencia.$key.Resultado.id", array('value' => $value['Audiencia']['resultado_id'], 'type' => 'hidden'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Defensor:</label>
                                <?php
                                $this->Util->setaValorPadrao($defensoresComarca, array());
                                $args = array(
                                    'default' => $value['Audiencia']['funcionario_id'],
                                    'empty' => false,
                                    'class' => 'form-control input-sm'
                                );
                                echo $this->Form->select("Audiencia.$key.funcionario_id", $defensoresComarca, $args);
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <?php if (empty($value['Audiencia']['id'])) {
                                    ?>
                                    <?php
                                    echo $this->Js->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-minus-sign')), array(
                                        'controller' => 'audiencias',
                                        'action' => "novaAudiencia/$key/$modelAssociacao/$idForm/$model?trs=1"), array(
                                        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                        'update' => '#audiencias',
                                        'method' => 'POST',
                                        'async' => true,
                                        'class' => 'input-group',
                                        'dataExpression' => true,
                                        'title' => 'Remover',
                                        'escape' => false
                                    ));
                                    echo $this->Js->writeBuffer();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Resumo:</label>
                                <?php
                                echo $this->Form->textarea("Audiencia.$key.observacao"
                                        , array('escape' => false, 'class' => 'form-control input-sm', 'style' => 'width: 555px; height: 33px;'
                                    , 'value' => $this->Util->setaValorPadrao($value['Audiencia']['observacao'], ''))
                                );
                                ?>
                                <p class="help-block">("Resumo da audiência")</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $qtd++;
        }
        ?>

        <?php
    } else { // Primeiro
        $key = 0;
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">                
                <h3 class="panel-title">Audiência <?php echo $qtd ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tipo Audiências:</label>
                            <?php
                            echo $this->Form->select("Audiencia.$key.tipo_audiencia_id", $tipoAudiencias, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                            ?>
                        </div>
                    </div>
                    </td>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>1° Audiência:</label>
                            <?php echo $this->Form->input("Audiencia.$key.data", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Resultado:</label>
                            <?php
                            echo $this->Form->select("Audiencia.$key.Resultado.tipo_resultado_id", $tpResultAudiencia, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data:</label>
                            <?php echo $this->Form->input("Audiencia.$key.Resultado.data_resultado", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Defensor:</label>
                            <?php
                            $this->Util->setaValorPadrao($defensoresComarca, array());
                            $this->Util->setaValorPadrao($value['Audiencia']['funcionario_id'], NULL);
                            echo $this->Form->select("Audiencia.$key.funcionario_id", $defensoresComarca, array('empty' => 'Selecione o Defensor', 'class' => 'form-control input-sm'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-8">
                        <div class="form-group">
                            <label>Resumo:</label>
                            <?php
                            echo $this->Form->textarea("Audiencia.$key.observacao"
                                    , array(
                                'escape' => false,
                                'class' => 'form-control input-sm',
                                    )
                            );
                            ?>
                            <p class="help-block">("Resumo da audiência")</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <?php
    if (!$condAudiencias) {
        $this->Util->setaValorPadrao($model, '');
        echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
            'controller' => 'audiencias',
            'action' => "novaAudiencia/-1/$modelAssociacao/$idForm/$model?trs=1"), array(
            'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
            'div' => false,
            'complete' => 'refreshJquery();',
            'update' => '#audiencias',
            'method' => 'POST',
            'async' => true,
            'dataExpression' => true,
            'title' => 'Novo',
            'class' => 'btn btn-default',
            'escape' => false
        ));
    }
    ?>
</div>


