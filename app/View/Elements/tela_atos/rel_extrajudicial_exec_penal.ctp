<div class="panel panel-default m-top-10">
    <div class="panel-heading"><b> Extrajudiciais:</b></div>
    <div class="panel-body">
                        
        <div class="col-md-12">
            <div class="formlor">
   
                <div class="col-md-6">
                    
                    <label>Tipo de atividade</label>
                    <?php
                    $tipoAtividade = isset($tipoAtividade) ? $tipoAtividade : array();
                    $tipoAtividadeIdsEsc1 = isset($tipoAtividadeIdsEsc) ? $tipoAtividadeIdsEsc : '';
                    $args = array(
                        'default' => $tipoAtividadeIdsEsc1,
                        'class' => 'form-control input-sm selectMultiplo set-width-multiselect',
                        'empty' => 'Selecionar',
                        'multiple' => 'multiple',
                        //'default' => $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') != "" ? $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') : "",
                        //'disabled' => $this->Session->read('dadosAnexoSigilosos') != "" ? true : false
                    );
                    echo $this->Form->select("Lista_processo2.tipoatividade_id", $tipoAtividadeGrouped, $args)
                    ?>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Data de movimentação:</label>
                        <?php echo $this->Form->text('Lista_processo2.data_inicio2', array('class' => 'data form-control input-sm')); ?>
                    </div>
                </div>
                

                <div class="col-md-3">
                    <div class="form-group-lor">
                        <label>Em substituição:</label>
                        <div>
                        <?php
                                                
                        $opcoes = array(0=>'Não',1=>'Sim');
                        $atributos = array(
                            'legend'=>false,
                            'separator'=>'&nbsp&nbsp',
                        );
                        echo $this->Form->radio('Lista_processo2.substituicao_extrj',$opcoes,$atributos);
                
                        ?>
                        </div>
                        
                    </div>
                </div>

                <!-- -->
            </div>

        </div>
        
        <div class="col-md-12">
            <div class="form-group" >
                <label>Observação:</label>
                <?php
                echo $this->Form->textarea('Lista_processo2.observacao', 
                array(
                    'class' => 'form-control input-sm',
                    'readonly'=> 'true',
                    'rows' =>'8'
                    )
                
                );
                ?>
            </div>
        </div>
        

    </div>
</div>
<?php 
if(isset($tabelaTipoAtividades)) {
?>
<div class="well">
    <table id="tabela-tipoatividademodal2" class="table color-table-white table-hover table-bordered " >
        <caption>Atividades cadastradas por mim</caption>
        
        <thead>
            <tr class="titulo-table2">
                <th>Atividade</th>
                <th width="40%">Observação</th>
                <th>Data</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            if(isset($tabelaTipoAtividades) && !Empty($tabelaTipoAtividades)) {
            foreach ($tabelaTipoAtividades as $key => $value) 
            {   //debug($processosAssistidosVinculados);
        ?>

        <tr id="tr-<?= $value['ate']['id']; ?>">
            <td>
                <?= $value['ta']['nome']; ?>
            </td>
            <td style="text-align: justify; ">
                <?php
                if($value['ate']['observacao']){
                ?>
                <?= nl2br($value['ate']['observacao']); ?>
                <?php
                }else{
                    echo "Não há observações cadastradas";
                }
                ?>
            </td>
            <td>
                <?php
                if($value['ta']['id_atividade'] == $tipoAtividadeIds || $value['ta']['id_atividade'] == $AtividadeRetornoId){
                    if(isset($value['ate']['data_clicked'])){
                        $arr2= str_split($value['ate']['data_clicked'],10);
                        $piecesData  = explode("-", $arr2[0]);
                        $date = $piecesData[2] . '/' . $piecesData[1] . '/' . $piecesData[0];
                    } else {
                            $date = '-';
                    }
                }else{
                    if(isset($value['ate']['data'])){
                        $arr2= str_split($value['ate']['data'],10);
                        $piecesData  = explode("-", $arr2[0]);
                        $date = $piecesData[2] . '/' . $piecesData[1] . '/' . $piecesData[0];
                    } else {
                            $date = '-';
                    }
                }
                ?>
                <?= $date; ?>
            </td>
            <td >
            <?php
            if(false){
            ?>
                <a title="campo..."   role="link" aria-disabled="true" ><div style="color:grey" class="glyphicon glyphicon-trash"></div></a>
            <?php
            }else{
            ?>
                <a title="excluir..." style="cursor:pointer" onclick="delPendencia2(event,<?= $value['ate']['id']; ?>)" ><div class="glyphicon glyphicon-trash"></div></a>
            <?php
            }
            ?>
            </td>
        </tr>
        <?php  
            }
        }else{
            echo "<tr>";
            echo "<td colspan='3'>";
                echo "<p>Não há atividades cadastradas</p>";
            echo "</tr>";
            echo "</td>";
        }
        ?>
        </tbody>

    </table>

    <table id="tabela-tipoatividademodal2" class="table color-table-white table-hover table-bordered " >
        <caption>Atividades cadastradas pelos demais usuários</caption>
        <thead>
            <tr class="titulo-table2">
                <th>Atividade</th>
                <th>Autor</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            if(isset($tabelaTipoAtividadesDemais) && !Empty($tabelaTipoAtividadesDemais)) {
            foreach ($tabelaTipoAtividadesDemais as $key => $value) 
            {   //debug($processosAssistidosVinculados);
        ?>

        <tr >
            <td>
                <?= $value['ta']['nome']; ?>
            </td>
            <td>
                <?= $value['pe']['nome']; ?>
            </td>
            <td>
                <?php
                if(isset($value['ate']['data'])){
                    $arr2= str_split($value['ate']['data'],10);
                    $piecesData  = explode("-", $arr2[0]);
                    $date = $piecesData[2] . '/' . $piecesData[1] . '/' . $piecesData[0];
                    } else {
                        $date = '-';
                    }
                ?>
                <?= $date; ?>
            </td>



        </tr>
        <?php  
            }
        }else{
            echo "<tr>";
            echo "<td colspan='3'>";
                echo "<p>Não há atividades cadastradas</p>";
            echo "</tr>";
            echo "</td>";
        }
        ?>
        </tbody>

    </table>
</div>
<?php 
}
?>


<style type="text/css">
    .table-responsive2{
        max-height: 50vh;
        overflow-y: auto;
    }
    .titulo-table2 {
        color: #fff;
        background-color: #419641;
    }
    .color-table-white {
        background: #fff;
    }

</style>
<script>
    $('#Lista_processo2DataInicio2').val($.datepicker.formatDate( "dd/mm/yy", new Date()))

    $('#Lista_processo2TipoatividadeId').on('change', function () {
            $("#Lista_processo2Observacao").attr("readonly", false); 
        });

$( "#try" ).click(function() {
  alert( "Handler for .click() called." );
});

function delPendencia2(event,id) {
    event.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller' => 'atividade_extras', 'action' => 'show_modal_acoes2_del'), true) ?>",
                data: {
                    id: id,
                },
                success: function(response) {
                //   list_atividadesExtras();
                // $("#lista_tabela_2tt").load(window.location.href+"#tabela-tipoatividademodal2"); 
                    alert(response);
                    $(`#tr-${id}`).remove();
                }
            });
            
}
       
       
</script>