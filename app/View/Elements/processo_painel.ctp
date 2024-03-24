<style>
    .link-modal2{
        color:#FDFEFE ;
    }
    .buttonfgx{
        color:#FDFEFE ;
    }

    .link-modal2:hover{
        color:#D6DBDF;
    }
    .buttonfgx:hover{
        color:#D6DBDF;
    }
    .link-modal2:focus{
        color:#D6DBDF;
    }
    .buttonfgx:focus{
        color:#D6DBDF;
    }

    .table-box {
    border: 1px solid #CCCCCC;
    margin-top: 15px;
    }

    .table-body {
    padding: 10px 10px 10px 10px;
    margin-top: 15px;
    }
    .headerTable{

    display: flex;
    background-color: #4682B4;
    width: 100%;
    color: #fff;
    padding: 12px;
    font-weight: 700;

    }
    .headerTable-div1 {
        width: 50%;
        
    }
    .headerTable-div2 {
        width: 50%;
        
    }


</style>
<?php 

if(!empty($processosAssistidosNovo)){ 
    
?>
    <?php 
    $x = '';
    ?>
            <?php foreach($processosAssistidosNovo as $key => $value): ?>
            <?php if(count($value['artic']) > 0){

            ?>
<div class="table-box">
    <div class="headerTable">
        <div class="headerTable-div1">Processo: <?=$value['p']['numeracao_unica']?></div>  
        <div class="headerTable-div2">      
            <?php foreach($value['ac']as $key => $valued): ?>
                
                <?php
                if (isset($valued[0]['numero'])) {
                    echo '&#8226 ';
                    echo $this->Html->link(
                        $valued[0]['numero'],
                        array(
                            "controller" => $valued[0]['link'],
                            "action" => "edit/"  . $valued[0]['id_link']
                        ),
                        array(
                            "class" => "buttonfgx",
                            "title" => 'Consulta Processual',
                            "target" => "_blank"
                        ),
                        null,
                        null,
                        false
                    );
                    echo " - ";
                    echo $valued[1];
                    echo "</br>";
                } else {
                    
                }
                ?>
                <?php endforeach; ?> 
        </div> 
    </div>
        <div class="table-body" id="lista_processos_new_vinculo-<?=$value['p']['id']?>" >
            <table class="table table-bordered table-striped" id="lista_tabela_processo_vinculo-<?=$value['p']['id']?>">        
           
                <tr>
                    <th >Comarca</th>
                    <th>Vara</th>
                    <th>Data de Movimentação</th>

                </tr>
           
                <tr>
                    <td><?= $value['c']['comarca'] ?></td>
                    <td><?= $value['atu']['vara'] ?></td>
                    <td>
                    <?php
                        if(isset($value['p']['data_cadastro'])){
                            $arr2= str_split($value['p']['data_cadastro'],10);
                            $pieces  = explode("-", $arr2[0]);
                            $date = $pieces[2] . '/' . $pieces[1] . '/' . $pieces[0];
                            echo  $date;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>

                </tr>  

            <?php foreach($value['artic']as $key => $value): 
                if(!empty($value[0])){
            ?>
                <tr>
                    <td  colspan="4"  bgcolor="#4682B4" > <font color="#FFF"><b>Registro: <?= $value[1] ?> </b></font></td>
                </tr>  
                <tr>
                    <td  colspan="4" ><b>Atos(s) Praticados(s)</b></td>
                </tr> 
                <?php foreach($value[0] as $key2 => $value2): ?>
                    <tr>
                        <td colspan="4" ><?= $key2+1 ?> ) <?= $value2 ?></td>
                    </tr>  
                <?php endforeach; ?> 
            <?php 
                }else {
            ?> 
                    <tr>
                        <td  colspan="4" ><b>Atos(s) Praticados(s)</b></td>
                    </tr> 
                    <tr>
                    <td colspan="4" >Não há Atos Praticados para este processo </td>
                    </tr>
            <?php 
                }
            endforeach; 
            ?>
    </table>
</div>
<?php } ?>
</div>
<?php
endforeach; 
} else {
    echo 'NENHUM ATO PRATICADO EM PROCESSO CADASTRADO NO PAINEL';
}
?>