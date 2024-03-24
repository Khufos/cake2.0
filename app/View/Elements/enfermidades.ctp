<div id="enferm">
    
    <?php
    $simNao = array(0 => 'Não', 1 => 'Sim');
    if (!empty($enfermidades)) {

        ?>
        <?php
        foreach ($enfermidades as $key => $value) {
//            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                   
                    
                   
            <?php
            echo $this->Js->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-minus-sign')), array(
                'controller' => 'Enfermidades', 'action' => "novaEnfermidade/$key/$idForm/$modelAssocEnferm/?trs=1"), array(
                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                'update' => '#enferm',
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
                    
                    
                    <?php echo $key+1 ?>ª Enfermidade</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Informe as Enfermidades que o paciente possui:</label>
                                <?php
                                echo $this->Form->select("Enfermidade.$key.tipo_doenca_id", $tipoDoenca, array(
                                    'default' => $value['Enfermidade']['tipo_doenca_id'],
                                    'class' => 'form-control input-sm',
                                    'empty' => 'Selecione'
                                ));
//                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>CID:</label>
                                <?php
                                echo $this->Form->input("Enfermidade.$key.cid", array('class' => 'form-control input-sm',  'type' => 'text', 'label' => false, 'value' => $value['Enfermidade']['cid']));
                                echo $this->Form->text("$modelAssocEnferm.$key.id", array('type' => 'hidden', 'value' => $value[$modelAssocEnferm]['id']));
                                echo $this->Form->text("Enfermidade.$key.id", array('type' => 'hidden', 'value' => $value['Enfermidade']['id']));
//                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Enfermidade Grave?</label>
                                <?php
                                echo $this->Form->select("Enfermidade.$key.grave", $simNao,array('empty' => 'Selecione', 'class' => 'form-control input-sm',  'type' => 'text', 'label' => false, 'value' => $value['Enfermidade']['grave']));
//                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Tempo de Prorrogação de tratamento</label>
                                <?php
                                echo $this->Form->input("Enfermidade.$key.prorrogacao",array('class' => 'form-control input-sm',  'type' => 'text', 'label' => false, 'value' => $value['Enfermidade']['prorrogacao']));
//                                ?>Ex.: 1 mês
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-12">
                            <div class="form-group">
                                <div id="EnfermidadeContent<?php echo $key ?>">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


    <?php } else { ?>
        <div class="panel panel-default">
            <div class="panel-heading">1ª Enfermidade</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Informe as Enfermidades que o paciente possui:</label>
                            <?php echo $this->Form->select("Enfermidade.0.tipo_doenca_id", $tipoDoenca, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>CID:</label>
                            <?php echo $this->Form->input("Enfermidade.0.cid", array('class' => 'form-control input-sm', 'type' => 'text', 'label' => false)); ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Enfermidade grave?</label>
                            <?php echo $this->Form->select('Enfermidade.0.grave', $simNao, array('empty' => 'Selecione', 'class' => 'form-control input-sm')); ?>
                        </div>
                    </div>
                </div>          
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Tempo de Prorrogação de tratamento</label>
                            <?php
                            echo $this->Form->input("Enfermidade.0.prorrogacao",array('class' => 'form-control input-sm',  'type' => 'text', 'label' => false));
//                                ?> Ex.: 1 mês
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-12">
                        <div class="form-group">
                            <div id="EnfermidadeContent0">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
    'controller' => 'enfermidades',
    'action' => "novaEnfermidade/-1/$idForm/$modelAssocEnferm/" . $this->params['controller'] . "?trs=1"
        ), array(
    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
    'before' => $this->Js->get('#loading')->effect('show'),
    'success' => $this->Js->get('#loading')->effect('hide'),
    'div' => false,
    'complete' => 'refreshJquery();runEffect();',
    'update' => '#enferm',
    'method' => 'POST',
    'async' => true,
    'dataExpression' => true,
    'title' => 'Novo',
    'class' => 'btn btn-default',
    'escape' => false
));


