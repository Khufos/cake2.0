$(document).ready(function(){
    $(".data").unbind().datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:2021',
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], // For formatting
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'], // Column headings for days starting at Sunday
        dateFormat: 'dd/mm/yy', // See format options on parseDate
        buttonImageOnly: true,
        buttonText: 'Calendário',
        showOn: 'button',
        buttonImage: endImageCalendario
    });

    $('.data').mask('99/99/9999');

    $('#edit-acolhimento').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-acolhimento');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/pa_acolhimentos/save',
            data: $form.serialize(),
            success: function(data){
                if(data != '0')
                {
                    data = data.split(',');
                    $('#modal').hide();
                    var $tds = $('#ac'+data[5]).parents('tr').find('td');
                    $($tds[0]).text(data[0]);
                    $($tds[1]).text(data[2]);
                    $($tds[2]).text(data[3]);
                    $('#edit-alert-success').show(800).delay(800).hide(800);
                    setTimeout(alert("Editado com Sucesso!", 2000));
                    window.location.reload();
                }else{
                    $('#modal').hide();
                    $('#edit-alert-danger').show(800).delay(800).hide(800);
                }
            }
        });
    });
});
