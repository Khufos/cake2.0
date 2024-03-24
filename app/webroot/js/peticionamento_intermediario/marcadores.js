function gerenciarMarcador(id, urlPag) {
    $.ajax({
        url: '/peticionamento_intermediarios_marcadores/marcador/' + id + '?urlAtual=' + urlPag + '&trs=1',
        type: "GET",
        datatype: 'html',
        success: function(data) {
            $("#marcadorExpediente").html(data);
            $('#addMarcador').modal({
                keyboard: false,
                backdrop: 'static'
            });
        }
    });
}