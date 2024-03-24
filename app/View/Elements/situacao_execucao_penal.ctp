<div class="row">
    <div class="col-xs-6 col-md-6"><label>Situação</label></div>
    <div class="col-xs-6 col-md-6"><label>Principal</label></div>
</div>
<?php if(!isset($execucaoPenaisSituacao)){ ?>
    <div class="row">
            <div class="col-sm-6">
                <?php echo $this->Form->select('ExecucaoPenaisSituacao.0.situacao_id', $situacoesExecucaoPenal, ['class'=>'form-control', 'required' => true]); ?>
            </div>
            <div class="col-sm-4">
                <?php
                $options2= array(
                    '0' => ''
                );
                $attributes2 = array(
                    'legend' => false, 
//                    'value' => 0,
                );
                echo $this->Form->radio('ExecucaoPenal.principal', $options2, $attributes2);
                ?>
            </div>
        </div>
<?php }else{ ?>
<?php foreach($execucaoPenaisSituacao as $key => $value){ ?>
               <?php $i = $key + 1; ?>
<div class="row">
            <div class="col-sm-6">
                    <?php 
                    if(isset($value['ExecucaoPenaisSituacao']['id'])){
                        echo $this->Form->input("ExecucaoPenaisSituacao.$key.id", array('type' => 'hidden', 'value' => $value['id'])); 
                    }
                    ?>
                    <?php echo $this->Form->select("ExecucaoPenaisSituacao.$key.situacao_id", $situacoesExecucaoPenal, ['class'=>'form-control validate[required]', 'required' => true, 'value' => $value['situacao_id'] ]); ?>
            </div>
            <div class="col-sm-2">
                <?php
                $gender='1';                
                $options2= array(
                    "$key" => ''
                );
                $attributes2 = array(
                    'legend' => false,
                    'hiddenField' => false
                );
                echo $this->Form->radio("ExecucaoPenal.principal", $options2, $attributes2);
                ?>
            </div>
            <div>
               <?php   
            echo $this->Js->link($this->Html->tag('i', '', array('class' => 'btn btn-default btn-xs glyphicon glyphicon-minus')), array(
                'controller' => 'execucao_penais_situacoes', 'action' => "novaSituacao/$key/formExecucao?trs=1"), array(
                'data' => $this->Js->get('#formExecucao')->serializeForm(array('isForm' => true, 'inline' => true)),
                'update' => '#situacao',
                'id' => "bt-remove-sit$key",
                'complete' => 'refreshJquery();',
                'method' => 'POST',
                'async' => true,
//                'class' => 'oculto',
                'dataExpression' => true,
                'title' => 'Remover',
                'escape' => false
                    )
            );
            echo $this->Js->writeBuffer(); 
            ?> 
            </div>
             <?php 

             ?>     
    </div>
<?php } ?>
<?php if(isset($remover) && $remover == -1){ ++$key; ?>
    <?php 
             ?> 
    <div class="row">
        <div class="col-sm-6">
                <?php echo $this->Form->select("ExecucaoPenaisSituacao.$key.situacao_id", $situacoesExecucaoPenal, ['class'=>'form-control validate[required]', 'required' => true]); ?>
        </div>                
        <div class="col-sm-2">    
                <?php
                $options2= array(
                    "$key" => ''
                );
                $attributes2 = array(
                    'legend' => false,
                    'hiddenField' => false
                );
                echo $this->Form->radio("ExecucaoPenal.principal", $options2, $attributes2);
                ?>
        </div>
        <div >
            <?php echo $this->Js->link($this->Html->tag('i', '', array('class' => 'btn btn-default btn-xs glyphicon glyphicon-minus')), array(
                'controller' => 'execucao_penais_situacoes', 'action' => "novaSituacao/$key/formExecucao?trs=1"), array(
                'data' => $this->Js->get('#formExecucao')->serializeForm(array('isForm' => true, 'inline' => true)),
                'update' => '#situacao',
                'id' => "bt-remove-sit$key",
                'complete' => 'refreshJquery();',
                'method' => 'POST',
                'async' => true,
//                'class' => 'oculto',
                'dataExpression' => true,
                'title' => 'Remover',
                'escape' => false
                    )
            );
            echo $this->Js->writeBuffer();
            ?>
            </div>
    </div>
<?php } ?>
    
<?php } ?>     