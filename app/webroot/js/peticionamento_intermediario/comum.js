function carregaMascaraNumeracaoUnica(numeracaoUnica){
    if(numeracaoUnica.includes(".") || numeracaoUnica.includes("-")){
        return numeracaoUnica;
    }
    return numeracaoUnica.replace(/^(\d{7})(\d{2})(\d{4})(\d{1})(\d{2})(\d{4}).*/, '$1-$2.$3.$4.$5.$6');
}

function formatCpfCnpj(cpfCnpj) {
    cpfCnpj = cpfCnpj.replace(/\D/g, '');

    if (cpfCnpj.length === 11) {
        return cpfCnpj.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    } else if (cpfCnpj.length === 14) {
        return cpfCnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
    } else {
        return cpfCnpj;
    }
}

function getDataBR(date) {
    var retorno = date.split("-");
    var dataFormatada =
        retorno[2].substring(0, 2) + "/" + retorno[1] + "/" + retorno[0];

    return dataFormatada;
}

function atualizarPagina() {
    location.reload();
}

function expandirPainel(idPanel){
    var panelAberto = $(idPanel + ' div.header-panel i').hasClass("fa-caret-down");
    if(panelAberto){
        $(idPanel + ' div.header-panel i').removeClass("fa-caret-down");
        $(idPanel + ' div.header-panel i').addClass("fa-caret-up");

        $(idPanel + ' div.header-panel').addClass("border-radius-4");
        $(idPanel + ' div.well').addClass("painel-recolhido");
    }else{
        $(idPanel + ' div.header-panel i').removeClass("fa-caret-up");
        $(idPanel + ' div.header-panel i').addClass("fa-caret-down");

        $(idPanel + ' div.header-panel').removeClass("border-radius-4");
        $(idPanel + ' div.well').removeClass("painel-recolhido");
    }
}