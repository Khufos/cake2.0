<?php if(empty($extrajudicial)){ echo 'NENHUM EXTRAJUDICIAL CADASTRADO NO PAINEL'; }else{  ?>
<table class="table table-bordered table-striped">        
        <tr>
            <th>Defensor</th>
            <th>Tipo de Resolução</th>
            <th>Houve Resolução</th>
        </tr>
        <?php foreach($extrajudicial as $key => $value): ?>
        <tr>
            <td><?= $value['Pessoa']['nome'] ?></td>
            <td><?= $value['TipoResolucao']['nome'] ?></td>
            <td><?= $value['ResolucaoExtrajudicialPainel']['houve_resolucao']  ? 'SIM' : 'NÃO' ?></td>
        </tr>
        <?php endforeach; ?>
            
</table> 
<?php }