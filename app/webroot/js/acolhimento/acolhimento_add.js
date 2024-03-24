$(document).ready(function(){
    
    
    $('#cadAcolhimento').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: window.location.origin + '/ai_acolhido_acolhimentos/registrar?trs=1',
                data: $('.acolhimento').serialize(),
                success: function(data){
                    if(data != '0')
                    {
                        $("#tabela_acolhimentos th:last").remove();
                        data = data.split('**');
                        $("#listaAcolhimentos table").append('<tr><td>'+ data[0] +'</td>' +
                                '<td>'+ data[1] +'</td>' +
                                '<td>'+ data[2] +'</td>' +
                                '<td>'+ data[3] +'</td>' +
                                '<td>'+ data[4] +'</td>' +
                                '<td>'+ data[6] +'</td>' +
                                '<td>'+ data[7] +'</td>' +
                                '<td class="actions">'+ '<a href="/ai_acolhido_acolhimentos/edit/'+data[5]+'" title="Editar Institucionalização" text-decoration="none" target="_blank" class="link-modal" data-target="#modal" data-toggle="modal"><div class="glyphicon glyphicon-edit"></div></a>' + 
                                        '<a id="acolhimento'+data[5]+'" class="delete-acolhimento" onclick="excluiAcolhimento('+data[5]+')"><div class="glyphicon glyphicon-trash"></div></a></td></tr>');
                        $('#cadAcolhimento').each (function(){
                            this.reset();
                          });
                        $('#edit-alert-success').show(800).delay(800).hide(800);
                    }else{
                        $('#edit-alert-danger').show(800).delay(800).hide(800);
                    }
                }
            });
    });
});

function excluiAcolhimento(id)
{   
    if (confirm("Tem certeza que deseja excluir?"))
        {
            $.post(window.location.origin+'/ai_acolhido_acolhimentos/excluir/'+id, function(data){
                if(data){
                    $('#acolhimento'+id).parents('tr').hide();
                    $('#remove-vinculo').show(800).delay(800).hide(800);
                }else{
                    alert('Institucionalização não pôde ser excluída, por favor tente novamente.');
                }
            });
        }
}

