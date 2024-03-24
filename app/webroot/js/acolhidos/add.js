$(document).ready(function () {
    $("#PessoaFisicaNumeroDocumento").blur(function () {
        var tipoDocSelecionado = $('#PessoaFisicaTipoDocumentoId').val();
        if (tipoDocSelecionado == tipoDocRG) {
            var rg = $(this).val();
            $.ajax({
                type: 'post',
                url: window.location.origin +'/pessoa_fisicas/verificaUnicidadeRG/' + rg + '?trs=1',
                beforeSend: function () {
                    $('#loading').fadeIn();
                },
                success: function (data) {
                    $('#rgs_homonimos').html(data);
                    $('#loading').fadeOut();
                },
                error: function (erro) {
                    $('#loading').fadeOut();
                }
            });
        }
    });

    $("#PaAcolhidoAddForm").submit(function (e) {
        e.preventDefault();

        if( $('#PessoaNome').val() == "" ||
            $('#PessoaFisicaTipoDocumentoId').val() == "" ||
            $('#PessoaFisicaNomeMae').val() == ""
        ) {
            alert("Nome, nome da mãe e tipo de documento são campos obrigatórios.");
        } else {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    $('#resAssistido').html(response);
                }
            });
        }
    });

    $('#PessoaFisicaTipoDocumentoId').change(function(){
        //Nao possui registro civil
        if(this.value == 0)
        {
            $('#PessoaFisicaNumeroDocumento').parents('.col-xs-6').hide();
            $('#PessoaFisicaOrgaoExpedidor').parents('.col-xs-6').hide();
            $('#PessoaFisicaCpf').parents('.col-xs-6').hide();
        } else {
            $('#PessoaFisicaNumeroDocumento').parents('.col-xs-6').show();
            $('#PessoaFisicaOrgaoExpedidor').parents('.col-xs-6').show();
            $('#PessoaFisicaCpf').parents('.col-xs-6').show();
        }
    });

    $('#PaAcolhidoDispAdocao').change(function(){
        $('#PaAcolhidoMotivoAdocao').parents('.col-xs-6').toggle();
    });

    $('#PaAcolhidoAdpf').change(function(){
        $('#PaAcolhidoNumeroAdpf').parents('.col-xs-6').toggle();
    });

    $('#PaAcolhidoSituacaoRua').change(function(){
        $('#PaAcolhidoSituacaoRuaLocal').parents('.col-xs-6').toggle();
    });
});
