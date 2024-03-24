function carregaEditor(id){
    anexoIdEdicao = null;
    showCustomLoading(); 
    $.ajax({
        url: '/peticionamento_intermediarios_editor_textos/index/' + id,
        type: "GET",
        datatype: 'html',
        success: function(data) {
            data = data.replaceAll("\uFEFF", ""); //Remove o BOM (Marcador de ordem de bytes)
            $("#editorDocumento").html(data.replaceAll('&#xFEFF;', ''));
            $("#btnMarcador").attr('onclick', onClickMarcador);
        },
        complete: function(){
            hideCustomLoading();
        }
    });
}

function salvarDocumentoEditor(){
    
    if(envioAgendado) {
        var msg = "O agendamento de envio offline para esse processo será cancelado. Deseja continuar?";
        if(!confirm(msg)) {
            $("#btnCancelarModal").attr('disabled', false);
            $("#btnSalvarModeloConfirmar").attr('disabled', false);  
            return;
        }
        $("#cancelarAgendamento").val(true);
    }

    $('#statusEditor').attr('style', 'background-color: #177941 !important');
    $('#statusEditor').html('Salvando arquivo...');
    
    encodarConteudoDoEditorEmBase64();
    $('#EditorTexto').val('');

    var form = $("#formEditorDoc");
    $.ajax({
        url: '/peticionamento_intermediarios_editor_textos/salvar/',
        type: "POST",
        data: form.serialize(),
        success: function(data) {
            $('#modalPeticionamentoIntermediarioSalvarModelo').modal('hide');
            envioAgendado = false;
            carregaEditor(peticionamentoId);
            reloadAnexosTable();
        }
    });

}

function confirmUpdateModelo() {
    $('#isUpdateModelo').val("true");
    $('#dialogoConfirmaAtualizarModelo').modal('hide');
    salvarModeloEditor();
}

function salvarModeloEditor(){
    
	$('#statusEditor').attr('style', 'background-color: #177941 !important');
	$('#statusEditor').html('Salvando modelo...');
	
	encodarConteudoDoEditorEmBase64();
	$('#EditorTexto').val('');

	var form = $("#formEditorDoc");
	$.ajax({
		url: '/peticionamento_intermediarios_editor_textos/salvarModelo/?trs=1',
		type: "POST",
		data: form.serialize(),
		success: function(data) {
			var ret = JSON.parse(data);

			$('#modalPeticionamentoIntermediarioSalvarModelo').modal('hide');
			
			if(ret.status == 0) {
				$("#btnCancelarModal").attr('disabled', false);
				$("#btnSalvarModelConfirmar").attr('disabled', false);

				$('#dialogoConfirmaAtualizarModelo').modal('show');
			} else if(ret.status == 1) {
				$("#btnCancelarModal").attr('disabled', false);
				$("#btnSalvarModelConfirmar").attr('disabled', false);
				
				alert("Ocorreu um erro ao salvar modelo, por favor tente novamente");
			} else {
				$("#RedirectEdit").val(true);
				showCustomLoading(); 
				alert("Modelo salvo com sucesso");


				var dados = ret.dados;
				
				var html = "<option value=''>Selecione um Modelo</option>";

				for(var i in dados){
					html += "<option value='"+dados[i].id+"'>"+dados[i].valor+"</option>"
				}

				$("#PeticionamentoIntermediarioEditorModelos").html(html);
				$("#PeticionamentoIntermediarioEditorModelos").select2();
				hideCustomLoading();
				
			}

			$('#statusEditor').attr('style', 'background-color: #777 !important');
			$('#statusEditor').html('Novo arquivo');
		}
	});

}

function btnAplicarModelo(event) {
    var idModelo = $("#PeticionamentoIntermediarioEditorModelos").val();
    if(idModelo == '') {
        alert('É necessário selecionar modelo para aplicar ao editor');
        return;
    }
    var peticaoId = $("#PeticaoId").val();
    modeloAplicado = true;

    showCustomLoading(); 
    $.ajax({
        url: '/peticionamento_intermediarios_editor_textos/carregarModelo/' + idModelo + '/' + peticaoId,
        type: "GET",
        datatype: 'html',
        async: false,
        success: function(data) {
            
            data = data.replaceAll("\uFEFF", ""); //Remove o BOM (Marcador de ordem de bytes)
            $("#editorDocumento").html(data.replaceAll('&#xFEFF;', ''));
            $('#statusEditor').attr('style', 'background-color: #FFC90E !important');
            $('#statusEditor').html('Em edição - Novo arquivo');
            
            $("#PeticionamentoIntermediarioEditorModelos").val(idModelo).trigger('change');
            hideCustomLoading();

        }
    });   
    
}

function cancelarDocumentoEditor(){
    carregaEditor(peticionamentoId);
}

function editarDocumentoEditor(anexo_peticionamento_id, anexo_id){
    showCustomLoading();
    modeloAplicado = false;

    $.ajax({
        url: '/peticionamento_intermediarios_editor_textos/edit/' + anexo_peticionamento_id,
        type: "GET",
        datatype: 'html',
        async: false,
        success: function(data) {
            
            data = data.replaceAll("\uFEFF", ""); //Remove o BOM (Marcador de ordem de bytes)
            $("#editorDocumento").html(data.replaceAll('&#xFEFF;', ''));

            var nomeArquivo = $('#linha_' + anexo_id + ' td:nth-child(3)').html();
            anexoIdEdicao = anexo_id;

            $('#statusEditor').attr('style', 'background-color: #FFC90E !important');
            $('#statusEditor').html('Em edição - ' + nomeArquivo);
            
            hideCustomLoading();

        }
    });   

}

function importarDados(){

    var atualPoloDetalhes = null;
    var dadosComplementares = null;
    var indexAtual = null;
    var listaPjeDetalhes = null;
    var isAutorTemp = $('#flexRadioAssistidoAutor').prop('checked');
    var isReuTemp = $('#flexRadioAssistidoReu').prop('checked');
    var isInteressadoTemp = $('#flexRadioAssistidoInteressado').prop('checked');

    if(peticaoResumida){

        dadosComplementares = {
            assistido: null,
            peticao_inicial: {
                nome_acao: pjeAssunto
            },
            pje: {
                polo_nome_pje: ""
            }
        }
    
        carregarDadosComplementares(dadosComplementares);
        return;

    }

    if(cadastroIncompleto){
        if(isAutorTemp){
            indexAtual = $('#PeticionamentoIntermediarioAutores').val();
        }
        if(isReuTemp){
            indexAtual = $('#PeticionamentoIntermediarioReus').val();
        }
        if(isInteressadoTemp){
            indexAtual = $('#PeticionamentoIntermediarioOutrosInteressados').val();
        }
    }else{
        indexAtual = assistidoPreSelecionado;
    }

    listaPjeDetalhes = autoresPjeDetalhes;
    var poloSelecionados = [];
    if(isAutorTemp) {
        $('select[name="Autores[]"] :selected').each(function(){
            poloSelecionados.push($(this).val());
         });
    }
    if(isReuTemp){
        listaPjeDetalhes = reusPjeDetalhes;
        $('select[name="Reus[]"] :selected').each(function(){
            poloSelecionados.push($(this).val());
         });
    }
    if(isInteressadoTemp) {
        listaPjeDetalhes = terceirosPjeDetalhes;
        $('select[name="OutrosInteressados"] :selected').each(function(){
            poloSelecionados.push($(this).val());
         });
    }

    if(!cadastroIncompleto) {
        var nomePoloSelecionados = [];

        if(isAutorTemp) {
            $('input[name="NomeAutor"]').each(function(){
                nomePoloSelecionados.push($(this).val());
             });
        }
        if(isReuTemp){
            $('input[name="NomeReu"]').each(function(){
                nomePoloSelecionados.push($(this).val());
             });
        }
        if(isInteressadoTemp) {
            $('input[name="NomeOutroInteressado"]').each(function(){
                nomePoloSelecionados.push($(this).val());
             });
        }

        for (let index = 0; index < listaPjeDetalhes.length; index++) {
            for (let index2 = 0; index2 < nomePoloSelecionados.length; index2++) {
                if(listaPjeDetalhes[index]['pessoaNome'].toLowerCase() == nomePoloSelecionados[index2].toLowerCase()) {
                    poloSelecionados.push(listaPjeDetalhes[index]);
                }
            }
        }
    }

    var assistidos = [];
    for (let index = 0; index < poloSelecionados.length; index++) {
        var atualPoloDetalhes = null;
        if(!cadastroIncompleto) {
            atualPoloDetalhes = poloSelecionados[index];
        } else {
            atualPoloDetalhes = listaPjeDetalhes[poloSelecionados[index]];
        }
        if(!atualPoloDetalhes || typeof atualPoloDetalhes === 'undefined'){
            alert("Ocorreu uma falha ao carregar os dados complementares, por favor, tente novamente.");
            return;
        }

        let enderecoAtual = "";
        if(atualPoloDetalhes['enderecos'][0]){
            enderecoAtual = formataEnderecoComplementar(atualPoloDetalhes['enderecos'][0]);
        }
                        
        let isPessoaFisica = atualPoloDetalhes['pessoaTipoPessoa'] === 'fisica';
        let tipoPessoa = 'F';
        let codigoDocumento = '';

        if(isPessoaFisica){
            if(atualPoloDetalhes && atualPoloDetalhes['documentos']){
                let documentosArray = atualPoloDetalhes['documentos'];
                documentosArray.forEach(function(documento) {
                    if(documento['tipoDocumento'] === 'CI'){
                        codigoDocumento = documento['codigoDocumento'];
                    }
                });
            }
        }else{
            tipoPessoa = 'J';
        }

        let docFiscal = atualPoloDetalhes['pessoaNumeroDocumentoPrincipal'] ? atualPoloDetalhes['pessoaNumeroDocumentoPrincipal'] : '';
        docFiscal = formatCpfCnpj(docFiscal);

        assistidos.push({
            tipo_pessoa: tipoPessoa,
            nome: atualPoloDetalhes['pessoaNome'] ? atualPoloDetalhes['pessoaNome'] : '',
            nacionalidade: atualPoloDetalhes['pessoaNacionalidade'] ? atualPoloDetalhes['pessoaNacionalidade'] : '',
            estado_civil: atualPoloDetalhes['pessoaEstadoCivil'] ? atualPoloDetalhes['pessoaEstadoCivil'] : '',
            profissao: atualPoloDetalhes['pessoaProfissao'] ? atualPoloDetalhes['pessoaProfissao'] : '',
            documento_fiscal: docFiscal,
            documento_identificador: codigoDocumento,
            filiacao: atualPoloDetalhes['pessoaNomeGenitora'] ? atualPoloDetalhes['pessoaNomeGenitora'] : '',
            endereco: enderecoAtual,
            telefone: atualPoloDetalhes['pessoaTelefone'] ? atualPoloDetalhes['pessoaTelefone'] : '',
            email: atualPoloDetalhes['pessoaEmail'] ? atualPoloDetalhes['pessoaEmail'] : '',
        });

    }

    dadosComplementares = {
        assistido: assistidos,
        peticao_inicial: {
            nome_acao: pjeAssunto,
            comarca: $("#PeticionamentoIntermediariosComarcaIdSelect option:selected").text(),
            atuacao: $("#AtuacoesNome").val(),
            numeracaoUnicaProcesso: numeracaoUnicaProcesso,
            defensor: $("#PeticionamentoIntermediarioDefensor option:selected").text()
        }
    }

    carregarDadosComplementares(dadosComplementares);

}

function formataEnderecoComplementar(enderecoAtual){
        
    var enderecoObjeto = [];

    enderecoObjeto.push(enderecoAtual['cep'] ? "CEP: " + enderecoAtual['cep'] : "");
    enderecoObjeto.push(enderecoAtual['logradouro']);
    enderecoObjeto.push(enderecoAtual['numero'] ? "Nº " + enderecoAtual['numero'] : "");
    enderecoObjeto.push(enderecoAtual['bairro']);
    enderecoObjeto.push(enderecoAtual['cidade']);
    enderecoObjeto.push(enderecoAtual['estado']);
    enderecoObjeto.push(enderecoAtual['pais']);

    return enderecoObjeto.filter(item => item !== "" && item).join(" - ");

}

function adicionarTags(){
    $("#modalPeticionamentoIntermediarioEditorTags").modal("show");
    $("#btnTagNumProcesso").focus();
    carregarModalTags();
}