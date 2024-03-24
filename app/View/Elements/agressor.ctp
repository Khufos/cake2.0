<style>
    .alinhaminus{
        top: 26px !important;
    }
</style>
<?php echo $this->Form->create('Amparo', array('action' => 'add', 'id' => 'formAmparo', 'role' => 'form', 'type' => 'file', 'class' => 'formValidate', 'class' => 'formAmparo')); ?>
<?php // debug($agressores); ?>
<fieldset>
                <legend>Agressores</legend>
<div id="agressor2">
    
    <?php if(empty($agressores)){ ?>
    <div class="row">
            
            <div class="form-group">
                <div class="col-md-5">
                        <label>Nome Agressor 1:</label>
                        <?php
                        echo $this->Form->text('Agressor.0.nome', ['class'=>'form-control', 'required' => true]);
                        ?>
                    
                </div>
            <div class="col-md-5">
                    
                        <label>Grau Conhecimento:</label>
                        <?php
                        echo $this->Form->select('Agressor.0.grau_parentesco',$grauParentesco, ['class'=>'form-control', 'required' => true]);
                        ?>
                </div>
                <div class="col-md-2">
                </div>    
            </div>
        </div>
<?php }else{ ?>
<?php foreach($agressores as $key => $value){ ?>
               <?php $i = $key + 1; ?>
<div class="row">
                <div class="form-group">
            <div class="col-md-5">
                    <label>Nome Agressor <?= $i; ?>:</label>
                    <?php 
                    if(isset($value['Agressor']['id'])){
                        echo $this->Form->input("Agressor.$key.id", array('type' => 'hidden', 'value' => $value['Agressor']['id'])); 
                    }
                    ?>
                    <?php echo $this->Form->text("Agressor.$key.nome", ['class'=>'form-control', 'required' => true, 'value' => $value['Agressor']['nome'] ]); ?>
            </div>        
            <div class="col-md-5 ">
                <label>Grau Conhecimento:</label>
                <?php echo $this->Form->select("Agressor.$key.grau_parentesco", $grauParentesco,['class'=>'form-control', 'required' => true, 'value' => $value['Agressor']['grau_parentesco'] ]); ?>
            </div>
            <div class="col-md-2">        
                    <?php
    echo $this->Js->link($this->Html->tag('i', '', array('class' => 'btn btn-default btn-xs glyphicon glyphicon-minus alinhaminus')), array(
        'controller' => 'agressores', 'action' => "novoAgressor/$key/formAmparo?trs=1"), array(
        'data' => $this->Js->get('.formAmparo')->serializeForm(array('isForm' => true, 'inline' => true)),
        'update' => '#agressao',
        'id' => "bt-remove-agr$key",
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
                </div>                
                 
<?php } ?>
<?php if(isset($remover) && $remover == -1){ ++$key; ?>
    
            <div class="form-group">
        <div class="col-md-5">
                <label>Nome Agressor <?= $key +1; ?>:</label>
                <?php echo $this->Form->text("Agressor.$key.nome", ['class'=>'form-control', 'required' => true, 'value' => $value['Agressor']['nome'] ]); ?>
        </div>
        <div class="col-md-5">
            <label>Grau Conhecimento:</label>
            <?php echo $this->Form->select("Agressor.$key.grau_parentesco", $grauParentesco,['class'=>'form-control', 'required' => true, 'value' => $value['Agressor']['grau_parentesco'] ]); ?>
    </div>
    <div class="col-md-2" >
        <span style="top:26px !important;">
                <?php
    echo $this->Js->link($this->Html->tag('i', '', array('class' => 'btn btn-default btn-xs glyphicon glyphicon-minus alinhaminus')), array(
        'controller' => 'agressores', 'action' => "novoAgressor/$key/formAmparo?trs=1"), array(
        'data' => $this->Js->get('.formAmparo')->serializeForm(array('isForm' => true, 'inline' => true)),
        'update' => '#agressao',
        'id' => "bt-remove-agr$key",
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
            </span>
            </div>                
        </div>
    </div>
<?php } ?>
    </div>
<?php } ?>
</fieldset>
<?php echo $this->Form->end(); ?> 
 