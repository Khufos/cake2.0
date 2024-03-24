$(document).ready(function(){
    $('a.delete-vinculo').click(function(){
        if (confirm("Tem certeza que deseja excluir?"))
        {
            var id = this.id;
            $.post(window.location.origin+'/partes/delete/'+id.substring(1), function(data){
                if(data){
                    $('#'+id).parents('tr').hide();
                    $('#remove-vinculo').show(800).delay(800).hide(800);
                }else{
                    alert('Vínculo não pôde ser excluído, por favor tente novamente.')
                }
            });
        }
    });
});
