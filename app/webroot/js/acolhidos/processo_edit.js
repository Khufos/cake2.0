$(document).ready(function(){
    $('.numeracao').mask('9999999-99.9999.999.9999');

    $('#edit-processo').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-processo');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/pa_acolhidos/saveProcessoAcolhimento',
            data: $form.serialize(),
            success: function(data){
                if(data != '0')
                {
                    data = data.split(',');
                    $('#modal').hide();
                    var $tds = $('#p'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[1]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[3]);
                    $($tds[3]).text(data[4]);
                    $($tds[4]).text(data[6]);
                    $('#edit-alert-success-processo').show(800).delay(800).hide(800);
                    setTimeout(alert("Editado com Sucesso!", 2000));
                    window.location.reload();
                }else{
                    $('#modal').hide();
                    $('#edit-alert-danger-processo').show(800).delay(800).hide(800);
                }
            }
        });
    });
});
