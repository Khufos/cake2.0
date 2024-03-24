<?php
$urlPesquisaJud = $this->Html->url([
    'controller' => 'RelatorioCorregedoria',
    'action' => 'relatorio_judicial',
    '?' => ['trs' => 1]
], true);
?>

<?php
$urlNumeracaoUnica = $this->Html->url([
    'controller' => 'Processos',
    'action' => 'getIdAjax',
    '?' => ['trs' => 1]
], true);
?>

<?=  $this->Form->create('Post', array(
    'url' => array(
        'controller' => 'RelatorioCorregedoria',
        'action' => 'relatorio_judicial'
    ),
    'id' => 'formjud',
)) ?>

<div class="panel panel-default m-top-10">
    <div class="panel-heading"><b> Judiciais:</b></div>
    <div class="panel-body">
                        
        <div class="row">

            <div class="col-md-2">
                <div class="form-group">
                <span style="color: red;">*</span>
                    <label>Data:</label>
                    <?php echo $this->Form->text('Lista_processo5.data_inicio5', array('class' => 'data form-control input-sm')); ?>
                </div>
            </div>

            <?php 
            echo $this->Form->input('hidden_ato_praticado_processo_id', array('type' => 'hidden', 'value' => '', 'id'=> 'hidden_ato_praticado_processo_id'));
            echo $this->Form->input('hidden_processo_id', array('type' => 'hidden', 'value' => '', 'id'=> 'hidden_processo_id'));
            ?>

            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                <span style="color: red;">*</span>
                    <label>Numeração Única</label>

                    <div id="boxNomeCivil">
                        <?= $this->Form->text('Filtro.nome', array('id' => 'FiltroNome', 'class' => 'form-control input-sm num_unica')); ?>
                        <?php echo $this->Jmycake->autocomplete2('FiltroNome', 'Processos/numeracao_unica', 'processos', 'formjud');?>
                    </div>

                </div>
            </div>
            <div class="my-button">
                <div style="margin-top: 10px;">
                    <button type="button" class="btn btn-primary" onclick="openModal()">Novo Processo</button>
                </div>
            </div>
        </div>

        <div class="row">
                
            <div class="col-md-3">
                <div class="form-group">
                <span style="color: red;">*</span>
                    <label>Atuação:</label>
                    <?= $this->Form->select('especializada_id5',

                        $especializadas, [
                            'default' => isset($especializadaFuncId) ? $especializadaFuncId : null,
                            'class' => 'Trecho form-control input-sm ',
                            'id' => 'especializadaOtherId5',
                            'empty' => 'Selecione'
                        ]) ?>

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                <span style="color: red;">*</span>
                    <label>Ato(s) Praticado(s):</label>
                    <?php
                    $EspecializadaAtoPraticadoGrouped= array(''=>'vazio');
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
                    echo $this->Form->radio('Lista_processo5.substituicao_extrj',$opcoes,$atributos);
            
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
                echo $this->Form->textarea('Lista_processo5.observacao', 
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
                    <button id="limparExtrajudDoc5"   class="btn btn-default">Limpar</button>
                    <button id="anexarExtrajudDoc5" type="submit"  class="btn btn-primary">Cadastrar</button>
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
<div class="well" id="extrajudicial_div_table5">

<h4>Filtrar por Atos Praticados</h4>

        <form method="post" id="formDeff5" action="relatorio_atividades">
            <div class="d-flex">
        
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">Tipo de Atividade</span>
                        <select id="dataselect_deff5" class="Trecho form-control" name="data[TableFiltro5][select_deff5]"
                        >
                            <option value="">Selecione</option>
                            <?php
                            foreach ($tipoAtividadeGroupedJud as $value => $label) {
                                $selected = (isset($_POST['data']['TableFiltro5']['select_deff5']) && $_POST['data']['TableFiltro5']['select_deff5'] == $value) ? 'selected' : '';
                                echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">Data Inicial</span>
                        <input id="dataExpdc_deff5" type="date" class="form-control" name="data[TableFiltro5][expdc_deff5]"
                        value="<?= isset($_POST['data']['TableFiltro5']['expdc_deff5']) ? $_POST['data']['TableFiltro5']['expdc_deff5'] : '' ?>">
                       
                        <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Data Final</span>
                        <input id="dataExpdc_ateff5"  type="date" class="form-control" name="data[TableFiltro5][expdc_ateff5]"
                        value="<?= isset($_POST['data']['TableFiltro5']['expdc_ateff5']) ? $_POST['data']['TableFiltro5']['expdc_ateff5'] : '' ?>">
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

    <table id="tabela-tipoatividademodal5" class="table color-table-white table-hover table-bordered " >
      
        
        <thead>
            <tr class="titulo-table2">
                <th style="vertical-align: middle;width: 80px">Data <div style="cursor: pointer;" title="Data em que a informação foi lançada." class="glyphicon glyphicon-question-sign"></div></th>
                <th>Assistido</th>
                <th>Ato praticado</th>
                <th>Processo</th>

                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            if(isset($tabelaAtoPraticadoProcessos) && !Empty($tabelaAtoPraticadoProcessos)) {
            foreach ($tabelaAtoPraticadoProcessos as $key => $value) 
            {
        ?>
                    
        <tr id="tr-<?= $value['AtoPraticadoProcesso']['id']; ?>">

            <td>
                <?php
                if(isset($value['AtoPraticadoProcesso']['data'])){
                    $arr2= str_split($value['AtoPraticadoProcesso']['data'],10);
                    $piecesData  = explode("-", $arr2[0]);
                    $date =   $piecesData[2] . '/' . $piecesData[1] .'/' . $piecesData[0];
                } else {
                        $date = '-';
                }
                ?>
                <?= $date; ?>
            </td>
            <td>
                <?= $value['pessoa']['nome']; ?>
            </td>
            <td>
            <?php 
                foreach ($value['AtoPraticado']['nome2'] as $key2 => $value2) {
                    echo " <p> ". ($key2+1).") $value2 </p>";
                }

            ?>
            </td>
            <td>
                <?= $value['processos']['numeracao_unica']; ?>
            </td>
            <td >
            <div class="box-edit">
            <?php
            if(false){
            ?>
                <a title="campo..."   role="link" aria-disabled="true" ><div style="color:grey" class="glyphicon glyphicon-trash"></div></a>
            <?php
            
            }else{
            
            ?>
                <div style="cursor: pointer;" class="glyphicon glyphicon-edit" title="editar" onclick="Edicao5('<?=$value['AtoPraticadoProcesso']['id']?>','<?=$_SERVER['REQUEST_URI']?>')"></div>
                <a title="excluir..." style="cursor:pointer" onclick="delPendencia5(event,<?= $value['AtoPraticadoProcesso']['id']; ?>)" ><div class="glyphicon glyphicon-trash"></div></a>
            
            <?php
            }
            ?>
            </div>
            </td>
        </tr>

        <?php  
            }

            
            // In your view (index.ctp)
            $prevPage5 = $currentPage5 > 1 ? $currentPage5 - 1 : 1;
            $nextPage5 = $currentPage5 < $totalPages5 ? $currentPage5 + 1 : $totalPages5;

            $select_deff5='x';
            $expdc_deff5='x';
            $expdc_ateff5='x';

            if(isset($_POST['data']['TableFiltro5']['select_deff5'])){
                $select_deff5 = $_POST['data']['TableFiltro5']['select_deff5'];
            }
            if(isset($_POST['data']['TableFiltro5']['expdc_deff5'])){
                $expdc_deff5 = $_POST['data']['TableFiltro5']['expdc_deff5'];
            }
            if(isset($_POST['data']['TableFiltro5']['expdc_ateff5'])){
                $expdc_ateff5 = $_POST['data']['TableFiltro5']['expdc_ateff5'];
            }

            ?>
            
            <tr class="classOcultar">
                <td id="paginAviso5" colspan="7" style="vertical-align: middle;">
                    <ul id="btn_navegacao5" class="pagination" style="margin: 0px;">
                        <li id="btnprev5">
                            <?= '<a href="?md=9&select_deff5='.$select_deff5.'&expdc_deff5='.$expdc_deff5.'&expdc_ateff5='.$expdc_ateff5.'&page5=' . $prevPage5 . '">«</a>' ?>
                        </li>
                        <li id="btnnumbers">
                            <?php
                            $range = 3; // Adjust the range as needed
            
                            // Display the first page
                            if ($currentPage5 > $range + 1) {
                                echo '<a href="?md=9&select_deff5='.$select_deff5.'&expdc_deff5='.$expdc_deff5.'&expdc_ateff5='.$expdc_ateff5.'&page5=1">1</a>';
                                if ($currentPage5 > $range + 5) {
                                    echo '<span>...</span>';
                                }
                            }
            
                            // Display the pages within the range
                            for ($x = max(1, $currentPage5 - $range); $x <= min($totalPages5 , $currentPage5 + $range); $x++) {
                                if ($x == $currentPage5) {
                                    echo '<span>' . $x . '</span>';
                                } else {
                                    echo '<a href="?md=9&select_deff5='.$select_deff5.'&expdc_deff5='.$expdc_deff5.'&expdc_ateff5='.$expdc_ateff5.'&page5=' . $x . '">' . $x . '</a>';
                                }
                            }
            
                            // Display the last page
                            if ($currentPage5 < $totalPages5 - $range) {
                                if ($currentPage5 < $totalPages5 - $range - 1) {
                                    echo '<span>...</span>';
                                }
                                echo '<a href="?md=9&select_deff5='.$select_deff5.'&expdc_deff5='.$expdc_deff5.'&expdc_ateff5='.$expdc_ateff5.'&page5=' . $totalPages5 . '">' . $totalPages5 . '</a>';
                            }
                            ?>
                        </li>
                        <li id="btnnext">
                            <?= '<a href="?md=9&select_deff5='.$select_deff5.'&expdc_deff5='.$expdc_deff5.'&expdc_ateff5='.$expdc_ateff5.'&page5=' . $nextPage5 . '">»</a>' ?>
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



<!-- Modal container -->
<div id="myModal" class="modal5">

  <div class="modal-header">
    <h4 class="modal-title">Cadastrar Novo Processo</h4>
    
    <button class="btn btn-default" type="button" onclick="closeModal()">X</button>
  </div>

  <div class="modal-body">
    <form id="myFormModal" onsubmit="submitForm5(event)">
        <div class="row">

            <div class="col-md-12" id="nomeAssistidoModalDiv">
            <?php
            echo $this->Form->input('hidden_assistido_id', array('type' => 'hidden', 'value' => '', 'id'=> 'hidden_assistido_id'));
            ?>    
            <div class="form-group">
                    <label>Nome do Assistido: 

                        <input type="radio" name="tipo_nome" value="civil" checked="checked" onclick="opcaoNomeDoAssistido('Civil')"> Nome Civil
                        <input type="radio" name="tipo_nome" value="social" onclick="opcaoNomeDoAssistido('Social')"> Nome Social

                    </label>

                    
                    <div id="boxNomeCivil">
                        <?= $this->Form->text('Filtro.nomeModal', array('id' => 'FiltroNomeModal', 'class' => 'form-control input-sm')); ?>
                        <?php echo $this->Jmycake->autocompleteNum('FiltroNomeModal', 'Pessoa/nome', 'assistidos', 'myFormModal','hidden_assistido_id');?>
                    </div>

                    <div id="boxNomeSocial" style="display:none">

                        <?php  echo  $this->Form->text('Filtro.nomeSocialModal', array('id' => 'FiltroNomeSocialModal', 'class' => 'form-control input-sm')); 
                            echo $this->Jmycake->autocompleteNum('FiltroNomeSocialModal', 'Pessoa/nome_social', 'assistidos', 'myFormModal','hidden_assistido_id');
                        ?>

                    </div>
                    <script>
                        function opcaoNomeDoAssistido(tipo){
                            $('#boxNomeCivil input, #boxNomeSocial input').val(''); 
                            $('#boxNomeCivil, #boxNomeSocial').hide(); 
                            $('#boxNome'+tipo).show();
                            $('#boxNome'+tipo + ' input').focus();
                        }
                    </script>

                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <span style="color: red;">*</span>
                    <label>Numeração Única</label>

                    <div id="boxnumeracaoCivil">
                        <?= $this->Form->text('Filtro.numeracaoModal', array('id' => 'FiltroNumeracaoModal', 'class' => 'form-control input-sm num_unica')); ?>
                      
                    </div>

                </div>
            </div>

            <div class="col-md-12">  
                <div class="form-group">
                    <span style="color: red;">*</span>
                    <label>Comarca do Processo:</label>
                    <?php
                    $args = array(
                        'class' => 'validate[required] form-control input-sm comarca',
                        'empty' => 'Selecione'
                    );
                    echo $this->Form->select('Processo.comarca_id', $comarcas, $args);

                    $this->Js->get('#ProcessoComarcaId')->event('change', $this->Js->request(
                                    array(
                                'controller' => 'unidade_defensoriais',
                                'action' => "buscaUnidadeDefensorialComarca?trs=1"), array(
                                'async' => true,
                                'dataExpression' => true,
                                'data' => $this->Js->serializeForm(
                                        array(
                                            'isForm' => true,
                                            'inline' => true
                                        )
                                ),
                                'update' => '#ProcessoUnidadeDefensorialId',
                                'method ' => 'POST'
                                    )
                    ));
                    echo $this->Js->writeBuffer();
                    ?>
                </div>
            </div>

            <div class="col-md-12">  
                <div class="form-group">
                    <label>Unidade DP: 
                        
                    </label>
                    <?php

                    $unidadesDefensoriais = isset($unidadesDefensoriais) ? $unidadesDefensoriais : array();
                    echo $this->Form->select("Processo.unidade_defensorial_id", $unidadesDefensoriais, array('class' => 'form-control input-sm'));

                    $this->Js->get('#ProcessoUnidadeDefensorialId')->event('change', $this->Js->request(
                                    array(
                                'controller' => 'atuacoes_unidade_defensoriais',
                                'action' => "buscaAtuacaoUnidade/?trs=1"), array(
                                'async' => true,
                                'dataExpression' => true,
                                'data' => $this->Js->serializeForm(
                                        array(
                                            'isForm' => true,
                                            'inline' => true
                                        )
                                ),
                                'update' => '#ProcessoAtuacaoId',
                                'method ' => 'POST'
                                    )
                    ));
                    echo $this->Js->writeBuffer();
                    ?>                        
                </div>
            </div>

            <div class="col-md-12">  
                <div class="form-group">
                    <label title="Unidade Judiciária de Atuação">UJA:</label>
                    <?php
                    $atuacoes = isset($atuacoes) ? $atuacoes : array();
                    $args = array(
                        'empty' => 'Selecione',
                        'class' => 'form-control input-sm',
                    );
                    echo $this->Form->select('Processo.atuacao_id', $atuacoes, $args);
                    ?>
                    <i class="pje-uja" style="font-size:12px"></i>
                </div>
            </div>

        </div>

    </form>

  </div>

  <div class="modal-footer">
    <button class="btn btn-primary"  type="submit" form="myFormModal">Salvar Processo</button>
    <button class="btn btn-default" type="button" onclick="clearInputs()">Limpar Campos</button>
  </div>

</div>

<!-- Overlay -->
<div id="overlay5" class="overlay5" onclick="closeModal()"></div>

<style type="text/css">
    /**/
    .modal-lor5 {
        background-color: rgba(0, 0, 0, 0.5);
    }

    /**/
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
    .my-button {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      height: 74px;
    }
    /**/
    /* Modal styles */
    .modal5 {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 700px;
      height: 660px;
      background-color: #fff;
      padding: 20px;
      border: 1px solid #ccc;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      z-index: 99;
    }

    .modal-header {
      background-color: #fff;
      padding: 15px;

      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-body {
      background-color: #eee;
      padding: 20px;
      border: 1px solid #ccc;
    }

    .modal-footer {
      background-color: #fff;
      padding: 15px;

      text-align: right;
    }

    /* Button styles */
    .open-modal-btn {
      cursor: pointer;
    }

        /* Input styles */
        .modal-input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    .overlay5 {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 98;
    }
    /**/
</style>
<script>
    var atosIdsfromEdit = [];
    const queryString5 = window.location.search;
    const postDeff5 = "<?= isset($_POST['data']['TableFiltro5']['select_deff5']) ? $_POST['data']['TableFiltro5']['select_deff5'] : 'nopost' ?>"
    
    $("#processo_pje").hide();
    $("#processo_pje").val(0);
    function openModal() {
    document.getElementById('myModal').style.display = 'block';
    document.getElementById('overlay5').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('myModal').style.display = 'none';
    document.getElementById('overlay5').style.display = 'none';
  }
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

        const grupo_id = "<?= isset($especializadaFuncId) ? $especializadaFuncId : null ?>"

        if(grupo_id){
            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'especializada_ato_praticados', 'action' => "get_rc_processuais/E?trs=1"), true) ?>",
                type: "POST",
                data: {grupo_id: grupo_id},
                dataType: 'json',
                success: function(data) {

                    $('#Lista_processoAtopraticado').empty();
                    $( "li" ).remove( ".select2-selection__choice" );
                    $.each(data, function(key, value) {

                        $('#Lista_processoAtopraticado').append('<option value="'+value[0].id+'">'+value[1].nome+'</option>');
                    });
                
                }
            });
        }

        $('#Lista_processoAtopraticado').on('change', function () {
            $("#Lista_processo5Observacao").attr("readonly", false); 
        });


    })
    switch (true) {
        case queryString5.includes('inst=5'):
            showTabContent2('abaJudiciais');
            break;
        case queryString5.includes('page5'):
            showTabContent2('abaJudiciais');
            break;
        default:
            // Handle the default case if none of the conditions match
            break;
    }

    if(postDeff5 != "nopost"){
        showTabContent2('abaJudiciais');
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

    $('#especializadaOtherId5').on('change', function () {
        let grupo_id = $(this).val();
        carregandoAtos = true;
    
        $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'especializada_ato_praticados', 'action' => "get_rc_processuais/E?trs=1"), true) ?>",
            type: "POST",
            data: {grupo_id: grupo_id},
            dataType: 'json',
            success: function(data) {
                if(atosIdsfromEdit.length != 0){
                    $('#Lista_processoAtopraticado').empty();

                    $( "li" ).remove( ".select2-selection__choice" );
                }
                $.each(data, function(key, value) {

                    $('#Lista_processoAtopraticado').append('<option value="'+value[0].id+'">'+value[1].nome+'</option>');
                });
                
                if(atosIdsfromEdit.length != 0){
                    console.log(atosIdsfromEdit)
                    $('#Lista_processoAtopraticado').trigger('change');
                }
                

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

   


    $("#anexarExtrajudDoc5").click(function() {
        event.preventDefault();

        var inputValue = $('#FiltroNome').val();

        if (inputValue.trim() !== '') {
            $.ajax({
                type: 'POST',
                url: '<?= $urlNumeracaoUnica ?>',
                data: { inputValue: inputValue },
                beforeSend: function(xhr) {
                    xhr.overrideMimeType("application/x-www-form-urlencoded")
                },
                success: function (response) {
                    var d = JSON.stringify(eval("(" + response + ")"));
                    var dados = JSON.parse(d);

                    if(dados.success == true){

                        $("#hidden_processo_id").val(dados.id);
                        console.log(dados.id)
                        sendformJud()
                       // alert('Formulário enviado com sucesso!')
                    }else {

                        alert('A numeração única digitada não corresponde a um processo cadastrado. Caso deseje cadastrar um novo processo basta clicar no botão [Novo Processo].')
                    }
                                                        
                }
            });
        }else{
            alert('Campo Numeração Única obrigatório');
        }

    });

    function Edicao5(id, requestURI) {
        // Make an AJAX call to the CakePHP 2 backend
        
        $.ajax({
            url: `/RelatorioCorregedoria/relatorio_judiciais2_edit/${id}`, // Your CakePHP 2 controller action URL to handle the AJAX request
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.overrideMimeType("application/x-www-form-urlencoded")
            },
            success: function(response) {

                let de = JSON.stringify(eval("(" + response + ")"));
                let resp = JSON.parse(de);
                console.log(resp)

                $("#anexarExtrajudDoc5").text("Editar");

                    
                $.ajax({
                    url: "<?php echo $this->Html->url(array('controller' => 'especializada_ato_praticados', 'action' => "get_rc_processuais/E?trs=1"), true) ?>",
                    type: "POST",
                    data: {grupo_id: resp.AtoPraticadoProcesso.especializada_id},
                    dataType: 'json',
                    success: function(data) {

                        $('#Lista_processoAtopraticado').empty();
                        $( "li" ).remove( ".select2-selection__choice" );
                        $.each(data, function(key, value) {

                            $('#Lista_processoAtopraticado').append('<option value="'+value[0].id+'">'+value[1].nome+'</option>');
                        });

                        atosIdsfromEdit = resp.AtoPraticadoAtoPraticadoProcesso.map(function (myObj) {
                            return myObj.ato_praticado_id;
                        });
                        console.log(atosIdsfromEdit);

                        $('#Lista_processoAtopraticado').val(atosIdsfromEdit);
                        $('#Lista_processoAtopraticado').trigger('change');

                        let dateParts = resp.AtoPraticadoProcesso.data.split('-');
                        let year = dateParts[0];
                        let month = dateParts[1];
                        let day = dateParts[2];

                        // Manually add leading zeros to day and month if necessary
                        if (month.length < 2) {
                        month = '0' + month;
                        }

                        if (day.length < 2) {
                        day = '0' + day;
                        }

                        let mydate = day + '/' + month + '/' + year

                        $('#Lista_processo5DataInicio5').val(mydate);
                        
                        $('#FiltroNome').val(resp.processos.numeracao_unica);

                        
                        $('#hidden_ato_praticado_processo_id').val(resp.AtoPraticadoProcesso.id);
                        $('#especializadaOtherId5').val(resp.AtoPraticadoProcesso.especializada_id);
                        //$('#especializadaOtherId5').trigger('change');

                        $(`input[name="data[Lista_processo5][substituicao_extrj]"][value="${resp.AtoPraticadoProcesso.substituicao}"]`).prop("checked", true);


                        $('#Lista_processo5Observacao').val(resp.AtoPraticadoProcesso.observacao);
                    
                    }
                });
                    

                
            },
            error: function(xhr, textStatus, errorThrown) {
            // Handle error if the AJAX request fails
            console.log('Error:', errorThrown);
            }
        });
    }

    function sendformJud() {
        event.preventDefault();

        let Lista_processo5DataInicio5 = $("#Lista_processo5DataInicio5").val();
        //let Lista_processo5 = $("#hidden_processo_id" ).val();

            
        let Lista_processoAtopraticado = $("#Lista_processoAtopraticado").val();

        let Lista_processo5Substituicao_extrj = $("#Lista_processo5Substituicao_extrj").val();
        let Lista_processo5observacao = $("#Lista_processo5observacao").val();

        //let AtendimentoUnidadeId5 = $("#AtendimentoUnidadeId5" ).val();
        let especializadaOtherId5 = $("#especializadaOtherId5").val();
        


            if(
            $.trim(Lista_processoAtopraticado) === "" || $.trim(especializadaOtherId5) === "" 
            ){
                alert('Existe campos obrigatórios em branco!')
                return;
            }
            
            var form2 = document.getElementById('formjud');

            var formData2 = new FormData(form2);
            
                $.ajax({
                        type: 'POST',
                        url: '<?= $urlPesquisaJud ?>',
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
                            //    return;
                            // Get the current URL
                            var currentURL = window.location.href;
                        
                            if (currentURL.indexOf('inst=5') === -1) {
                                // Add '&inst=2' to the URL if it doesn't already exist
                                var currentURL = window.location.href;
                                var newURL = currentURL.split('?')[0] + '?inst=5';
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
            

    }


    function showTabContent2(tabId) {
        $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
    }

    $('#Lista_processo5DataInicio5').val($.datepicker.formatDate( "dd/mm/yy", new Date()))
    

    function submitForm5(event) {
        event.preventDefault();

        let numeracao_unica =  $('#FiltroNumeracaoModal').val()
        if($.trim(numeracao_unica) === ""){
            alert('O campo númeração única não pode ser vazio');
            return;
        }

        var formData = {
        assistido_id: $('#hidden_assistido_id').val(),
        numeracao_unica: $('#FiltroNumeracaoModal').val(),
        comarca_id: $('#ProcessoComarcaId').val(),
        unidade_defensorial_id: $('#ProcessoUnidadeDefensorialId').val(),
        atuacao_id: $('#ProcessoAtuacaoId').val(),
        };

        $.ajax({
        type: 'POST',
        url: `/Processos/add_ajax`, 
        data: formData,
        beforeSend: function(xhr) {
                    xhr.overrideMimeType("application/x-www-form-urlencoded")
        },
        success: function(response) {

            let de = JSON.stringify(eval("(" + response + ")"));
            let resp = JSON.parse(de);
            console.log(resp)

            if(resp.success == true){
                alert('Formulário enviado com sucesso!')
                closeModal();
                $('#FiltroNome').val(numeracao_unica)
            }else {
                alert(resp.message);
            }
            
        },
        error: function(error) {
            console.error('Error:', error);
            // Optionally, handle error response
        }
        });
    }

  function clearInputs() {
    $('#myFormModal')[0].reset();
  }


function delPendencia5(event,id) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "<?php echo $this->Html->url(array('controller' => 'RelatorioCorregedoria', 'action' => 'ato_praticado_delete'), true) ?>",
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
        if (currentURL.indexOf('inst=5') === -1) {
            // Add '&inst=2' to the URL if it doesn't already exist
            var currentURL = window.location.href;
            var newURL = currentURL.split('?')[0] + '?inst=5';
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
     /*
    $('#agree_terms').on('change', function() {
        var checked = $(this).prop('checked');
        if (checked) {
            // Checkbox is checked, hide the div
            $('#nomeAssistidoModalDiv').hide();
            $('#agree_id').val(1);
        } else {
            // Checkbox is unchecked, show the div based on the selected radio button
            $('#nomeAssistidoModalDiv').show();
            $('#agree_id').val(0);
        }
    });
    */
</script>
