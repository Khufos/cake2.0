$(document).ready(function(){

    $('#edit-familiaSucessao').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-familiaSucessao');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/familia_sucessoes/save_familiaSucessoes',
            data: $form.serialize(),
            success: function(data){
                
                if(data != '0')
                {
                    data = data.split(',');
                    $('#modal').modal('hide');
                    var $tds = $('#v'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[1]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[3]);
                    $($tds[3]).text(data[4]);
                    $($tds[4]).text(data[5]);
                    $($tds[5]).text(data[6]);
                    $($tds[6]).text(data[7]);
                    $('#edit-alert-success-familiaSucessao').show(800).delay(800).hide(800);
                }else{
                    $('#modal').modal('hide');
                    $('#edit-alert-danger-familiaSucessao').show(800).delay(800).hide(800);
                }
            }
        });
    });   
});
