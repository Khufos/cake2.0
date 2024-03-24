<?php
$urlPesquisaExtra = $this->Html->url([
    'controller' => 'RelatorioCorregedoria',
    'action' => 'relatorio_extrajudicial',
    '?' => ['trs' => 1]
], true);
?>

<?=  $this->Form->create('Post', array(
    'url' => array(
        'controller' => 'RelatorioCorregedoria',
        'action' => 'relatorio_extrajudicial'
    ),
    'id' => 'formExtrajud',
)) ?>

<div class="panel panel-default m-top-10">
    <div class="panel-heading"><b> Extrajudiciais:</b></div>
    <div class="panel-body">
                        
        <div class="row">
            <div class="col-md-3">  
                <div class="form-group">
                    <label><span class='label_bold esquerda'>*Posto de Atendimento:</span></label>
                    <?php
                    $uUnidade = $this->Session->read('Atendimento.unidade'); // ultima unidade que o atendimento foi realizado
                    $postos = $this->Session->read('postos'); // recebe os posto da sess�o; 
                    

                    if($uUnidade == null){
                        $idUnidade = $this->Session->read('Funcionario.unidade_id');
                        
                    }

                    echo $this->Form->select('Atendimento.unidade_id2', $postos, array(
                        'default' => $this->Util->setaValorPadrao($idUnidade, $uUnidade),
                        'class' => ' form-control input-sm'));
                    ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    
                    <label>*Tipo de atividade</label>
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
                    echo $this->Form->select("Lista_processo2.tipoatividade_id", $tipoAtividadeGrouped, $args);
                    

                    ?>
                </div>
            </div>


            
        </div>

        <div class="row">
            <!--
            <div class="col-md-2">
                <div class="form-group">
                    <span style="color: red;">*</span>
                    <label>Mês/Ano</label>
                    <div><input type="month" id="Lista_processo2DataInicio2" name="data[Lista_processo2][data_inicio2]"  class="custom-input" /></div>
                </div>
            </div>
            -->
            <div class="col-md-3">
                <div class="form-group">
                    <span style="color: red;">*</span>
                    <label for="RelatorioCorregedoriaData">Mês/Ano</label>
                    <div class="input-container">
                        <select id="monthSelect1" name="data[Lista_processo2][month]" >
                            <option value="" disabled selected>Mês</option>
                            <option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                            <!-- Add more months as needed -->
                        </select>
                        <select id="yearSelect1" name="data[Lista_processo2][year]">
                            <option value="" disabled selected>Ano</option>

                            <!-- Add more years as needed -->
                        </select>
                    </div>
                </div>
            </div>
                
            <div class="col-md-3">
                <div class="form-group">

                    <label>*Atuação:</label>
                    <?= $this->Form->select('especializada_id2',

                        $especializadas, [
                            'default' => isset($especializadaFuncId) ? $especializadaFuncId : null,
                            'class' => 'Trecho form-control input-sm ',
                            'id' => 'especializadaOtherId2',
                            'empty' => 'Selecione'
                        ]) ?>

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">

                <?= $this->Form->input('qtd_atividade', [
                    'type' => 'number',
                    'label' => '<span style="color: red;">*</span> Quant. de Atividades',
                    'placeholder' => 'digite a Quant. de Atividades',
                    'class' => 'form-control',
                    'id' => 'qtd_atividade_extr',
                    'required' => true
                ]) ?>

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
                    echo $this->Form->radio('Lista_processo2.substituicao_extrj',$opcoes,$atributos);
            
                    ?>
                    </div>
                    
                </div>
            </div>


        </div>
        
         
                <!-- -->
            
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
        
        <div class="row">
            <div class="col-md-12" style="text-align: right;">

                <div class="form-group">
                    <button id="limparExtrajudDoc"   class="btn btn-default">Limpar</button>
                    <button id="anexarExtrajudDoc" type="submit"  class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>  

    </div>

</div>

<?php echo $this->Form->end();  
 //   debug($_POST['data']['TableFiltro']);
?>

<?php 
if(isset($tabelaTipoAtividades)) {
?>
<div class="well" id="extrajudicial_div_table">

    <h4>Filtrar por atividades Extrajudiciais</h4>

        <form method="post" id="formDeff2" action="relatorio_atividades">
            <div class="d-flex">
        
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">Tipo de Atividade</span>
                        <select id="dataselect_deff2" class="Trecho form-control" name="data[TableFiltro2][select_deff2]"
                        >
                            <option value="">Selecione</option>
                            <?php
                            foreach ($tipoAtividadeGrouped as $value => $label) {
                                $selected = (isset($_POST['data']['TableFiltro2']['select_deff2']) && $_POST['data']['TableFiltro2']['select_deff2'] == $value) ? 'selected' : '';
                                echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">Data Inicial</span>
                        <input id="dataExpdc_deff2" type="date" class="form-control" name="data[TableFiltro2][expdc_deff2]"
                        value="<?= isset($_POST['data']['TableFiltro2']['expdc_deff2']) ? $_POST['data']['TableFiltro2']['expdc_deff2'] : '' ?>">
                       
                        <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Data Final</span>
                        <input id="dataExpdc_ateff2"  type="date" class="form-control" name="data[TableFiltro2][expdc_ateff2]"
                        value="<?= isset($_POST['data']['TableFiltro2']['expdc_ateff2']) ? $_POST['data']['TableFiltro2']['expdc_ateff2'] : '' ?>">
                    </div>
                </div>
                <div>
                    <div class="form-group col-md-2 text-center">
                        <div class="input-group">
                            <div class="center-button">
                                
                                <button type="submit" id="submitButton2">
                                    <div style="cursor: pointer;" title="Pesquisar" class="glyphicon glyphicon-search"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-2  text-center" style="margin-left: 10px;">
                        <div class="input-group">
                            <div class="center-button">
                                <button type="button" id="cleanButton2">
                                    <div style="cursor: pointer;" title="Limpar formulário" class="glyphicon glyphicon-remove-sign"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            
            </div>
        </form>

    <table id="tabela-tipoatividademodal2" class="table color-table-white table-hover table-bordered " >
      
        
        <thead>
            <tr class="titulo-table2">
                <th style="vertical-align: middle;width: 80px">Data <div style="cursor: pointer;" title="Data em que a informação foi lançada." class="glyphicon glyphicon-question-sign"></div></th>
                <th style="vertical-align: middle;width: 100px">mês/ano <div style="cursor: pointer;" title="mês/ano de registro da atividade." class="glyphicon glyphicon-question-sign"></div></th>
                <th>Atividade</th>
                <th width="40%"  >Observação</th>
                <th style="vertical-align: middle; text-align: center;">Quant. de Atividades</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            if(isset($tabelaTipoAtividades) && !Empty($tabelaTipoAtividades)) {
            foreach ($tabelaTipoAtividades as $key => $value) 
            { //  debug($tabelaTipoAtividades);
        ?>
                    
        <tr id="tr-<?= $value['AtividadeExtra']['id']; ?>">

            <td>
                <?php
                if($value['ta']['id_atividade']){
                    if(isset($value['AtividadeExtra']['data_cadastro'])){
                        $arr2= str_split($value['AtividadeExtra']['data_cadastro'],10);
                        $piecesData  = explode("-", $arr2[0]);
                        $date =   $piecesData[2] . '/' . $piecesData[1] . '/' . $piecesData[0];
                    } else {
                            $date = '-';
                    }
                }else{
                    $date = '-';
                }
                ?>
                <?= $date; ?>
            </td>
            <td>
                <?php
                if(isset($value['AtividadeExtra']['data'])){
                    $arr2= str_split($value['AtividadeExtra']['data'],10);
                    $piecesData  = explode("-", $arr2[0]);
                    $date =   $piecesData[1] . '/' . $piecesData[0];
                } else {
                        $date = '-';
                }
                ?>
                <?= $date; ?>
            </td>
            <td>
                <?= $value['ta']['nome']; ?>
            </td>
            <td style="text-align: justify; ">
                <?php
                if($value['AtividadeExtra']['observacao']){
                ?>
                <?= nl2br($value['AtividadeExtra']['observacao']); ?>
                <?php
                }else{
                    echo "Não há observações cadastradas";
                }
                ?>
            </td>
            <td>
                <?= $value['AtividadeExtra']['qtd_atividades']; ?>
            </td>
            <td >
            <div class="box-edit">
            <?php
            if(false){
            ?>
                <a title="campo..."   role="link" aria-disabled="true" ><div style="color:grey" class="glyphicon glyphicon-trash"></div></a>
            <?php
            
            }else{
            
                echo $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), array(
                'controller' => 'atividade_extras',
                'action' => "show_modal_extrajudicial2/" .$value['AtividadeExtra']['id'] . "/" . "1"), array(
                'title' => 'Editar',
                'class' => 'buttonxzc',
                'data-target' => "#modal",
                'data-toggle' => "modal",
                'escape' => false
            ));
            ?>
                <a title="excluir..." style="cursor:pointer" onclick="delPendencia2(event,<?= $value['AtividadeExtra']['id']; ?>)" ><div class="glyphicon glyphicon-trash"></div></a>
            
            <?php
            }
            ?>
            </div>
            </td>
        </tr>

        <?php  
            }

            
            // In your view (index.ctp)
            $prevPage2 = $currentPage2 > 1 ? $currentPage2 - 1 : 1;
            $nextPage2 = $currentPage2 < $totalPages2 ? $currentPage2 + 1 : $totalPages2;

            $select_deff2='x';
            $expdc_deff2='x';
            $expdc_ateff2='x';

            if(isset($_POST['data']['TableFiltro2']['select_deff2'])){
                $select_deff2 = $_POST['data']['TableFiltro2']['select_deff2'];
            }
            if(isset($_POST['data']['TableFiltro2']['expdc_deff2'])){
                $expdc_deff2 = $_POST['data']['TableFiltro2']['expdc_deff2'];
            }
            if(isset($_POST['data']['TableFiltro2']['expdc_ateff2'])){
                $expdc_ateff2 = $_POST['data']['TableFiltro2']['expdc_ateff2'];
            }

            ?>
            
            <tr class="classOcultar">
                <td id="paginAviso2" colspan="7" style="vertical-align: middle;">
                    <ul id="btn_navegacao2" class="pagination" style="margin: 0px;">
                        <li id="btnprev2">
                            <?= '<a href="?md=9&select_deff2='.$select_deff2.'&expdc_deff2='.$expdc_deff2.'&expdc_ateff2='.$expdc_ateff2.'&page2=' . $prevPage2 . '">«</a>' ?>
                        </li>
                        <li id="btnnumbers">
                            <?php
                            $range = 3; // Adjust the range as needed
            
                            // Display the first page
                            if ($currentPage2 > $range + 1) {
                                echo '<a href="?md=9&select_deff2='.$select_deff2.'&expdc_deff2='.$expdc_deff2.'&expdc_ateff2='.$expdc_ateff2.'&page2=1">1</a>';
                                if ($currentPage2 > $range + 2) {
                                    echo '<span>...</span>';
                                }
                            }
            
                            // Display the pages within the range
                            for ($x = max(1, $currentPage2 - $range); $x <= min($totalPages2 , $currentPage2 + $range); $x++) {
                                if ($x == $currentPage2) {
                                    echo '<span>' . $x . '</span>';
                                } else {
                                    echo '<a href="?md=9&select_deff2='.$select_deff2.'&expdc_deff2='.$expdc_deff2.'&expdc_ateff2='.$expdc_ateff2.'&page2=' . $x . '">' . $x . '</a>';
                                }
                            }
            
                            // Display the last page
                            if ($currentPage2 < $totalPages2 - $range) {
                                if ($currentPage2 < $totalPages2 - $range - 1) {
                                    echo '<span>...</span>';
                                }
                                echo '<a href="?md=9&select_deff2='.$select_deff2.'&expdc_deff2='.$expdc_deff2.'&expdc_ateff2='.$expdc_ateff2.'&page2=' . $totalPages2 . '">' . $totalPages2 . '</a>';
                            }
                            ?>
                        </li>
                        <li id="btnnext">
                            <?= '<a href="?md=9&select_deff2='.$select_deff2.'&expdc_deff2='.$expdc_deff2.'&expdc_ateff2='.$expdc_ateff2.'&page2=' . $nextPage2 . '">»</a>' ?>
                        </li>
                    </ul>
                </td>
            </tr>
            
        <?php 
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
    .box-edit {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .titulo-table2 {
        color: #fff;
        background-color: #4BB246 !important;
    }
    .color-table-white {
        background: #fff;
    }
    .buttonxzc{
        margin-right: 5px;
    }
    .buttonxzc:hover{
        margin-right: 5px;
    }
    .buttonxzc:focus{
        margin-right: 5px;
    }
</style>
<script>
    const queryString2 = window.location.search;
    const postDeff2 = "<?= isset($_POST['data']['TableFiltro2']['select_deff2']) ? $_POST['data']['TableFiltro2']['select_deff2'] : 'nopost' ?>"
    
    $(document).ready(function() {
        $('#PessoaNome').removeAttr('required');
        /*
        $('#submitButton2').click(function(event) {
            event.preventDefault();
            alert('ola')
            $('#formDeff2').submit();
        });
        */
        var currentYear = new Date().getFullYear();
        var pastYear = 2002;

        for (var year = currentYear; year >= pastYear; year--) {
            $('#yearSelect1').append('<option value="' + year + '">' + year + '</option>');
        }
        $('#yearSelect1').val(currentYear);

        var currentMonth = new Date().getMonth() + 1; // Adding 1 because months are zero-indexed
        $('#monthSelect1').val(currentMonth.toString().padStart(2, '0'));

    })
    switch (true) {
        case queryString2.includes('inst=3'):
            showTabContent2('abaExtrajudiciais');
            break;
        case queryString2.includes('page2'):
            showTabContent2('abaExtrajudiciais');
            break;
        default:
            // Handle the default case if none of the conditions match
            break;
    }

    if(postDeff2 != "nopost"){
        showTabContent2('abaExtrajudiciais');
    }

    //var initialValue = $('#PostFieldName').val();

    // Detect changes in the hidden input field
    $('#PostFieldName2').on('change', function() {
        var assistidoId = $(this).val();
        console.log(assistidoId)
        $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'assistidos', 'action' => "getNumeroAcaoAssistidoAjax/E?trs=1"), true) ?>",
                type: "POST",
                beforeSend: function(xhr) {
                    xhr.overrideMimeType("application/x-www-form-urlencoded")
                },
                data: {assistido_id: assistidoId},

                success: function(response) {
                    let de = JSON.stringify(eval("(" + response + ")"));
                    let data= JSON.parse(de);
                    console.log(data)
                    //$('#postNumeroAcao').empty();
                    //$( "li" ).remove( ".select2-selection__choice" );
                    $
                    $.each(data, function(key, value) {
                        $('#postNumeroAcao2').append('<option value="'+value[0].id+'">'+value[1].nome+'</option>');
                    });
                
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Request Error:", status, error);
                    // You can handle the error here, e.g., display an error message.
                    alert("An error occurred while fetching data.");
                }
            });
    });
    /*
    $('#PessoaNome').on('input', function() {
        // This function will be executed whenever the input value changes
        console.log('Input value changed: ' + $(this).val());
    });
    */
    $("#cleanButton2").click(function() {
       window.location.href = window.location.href.split('?')[0]; // Clear POST data
    });

    function showTabContent2(tabId) {
        $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
    }

    $('#Lista_processo2DataInicio2').val($.datepicker.formatDate( "dd/mm/yy", new Date()))

    $('#Lista_processo2TipoatividadeId').on('change', function () {
            $("#Lista_processo2Observacao").attr("readonly", false); 
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
        alert('Registro deletado com sucesso!');
            

        // Get the current URL
        var currentURL = window.location.href;
        console.log(currentURL);
        if (currentURL.indexOf('inst=3') === -1) {
            // Add '&inst=2' to the URL if it doesn't already exist
            var currentURL = window.location.href;
            var newURL = currentURL.split('?')[0] + '?inst=3';
            window.location.href = newURL;
            /*
            if(currentURL.indexOf('#') != -1){
                location.reload()
            }
            */
            
            // Reload the page with the modified URL
            //window.location.href = newURL;
            //location.reload()
            return;
        }
        window.location.href = currentURL;
        location.reload()
        },
        error: function(xhr, textStatus, errorThrown) {
        // Handle error if the AJAX request fails
        console.error('Error:', errorThrown);
        alert('Falha ao deletar o registro. Por favor, contate o suporte');
        }
    });
            
}
       
$('#anexarExtrajudDoc').click(function(event) {
    event.preventDefault();
    
  let Lista_processo2TipoatividadeId = $("#Lista_processo2TipoatividadeId" ).val();
  //let Lista_processo2DataInicio2 = $("#Lista_processo2DataInicio2" ).val();
  let Lista_processo2Substituicao_extrj = $("#Lista_processo2Substituicao_extrj" ).val();
  let Lista_processo2observacao = $("#Lista_processo2observacao" ).val();
  let AtendimentoUnidadeId2 = $("#AtendimentoUnidadeId2" ).val();
  let especializadaOtherId2 = $("#especializadaOtherId2" ).val();
 


    if($.trim(Lista_processo2TipoatividadeId) === "" || 
     $.trim(AtendimentoUnidadeId2) === "" || $.trim(especializadaOtherId2) === "" 
    ){
        alert('Existe campos obrigatórios em branco!')
        return;
    }
    
    var form2 = document.getElementById('formExtrajud');

    var formData2 = new FormData(form2);
    
        $.ajax({
                type: 'POST',
                url: '<?= $urlPesquisaExtra ?>',
                data: formData2,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response)

                    if(response.success == true){
                        alert('Formulário enviado com sucesso!')
                    }else {
                        alert('Houve um erro no envio do formulário')
                    }
                         
                    // Get the current URL
                    var currentURL = window.location.href;
                   
                    if (currentURL.indexOf('inst=3') === -1) {
                        // Add '&inst=2' to the URL if it doesn't already exist
                        var currentURL = window.location.href;
                        var newURL = currentURL.split('?')[0] + '?inst=3';
                        window.location.href = newURL;
                        /*
                        if(currentURL.indexOf('#') != -1){
                            location.reload()
                        }
                        */
                        // Reload the page with the modified URL
                        
                        //location.reload()
                        return;
                    }else{
                        //console.log(currentURL)
                        //window.location.href = currentURL;
                        location.reload()
                    }
                    
                    
                    
                }
        });
    


});
</script>
