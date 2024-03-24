function tomarCiencia(idAvisoPje, idProcesso, idAtuacao, idExpediente, urlPag, userAuth, idDescricaoAto, id){
    var res = ""
    $.ajax({
        async: false,
        type: "GET",
        datatype: 'json',
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/atuacaoUser/'+id+'?trs=1',
        success: function (response) {
            res = JSON.parse(response);
            if(!res){
                res = false;
            }
            console.log(res)
        }
    });

    var numeracaoUnicaExpediente = null;
    listaAvisoPendente.forEach(element => {
        if(element['PjeAvisoPendentes']['id_aviso'] == idExpediente){
            numeracaoUnicaExpediente = element['PjeAvisoPendentes']['processo_numeracao_unica'];
        }
    });

    var listaAvisosPorProcesso = [];
    var avisosHtml = '';
    listaAvisoPendente.forEach(element => {
        if(element['mov']['tipo_movimentacao_id'] != null){
            return;
        }
        if(element['PjeAvisoPendentes']['processo_numeracao_unica'] == numeracaoUnicaExpediente){
            avisosHtml += '<tr>';
            
            avisosHtml += '<td style="text-align:center;"><input id="chk_aviso_assoc_'+ element['PjeAvisoPendentes']['id_aviso'] +'" type="checkbox" class="checkAviso checkAvisoAssociado" value="' + element['PjeAvisoPendentes']['id'] + ','+ element['prc']['id']+','+element['atuc']['id']+','+element['PjeAvisoPendentes']['id_aviso']+','+element['PjeAvisoPendentes']['pje_descricao_ato_id']+'" style="cursor:pointer;"></td>';
            avisosHtml += '<td style="text-align:center;">' + element['PjeAvisoPendentes']['id_aviso'] + '</td>';
            avisosHtml += '<td style="min-width: 150px;">' + element['PjeAvisoPendentes']['destinatario_pje'] + '</td>';
            avisosHtml += '<td style="text-align:center;">' + formataData(element['PjeAvisoPendentes']['data_expedicao']) + '</td>';
            avisosHtml += '<td style="text-align:center;">' + formataData(element['PjeAvisoPendentes']['data_limite_ciencia']) + '</td>';            
            
            avisosHtml += '<td style="text-align:center;">' + verificarVencimento(element['PjeAvisoPendentes']['data_limite_ciencia']) + '</td>';            
            
            avisosHtml += '</tr>';
            listaAvisosPorProcesso.push(element);
        }
    });

    if(listaAvisosPorProcesso.length >= 2){
        $("#titulo-modal-avisos").html('Expedientes associados ao processo: ' + numeracaoUnicaExpediente);
        $("#tabela-avisos-associados > tbody").html(avisosHtml);
        $("#modalListaAvisos").modal({
            keyboard: false,
            backdrop: 'static'
        });

        checados = [];
        $('.checkAviso').prop('checked', false);

        $("#checkTodosAvisosAssociados").click(function(){
            checados = [];
            $('.checkAvisoAssociado').not(this).prop('checked', this.checked);
            var exped = document.getElementsByClassName("checkAvisoAssociado");
            for(var i =0; i< exped.length; i++){
                if ($(exped[i]).prop("checked")){ 
                    checados.push($(exped[i]).val()); 
                }
            }
        }); 

        $(".checkAvisoAssociado").click(function(e) {
            if ($(this).prop( "checked")){    
                checados.push($(this).val());        
            }
            else{
                checados.splice(checados.indexOf($(this).val()), 1);              
            }
        });

        $('#btnTomarCienciaAssociados').click(function(){
            executarLote(funcionarioId, userAuthFlag, '/peticionamento_intermediarios_2_grau_caixa_entrada/index/1', 1);
        });

        $('#btnVoltarModalAssociados').click(function(){
            checados = [];
            $("#tabela-avisos-associados > tbody").html('');
        });

        return;
    }
    
    if(userAuth == 0){
        $("#btnmodalform").attr("onclick", "consultarTeorComunicacao("+idAvisoPje+","+idProcesso+",'"+idEspecializada+"',"+idExpediente+",'"+urlPag+"',"+userAuth+","+idDescricaoAto+")");

        $("#btnmodalformSegund").attr("onclick", "limparInput('formAutentPje')");
        $("#btnmodalPrincipal").attr("onclick", "abrirModalAutenticacao()");
    }
    else{
        $("#btnmodalPrincipal").attr("onclick", "consultarTeorComunicacao("+idAvisoPje+","+idProcesso+",'"+idEspecializada+"',"+idExpediente+",'"+urlPag+"',"+userAuth+","+idDescricaoAto+")");  
    }
    if(res.includes(idEspecializada)){
        // Perfil faz parte da atuacao
        $("#btnmodalSegundario").attr("onclick", "fecharModal('dialogoConfirmacaoPadrao')");
        confirmacao("Tem certeza que deseja registrar ciência do ato?", "Sim", "Não");
    }else{
        // Perfil NÃO faz parte da atuaca
        $("#btnmodalSegundario").attr("onclick", "fecharModal('dialogoConfirmacaoPadrao')");
        confirmacao("A unidade judicial deste expediente não está vinculada a sua DP. Deseja insistir na ciência do ato?", "Sim", "Não");
    } 
}

function verificarVencimento(dataString) {
    
    const dataFornecida = new Date(dataString);
    if (isNaN(dataFornecida.getTime())) {
        return 'Data inválida';
    }

    const dataAtual = new Date();

    if (dataFornecida > dataAtual) {
        return 'Em curso';
    } else {
        return 'Vencido';
    }
}

function padLeft(str, length = 2, char = '0') {
    str = str.toString();
    return str.padStart(length, char);
}
  
function formataData(dataString){

    const data = new Date(dataString);

    const dia = padLeft(data.getDate());
    const mes = padLeft(data.getMonth() + 1); 
    const ano = padLeft(data.getFullYear());
    const horas = padLeft(data.getHours());
    const minutos = padLeft(data.getMinutes());
    const segundos = padLeft(data.getSeconds());

    const dataFormatada = `${dia}/${mes}/${ano} ${horas}:${minutos}:${segundos}`;

    return dataFormatada;

}

function executarLote(idFuncionario, userAuth, urlPag, opcao = null) {
    var opc = selecItem.options[selecItem.selectedIndex].value;

    if(opcao != null){
        opc = opcao;
    }

    if(opc == 0){
        $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
        aviso("Nenhuma opção selecionada. Por favor, escolha uma opção e tente novamente!", 2);
    }
    else if(opc == 1){
        tomarCienciaLote(idFuncionario, userAuth, urlPag, (opcao != null));
    }
    else{
        excluirAvisoLote(urlPag);
    }
}

function tomarCienciaSigad(idAvisoPje, idProcesso, idExpediente, urlPag, userAuth, idDescricaoAto, id){
    var res = ""
    idEspecializada = $("#PeticionamentoIntermediariosEspecializada").val();
    $.ajax({
        async: false,
        type: "GET",
        datatype: 'json',
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/EspecializadaUser/'+id+'?trs=1',
        success: function (response) {
            res = JSON.parse(response);
            if(!res){
                res = false;
            }
        }
    });
    if(userAuth == 0){
        $("#btnmodalform").attr("onclick", "consultarTeorComunicacaoSigad("+idAvisoPje+","+idProcesso+",'"+idEspecializada+"',"+idExpediente+",'"+urlPag+"',"+userAuth+","+idDescricaoAto+")");

        $("#btnmodalformSegund").attr("onclick", "limparInput('formAutentPje')");
        $("#btnmodalPrincipal").attr("onclick", "abrirModalAutenticacao()");
    }
    else{
        $("#btnmodalPrincipal").attr("onclick", "consultarTeorComunicacaoSigad("+idAvisoPje+","+idProcesso+",'"+idEspecializada+"',"+idExpediente+",'"+urlPag+"',"+userAuth+","+idDescricaoAto+")");  
    }
    if(res.includes(idEspecializada)){
        // Perfil faz parte da atuacao
        $("#btnmodalSegundario").attr("onclick", "fecharModal('dialogoConfirmacaoPadrao')");
        confirmacao("Tem certeza que deseja registrar ciência do ato?", "Sim", "Não");
    }else{
        // Perfil NÃO faz parte da atuaca
        $("#btnmodalSegundario").attr("onclick", "fecharModal('dialogoConfirmacaoPadrao')");
        confirmacao("A unidade judicial deste expediente não está vinculada a sua DP. Deseja insistir na ciência do ato?", "Sim", "Não");
    }
}

function tomarCienciaLote(id, userAuth, urlPag, isModalAssociados = false){
    var res = ""
    $.ajax({
        async: false,
        type: "GET",
        datatype: 'json',
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/EspecializadaUser/'+id+'?trs=1',
        success: function (response) {
            res = JSON.parse(response);
            if(!res){
                res = false;
            }
        }
    });

    var nenhumExpediente = !$(".checkAviso").is(":checked");
    if (isModalAssociados) {
        $('#modalListaAvisos').modal('hide');
    }

    if(nenhumExpediente){
        $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
        aviso("Nenhum expediente foi selecionado!", 2);
    }
    else{
        if(userAuth == 0){
            $("#btnmodalPrincipal").attr("onclick", "abrirModalTipoCiencia("+userAuth+",'"+urlPag+"')");
            $("#btnmodalSegundario").attr("onclick", "fecharModal('dialogoConfirmacaoPadrao')");
            confirmacao("Tem certeza que deseja registrar ciência do ato nos expediente(s) selecionado(s)?", "Sim", "Não");
        }else{
            $("#btnmodalPrincipal").attr("onclick", "abrirModalTipoCienciaEmLote("+userAuth+",'"+urlPag+"')");
            $("#btnmodalSegundario").attr("onclick", "fecharModal('dialogoConfirmacaoPadrao')");
            confirmacao("Tem certeza que deseja registrar ciência do ato nos expediente(s) selecionado(s)?", "Sim", "Não");
        }

        var checadosId = [];
        checados.forEach(element => {
            var checadoId = element.split(',')[0];
            checadosId.push(checadoId);
        });

        var listaAtuacoes = [];
        listaAvisoPendente.forEach(element => {
            if((element['PjeAvisoPendentes']['id']).includes(checadosId)){
                listaAtuacoes.push(element['atuc']['id']);
            }
        });

        if(res != false){
            res = res[0];
        }

        if(res.includes(listaAtuacoes) && listaAtuacoes[0] != null){
            // Perfil faz parte da atuacao
            $("#btnmodalSegundario").attr("onclick", "fecharModal('dialogoConfirmacaoPadrao')");
            confirmacao("Tem certeza que deseja registrar ciência do ato?", "Sim", "Não");
        }else{
            // Perfil NÃO faz parte da atuaca
            $("#btnmodalSegundario").attr("onclick", "fecharModal('dialogoConfirmacaoPadrao')");
            confirmacao("A unidade judicial deste expediente não está vinculada a sua DP. Deseja insistir na ciência do ato?", "Sim", "Não");
        }
    }
}

function abrirModalTipoCiencia(userAuth, urlPag){
    $("#btnmodalPrincipal").attr("onclick", "abrirModalAutenticacaoEmLote(0,"+userAuth+",'"+urlPag+"')");
    $("#btnmodalSegundario").attr("onclick", "abrirModalAutenticacaoEmLote(1,"+userAuth+",'"+urlPag+"')");
    confirmacao("Esta ciência será registrada automaticamente no seu relatório da corregedoria.", "Não estou em substituição", "Estou em substituição");
}

function abrirModalTipoCienciaEmLote(userAuth, urlPag){
    $("#btnmodalPrincipal").attr("onclick", "consultarTeorComunicacaoEmLote(0,"+userAuth+",'"+urlPag+"')");
    $("#btnmodalSegundario").attr("onclick", "consultarTeorComunicacaoEmLote(1,"+userAuth+",'"+urlPag+"')");
    confirmacao("Esta ciência será registrada automaticamente no seu relatório da corregedoria.", "Não estou em substituição", "Estou em substituição");
}

function abrirModalAutenticacaoEmLote(substituicao, userAuth, urlPag){
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

    $("#btnmodalform").attr("onclick", "consultarTeorComunicacaoEmLote("+substituicao+","+userAuth+",'"+urlPag+"')");
    $("#btnmodalformSegund").attr("onclick", "limparInput('formAutentPje')");
}

function excluirAvisoLote(urlPag){
    var nenhumExpediente = !$(".checkAviso").is(":checked");
    if(nenhumExpediente){
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

function abrirModalAutenticacao(){
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
}

function fecharModal(idModal){
    $('#'+idModal).modal('hide');
}

function abrirModalConfirm(idAvisoPje, urlPag){
    fecharModal("dialogoAvisoPadrao");
    $("#btnmodalPrincipal").attr( "onclick", "ocultarExpedientePje("+idAvisoPje+",'"+urlPag+"')");
    $("#btnmodalSegundario").attr( "onclick", "fecharModal('dialogoConfirmacaoPadrao')");
    confirmacao("Esta aviso já foi visualizado diretamente na plataforma do Sistema PJE. Deseja deslocar este expediente de pendente para o status de removido?", "Sim", "Não");
}

function ocultarExpedientePje(idAvisoPje, urlPag){
    fecharModal('dialogoConfirmacaoPadrao');

    var mensagemRemocaoPJE = "Nenhuma comunicação processual localizada";
    $.ajax({
        type: "POST",
        datatype: 'html',
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/removeraviso/'+idAvisoPje+'?trs=1',
        data: "msgRemoverExpPje="+mensagemRemocaoPJE,
        success: function () {
            atualizarPagina(urlPag);
            $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("Operação efetuada com sucesso", 1);
        }
    });
}

function registrarCienciaPje(idAvisoPje, idExpediente, idProcesso, idEspecializada, subst, urlPag, idDescricaoAto){
    fecharModal('dialogoConfirmacaoPadrao');
    
    $.ajax({
        type: "POST",
        datatype: 'html',
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+idAvisoPje+'/'+idExpediente+'/1?trs=1',
        data: "tpMovimentacaoId=1&funcionarioID="+funcionarioId+"&nprocesso="+idProcesso+"&atoPraticado="+idDescricaoAto+"&atuaID="+idEspecializada+"&idVinculo="+vinculoId+"&substituicao="+subst,
        success: function (response) {
            $("#visualizarExpediente").html(response);
            atualizarPagina(urlPag);
            $('#vizExped').modal({
                keyboard: false,
                backdrop: 'static'
            });                   
        }
    });
}

function registrarCienciaPjeSigad(idAvisoPje, idExpediente, idProcesso, idEspecializada, subst, urlPag, idDescricaoAto){
    fecharModal('dialogoConfirmacaoPadrao');

    $.ajax({
        type: "POST",
        datatype: 'html',
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+idAvisoPje+'/'+idExpediente+'/1?trs=1',
        data: "tpMovimentacaoId=1&funcionarioID="+funcionarioId+"&nprocesso="+idProcesso+"&atoPraticado="+idDescricaoAto+"&especID="+idEspecializada+"&idVinculo="+vinculoId+"&substituicao="+subst,
        success: function (response) {
            visualExpediente(idExpediente, urlPag, true);
        }
    });
}

function alterarSenhaSigad(idAvisoPje,idExpediente,idProcesso,idEspecializada,urlPag,idDescricaoAto)
{
    $("#btnmodalform").attr("onclick", "consultarTeorComunicacao("+idAvisoPje+","+idProcesso+",'"+idEspecializada+"',"+idExpediente+",'"+urlPag+"', 0)");
    $("#btnmodalformSegund").attr("onclick", "limparInput('formAutentPje')");
    fecharModal('dialogoAvisoPadrao');

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
}

function consultarTeorComunicacao(idAvisoPje, idProcesso, idEspecializada, idExpediente, urlPag, userAuth, idDescricaoAto)
{
    if(userAuth == 1)
    {
        fecharModal('dialogoConfirmacaoPadrao');

        $('body').on('hidden.bs.modal', function() {
            if ($('.modal.in').length) {
                $('body').addClass('modal-open');
                $("body").css("padding-right", "17px");
            }
        });

        $.ajax({
            type: "POST",
            datatype: 'json',
            url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+idAvisoPje+'/'+idExpediente+'/0?trs=1',
            success: function (response) {
                var objRetorno = JSON.parse(response);
                if(objRetorno.retorno == 0){
                    $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                    aviso(objRetorno.msg, 0);
                }
                else if((objRetorno.retorno == 4)||(objRetorno.retorno == 5)){                       
                    $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
                    aviso(objRetorno.msg, 0);
                }
                else if(objRetorno.retorno == 2){//Expediente já foi respondido                        
                    $("#btnModalAviso").attr("onclick", "abrirModalConfirm("+idAvisoPje+",'"+urlPag+"')");
                    aviso(objRetorno.msg, 2);
                }
                else if(objRetorno.retorno == 3){//Já houve registro de ciência no portal do PJE                        
                    $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
                    aviso(objRetorno.msg, 2);
                    atualizarPagina(urlPag);
                }
                else if(objRetorno.retorno == 1){//Ciência registrada no PJE através do Sigad                 
                    
                    $("#btnmodalPrincipal").attr("onclick", "registrarCienciaPje("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idEspecializada+"', 0, '"+urlPag+"',"+idDescricaoAto+")");
                    $("#btnmodalSegundario").attr("onclick", "registrarCienciaPje("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idEspecializada+"', 1, '"+urlPag+"',"+idDescricaoAto+")");

                    confirmacao("Esta ciência será registrada automaticamente no seu relatório da corregedoria.", "Não estou em substituição", "Estou em substituição");
                }
                else if(objRetorno.retorno == 6){                        
                    $("#btnModalAviso").attr("onclick", "alterarSenhaSigad("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idEspecializada+"','"+urlPag+"', "+ idDescricaoAto +")");
                    aviso(objRetorno.msg, 0);
                }
            }
        });
    }
    else
    {
        if($("#senhaPje").val()!="")
        {
            var form = $("#formAutentPje");
            $.ajax({
                type: "POST",
                datatype: 'json',
                url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+idAvisoPje+'/'+idExpediente+'/0?trs=1',
                data: form.serialize(),
                success: function (response) {
                    var objRetorno = JSON.parse(response);
                    if(objRetorno.retorno == 0){
                        $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                        aviso(objRetorno.msg, 0);
                        limparInput("formAutentPje");
                    }
                    else if((objRetorno.retorno == 4)||(objRetorno.retorno == 5)){
                        $('#dialogoFormularioPadrao').modal('hide');
                        limparInput("formAutentPje");
                        $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
                        aviso(objRetorno.msg, 0);
                    }
                    else if(objRetorno.retorno == 2){//Expediente já foi respondido
                        $('#dialogoFormularioPadrao').modal('hide');
                        limparInput("formAutentPje");
                        $("#btnModalAviso").attr("onclick", "abrirModalConfirm("+idAvisoPje+",'"+urlPag+"')");
                        aviso(objRetorno.msg, 2);
                    }
                    else if(objRetorno.retorno == 3){//Já houve registro de ciência no portal do PJE
                        $('#dialogoFormularioPadrao').modal('hide');
                        limparInput("formAutentPje");
                        $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
                        aviso(objRetorno.msg, 2);
                        atualizarPagina(urlPag);
                    }
                    else if(objRetorno.retorno == 1){//Ciência registrada no PJE através do Sigad
                        $('#dialogoFormularioPadrao').modal('hide');
                        limparInput("formAutentPje");
                        
                        $("#btnmodalPrincipal").attr("onclick", "registrarCienciaPje("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idEspecializada+"', 0, '"+urlPag+"',"+idDescricaoAto+")");
                        $("#btnmodalSegundario").attr("onclick", "registrarCienciaPje("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idEspecializada+"', 1, '"+urlPag+"',"+idDescricaoAto+")");

                        confirmacao("Esta ciência será registrada automaticamente no seu relatório da corregedoria.", "Não estou em substituição", "Estou em substituição");
                    }
                }
            });
        }
        else{
            $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("Campo vazio. Por favor informe uma senha válida.", 0);
        }
    }   
}

function consultarTeorComunicacaoSigad(idAvisoPje, idProcesso, idEspecializada, idExpediente, urlPag, userAuth, idDescricaoAto)
{
    if(userAuth == 1)
    {
        fecharModal('dialogoConfirmacaoPadrao');

        $('body').on('hidden.bs.modal', function() {
            if ($('.modal.in').length) {
                $('body').addClass('modal-open');
                $("body").css("padding-right", "17px");
            }
        });

        $.ajax({
            type: "POST",
            datatype: 'json',
            url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+idAvisoPje+'/'+idExpediente+'/0?trs=1',
            success: function (response) {
                var objRetorno = JSON.parse(response);
                if(objRetorno.retorno == 0){
                    $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                    aviso(objRetorno.msg, 0);
                }
                else if((objRetorno.retorno == 4)||(objRetorno.retorno == 5)){                       
                    $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
                    aviso(objRetorno.msg, 0);
                }
                else if(objRetorno.retorno == 2){//Expediente já foi respondido                        
                    $("#btnModalAviso").attr("onclick", "abrirModalConfirm("+idAvisoPje+",'"+urlPag+"')");
                    aviso(objRetorno.msg, 2);
                }
                else if(objRetorno.retorno == 3){//Já houve registro de ciência no portal do PJE                        
                    $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
                    aviso(objRetorno.msg, 2);
                    atualizarPagina(urlPag);
                }
                else if(objRetorno.retorno == 1){//Ciência registrada no PJE através do Sigad                 
                    
                    $("#btnmodalPrincipal").attr("onclick", "registrarCienciaPjeSigad("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idEspecializada+"', 0, '"+urlPag+"',"+idDescricaoAto+")");
                    $("#btnmodalSegundario").attr("onclick", "registrarCienciaPjeSigad("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idEspecializada+"', 1, '"+urlPag+"',"+idDescricaoAto+")");

                    confirmacao("Esta ciência será registrada automaticamente no seu relatório da corregedoria.", "Não estou em substituição", "Estou em substituição");
                }
                else if(objRetorno.retorno == 6){                        
                    $("#btnModalAviso").attr("onclick", "alterarSenhaSigad("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idEspecializada+"','"+urlPag+"', "+ idDescricaoAto +")");
                    aviso(objRetorno.msg, 0);
                }
            }
        });
    }
    else
    {
        if($("#senhaPje").val()!="")
        {
            var form = $("#formAutentPje");
            $.ajax({
                type: "POST",
                datatype: 'json',
                url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+idAvisoPje+'/'+idExpediente+'/0?trs=1',
                data: form.serialize(),
                success: function (response) {
                    var objRetorno = JSON.parse(response);
                    if(objRetorno.retorno == 0){
                        $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                        aviso(objRetorno.msg, 0);
                        limparInput("formAutentPje");
                    }
                    else if((objRetorno.retorno == 4)||(objRetorno.retorno == 5)){
                        $('#dialogoFormularioPadrao').modal('hide');
                        limparInput("formAutentPje");
                        $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
                        aviso(objRetorno.msg, 0);
                    }
                    else if(objRetorno.retorno == 2){//Expediente já foi respondido
                        $('#dialogoFormularioPadrao').modal('hide');
                        limparInput("formAutentPje");
                        $("#btnModalAviso").attr("onclick", "abrirModalConfirm("+idAvisoPje+",'"+urlPag+"')");
                        aviso(objRetorno.msg, 2);
                    }
                    else if(objRetorno.retorno == 3){//Já houve registro de ciência no portal do PJE
                        $('#dialogoFormularioPadrao').modal('hide');
                        limparInput("formAutentPje");
                        $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
                        aviso(objRetorno.msg, 2);
                        atualizarPagina(urlPag);
                    }
                    else if(objRetorno.retorno == 1){//Ciência registrada no PJE através do Sigad
                        $('#dialogoFormularioPadrao').modal('hide');
                        limparInput("formAutentPje");
                        
                        $("#btnmodalPrincipal").attr("onclick", "registrarCienciaPjeSigad("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idAtuacao+"', 0, '"+urlPag+"',"+idDescricaoAto+")");
                        $("#btnmodalSegundario").attr("onclick", "registrarCienciaPjeSigad("+idAvisoPje+", "+idExpediente+", "+idProcesso+", '"+idAtuacao+"', 1, '"+urlPag+"',"+idDescricaoAto+")");

                        confirmacao("Esta ciência será registrada automaticamente no seu relatório da corregedoria.", "Não estou em substituição", "Estou em substituição");
                    }
                }
            });
        }
        else{
            $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("Campo vazio. Por favor informe uma senha válida.", 0);
        }
    }
}

function consultarTeorComunicacaoEmLote(subst, userAuth, urlPag){
    if(userAuth == 1){
        fecharModal('dialogoConfirmacaoPadrao');

        $('body').on('hidden.bs.modal', function() {
            if ($('.modal.in').length) {
                $('body').addClass('modal-open');
                $("body").css("padding-right", "17px");
            }
        });

        sitExpedPje.innerHTML = "";
        for(var i = 0; i<checados.length; i++){
            $.ajax({
                async: false,
                type: "POST",
                datatype: 'json',
                url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+checados[i].split(",",4)[0]+'/'+checados[i].split(",",4)[3]+'/0?trs=1',
                success: function (response) {
                    var objRetorno = JSON.parse(response);
                    if((objRetorno.retorno == 0)||(objRetorno.retorno == 4)||(objRetorno.retorno == 5)){
                        $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                        aviso(objRetorno.msg, 0);
                    }
                    else if(objRetorno.retorno == 2){//Já houve atendimento no portal do PJE
                        sitExpedPje.innerHTML += "<div class='col-sm-12' style='color: #a94442;background-color: #f2dede; padding: 5px 5px 5px 15px; border: 1px solid #ebccd1;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><strong> Falha:</strong> (Expediente Nº "+checados[i].split(",",4)[3]+"). "+objRetorno.msg+"</div>";
                    }
                    else if(objRetorno.retorno == 3){//Já houve registro de ciência no portal do PJE
                        sitExpedPje.innerHTML += "<div class='col-sm-12' style='color: #a94442;background-color: #f2dede; padding: 5px 5px 5px 15px; border: 1px solid #ebccd1;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><strong> Falha:</strong> (Expediente Nº "+checados[i].split(",",4)[3]+"). "+objRetorno.msg+"</div>";
                    }
                    else if(objRetorno.retorno == 1){//Ciência registrada no PJE através do Sigad
                        sitExpedPje.innerHTML += "<div class='col-sm-12' style='color: #3c763d; background-color: #dff0d8; padding: 5px 5px 5px 15px; border: 1px solid #d6e9c6;'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span><strong> Sucesso:</strong> (Expediente Nº "+checados[i].split(",",4)[3]+"). "+objRetorno.msg+"</div>";
                        $.ajax({
                            async: false,
                            type: "POST",
                            datatype: 'html',
                            url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+checados[i].split(",",4)[0]+'/'+checados[i].split(",",4)[3]+'/1?trs=1',
                            data: "tpMovimentacaoId=1&funcionarioID="+funcionarioId+"&nprocesso="+checados[i].split(",",4)[1]+"&atoPraticado="+checados[i].split(",",5)[4]+"&atuaID="+checados[i].split(",",4)[2]+"&idVinculo="+vinculoId+"&substituicao="+subst,

                            success: function () {}
                        });
                    }
                }
            });
        }
        limparInput("formAutentPje");

        $("#dialogoSituacaoExped").modal({
            keyboard: false,
            backdrop: 'static'
        });
        atualizarPagina(urlPag);
    }else{
        if($("#senhaPje").val()!=""){
            $('#dialogoFormularioPadrao').modal('hide');
            var form = $("#formAutentPje");
            sitExpedPje.innerHTML = "";
            var flag = false;
            for(var i = 0; i<checados.length; i++){
                $.ajax({
                    async: false,
                    type: "POST",
                    datatype: 'json',
                    url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+checados[i].split(",",4)[0]+'/'+checados[i].split(",",4)[3]+'/0?trs=1',
                    data: form.serialize(),
                    success: function (response) {
                        var objRetorno = JSON.parse(response);
                        if((objRetorno.retorno == 0)||(objRetorno.retorno == 4)||(objRetorno.retorno == 5)){
                            $("#btnModalAviso").attr("onclick", "fecharModal('dialogoAvisoPadrao')");
                            aviso(objRetorno.msg, 0);
                            flag = true;
                        }
                        else if(objRetorno.retorno == 2){//Já houve atendimento no portal do PJE
                            sitExpedPje.innerHTML += "<div class='col-sm-12' style='color: #a94442;background-color: #f2dede; padding: 5px 5px 5px 15px; border: 1px solid #ebccd1;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><strong> Falha:</strong> (Expediente Nº "+checados[i].split(",",4)[3]+"). "+objRetorno.msg+"</div>";
                        }
                        else if(objRetorno.retorno == 3){//Já houve registro de ciência no portal do PJE
                            sitExpedPje.innerHTML += "<div class='col-sm-12' style='color: #a94442;background-color: #f2dede; padding: 5px 5px 5px 15px; border: 1px solid #ebccd1;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><strong> Falha:</strong> (Expediente Nº "+checados[i].split(",",4)[3]+"). "+objRetorno.msg+"</div>";
                        }
                        else if(objRetorno.retorno == 1){//Ciência registrada no PJE através do Sigad
                            sitExpedPje.innerHTML += "<div class='col-sm-12' style='color: #3c763d; background-color: #dff0d8; padding: 5px 5px 5px 15px; border: 1px solid #d6e9c6;'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span><strong> Sucesso:</strong> (Expediente Nº "+checados[i].split(",",4)[3]+"). "+objRetorno.msg+"</div>";
                            $.ajax({
                                async: false,
                                type: "POST",
                                datatype: 'html',
                                url: '/peticionamento_intermediarios_2_grau_caixa_entrada/movimentacao/'+checados[i].split(",",4)[0]+'/'+checados[i].split(",",4)[3]+'/1?trs=1',
                                data: "tpMovimentacaoId=1&funcionarioID="+funcionarioId+"&nprocesso="+checados[i].split(",",4)[1]+"&atoPraticado="+checados[i].split(",",5)[4]+"&atuaID="+checados[i].split(",",4)[2]+"&idVinculo="+vinculoId+"&substituicao="+subst,

                                success: function () {}
                            });
                        }
                    }
                });

                if(flag) {
                    limparInput("formAutentPje");
                    return;
                }
            }

            limparInput("formAutentPje");

            $("#dialogoSituacaoExped").modal({
                keyboard: false,
                backdrop: 'static'
            });
            atualizarPagina(urlPag);
        }
        else{
            $("#btnModalAviso").attr( "onclick", "fecharModal('dialogoAvisoPadrao')");
            aviso("Campo vazio. Por favor informe uma senha válida.", 0);
        }
    }
}

function aviso(texto, tipo){
    //Tipo 0 => Modal de Erro
    //Tipo 1 => Modal de Sucesso
    //Tipo 2 => Modal de Aviso
    txtMsgAviso.innerHTML = texto;
    if(tipo == 0){
        $("#rotulo").css("background-color", "#d52626");
        $("#rotulo").css("color", "#fff");
        $("#iconeModal").removeClass("glyphicon-warning-sign glyphicon-ok-sign").addClass("glyphicon-remove-sign");
        $("#iconeModal").css("color", "#d52626");
        ttlModal.innerHTML = "Ops! Algo deu errado";
    }
    else if(tipo == 1){
        $("#rotulo").css("background-color", "rgb(84, 164, 55)");
        $("#rotulo").css("color", "#fff");
        $("#iconeModal").removeClass("glyphicon-warning-sign glyphicon-remove-sign").addClass("glyphicon-ok-sign");
        $("#iconeModal").css("color", "rgb(84, 164, 55)");
        ttlModal.innerHTML = "Sucesso";
    }
    else if(tipo == 2){
        $("#rotulo").css("background-color", "#ffd600");
        $("#rotulo").css("color", "rgb(53, 39, 23)");
        $("#iconeModal").removeClass("glyphicon-remove-sign glyphicon-ok-sign").addClass("glyphicon-warning-sign");
        $("#iconeModal").css("color", "#ffd600");
        ttlModal.innerHTML = "Aviso";
    }
    $("#dialogoAvisoPadrao").modal({
        keyboard: false,
        backdrop: 'static'
    });
}

function visualExpediente(idExpediente, urlPag, atualizarPag = true){
    $.ajax({
        type: "POST",
        datatype: 'html',
        url: '/peticionamento_intermediarios_2_grau_caixa_entrada/visualizarExpediente?trs=1',
        data: "idExped="+idExpediente,
        success: function (response) {
            $("#visualizarExpediente").html(response);
            if(atualizarPag){
                atualizarPagina(urlPag);
            }
            $('#vizExped').modal({
                keyboard: false,
                backdrop: 'static'
            });                   
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log('Erro:' + textStatus);
        }
    });
}

function confirmacao(texto, btnPrincipal, btnSegundario){
    txtMsgConfirmacao.innerHTML = texto;
    btnmodalPrincipal.innerHTML = btnPrincipal;
    btnmodalSegundario.innerHTML = btnSegundario;
    $("#dialogoConfirmacaoPadrao").modal({
        keyboard: false,
        backdrop: 'static'
    });
}

function printExpediente() {
    var divContents = document.getElementById("corpoConteudo").innerHTML;
    var divCabec = document.getElementById("cabExp").innerHTML;
    var a = window.open('', '', 'height=600, width=800');
    a.document.write(divCabec+"\n"+divContents);
    a.document.close();
    a.print();
}

function limparInput(idDiv){
    var form = document.getElementById(idDiv);
    var inputs = form.querySelectorAll('input');
    for (var i = 0; i < inputs.length; i++) {
        if ((inputs[i].type != 'checkbox') && (inputs[i].type != 'radio')) {
            inputs[i].value = '';
        }
    }
}
