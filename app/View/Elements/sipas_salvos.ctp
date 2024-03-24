<?php if(empty($sipa)){ echo 'NENHUM CÁLCULO SALVO'; }; ?>
<table class="table table-bordered table-striped">    
<caption><strong>CÁLCULOS SALVOS</strong></caption>    
        <?php $x = '**'; ?>
                <tr>
                    <th>N°</th>
                    <th>Observação</th>
                    <th>Data do cadastro</th>
                    <th>Opções</th>
                </tr>
        <?php foreach($sipa as $key => $value):
                $dataObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $value['sipas']['data_cadastro']);
                $dataFormatada = $dataObjeto->format('d/m/Y');
        ?>
            <tr>
                <td style="width:10%"><?= $value['sipas']['id'] ?></td>
                <td style="width:55%"><?= $value['sipas']['observacao'] ?></td>
                <td style="width:31%"><?= $dataFormatada ?></td>
                <td style="text-align: center">
                    <div style="cursor: pointer; margin: 5px;"  class="glyphicon glyphicon-eye-open" title="Visualizar calculo" onclick='selecionarCalculo(<?= $value["sipas"]["id"]; ?>)'></div>
                </td>
            </tr>    
        <?php endforeach; ?>
</table>  

<script>   

    function selecionarCalculo(item){
        window.open('/sipas/index?sipa='+item+'&trs=1', '_blank');
    }
</script>

