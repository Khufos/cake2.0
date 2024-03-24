<style>
    .margin-bottom {

        margin-bottom: 10px;
        box-shadow: 0px 1px 0px #091e4240;
    }

</style>
<div>
    <h4>HISTÓRICO DE ATENDIMENTOS</h4> 
</div>

<table width="100%" class="table">  
    <thead>
        <tr>   
            <th>DEFENSOR/SERVIDOR</th>
            <th>OBSERVA&Ccedil;&Atilde;O</th>
            <th>DATA</th>
        </tr>
    </thead>
    <?php
    $i = 0;
    $key = 0;
    foreach ($historico as $hist):  

    if($model == 'acoes' || in_array($model, $allowedModelsList)):

    if (($hist['AcaoHistorico']['observacao'] != '' && $hist['AcaoHistorico']['observacao'] != 'ND') || isset($hist['AcaoHistorico']['data3'])
    ||  isset($hist['AcaoHistorico']['data4']) || isset($hist['AcaoHistorico']['data5'] )):
    
    if(isset($hist['AcaoHistorico']['data4'])){
        /*
        if($hist['AcaoHistorico']['atos_praticados'] == 'Atendimento ao público caso novo' || $hist['AcaoHistorico']['atos_praticados'] == 'Atendimento ao público caso retorno'){
            continue;
        }
        */
    }


            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr <?php echo $class; ?> >
                <td align="justify" style='width: 335px;'><?php if($hist['Funcionario']['tipo_funcionario'] == 4){
                    echo 'DEF. ';
                } echo $hist['Funcionario']['nome']; ?></td>

                <?php
                if(isset($hist['AcaoHistorico']['data2'])){
                ?>
                    <td class="content" style="text-align: justify;" style="width: 100px;" >
                        <b class='badge margin-bottom' style='background-color: #dc3545;'> Observação</b><br/>
                        <?php echo "• " . nl2br(wordwrap($hist['AcaoHistorico']['observacao'], 73, ' ', true)); ?>
                    </td>   
                <?php
                    }elseif(isset($hist['AcaoHistorico']['data3'])){
                        echo  "<td class='content' style='text-align: justify;' style='width: 100px;' >";
                        echo  "<b class='badge margin-bottom' style='background-color: #28a745;' > Atos Processuais:</b><br/>";
                        foreach ($hist['AcaoHistorico']['atos_praticados'] as $key => $value) {
                ?>
                    <?php echo ($key+1).") ". $value ."<br/>"; ?>
                    <?php
                        }
                        if($hist['AcaoHistorico']['observacao']){
                            echo "<br/>" ;
                            echo "• " . $hist['AcaoHistorico']['observacao'];
                            echo  "</td>";
                        }else{
                            echo  "</td>";
                        }

                    }elseif(isset($hist['AcaoHistorico']['data4'])){
                        echo  "<td class='content' style='text-align: justify;' style='width: 100px;'>";
                        echo  "<b class='badge margin-bottom' style='background-color: #007bff;'> Atos Extrajudiciais:</b><br/>";
                        echo  "1) " .$hist['AcaoHistorico']['atos_praticados']."<br/>";

                        if($hist['AcaoHistorico']['observacao']){
                            echo "<br/>" ;
                            echo "• " . $hist['AcaoHistorico']['observacao'];
                            echo  "</td>";
                        }else{
                            echo  "</td>";
                        }

                    }elseif(isset($hist['AcaoHistorico']['data5'])){
                        echo  "<td class='content' style='text-align: justify;' style='width: 100px;'>";
                        echo  "<b class='badge margin-bottom' style='background-color: #17a2b8;'> Atos Extrajudiciais Plantão/Mutirão:</b><br/>";
                        echo  "1) " .$hist['AcaoHistorico']['atos_praticados']."<br/>";

                        if($hist['AcaoHistorico']['observacao']){
                            echo "<br/>" ;
                            echo "• " . $hist['AcaoHistorico']['observacao'];
                            echo  "</td>";
                        }else{
                            echo  "</td>";
                        }
                    }
                    ?>
                <td style='width: 200px;'>
                <?php
                        if(isset($hist['AcaoHistorico']['data3'])){
                        ?>      
                            <?php echo substr($hist['AcaoHistorico']['data'], 0, -8);  ?>
                        <?php
                        }elseif(isset($hist['AcaoHistorico']['data4'])){
                        ?>      
                            <?php echo substr($hist['AcaoHistorico']['data4'], 0, -8);  ?>
                        <?php
                        }elseif(isset($hist['AcaoHistorico']['data5'])){
                        ?>      
                            <?php echo substr($hist['AcaoHistorico']['data5'], 0, -8);  ?>
                        <?php
                        }else{
                        ?>
                        <?php echo $hist['AcaoHistorico']['data']; ?>
                        <?php
                        }
                        ?>
                </td>

            </tr>
            <?php
            $key++;
    endif;
    endif;

    if($model != 'acoes' && !in_array($model, $allowedModelsList)):

        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
        ?>
        <tr <?php echo $class; ?> >
            <td align="justify"><?php if($hist['Funcionario']['tipo_funcionario'] == 4){
                echo 'DEF. ';
            } echo $hist['Funcionario']['nome']; ?></td>
            <td class="content" style="text-align: justify;"><?php echo nl2br(wordwrap($hist['AcaoHistorico']['observacao'], 73, ' ', true)); ?></td>

            <td><?php echo $hist['AcaoHistorico']['data']; ?></td>

        </tr>
        <?php
        $key++;

    endif;
    endforeach;
    ?>
</table>
