$(document).ready(function(){
    $(".data").datepicker("destroy");
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

    $('#edit-acolhidoAcolhimento').submit(function(e){;
        $('body').removeClass('modal-open');
        e.preventDefault();
        var $form = $('#edit-acolhidoAcolhimento');

        $.ajax({
            type: "POST",
//            url: window.location.origin + '/pa_acolhimentos/save',
            url: window.location.origin + '/ai_acolhido_acolhimentos/salvar?trs=1',
            data: $form.serialize(),
            success: function(data){
                if(data != '0')
                {
                    
                    data = data.split('**');
//                    console.log(data[1]);
                    $('#modal').hide();
                    
                    var $tds = $('#acolhimento'+data[4]).parents('tr').find('td');
                    $($tds[1]).text(data[0]);
                    $($tds[2]).text(data[1]);
                    $($tds[3]).text(data[2]);
                    $($tds[4]).text(data[3]);
                    $($tds[5]).text(data[5]);
                    $($tds[6]).text(data[6]);
                    $('#edit-alert-success').show(800).delay(800).hide(800);
                }else{
                    $('#modal').hide();
                    $('#edit-alert-danger').show(800).delay(800).hide(800);
                }
            }
        });
    });
});
