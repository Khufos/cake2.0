$(function() {

    // Atribui evento e função para limpeza dos campos
    $('#buscaVitima').on('input', limpaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $( "#buscaVitima" ).autocomplete({
	    minLength: 3,
	    source: function( request, response ) {
	        $.ajax({
	            url: urlbuscaVitima,
	            dataType: "json",
	            data: {
	            	acao: 'autocomplete',
	                parametro: $('#buscaVitima').val()
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
	        $("#buscaVitima").val( ui.item.nome );
	        carregarDados();
	        return false;
	    },
	    select: function( event, ui ) {
	        $("#buscaVitima").val( ui.item.nome );
	        return false;
	    }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
        
//        alert(item.nome);
      return $( "<li>" )
        .append( "<a><b>Nome: </b>" + item.nome + "<br> <b> Mãe: </b>" + item.nome_mae + "</a><br>" )
        .appendTo( ul );
    };

    // Função para carregar os dados da consulta nos respectivos campos
    function carregarDados(){
    	var busca = $('#buscaVitima').val();

    	if(busca != "" && busca.length >= 3){
    		$.ajax({
	            url: urlbuscaVitima,
	            dataType: "json",	
	            data: {
	            	acao: 'consulta',
	                parametro: $('#buscaVitima').val()
	            },
	            success: function( data ) {
	               $('#AssistidoIdVitima').val(data[0].assistido_id);
	               $('#VitimaId').val(data[0].vitima_id);
	               $('#PessoaIdVitima').val(data[0].vitima_id);
	               $('#PessoaNomeVitima').val(data[0].nome);
	               $('#PessoaFisicaNomeMaeVitima').val(data[0].nome_mae);
	               $('#PessoaFisicaNomePaiVitima').val(data[0].nome_pai);
	               $('#PessoaFisicaApelidoVitima').val(data[0].apelido);
	               $('#PessoaFisicaSexoVitima').val(data[0].sexo);
	               $('#PessoaFisicaNascimentoVitima').val(data[0].nascimento);
	               $('#PessoaFisicaNacionalidadeVitima').val(data[0].nacionalidade);
	               $('#PessoaFisicaNaturalidadeVitima').val(data[0].naturalidade);
	               $('#PessoaFisicaEstadoCivilIdVitima').val(data[0].estado_civil_id);
	               $('#PessoaFisicaSituacaoProfissionalIdVitima').val(data[0].situacao_profissional_id);
	               $('#PessoaFisicaProfissaoIdVitima').val(data[0].profissao_id);
	               $('#PessoaFisicaRendaIdVitima').val(data[0].renda_id);
	               $('#PessoaFisicaQuantidadeFilhoIdVitima').val(data[0].quantidade_filho_id);
	               $('#PessoaFisicaNucleoFamiliarIdVitima').val(data[0].nucleo_familiar_id_id);
	               $('#PessoaFisicaTipoResidenciaIdVitima').val(data[0].tipo_residencia_id);
	               $('#PessoaFisicaReligiaoIdVitima').val(data[0].religiao_id);
	               $('#PessoaFisicaRacaIdVitima').val(data[0].raca_id);
	               $('#PessoaFisicaTipoDeficienciaIdVitima').val(data[0].tipo_deficiencia_id);
	               $('#PessoaFisicaTipoDocumentoIdVitima').val(data[0].tipo_documento_id);
	               $('#PessoaFisicaNumeroDocumentoVitima').val(data[0].numero_documento);
	               $('#PessoaFisicaOrgaoExpedidorVitima').val(data[0].orgao_expedidor);
	               $('#PessoaFisicaCpfVitima').val(data[0].cpf);
	               $('#PessoaFisicaEscolaridadeIdVitima').val(data[0].escolaridade_id);
	               $('#ContatoResidencialVitima').val(data[0].residencial);
	               $('#ContatoCelularVitima').val(data[0].celular);
	               $('#ContatoComercialVitima').val(data[0].comercial);
	               $('#ContatoRecadoVitima').val(data[0].recado);
	               $('#ContatoResponsavelVitima').val(data[0].responsavel);
	               $('#ContatoEmailVitima').val(data[0].email);
	               $('#cepVitima').val(data[0].cep);
	               $('#EnderecoEstadoVitima').val(data[0].estado);
	               $('#EnderecoCidadeIdVitima').val(data[0].cidade_id);
	               $('#EnderecoBairroDescricaoVitima').val(data[0].bairro_descricao);
	               $('#EnderecoLogradouroDescricaoVitima').val(data[0].logradouro_descricao);
	               $('#EnderecoNumeroVitima').val(data[0].numero);
	               $('#EnderecoReferenciaVitima').val(data[0].referencia);

	            }
	        });
    	}
    }

    function limpaCampos(){
       var busca = $('#buscaVitima').val();

       if(busca === ""){
            $('#AssistidoIdVitima').val('');
            $('#VitimaId').val('');
            $('#AssistidoIdVitima').val('');
            $('#VitimaId').val('');
            $('#PessoaNomeVitima').val('');
            $('#PessoaFisicaNomeMaeVitima').val('');
            $('#PessoaFisicaNomePaiVitima').val('');
            $('#PessoaFisicaApelidoVitima').val('');
            $('#PessoaFisicaSexoVitima').val('');
            $('#PessoaFisicaNascimentoVitima').val('');
            $('#PessoaFisicaNacionalidadeVitima').val('');
            $('#PessoaFisicaNaturalidadeVitima').val('');
            $('#PessoaFisicaEstadoCivilIdVitima').val('');
            $('#PessoaFisicaSituacaoProfissionalIdVitima').val('');
            $('#PessoaFisicaProfissaoIdVitima').val('');
            $('#PessoaFisicaRendaIdVitima').val('');
            $('#PessoaFisicaQuantidadeFilhoIdVitima').val('');
            $('#PessoaFisicaNucleoFamiliarIdVitima').val('');
            $('#PessoaFisicaTipoResidenciaIdVitima').val('');
            $('#PessoaFisicaReligiaoIdVitima').val('');
            $('#PessoaFisicaRacaIdVitima').val('');
            $('#PessoaFisicaTipoDeficienciaIdVitima').val('');
            $('#PessoaFisicaTipoDocumentoIdVitima').val('');
            $('#PessoaFisicaNumeroDocumentoVitima').val('');
            $('#PessoaFisicaOrgaoExpedidorVitima').val('');
            $('#PessoaFisicaCpfVitima').val('');
            $('#PessoaFisicaEscolaridadeIdVitima').val('');
            $('#ContatoResidencialVitima').val('');
            $('#ContatoCelularVitima').val('');
            $('#ContatoComercialVitima').val('');
            $('#ContatoRecadoVitima').val('');
            $('#ContatoResponsavelVitima').val('');
            $('#ContatoEmailVitima').val('');
            $('#cepVitima').val('');
            $('#EnderecoEstadoVitima').val('');
            $('#EnderecoCidadeIdVitima').val('');
            $('#EnderecoBairroDescricaoVitima').val('');
            $('#EnderecoLogradouroDescricaoVitima').val('');
            $('#EnderecoNumeroVitima').val('');
            $('#EnderecoReferenciaVitima').val('');
       }
    }
});
