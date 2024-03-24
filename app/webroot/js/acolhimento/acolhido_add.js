$(document).ready(function(){
    
    
    $('#cadAcolhido').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: window.location.origin + '/ai_acolhidos/registrar?trs=1',
                data: $('.acolhido').serialize(),
                success: function(data){

                    if(data != '0')
                    {
                        $("#tabela_acolhidos th:last").remove();
                        data = data.split('**');
                        $("#listaAcolhidos table").append('<tr><td>'+ data[0] +'</td>' +
                                '<td>'+ data[1] +'</td>' +
                                '<td>'+ data[2] +'</td>' +
                                '<td class="actions">'+ '<a href="/ai_acolhidos/edit/'+data[3]+'" title="Editar acolhido" text-decoration="none" target="_blank" class="link-modal" data-target="#modal" data-toggle="modal"><div class="glyphicon glyphicon-edit"></div></a>' + 
                                        '<a id="acolhido'+data[3]+'" class="delete-acolhido" onclick="excluiAcolhido('+data[3]+')"><div class="glyphicon glyphicon-trash"></div></a></td></tr>');
                        atualizaComboAcolhidos(data[4]);
                        $('#cadAcolhido').each (function(){
                            this.reset();
                          });
                          $('#AiAcolhimentoId').val(data[4]);
                        $('#edit-alert-success').show(800).delay(800).hide(800);
                    }else{
                        $('#edit-alert-danger').show(800).delay(800).hide(800);
                    }
                }
            });
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