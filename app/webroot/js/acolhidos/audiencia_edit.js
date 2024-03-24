$(document).ready(function(){
    $(".data").unbind().datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:2020',
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], // For formatting
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'], // Column headings for days starting at Sunday
        dateFormat: 'dd/mm/yy', // See format options on parseDate
        buttonImageOnly: true,
        buttonText: 'Calendário',
        showOn: 'button',
        buttonImage: endImageCalendario
    });

    $('.data').mask('99/99/9999');
    
    $('#edit-audiencia').submit(function(e){
        e.preventDefault();
        var $form = $('#edit-audiencia');

        $.ajax({
            type: "POST",
            url: window.location.origin + '/audiencias/save_acolher',
            data: $form.serialize(),
            success: function(data){
                if(data != '0')
                {
                    data = data.split(',');
                    $('#modal').hide();
                    var $tds = $('#a'+$.trim(data[0])).parents('tr').find('td');
                    $($tds[0]).text(data[2]);
                    $($tds[1]).text(data[1]);
                    $('#edit-alert-success-audiencia').show(800).delay(800).hide(800);
                }else{
                    $('#modal').hide();
                    $('#edit-alert-danger-audiencia').show(800).delay(800).hide(800);
                }
            }
        });
    });
});
