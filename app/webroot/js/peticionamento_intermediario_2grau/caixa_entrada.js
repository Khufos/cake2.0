
$(document).ready(function () {

    $("#moverGrupo").select2({
        dropdownParent: $('#dialogoMoverParaGrupo')
    });

    $("#filtro_marcador").select2({placeholder: "Selecione...", tags:true, allowClear: true});
    var botaoExportar = document.getElementById('excelExpendietes'); // substitua 'botao-exportar' pelo ID do seu botão de exportação

    botaoExportar.addEventListener('click', function() {
        var tabela = document.getElementById('tblExpedientePje'); // substitua 'tabela' pelo ID da sua tabela

        var nomeArquivo = 'aviso_pendentes.xlsx'; // nome do arquivo de saída

        /* Cria um objeto de trabalho do Excel */
        var workbook = XLSX.utils.table_to_book(tabela, { sheet: "SheetJS" });

        /* Converte o objeto de trabalho em um blob */
        var blob = workbook2blob(workbook);

        /* Cria um link de download */
        var linkDownload = document.createElement('a');
        linkDownload.href = URL.createObjectURL(blob);
        linkDownload.download = nomeArquivo;

        /* Dispara o download */
        linkDownload.click();
    });

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
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/expedientespje?perfil=G&trs=1&executa_distribuicao=0',
        datatype: 'json',
        type: "POST",
        success: function(data) {
            var listaAvisosImportados = null;
            
            var objRetorno = JSON.parse(data);
            if(objRetorno.retorno == 0){
                $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                aviso(objRetorno.msg, 0);
            }

            listaAvisosImportados = JSON.parse(data);
            if(listaAvisosImportados['lista_avisos'] !== undefined){
                listaAvisosImportados = listaAvisosImportados['lista_avisos'];
            }
            
            $.ajax({
                async: false,
                url: '/peticionamento_intermediarios_2_grau_distribuicao/iniciar_distribuicao',
                type: "POST",
                data: {
                    listaAvisos: listaAvisosImportados
                },
                success: function() {
                    alert("Importação e distribuição automática realizada com sucesso.");
                },
                error: function(error){
                    alert("Ocorreu uma falha na distribuição automática.");
                    console.log(error);
                }
            });  
        },
        complete: function() {
            var form = $("#formAvisoPje");
            $.ajax({
                async: false,
                url: '/peticionamento_intermediarios_2_grau_caixa_entrada/index/1',
                type: "POST",
                datatype: 'html',
                data: form.serialize(),
                success: function(data) {
                    $($(data).find("#corpoAvisoPend")).replaceAll("#corpoAvisoPend");
                    $($(data).find("#variaveisJs")).replaceAll("#variaveisJs");
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
            url: '/peticionamento_intermediarios_2_grau_caixa_entrada/removeraviso?trs=1',
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
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/responderexpediente/'+id+'?trs=1',
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
    //     url: '/peticionamento_intermediarios_2_grau_caixa_entrada/removeraviso?trs=1',
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

function moverParaGrupo(idAvisoPje) {
    $("#moverGrupo").val("").trigger('change');
    $("#dialogoMoverParaGrupo").modal('show');
    $("#btnConfirmMoverParaGrupo").attr( "onclick", "salvarMoverGrupo("+idAvisoPje+")");
}

function salvarMoverGrupo(idAvisoPje) {

    if($("#moverGrupo").val() == "") {
        alert("É obrigatório selecionar a caixa destino");
        $("#moverGrupo").focus();
        return;
    }

    var ids = [];
    ids.push(idAvisoPje);
    $('input[name="selecAviso[]"]:checked').each(function () {
        var value = $(this).val().split(',');
        if(idAvisoPje != parseInt(value[0])) {
            ids.push(parseInt(value[0]));
        }
    });

    $("#btnConfirmMoverParaGrupo").attr('disabled', true);
    $("#btnCancelarMoverParaGrupo").attr('disabled', true);
    
    if( $("#moverDefensor").val() != '')
    {
        $.ajax({
            url: "/peticionamento_intermediarios_2_grau_caixa_entrada/mover_defensor/",
            type: "POST",
            datatype: 'json',
            data: {
                ids: ids.join(','),
                id_grupo: $("#moverGrupo").val(),
                id_pessoa:$("#moverDefensor").val()
            },
            success: function(result) {
                alert("Processo movido com sucesso.");
                window.location.reload();
            },
            error: function(error) {
                alert(error);
                $("#btnConfirmMoverParaGrupo").attr('disabled', false);
                $("#btnCancelarMoverParaGrupo").attr('disabled', false);
            }
        });
    }else {
        $.ajax({
            url: "/peticionamento_intermediarios_2_grau_caixa_entrada/mover_grupo/",
            type: "POST",
            datatype: 'json',
            data: {
                ids: ids.join(','),
                id_grupo: $("#moverGrupo").val()
            },
            success: function(data) {

                var listaAvisosImportados = null;

                var dados = JSON.stringify(eval("(" + data + ")"));               
                listaAvisosImportados = dados;
                             
                $.ajax({
                    async: false,
                    url: '/peticionamento_intermediarios_2_grau_distribuicao/iniciar_distribuicao',
                    type: "POST",
                    data: {
                        listaAvisos: data
                    },
                    success: function() {
                        alert("Processo movido com sucesso.");
                    },
                    error: function(error){
                        alert("Ocorreu uma falha na distribuição automática.");
                        console.log(error);
                    }
                });  

                window.location.reload();
            },
            error: function(error) {
                alert(error);
                $("#btnConfirmMoverParaGrupo").attr('disabled', false);
                $("#btnCancelarMoverParaGrupo").attr('disabled', false);
            }
        });
    }
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
            url: '/peticionamento_intermediarios_2_grau_caixa_entrada/removeraviso/'+checados[i].split(",",3)[0]+'?trs=1',
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
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/removeraviso/'+idAvisoPje+'?trs=1',
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
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/marcador/'+id+'?urlAtual='+urlPag+'&trs=1',
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
            url: '/peticionamento_intermediarios_2_grau_caixa_entrada/index/2',
            type: "POST",
            datatype: 'html',
            data: form.serialize(),
            success: function(data) {
                document.getElementById("termNumTodas").checked = true;
                $($(data).find("#corpoAvisoPend")).replaceAll("#corpoAvisoPend");
                $($(data).find("#variaveisJs")).replaceAll("#variaveisJs");
                limparInput("formAvisoPje");
                $('#filtro_comarca').val(null).trigger('change');
                //$('#filtro_atuacao').val(null).trigger('change');
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

function filtrarExpediente(){
    var perfil = perfilUser.options[perfilUser.selectedIndex].value;
    if(perfil!=''){
        var form = $("#formAvisoPje");
        $.ajax({
            url: '/peticionamento_intermediarios_2_grau_caixa_entrada/index/1',
            type: "POST",
            datatype: 'html',
            data: form.serialize(),
            success: function(data) {
                $($(data).find("#corpoAvisoPend")).replaceAll("#corpoAvisoPend");
                $($(data).find("#variaveisJs")).replaceAll("#variaveisJs");
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
                $($(dados).find("#variaveisJs")).replaceAll("#variaveisJs");
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
            $($(data).find("#variaveisJs")).replaceAll("#variaveisJs");
        }
    });
}

function obterGrupo(grupoId) {
    $.ajax({
        url: "/peticionamento_intermediarios_2_grau_caixa_entrada/obterDefensoresPorGrupoId/" + grupoId,
        type: "POST",
        datatype: 'json',
        success: function(result) {
            if(result && result.length > 0){
                var dados = JSON.parse(trim(result));
                $.each(dados, function(index, item) {
                    var id = item.Pessoa.id;
                    var nome = item.Pessoa.nome;
                    $('#moverDefensor').append(new Option(nome, id));
                });                
            }else{}
        },
        error: function(error) {
            alert(error);
        }
    });
}