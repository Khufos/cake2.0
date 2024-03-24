<script type="text/javascript">
    //Mask Money
    String.prototype.reverse = function(){
        return this.split('').reverse().join(''); 
    };
    /*
    $(".select2-selection__choice__remove ").click(function() {
        $(this).remove();
    });
    */
    $(document).ready(function () {
        var testeOkk = true;
        $(".selectMultiplo").select2();
        
        $('#Lista_processoDataInicio').val($.datepicker.formatDate( "dd/mm/yy", new Date()))
        
  

        $("#submitInfProcList").click(function (event) {
                //validacao
                testeOkk = true;
                var ato = $("#Lista_processoAtopraticado").val()
                var data = $("#Lista_processoDataInicio").val()
                var substituicao0 = $("#Lista_processoSubstituicao0").val()
                var substituicao1 = $("#Lista_processoSubstituicao1").val()
                var postoAtendimento2 =$('#AtendimentoUnidadeId').find(":selected").val()
                var numberPostoAtendimento2 = parseInt(postoAtendimento2)

                if(isNaN(numberPostoAtendimento2)) {
                    alert("Por favor, preencha o campo de *[Posto de Antendimento]!");
                    return;
                }

                if( ato== null ||   data=='' || ato==''  || (substituicao0 =='' && substituicao0=='') ) {
                    alert("Existem campos obrigatórios em branco!");
                    return;
                }


                    var formulario = $('#InformacoesFormularioId').val();
                    var form = $("#"+formulario);


                    $.ajax({
                        type: "POST",
                        url: window.location.origin + '/processos/save_modal_acoes',
                        data: form.serialize(),
                        success: function (response) {  
                            esvaziarCampos();                  
                            alert("Informação Cadastrada com Sucesso!");
                            
                            //document.getElementById("infor_atend").style.display="none";
                            //document.getElementById("submitFormAcao").style.display="none";


                           // $("#lista_processos_new").load(window.location.href + " #lista_tabela_processo" );                      
                            $("#lista_processos_new_vinculo").load(window.location.href + " #lista_tabela_processo_vinculo" );
                        }
                    }); 
                    event.preventDefault();
                
                


                
                function esvaziarCampos() {
                    $('#Lista_processoNumeracaoUnica').val('');
                    $('#Lista_processoComarcaId').val('');
                    $('#Lista_processoUnidadeDefensorialId').val('');
                    $('#Lista_processoAtuacaoId').val('')
                    $('#Lista_processoSituacaoProcessualIdModal').val('');
                    $('#Lista_processoValorCausa').val('');
                    $('#Lista_processoObservacao').val('');

                    $('.select2-selection__choice').remove();
                    

                }
        });

        $('#Lista_processoAtopraticado').on('change', function () {
            $("#Lista_processoObservacao").attr("readonly", false); 
        });

        $( ".btn_delete_penal_lor" ).click(function(event) {
            event.preventDefault();
          //  alert('it worked')

        });

        $( ".btn_edit_penal_lor" ).click(function(event) {
            event.preventDefault();
            alert('it worked2')

        });
        
    });


    function deleteInformation(event, var_p_id, var_app_id) {
            event.preventDefault();
            
            $.ajax({
                type: 'POST',
                data: {
                    pid: var_p_id,
                    appid: var_app_id
                },
                url: "edit_modal_acoes_delete_ajax/",
                success: function (data) {
                    if(data != 'error'){
                        $("tr." + var_app_id).remove(); 
                    }
                },
            });
            
            
    }
    function editInformation(event,id_assistido,var_p_id, var_app_id) {

            
            $.ajax({
                type: 'POST',
                data: JSON.stringify({
                    aid: id_assistido,
                    pid: var_p_id,
                    appid: var_app_id
                }),
                contentType: "application/json",
                url: "edit_modal_ajax/?trs=1",
                success: function (data) {
                    data2 =JSON.parse(data)

                    resposta = data2.map(
                     function(objeto){
                        if(objeto.app.id == var_app_id){
                            $('#Lista_processoObservacao').val(objeto.app.observacao)

                            let dateArray = objeto.app.data.split("-"); 
                            dateArray.reverse(); // Reverse the order of the array
                            let newDate = dateArray.join("/"); // Join the array elements back into a string 
                            $('#Lista_processoDataInicio').val(newDate)
                            
                            $('#Lista_processoAtopraticado').val(objeto.arti2)

                            if(objeto.app.substituicao == '0'){
                                $("#Lista_processoSubstituicao0").attr("checked", true);
                            }else{
                                $("#Lista_processoSubstituicao1").attr("checked", true);
                            }

                            $("#Lista_processo_idregistro").val(objeto.app.id);
                            

                            $('.selectMultiplo').trigger('change');
  
                            
                        }

                        
                     }
                    )
                },
            });
      
    }

</script>
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
margin-top: 10px;
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
if(isset($idAcao)){
    echo $this->Form->hidden('Lista_processo.acao_id', array('value' => $idAcao));

    echo $this->Form->hidden('Lista_processo.processo_id',
     array('value' => $processosAssistidosVinculados[0]['p']['id']));
}  
     if(isset($processosAssistidosVinculados)) {
        if($processosAssistidosVinculados != false) {
?>
    <div class="panel panel-default m-top-10" id="formlor2">
    <div class="panel-heading"><b>Cadastro de Ato Processual</b></div>
    <div class="panel-body">

    <div class="row">
        <input type="hidden" id="Lista_processo_idregistro"  name="data[Lista_processo][idregistro]" value="">
        <div class="col-md-5">
            <div class="form-group">
                
                <label>Ato(s) Praticado(s):</label>
                <?php

                $args = array(
                    'class' => 'form-control input-sm selectMultiplo set-width-multiselect',
                    'empty' => 'Selecionar',
                    'multiple' => 'multiple',
                    //'default' => $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') != "" ? $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') : "",
                    //'disabled' => $this->Session->read('dadosAnexoSigilosos') != "" ? true : false
                );
                echo $this->Form->select("Lista_processo.atopraticado",  $EspecializadaAtoPraticadoGrouped, $args)
                ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Data de movimentação:</label>
                <?php echo $this->Form->text('Lista_processo.data_inicio', array('class' => 'data form-control input-sm')); ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group-lor">
                <label>Em substituição:</label>
                <div >
                <?php
                                        
                $opcoes = array(0=>'Não',1=>'Sim');
                $atributos = array(
                    'legend'=>false,
                    'separator'=>'&nbsp&nbsp',
                );
                echo $this->Form->radio('Lista_processo.substituicao',$opcoes,$atributos);
        
                ?>
                </div>

            </div>
       </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Observação:</label>
                <?php
                echo $this->Form->textarea('Lista_processo.observacao', array(
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
    echo" </div>";
        }}
    ?>

<?php
    $url= $_SERVER['REQUEST_URI'];    
    $pieces  = explode("/", $url);

    ?>
    <div class="table-box">

    <?php 

    if(isset($processosAssistidosVinculados) ) {
    if($processosAssistidosVinculados != false) {
    ?>
    <div class="headerTable">
        Processo: <?=$processosAssistidosVinculados[0]['p']['numeracao_unica']?></font>
    </div>

    <div class="table-body">
    <div id="lista_processos_new_vinculo2" style="margin-top: 15px">
        <table class="table table-bordered table-striped table-lor2" id="lista_tabela_processo_vinculo2">
        <?php 
        if($processosAssistidosVinculados[0]['app']['processo_id'] != null) {
        ?>  
            
            <?php foreach($processosAssistidosVinculados as $key => $value):    ?>
            
            <tr class="<?= $value['app']['id'] ?>" >
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
                    <div class="glyphicon glyphicon-edit buttonfgx" 
                        onClick="editInformation(event,<?=$idAssistido?>,<?=$value['p']['id']?>,<?=$value['app']['id']?>)">
                    </div>
                    <div class="glyphicon glyphicon-trash buttonfgx" 
                        onClick="deleteInformation(event,<?=$value['p']['id']?>,<?=$value['app']['id']?>)">
                        
                    </div>
                </th>
            </tr>
        
            <tr class="<?= $value['app']['id'] ?>">
                <td colspan="4"><b>Observacão:</b> <?= nl2br($value['app']['observacao']) ?></td>
            </tr>  
    

            <tr class="<?= $value['app']['id'] ?>">
                <td  colspan="4" ><b>Atos(s) Praticado(s): </b></td>
            </tr>  
            <?php if($value['arti'] != 'N'): ?>           
                <?php foreach($value['arti'] as $key2 => $value2): ?>
                    <tr class="<?= $value['app']['id'] ?>">
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
    <font>   Processo: Não há processo vinculado a esta ação</font>
    </div>
    <?php 
    }} else{
    ?>
    <div class="headerTable">
    <font>   Processo: Não há processo vinculado a esta ação</font>
    </div>
    <?php 
        } 
    ?>

    </div>



    
