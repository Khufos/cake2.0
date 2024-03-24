$(document).ready(function(){
    $('a.delete-historico').click(function(){
        if (confirm("Tem certeza que deseja excluir?"))
        {
            var id = this.id;
            $.post(window.location.origin+'/pa_historicos/delete/'+id.substring(1), function(data){
                if(data)
                {
                    $('#'+id).parents('tr').hide();
                    $('#remove-historico').show(800).delay(800).hide(800);
                }else{
                    alert('Histórico não pôde ser excluído, por favor tente novamente.')
                }
            });
        }
    });
});
