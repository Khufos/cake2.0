$(function() {

    // Atribui evento e função para limpeza dos campos
    $('#busca').on('input', limpaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $( "#busca" ).autocomplete({
	    minLength: 3,
	    source: function( request, response ) {
	        $.ajax({
	            url: urlbusca,
	            dataType: "json",
	            data: {
	            	acao: 'autocomplete',
	                parametro: $('#busca').val()
	            },
	            success: function(data) {
                        response(data);
                        
//                        alert('Successfully called');
	            },
                    error: function(jqxhr, status, exception) {
                        alert('Exception:', exception);
                    }
	        });
	    },
	    focus: function( event, ui ) {
	        $("#busca").val( ui.item.nome );
	        carregarDados();
	        return false;
	    },
	    select: function( event, ui ) {
	        $("#busca").val( ui.item.nome );
	        return false;
	    }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
        
//        alert(item.nome);
      return $( "<li>" )
        .append( "<a><b>Nome: </b>" + item.nome + "<br> Mãe: </b>" + item.nome_mae + "</a><br>" )
        .appendTo( ul );
    };

    // Função para carregar os dados da consulta nos respectivos campos
    function carregarDados(){
    	var busca = $('#busca').val();

    	if(busca != "" && busca.length >= 3){
    		$.ajax({
	            url: urlbusca,
	            dataType: "json",	
	            data: {
	            	acao: 'consulta',
	                parametro: $('#busca').val()
	            },
	            success: function( data ) {
	               $('#AssistidoId').val(data[0].assistido_id);
	               $('#FamiliarId').val(data[0].familiar_id);
	               $('#PessoaNome').val(data[0].nome);
	               $('#PessoaFisicaNomeMae').val(data[0].nome_mae);
	               $('#PessoaFisicaNomePai').val(data[0].nome_pai);
	               $('#PessoaFisicaApelido').val(data[0].apelido);
	               $('#PessoaFisicaSexo').val(data[0].sexo);
	               $('#PessoaFisicaNascimento').val(data[0].nascimento);
	               $('#PessoaFisicaNacionalidade').val(data[0].nacionalidade);
	               $('#PessoaFisicaNaturalidade').val(data[0].naturalidade);
	               $('#PessoaFisicaEstadoCivilId').val(data[0].estado_civil_id);
	               $('#PessoaFisicaSituacaoProfissionalId').val(data[0].situacao_profissional_id);
	               $('#PessoaFisicaProfissaoId').val(data[0].profissao_id);
	               $('#PessoaFisicaRendaId').val(data[0].renda_id);
	               $('#PessoaFisicaQuantidadeFilhoId').val(data[0].quantidade_filho_id);
	               $('#PessoaFisicaNucleoFamiliarId').val(data[0].nucleo_familiar_id_id);
	               $('#PessoaFisicaTipoResidenciaId').val(data[0].tipo_residencia_id);
	               $('#PessoaFisicaReligiaoId').val(data[0].religiao_id);
	               $('#PessoaFisicaRacaId').val(data[0].raca_id);
	               $('#PessoaFisicaTipoDeficienciaId').val(data[0].tipo_deficiencia_id);
	               $('#PessoaFisicaTipoDocumentoId').val(data[0].tipo_documento_id);
	               $('#PessoaFisicaNumeroDocumento').val(data[0].numero_documento);
	               $('#PessoaFisicaOrgaoExpedidor').val(data[0].orgao_expedidor);
	               $('#PessoaFisicaCpf').val(data[0].cpf);
	               $('#PessoaFisicaEscolaridadeId').val(data[0].escolaridade_id);
	               $('#ContatoResidencial').val(data[0].residencial);
	               $('#ContatoCelular').val(data[0].celular);
	               $('#ContatoComercial').val(data[0].celular);
	               $('#ContatoRecado').val(data[0].recado);
	               $('#ContatoResponsavel').val(data[0].responsavel);
	               $('#ContatoEmail').val(data[0].email);
	               $('#cep').val(data[0].cep);
	               $('#EnderecoEstado').val(data[0].estado);
	               $('#EnderecoCidadeId').val(data[0].cidade_id);
	               $('#EnderecoBairroDescricao').val(data[0].bairro_descricao);
	               $('#EnderecoLogradouroDescricao').val(data[0].logradouro_descricao);
	               $('#EnderecoNumero').val(data[0].numero);
	               $('#EnderecoReferencia').val(data[0].referencia);

	            }
	        });
    	}
    }

    function limpaCampos(){
       var busca = $('#busca').val();

       if(busca == ""){
            $('#AssistidoId').val('');
            $('#FamiliarId').val('');
            $('#AssistidoId').val('');
            $('#PessoaNome').val('');
            $('#PessoaFisicaNomeMae').val('');
            $('#PessoaFisicaNomePai').val('');
            $('#PessoaFisicaApelido').val('');
            $('#PessoaFisicaSexo').val('');
            $('#PessoaFisicaNascimento').val('');
            $('#PessoaFisicaNacionalidade').val('');
            $('#PessoaFisicaNaturalidade').val('');
            $('#PessoaFisicaEstadoCivilId').val('');
            $('#PessoaFisicaSituacaoProfissionalId').val('');
            $('#PessoaFisicaProfissaoId').val('');
            $('#PessoaFisicaRendaId').val('');
            $('#PessoaFisicaQuantidadeFilhoId').val('');
            $('#PessoaFisicaNucleoFamiliarId').val('');
            $('#PessoaFisicaTipoResidenciaId').val('');
            $('#PessoaFisicaReligiaoId').val('');
            $('#PessoaFisicaRacaId').val('');
            $('#PessoaFisicaTipoDeficienciaId').val('');
            $('#PessoaFisicaTipoDocumentoId').val('');
            $('#PessoaFisicaNumeroDocumento').val('');
            $('#PessoaFisicaOrgaoExpedidor').val('');
            $('#PessoaFisicaCpf').val('');
            $('#PessoaFisicaEscolaridadeId').val('');
            $('#ContatoResidencial').val('');
            $('#ContatoCelular').val('');
            $('#ContatoComercial').val('');
            $('#ContatoRecado').val('');
            $('#ContatoResponsavel').val('');
            $('#ContatoEmail').val('');
            $('#cep').val('');
            $('#EnderecoEstado').val('');
            $('#EnderecoCidadeId').val('');
            $('#EnderecoBairroDescricao').val('');
            $('#EnderecoLogradouroDescricao').val('');
            $('#EnderecoNumero').val('');
            $('#EnderecoReferencia').val('');
            $('#FamiliarGrauParentesco').val('');
       }
    }
});
