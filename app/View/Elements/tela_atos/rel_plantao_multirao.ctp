<div class="panel panel-default m-top-10">
    <div class="panel-heading"><b> Plantão Multirão:</b></div>
    <div class="panel-body">
                        
        <div class="col-md-12">
            <div class="formlor">

                <div class="form-grouplor23">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label>Tipo de Plantão/Mutirão</label>
                                <?php
                                $tipoAtividadeIdsEsc2 = isset($tipoAtividadeIdsEscMult) ? $tipoAtividadeIdsEscMult : '';
                                $args = array(
                                    'class' => 'form-control input-sm selectMultiplo set-width-multiselect',
                                    'empty' => 'Selecionar',
                                );
                                echo $this->Form->select("Lista_processo3.tipogrupo_id", $tipoAtividadeGroupedSigla, $args)
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label>Tipo de Atividade</label>
                                <?php
                                $tipoAtividade = isset($tipoAtividade) ? $tipoAtividade : array();
                                $tipoAtividadeIdsEsc2 = isset($tipoAtividadeIdsEscMult) ? $tipoAtividadeIdsEscMult : '';
                                $tipoAtividadeGroupedOutro= array(''=>'vazio');
                                $args = array(
                                    'default' => $tipoAtividadeIdsEsc2,
                                    'class' => 'form-control input-sm selectMultiplo set-width-multiselect',
                                    'empty' => 'Selecionar',
                                    'multiple' => 'multiple',
                                    //'default' => $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') != "" ? $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') : "",
                                    //'disabled' => $this->Session->read('dadosAnexoSigilosos') != "" ? true : false
                                );
                                echo $this->Form->select("Lista_processo3.tipoatividade_id", $tipoAtividadeGroupedOutro, $args)
                                ?>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="form-group">
                        <label>Data de movimentação:</label>
                        <?php echo $this->Form->text('Lista_processo3.data_inicio2', array('class' => 'data form-control input-sm')); ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group-lor">
                        <label>Em substituição:</label>
                        <div>
                        <?php
                                                
                        $opcoes = array(0=>'Não',1=>'Sim');
                        $atributos = array(
                            'legend'=>false,
                            'separator'=>'&nbsp&nbsp',
                        );
                        echo $this->Form->radio('Lista_processo3.substituicao_extrj',$opcoes,$atributos);
                
                        ?>
                        </div>

                    </div>
                </div>


            </div>

        </div>
        <div class="col-md-12">
            <div class="form-group" >
                <label>Observação:</label>
                <?php
                echo $this->Form->textarea('Lista_processo3.observacao',
                 array(
                    'class' => 'form-control input-sm',
                    'readonly'=> 'true',
                    'rows' =>'8'
                ));
                ?>
            </div>
        </div>
    </div>

</div>

<?php 
if(isset($tabelaTipoAtividadesOutros)) {
?>
<div class="well">
    <table id="tabela-tipoatividademodal2" class="table color-table-white table-hover table-bordered " >
        <caption>Atividades cadastradas por mim</caption>
        
        <thead>
            <tr class="titulo-table3">
                <th>Atividade</th>
                <th width="40%">Observação</th>
                <th>Data</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            
            if(isset($tabelaTipoAtividadesOutros) && !Empty($tabelaTipoAtividadesOutros)) {
            foreach ($tabelaTipoAtividadesOutros as $key => $value) 
            {   //debug($processosAssistidosVinculados);
        ?>

        <tr id="tr-mult-<?= $value['ate']['id']; ?>">
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
            if($value['ta']['id_atividade'] == $tipoAtividadeIds){
            ?>
                <a title="campo..."   role="link" aria-disabled="true" ><div style="color:grey" class="glyphicon glyphicon-trash"></div></a>
            <?php
            }else{
            ?>
                <a title="excluir..." style="cursor:pointer" onclick="delPendencia3(<?= $value['ate']['id']; ?>)" ><div class="glyphicon glyphicon-trash"></div></a>
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

    <table id="tabela-tipoatividademodal3" class="table color-table-white table-hover table-bordered " >
        <caption>Atividades cadastradas pelos demais usuários</caption>
        <thead>
            <tr class="titulo-table3">
                <th>Atividade</th>
                <th>Autor</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            if(isset($tabelaTipoAtividadesDemaisOutros) && !Empty($tabelaTipoAtividadesDemaisOutros)) {
            foreach ($tabelaTipoAtividadesDemaisOutros as $key => $value) 
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
    .titulo-table3 {
        color: #fff;
        background-color: #008239;
    }

</style>
<script>
    $('#Lista_processo3DataInicio2').val($.datepicker.formatDate( "dd/mm/yy", new Date()))
   
$( "#try" ).click(function() {
  alert( "Handler for .click() called." );
});

$('#Lista_processo3TipogrupoId').on('change', function () {
    let grupo_id = $(this).val();
    
    
    $.ajax({
        url: "<?php echo $this->Html->url(array('controller' => 'atividade_extras', 'action' => "get_rc_atividades/E?trs=1"), true) ?>",
        type: "POST",
        data: {grupo_id: grupo_id},
        dataType: 'json',
        success: function(data) {
           $('#Lista_processo3TipoatividadeId').empty();
            $( "li" ).remove( ".select2-selection__choice" );
            $.each(data, function(key, value) {
                $('#Lista_processo3TipoatividadeId').append('<option value="'+value[0].id+'">'+value[1].nome+'</option>');
            });
           
        }
    });
    
});

$('#Lista_processo3TipoatividadeId').on('change', function () {
            $("#Lista_processo3Observacao").attr("readonly", false); 
});

function delPendencia3(id) {
    
    
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
                    $(`#tr-mult-${id}`).remove();
                }
            });
            
}
       
       
</script>