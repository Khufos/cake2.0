<?php
//FireCake::info($historicos, '$historicos');
if (!empty($historicos)) { // existir histórico    
    ?>   
    <fieldset>        
        <table width="100%" id="tableHistoricoCasos" class="Sorter tablesorter cabecalhoRel scrollableFixedHeaderTable historico printHistorico">   
            <caption class="captionA"> Ocorr&ecirc;ncia(s)</caption>
            <tr>
                <th width="2%"><?php echo $this->Form->checkbox('check', array("class" => 'checked')); ?></th>
                <th width="21%">DEFENSOR/SERVIDOR</th>
                <th width="61%">OBSERVA&Ccedil;&Atilde;O</th>
                <th width="10%">DATA</th>                
            </tr>
            <?php
//			  	FireCake::info($idFunc ,"func");
            $i = 0;
            $key = 0;
            foreach ($historicos as $historico):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr <?php echo $class; ?>>
                    <td align="justify"><?php echo $this->Form->checkbox('id' . $i, array("value" => $historico['AcaoHistorico']['id'], "class" => 'hide', "name" => 'data[AcaoHistorico][id][]')); ?></td>
                    <td align="justify"><?php echo $historico['Funcionario']['nome']; ?></td>
                    <td class="content" style="text-align: justify;"><?php echo nl2br(wordwrap($historico['AcaoHistorico']['observacao'], 73, ' ', true)); ?></td>
                    <td><?php echo $historico['AcaoHistorico']['data']; ?></td>                   
                </tr>
                <?php
                $key++;
            endforeach;
            ?>
        </table>                
    </fieldset>   
    <?php
}
?>
