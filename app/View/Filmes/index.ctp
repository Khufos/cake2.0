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


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal Title</h4>
                </div>
                <div class="modal-body">
                    <!-- Formulário dentro do modal -->
                    <form id="form1">
                    <div class="form-group">
                    <p id="idDefensor" data-id=""></p>
                    
                    </div>
                        <div class="form-group">
                            <label for="dataInicio">Data de Início:</label>
                            <input type="date" class="form-control" id="dataInicio">
                        </div>
                        <div class="form-group">
                            <label for="dataFim">Data de Fim:</label>
                            <input type="date" class="form-control" id="dataFim">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" form="form1">Enviar</button>
                </div>
            </div>
        </div>
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

            <th style="vertical-align: middle; text-align: center;">ID</th>
            <th style="vertical-align: middle; text-align: center;">NOME</th>
            <th style="vertical-align: middle; text-align: center;">ANO</th>
            <th style="vertical-align: middle; text-align: center;">DURACAO</th>
            <th style="vertical-align: middle; text-align: center;">IDIOMA</th>
            <th style="vertical-align: middle; text-align: center;">GENERO_ID</th>
            <th style="vertical-align: middle; text-align: center;">DATA_RETIFICADA INICIO</th>
            <th style="vertical-align: middle; text-align: center;">DATA_RETIFICADA FIM</th>
            <th style="vertical-align: middle; text-align: center;">Ações</th>

            </tr>
        </thead>
        <?php foreach ($filmes as $filme) :
            
            $id = $filme['Filme']['id'];?>
            <tr>
                <td><?php echo $filme['Filme']['id']; ?></td>
                <td><?php echo $filme['Filme']['nome']; ?></td>
                <td><?php echo $filme['Filme']['ano']; ?></td>
                <td><?php echo $filme['Filme']['duracao']; ?></td>
                <td><?php echo $filme['Filme']['idioma']; ?></td>
                <td><?php echo $filme['Filme']['genero_id']; ?></td>
                <td><?php echo $filme['Filme']['dataRetificadaI']; ?></td>
                <td><?php echo $filme['Filme']['dataRetificadaF']; ?></td>
                <td>
                    <button type="button" data-toggle="modal" data-target="#Student_AddModal" class="glyphicon glyphicon-plus-sign" onclick='exibirDetalhes()'></button>
                    <button type="button" class="glyphicon glyphicon-tag" data-toggle="modal" data-target="#myModal" onclick='pegaId("<?php echo  $id ?>")'></button>

                </td>
                <td>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<ul class="pagination">
    <?php
    echo $this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li', 'class' => 'page-item', ' class' => 'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', ' class' => 'page-link'));
    echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'class' => 'page-item',  'currentClass' => 'disabled page-link', ' class' => 'page-link'));
    echo $this->Paginator->next(__('Next') . ' >', array('tag' => 'li', 'class' => 'page-item', ' class' => 'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', 'currentClass' => 'page-link', ' class' => 'page-link'));
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



    function pegaId(dados) {

        $('#idDefensor').attr('data-id', dados);
        //console.log(dados);
    }
</script>

<script>
    $('#form1').submit(function(e) {
        e.preventDefault();
        var idDefensor = $('#idDefensor').attr('data-id');
         var dataInicio = $('#dataInicio').val();
        var dataFim = $('#dataFim').val();
        // alert("Id:" + idDefensor + "\n" + "Primeira data: " + dataInicio + "\n" + "Segunda data: " + dataFim);
        $.ajax({
            url:'/public_html/projeto_cinema/filmes/recive/E?trs=1/',
            method:'POST',
            data:{
                IdDefensor: idDefensor ,
                dataInicio: dataInicio,
                dataFim:dataFim
            },

            dataType:'json'

        }).done(function(result){
            console.log(result);
        });

    });
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

    .pagination {
        margin: 5px;
    }

    .table {
        margin-bottom: 0px;
        background: #fff;
    }

    .row {

        margin-right: 0px;
        margin-left: 0px;

    }

    .letra {
        color: red;


    }
</style>