<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="form-group">
                    <label>Liminar:</label>
                    <?php echo $this->Form->select('Consumidor.tipo_liminar_id', $tipoLiminares, array('empty' => 'Selecione', 'class' => 'form-control input-sm', 'value' => $DadosConsumidor['Consumidor']['tipo_liminar_id'])); ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">  
                <div class="form-group">
                    <label>Agravo Interposto pela DPE:</label><br/> 
                        <?php 
                            echo $this->Form->radio('Consumidor.agravo', array(0 => 'Não', 1 => 'Sim'), array('default' => $DadosConsumidor['Consumidor']['agravo'], 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
                        ?> 
                </div>   
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="form-group">
                    <label>Sentença:</label>
                    <?php echo $this->Form->select('Consumidor.sentenca_id', $sentencas, array('empty' => 'Selecione', 'class' => 'form-control input-sm', 'value' => $DadosConsumidor['Consumidor']['sentenca_id'])); ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">  
                <div class="form-group">
                    <label>Apelação Interposta pela DPE:</label><br/> 
                        <?php
                            echo $this->Form->radio('Consumidor.apelacao', array(0 => 'Não', 1 => 'Sim'), array('default' => $DadosConsumidor['Consumidor']['apelacao'], 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
                        ?>    
                </div>
            </div>
        </div>
   </div>
</div>



