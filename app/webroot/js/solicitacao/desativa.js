$(document).ready(function () {
    $("#btnCancela").click(function (event) {
        /*var data_dd = document.querySelector("input[name='motivo_cancelamento']").value;
        if(data_dd.length != 20){
           alert("Informe um mínimo de 20 caracteres");
           return false;
        }*/
        if ($("#SolicitacaoAuditoria").validationEngine('validate')) {
            var form = $("#SolicitacaoAuditoria");
            $.ajax({
                type: "POST",
                url: window.location.origin + '/solicitacoes/updatdesativa',
                data: form.serialize(),
                success: function (response) {
                    if(response != '0')
                    {
                        $('#modal').hide();                        
                        $('#cancela-alert-success').show(800).delay(800).hide(800);
                        setTimeout(alert("Solicitação cancelada com Sucesso!", 2000));
                        $("#here").load(window.location.href + " #here" );
                    }else{
                        $('#modal').hide();
                        $('#cancela-alert-danger').show(800).delay(800).hide(800);
                    }
                }
            });
        }
        
        event.preventDefault();
    });

    $(document).on("input", "#SolicitacaoAuditoriaMotivoCancelamento", function () {
        var limite = 300;
        var caracteresDigitados = $(this).val().length;
        if(caracteresDigitados >= 20){
            document.getElementById("btnCancela").disabled = false; 
        }else{
            document.getElementById("btnCancela").disabled = true; 
        }
        var caracteresRestantes = limite - caracteresDigitados;

        $(".caracteres").text(caracteresRestantes);
    });
    

});
