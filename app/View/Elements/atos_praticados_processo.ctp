<?php if(!empty($atosPraticados)){ ?>
<div>
    <h4>ATOS PRATICADOS NO PROCESSO2</h4> 
</div>
<table class="table">
    <tr>
        <th>Data</th>
        <th>Ato Praticado</th>
        <th>Defensor</th>
    </tr>
<?php foreach($atosPraticados as $key => $value): 
    ?>
    <tr>
        <td><?= $value['AtoPraticadoProcesso']['data'] ?></td>
        <td><?= $value['AtoPraticado']['nome'] ?></td>
        <td><?= $value['Pessoa']['nome'] ?></td>
    </tr>
<?php endforeach; ?>    
</table>
<?php } ?>