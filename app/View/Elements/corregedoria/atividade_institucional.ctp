<style>
        .custom-input {
            padding: 0px 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 100%;
            height: 28px;
            /* Add more styles as needed */
        }
        .input-container {
            display: flex;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .input-container select {
            flex: 1;
            padding: 5px 5px;
            border: none;
            outline: none;
            background-color: #fff ;
        }

        .input-container select:first-child {
            border-right: 2px solid #ccc;
        }
</style>
<?php
$urlPesquisa = $this->Html->url([
    'controller' => 'RelatorioCorregedoria',
    'action' => 'relatorio_atividades2',
    '?' => ['trs' => 1]
], true);


?>

<?= $this->Form->create('RelatorioCorregedoria', [
'id' => 'formAnexo',
'enctype' => 'multipart/form-data'
]) ?>
                
    <h4>Cadastrar Atividades Institucionais</h4>
    <div class="row">
 
        <input type="hidden" id="btnHidden" name="data[RelatorioCorregedoria][idform]" value="0">
        <!--
        <div class="form-group col-md-2">
            <label><span style="color: red;">* </span>Tipo de Atividade</label>
            <div style="height: 34px; padding: 4px 12px; border: 1px solid #ccc; border-radius: 4px;">
                <label class="radio-inline"><input id="termExt" type="radio" name="data[RelatorioCorregedoria][termNum]" value="1">Interna</label>
                <label class="radio-inline"><input id="termInt" type="radio" name="data[RelatorioCorregedoria][termNum]" value="2">Externa</label>
            </div>
        </div>
        -->
        <!--
        <div class="col-md-3">
            <div class="form-group">

             /* $this->Form->input('descricao_atividade', [
            'type' => 'select',
            
            'label' => '<span style="color: red;">*</span> Atividade',
            'id' => 'descricaoAtvId',
            'class' => 'Trecho  form-control input-sm ',
            'empty' => 'Selecione',
            'required' => true
            ]) */  

            </div>
        </div>
        -->
        

        
        <div class="col-md-3">
            <div class="form-group">
                <span style="color: red;">*</span>
                <label for="RelatorioCorregedoriaData">Mês/Ano</label>
                <div class="input-container">
                    <select id="monthSelect" name="data[RelatorioCorregedoria][month]" >
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
                    <select id="yearSelect" name="data[RelatorioCorregedoria][year]">
                        <option value="" disabled selected>Ano</option>

                        <!-- Add more years as needed -->
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">

                <label><span style="color: red;">*</span> Atividade:</label>

                <?= $this->Form->select('descricao_atividade',

                    $descricaoAtividade, [
                        'default' => isset($especializadaFuncId) ? $especializadaFuncId : null,
                        'class' => 'Trecho form-control input-sm ',
                        'id' => 'descricaoAtvId',
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
                'required' => true
            ]) ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <?= $this->Form->input('nome_atividade', [
                'type' => 'text',
                'label' => 'Nome Atividade',
                'placeholder' => 'digite o nome da atividade',
                'class' => 'form-control',
                'required' => false
            ]) ?>

            </div>
        </div>



    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">

                <label>Atuação:</label>
                <?= $this->Form->select('especializada_id2',

                    $especializadas, [
                        'default' => isset($especializadaFuncId) ? $especializadaFuncId : null,
                        'class' => 'Trecho form-control input-sm ',
                        'id' => 'especializadaOtherId',
                        'empty' => 'Selecione'
                    ]) ?>

            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">

            <?= $this->Form->input('publico_atingido', [
                'type' => 'number',
                'label' => 'Público Total Atingido',
                'placeholder' => 'digite o Público Total Atingido',
                'class' => 'form-control',
                'required' => false
            ]) ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">

            <?= $this->Form->input('grupo_vulneravel', [
            'type' => 'select',
            'options' => $tipo_grupo,
            'label' => 'Grupo Vulnerável',
            'class' => 'Trecho form-control input-sm ',
            'empty' => 'Selecione'
            ]) ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">

                <?= $this->Form->input('violacao_direito', [
                'type' => 'select',
                'options' => $violacaoDireito,
                'label' => 'Tipo de violação de direito',
                'class' => 'Trecho form-control input-sm ',
                'empty' => 'Selecione'
                ]) ?>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="form-group-lor">
                <label>Em substituição:</label>
                <div>
                <?php
                                        
                $opcoes = array(0=>'Não',1=>'Sim');
                $atributos = array(
                    'legend'=>false,
                    'separator'=>'&nbsp&nbsp',
                );
                echo $this->Form->radio('substituicao_inst',$opcoes,$atributos);
        
                ?>
                </div>
                
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="file_upload">Selecione arquivo:</label>
                <input type="file" name="data[Anexo][arquivo]" id="file_upload" accept=".pdf" class="btn btn-default" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php
                    echo $this->Form->label('message', 'Comentários/Observações:');
                    echo $this->Form->textarea('message', array(
                        'class' => 'form-control input-sm',
                        'rows' => '5'
                    ));
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: right;">

            <div class="form-group">
                <button id="limparDocumento"   class="btn btn-default">Limpar</button>
                <button id="anexarDocumento" type="submit"  class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </div>              
<?php echo $this->Form->end();  
 //   debug($_POST['data']['TableFiltro']);
?>

    <div id="conteudoTabelaAviso">
        <h4>Filtrar por Atividade Institucionais</h4>
        <form method="post" id="formDeff" action="relatorio_atividades">
            <div class="d-flex">
        
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">Atividade</span>
                        <select id="dataselect_deff" class="Trecho form-control" name="data[TableFiltro][select_deff]"
                        >
                            <option value="option1">Selecione</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">Data Inicial</span>
                        <input id="dataExpdc_deff" type="date" class="form-control" name="data[TableFiltro][expdc_deff]"
                        value="<?= isset($_POST['data']['TableFiltro']['expdc_deff']) ? $_POST['data']['TableFiltro']['expdc_deff'] : '' ?>">
                        <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Data Final</span>
                        <input id="dataExpdc_ateff"  type="date" class="form-control" name="data[TableFiltro][expdc_ateff]"
                        value="<?= isset($_POST['data']['TableFiltro']['expdc_ateff']) ? $_POST['data']['TableFiltro']['expdc_ateff'] : '' ?>">
                    </div>
                </div>
                <div>
                    <div class="form-group col-md-2 text-center">
                        <div class="input-group">
                            <div class="center-button">
                                
                                <button type="submit">
                                    <div style="cursor: pointer;" title="Pesquisar" class="glyphicon glyphicon-search"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-2  text-center" style="margin-left: 10px;">
                        <div class="input-group">
                            <div class="center-button">
                                <button type="button" id="cleanButton">
                                <div style="cursor: pointer;" title="Limpar formulário" class="glyphicon glyphicon-remove-sign"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            
            </div>
        </form>

        <table id="tblExpedientePje" class="table table-bordered table-striped" style="margin-bottom: 0px;">
            <thead style="background-color: #4BB246; color: white;">
                <tr>
                    <th style="vertical-align: middle;width: 80px">Data <div style="cursor: pointer;" title="Data em que a informação foi lançada." class="glyphicon glyphicon-question-sign"></div></th>
                    <th style="vertical-align: middle;width: 100px">mês/ano <div style="cursor: pointer;" title="mês/ano de registro da atividade." class="glyphicon glyphicon-question-sign"></div></th>
                    <th style="vertical-align: middle;">Atividade</th>
                    <th style="vertical-align: middle; text-align: center;">Público Total Atingido</th>
                    <th style="vertical-align: middle; text-align: center;">Quant. de Atividades</th>
                    <th style="vertical-align: middle; text-align: center;">Grupo Vúlneravel</th>
                    <th style="vertical-align: middle; text-align: center;">Anexo</th>
                    <th style="vertical-align: middle; text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody id="corpoAvisoPend">
                <?php
                   
                    foreach ($atividadeInstitucional  as $key => $aviso) :

                    ?>
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style='font-size: 12px; margin: 0px;'>
                                    <?=$this->Util->ddmmaa($aviso['AtividadeInstitucional']['data_cadastro'])?>
                                </p>
                            </td>
                            <td style="vertical-align: middle;">
                                <p style='font-size: 12px; margin: 0px;'>
                                <?= date('m/Y', strtotime($aviso['AtividadeInstitucional']['data'])) ?>
                                </p>
                            </td>
                            <td style="vertical-align: middle;">
                                <p style='font-size: 12px; margin: 0px;'>
                                    <?=$aviso['da']['nome']?>
                                </p>
                            </td>
                            <td style="vertical-align: middle;">
                                <?=$aviso['AtividadeInstitucional']['publico_total']?>
                            </td>
                            <td style="vertical-align: middle;">
                                <?=$aviso['AtividadeInstitucional']['qtd_atividades']?>
                            </td>
                            <td style="vertical-align: middle;">
                                <?=$aviso['tg']['nome']?>
                            </td>

                            <td style="vertical-align: middle;">
                            <?php if (null != ($aviso['AtividadeInstitucional']['dir'])) : ?>
                                <a href="<?php echo $this->Html->url(array('controller' => 'RelatorioCorregedoria', 'action' => 'download', $aviso['AtividadeInstitucional']['id'])); ?>">
                                    <div style="cursor: pointer;" class="glyphicon glyphicon-download-alt" title="Download Anexo" ></div>
                                </a>
                                <span><div style="cursor: pointer;" class="glyphicon glyphicon-remove" title="Apagar Anexo" onclick="ApagarAnexo('<?=$aviso['AtividadeInstitucional']['id']?>')"></div></span>
                            <?php endif; ?>
                            <?php if (null == ($aviso['AtividadeInstitucional']['dir'])) : ?>
                                -
                            <?php endif; ?>
                            </td>

                            <td class = "classOcultar" style="vertical-align: middle; text-align: center;">
                                <div style="cursor: pointer;" class="glyphicon glyphicon-edit" title="editar" onclick="Edicao('<?=$aviso['AtividadeInstitucional']['id']?>','<?=$_SERVER['REQUEST_URI']?>','<?=$aviso['AtividadeInstitucional']['dir']?>')"></div>
                                <div style="cursor: pointer;" class="glyphicon glyphicon-trash" title="Apagar" onclick="Apagar('<?=$aviso['AtividadeInstitucional']['id']?>','<?=$_SERVER['REQUEST_URI']?>')"></div>
                            
                            </td>

                            
                        </tr><?php
                    endforeach;
                ?>
                        <?php
                            // In your view (index.ctp)
                            $prevPage1 = $currentPage1 > 1 ? $currentPage1 - 1 : 1;
                            $nextPage1 = $currentPage1 < $totalPages1 ? $currentPage1 + 1 : $totalPages1;

                            $select_deff='x';
                            $expdc_deff='x';
                            $expdc_ateff='x';

                            if(isset($_POST['data']['TableFiltro']['select_deff'])){
                                $select_deff = $_POST['data']['TableFiltro']['select_deff'];
                            }
                            if(isset($_POST['data']['TableFiltro']['expdc_deff'])){
                                $expdc_deff = $_POST['data']['TableFiltro']['expdc_deff'];
                            }
                            if(isset($_POST['data']['TableFiltro']['expdc_ateff'])){
                                $expdc_ateff = $_POST['data']['TableFiltro']['expdc_ateff'];
                            }
                        ?>
 
                        <tr class = "classOcultar">
                            <td id="paginAviso" colspan="7" style="vertical-align: middle;">
                                <ul id="btn_navegacao" class="pagination" style="margin: 0px;">
                                    <li id="btnprev" >
                                    <?= '<a href="?md=9&select_deff='.$select_deff.'&expdc_deff='.$expdc_deff.'&expdc_ateff='.$expdc_ateff.'&page1=' . $prevPage1 . '">«</a>'?>
       
                                    </li>
                                    <li id="btnnumbers" >
                                    <?php

                                        for ($i = 1; $i <= $totalPages1; $i++) {
                                            if ($i == $currentPage1) {
                                                echo '<span>' . $i . '</span>';
                                            } else {


                                                echo '<a href="?md=9&select_deff='.$select_deff.'&expdc_deff='.$expdc_deff.'&expdc_ateff='.$expdc_ateff.'&page1=' . $i . '">' . $i . '</a>';
                                            }
                                        }
                                    ?>
                                    </li>
                                    <li id="btnnext">
                                        <?='<a href="?md=9&select_deff='.$select_deff.'&expdc_deff='.$expdc_deff.'&expdc_ateff='.$expdc_ateff.'&page1=' . $nextPage1 . '">»</a>'?>
                                    </li>
                                </ul>
                            </td>
                            
                        </tr>




            </tbody>
        </table>
    </div>
<script type="text/javascript">

const queryString = window.location.search;
const postDeff = "<?= isset($_POST['data']['TableFiltro']['select_deff']) ? $_POST['data']['TableFiltro']['select_deff'] : 'nopost' ?>"
$(document).ready(function() {

        var currentYear = new Date().getFullYear();
        var pastYear = 2002;

        for (var year = currentYear; year >= pastYear; year--) {
            $('#yearSelect').append('<option value="' + year + '">' + year + '</option>');
        }
        $('#yearSelect').val(currentYear);

        var currentMonth = new Date().getMonth() + 1; // Adding 1 because months are zero-indexed
        $('#monthSelect').val(currentMonth.toString().padStart(2, '0'));
        
    $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'descricao_atividade', 'action' => "get_desc_atividade2/E?trs=1"), true) ?>",
            type: "POST",
            data: {tipoAtv_id: "2"},
            dataType: 'json',
            success: function(data) {

                $('#dataselect_deff').empty();
                $( "li" ).remove( ".select2-selection__choice" );
                $('#dataselect_deff').append('<option value="">Selecione opções carregadas</option>');
                $.each(data, function(key, value) {
                    
                    $('#dataselect_deff').append('<option value="'+value[0].id+'">'+value[1].nome+'</option>');
                });

                let selectCarregado = "<?= isset($_POST['data']['TableFiltro']['select_deff']) ? $_POST['data']['TableFiltro']['select_deff'] : '' ?>"

                if(selectCarregado !=''){
                    $('#dataselect_deff').val(selectCarregado)
                    $('#dataselect_deff').trigger('change');
                }
                
            
            }
        });

    function algo(){
            $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'descricao_atividade', 'action' => "get_desc_atividade/E?trs=1"), true) ?>",
            type: "POST",
            data: {tipoAtv_id: "1"},
            dataType: 'json',
            success: function(data) {

            $('#dataselect_deff').empty();
                $( "li" ).remove( ".select2-selection__choice" );
                $('#dataselect_deff').append('<option value="">Selecione opções carregadas</option>');
                $.each(data, function(key, value) {
                
                    $('#dataselect_deff').append('<option value="'+value.descricao_atividade.id+'">'+value.descricao_atividade.nome+'</option>');
                });

                $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'descricao_atividade', 'action' => "get_desc_atividade/E?trs=1"), true) ?>",
                type: "POST",
                data: {tipoAtv_id: "2"},
                dataType: 'json',
                success: function(data) {

                    $('#dataselect_deff').empty();
                    $( "li" ).remove( ".select2-selection__choice" );
                    $('#dataselect_deff').append('<option value="">Selecione opções carregadas</option>');
                    $.each(data, function(key, value) {
                    
                        $('#dataselect_deff').append('<option value="'+value.descricao_atividade.id+'">'+value.descricao_atividade.nome+'</option>');
                    });

                    let selectCarregado = "<?= isset($_POST['data']['TableFiltro']['select_deff']) ? $_POST['data']['TableFiltro']['select_deff'] : '' ?>"

                    if(selectCarregado !=''){
                        $('#dataselect_deff').val(selectCarregado)
                        $('#dataselect_deff').trigger('change');
                    }
                    
                
                }
                });
            }
        });
    }

})

switch (true) {
    case queryString.includes('inst=2'):
        showTabContent('abaPartes');
        break;
    case queryString.includes('page1'):
        showTabContent('abaPartes');
        break;
    default:
        // Handle the default case if none of the conditions match
        break;
}

if(postDeff != "nopost"){
    showTabContent('abaPartes');
}

$("#limparDocumento").click(function(event) {
    event.preventDefault();
    
    $("#btnHidden" ).val("0");

    /*
    $("#termExt").prop("checked", false);
    $("#termInt").prop("checked", false);
    */

    $("#descricaoAtvId" ).val("");
    $("#RelatorioCorregedoriaData" ).val("");
    $("#RelatorioCorregedoriaNomeAtividade" ).val("");
    $("#especializadaOtherId" ).val("");
    $("#RelatorioCorregedoriaPublicoAtingido" ).val("");
    $("#RelatorioCorregedoriaQtdAtividade" ).val("");
    $("#RelatorioCorregedoriaGrupoVulneravel" ).val("");
    $("#RelatorioCorregedoriaMessage" ).val("");
    
    $("#formAnexo input[type='number']").val("");
    $("#formAnexo textarea").val("");

    $("#anexarDocumento").text("Cadastrar");
    $(`input[name="data[RelatorioCorregedoria][substituicao_inst]"]`).prop('checked', false);

    $('#descricaoAtvId').trigger('change');
    $('#especializadaOtherId').trigger('change');
    $('#RelatorioCorregedoriaGrupoVulneravel').trigger('change');
    $('#RelatorioCorregedoriaViolacaoDireito').trigger('change');

});

$("#cleanButton").click(function() {
       
        window.location.href = window.location.href.split('?')[0]; // Clear POST data
});


function showTabContent(tabId) {
    $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
}

$('#anexarDocumento').click(function(event) {
    event.preventDefault();

  let descricaoAtvId = $("#descricaoAtvId" ).val();
  let RelatorioCorregedoriaData = $("#monthSelect" ).val();
  let RelatorioCorregedoriaQtdAtividade = $("#RelatorioCorregedoriaQtdAtividade" ).val();
  let idEdit = $("#btnHidden" ).val();
  

    if(idEdit == 0){
        if($.trim(descricaoAtvId) === "" || $.trim(RelatorioCorregedoriaData) === "" || $.trim(RelatorioCorregedoriaQtdAtividade) === ""){
            alert('Existe campos obrigatórios em branco!')
            return;
        }
    }


    
    var form = document.getElementById('relatorio');

    var formData = new FormData(form);
    
        $.ajax({
                type: 'POST',
                url: '<?= $urlPesquisa ?>',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    

                    if(response.success == true){
                        alert('Formulário enviado com sucesso!')
                    }else {
                        alert('Houve um erro no envio do formulário')
                    }
                    //return;
                    // Get the current URL
                    var currentURL = window.location.href;
                    
                    if (currentURL.indexOf('inst=2') == -1) {
                        // Add '&inst=2' to the URL if it doesn't already exist

                        var currentURL = window.location.href;
                        var newURL = currentURL.split('?')[0] + '?inst=2';
                        window.location.href = newURL;
                        return;
                    }
                    //window.location.href = currentURL;
                    location.reload()
                    
                }
        });
    
});

function Edicao(id, requestURI,anexo) {
  // Make an AJAX call to the CakePHP 2 backend
  $("#anexarDocumento").text("Editar");
  $.ajax({
    url: `/RelatorioCorregedoria/relatorio_atividades2_edit/${id}`, // Your CakePHP 2 controller action URL to handle the AJAX request
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.overrideMimeType("application/x-www-form-urlencoded")
    },
    success: function(response) {

        let de = JSON.stringify(eval("(" + response + ")"));
        let resp = JSON.parse(de);
        console.log(resp)

        let tipoAtv_id = resp.tipo_atividade;

        $.ajax({
        url: "<?php echo $this->Html->url(array('controller' => 'descricao_atividade', 'action' => "get_desc_atividade2/E?trs=1"), true) ?>",
        type: "POST",
        data: {tipoAtv_id: tipoAtv_id},
        dataType: 'json',
        success: function(data) {
           
           $('#descricaoAtvId').empty();
            $( "li" ).remove( ".select2-selection__choice" );
            $('#descricaoAtvId').append('<option valuid_especializadaEspecializada:e="">Selecione opções carregadas</option>');
            $.each(data, function(key, value) {
               
                $('#descricaoAtvId').append('<option value="'+value[0].id+'">'+value[1].nome+'</option>');
            });
            //
            $('#btnHidden').val(resp.id);
            $('#descricaoAtvId').val(resp.tipo_atividade_id);

            let dateParts = resp.data.split('-');
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

            // Create the formatted date string in the format 'DD/MM/YYYY'
            //let formattedDate = day + '/' + month + '/' + year;
            //let formattedDate = year + '-' + month;

           // $('#RelatorioCorregedoriaData').val(formattedDate);

           
           $('#monthSelect').val(month);
           $('#yearSelect').val(year);

            $('#RelatorioCorregedoriaNomeAtividade').val(resp.nome_atividade_institucional);
            $('#especializadaOtherId').val(resp.id_especializada);
            $('#RelatorioCorregedoriaPublicoAtingido').val(resp.publico_total);
            $('#RelatorioCorregedoriaQtdAtividade').val(resp.qtd_atividades);
            $('#RelatorioCorregedoriaGrupoVulneravel').val(resp.id_tipo_grupo);
            $('#RelatorioCorregedoriaViolacaoDireito').val(resp.tipo_violacao_id);
            $('#RelatorioCorregedoriaMessage').val(resp.observacao);
            $(`input[name="data[RelatorioCorregedoria][substituicao_inst]"][value="${resp.substituicao}"]`).prop("checked", true);

            if(anexo != ''){
                $('#file_upload').prop('disabled', true);
                
            }else{
                $('#file_upload').prop('disabled', false);
            }
            
            $('#descricaoAtvId').trigger('change');
            $('#especializadaOtherId').trigger('change');
            $('#RelatorioCorregedoriaGrupoVulneravel').trigger('change');
            $('#RelatorioCorregedoriaViolacaoDireito').trigger('change');
        }
        
    });
        /*
       if(tipoAtv_id == 1){
        $('#termExt').prop('checked', true);
       }

       if(tipoAtv_id == 2){
        $('#termInt').prop('checked', true);
       }
        */
    },
    error: function(xhr, textStatus, errorThrown) {
      // Handle error if the AJAX request fails
      console.error('Error:', errorThrown);
    }
  });
}


function Apagar(id, requestURI) {
  // Confirm with the user before proceeding with the delete operation
  if (!confirm('Você tem certeza que deseja excluir esse item ? Qualquer anexo vinculado será apagado.')) {
    return; // User canceled the delete operation
  }

  // Make an AJAX call to the CakePHP 2 backend to delete the item
  $.ajax({
    url: `/RelatorioCorregedoria/apagar_atividades_institucionais/${id}`, // Append the id to the URL for the delete action
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.overrideMimeType("application/x-www-form-urlencoded")
    },
    success: function(response) {
        let de = JSON.stringify(eval("(" + response + ")"));
        let resp = JSON.parse(de);

        if(resp.status == "success"){
            alert('Registro deletado com sucesso!');
       
            // Get the current URL
            var currentURL = window.location.href;
            
            if (currentURL.indexOf('inst=2') === -1) {
                // Add '&inst=2' to the URL if it doesn't already exist
                var currentURL = window.location.href;
                var newURL = currentURL.split('?')[0] + '?inst=2';
                window.location.href = newURL;
                return;

            }
            //window.location.href = currentURL;
            location.reload()
        }else{
            alert('Falha ao deletar o registro. Por favor, contate o suporte');
        }

    },
    error: function(xhr, textStatus, errorThrown) {
      // Handle error if the AJAX request fails
      console.error('Error:', errorThrown);
      alert('Falha ao deletar o registro. Por favor, contate o suporte');
    }
  });
}

function ApagarAnexo(id, requestURI) {
  // Confirm with the user before proceeding with the delete operation
  if (!confirm('Você deseja excluir esse anexo do registro? Essa opção excluirá o anexo permanentemente')) {
    return; // User canceled the delete operation
  }

  // Make an AJAX call to the CakePHP 2 backend to delete the item
  $.ajax({
    url: `/RelatorioCorregedoria/apagar_atividades_anexo/${id}`, // Append the id to the URL for the delete action
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.overrideMimeType("application/x-www-form-urlencoded")
    },
    success: function(response) {
        let de = JSON.stringify(eval("(" + response + ")"));
        let resp = JSON.parse(de);

        if(resp.status == "success"){
            alert('Registro deletado com sucesso!');
        
            window.location.reload();
        }else{
            alert('Falha ao deletar o registro. Por favor, contate o suporte');
        }

    },
    error: function(xhr, textStatus, errorThrown) {
      // Handle error if the AJAX request fails
      console.error('Error:', errorThrown);
      alert('Falha ao deletar o registro. Por favor, contate o suporte');
    }
  });
}

</script>
