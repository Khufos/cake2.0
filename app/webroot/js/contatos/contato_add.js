$(document).ready(function(){      
    
    $("#submitContatoNovo").click(function (event) {        
        tinyMCE.triggerSave();
        var form = document.getElementById('formFundiario');        
        var formData = new FormData(form);        
        $.ajax({
            type: "POST",
            //url: window.location.origin + '/contatos/add_contato_model/'+ form + '/' + idModel + '?trs=1',            
            url: window.location.origin + '/contatos/add_contato_model?trs=1',            
            data: formData,
            success: function (response) {
                $('#resContato').html(response);
            }
        });
        return false;
        
        event.preventDefault();
    });
    
    

});

function excluiAcolhido(id)
{   
    if (confirm("Tem certeza que deseja excluir?"))
        {
            $.post(window.location.origin+'/ai_acolhidos/excluir/'+id, function(data){
                if(data){
                    $('#acolhido'+id).parents('tr').hide();
                    $('#remove-vinculo').show(800).delay(800).hide(800);
                }else{
                    alert('Vínculo não pôde ser excluído, por favor tente novamente.');
                }
            });
        }
}

function atualizaComboAcolhidos(idAcolhimento)
{
    
    $.ajax({
        type: "POST",
        url: window.location.origin + '/ai_acolhidos/comboAcolhidos/'+idAcolhimento+'?trs=1',
//        data: $('.acolhido').serialize(),
        success: function(data){
            console.log(data);
            obj = JSON.parse(data);
            var options = $('#AiAcolhidoAcolhimentoAcolhidoId');
        options.empty();
        options.append("<option value=''>Selecione</option>");
        $.each(obj, function (i, item) {
            options.append("<option value='"+i+"'>"+item+"</option>");
        });
            
        }
    });
}