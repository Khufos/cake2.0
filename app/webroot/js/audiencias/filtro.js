$(document).ready(function(){
    $('#AudienciaAddEmLoteForm').submit(function(e){
        if($('input:checked').length == 0)
        {
            e.preventDefault();
            alert('É preciso selecionar pelo menos um assistido');
        }
    });

    $('#PaInstituicaoId').change(function(){
        var abrigo = $(this).val();
        $('tr.filtro').each(function(i,e){
            if($(e).data('abrigo') != abrigo && abrigo != "")
            {
                $(e).hide();
            } else {
                $(e).show();
            }
        });
    });

    $('#todos').click(function(){
        cheked_by_abrigo($('#PaInstituicaoId').val());
    });
});

var cheked_by_abrigo = function(abrigo){
    $('[name="Assistidos[]"]').each(function(i,e){
        if ($(e).parents('tr').data('abrigo') == abrigo)
        {
            var $checked = !$(e).prop('checked');
            $(e).prop('checked', $checked);
            $(e).attr('checked', $checked);
        }

        if(abrigo == "")
        {
            var $checked = $('#todos').prop('checked');
            $(e).prop('checked', $checked);
            $(e).attr('checked', $checked);
        }
    })
}
