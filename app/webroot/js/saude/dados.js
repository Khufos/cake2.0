$(document).ready(function(){
    $('#SaudeDemandado').on("change", function () {
        if($(this).val() == 1 || $(this).val() == 3){
            $("#municipios").css("display", "block");
        }else{
            $("#municipios").css("display", "none");
        }
    });
    $('#SaudeFalecimento').on("change", function () {
        if($(this).val() == 1){
            $("#DataObito").css("display", "block");
        }else{
            $("#DataObito").css("display", "none");
        }
    });
    $("#SaudeTipoInternamentoHospitalarTipoInternamento").on("change click", function () { 
        var arr = [];
        $( "#SaudeTipoInternamentoHospitalarTipoInternamento option:selected" ).each(function() {
          arr.push($(this).text());
        });

        if($.inArray("Outros", arr) !== -1){
            $( "#SaudesInternamentos" ).css( "display", "block" );
        }else{
            $( "#SaudesInternamentos" ).css( "display", "none" );
        }
    });
})
