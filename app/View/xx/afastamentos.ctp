<?php

$urlBuscaUnidades = $this->Html->url([
    'controller' => 'comarcas',
    'action' => 'buscaComarcaUnidade',
    '?' => ['trs' => 1]
], true);


$urlPesquisa = $this->Html->url([
    'controller' => 'Corregedorias',
    'action' => 'relatorio_atividades',
    '?' => ['trs' => 1]
], true);


$configSelect = [
    'class' => 'Trecho form-control input-sm ',
    'multiple' => 'multiple'
];
$configSelect2 = [
    'class' => 'Trecho form-control input-sm '
];

$configSelectValidade = [
    'class' => 'Trecho form-control input-sm ',
    'multiple' => 'multiple'
];


$configData = [
    'class' => 'data form-control input-sm validate[required]'
];

?>


<script type="text/javascript">
    $(document).ready(function() {
        $("#CorregedoriasDefensorNome").select2(); // Campo Nome Defensor
        $("#ProcessoComarcaId").select2(); // Campo Comarca
        $("#nome_unidade").select2(); // Campo Unidade
        $("#nome_afastamento").select2(); // Tipo de Afastamento
        $("#ProcessoUnidadeDefensorialId").select2();
    });
    $('h3.page-header').first().remove();
</script>
<h3 class="page-header">Corregedoria - Listagem de Afastamentos</h3>
<div class="well">
    <?php echo $this->Form->create('Corregedorias', array('action' => 'afastamentos')) ?>
    <div>
       
    </div>
    <div class="row">
        <form method="post" id="formDeff" action="">
            <div class="col-md-3">
                <div class="form-group">
                    <?= $this->Form->input('defensor_nome', [
                        'empty' => 'Selecione',
                        'label' => "Nome do Defensor:",
                        'placeholder' => 'digite o nome do defensor',
                        'class' => 'form-control',
                        'required' => false,
                        'type' => 'select',
                        'options' => $funcionarios,
                        'default' => $configSelect
                    ]) ?>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label>Comarca:</label>
                    <?php
                    $args = array(
                        'class' => 'validate[required] form-control input-sm comarca',
                        'empty' => 'Selecione',
                        'required' => false,
                    );
                    echo $this->Form->select('Processo.comarca_id', $comarcas, $args);

                    $this->Js->get('#ProcessoComarcaId')->event('change', $this->Js->request(
                        array(
                            'controller' => 'Corregedorias',
                            'action' => "buscarUnidades?trs=1"
                        ),
                        array(
                            'async' => true,
                            'complete' => 'refreshJquery();',

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

            <div class="col-md-3">
                <label>Unidade:</label>
                <div class="form-group">
                    <?php

                    $unidadesDefensoriais = isset($unidadesDefensoriais) ? $unidadesDefensoriais : array();

                    echo $this->Form->select("Processo.unidade_defensorial_id", $unidadesDefensoriais, array('class' => 'form-control input-sm', 'empty' => 'Selecione'));

                    $this->Js->get('#ProcessoUnidadeDefensorialId')->event('change', $this->Js->request(
                        array(
                            'controller' => 'atuacoes_unidade_defensoriais',
                            'action' => "buscaAtuacaoUnidade/?trs=1"
                        ),
                        array(
                            'complete' => 'refreshJquery();',

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
                    echo $this->Js->writeBuffer(); ?>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <?= $this->Form->input('nome_afastamento', [
                    'type' => 'select',
                    'empty' => 'Selecione',
                    'label' => 'Tipo de Afastamento:',
                    'placeholder' => 'digite o tipo de afastamento',
                    'class' => 'form-control',
                    'required' => false,
                    'options' => $motivoAfastamento,
                    'default' => $configSelect
                ]) ?>
            </div>
        </div>

        <div class="input-group col-md-4" style="top: 23px;">
            <span class="input-group-addon">Data Inicial</span>
            <input id="dataExpdc_deff2" type="date" class="form-control" name="data[TableFiltro2][expdc_deff2]" value="<?= isset($_POST['data']['TableFiltro2']['expdc_deff2']) ? $_POST['data']['TableFiltro2']['expdc_deff2'] : '' ?>">

            <span class="input-group-addon">Data Final</span>
            <input id="dataExpdc_ateff2" type="date" class="form-control" name="data[TableFiltro2][expdc_ateff2]" value="<?= isset($_POST['data']['TableFiltro2']['expdc_ateff2']) ? $_POST['data']['TableFiltro2']['expdc_ateff2'] : '' ?>">
        </div>

        <div class="row">
            <div class="col-md-12" style="text-align: right;  top: 41px; left: 30px;">

                <div class="form-group">
                    <button id="limparDocumento" class="btn btn-default">Limpar</button>
                    <?php echo $this->Form->button('Pesquisar', array('class' => 'btn btn-success', 'escape' => false, 'type' => 'submit')) ?>
                </div>
            </div>
        </div>

    </div>
    <!-- <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <?= $this->Form->input('nome_atividade', [
                    'type' => 'text',
                    'label' => 'Tipo de afastamento',
                    'placeholder' => 'digite o nome do comarca',
                    'class' => 'form-control',
                    'required' => false
                ]) ?>
            </div>
        </div>
        
    </div> -->
    </form>


</div>
<div class="modal fade" id="Student_AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Observação do afastamento </h4>
            </div>
            <div class="modal-body">
                <div class="scroll">
                    <p class="margen_texto" id="detalhesConteudo">Contuedo da observação&hellip;</p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<table id="tblExpedientePje" class="table table-hover table-bordered" style="margin-bottom: 0px;">
    <thead style="background-color: #4BB246; color: white; height: 20px; max-height: 50px; ">
        <tr>
            <th scope="col" style="vertical-align: middle; text-align: center;">
                <?php echo $this->Paginator->sort(
                    'id',
                    $this->Html->tag('i', '', ['class' => 'fa fa-info-circle']) . ' ' . __('DATA CADASTRO'),
                    ['class' => 'estiloData', 'escape' => false]
                ); ?>
            </th>
            <th style="vertical-align: middle; text-align: center;">NOME DO DEFENSOR</th>
            <th style="vertical-align: middle; text-align: center;">COMARCA</th>
            <th style="vertical-align: middle; text-align: center;">UNIDADE</th>
            <th style="vertical-align: middle; text-align: center;">TIPO DE AFASTAMENTO</th>
            <th scope="col" style="vertical-align: middle; text-align: center;">
                <?php echo $this->Paginator->sort(
                    'data_inicial',
                    $this->Html->tag('') . ' ' . __('DATA DO AFASTAMENTO'),
                    ['class' => 'estiloData', 'escape' => false]
                ); ?>
            </th>
            <th scope="col" style="vertical-align: middle; text-align: center;">
                <?php echo $this->Paginator->sort(
                    'data_final',
                    $this->Html->tag('') . ' ' . __('DATA RETIFICADA'),
                    ['class' => 'estiloData', 'escape' => false]
                ); ?>
            </th>
            <th style="vertical-align: middle; text-align: center;">OBS</th>
        </tr>
    </thead>
    <tbody id="corpoAvisoPend">
        <?php
        // Check if $pages is empty before rendering the table
        if (empty($pages)) {
            echo '<tr class="mensagem-nao-encontrado">';
            echo '<td colspan="8"><p>AFASTAMENTO NÃO ENCONTRADO</p></td>';
            echo '</tr>';
        } else {
            // Iterate through $pages if it's not empty
            foreach ($pages as $key => $usuarios) :
                $viewlinkNome = $this->Html->link(
                    $this->Html->tag('i', '', ['class' => 'fa fa-info-circle', 'style' => 'font-size: 16px; margin-right: 10px;']) . ' ' . $usuarios['p']['nome'],
                    ['controller' => 'corregedorias', 'action' => 'view', $usuarios['Afastamento']['id'] . '?trs=1'],
                    ['escape' => false] // Necessário para renderizar HTML dentro do link
                );
                $dataInicio = new DateTime($usuarios['Afastamento']['data_inicio']);
                $dataFormatadaIni = $dataInicio->format('d/m/Y');

                $dataFim = new DateTime($usuarios['Afastamento']['data_fim']);
                $dataFinal = $dataFim->format('d/m/Y');

                $dataCadastro = new DateTime($usuarios['Afastamento']['data_cadastro']);
                $dataCad = $dataCadastro->format('d/m/Y');

                $statusAfastamento = $usuarios['TipoAfastamento']['nome'] = empty($usuarios['TipoAfastamento']['nome']) ? 'ND' : $usuarios['TipoAfastamento']['nome'];

                $observacao = isset($usuarios['Afastamento']['observacao']) ? $usuarios['Afastamento']['observacao'] : 'ND';

                $obs = !empty($usuarios[0]['nova_observacao']) ? str_replace(["\r", "\n"], '', $usuarios[0]['nova_observacao']) : 'ND';
                $observacaoEscaped = str_replace(' ', '', htmlspecialchars($obs, ENT_QUOTES, 'UTF-8'));


        ?>
                <tr>
                
                    <td>
                        <p><?php echo $dataCad ?></p>
                    </td>
                    <td>
                        <p>
                            <!-- Substitua 'fas fa-info-circle' pelo ícone desejado -->
                            <?php echo $viewlinkNome ?>
                        </p>
                    </td>
                    <td>
                        <p><?php echo $usuarios['Comarca']['nome'] ?></p>
                    </td>
                    <td>
                        <p><?php echo  $usuarios['Unidade']['nome'] ?></p>
                    </td>
                    <td>
                        <p><?php echo $statusAfastamento  ?></p>
                    </td>
                    <td>
                    <p><span style="color: red;">De</span> <span><?php echo $dataFormatadaIni ?></span> <span style="color: red;">A</span> <span><?php echo $dataFinal ?></span></p>

                    </td>
                    <td>
                    <p><span style="color: red;">De</span> <span><?php echo $dataFormatadaIni ?></span> <span style="color: red;">A</span> <span><?php echo $dataFinal ?></span></p>

                    </td>

                    <td>
                        <button type="button" data-toggle="modal" data-target="#Student_AddModal" class="glyphicon glyphicon-eye-open" onclick='exibirDetalhes("<?php echo $obs  ?>")'></button>
                    </td>
                </tr>
        <?php
            endforeach;
        }
        ?>
    </tbody>
</table>
<ul class="pagination">
<?php
    echo $this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li', 'class'=>'page-item', ' class'=>'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', ' class' =>'page-link'));
    echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'class'=>'page-item',  'currentClass' => 'disabled page-link', ' class'=>'page-link'));
    echo $this->Paginator->next(__('Next') . ' >', array('tag' => 'li', 'class'=>'page-item', ' class'=>'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', 'currentClass'=>'page-link', ' class' =>'page-link'));
?>  
</ul> 


<script type="text/javascript">
    $("#limparDocumento").click(function(event) {
        event.preventDefault();
        //======================================//
        $("#CorregedoriasDefensorNome").val(""); // Adicione o # antes do nome_atividade para indicar um ID
        $('#CorregedoriasDefensorNome').trigger('change');
        //======================================//
        $("#ProcessoComarcaId").val("");
        $('#ProcessoComarcaId').trigger('change');
        //======================================//
        $("#ProcessoUnidadeDefensorialId").val("");
        $('#ProcessoUnidadeDefensorialId').trigger('change');
        //======================================//
        $("#ProcessoUnidadeDefensorialId").val("");
        $('#ProcessoUnidadeDefensorialId').trigger('change');
        //======================================//
        $("#CorregedoriasNomeAfastamento").val("");
        $("#CorregedoriasNomeAfastamento").trigger('change');
        //======================================//
        $('#dataInicial').val("");

    });

    function exibirDetalhes(dados) {

        document.getElementById('detalhesConteudo').innerHTML = dados;
        //console.log(dados);
    }
</script>

<style>
    table p {
        text-align: center;
        padding: 0;
        margin: 0;
    }

    tr td button {
        width: 80%;
        position: absolute;
        left: -8%;
    }

    tr {

        font-size: 14px;
    }

    table thead {
        height: 10px;
        font-size: 14px;
        padding: 0;
        max-height: 50px;
        flex-wrap: nowrap;
    }

    th {
        padding: 0;
    }

    tr td {
        height: 30px;
    }

    tr td:nth-child(1) {
        width: auto;
        text-align: center;
        /* Centraliza o conteúdo horizontalmente */

        font-size: 12px;
    }

    tr td:nth-child(2) {
        width: auto;
        text-align: center;
        /* Centraliza o conteúdo horizontalmente */

        font-size: 12px;
    }

    tr td:nth-child(3) {
        width: auto;
        text-align: center;
        /* Centraliza o conteúdo horizontalmente */

        font-size: 12px;
    }

    tr td:nth-child(4) {
        width: auto;
        text-align: center;
        /* Centraliza o conteúdo horizontalmente */

        font-size: 12px;
    }

    tr td:nth-child(5) {
        width: auto;
        text-align: center;
        /* Centraliza o conteúdo horizontalmente */

        font-size: 12px;
    }

    tr td:nth-child(6) {
        width: auto;
        text-align: center;
        /* Centraliza o conteúdo horizontalmente */
        font-size: 12px;
    }

    tr td:nth-child(7) {
        width: auto;

        /* Centraliza o conteúdo horizontalmente */
        font-size: 12px;
    }

    tr td:nth-child(8) {
        width: auto;
        align-items: center;
        /* Centraliza o conteúdo horizontalmente */
        vertical-align: middle;
        font-size: 12px;
    }

    .margen_texto {
        padding: 10px;
    }

    .modal {
        max-height: 700px;
        overflow-y: hidden;
    }


    .mensagem-nao-encontrado td p {
        color: #878787;
        /* Cor de fundo vermelha para indicar que não foram encontrados resultados */
        text-align: center;
        font-weight: bold;

    }

    .estiloData {
        color: white;
    }
    .pagination{
        margin: 5px;
    }
    .table {
        margin-bottom: 0px;
        background: #fff;
    }

    .row{
       
        margin-right: 0px; 
        margin-left: 0px;

    }

   .letra{
    color:red;
    

   }
</style>