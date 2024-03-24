$(document).ready(function(){

    $('#edit-observacoes').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-observacoes');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/pastas_observacoes/save_observacoes',
            data: $form.serialize(),
            success: function(data){
                console.log(data);
                if(data != '0')
                {
                    data = data.split(',');
                    $('#modal').modal('hide');
                    var $tds = $('#v'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[1]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[3]);
      
                    $('#edit-alert-success-observacoes').show(800).delay(800).hide(800);
                    reloadObservacoesTable();

                    if($($tds[3]).text(data[4])){
                        alert("E-mail enviado com sucesso.");
                    }else{
                        alert("E-mail não pode ser enviado.");
                    }

                }else{
                    $('#modal').modal('hide');
                    $('#edit-alert-danger-observacoes').show(800).delay(800).hide(800);
                }
                
            }
        });
    });

   
    
});
