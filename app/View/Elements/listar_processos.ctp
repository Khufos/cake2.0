
<style>
.after_table{
    display: flex;
    width: 100%;
    justify-content: flex-end;
    font-size: 12px;

}
.table-lor2{
    margin-bottom: 1px;
}

.glyphicon-edit {
    padding-right: 5px;
}
.special {
    width: 90px;
}
 .table-lor2 th {
  background:  #4682B4;
  color: white;
}
.hideFunc{
display: none;
}
.showFunc{
display: block;

background-color: #ECECEC;
padding: 15px;
padding-bottom: 40px;
width: 100%;
height: fit-content;
min-height: 100px;
border: 1px solid #C9C9C9;
}

.buttonlor2-box {
    display: flex;
    width: 30%;
}
.buttonlor2 {
  font: bold 12px Arial;
  text-decoration: none;
  background-color: green;
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;
  margin-left:2px
}
.buttonlor2:hover {
  font: bold 12px Arial;
  text-decoration: none;
  background-color: green;
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;

  margin-left:2px
}
.buttonlor2:focus {
  font: bold 12px Arial;
  text-decoration: none;
  background-color: green;
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;

  margin-left:2px
}
.form-group-lor{
    display: flex;
    flex-direction: column;


}
table {
  border-collapse: collapse;
}

tr .line {
  border-bottom: 1pt solid black;
}
.buttonfgx{
    color:#FDFEFE ;
}
.buttonfgx:hover{
    color:#D6DBDF;
}
.buttonfgx:focus{
    color:#D6DBDF;
}
.headerTable{

    display: flex;
    background-color: #4682B4;
    width: 100%;
    color: #fff;
    padding: 12px;
}
.headerTable2{

display: flex;
background-color: #fff;
width: 100%;
color: black;
padding: 12px;
}
.table-body {
    padding: 10px;
}

.table-box {
    border: 1px solid #CCCCCC;
    margin-top: 20px;
}




</style>


<?php
    $url= $_SERVER['REQUEST_URI'];    
    $pieces  = explode("/", $url);

    ?>
    <div class="table-box">

    <?php 
    if($processosAssistidosVinculados) {
    ?>
    <div class="headerTable">
        Processo: <?=$processosAssistidosVinculados[0]['p']['numeracao_unica']?></font>
    </div>

    <div class="table-body">
    <div id="lista_processos_new_vinculo" style="margin-top: 15px">
        <table class="table table-bordered table-striped table-lor2" id="lista_tabela_processo_vinculo">
        <?php 
        if($processosAssistidosVinculados[0]['app']['processo_id'] != null) {
        ?>  
            
                <?php foreach($processosAssistidosVinculados as $key => $value):    ?>
                <tr>
                    <th ><b>Registro:</b> <?= $value['app']['id'] ?> </th>
                    <th><b>Em substituição:</b> <?= $value['app']['substituicao'] ? "Sim" :"Não" ?></th>
                    <th><b>Data:</b>
                     
                     <?php
                     if(isset($value['app']['data'])){
                        $arr2= str_split($value['app']['data'],10);
                        $piecesData  = explode("-", $arr2[0]);
                        $date = $piecesData[2] . '/' . $piecesData[1] . '/' . $piecesData[0];
                        echo $date;
                    }else{
                        echo "--";
                    }
                    ?>

                    </th>
                    <th >
                    <?php
                        
                        echo $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), array(
                            'controller' => 'processos',
                            'action' => "edit_modal_acoes/" .$idAssistido ."/" . $value['p']['id'] ."/". $value['app']['id'] ), array(
                            'title' => 'Editar',
                            'class' => 'buttonfgx',
                            'data-target' => "#modal",
                            'data-toggle' => "modal",
                            'escape' => false
                        ));

                        echo $this->Html->link($this->Html->div('glyphicon glyphicon-trash', ''), array(
                            'controller' => 'processos',
                            'action' => "edit_modal_acoes_delete/" .$idAssistido ."/" . $value['p']['id'] ."/". $value['app']['id']), array(
                            'title' => 'Delete',
                            'class' => 'buttonfgx',
                            'data-target' => "#modal",
                            'data-toggle' => "modal",
                            'escape' => false
                        ));
                    ?>
                    </th>
                </tr>
               
                <tr >
                    <td colspan="4"><b>Observacão:</b> <?= $value['app']['observacao'] ?></td>
                </tr>  
        
  
        <tr >
            <td  colspan="4" ><b>Atos(s) Praticado(s): </b></td>
        </tr>  
        <?php if($value['arti'] != 'N'): ?>           
            <?php foreach($value['arti'] as $key2 => $value2): ?>
                <tr>
                    <td colspan="4" >  <?= ($key2+1) .") " .$value2 . "</br>" ?></td>
                </tr>   
            <?php endforeach; ?> 
        <?php endif; ?> 

        <?php
   
    endforeach; 

    ?>
                <?php 
                } else{
            ?>
                <tr>
                    <th ><b>Registro:</b> Sem registro </th>
                </tr> 
                <tr >
                    <td >Não há Atos Praticados associados a este processo</td>
                </tr>  
            <?php 
            } 
            ?>

        </table>    
    </div>
    </div>


    <?php 
        } else{
    ?>
        <div class="headerTable">
            Processo: Não há processo vinculado a esta ação</font>
        </div>
    <?php 
        } 
    ?>

    </div>



    
