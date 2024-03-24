$(function () {

    $("select").select2();

    Highcharts.setOptions({
        lang: {
            months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            shortMonths: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            loading: ['Atualizando o gráfico...aguarde'],
            contextButtonTitle: 'Exportar gráfico',
            decimalPoint: ',',
            thousandsSep: '.',
            downloadJPEG: 'Baixar imagem JPEG',
            downloadPDF: 'Baixar arquivo PDF',
            downloadPNG: 'Baixar imagem PNG',
            downloadSVG: 'Baixar vetor SVG',
            printChart: 'Imprimir gráfico',
            rangeSelectorFrom: 'De',
            rangeSelectorTo: 'Para',
            rangeSelectorZoom: 'Zoom',
            resetZoom: 'Limpar Zoom',
            resetZoomTitle: 'Voltar Zoom para nível 1:1',
        }
    });

    Highcharts.chart('containerDias', {
        data: {
            table: 'tableDias'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Petições por unidade judicial'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Quantidade'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.point.name + '</b><br/>' +
                    this.point.y + ' ' + this.series.name ;
            }
        }
    });

    Highcharts.chart('containerResum', {
        data: {
            table: 'tableResum'
        },
        chart: {
            type: 'column',
        },
        title: {
            text: 'Petições protocoladas e em rascunho'
        },
        legend: {
            enabled: false
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Quantidade'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.point.name + '</b><br/>' +
                    this.point.y;
            }
        }
    });

    Highcharts.chart('containerHistorico', {
        data: {
            table: 'tableHistorico'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: 'Petições por período'
        },
        legend: {
            enabled: false
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Quantidade'
            }
        },
        tooltip: {
            formatter: function () {
                return this.point.y+' petições';
            }
        }
    });

    if(typeof substituicaoSelecionada !== 'undefined'){
        $('#filtro-substituicao').val(substituicaoSelecionada).trigger('change');
    }
    
    if(typeof unidadeJudicialSelecionada !== 'undefined'){
        $('#filtro-unidade').val(unidadeJudicialSelecionada).trigger('change');
    }

    if(typeof dataInicialSelecionada !== 'undefined'){
        $('#filtro-data-inicial').val(dataInicialSelecionada);
    }

    if(typeof dataFinalSelecionada !== 'undefined'){
        $('#filtro-data-final').val(dataFinalSelecionada);
    }

});

function validateDate(dateString, errorMessage, inputElement) {
    var dateParts = dateString.split('/');
    var formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

    if (dateString !== '' && !Date.parse(formattedDate)) {
        alert(errorMessage);
        inputElement.focus();
        return false;
    }

    return formattedDate;
}

$("#formFiltro").submit(function (event) {
    var dataLimiteI = $("#filtro-data-inicial").val();
    var dataLimiteF = $("#filtro-data-final").val();

    var dataLimiteI2 = validateDate(dataLimiteI, 'Data inicial inválida', $("#filtro-data-inicial"));
    var dataLimiteF2 = validateDate(dataLimiteF, 'Data final inválida', $("#filtro-data-final"));

    if (dataLimiteI2 && dataLimiteF2 && new Date(dataLimiteF2) < new Date(dataLimiteI2)) {
        alert('A data inicial deve ser menor ou igual à data final');
        return false;
    }

    return true;
});

$("#btnLimparCampos").on('click', function() {
    $("#filtro-data-inicial").val('');
    $("#filtro-data-final").val('');
    $('#filtro-unidade').val('').trigger('change');
    $('#filtro-substituicao').val('').trigger('change');
    $('#formFiltro').submit();
});