<script>   

    $(document).ready(function(){
        $("#AtendimentoUnidadeId").select2();              
    });
</script>


<div class="well well-sm">
    <div class="row">
        <div class="col-xs-6 col-md-12">  
            <div class="form-group">
                <label><span class='label_bold esquerda'>*Posto de Atendimento:</span></label>
                <?php
                $uUnidade = $this->Session->read('Atendimento.unidade'); // ultima unidade que o atendimento foi realizado
                $postos = $this->Session->read('postos'); // recebe os posto da sess�o; 
                

                if($idUnidade == 0 && $uUnidade == null){
                    $idUnidade = $this->Session->read('Funcionario.unidade_id');
                    
                }

                echo $this->Form->select('Atendimento.unidade_id', $postos, array(
                    'default' => $this->Util->setaValorPadrao($idUnidade, $uUnidade),
                    'class' => 'validate[required] form-control input-sm'));
                ?>
            </div>
        </div>
    </div>
</div>