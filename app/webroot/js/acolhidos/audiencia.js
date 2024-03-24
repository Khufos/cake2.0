$(document).ready(function(){
    $('a.delete-audiencia').click(function(){
        if (confirm("Tem certeza que deseja excluir?"))
        {
            var id = this.id;
            $.post(window.location.origin+'/audiencias/delete_acolher/'+id.substring(1), function(data){
                if(data){
                    $('#'+id).parents('tr').hide();
                    $('#remove-audiencia').show(800).delay(800).hide(800);
                }else{
                    alert('Audiência não pôde ser excluído, por favor tente novamente.')
                }
            });
        }
    });
});
