
<?php if(empty($atividadeExtrajudiciais)){ echo 'NENHUMA AUDIÊNCIA CADASTRADA NO PAINEL'; }; ?>

<table class="table table-bordered table-striped">    
<caption><strong>HISTÓRICO</strong></caption>    
        <?php $x = '**'; ?>
                <tr>
                    <th>Atividade</th>
                    <th>Autor</th>
                    <th>Observação</th>
                    <th>DATA</th>
                    <th>Visualizar</th>
                </tr>
                <?php foreach($atividadeExtrajudiciais as $key => $value): ?>
        <tr>
            <td style="width:31%"><?= $value['ta']['nome'] ?></td>
            <td style="width:31%"><?= $value['pe']['nome'] ?></td>
            <td style="width:31%"><?= $value['ate']['observacao'] ?></td>
            <td ><?= date('d/m/Y',strtotime($value['ate']['data'])) ?></td>

            <td style="text-align: center">
            <?php

                $model_ic = '';
                if($value['ate']['acao_id'] != ''){
                    $model_ic = 'acoes';
                    $esp_id= $value['ate']['acao_id'];
                }elseif($value['e']['model'] != ''){
                    $model_ic = $value['e']['model'];
                    $esp_id= $value['ate']['espec_registro_id'];
                }else{
                    $model_ic= '';
                    $esp_id= '';
                }

                echo $this->Html->link($this->Html->div('glyphicon glyphicon-new-window loralign', ''), array(
                    'controller' => $model_ic,
                    'action' => "edit/"  . $esp_id
                ), array('escape' => false, 'title' => 'Vizualizar', 'id' => 'lor'));
            ?>
            </td>
            
        </tr>    
        <?php endforeach; ?>
            
</table>  

<script>   

    $(document).ready(function(){
        $("#AcaoTipoAcaoId").select2(); 
        $(".selectMultiplo").select2();   
        $('#Lista_processoDataInicio').val($.datepicker.formatDate( "dd/mm/yy", new Date()))          
    });
</script>

