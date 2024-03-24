$(document).ready(function(){
    $('a.delete-processo').click(function(){
        if (confirm("Tem certeza que deseja excluir?"))
        {
            var id = this.id;
            $.post(window.location.origin+'/processos/deleteAcolhido/'+id.substring(1), function(data){
                if(data){
                    $('#'+id).parents('tr').hide();
                    $('#remove-processo').show(800).delay(800).hide(800);
                }else{
                    alert('Acolhimento não pôde ser excluído, por favor tente novamente.')
                }
            });
        }
    });
});
