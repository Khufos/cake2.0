$(document).ready(function () {
    $("#tipoDoc").change(function () {
        /*Verifica se o tipo do documento escolhido é CPF*/
        if ($(this).val() == 102) {
            $("#FiltroDocumento").addClass("cpf");
        } else {
            $("#FiltroDocumento").removeClass("cpf").unmask();
        }
        refreshJquery();
    });

    $("#TipoAtendimentoId").change(function(){
        if($(this).val() == 1) {
            $("#status").show('fast');
        }else{
            $("#status").hide('fast');
        }
    })
});
