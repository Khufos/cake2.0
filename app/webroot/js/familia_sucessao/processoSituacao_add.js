$(document).ready(function(){

    $('#edit-processoSituacao').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-processoSituacao');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/pasta_processos/save_situacaoProcessual',
            data: $form.serialize(),
            success: function(data){
                if(data != '0')
                {
                    data = data.split(',');
                    //$('#modal').modal('hide');
                    var $tds = $('#v'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[1]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[3]);
                    //$($tds[3]).text(data[4]);
                   // $($tds[4]).text(data[5]);
                    $('#edit-alert-success-processoSituacao').show(800).delay(800).hide(800);
                    reloadTabelaSituacaoProcesso();
                }else{
                    $('#modal').modal('hide');
                    $('#edit-alert-danger-processoSituacao').show(800).delay(800).hide(800);
                }
            }
        });
    });

   
    
});
