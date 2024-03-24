$(document).ready(function(){
    $('a.delete-acolhimento').click(function(){
        if (confirm("Tem certeza que deseja excluir?"))
        {
            var id = this.id;
            $.post(window.location.origin+'/ai_acolhido_acolhimentos/excluir/'+id.substring(11), function(data){
                if(data){
                    $('#'+id).parents('tr').hide();
                    $('#remove-acolhimento').show(800).delay(800).hide(800);
                }else{
                    alert('Vínculo não pôde ser excluído, por favor tente novamente.');
                }
            });
        }
    });
});
