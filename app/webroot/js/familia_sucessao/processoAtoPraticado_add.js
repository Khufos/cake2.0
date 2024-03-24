$(document).ready(function(){

    $('#edit-processoAtoPraticado').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-processoAtoPraticado');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/pasta_processos/save_atoPraticado',
            data: $form.serialize(),
            success: function(data){
                console.log(data);
                if(data != '0' &&  data != 1)
                {
                    data = data.split(',');
                    //$('#modal').modal('hide');
                    var $tds = $('#v'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[1]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[3]);
                    $($tds[3]).text(data[4]);
                   // $($tds[4]).text(data[5]);
                    $('#edit-alert-success-processoAtoPraticado').show(800).delay(800).hide(800);
                    reloadTabelaAtoPraticadoProcesso();
                }else if(data == 1){
                    alert("Vínculo com defensor não encontrado, por favor entre em contato com o CMO.");
                    //$('#edit-alert-danger-acaoJudicial').val("Vínculo não encontrado, por favor entre em contato com o CMO.").show(800).delay(800).hide(800);
                    //$('#edit-alert-danger-acaoJudicial').show(800).delay(800).hide(800);
                }else{
                    $('#modal').modal('hide');
                    $('#edit-alert-danger-processoAtoPraticado').show(800).delay(800).hide(800);
                }
            }
        });
    });

   
    
});
