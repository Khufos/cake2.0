$(document).ready(function() {

    // if(cadastroIncompleto){
    //     definicoesCadastroIncompleto();
    //     return;
    // }

    // definicoesCadastroCompleto();

    definicoesCadastroIncompleto();

});

$('#PeticionamentoIntermediarioReus').on('change', function() {

    var idSelect = "#PeticionamentoIntermediarioReus";
    var textSelect = "Selecione um Réu";

    validaMudancaAssistido(idSelect, textSelect);

});

$('#PeticionamentoIntermediarioAutores').on('change', function() {

    var idSelect = "#PeticionamentoIntermediarioAutores";
    var textSelect = "Selecione um Autor";

    validaMudancaAssistido(idSelect, textSelect);

});

$('#PeticionamentoIntermediarioOutrosInteressados').on('change', function() {

    var idSelect = "#PeticionamentoIntermediarioOutrosInteressados";
    var textSelect = "Selecione um Interessado";

    validaMudancaAssistido(idSelect, textSelect);

});

$("input[name='flexRadioAssistido']").on("click", function () {
    var reuSelecionado = $("#flexRadioAssistidoReu").is(":checked");
    var autorSelecionado = $("#flexRadioAssistidoAutor").is(":checked");
    var interessadoSelecionado = $("#flexRadioAssistidoInteressado").is(":checked");

    var idSelect = "#PeticionamentoIntermediarioOutrosInteressados";
    var textSelect = "Selecione um Interessado";

    if(autorSelecionado) {
        idSelect = "#PeticionamentoIntermediarioAutores";
        textSelect = "Selecione um Autor";
    } else if(reuSelecionado) {
        idSelect = "#PeticionamentoIntermediarioReus";
        textSelect = "Selecione um Réu";
    }

    radioAssistidoAlterado = validaMudancaAssistido(idSelect, textSelect);

    radioAssistidoAlterado = true;

});

function definicoesCadastroIncompleto(){

    var tipoAssistidoTemp = "ativo";
    if($('#poloAssistido').val() === 'PA'){
        tipoAssistidoTemp = "passivo";
    }else if($('#poloAssistido').val() != 'AT'){
        tipoAssistidoTemp = "terceiro";
    }

    setAssistidoRadioButton(tipoAssistidoTemp, false);

}

function definicoesCadastroCompleto(){

    var tipoAssistidoTemp = "ativo";
    if($('#poloAssistido').val() === 'PA'){
        tipoAssistidoTemp = "passivo";
    }else if($('#poloAssistido').val() != 'AT'){
        tipoAssistidoTemp = "terceiro";
    }

    setAssistidoRadioButton(tipoAssistidoTemp, true);

}

function validaMudancaAssistido(idSelect, textSelect){

    if($(idSelect).find(":selected").text() === textSelect) {
        return false;
    }

    $.ajax({
        type: "POST",
        url: urlConsultarPeticionamentoAssistido,
        data: { 
            'assistido': $(idSelect).find(":selected").text(), 
            'numeroProcesso': numeracaoUnicaProcesso,
            'peticaoId': peticionamentoId
        },
        success: function(result) {
            if(result.trim().length > 0) {
                if(confirm(`Já existe uma petição em rascunho com ${result} para o assistido selecionado. Deseja criar uma nova petição?`)) {
                    $("#PeticionamentoIntermediarioSubstituicao").val(1).trigger('change');
                } else {
                    if(idSelect === '#PeticionamentoIntermediarioReus'){
                        document.getElementById('flexRadioAssistidoAutor').checked = true;
                    }
                    if(idSelect === '#PeticionamentoIntermediarioAutores'){
                        document.getElementById('flexRadioAssistidoReu').checked = true;
                    }
                }
            }
        }
    });

}

function setAssistido(tipoAssistido) {
    if (tipoAssistido == "ativo") {
        $('#PeticionamentoIntermediarioAutores').select2({
            disabled: false
        });
        $('#PeticionamentoIntermediarioReus').select2({
            disabled: true
        });
        $('#PeticionamentoIntermediarioOutrosInteressados').select2({
            disabled: true
        });
        $("#BtnAdicionaPoloAtivo").show();
        $("#BtnAdicionaPoloPassivo").hide();
        verificaPolosAtivo();
        removerPolosPassivoAdicionais();
    } else if(tipoAssistido == "passivo") {
        $('#PeticionamentoIntermediarioAutores').select2({
            disabled: true
        });
        $('#PeticionamentoIntermediarioReus').select2({
            disabled: false
        });
        $('#PeticionamentoIntermediarioOutrosInteressados').select2({
            disabled: true
        });
        $("#BtnAdicionaPoloAtivo").hide();
        $("#BtnAdicionaPoloPassivo").show();
        verificaPolosPassivo();
        removerPolosAtivoAdicionais();
    } else {
        $('#PeticionamentoIntermediarioAutores').select2({
            disabled: true
        });
        $('#PeticionamentoIntermediarioReus').select2({
            disabled: true
        });
        $('#PeticionamentoIntermediarioOutrosInteressados').select2({
            disabled: false
        });
        $("#BtnAdicionaPoloAtivo").hide();
        $("#BtnAdicionaPoloPassivo").hide();
        removerPolosPassivoAdicionais();
        removerPolosAtivoAdicionais();
    }
    salvarProgresso();
}

function setAssistidoRadioButton(tipoAssistido, setDisabled = true) {

    if (tipoAssistido === "ativo") {

        $('#flexRadioAssistidoAutor').attr({'checked': 'checked'});
        if(setDisabled){
            $("#BtnAdicionaPoloAtivo").show();
            $("#BtnAdicionaPoloPassivo").hide();

            $('#flexRadioAssistidoAutor').attr({disabled: false});
            $('#flexRadioAssistidoReu').attr({disabled: true});
            $('#flexRadioAssistidoInteressado').attr({disabled: true});
        }

    } else if(tipoAssistido === "passivo") {

        $('#flexRadioAssistidoReu').attr({'checked': 'checked'});
        if(setDisabled){
            $("#BtnAdicionaPoloAtivo").hide();
            $("#BtnAdicionaPoloPassivo").show();

            $('#flexRadioAssistidoAutor').attr({disabled: true});
            $('#flexRadioAssistidoReu').attr({disabled: false});
            $('#flexRadioAssistidoInteressado').attr({disabled: true});
        }

    }else{

        $('#flexRadioAssistidoInteressado').attr({'checked': 'checked'});
        if(setDisabled){
            $("#BtnAdicionaPoloAtivo").hide();
            $("#BtnAdicionaPoloPassivo").hide();

            $('#flexRadioAssistidoAutor').attr({disabled: true});
            $('#flexRadioAssistidoReu').attr({disabled: true});
            $('#flexRadioAssistidoInteressado').attr({disabled: false});
        }

    }

}