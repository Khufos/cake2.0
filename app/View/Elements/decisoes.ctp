<div id="decisoes">
    <?php
    $tipoDecisoes = $this->Session->read('tipoDecisoes');
    $tipoCondenacao = $this->Session->read('tipoCondenacao');
    $qtd = 1;
    if (!empty($decisoes)) {  // Redesenha as existentes        
        ?>
        <?php
        foreach ($decisoes as $key => $value) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Testemunha <?php echo $qtd ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label><?php echo $key + 1 ?>° Tipo de Decisao:</label>
                                <?php
                                $args = array(
                                    'default' => $value['Decisao']['tipo_decisao_id'],
                                    'class' => 'form-control input-sm',
                                    'empty' => 'Selecione'
                                );
                                echo $this->Form->select("Decisao.$key.tipo_decisao_id", $tipoDecisoes, $args);
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <?php echo $key + 1; ?>° Data:
                                <?php
                                $args = array(
                                    'class' => 'form-control input-sm data',
                                    'data-date-format' => 'DD/MM/YYYY',
                                    'value' => $this->Util->ddmmaa($value['Decisao']['data']),
                                    'label' => false
                                );
                                echo $this->Form->text("Decisao.$key.data", $args);
                                echo $this->Form->text("Decisao.$key.id", array('type' => 'hidden', 'value' => $value['Decisao']['id']));
                                echo $this->Form->text("$modelAssocDecisao.$key.id", array('type' => 'hidden', 'value' => $value[$modelAssocDecisao]['id']));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <?php if (empty($value['Decisao']['id'])) { ?>
                                    <?php
                                    echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                        'controller' => 'decisoes',
                                        'action' => "novaDecisao/$key/$modelAssocDecisao/$idForm?trs=1"), array(
                                        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                        'before' => $this->Js->get('#loading')->effect('show'),
                                        'success' => $this->Js->get('#loading')->effect('hide'),
                                        'update' => '#decisoes',
                                        'div' => false,
                                        'method' => 'POST',
                                        'async' => true,
                                        'class' => 'btn btn-default margintop20',
                                        'title' => 'Apagar',
                                        'dataExpression' => true,
                                        'escape' => false)
                                    );
                                    echo $this->Js->writeBuffer();
                                }
                                ?>
                            </div>
                        </div>
                        <?php if (isset($proAdm)) { ?>
                            <div class="col-xs-6 col-md-4">  
                                <div class="form-group">
                                    <label>Condenação:</label>
                                    <?php
                                    $args = array(
                                        'default' => $value['Condenacao']['tipo_condenacao_id'],
                                        'class' => 'form-control input-sm data',
                                        'empty' => 'Selecione'
                                    );
                                    echo $this->Form->select("Condenacao.$key.tipo_condenacao_id", $tipoCondenacao, $args);
                                    ?>
                                    <?php echo $this->Form->hidden("Condenacao.$key.id"); ?>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">  
                                <div class="form-group">
                                    <label>Pena:</label>
                                    <?php
                                    $args = array(
                                        'default' => $value['Condenacao']['quantidade_dias'],
                                        'class' => 'form-control input-sm data',
                                        'empty' => 'Selecione'
                                    );
                                    echo $this->Form->select("Condenacao.$key.quantidade_dias", $qtdDias, $args);
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>  
                </div>
            </div>
            <?php
            $qtd++;
        }
    } else { // Primeiro
        $key = 0;
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Testemunha <?php echo $qtd ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <label>1° Tipo de Decisão:</label>
                            <?php
                            echo $this->Form->select("Decisao.$key.tipo_decisao_id", $tipoDecisoes, array('class' => 'form-control input-sm'));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <label>Data:</label>
                            <?php
                            $args = array(
                                'class' => 'form-control input-sm data',
                                'data-date-format' => 'DD/MM/YYYY',
                                'label' => false
                            );
                            echo $this->Form->text("Decisao.$key.data", $args);
                            ?>
                        </div>
                    </div>
                    <?php if (isset($proAdm)) { ?>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label>Condenação:</label>
                                <?php echo $this->Form->select("Condenacao.$key.tipo_condenacao_id", $tipoCondenacao, array('class' => 'form-control input-sm data')); ?>
                                <?php echo $this->Form->hidden("Condenacao.$key.id"); ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label>Pena:</label>
                                <?php echo $this->Form->select("Condenacao.$key.quantidade_dias", $qtdDias, array('class' => 'form-control input-sm data')); ?>
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
                'controller' => 'decisoes',
                'action' => "novaDecisao/-1/$modelAssocDecisao/$idForm?trs=1"), array(
                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                'update' => '#decisoes',
                'complete' => 'refreshJquery();',    
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
