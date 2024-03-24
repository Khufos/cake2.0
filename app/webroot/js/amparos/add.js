$(document).ready(function () {
    $('#AmparoTipoMorteId').on("change", function () {
        if($(this).val() == 2){
            $("#modalidades").css("display", "block");
        }else{
            $("#modalidades").css("display", "none");
        }
    });
    
    
});
function diferencaDias(dataInicial, dataFinal, idDif) {
    var mes, arrDataInicial, novaDataInicial, diasEntreDatas, arrDataFinal, novaDataFinal;
    mes = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    
    arrDataFinal = dataFinal.split('/');
    arrDataInicial = dataInicial.split('/');
    novaDataInicial = mes[(arrDataInicial[1] - 1)] + ' ' + arrDataInicial[0] + ' ' + arrDataInicial[2];
    novaDataFinal = mes[(arrDataFinal[1] - 1)] + ' ' + arrDataFinal[0] + ' ' + arrDataFinal[2];
    diasEntreDatas = dateDif.dateDiff(novaDataInicial, novaDataFinal);
    
//    $("#" + idDif).html(diasEntreDatas + "dias");
    $("#" + idDif).val(diasEntreDatas);
}