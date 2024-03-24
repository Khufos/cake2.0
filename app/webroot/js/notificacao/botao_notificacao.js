$(document).ready(function(){
    
    $("#dialog").dialog({
    autoOpen : false, modal : true, show : "blind", hide : "blind"
  });

  // next add the onclick handler
  $("#contactUs").click(function() {
    $("#dialog").dialog("open");
    return false;
  });
  
    $('.informarAssitido').on('click', function(){
        var idAcaoHistorico = $(this).attr('id');
        idAcaoHistorico = idAcaoHistorico.substring(2);
        
        var idAssistido = $('#AcaoAssistidoId').val();
        var url = $('#NotificacaoUrl').val();
        
       $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Sim": function() {
          var janela = $(this);
          $.post("/notifica_assistidos/informar", 
          {idAssistido: idAssistido, idAcaoHistorico: idAcaoHistorico, url: url}, 
          function( data ) {
            if(data != 0){
                janela.dialog( "close" );
                $('#email-alert-success').show(800).delay(800).hide(800);
                setTimeout(alert("E-mail enviado com sucesso!", 2000));
            }else{
                $('#email-alert-danger').show(800).delay(800).hide(800);
                setTimeout(alert("Não foi possível enviar o e-mail", 2000));
            }
            $('#notificadoSimNao').text('Sim');
          });
        },
        Não: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    });
});
/*

  $( function() {
    
  } );
*/