<?php if(empty($audiencias)){ echo 'NENHUMA AUDIÊNCIA CADASTRADA NO PAINEL'; }; ?>

<table class="table table-bordered table-striped">        
        <?php $x = '**'; ?>
        <?php foreach($audiencias as $key => $value): ?>
            <?php if($x != $value['Processo']['numeracao_unica']){
                $x = $value['Processo']['numeracao_unica']; ?>
                <tr ><th colspan="4" bgcolor="#C4F0CD">Processo: <?=$value['Processo']['numeracao_unica']?></th></tr>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Tipo</th>
                    <th>Resultado</th>
                </tr>
           <?php } ?>
        <tr>
            <td><?= date('d/m/Y',strtotime($value['PainelAudiencia']['data'])) ?></td>
            <td><?= $value['PainelAudiencia']['hora'] ?></td>
            <td><?= $value['TipoAudiencia']['nome'] ?></td>
            <td><?= $value['TipoResultado']['nome'] ?></td>
        </tr>    
        <?php endforeach; ?>
            
</table>        