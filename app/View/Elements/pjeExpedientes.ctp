<div class="panel panel-default m-top-10">
    <div class="panel-heading panel-heading-lor">
        <div>
            <b> Avisos Pendentes PJE</b> 
        </div>
        <div style="cursor: pointer;" id="closeBtnExpedientes" >
            x
        </div>
    </div>
    <div class="panel-body">
    <table class="table table-bordered table-striped" style="margin-bottom: 0px;">
        <thead>
            <tr>
                <th style="vertical-align: middle;">Nome da parte</th>
                <th style="vertical-align: middle; text-align: center;">Número</th>
                <th style="vertical-align: middle; text-align: center;">Descrição do ato</th>
                <th style="vertical-align: middle; text-align: center;">Data de expedição</th>
                <th style="vertical-align: middle; text-align: center;">Prazo</th>
                <th style="vertical-align: middle; text-align: center;">Data limite para ciência</th>
                <th style="vertical-align: middle; text-align: center;">Data limite para resposta</th>
                <th style="vertical-align: middle; text-align: center;" colspan="4">Opção</th>
            </tr>
        </thead>
        <tbody id="corpoAvisoPend">
            <?php

                foreach ($avisoPendente as $key => $aviso) :?>
                    <tr>
                        <td style="vertical-align: middle;">
                            <p style='font-size: 12px; margin: 0px;'>
                                <b>SIGAD: </b><a href="/assistidos/extrato/<?=$aviso['ass']['id']?>" target="_blank"><?=$aviso['pass']['nome']?></a><br>
                                <b>PJE:   </b><?=$aviso['PjeAvisoPendentes']['destinatario_pje']?>
                            </p>
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                         <?php if ($aviso['PjeAvisoPendentes']['perfil_importacao'] == 'G') : ?>
                            <div title="Geral" style="cursor: pointer;"  >
                                <?= "(".$aviso['PjeAvisoPendentes']['perfil_importacao'] .") " . $aviso['PjeAvisoPendentes']['id_aviso'] ?>
                            </div>
                         <?php endif ?>
                         <?php if ($aviso['PjeAvisoPendentes']['perfil_importacao'] == 'CUR') : ?>
                            <div title="Curadoria Especial" style="cursor: pointer;">
                                <?= "(".$aviso['PjeAvisoPendentes']['perfil_importacao'] .") " . $aviso['PjeAvisoPendentes']['id_aviso'] ?>
                            </div>
                         <?php endif ?>
                         <?php if ($aviso['PjeAvisoPendentes']['perfil_importacao'] == 'NC') : ?>
                            <div title="Núcleo de Contestação" style="cursor: pointer;">
                                <?= "(".$aviso['PjeAvisoPendentes']['perfil_importacao'] .") " . $aviso['PjeAvisoPendentes']['id_aviso'] ?>
                            </div>
                         <?php endif ?>
                         <?php if ($aviso['PjeAvisoPendentes']['perfil_importacao'] == '') : ?>
                            <div >
                                <?=  $aviso['PjeAvisoPendentes']['id_aviso'] ?>
                            </div>
                         <?php endif ?>
                        </td>
                        <td style="vertical-align: middle; text-align: center;"><?=$aviso['PjeAvisoPendentes']['descricao_ato']; ?></td>
                        <td style="vertical-align: middle; text-align: center;"><?=$this->Util->ddmmaaHis($aviso['PjeAvisoPendentes']['data_expedicao'])?></td>
                        <td style="vertical-align: middle; text-align: center;"><?=$aviso['PjeAvisoPendentes']['prazo']; ?></td>
                        <td style="vertical-align: middle; text-align: center;"><?=$this->Util->ddmmaaHis($aviso['PjeAvisoPendentes']['data_limite_ciencia'])?></td>
                        <td style="vertical-align: middle; text-align: center;"><?=$this->Util->ddmmaaHis($aviso['PjeAvisoPendentes']['data_limite_resposta'])?></td>
                        <td style="vertical-align: middle; text-align: center;"><input type="checkbox" name="selecAviso[]" class="checkAviso" value="<?=$aviso['PjeAvisoPendentes']['id']?>,<?=$aviso['prc']['id']?>,<?=$aviso['atuc']['id']?>,<?=$aviso['PjeAvisoPendentes']['id_aviso']?>"></td><?php
                            if($aviso['mov']['tipo_movimentacao_id'] == 1){?>
                                <td style="vertical-align: middle; text-align: center;"><a class="glyphicon glyphicon-share-alt" title="Responder" href="/PeticionamentoIntermediarios/edit?rota_anterior=/PjeController/index/<?=$aviso['PjeAvisoPendentes']['processo_numeracao_unica']?>&numeracao_unica=<?=$aviso['PjeAvisoPendentes']['processo_numeracao_unica']?>&idAvisoPje=<?=$aviso['PjeAvisoPendentes']['id']?>" target="_blank"></a></td>
                                <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div style="cursor: pointer;" class="glyphicon glyphicon-eye-open" title="Visualizar Expediente" onclick="visualExpediente('<?=$aviso['PjeAvisoPendentes']['id_aviso']?>','<?=$_SERVER['REQUEST_URI']?>')"></div></td><?php
                            }
                            else{?>
                                <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div class="glyphicon glyphicon-search" style="cursor: pointer; background-color: red;color: white; padding: 2px 4px;" title="Tomar Ciência" onclick="tomarCiencia('<?=$aviso['PjeAvisoPendentes']['id']?>','<?=$aviso['prc']['id']?>','<?=$aviso['atuc']['id']?>','<?=$aviso['PjeAvisoPendentes']['id_aviso']?>','<?=$_SERVER['REQUEST_URI']?>',<?=$userAuth?>,<?=$aviso['PjeAvisoPendentes']['pje_descricao_ato_id']?>,<?= $idFunc ?>)"></div></td><?php
                            }?>
                        <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div style="cursor: pointer;" class="glyphicon glyphicon-trash" title="Excluir Expediente" onclick="excluirAviso(<?=$aviso['PjeAvisoPendentes']['id']?>,'<?=$_SERVER['REQUEST_URI']?>')"></div></td>
                        <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div style="cursor: pointer;" class="glyphicon glyphicon-tags" title="Marcador" onclick="gerenciarMarcador(<?=$aviso['PjeAvisoPendentes']['id']?>,'<?=$_SERVER['REQUEST_URI']?>')"></div></td>                                                                     
                    </tr><?php
                endforeach;
            ?>
            <tr style="position: sticky;">
                <td id="infAviso" colspan="14" class="alert alert-success" style="position:relative; padding:14px"><?=$this->Paginator->counter(array('format' => '<strong>Página %page% de %pages%</strong>, exibindo %current% registros de um total de <strong>%count%</strong>, exibindo do registro %start% até o %end%'));?></td>
            </tr>
            <tr>

                <td colspan="3" style="vertical-align: middle; text-align: center;"><input type="checkbox" id="checkTodosExpediente"> Selecionar todos os expedientes</td>
                <td colspan="7" style="vertical-align: middle;">
                    <label for="">Com os Itens Selecionados:</label>
                    <div class="input-group" style="margin-bottom: 0px;">
                        <select class="form-control" id="selecItem">
                            <option value="0">O que deseja fazer?</option>
                            <option value="1">Tomar Ciência</option>
                            <option value="2">Excluir Expediente</option>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="executarLote('<?=$_SERVER['REQUEST_URI']?>')">Executar</button>
                        </span>
                    </div>
                </td>
            </tr>
            <script>
                /*
                    const divNumber = document.getElementById("btnnumbers");
                    for (child of divNumber.children){
                        url = child.href;
                        child.setAttribute("onclick", "atualizarPaginacao('"+url+"')");
                        child.removeAttribute("href");
                        child.removeAttribute("href");
                    }
                    const divPrev = document.getElementById("btnprev");
                    for (child of divPrev.children){
                        url = child.href;
                        child.setAttribute("onclick", "atualizarPaginacao('"+url+"')");
                        child.removeAttribute("href");
                        child.removeAttribute("href");
                    }
                    const divNext = document.getElementById("btnnext");
                    for (child of divNext.children){
                        url = child.href;
                        child.setAttribute("onclick", "atualizarPaginacao('"+url+"')");
                        child.removeAttribute("href");
                        child.removeAttribute("href");
                    }
                */
                var checados = [];
                $(".checkAviso").click(function(e) {
                    if ($(this).prop( "checked")){    
                        checados.push($(this).val());        
                    }
                    else{
                        checados.splice(checados.indexOf($(this).val()), 1);              
                    }
                });
                
                $("#checkTodosExpediente").click(function(){
                    checados = [];
                    $('.checkAviso').not(this).prop('checked', this.checked);
                    var exped = document.getElementsByClassName("checkAviso");
                    for(var i =0; i< exped.length; i++){
                        if ($(exped[i]).prop( "checked")){ 
                            checados.push($(exped[i]).val()); 
                        }
                    }
                });   
            </script>
        </tbody>
    </table>
 
    <div id="excluirAvisoPendente"></div>
    <div id="vizualizarExpediente"></div>
    <div id="responderExpediente"></div>
    <div id="marcadorExpediente"></div>

   


    </div>
</div>



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

<script src="\js\html2pdf.bundle.min.js" type="text/javascript"></script>
<script src="\js\xlsx.full.min.js"></script>
<?=$this->Html->script('intimacoes/comumFromPleno.js') ?>

<script>
   
   $(document).ready(function () {
        $("#filtro_marcador").select2({placeholder: "Selecione...", tags:true, allowClear: true});

        carregarComarcaAtuacao();
      



        /* Função auxiliar para converter o objeto de trabalho em um blob */
        function workbook2blob(workbook) {
            var wopts = { bookType: 'xlsx', bookSST: false, type: 'binary' };
            var wbout = XLSX.write(workbook, wopts);

            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i < s.length; i++) {
                    view[i] = s.charCodeAt(i) & 0xFF;
                }
                return buf;
            }

            return new Blob([s2ab(wbout)], { type: 'application/octet-stream' });
        }
    });

    function gerarPDF() {
        var options = {
            margin: 7,
            filename: 'expediente.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

        // Define a posição da barra de rolagem para o topo
        document.body.scrollTop = 0;

        // Obtém o elemento HTML que será convertido em PDF
        var table = document.getElementById('conteudoTabelaAviso');

        // Copia a tabela para mostrar as colunas ocultas
        var tableCopy = table.cloneNode(true);

        //Adiciona a classe "hidden" às células das colunas indesejadas
        var columnClassName = 'classOcultar'; // Nome da classe para ocultar as colunas
        var columnCells = tableCopy.querySelectorAll('.'+columnClassName);
        for (var i = 0; i < columnCells.length; i++) {
            columnCells[i].classList.add('hidden');
        }

        // Gera o PDF usando o html2pdf
        html2pdf().set(options).from(tableCopy).save();
    }

    function atualizarExpediente(){
        $.ajax({
            async: false,
            url: '/pje_aviso_pendentes/expedientespje?perfil=CUR&trs=1',
            datatype: 'json',
            type: "POST",
            success: function(data){
                var objRetorno = JSON.parse(data);
                if(objRetorno.retorno == 0){
                    $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                    aviso(objRetorno.msg, 0);
                }
                else if(objRetorno.retorno == 1){
                    $.ajax({
                        async: false,
                        url: '/pje_aviso_pendentes/expedientespje?perfil=NC&trs=1',
                        datatype: 'json',
                        type: "POST",
                        success: function(data){
                            var objRetorno = JSON.parse(data);
                            if(objRetorno.retorno == 0){
                                $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                                aviso(objRetorno.msg, 0);
                            }
                            else if(objRetorno.retorno == 1){
                                $.ajax({
                                    async: false,
                                    url: '/pje_aviso_pendentes/expedientespje?perfil=G&trs=1',
                                    datatype: 'json',
                                    type: "POST",
                                    success: function(data){
                                        var objRetorno = JSON.parse(data);
                                        if(objRetorno.retorno == 0){
                                            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                                            aviso(objRetorno.msg, 0);
                                        }
                                        else if(objRetorno.retorno == 1){
                                            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                                            aviso(objRetorno.msg, 1);
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
            },
            complete: function() {
                var form = $("#formAvisoPje");
                $.ajax({
                    async: false,
                    url: '/pje_aviso_pendentes/index/1',
                    type: "POST",
                    datatype: 'html',
                    data: form.serialize(),
                    success: function(data) {
                        $($(data).find("#corpoAvisoPend")).replaceAll("#corpoAvisoPend");
                    }
                });  
            }
        });
    }

    function abrirModalTipoCiencia(urlPag){
        $("#btnmodalPrincipal").attr("onclick", "abrirModalAutenticacaoEmLote(0,'"+urlPag+"')");
        $("#btnmodalSegundario").attr("onclick", "abrirModalAutenticacaoEmLote(1,'"+urlPag+"')");
        confirmacao("Esta ciência será registrada automaticamente no seu relatório da corregedoria.", "Não estou em substituição", "Estou em substituição");
    }

    function abrirModalAutenticacaoEmLote(substituicao, urlPag){
        fecharModal('dialogoConfirmacaoPadrao');

        $("#dialogoFormularioPadrao").modal({
            keyboard: false,
            backdrop: 'static'
        });

        $('body').on('hidden.bs.modal', function() {
            if ($('.modal.in').length) {
                $('body').addClass('modal-open');
                $("body").css("padding-right", "17px");
            }
        });

        $("#btnmodalform").attr("onclick", "consultarTeorComunicacaoEmLote("+substituicao+",'"+urlPag+"')");
        $("#btnmodalformSegund").attr("onclick", "limparInput('formAutentPje')");
    }

    function excluirAvisoLote(urlPag){
        if(!$(".checkAviso").is(":checked")){
            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("Nenhum expediente foi selecionado!", 2);
        }
        else{
            $.ajax({
                url: '/pje_aviso_pendentes/removeraviso?trs=1',
                type: "GET",
                datatype: 'html',
                success: function(data) {
                    $("#excluirAvisoPendente").html(data);
                    $('#remAvs').modal({
                        keyboard: false,
                        backdrop: 'static'
                    });

                    $('body').on('hidden.bs.modal', function() {
                        if ($('.modal.in').length) {
                            $('body').addClass('modal-open');
                            $("body").css("padding-right", "17px");
                        }
                    });

                    $("#remAvisoPJE").attr( "onclick", "modalConfirmacaoRemocaoEmLote('"+urlPag+"')");
                }
            });            
        }
    }

    function responder(id){
        $.ajax({
            url: '/pje_aviso_pendentes/responderexpediente/'+id+'?trs=1',
            type: "GET",
            datatype: 'html',
            success: function(data) {
                $("#responderExpediente").html(data);
                $('#respExpPJE').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        });
    }

    function excluirAviso(idAvisoPje, urlPag) {
        // $.ajax({
        //     url: '/pje_aviso_pendentes/removeraviso?trs=1',
        //     type: "GET",
        //     datatype: 'html',
        //     success: function(data) {
        //         $("#excluirAvisoPendente").html(data);
        //         $('#remAvs').modal({
        //             keyboard: false,
        //             backdrop: 'static'
        //         });

        //         $('body').on('hidden.bs.modal', function() {
        //             if ($('.modal.in').length) {
        //                 $('body').addClass('modal-open');
        //                 $("body").css("padding-right", "17px");
        //             }
        //         });

        //         $("#remAvisoPJE").attr( "onclick", "modalConfirmacaoRemocao("+idAvisoPje+",'"+urlPag+"')");
        //     }
        // });

        $("#btnmodalPrincipal").attr( "onclick", "deletarExpediente("+idAvisoPje+",'"+urlPag+"')");
        $("#btnmodalSegundario").attr( "onclick", "fecharModal('dialogoConfirmacaoPadrao')");
        confirmacao("Tem certeza que deseja excluir este expediente "+idAvisoPje+" do Sigad?", "Sim", "Não");
    }

    function modalConfirmacaoRemocaoEmLote(urlPag){
        if(mtrem.value != ""){
            $("#btnmodalPrincipal").attr( "onclick", "deletarExpedienteEmLote('"+urlPag+"')");
            $("#btnmodalSegundario").attr( "onclick", "fecharModal('dialogoConfirmacaoPadrao')");
            confirmacao("Tem certeza que deseja excluir os expedientes selecionados do Sigad?", "Sim", "Não");
        }
        else{
            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("O campo 'motivo da remoção' é de preenchimento obrigatorio. Por favor preencha esse campo e tente novamente.", 2);
        }
    }

    function modalConfirmacaoRemocao(idAvisoPje,urlPag){
        if(mtrem.value != ""){
            $("#btnmodalPrincipal").attr( "onclick", "deletarExpediente("+idAvisoPje+",'"+urlPag+"')");
            $("#btnmodalSegundario").attr( "onclick", "fecharModal('dialogoConfirmacaoPadrao')");
            confirmacao("Tem certeza que deseja excluir este expediente do Sigad?", "Sim", "Não");
        }
        else{
            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("O campo 'motivo da remoção' é de preenchimento obrigatorio. Por favor preencha esse campo e tente novamente.", 2);
        }
    }

    function deletarExpedienteEmLote(urlPag){
        fecharModal('dialogoConfirmacaoPadrao');
        fecharModal('remAvs');
        for(var i = 0; i<checados.length; i++){
            var form = $("#formRemAvisoPje");
            $.ajax({
                async: false,
                type: "POST",
                datatype: 'html',
                url: '/pje_aviso_pendentes/removeraviso/'+checados[i].split(",",3)[0]+'?trs=1',
                data: form.serialize(),
                success: function () {
                }
            });
        }
        atualizarPagina(urlPag);
        $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
        aviso("Expediente excluído com sucesso", 1);
    }

    function deletarExpediente(idAvisoPje,urlPag){
        fecharModal('dialogoConfirmacaoPadrao');
        fecharModal('remAvs');
        var form = $("#formRemAvisoPje");
        $.ajax({
            type: "POST",
            datatype: 'html',
            url: '/pje_aviso_pendentes/removeraviso/'+idAvisoPje+'?trs=1',
            data: form.serialize(),
            success: function () {
                atualizarPagina(urlPag);
                $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                aviso("Expediente excluído com sucesso", 1);
            }
        });
    }

    function gerenciarMarcador(id, urlPag){
        $.ajax({
            url: '/pje_aviso_pendentes/marcador/'+id+'?urlAtual='+urlPag+'&trs=1',
            type: "GET",
            datatype: 'html',
            success: function(data) {
                $("#marcadorExpediente").html(data);
                $('#addMarcador').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        });
    }

    function executarLote(urlPag) {
        var opc = selecItem.options[selecItem.selectedIndex].value;
        if(opc == 0){
            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("Nenhuma opção selecionada. Por favor, escolha uma opção e tente novamente!", 2);
        }
        else if(opc == 1){
            tomarCienciaLote(urlPag);
        }
        else{
            excluirAvisoLote(urlPag);
        }        
    }

    function limparSelect (idDiv){
        var form = document.getElementById(idDiv);
        var selects = form.querySelectorAll('select');
        for (var i = 0; i < selects.length; i++) {
            var options = selects[i].querySelectorAll('option');
            if (options.length > 0)selects[i].value = options[0].value;
        }
    }
    
    function exibirtodosExpediente() {
        var perfil = perfilUser.options[perfilUser.selectedIndex].value;
        if(perfil!=''){
            var form = $("#formAvisoPje");
            $.ajax({
                url: '/pje_aviso_pendentes/index/2',
                type: "POST",
                datatype: 'html',
                data: form.serialize(),
                success: function(data) {
                    document.getElementById("termNumTodas").checked = true;
                    $($(data).find("#corpoAvisoPend")).replaceAll("#corpoAvisoPend");
                    limparInput("formAvisoPje");
                    $('#filtro_comarca').val(null).trigger('change');
                    $('#filtro_atuacao').val(null).trigger('change');
                    $('#filtro_marcador').val(null).trigger('change');
                    limparSelect("statusSelect");
                }
            });
        }
        else{
            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("O campo \"perfil do PJE\" é obrigatório. Por favor preencha este campo e tente novamente.", 2);
        }           
    }



    function carregarComarcaAtuacao(){
        $.getJSON('/json/AtuacoesUnidadeDefensoriais/listaAtuacaoComarca.json', function (data) {
            $("#filtro_comarca").change(function () {                
                var options_atuacao ='';
                var str = [];          
                $("#filtro_comarca option:selected").each(function (index) {
                    str[index] = $(this).val();
                });
                $.each(data, function (key, val) {
                    for (let i = 0; i < str.length; i++) {
                        if(key == str[i]) {                          
                            $.each(val, function (key_atc, val_atuc) {
                                if(key == "291" && key_atc == "521"){
                                    options_atuacao += '<option value="' + key_atc + '">' + val_atuc + '</option>';
                                    if(val["1349"] != undefined){
                                        let _valTemp = val["1349"];
                                        options_atuacao += '<option value="1349">' + _valTemp + '</option>';
                                    }
                                    return;
                                }

                                if(key == "291" && key_atc == "1349"){
                                    return;
                                }
                                options_atuacao += '<option value="' + key_atc + '">' + val_atuc + '</option>';
                            });
                            break;                     
                        }
                    }
                });
                $("#filtro_atuacao").html(options_atuacao);
      
                <?php if(isset($vetorIdAtc)){?>
                    $("#filtro_atuacao").val([<?=$vetorIdAtc?>]).change();
                <?php }?>
                
                $("#filtro_atuacao").select2({
                    placeholder: "Selecione...",
                    tags:true,
                    allowClear: true
                });
            }).change();
        });
    }

    function filtrarExpediente(){
        var perfil = perfilUser.options[perfilUser.selectedIndex].value;
        if(perfil!=''){
            var form = $("#formAvisoPje");
            $.ajax({
                url: '/pje_aviso_pendentes/index/1',
                type: "POST",
                datatype: 'html',
                data: form.serialize(),
                success: function(data) {
                    $($(data).find("#corpoAvisoPend")).replaceAll("#corpoAvisoPend");
                }
            });  
        }
        else{
            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("O campo \"perfil do PJE\" é obrigatório. Por favor preencha este campo e tente novamente.", 2);
        }
    }

    function atualizarPaginacao(urlPag){
        var perfil = perfilUser.options[perfilUser.selectedIndex].value;
        if(perfil!=''){
            var form = $("#formAvisoPje");
            $.ajax({
                url: urlPag,
                type: "POST",
                datatype: 'html',
                data: form.serialize(),
                success: function(dados) {
                    $($(dados).find("#corpoAvisoPend")).replaceAll("#corpoAvisoPend");
                }
            });
        }
        else{
            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("O campo \"perfil do PJE\" é obrigatório. Por favor preencha este campo e tente novamente.", 2);
        }  
    }

    function atualizarPagina(urlPrincipal){
        var form = $("#formAvisoPje");
        $.ajax({
            url: urlPrincipal,
            type: "POST",
            datatype: 'html',
            data: form.serialize(),
            success: function(data) {
                $($(data).find("#selectMarcador")).replaceAll("#selectMarcador");
                $("#filtro_marcador").select2({placeholder: "Selecione...", tags:true, allowClear: true});
                $($(data).find("#corpoAvisoPend")).replaceAll("#corpoAvisoPend");
            }
        });
    }
</script>