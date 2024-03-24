$(document).ready(function(){
    $('a.delete-familiaSucessao').click(function(){
        if (confirm("Tem certeza que deseja excluir?"))
        {
            var id = this.id;
            console.log(id);
            $.post(window.location.origin+'/familia_sucessoes/delete/'+id.substring(1), function(data){
                if(data){
                    $('#'+id).parents('tr').hide();
                    $('#remove-familiaSucessao').show(800).delay(800).hide(800);
                }else{
                    alert('Família Sucessão não pôde ser excluído, por favor tente novamente.')
                }
            });
        }
    });
});
