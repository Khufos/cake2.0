var carregouAtoPraticado = cadastroIncompleto;
var atualizarAtoComplete = false;

function limparAtoPraticado() {
    let _id = '#PeticionamentoIntermediarioAtoPraticado';
    $(_id).select2().empty();
    $(_id).select2({'placeholder': 'Selecione um ato praticado'});
}

function atualizarAto(tipoDeDocumentoId, onComplete) {
    if(cadastroIncompleto){
        if(hasFormLocalStorage()){
            return;
        }
    }
    
    limparAtoPraticado();

    if(!tipoDeDocumentoId){
        return;
    }

    url = `/peticionamento_intermediarios/get_atos`;
    if(tipoDeDocumentoId){
        url += `/${tipoDeDocumentoId}`;
    }
    
    showCustomLoading();
    $.ajax({
        url: url,
        type: "GET",
        success: function(data) {
            let atos = JSON.parse(data.trim());
            let temAssociacao = (atos.length != 0);

            var idsAtos = [];
            $("#PeticionamentoIntermediarioAtoPraticado").select2({
                placeholder: "Selecione um ato praticado",
                tags: true,
                allowClear: true,
                maximumSelectionLength: 1,
                language: {
                    maximumSelected: () => 'Apenas 1 ato pode ser selecionado.'
                },
                data: listaTodosAtosPraticados.map((item) => {
                    return {'id': item.ato.id, 'text': item.ato.nome};
                })
            });
            
            var usarIdsAtos = false;
            if(carregouAtoPraticado || !valorAtoPraticado || valorAtoPraticado.length === 0){
                usarIdsAtos = true;
            }

            if(usarIdsAtos){
                
                for (let i = 0; i < atos.length; i++) {
                    idsAtos.push(atos[i]['ato']['id']);
                }

                if(idsAtos.length > 0 && temAssociacao) {
                    $("#PeticionamentoIntermediarioAtoPraticado").val(idsAtos).trigger('change');
                }
                
            }else{
                $("#PeticionamentoIntermediarioAtoPraticado").val(valorAtoPraticado).trigger('change');
                carregouAtoPraticado = true;
            }

        },
        error: function(error) {
            alert('Não foi possível listar os atos praticados.')
        },
        complete: function(jqXHR, textStatus) {
            if(onComplete) {
                onComplete();
            }
            hideCustomLoading();
        }
    });
}

$('#PeticionamentoIntermediarioAtoPraticado').on('change', function(){
    salvarProgresso();
});