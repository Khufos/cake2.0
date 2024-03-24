<?php   
    if(empty($execucaoPenalNumero)){ ?>
        <div class="row">
            <fieldset>Número Execução:</fieldset>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <?php echo $this->Form->text('ExecucaoPenalNumero.0.numero_processo_execucao_penal', ['class'=>'num_unica form-control', 'required' => true]); ?>
                </div>                
            </div>
        </div>
<?php 
    }else{ ?>
        <div class="row">
        <?php 
            foreach($execucaoPenalNumero as $key => $value){ 
                $i = $key + 1; ?>
                <div class="col-xs-4 col-md-4">
                    <div class="form-group">
                        <fieldset>Número Execução <?= $i; ?>:</fieldset>
                        <?php 
                            if(isset($value['ExecucaoPenalNumero']['id'])){
                                echo $this->Form->input("ExecucaoPenalNumero.$key.id", array('type' => 'hidden', 'value' => $value['ExecucaoPenalNumero']['id'])); 
                            }
                        ?>
                        <?php 
                            echo $this->Form->text("ExecucaoPenalNumero.$key.numero_processo_execucao_penal", ['class'=>'num_unica form-control input-sm', 'required' => true, 'value' => $value['ExecucaoPenalNumero']['numero_processo_execucao_penal'] ]); 
                            echo $this->Js->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-minus-sign')), 
                                array('controller' => 'execucao_penal_numeros', 'action' => "novoNumero/$key/formExecucao?trs=1"), 
                                array(
                                    'data' => $this->Js->get('#formExecucao')->serializeForm(array('isForm' => true, 'inline' => true)),
                                    'update' => '#numero',
                                    'id' => "bt-remove$key",
                                    'complete' => 'refreshJquery();',
                                    'method' => 'POST',
                                    'async' => true,
                                    'dataExpression' => true,
                                    'title' => 'Remover',
                                    'escape' => false
                                )
                            );
                            echo $this->Js->writeBuffer(); 
                        ?>
                   </div>
                </div>                
                <?php 
                    if($i % 4 == 0){ 
                        echo   "</div>" .'<div class="row">';   
                    } 
                ?>     
        <?php       
            } ?>
<?php if(isset($remover) && $remover == -1){ ++$key; ?>
    <?php if($i % 3 != 0){ 
                     echo   
            '<div class="row">';
                
             } ?> 
        <div class="col-xs-6 col-md-4">
            <div class="form-group">
                <fieldset>Número Execução <?= $key +1; ?>:</fieldset>
                <?php 
                    echo $this->Form->text("ExecucaoPenalNumero.$key.numero_processo_execucao_penal", ['class'=>'num_unica form-control', 'required' => true]); 
                    echo $this->Js->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-minus-sign')), 
                        array(
                            'controller' => 'execucao_penal_numeros', 'action' => "novoNumero/$key/formExecucao?trs=1"), array(
                            'data' => $this->Js->get('#formExecucao')->serializeForm(array('isForm' => true, 'inline' => true)),
                            'update' => '#numero',
                            'id' => "bt-remove$key",
                            'complete' => 'refreshJquery();',
                            'method' => 'POST',
                            'async' => true,
                            'dataExpression' => true,
                            'title' => 'Remover',
                            'escape' => false
                    ));
                    echo $this->Js->writeBuffer();
                ?>
            </div>                
        </div>
    </div>
<?php } ?>
    </div>
<?php } ?>