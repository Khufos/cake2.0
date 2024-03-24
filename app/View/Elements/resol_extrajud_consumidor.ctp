<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-6 col-md-4">  
                <div class="form-group">
                    <label>Resolução extrajudicial:</label><br/> 
                        <?php 
                            echo $this->Form->radio('Consumidor.resolucao', array(0 => 'Não', 1 => 'Sim'), array('default' => $DadosConsumidor['Consumidor']['resolucao'], 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
                        ?> 
                </div>   
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Utilização dos termos de cooperação firmados com a Defensoria Pública:</label><br/> 
                        <?php 
                            echo $this->Form->radio('Consumidor.utilizacao_termo_cooperacao', array(0 => 'Não', 1 => 'Sim'), array('default' =>  $DadosConsumidor['Consumidor']['utilizacao_termo_cooperacao'], 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
                        ?>    
                </div>
            </div>
        </div>
   </div>
</div>


