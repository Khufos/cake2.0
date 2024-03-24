$(document).ready(function () {

    $(".formValidate").validationEngine({
        validationEventTrigger: "change"
    });
    /* Mostra o loading quando uma requisição Ajax se inicia */
    $(document).ajaxStart(function () {
        $("#loading").show();
    });
    /* Oculta o loading quando uma requisição Ajax finaliza */
    $(document).ajaxComplete(function () {
        $("#loading").hide();
        $(".tablesorter").tablesorter();
    });
    $(document).ajaxError(function () {
        $("#loading").hide();
    });

    /* Mascar campo para valor */
    $("body").delegate(".maskMoney", "focus", function () {
        $(this).setMask({
            mask: '99,999.999.999.999',
            type: 'reverse',
            defaultValue: ''
        });
    });

//    $("table").tablesorter({
//        sortList: [[0, 0], [2, 0]],
//        headers: {
//            5: {
//                sorter: false
//            }
//        }
//    });

    $('body').delegate(".telefone", "keypress", function () {
        mascaraTel(this, mtel);
    });

    atualizaBotao();
    refreshEditor();
    refreshJquery();
    botoes();
});

// run the currently selected effect
function runEffect() {
    // run the effect
    $("#resPesquisa").show('fold', 800);
}

var dateDif = {
    dateDiff: function (strDate1, strDate2) {
        return (((Date.parse(strDate2)) - (Date.parse(strDate1))) / (24 * 60 * 60 * 1000)).toFixed(0);
    }
}

function diferenca(dataInicial, dataFinal, idDif) {
    var mes, arrDataInicial, novaDataInicial, diasEntreDatas, arrDataFinal, novaDataFinal;
    mes = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    arrDataFinal = dataFinal.split('/');
    arrDataInicial = dataInicial.split('/');
    novaDataInicial = mes[(arrDataInicial[1] - 1)] + ' ' + arrDataInicial[0] + ' ' + arrDataInicial[2];
    novaDataFinal = mes[(arrDataFinal[1] - 1)] + ' ' + arrDataFinal[0] + ' ' + arrDataFinal[2];
    diasEntreDatas = dateDif.dateDiff(novaDataInicial, novaDataFinal);
    var anos = 0, meses = 0;

    while (diasEntreDatas >= 365) {
        anos++;
        diasEntreDatas -= 365;
    }

    while (diasEntreDatas >= 30 && meses < 11) {
        meses++;
        diasEntreDatas -= 30;
    }

    $("#" + idDif).html(anos + "a " + meses + "m " + diasEntreDatas + "d");
}

function retiraAcentos(Campo) {
    var Acentos = "áàãââÁÀÃÂéêèÉÊíÍóõôÓÔÕúüÚÜçÇabcdefghijklmnopqrstuvxwyz";
    var Traducao = "AAAAAAAAAEEEEEIIOOOOOOUUUUCCABCDEFGHIJKLMNOPQRSTUVXWYZ";
    var Posic, Carac;
    var TempLog = "";
    for (var i = 0; i < Campo.length; i++) {
        Carac = Campo.charAt(i);
        Posic = Acentos.indexOf(Carac);
        if (Posic > -1)
            TempLog += Traducao.charAt(Posic);
        else
            TempLog += Campo.charAt(i);
        if (TempLog.substring(0, 1) == ' ')
            TempLog = TempLog.substring(0, TempLog.length - 1);
    }
//    TempLog = trim(TempLog);    
    return (TempLog);
}

function validateForms() {
    return $(".formValidate").validationEngine('validate');
}

/**
 * Função que retira mais de 1 espaço do inicio, entre e fim da string.
 * @param {type} str
 * @returns {@exp;str@call;replace}
 */
function trim(str) {
    return str.replace(/^\s+|\s+$/g, " ");
}

function limpaCampos(campos) {
    arrayCampos = campos.split("*");
    tam = arrayCampos.length;
    for (i = 0; i < tam; i++) {
        //alert(arrayCampos[i]);
        var $el = $("#" + arrayCampos[i]);
        if ($el.is("div,span") === false) {
            $el.val("");
            //alert("div"+arrayCampos[i]);
        }
        else {
            //alert("hmml"+arrayCampos[i]);
            $el.html("");
        }
    }
}

function preencheCampos(campos, valores) {
//        alert(campos);
//        alert(valores);
    arrayCampos = campos.split("*");
    arrayValores = valores.split("*");
    tam = arrayCampos.length;
    for (i = 0; i < tam; i++) {
//        alert(arrayCampos[i]);
        var $el = $("#" + arrayCampos[i]);
        $el.val(arrayValores[i]);
        //alert("div"+arrayCampos[i]);

    }
}

function removerElemento(campos) {
    //alert(campos);
    arrayCampos = campos.split("*");
    tam = arrayCampos.length;
    for (i = 0; i < tam; i++) {
        id = arrayCampos[i];
        $("#" + id).remove();
    }
}

function atualizaSelect(id) {
    setTimeout(function () {
        $("#" + id + " > option").each(function () {
            var status = $(this).attr("sel");
            //alert(status);
            $(this).attr("selected", "").attr("selected", status == 0 ? "" : "selected");
        });
    }, 500);
}

function atualizaChecked(id) {
    setTimeout(function () {
        $("input[type=checkbox]").each(function () {
            //this.checked = true;
            marcar = $(this).attr("marcar")
            if (marcar == 's')
                this.checked = true;
            else
                this.checked = false;
        });
    }, 100);
}

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

function mudarEstado(campos, acao) { // habilita/desabilita campos para manipulação
    if (campos != '') {
        campos = campos.split("*");
        for (i = 0; i < campos.length; i++) {
            //alert(campos[i]);
            //alert(acao);
            document.getElementById(campos[i]).disabled = acao;
        }
    }
}

function temValor(array, valor) {
    tamV = array.length;
    for (q = 0; q < tamV; q++) {
        //alert(array[q]);
        if (array[q] == valor) {
            return true;
        }
    }
    return false;
}

function mostrarCampo(campos, valorCampo, valorCompara, mostrar, sinal) {
    //alert(valorCampo);
    arrayCampos = campos.split("*");
    valoresCompara = valorCampo.split(",");
    tam = arrayCampos.length;

    if (campos != "123456") {
        for (i = 0; i < tam; i++) {

            var $el = $("#" + arrayCampos[i]);

            if ($el.is("div,span") === false) {
                //alert('não é div: '+arrayCampos[i]);
                $el.html("");
            }
            else {
                if (sinal == 1) { // comparar se e for igual
                    if (temValor(valoresCompara, valorCompara)) {
                        if (mostrar)
                            $el.css("display", "block");
                        else
                            $el.css("display", "none");
                    }
                } else { // comparar se e diferente
                    if (!temValor(valoresCompara, valorCompara)) {
                        if (mostrar)
                            $el.css("display", "block");
                        else
                            $el.css("display", "none");
                    }
                }
            }
        }
    }
}

function mostrarCampoUnidade(campos, valorCampo, valorCompara, mostrar, sinal) {
    //alert(campos);
    arrayCampos = campos.split("*");

    var $el1 = $("#" + arrayCampos[0]);
    var $el2 = $("#" + arrayCampos[1]);
    var $el3 = $("#" + arrayCampos[2]);
    var $el4 = $("#" + arrayCampos[3]); //label vara
    var $el5 = $("#" + arrayCampos[4]); // label funcionarios

    if ($el3.val() == 'D') { //defensor
        $el = $el2; //vara
        $oc = $el1;
        $exL = $el4;
    } else { //servidor
        $el = $el1; //funcionario
        $oc = $el2;
        $exL = $el5;
    }
    if (sinal == 0) {// comparar se e diferente
        if (valorCampo != valorCompara) {
            if (mostrar) {
                $el.css("display", "block");
                $oc.css("display", "none");
                $exL.css("display", "block");
            } else {
                $el.css("display", "none");
                $oc.css("display", "block");
                $exL.css("display", "none");
            }
        }
    }
}


$(document).bind("ready", function () {

    lc = new LoadingController();

});

LoadingController = function () {

    /**
     * @private
     */
    var $loadingElement = $("#loading");

    /**
     * @public
     */
    return {
        /**
         * Mostra o indicador de carregamento
         * @param {Object} sourceElement
         */
        start: function (requestObject) {
            mudaSituacaoButao('disabled', 'disabled');
            $loadingElement.fadeIn("normal");
        },
        /**
         * Esconde o indicador de carregamento
         * @param {Object} sourceElement
         */
        stop: function (requestObject) {
            mudaSituacaoButao('disabled', false);
            $loadingElement.fadeOut("normal");
        }

    };
};


$(function () {
    $('.tbody tr')
            .mouseover(function () {
                $(this).addClass('over');
            })
            .mouseout(function () {
                $(this).removeClass('over');
            });
});


$("body").delegate('.data', 'click', function () {
    $(this).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:2030',
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], // For formatting
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'], // Column headings for days starting at Sunday
        dateFormat: 'dd/mm/yy', // See format options on parseDate
        buttonImageOnly: true,
        buttonText: 'Calendário',
        showOn: 'button',
        buttonImage: endImageCalendario
    });
});

/* Exibe alerta do set-flash do cake */
$(function () {
    $("#flashMessage").click(function () {
        $(this).fadeOut();
    });
});

function intervaloDatas(dtI, dtF) {
    $(function () {
        $("#" + dtI).unbind().mask("99/99/9999");

        $("#" + dtF).unbind().mask("99/99/9999");

        $("#" + dtI).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            yearRange: '1920:2030',
            numberOfMonths: 2,
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], // For formatting
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'], // Column headings for days starting at Sunday
            dateFormat: 'dd/mm/yy', // See format options on parseDate
            buttonImageOnly: true,
            buttonText: 'Calendário',
            showOn: 'button',
            buttonImage: endImageCalendario,
            onClose: function (selectedDate) {
                $("#" + dtF).datepicker("option", "minDate", selectedDate);
            }
        });
        $("#" + dtF).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            yearRange: '1920:2030',
            numberOfMonths: 2,
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], // For formatting
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'], // Column headings for days starting at Sunday
            dateFormat: 'dd/mm/yy', // See format options on parseDate
            buttonImageOnly: true,
            buttonText: 'Calendário',
            showOn: 'button',
            buttonImage: endImageCalendario,
            onClose: function (selectedDate) {
                $("#" + dtI).datepicker("option", "maxDate", selectedDate);
            }
        });
    });
}


function refreshEditor() {
    tinyMCE.init({
        body_id: "editor",
        theme: "advanced",
        mode: "specific_textareas",
        editor_selector: "mceEditorEspecific",
        plugins: "pagebreak,table,advhr,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist",
        convert_urls: false,
        skin: "o2k7",
        //skin_variant : "black",
        // Theme options
        theme_advanced_buttons1: "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor,|,fullscreen",
        theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,hr,removeformat,ltr,rtl,visualchars,pagebreak,|,cite,abbr,acronym,del,ins,",
        theme_advanced_buttons3: "",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,
        // Example content CSS (should be your site CSS)
        content_css: "../../css/editor/content.css",
        template_external_list_url: "../../js/lists/template_list.js",
        external_link_list_url: "../../js/lists/link_list.js",
        external_image_list_url: "../../js/lists/image_list.js",
        media_external_list_url: "../../js/lists/media_list.js",
        height: '380'

    });
    // preparar para envio ajax
    tinyMCE.execCommand("mceAddControl", true, "ModeloDocumentoConteudo");
}

function refreshJquery() {
//    var content = '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>';
//    $('.date').find('span').remove();
//    $('.date').append(content);
//
//    $('.date').datetimepicker({
//        pickTime: false
//    });



    /** Procura item lista ------------------------------------------*/
    if ($("input#id_search").length > 0) {
        $('input#id_search').quicksearch("table tr");
    }
    /*----------------------------------------------------------------*/


    /**
     * Melhoras visuais na tabela de agenda
     * Bruno Gonçalves
     * 16/03/2011
     */
    $(".agenda td").hover(function () {
        var colIndex = $(this).index();
        var lineIndex = $(this).parent("tr").index();

        if (colIndex != 0) {
            $(this).css("background-color", "#FFDBCA");
            $(this).not(".feriado").toggleClass();
            $(".agenda col").eq(colIndex).css("background-color", "#E6FFE6");
            $(".agenda th").eq(colIndex).removeClass("dia");
            $(".agenda tr").eq(++lineIndex).find("td:eq(0)").removeClass("turno");
        }
    },
            function () {
                var colIndex = $(this).index();
                var lineIndex = $(this).parent("tr").index();

                if (colIndex != 0) {
                    if ($(this).children("input[type=checkbox]").is(":checked")) {
                        $(this).css("background-color", "#E0C000");
                    } else {
                        $(this).css("background-color", "");
                    }

                    $(this).not(".feriado").toggleClass();
                    $(".agenda col").eq(colIndex).css("background-color", "");
                    $(".agenda th").eq(colIndex).addClass("dia");
                    $(".agenda tr").eq(++lineIndex).find("td:eq(0)").addClass("turno");
                }
            }
    );


    /**
     * Destaca os dias selecionados na agenda
     * Bruno Gonçalves
     * 17/03/2011
     */
    $(".agenda").delegate('input[type=checkbox]', 'click', function () {
        if ($(this).attr("checked")) {
            $(this).parent("td").css("background-color", "#E0C000");
        } else {
            $(this).parent("td").css("background-color", "#FFFFBF");
        }
    });


    // ---------------------------------- Obrigatoriedade
    $("form").find(":contains('*')").filter("span").each(function () {
        $(this).html($(this).html().replace(/\*/g, "<span class='required'>*</span>"));
    });


    //------------------------ Botões
    $(function () {
        $("button, input:submit,input:button,input:reset", ".content").button();
    });


    //-------------------------- Calendário
    calendario();

    mascara();

    marcaDagua();

    sonumero();

    checkedAll();

    //----------------------- Sem acentos
    $(".nome").keyup(function () {
        $(this).val(retiraAcentos($(this).val()));
    });

    //----------------------- Caixa Alta
    $(".caixa_alta").keyup(function () {
        $(this).val(retiraAcentos($(this).val()));
    });

    //-------------------------- Exibir campos para Cadastro
    exibirCamposCadastro();
    //--------------------------- Exibir msg para o botão de nova ação (assistido)
    exibirCamposCadastroMsg();
    var data = new Date();
    ms = data.getMilliseconds();

}

function calendario() {
    //--------------------------- Calendário
    $(".data").unbind().datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:2030',
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], // For formatting
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'], // Column headings for days starting at Sunday
        dateFormat: 'dd/mm/yy', // See format options on parseDate
        buttonImageOnly: true,
        buttonText: 'Calendário',
        showOn: 'button',
        buttonImage: endImageCalendario
    });
}

function botoes() {
    $('.glyphicon-calendar').attr({title: 'Agendar'});
    $('.espelho').attr({title: 'Espelho'});
    $('.glyphicon-info-sign').attr({title: 'Espelho do Assistido'});
    $('.car').attr({title: 'Conciliação'});
    $('.cadastrar_dia').attr({title: 'Cadastrar Dia'});
    $('.listar_atendimento').attr({title: 'Listar Atendimento'});
    $('.editar').attr({title: 'Editar'});
    $('.apagar').attr({title: 'Excluir'});
    $('.novo').attr({title: 'Novo'});
    $('.listar').attr({title: 'Listar'});
    $('.proximo').attr({title: 'Próximo'});
    $('.anterior').attr({title: 'Anterior'});
    $('.visualizar').attr({title: 'Visualizar'});
    $('.acompanhar_assistido').attr({title: 'Acompanhar'});
    $('.glyphicon-file').attr({title: 'Extrato'});
    $('.acao_assistido_acao').attr({title: 'Cadastrar/Editar Ação'});
    $('.cadastrar_assistido').attr({title: 'Cadastrar'});
    $('.glyphicon-user').attr({title: 'Editar'});
    $('.apagar_assistido').attr({title: 'Apagar'});
    $('.listar_assistido').attr({title: 'Listar Assistido'});
    $('.acao').attr({title: 'Ação'});
    $('.listar_crime').attr({title: 'Listar Crime'});
    $('.psicossocial').attr({title: 'Cadastrar Atendimento NAP'});
    $('.cadastrarCrime').attr({title: 'Cadastrar Crime'});
    $('.listarCeaflan').attr({title: 'Listar Ceaflan / Capred'});
    $('.apagar_ceaflan').attr({title: 'Apagar Ceaflan / Capred'});
    $('.novo_curador').attr({title: 'Cadastrar Curadoria'});
    $('.familia').attr({title: 'Cadastrar Registro Família'});
    $('.add_curador').attr({title: 'Cadastrar Curadoria'});
    $('.novo_assistido').attr({title: 'Cadastrar Assistido'});
    $('.listar_juventudes').attr({title: 'Listar Infância X Juventude'});
    $('.add_juventudes').attr({title: 'Cadastrar Infância/Juventude (Atos Infracionais)'});
    $('.novo_funcionario').attr({title: 'Cadastrar'});
    $('.editar_funcionario').attr({title: 'Editar Funcionários'});
    $('.editar_funcionario1').attr({title: 'Editar Funcionários'});
    $('.apagar_funcionario').attr({title: 'Apagar'});
    $('.titularidade').attr({title: 'Titularidade/Designação'});
    $('.listar_funcionario').attr({title: 'Listar Funcionários'});
    $('.listar_defensor').attr({title: 'Listar Defensores'});
    $('.visualizar_perfil').attr({title: 'Visualizar'});
    $('.editar_perfil').attr({title: 'Editar'});
    $('.apagar_perfil').attr({title: 'Apagar'});
    $('.cadastrar_acao').attr({title: 'Cadastrar Ação'});
    $('.editar_acao').attr({title: 'Editar'});
    $('.apagar_acao').attr({title: 'Apagar'});
    $('.visualizar_acao').attr({title: 'Listar Ações do Assistido'});
    $('.visualizar_acao1').attr({title: 'Visualizar'});
    $('.visualizar_dados_acao').attr({title: 'Detalhar'});
    $('.visualizar_tp_doc').attr({title: 'Visualizar'});
    $('.editar_tp_doc').attr({title: 'Editar'});
    $('.apagar_tp_doc').attr({title: 'Apagar'});
    $('.novo_usuario').attr({title: 'Cadastrar'});
    $('.editar_usuario').attr({title: 'Editar'});
    $('.apagar_usuario').attr({title: 'Apagar'});
    $('.editar_telas').attr({title: 'Editar'});
    $('.apagar_telas').attr({title: 'Apagar'});
    $('.novo_telas').attr({title: 'Novo'});
    $('.cadastrar_civeis').attr({title: 'Cadastrar Cível/Fazenda Pública'});
    $('.juventude_civeis').attr({title: 'Cadastrar Infância/Juventude (Cível)'});
    $('.flagrante_assistido').attr({title: 'Cadastrar Flagrante'});
    $('.direito').attr({title: 'Cadastrar Direitos Humanos'});
    $('.cdd').attr({title: 'Central de distribuição de demandas'});
    $('.execucao_penal').attr({title: 'Execucão Penal'});
    $('.window_search').attr({title: 'Visualizar'});
    $('.idoso').attr({title: 'Cadastrar Registro Idoso'});
    $('.modelo_documento').attr({title: 'Modelo de Documento'});
    $('.pre_agendamento').attr({title: 'Cadastrar Pré Agendamento'});
    $('.instancia_superior_civel').attr({title: 'Cadastrar Instância Superior (Cível)'});
    $('.juizado_criminais').attr({title: 'Cadastrar Instância Superior (Crime)'});
    $('.relacionamento').attr({title: 'Cadastrar Atendimento CRC'});
    $('.glyphicon-comment').attr({title: 'Registro CRC'});
    $('.capred').attr({title: 'Cadastrar Assistência ao Preso (CAPRED)'});
    $('.fundiario').attr({title: 'Cadastrar Fundiário'});
    $('.glyphicon-header').attr({title: 'Emitir Documento de Hipossuficiência'});
    $('.grafico_1').attr({title: 'Exibir Gráfico'});
    $('.delete').attr({title: 'Apagar'});
    $('.processo_administrativo').attr({title: 'Cadastrar Processo Administrativo'});
    $('.pre_cadastro').attr({title: 'Adicionar Pré Cadastro'});
    $('.del').attr({title: 'Cancelar'});
    $('.comprovante_car').attr({title: 'Comprovante'});
    $('.pesquisar').attr({title: 'Pesquisar'});
    $('.presente').attr({title: 'Presente'});
    $('.ciente').attr({title: 'Assistido Presente'});
    $('.atendido').attr({title: 'Atendido'});
    $('.plantao').attr({title: 'Agendamentos do Plantão'});
    $('.alterar_defensores').attr({title: 'Permuta de defensores'});
    $('.mulher').attr({title: 'Cadastrar Núcleo Mulher'});
    $('.mais').attr({title: 'Adicionar'});
}


function atualizaBotao() {
    $(".botao").button();
}

function ajusteGrid() {
    $('.grid td').each(function (index) {
        var tam_th = $('.grid th').eq(index).width();
        var tam_td = $(this).width();
        //alert(tam_th + " - " + tam_td);
        if (tam_th > tam_td) {
            $(this).width(tam_th);
        } else {
            $('.grid th').eq(index).width(tam_td);
        }


        //$('#ttt').append('<br />TD: ' + $(this).width() + ' TH: ' + $('.grid th').eq(index).width());
        if (index == ($(".grid tr").eq(0).children().size() - 1)) {
            if (tam_th > tam_td) {
                $(this).eq(index).width(tam_td + 1);
            } else {
                $('.grid th').eq(index).width(tam_td + 1);
                $('.grid td').eq(index).width(tam_td + 1);
            }
            return false;
        }
    });
}

// Mascara para telefone de 8 ou 9 digitos
function mascaraTel(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1)
}
function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}
function mtel(v) {
    v = v.replace(/\D/g, "");             //Remove tudo o que não é dígito
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v = v.replace(/(\d)(\d{4})$/, "$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}

function mascara() {
	var opcoesNumUnica = {
		translation: {
			'Z': {
				pattern: /[\.]/,
				optional: true
			}
	    },
	    onComplete: function(value) {
	    	console.log('value:' + value);
	    },
	};
    //--------------------------- Máscaras
    //$(".telefone").mask("(99) 9999-9999");
    $('.protocolo').mask("999.999.999.999.999.999");
    $(".cpf").unbind().mask("999.999.999-99");
    $(".cnpj").unbind().mask("99.999.999/9999-99");
    $(".cep").unbind().mask("99999-999");
    $(".hora").unbind().mask("99:99:99");
    $(".HHmm").unbind().mask("99:99");
    $(".data").unbind().mask("99/99/9999");
    $(".mesAno").unbind().mask("99/9999");
    $(".num_unica").unbind().mask("9999999-99.9999.9.Z99.9999", opcoesNumUnica);
    $(".num_anterior").unbind().mask("9999999-9/9999");
    $(".ins_municipal").unbind().mask("999.999.99-9");
    $(".ins_estadual").unbind().mask("999999-99");
}

function checkedAll() {
    $("body").on('click', 'input.checkedAll', function () {
        var itemChecked = $(this).attr("classitem");
        if ($(this).is(":checked")) {
            $('.' + itemChecked).prop("checked", true);
        } else {
            $('.' + itemChecked).prop("checked", false);
        }
    });
}


/* Valida CPF o 2 ultimos digitos */
function isCPF(value) {
    value = $.trim(value.val());
    cpf = value.replace(/\.|-|\//gi, ''); // elimina .(ponto), -(hifem) e /(barra)

    while (cpf.length < 11)
        cpf = "0" + cpf;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = 11;
    for (i = 0; i < 11; i++) {
        a[i] = cpf.charAt(i);
        if (i < 9)
            b += (a[i] * --c);
    }
    if ((x = b % 11) < 2) {
        a[9] = 0
    } else {
        a[9] = 11 - x
    }
    b = 0;
    c = 11;
    for (y = 0; y < 10; y++)
        b += (a[y] * c--);
    if ((x = b % 11) < 2) {
        a[10] = 0;
    } else {
        a[10] = 11 - x;
    }
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) {
        return "* CPF inválido";
    }
}

function sonumero() {
    $('.sonumero').keypress(function (event) {
        var tecla = (window.event) ? event.keyCode : event.which;
        if ((tecla > 47 && tecla < 58))
            return true;
        else {
            if (tecla != 8)
                return false;
            else
                return true;
        }
    });
}
function comparaCampos(campo1, campo2, msg) {
    //alert(campo1+campo2);
    if (document.getElementById(campo1).value != document.getElementById(campo2).value) {
        alert(msg);
    }
}

function carregarModal() {
    $(document).ready(function () {
        //alert();
        tb_init('a.thickbox, area.thickbox, input.thickbox');//pass where to apply thickbox
        imgLoader = new Image();// preload image
        imgLoader.src = tb_pathToImage;
    });
}

//function mudaSituacaoButao(atributo, valor) {
//    $(document).ready(function() {
//        // On submit disable its submit button
//        $('input:submit,input:button', this).attr(atributo, valor);
//    });
//}

//Ajustando a url de http para https, pois estava causando bloqueio na página
function getAssistidosPresentesByDefensor(id_pessoa) {
    var dia = new Date();
    horaChamada = $("#AgendamentoHoraUltimaChamada").val();
    difHora = horaChamada - dia.getTime();
    $(document).ready(function () {
        if (($("#alert_defensor").css("display") == "none") || (difHora < 0)) {
            $.ajax({
                // url: "https://" + endListaAssistido + "agendamentos/buscaAgendamentoDefensor/" + id_pessoa + "?trs=1",
                url: "/agendamentos/buscaAgendamentoDefensor/" + id_pessoa + "?trs=1",
                global: false,
                success: function (data) {
                    var result = data.trim();
                    if (result !== "erro") {
                        $("#alert_defensor_content").remove();
                        $("#lista_assistidos").prepend(data);
                    }
                }
            });
        }
    });
}

var qtdAvisos = 0;
function getAvisosByDefensor() {
    $(document).ready(function () {
        $.ajax({
            url: "/pje_aviso_pendentes/buscarAvisosDefensor/?trs=1",
            global: false,
            success: function (data) {
                var result = data.trim();
                var json = JSON.parse(result);
                if (result !== "erro") {
                    var list = "";
                    qtdAvisos = json.length;
                    if(json.length > 0) {
                        for (let index = 0; index < qtdAvisos; index++) {
                            var instancia = json[index][0].instancia_pje;
                            var url = instancia == '1' ? "/pje_aviso_pendentes/" : "/peticionamento_intermediarios_2_grau_caixa_entrada/";
                            list += "<tr><td><a href='"+url+"?atuacao_id="+json[index][0].atuacao_id +"'>"+json[index][0].nome +" - "+json[index][0].qtd +"</a></td></tr>";
                        }

                        if(qtdAvisos != 0) {
                            $("#exibir_painelSenha").css("color", "red");
                            $("#qtd_agd").show();			
                            $("#qtd_agd").html(qtdAvisos);
                        }
                    } else {
                        list += "<tr><td>Nenhum aviso</td></tr>";
                    }
                    $("#lista_avisos_def").html(list);
                }
            }
        });
    });
}


/*
 Bruno Gonçalves
 11/11/2010
 Prepara uma div modal para receber um conteúdo.
 */
function showContentModal(size_height, size_width, id_div_content, title, id_element, data) {
    $(id_div_content).attr('title', title);
    $('#ui-dialog-title-dialog').empty().append(title);
    $.fx.speeds._default = 800;

    $(function () {
        $(id_div_content).dialog({
            autoOpen: false,
            hide: 'scale',
            height: size_height,
            width: size_width,
            modal: true
        });

        $(id_div_content).empty().html(data);
        $(id_div_content).dialog('open');
    });
}


/*
 Bruno Gonçalves
 14/01/2011
 Impressão do histórico
 */
function printHistorico() {
    $(document).ready(function () {
        // Seleciona o item clickado
        $(".printHistorico tr").not(":first").click(function () {
            if (!$(this).find(":checkbox").is(":checked")) {
                $(this).find(":checkbox").prop("checked", true);
                $(this).css("background-color", "#FFFF99");
            } else {
                $(".checked").attr("checked", false);
                $(this).find(":checkbox").prop("checked", false);
                $(this).css("background-color", "");
            }
        });

        // Remove a seleção de todos os itens no carregamento da página
        $(".printHistorico tr").find(":checkbox").each(function (index) {
            $(this).prop("checked", false);
        });

        // Seleciona vários itens de uma só vez
        $(".checked").click(function () {
            if ($(this).is(":checked")) {
                $(".printHistorico tr").find(":checkbox").prop("checked", true);
                $(".printHistorico tr").css("background-color", "#FFFF99");
            } else {
                $(".printHistorico tr").find(":checkbox").prop("checked", false);
                $(".printHistorico tr").css("background-color", "");
            }
        });

        // Remove a seleção de todos os itens no carregamento da página
        $(".printHistorico tr a").click(function (index) {

            $('.nav-pills a[href="#RelObservacao"').tab('show');

            $("#AcaoHistoricoObservacao").focus();
            $("#AcaoHistoricoId").val($(this).attr("id"));
            
            let mytext  = $(this).parents(".printHistorico tr").find(".content").text();

            const textWithoutSecondLine = mytext.split("\n").filter((line, index) => index !== 1 ).join("\n");

            const textAlmostFormated = textWithoutSecondLine.trimLeft().replace(/^\s*•/, "");

            const textFormated = textAlmostFormated.trimLeft().trimRight();

            $("#AcaoHistoricoObservacao").val(textFormated);


            $("#AcaoHistoricoObservacao").css("background-color", "#FFFF99");
            $("#removeEdition").show();
            $("#removeEdition").text("Cancelar Edição do Histórico");
        });


        $("#removeEdition").hide();

        // Remove a seleção de todos os itens no carregamento da página
        $("#removeEdition").click(function () {
            $("#AcaoHistoricoObservacao").focus();
            $("#AcaoHistoricoId").val("");
            $("#AcaoHistoricoObservacao").val("");
            $("#AcaoHistoricoObservacao").css("background-color", "");
            $("#removeEdition").hide();
        });
    });
}

/*
 Jailson Boa Morte
 19/01/2011
 */
function exibirCamposCadastro() {
    $("#novoCadastro").unbind().click(function () {
        var msg = "Tem certeza que é necessário um novo cadastro ? Verifique o histórico ! ";
        if (confirm(msg)) {
            $("#corpoNovoCadastro").show()
            $("#novoCadastro").hide();
        } else {
            $("#corpoNovoCadastro").hide();
        }
        return false;
    });
}

function exibirCamposCadastroMsg() {
    $("#novoCadastroMsg").unbind().click(function () {
        var msg = "Antes de cadastrar nova ação, por favor verifique o histórico. Deseja cadastrar nova ação ? ";
        if (confirm(msg)) {
            $("#corpoNovoCadastroMsg").show()
            $("#novoCadastroMsg").hide();
        } else {
            $("#corpoNovoCadastroMsg").hide();
        }
        return false;
    });
}

function refreshSelect() {
    $('#sel').click();
}


/**
 * Bruno Gonçalves
 * Calcula a diferença de dias entre duas datas
 */
function date_diff(dt_ini, dt_fim) {
    var iDate;
    var fDate;
    var arrDtIni = dt_ini.split('/');
    var arrDtFim = dt_fim.split('/');
    var dia = 1000 * 60 * 60 * 24;

    iDate = new Date(arrDtIni[2], (arrDtIni[1] - 1), arrDtIni[0]);
    fDate = new Date(arrDtFim[2], (arrDtFim[1] - 1), arrDtFim[0]);

    diferenca = fDate.getTime() - iDate.getTime();

    return Math.round(diferenca / dia);
}


/*
 Isac Costa
 30/09/2011
 Marca D'agua na caixa de Texo.
 basta defirnir ('class'=> "water", 'data-value'=>'Digite aqui')
 */


function marcaDagua() {
    var input = document.getElementsByClassName("water");

    for (var i = 0; i < input.length; i++)
    {
        input[i].style.color = "gray";
        input[i].style.fontStyle = "italic";
        input[i].style.fontSize = "12px";
        input[i].style.fontFamily = "Verdana,Arial,sans-serif";
        input[i].value = input[i].getAttribute("data-value");
        input[i].setAttribute("data-value", "");

        input[i].onblur = function ()
        {
            if (this.value.length === 0)
            {
                this.style.color = "gray";
                this.style.fontStyle = "italic";
                this.style.fontFamily = "Verdana,Arial,sans-serif";
                this.style.fontSize = "12px";
                this.value = this.getAttribute("data-value");
                this.setAttribute("data-value", "");

            }
        }

        input[i].onfocus = function ()
        {
            if (this.getAttribute("data-value") === "")
            {
                this.style.color = "black";
                this.style.fontStyle = "normal";
                this.setAttribute("data-value", this.value);
                this.value = "";
            }
        }
    }
}
