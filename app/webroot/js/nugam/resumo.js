function getResumo(assistidoId) {
    $.ajax({
        url: "/nugam_atendimentos/resumo/"+assistidoId+'/trs=1',
        type: "POST",
        dataType: "json",
        success: function(data) {
            $("#gridResumo").html("");
            if (data.length > 0) {
//                $("#total_audiencias").html(data.length);
                loadGrid(data, "#gridResumo");
//                if (load_modal) {
//                loadGrid(data, "#audiencias-modal");
//                }
            } 
        }
    });
}
$(document).ready(function(){
    $.ajax
});
exibirUnidadePrisional();


 
