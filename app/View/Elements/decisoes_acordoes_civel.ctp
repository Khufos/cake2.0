<div id="DecisoesAcordoes">
    <?php
    if (!empty($decisoesAcordoesCivel)) {
        foreach ($decisoesAcordoesCivel as $key => $value) {
            ?>       
            <div class="row">
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">
                        <label>Decisão Interlocutória:</label>
                        <?php echo $this->Form->input("DecisoesAcordoesCivel.$key.data_decisao", array('class' => 'form-control input-sm data', 'value' => $this->Util->ddmmaa($value['DecisoesAcordoesCivel']['data_decisao']), 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">
                        <label>Acórdão:</label>
                        <?php echo $this->Form->input("DecisoesAcordoesCivel.$key.data_acordao", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $this->Util->ddmmaa($value['DecisoesAcordoesCivel']['data_acordao']))); ?>
                    </div>
                </div>

                <?php echo $this->Form->text("DecisoesAcordoesCivel.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['DecisoesAcordoesCivel']['id'], null))); ?>


            </div>
            <?php
        }
    } else {
        $key = 0;
        ?>    
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Decisão Interlocutória:</label>
                    <?php echo $this->Form->input("DecisoesAcordoesCivel.$key.data_decisao", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Acórdão:</label>
                    <?php echo $this->Form->input("DecisoesAcordoesCivel.$key.data_acordao", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
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
                'controller' => 'civeis',
                'action' => "novaDecisaoAcordao/-1/$idForm/?trs=1"), array(
                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                'before' => $this->Js->get('#loading')->effect('show'),
                'success' => $this->Js->get('#loading')->effect('hide'),
                'div' => false,
                'complete' => 'refreshJquery();',
                'class' => 'btn btn-default',
                'update' => '#DecisoesAcordoes',
                'method' => 'POST',
                'async' => true,
                'dataExpression' => true,
                'title' => 'Novo',
                'escape' => false
                    ));
            ?>
        </div>
    </div>
</div>
