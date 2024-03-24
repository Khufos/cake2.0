<div id="IdososCarga">
    <?php
    $controller = $this->params['controller'];
    if (!empty($cargas)) {
        foreach ($cargas as $key => $value) {
            ?>  
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Data da Confecção de Carga:</label>

                        <?php
                        $args = array(
                            'class' => 'form-control input-sm data',
                            'data-date-format' => 'DD/MM/YYYY',
                            'value' => $value[$modelAssocCarga]['data_entrada_carga'],
                            'label' => false
                        );
                        echo $this->Form->text("$modelAssocCarga.$key.data_entrada_carga", $args);
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Data da Baixa de Carga:</label>
                        <?php
                        $args = array(
                            'class' => 'form-control input-sm data',
                            'data-date-format' => 'DD/MM/YYYY',
                            'value' => $value[$modelAssocCarga]['data_saida_carga'],
                            'label' => false
                        );
                        echo $this->Form->text("$modelAssocCarga.$key.data_saida_carga", $args);
                        ?>
                        <?php echo $this->Form->text("$modelAssocCarga.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value[$modelAssocCarga]['id'], null))); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php
//                            echo $ajax->link($this->Html->div('apagar', ''), array('controller' => "$controller", 'action' => "novaCarga/$key/$idForm/?trs=1"), array('with' => "Form.serialize( $('$idForm') )",
//                                'update' => "$modelAssocCarga",
//                                'loading' => 'lc.start(request)',
//                                'complete' => 'lc.stop(request);refreshJquery();'
//                                    ), null, false
//                            );
                        echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                            'controller' => "$controller",
                            'action' => "novaCarga/$key/$idForm/?trs=1"), array(
                            'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                            'before' => $this->Js->get('#loading')->effect('show'),
                            'success' => $this->Js->get('#loading')->effect('hide'),
                            'update' => "#$modelAssocCarga",
                            'div' => false,
                            'method' => 'POST',
                            'async' => true,
                            'class' => 'btn btn-default margintop20',
                            'title' => 'Apagar Medida',
                            'dataExpression' => true,
                            'escape' => false)
                        );
                        echo $this->Js->writeBuffer();
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    } else { // primeira data
        $key = 0;
        ?>    
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Data da Confecção de Carga:</label>

                    <?php
                    $args = array(
                        'class' => 'form-control input-sm data',
                        'data-date-format' => 'DD/MM/YYYY',
                        'label' => false
                    );
                    echo $this->Form->text("$modelAssocCarga.$key.data_entrada_carga", $args);
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Data da Baixa de Carga:</label>        
                    <?php
                    $args = array(
                        'class' => 'form-control input-sm data',
                        'data-date-format' => 'DD/MM/YYYY',
                        'label' => false
                    );
                    echo $this->Form->text("$modelAssocCarga.$key.data_saida_carga", $args);
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<span>
    <?php
//    echo $ajax->link($this->Html->div('novo', ''), array(
//        'controller' => "$controller",
//        'action' => "novaCarga/-1/$idForm/?trs=1"
//            ), array(
//        'with' => "Form.serialize( $('$idForm') )",
//        'update' => "$modelAssocCarga",
//        'indicator' => 'loading',
//        'complete' => 'refreshJquery();',
//            ), null, false
//    );
    echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
        'controller' => "$controller",
        'action' => "novaCarga/-1/$idForm/?trs=1"), array(
        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
        'before' => $this->Js->get('#loading')->effect('show'),
        'success' => $this->Js->get('#loading')->effect('hide'),
        'div' => false,
        'complete' => 'refreshJquery();runEffect();',
        'update' => "#$modelAssocCarga",
        'method' => 'POST',
        'async' => true,
        'dataExpression' => true,
        'title' => 'Novo',
        'class' => 'btn btn-default',
        'escape' => false
            ), null, false
    );
    ?>
</span> 
