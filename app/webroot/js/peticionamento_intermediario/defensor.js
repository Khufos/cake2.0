$('#PeticionamentoIntermediarioDefensor').on('change', function(ev) {
    getUnidadeDefensorialByDefensor();
});

function getUnidadeDefensorialByDefensor(){
    
    var atualDefensorId = $('#PeticionamentoIntermediarioDefensor').val();
    $("#DefensorId").val(atualDefensorId);

    if(!atualDefensorId){
        return;
    }

    $.ajax({
        url: "/peticionamento_intermediarios/obter_unidade_defensorial_comarca/",
        method: 'GET',
        data: {
            defensorId: atualDefensorId
        },
        success: function(response) {

            response = response.replace(/(\r\n|\n|\r)/gm, "");
            response = response.replaceAll('"', "");
            response = response.replaceAll('[', "");
            response = response.replaceAll(']', "")
            response = response.split(',');

            if(response.length != 2 || !response[0] || !response[1]){
                return;
            }

            var unidDefTemp = response[0].toString().trim();
            // var comarcaTemp = response[1].toString().trim();

            $('#UnidadeDefensoriaisNome').val(unidDefTemp).trigger('change');
            // $('#PeticionamentoIntermediariosComarcaIdSelect').val(comarcaTemp).trigger('change');

        },
        error: function(xhr, status, error) {
            alert('Não foi possível atualizar os campos de unidade defensorial e comarca.');
        }
    });
    
}