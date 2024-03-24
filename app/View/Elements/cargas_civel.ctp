<div id="CargasCivel">
    <?php
    if (!empty($cargasCivel)) {
        foreach ($cargasCivel as $key => $value) {
            ?>       
            <div class="row">
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">
                        <label>Data da Confecção de Carga:</label>
                        <?php echo $this->Form->input("CargasCivel.$key.data_entrada_carga", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $this->Util->ddmmaa($value['CargasCivel']['data_entrada_carga']))); ?>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">
                        <label>Data da Baixa de Carga:</label>
                        <?php echo $this->Form->input("CargasCivel.$key.data_saida_carga", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $this->Util->ddmmaa($value['CargasCivel']['data_saida_carga']))); ?>
                    </div>
                </div>
                <?php echo $this->Form->text("CargasCivel.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['CargasCivel']['id'], null))); ?>
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Js->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-minus-sign')), array(
                            'controller' => 'civeis',
                            'action' => "novaDataCarga/$key/formCivel/?trs=1"), array(
                            'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                            'before' => $this->Js->get('#loading')->effect('show'),
                            'success' => $this->Js->get('#loading')->effect('hide'),
                            'div' => false,
                            'complete' => 'refreshJquery();runEffect();',
                            'update' => '#CargasCivel',
                            'class' => 'input-group',
                            'method' => 'POST',
                            'async' => true,
                            'dataExpression' => true,
                            'title' => 'Remover',
                            'escape' => false
                                ), null, false
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
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Data da Confecção de Carga:</label>
                    <?php echo $this->Form->input("CargasCivel.$key.data_entrada_carga", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Data da Baixa de Carga:</label>
                    <?php echo $this->Form->input("CargasCivel.$key.data_saida_carga", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div>&nbsp;</div>

</div>
<div class="row">
    <div class="col-xs-6 col-md-4">
        <div class="form-group">
            <?php
            echo $this->Js->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-plus-sign')), array(
                'controller' => 'civeis',
                'action' => "novaDataCarga/-1/$idForm/?trs=1"), array(
                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                'before' => $this->Js->get('#loading')->effect('show'),
                'success' => $this->Js->get('#loading')->effect('hide'),
                'div' => false,
                'complete' => 'refreshJquery();runEffect();',
                'update' => '#CargasCivel',
                'method' => 'POST',
                'async' => true,
                'dataExpression' => true,
                'title' => 'Novo',
                'escape' => false
                    ), null, false
            );
            ?>
        </div>
    </div>
</div>

