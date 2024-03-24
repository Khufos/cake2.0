var dblclick_linha = function (el){
    $('#'+el+'_table tr').unbind();
    $('#'+el+'_table tr').dblclick(function(e){
        e.preventDefault();
        editar($(this));
    })
}

var bind_event_editar = function(){
    $('.editar').unbind();
    $('.editar').click(function(e){
        e.preventDefault();
        var tr = $(this).parents('tr');
        editar(tr);
    })

    dblclick_linha('af');
    dblclick_linha('cg');
    dblclick_linha('spe');
    dblclick_linha('sp');
    dblclick_linha('sip');
}

var bind_event_excluir = function(){
    $('.excluir').unbind();
    $('.excluir').click(function(e){
        e.preventDefault();
        if(confirm("Deseja, realemente, excluir esse registro?"))
        {
            $(this).parents('tr').remove();
        }
    })
}

$(document).ready(function(){
//    $('#usuario-id').select2();
//    $('#def-form').validator();
//Adicionar linha cargo
    $('#filho_add').on('click', function(e){
        e.preventDefault();
        var n_cg = parseInt($('#n_cargos').val())+1;
        var nome = $('#FilhoPessoaNome').val();
        var dt_nasc = $('#FilhoPessoaFisicaDataNascimento').val();
        var sexo = $('#FilhoPessoaFisicaSexo').val();
        var options = $('#sexo').html();

        
            var tr = "<tr>\
                <td>\
                    <span>"+nome+"</span>\
                    <input type='text' name='APessoa["+n_cg+"][data_inicio]' class='dp form-control' value='"+nome+"' style='display:none'>\
                </td>\
                <td>\
                    <span>"+dt_nasc+"</span>\
                    <input type='text' name='APessoaFisica["+n_cg+"][data_fim]' class='dp form-control' value='"+dt_nasc+"' style='display:none'>\
                </td>\
                <td>\
                    <span>"+$('#sexo option:selected').text()+"</span>\
                    <select name='APessoaFisica["+n_cg+"][unidade_id]' class='form-control' style='display:none'>"+options+"</select>\
                </td>\
                <td>\
                    <button class='btn btn-info btn-xs editar'>Editar</button>\
                    <button class='btn btn-danger btn-xs excluir'>Excluir</button>\
                </td>\
            </tr>";

            $('#n_cargos').val(n_cg);
            $('#cg_table').append(tr);
            $('#cg_table').find('tr').last().find('select').val(sexo);

            bind_event_editar();
            bind_event_excluir();

            $('#cg_dt_inicio').val("");
            $('#cg_dt_fim').val("");
            $('#cg_cargo').val(1);
            $('#cg_observacao').val("");
        
    });
});