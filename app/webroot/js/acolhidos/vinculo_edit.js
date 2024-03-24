$(document).ready(function(){
    $('#edit-vinculo').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-vinculo');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/partes/save_acolher',
            data: $form.serialize(),
            success: function(data){
                if(data != '0')
                {
                    data = data.split(',');
                    $('#modal').hide();
                    var $tds = $('#v'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[1]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[3]);
                    $('#edit-alert-success-vinculo').show(800).delay(800).hide(800);
                }else{
                    $('#modal').hide();
                    $('#edit-alert-danger-vinculo').show(800).delay(800).hide(800);
                }
            }
        });
    });
});
