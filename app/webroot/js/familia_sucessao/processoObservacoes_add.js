$(document).ready(function(){

    $('#edit-acaoJudicialObservacao').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-acaoJudicialObservacao');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/pasta_processos/save_observacoes',
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
                    $($tds[3]).text(data[4]);
                    $($tds[4]).text(data[5]);
                    $('#edit-alert-success-acaoJudicialObservacao').show(800).delay(800).hide(800);
                    reloadTabelaObservacaoProcesso();
                }else{
                    $('#modal').modal('hide');
                    $('#edit-alert-danger-acaoJudicialObservacao').show(800).delay(800).hide(800);
                }
            }
        });
    });

   
    
});
