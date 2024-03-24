$(document).ready(function(){

    $('#edit-acordoExtrajudiciais').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-acordoExtrajudiciais');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/pasta_acordo_extrajudiciais/save_acordoExtrajudiciais',
            data: $form.serialize(),
            success: function(data){
                if(data != '0')
                {
                    data = data.split(',');
                    //$('#modal').hide();// Com esta forma quebra a barra de rolagem
                    $('#modal').modal('hide');//Nesta versão do bootstrap só funciona desta forma
                    var $tds = $('#v'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[1]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[3]);
                    $($tds[3]).text(data[4]);
                    $($tds[4]).text(data[5]);
                    $('#edit-alert-success-acordoExtrajudicial').show(800).delay(800).hide(800);
                    reloadAcordoExtrajudicialTable();
                }else{
                    $('#modal').modal('hide');
                    $('#edit-alert-danger-acordoExtrajudicial').show(800).delay(800).hide(800);
                }
            }
        });
    });

   
    
});
