$(document).ready(function(){
    $('#edit-historico').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-historico');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/pa_historicos/save',
            data: $form.serialize(),
            success: function(data){
                if(data != '0')
                {
                    data = data.split('*');
                    $('#modal').hide();
                    var $tds = $('#h'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[1]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[4]);
                    $($tds[4]).text(data[3]);
                    $('#edit-alert-success-historico').show(800).delay(800).hide(800);
                    setTimeout(alert("Editado com Sucesso!", 2000));
                    window.location.reload();
                }else{
                    $('#modal').hide();
                    $('#edit-alert-danger-historico').show(800).delay(800).hide(800);
                }
            }
        });
    });
});
