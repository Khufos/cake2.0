function debitar(ano, ano_inicial, ano_final, mes){   
    validarValoresDebito(ano);
    var valor_a_debitar = $("#"+ano+"_"+mes+"_debitar").val();    
    debitarValores(valor_a_debitar, ano, ano_final, mes);
    recalcularTotaisAno(ano, ano_inicial, ano_final, mes);
}

function validarValoresDebito(ano){
    for(var count = 1; count <= 12; count++){
      var valor_atual = $("#"+ano+"_"+count+"_debitar").val();
      valor_novo    = valor_atual ? valor_atual : 0;      
      $("#"+ano+"_"+count+"_debitar").val(valor_novo);
      $("#"+ano+"_"+count+"_debitar").attr('value', valor_novo);
    }
}

function debitarValores(valor_a_debitar, ano, ano_final, mes){
    var novo_valor        = ($("#"+ano+"_"+mes).val() - valor_a_debitar).toFixed(2);
    var novo_valor_inpc   = this.getValorInpc(ano, ano_final, mes, valor_a_debitar);
    // alert(novo_valor_inpc);
    
    // j("#"+ano+"_"+mes+"_INPC").val(novo_valor_inpc);
}

function getValorInpc(ano, ano_final, mes, novo_valor_inpc){
    var indices = new Array();
    indices["1994"] = new Array(41.32, 40.57, 43.08, 42.86, 42.73, 48.24, 7.75, 1.85, 1.40, 2.82, 2.96, 1.70);
    indices["1995"] = new Array(1.44, 1.01, 1.62, 2.49, 2.10, 2.18, 2.46, 1.02, 1.17, 1.40, 1.51, 1.65);
    indices["1996"] = new Array(1.46, 0.71, 0.29, 0.93, 1.28, 1.33, 1.20, 0.50, 0.02, 0.38, 0.34, 0.33);
    indices["1997"] = new Array(0.81, 0.45, 0.68, 0.60, 0.11, 0.35, 0.18, -0.03, 0.10, 0.29, 0.15, 0.57);
    indices["1998"] = new Array(0.85, 0.54, 0.49, 0.45, 0.72, 0.15, -0.28, -0.49, -0.31, 0.11, -0.18, 0.42);
    indices["1999"] = new Array(0.65, 1.29, 1.28, 0.47, 0.05, 0.07, 0.74, 0.55, 0.39, 0.96, 0.94, 0.74);
    indices["2000"] = new Array(0.61, 0.05, 0.13, 0.09, -0.05, 0.30, 1.39, 1.21, 0.43, 0.16, 0.29, 0.55);
    indices["2001"] = new Array(0.77, 0.49, 0.48, 0.84, 0.57, 0.60, 1.11, 0.79, 0.44, 0.94, 1.29, 0.74);
    indices["2002"] = new Array(1.07, 0.31, 0.62, 0.68, 0.09, 0.61, 1.15, 0.86, 0.83, 1.57, 3.39, 2.70);
    indices["2003"] = new Array(2.47, 1.46, 1.37, 1.38, 0.99, -0.06, 0.04, 0.18, 0.82, 0.39, 0.37, 0.54);
    indices["2004"] = new Array(0.83, 0.39, 0.57, 0.41, 0.40, 0.50, 0.73, 0.50, 0.17, 0.17, 0.44, 0.86);
    indices["2005"] = new Array(0.57, 0.44, 0.73, 0.91, 0.70, -0.11, 0.03, 0.00, 0.15, 0.58, 0.54, 0.40);
    indices["2006"] = new Array(0.38, 0.23, 0.27, 0.12, 0.13, -0.07, 0.11, -0.02, 0.16, 0.43, 0.42, 0.62);
    indices["2007"] = new Array(0.49, 0.42, 0.44, 0.26, 0.26, 0.31, 0.32, 0.59, 0.25, 0.30, 0.43, 0.97);
    indices["2008"] = new Array(0.69, 0.48, 0.51, 0.64, 0.96, 0.91, 0.58, 0.21, 0.15, 0.50, 0.38, 0.29);
    indices["2009"] = new Array(0.64, 0.31, 0.20, 0.55, 0.60, 0.42, 0.23, 0.08, 0.16, 0.24, 0.37, 0.24);
    indices["2010"] = new Array(0.88, 0.70, 0.71, 0.73, 0.43, -0.11, -0.07, -0.07, 0.54, 0.92, 1.03, 0.60);
    indices["2011"] = new Array(0.94, 0.54, 0.66, 0.72, 0.57, 0.22, 0.00, 0.42, 0.45, 0.32, 0.57, 0.51);
    indices["2012"] = new Array(0.51, 0.39, 0.18, 0.64, 0.55, 0.26, 0.43, 0.45, 0.63, 0.71, 0.54, 0.74);
    indices["2013"] = new Array(0.92, 0.52, 0.60, 0.59, 0.35, 0.28, -0.13, 0.16, 0.27, 0.61, 0.54, 0.72);
    indices["2014"] = new Array(0.63, 0.64, 0.82, 0.78, 0.60, 0.26, 0.13, 0.18, 0.49, 0.38, 0.53, 0.62);
    indices["2015"] = new Array(1.48, 1.16, 1.51, 0.71, 0.99, 0.77, 0.58, 0.25, 0.51, 0.77, 1.11, 0.90);
    indices["2016"] = new Array(1.51, 0.95, 0.44, 0.64, 0.98, 0.47, 0.64, 0.31, 0.08, 0.17, 0.07, 0.14);
    indices["2017"] = new Array(0.42, 0.24, 0.32, 0.08, 0.36, -0.30, 0.17, -0.03, -0.02, 0.37, 0.18, 0.26);
    indices["2018"] = new Array(0.23, 0.18, 0.07, 0.21, 0.43, 1.43, 0.25, 0.00, 0.30, 0.40, -0.25, 0.14);
    indices["2019"] = new Array(0.36, 0.54, 0.77, 0.60, 0.15, 0.01, 0.10, 0.12, -0.05, 0.04, 0.54, 1.22);
    indices["2020"] = new Array(0.19, 0.17, 0.18, -0.23, -0.25, 0.30, 0.44, 0.36, 0.87, 0.89, 0.95, 1.46);
    indices["2021"] = new Array(0.27, 0.82, 0.86, 0.38, 0.96, 0.60, 1.02, 0.88, 1.20, 1.16, 0.84, 0.73);
    indices["2022"] = new Array(0.67, 1.00, 1.71, 1.04, 0.45, 0.62, -0.60, -0.31, -0.32, 0.47, 0.38, 0.69);
    indices["2023"] = new Array(0.46, 0.77, 0.64, 0.53, 0.36, -0.10, -0.09, 0.20, 0.11, 0.12, 0.10, 0.00);
    indices["2024"] = new Array(0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00);

    // while (ano <= ano_final){
    // while (ano <= ano_final){
      while (mes <= 12){
        inpc = indices[ano][mes-1];
        // alert(ano+'-'+mes+'-'+novo_valor_inpc);
        // alert(ano+'-'+mes+'-'+novo_valor);
        novo_valor_inpc = parseFloat(novo_valor_inpc);
        // alert(a);
        // novo_valor_inpc = parseFloat(novo_valor_inpc);
        // alert(novo_valor_inpc);
        // novo_valor_inpc = novo_valor_inpc + ((inpc * novo_valor_inpc) / 100);
        novo_valor_inpc = ( (novo_valor_inpc + ( (inpc / 100) * novo_valor_inpc) ) );
        // alert(novo_valor_inpc);
        // alert(parseFloat(novo_valor_inpc));

        // [72.49,72.53,72.75,72.68,72.78,72.85]
        mes+= 1;
        // mes++;
      }
      // mes = 1
      // ano++;
    // }    
    return novo_valor_inpc.toFixed(2);
  }

  function recalcularTotaisAno(ano, ano_inicial, ano_final, mes){
    getValorTotalPorAno(ano);
    getValorTotal(ano_inicial, ano_final);
    getValorTotalComInpc(ano_inicial, ano_final);
    getValorTotalMulta();
  }

  function getValorTotalPorAno(ano){
    var valor_total       = 0;
    var valor_total_pago  = 0;
    var valor_total_inpc  = 0;

    for(var count = 1; count <= 12; count++){
      valor_total       = parseFloat($("#"+ano+"_"+count).val()) + valor_total;
      valor_total_pago  = parseFloat($("#"+ano+"_"+count+"_debitar").val()) + valor_total_pago;
      valor_total_inpc  = parseFloat($("#"+ano+"_"+count+"_INPC").val()) + valor_total_inpc;
    }
     
     /*console.log("valor total: "+valor_total);
     console.log("valor total pago: "+valor_total_pago);
     console.log("valor total inpc: "+valor_total_inpc);*/

    $("#valor_total_"+ano).val(valor_total.toFixed(2));
    $("#total_pago_"+ano).val(valor_total_pago.toFixed(2));
    $("#valor_total_"+ano+"_INPC").val((valor_total_inpc-valor_total_pago).toFixed(2)); 
    $("#total_pago_"+ano).attr('value', valor_total_pago.toFixed(2)); 
    $("#valor_total_"+ano+"_INPC").attr('value', (valor_total_inpc-valor_total_pago).toFixed(2));  
  }

  function getValorTotal(ano_inicial, ano_final){
    var valor_total_por_ano       = 0.0;
    var valor_total_pago_por_ano  = 0.0;
    while(ano_inicial <= ano_final){
      valor_total_por_ano       = parseFloat($("#valor_total_"+ano_inicial).val()) + valor_total_por_ano;
      valor_total_pago_por_ano  = parseFloat($("#total_pago_"+ano_inicial).val()) + valor_total_pago_por_ano;
      ano_inicial++;
    }

    //console.log((parseFloat(valor_total_por_ano).toFixed(2) - parseFloat(valor_total_pago_por_ano).toFixed(2)).toFixed(2));
    $("#valor_total_geral").val((parseFloat(valor_total_por_ano).toFixed(2) - parseFloat(valor_total_pago_por_ano).toFixed(2)).toFixed(2));
    $("#valor_total_geral").attr('value', (parseFloat(valor_total_por_ano).toFixed(2) - parseFloat(valor_total_pago_por_ano).toFixed(2)).toFixed(2)); 
  }

  function getValorTotalComInpc(ano_inicial, ano_final){
    var valor_total_por_ano = 0.0;
    while(ano_inicial <= ano_final){
      // console.log(valor_total_geral_com_inpc);
      // console.log(valor_total_por_ano);
      valor_total_por_ano = parseFloat($("#valor_total_"+ano_inicial+"_INPC").val()) + valor_total_por_ano;
      ano_inicial++;
    }
    
    $("#valor_total_geral_com_inpc").val(parseFloat(valor_total_por_ano).toFixed(2));
    valor_total_geral_com_inpc = $("#valor_total_geral_com_inpc").val(parseFloat(valor_total_por_ano).toFixed(2));
    $("#valor_total_multa_inpc").val((parseFloat(valor_total_geral_com_inpc.val()) * parseFloat($("#salario_per_multa").val())/100).toFixed(2));
    $("#valor_total_geral_com_inpc").attr('value', parseFloat(valor_total_por_ano).toFixed(2)); 
    $("#valor_total_multa_inpc").attr('value', (parseFloat(valor_total_geral_com_inpc.val()) * parseFloat($("#salario_per_multa").val())/100).toFixed(2)); 
  }

  function getValorTotalMulta(ano_inicial, ano_final){
    valor_multa    = $("#valor_total_multa").val();    
    valor_multa_inpc = $("#valor_total_multa_inpc").val();

    $("#valor_total_multa").val((parseFloat($("#valor_total_geral").val()) * parseFloat($("#salario_per_multa").val())/100).toFixed(2));
    $("#valor_total_com_multa").val((parseFloat($("#valor_total_geral").val()) + parseFloat(valor_multa)).toFixed(2));    
    $("#valor_total_com_multa_e_inpc").val((parseFloat($("#valor_total_geral_com_inpc").val()) + parseFloat(valor_multa_inpc)).toFixed(2));
    $("#valor_total_multa").attr('value', (parseFloat($("#valor_total_geral").val()) * parseFloat($("#salario_per_multa").val())/100).toFixed(2)); 
    $("#valor_total_com_multa").attr('value',(parseFloat($("#valor_total_geral").val()) + parseFloat(valor_multa)).toFixed(2)); 
    $("#valor_total_com_multa_e_inpc").attr('value',(parseFloat($("#valor_total_geral_com_inpc").val()) + parseFloat(valor_multa_inpc)).toFixed(2));
  } 