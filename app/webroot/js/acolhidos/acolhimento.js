$(document).ready(function(){
    $('a.delete').click(function(){
        if (confirm("Tem certeza que deseja excluir?"))
        {
            var id = this.id;
            $.post(window.location.origin+'/pa_acolhimentos/delete/'+id.substring(2), function(data){
                if(data)
                {
                    $('#'+id).parents('tr').hide();
                    $('#remove-acolhimento').show(800).delay(800).hide(800);
                }else{
                    alert('Acolhimento não pôde ser excluído, por favor tente novamente.')
                }
            });
        }
    });
});
