function modalPanel(comp,url)
{
	$(comp).colorbox({width:"80%", height:"80%", iframe:true,href:url})
}

function modalPanel(comp,url,largura,altura)
{
	$(comp).colorbox({width:largura+"%", height:altura+"%", iframe:true,href:url})
}

// Máscaras

function mascara(o,f)
{
    v_obj=o;
    v_fun=f;
    setTimeout("execmascara()",1)
}

function execmascara()
{
    v_obj.value=v_fun(v_obj.value)
}

function formatacaoData(v) {
	v=v.replace(/\D/g,"")
	v=v.replace(/(\d{2})(\d)/,"$1/$2")
	v=v.replace(/(\d{2})(\d)/,"$1/$2")
	return v
}

function formatacaoHora(v) {
	v=v.replace(/\D/g,"")
	v=v.replace(/(\d{2})(\d)/,"$1:$2")
	//v=v.replace(/(\d{2})(\d)/,"$1$2")
	return v
}

function formatacaoTelefone(v)
{
    v=v.replace(/\D/g,"")                 	// Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 	// Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")    	// Coloca hífen entre o quarto e o quinto dígitos
    return v
}

// Com formatação para a casa de milhar, somente números inteiros
function formatacaoQuantidadeComMilhar(v)
{
    v=v.replace(/\D/g,"")  			// Permite digitar apenas números
    v=v.replace(/(\d{1})(\d{9})$/,"$1.$2")  	// Coloca ponto antes dos últimos 9 digitos
    v=v.replace(/(\d{1})(\d{6})$/,"$1.$2")  	// Coloca ponto antes dos últimos 6 digitos
    v=v.replace(/(\d{1})(\d{3})$/,"$1.$2")  	// Coloca ponto antes dos últimos 3 digitos
    return v
}

// Sem formatação para a casa de milhar
function formatacaoQuantidade(v)
{
    v=v.replace(/\D/g,"")  			// Permite digitar apenas números
    v=v.replace(/(\d{1})(\d{1,4})$/,"$1.$2")    // Coloca virgula antes dos últimos 4 digitos
    return v
}

// Sem formatação para a casa de milhar
function formatacaoQuantidade2CasasDecimais(v)
{
    v=v.replace(/\D/g,"")  			// Permite digitar apenas números
    v=v.replace(/(\d{1})(\d{1,2})$/,"$1.$2")    // Coloca virgula antes dos últimos 2 digitos
    return v
}

function formatacaoMonetaria(v)
{
    v=v.replace(/\D/g,"") 			// Permite digitar apenas números
    v=v.replace(/[0-9]{12}/,"inválido")   	// Limita pra máximo 999.999.999,99
    v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  	// Coloca ponto antes dos últimos 8 digitos
    v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  	// Coloca ponto antes dos últimos 5 digitos
    v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")    // Coloca virgula antes dos últimos 2 digitos
    return v
}

//Autor: Edivan
function limpaCampo(v)
{
    return v = ""
}

//Autor: Edivan
function somenteDigitos(v)
{
    return v.replace(/\D/g,"") //Remove tudo o que não é dígito
}

function somenteLetras(v)
{
    return v.replace(/\d/g,"") //Remove tudo o que não é dígito
}

function formatacaoCNPJ(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dígitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hífen depois do bloco de quatro dígitos
    return v
}

function formatacaoCPF(v)
{
   v=v.replace(/\D/g,"")                                       //Remove tudo o que não é dígito
   v=v.replace(/^(\d{3})(\d)/,"$1.$2")                         //Coloca ponto entre o terceiro e o quarto dígitos
   v=v.replace(/^(\d{3})\.(\d{3})(\d)/,"$1.$2.$3")             //Coloca ponto entre o sexto e o sétimo dígitos
   v=v.replace(/^(\d{3})\.(\d{3}).(\d{3})(\d)/,"$1.$2.$3-$4")  //Coloca um hífen depois dos 3 blocos de 3 dígitos
   return v
}

function formatacaoMATRIC(v)
{
   v=v.replace(/\D/g,"")                                       //Remove tudo o que não é dígito
   v=v.replace(/^(\d{3})(\d)/,"$1.$2")                         //Coloca ponto entre o terceiro e o quarto dígitos
   v=v.replace(/^(\d{3})\.(\d{3})(\d)/,"$1.$2-$3")             //Coloca um hífen entre o sexto e o sétimo dígitos
   v=v.replace(/^(\d{3})\.(\d{3})\-(\d{1})(\d)/,"$1.$2-$3-$4") //Coloca um hífen depois do bloco de quatro dígitos
   return v
}

function formatacaoCep(v)
{
   v=v.replace(/\D/g,"")                                       //Remove tudo o que não é dígito
   v=v.replace(/^(\d{5})(\d)/,"$1-$2")                         //Coloca hífen entre o quinto e o sexto dígitos
   return v
}

function formatacaoMoeda(v) {
	v=v.replace(/\D/g,"")  //permite digitar apenas números
	v=v.replace(/[0-9]{12}/,"inválido")   //limita pra máximo 999999999.99
	v=v.replace(/(\d{1})(\d{2})$/,"$1.$2")  //coloca ponto antes dos últimos 2 digitos
	//v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
	//v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
	//v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")    //coloca virgula antes dos últimos 2 digitos
	//v= "R$ "+v
	return v
}

function formataCampoMoeda(evt, src, mascara)
{

    if(mascara != 'moeda')
    {
        var tecla = (window.event)?evt.keyCode:evt.which;
        var i = src.value.length;
        if(teclasAceitas.indexOf(tecla) == -1)
        {
                if(!VerificaTecla(tecla, mascara.charAt(i)) || i >= mascara.length)
                {
                        return false;
                }
                else if(separadores.indexOf(mascara.charAt(i)) > -1)
                {
                        if(!VerificaTecla(tecla, mascara.charAt(i+1)))
                        {
                            return false;
                        }
                        else
                        {
                            src.value += mascara.charAt(i);
                        }
                }
                src.value += String.fromCharCode(tecla);
                return false;
        }
        else
        {
            return true;
        }
    }
    else
    {

        var sep = 0;
        var decSep = ',';
        var milSep = '.';
        var key = '';
        var i = j = 0;
        var len = len2 = 0;
        var strCheck = '0123456789';
        var aux = aux2 = '';
        var whichCode = (window.Event) ? evt.which : evt.keyCode;

           if (whichCode == 13) return false;  // Enter
         // alert(wichCode);

        if (whichCode == 8)
        {
            key = src.value.substr(src.value.length-2, 1);
            //alert('key='+key);
            src.value = src.value.substr(0, src.value.length - 2);
        }
        else
        {
            key = String.fromCharCode(whichCode);  // Get key value fromkey code
            //alert('key='+key);
        }

        if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
        len = src.value.length;
        for(i = 0; i < len; i++)
            if ((src.value.charAt(i) != '0') && (src.value.charAt(i) != decSep)) break;
        aux = '';
        for(; i < len; i++)
            if (strCheck.indexOf(src.value.charAt(i))!=-1) aux += src.value.charAt(i);
        aux += key;
        len = aux.length;

        //if (len == 0) src.value = '';
        //if (len == 1) src.value = '0'+ decSep + '0' +'0'+'0' + aux;
        //if (len == 2) src.value = '0'+ decSep + '0' +'0'+ aux;
        //if (len == 3) src.value = '0'+ decSep + '0' + aux;
        //if (len == 4) src.value = '0'+ decSep + aux;

       	//if (len > 4)
        //{
        //    aux2 = '';
        //    for (j = 0, i = len - 5; i >= 0; i--)
        //    {
        //        if (j == 3)
        //        {
        //            aux2 += milSep;
        //           j = 0;
        //        }
        //        aux2 += aux.charAt(i);
        //        j++;
        //    }
        //    src.value = '';
        //    len2 = aux2.length;
        //    for (i = len2 - 1; i >= 0; i--)
        //       src.value += aux2.charAt(i);
        //    src.value += decSep + aux.substr(len - 4, len);
       	//}
       	
       	//if (len == 0) src.value = '';
        //if (len == 1) src.value = '0'+ decSep + '0' +'0'+'0' + aux;
        //if (len == 2) src.value = '0'+ decSep + '0' +'0'+ aux;
        //if (len == 3) src.value = '0'+ decSep + '0' + aux;
        //if (len == 4) src.value = '0'+ decSep + aux;

				if (len == 1) src.value = '0'+ decSep + '0' + aux;
        if (len == 2) src.value = '0'+ decSep + aux;

       	if (len > 2)
        {
            aux2 = '';
            for (j = 0, i = len - 3; i >= 0; i--)
            {
                if (j == 3)
                {
                    aux2 += milSep;
                    j = 0;
                }
                aux2 += aux.charAt(i);
                j++;
            }
            src.value = '';
            len2 = aux2.length;
            for (i = len2 - 1; i >= 0; i--)
               src.value += aux2.charAt(i);
            src.value += decSep + aux.substr(len - 2, len);
        }

        return false;
    }
}

function arredonda( valor , casas ){
   var novo = Math.round( valor * Math.pow( 10 , casas ) ) / Math.pow(
10 , casas );
   return( novo );
}

function float2moeda(num) {

   var separacaoPonto = num.toString().split(".");
   var cents = separacaoPonto[1];
   var centsTam = 0;

   if(typeof cents == 'undefined' || cents == 0)
   {
           cents = "0000";
   }
   else
   {
           centsTam = cents.toString().length;
           if(centsTam != 4)
           {
               if(centsTam == 1)
                   cents+="000";
               if(centsTam == 2)
                   cents+="00";
               if(centsTam == 3)
                   cents+="0";
           }
   }


   var reais = separacaoPonto[0];
   var tamanho = reais.toString().length-1;
   var contador = 0;
   var numeroinicial = "";

   for(var i=tamanho;i>=0;i--)
   {

           if(contador==3)
           {
               numeroinicial +='.';
               contador = 0;
           }
           numeroinicial += reais.substring(i+1,i);
           contador++;
   }
   var tamanhoNumeroFinal = numeroinicial.toString().length;
   var numerofinal = "";


   for(var i=tamanhoNumeroFinal; i>=0;i--)
   {
           numerofinal += numeroinicial.substring(i+1,i);
   }

    numerofinal+=','+cents;

    if(num==0)
           numerofinal = '0,0000';

    return numerofinal;
}

function replaceAllFormatoAmericano(valor){
	if(valor != '')	{
		while(valor.lastIndexOf('.') != -1){
			valor =  valor.replace('.','');
		}
		valor = valor.replace(',','.');
	}
	return valor;
}

// função utilizada do site http://www.htmlstaff.org/ver.php?id=7836
// função genérica utilizada para mascara
// o formato é declarado na view  com ":onkeypress=>"formatar_mascara(this, '#######-##.####.#.##.####')"
// ex :onkeypress=>"formatar_mascara(this, '###.###.###-##')

function formatar_mascara(src, mascara) {
	var campo = src.value.length;
	var saida = mascara.substring(0,1);
	var texto = mascara.substring(campo);
	if(texto.substring(0,1) != saida) {
		src.value += texto.substring(0,1);
	}
}

/*function debitar(ano, ano_inicial, ano_final, mes){   
    validarValoresDebito(ano);
    var valor_a_debitar = $("#"+ano+"_"+mes+"_debitar").val();    
    debitarValores(valor_a_debitar, ano, ano_final, mes);
    recalcularTotaisAno(ano, ano_inicial, ano_final, mes);
}*/

/*function validarValoresDebito(ano){
    for(var count = 1; count <= 12; count++){
      var valor_atual = $("#"+ano+"_"+count+"_debitar").val();
      valor_novo    = valor_atual ? valor_atual : 0;      
      $("#"+ano+"_"+count+"_debitar").val(valor_novo);
    }
}*/

/*function debitarValores(valor_a_debitar, ano, ano_final, mes){
    var novo_valor        = ($("#"+ano+"_"+mes).val() - valor_a_debitar).toFixed(2);
    var novo_valor_inpc   = this.getValorInpc(ano, ano_final, mes, valor_a_debitar);
    // alert(novo_valor_inpc);
    
    // j("#"+ano+"_"+mes+"_INPC").val(novo_valor_inpc);
}*/

/*function getValorInpc(ano, ano_final, mes, novo_valor_inpc){
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
    indices["2020"] = new Array(0.19, 0.17, 0.18, -0.23, -0.25, 0.30, 0.44, 0.36, 0.00, 0.00, 0.00, 0.00);
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
  }*/

  /*function recalcularTotaisAno(ano, ano_inicial, ano_final, mes){
    getValorTotalPorAno(ano);
    getValorTotal(ano_inicial, ano_final);
    getValorTotalComInpc(ano_inicial, ano_final);
    getValorTotalMulta();
  }*/

  /*function getValorTotalPorAno(ano){
    var valor_total       = 0;
    var valor_total_pago  = 0;
    var valor_total_inpc  = 0;

    for(var count = 1; count <= 12; count++){
      valor_total       = parseFloat($("#"+ano+"_"+count).val()) + valor_total;
      valor_total_pago  = parseFloat($("#"+ano+"_"+count+"_debitar").val()) + valor_total_pago;
      valor_total_inpc  = parseFloat($("#"+ano+"_"+count+"_INPC").val()) + valor_total_inpc;
    }
     
     //console.log("valor total: "+valor_total);
     //console.log("valor total pago: "+valor_total_pago);
     //console.log("valor total inpc: "+valor_total_inpc);

    
    $("#valor_total_"+ano).val(valor_total.toFixed(2));
    $("#total_pago_"+ano).val(valor_total_pago.toFixed(2));
    $("#valor_total_"+ano+"_INPC").val((valor_total_inpc-valor_total_pago).toFixed(2));    
  }*/

  /*function getValorTotal(ano_inicial, ano_final){
    var valor_total_por_ano       = 0.0;
    var valor_total_pago_por_ano  = 0.0;
    while(ano_inicial <= ano_final){
      valor_total_por_ano       = parseFloat($("#valor_total_"+ano_inicial).val()) + valor_total_por_ano;
      valor_total_pago_por_ano  = parseFloat($("#total_pago_"+ano_inicial).val()) + valor_total_pago_por_ano;
      ano_inicial++;
    }

    //console.log((parseFloat(valor_total_por_ano).toFixed(2) - parseFloat(valor_total_pago_por_ano).toFixed(2)).toFixed(2));
    $("#valor_total_geral").val((parseFloat(valor_total_por_ano).toFixed(2) - parseFloat(valor_total_pago_por_ano).toFixed(2)).toFixed(2));
  }*/

  /*function getValorTotalComInpc(ano_inicial, ano_final){
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
  }

  function getValorTotalMulta(ano_inicial, ano_final){
    valor_multa    = $("#valor_total_multa").val();    
    valor_multa_inpc = $("#valor_total_multa_inpc").val();

    //console.log(valor_multa);
    $("#valor_total_multa").val((parseFloat($("#valor_total_geral").val()) * parseFloat($("#salario_per_multa").val())/100).toFixed(2));
    $("#valor_total_com_multa").val((parseFloat($("#valor_total_geral").val()) + parseFloat(valor_multa)).toFixed(2));    
    $("#valor_total_com_multa_e_inpc").val((parseFloat($("#valor_total_geral_com_inpc").val()) + parseFloat(valor_multa_inpc)).toFixed(2));
  } */







