$('#AtuacoesNome').on('change', function(ev) {
    $('#atuacaoId').val(ev.target.value);
    $('#atuacaoId').trigger('change');
});

$('#PeticionamentoIntermediariosComarcaIdSelect').on('change', function(ev) {
    $('#comarcaId').val(ev.target.value);
    $('#comarcaId').trigger('change');
});

$('#UnidadeDefensoriaisNome').on('change', function(ev) {
    $('#unidadeDefensorialId').val(ev.target.value);
    $('#unidadeDefensorialId').trigger('change');
    salvarProgresso();
});

function ativaUnidadeJudicialAndComarca(){

    getUnidadeDefensorialByDefensor();

    if(cadastroIncompleto){
        var unidadeDefensorialId = $('#unidadeDefensorialId').val();
        $('#UnidadeDefensoriaisNome').select2({
            disabled: unidadeDefensorialId ? true : false
        });
        
        var comarcaId = $('#comarcaId').val();
        $('#PeticionamentoIntermediariosComarcaIdSelect').select2({
            disabled: comarcaId ? true : false
        });
    }
    
    if($('#UnidadeDefensoriaisNome').val() == '' && petUnidadeDefensorialId != ''){
        $('#UnidadeDefensoriaisNome').val(petUnidadeDefensorialId).trigger('change');
    }

}