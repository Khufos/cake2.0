<div id="intimacao">
    <?php
    $tipoIntimacoes = $this->Session->read('tipoIntimacoes');
    if (!empty($intimacoes)) {  // Redesenha as existentes
        ?>
        <?php foreach ($intimacoes as $key => $value) { ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $key + 1; ?>° Intimação:</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>Tipo Intimações:</label>
                                <?php
                                $args = array('default' => $value['Intimacao']['tipo_intimacao_id'], 'class' => 'form-control input-sm');
                                echo $this->Form->select("Intimacao.$key.tipo_intimacao_id", $tipoIntimacoes, $args);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">  
                            <div class="form-group">                                
                                <?php
                                $args = array(
                                    'class' => 'form-control input-sm data',
                                    'data-date-format' => 'DD/MM/YYYY',
                                    'label' => false,
                                    'value' => $this->Util->ddmmaa($value['Intimacao']['data'])
                                );
                                echo $this->Form->text("Intimacao.$key.data", $args);
                                echo $this->Form->text("Intimacao.$key.id", array('type' => 'hidden', 'value' => $value['Intimacao']['id']));
                                echo $this->Form->text("$modelAssocInti.$key.id", array('type' => 'hidden', 'value' => $value[$modelAssocInti]['id']));
                                ?>
                            </div>
                        </div>
                        <?php if (empty($value['Intimacao']['id'])) { ?>
                            <div class="col-md-4">  
                                <div class="form-group">
                                    <?php
                                    echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                        'controller' => 'intimacoes',
                                        'action' => "novaIntimacao/$key/$modelAssocInti/$idForm?trs=1"), array(
                                        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                        'before' => $this->Js->get('#loading')->effect('show'),
                                        'success' => $this->Js->get('#loading')->effect('hide'),
                                        'update' => '#intimacao',
                                        'div' => false,
                                        'method' => 'POST',
                                        'async' => true,
                                        'class' => 'btn btn-default margintop20',
                                        'title' => 'Apagar Intimação',
                                        'dataExpression' => true,
                                        'escape' => false)
                                    );
                                    echo $this->Js->writeBuffer();
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    } else { // Primeiro 
        $key = 0;
        ?>
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $key + 1; ?>° Intimação:</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>Tipo Intimações:</label>
                            <?php
                            $args = array(
                                'default' => $this->Util->setaValorPadrao($value['Intimacao']['tipo_intimacao_id'], null),
                                'class' => 'form-control input-sm'
                            );
                            echo $this->Form->select("Intimacao.$key.tipo_intimacao_id", $tipoIntimacoes, $args);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>Data:</label>
                            <?php
                            $args = array(
                                'class' => 'form-control input-sm data',
                                'data-date-format' => 'DD/MM/YYYY',
                                'label' => false
                            );
                            echo $this->Form->text("Intimacao.$key.data", $args);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
//echo $ajax->link($this->Html->div('novo', ''), array(
//    'controller' => 'intimacoes',
//    'action' => "novaIntimacao/-1/$modelAssocInti/$idForm?trs=1"
//        ), array('with' => "Form.serialize( $('$idForm') )",
//    'update' => 'intimacao',
//    'loading' => 'lc.start(request)',
//    'complete' => 'lc.stop(request);refreshJquery();',
//        ), null, false
//);
?>
<div class="row">
    <div class="col-xs-6 col-md-4">
        <div class="form-group">
            <?php
            echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
                'controller' => 'intimacoes',
                'action' => "novaIntimacao/-1/$modelAssocInti/$idForm?trs=1"), array(
                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                'complete' => 'refreshJquery();',
                'update' => '#intimacao',
                'div' => false,
                'method' => 'POST',
                'async' => true,
                'class' => 'btn btn-default',
                'title' => 'Nova Intimação',
                'dataExpression' => true,
                'escape' => false)
            );
            ?>
        </div>
    </div>
</div>
