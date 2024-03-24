function limpaCampos(campos){
    //alert(campos);
    arrayCampos = campos.split("*");
    tam = arrayCampos.length;
    for (i = 0; i < tam; i++){
        //alert(arrayCampos[i]);
        var $el = jQuery("#" + arrayCampos[i]);
        if ($el.is("div,span") === false){
            $el.val("");
			//alert("div"+arrayCampos[i]);
        }
        else {
			//alert("hmml"+arrayCampos[i]);		
            $el.html("");
        }
    }
}

function preencheCampos(campos,valores){
	//alert(campos);
	arrayCampos = campos.split("*");
	arrayValores = valores.split("*");
	tam = arrayCampos.length;
	for (i = 0; i < tam; i++){
		//alert(arrayCampos[i]);
		var $el = jQuery("#" + arrayCampos[i]);        
			$el.val(arrayValores[i]);
			//alert("div"+arrayCampos[i]);
				
	}
}

function removerElemento(campos){
	//alert(campos);
	arrayCampos = campos.split("*");
    tam = arrayCampos.length;
    for (i = 0; i < tam; i++){	
		id=arrayCampos[i];		
		jQuery("#" + id).remove();	
	}
}

function atualizaSelect(id){
	setTimeout(function() {
		jQuery("#" + id + " > option").each(function() {
			var status = jQuery(this).attr("sel");
			//alert(status);
			jQuery(this).attr("selected", "").attr("selected", status ==0?"" : "selected");
		});
	}, 500);
}

function atualizaChecked(id){
	// jQuery("input[type=checkbox]").each(function() {			
	//var status = this.checked;
	//jQuery(this).attr("checked", "").attr("checked", status ==true?"" : "checked");			
		setTimeout(function() {
			jQuery("input[type=checkbox]").each(function() { 
				//this.checked = true; 
				marcar =jQuery(this).attr("marcar")
				if(marcar=='s')
					this.checked = true; 
				else
					this.checked = false; 
				// alert(marcar);
			});
		}, 100);
	// } else {
		// jQuery("input[type=checkbox]").each(function() { 
			// this.checked = false; 
		// });
	// }
// });		
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}


function mudarEstado(campos, acao){ // habilita/desabilita campos para manipulação		
	if (campos != '') {
        campos = campos.split("*");
        for (i = 0; i < campos.length; i++){
            //alert(campos[i]);
            //alert(acao);
            document.getElementById(campos[i]).disabled = acao;
        }
    }
}

/*function mostrarCampo(campos,valorCampo,valorCompara,mostrar,sinal){
    //alert(campos);
    arrayCampos = campos.split("*");
    tam = arrayCampos.length;        

	if(campos!="123456"){
		for (i = 0; i < tam; i++) {
			
			var $el = jQuery("#" + arrayCampos[i]);
			
			if ($el.is("div,span") === false) {
				alert('n�o � div: '+arrayCampos[i]);
				$el.html("");
			}else{
				if(sinal==1){ // comparar se e for igual
					if(valorCampo==valorCompara){
						if(mostrar)		
							$el.css("display", "block"); 
						else
							$el.css("display", "none");
					}
				}else{ // comparar se e diferente
					if(valorCampo!=valorCompara){
						if(mostrar)		
							$el.css("display", "block"); 
						else
							$el.css("display", "none");
					}
				}
			}		       
		}
	}
}*/

function temValor(array,valor){
	tamV = array.length;
	for (q = 0; q < tamV; q++) {
		//alert(array[q]);
		if(array[q]==valor){
			return true;
		}		
	}
	return false;
}

function mostrarCampo(campos,valorCampo,valorCompara,mostrar,sinal){
    //alert(valorCampo);
    arrayCampos = campos.split("*");
    valoresCompara = valorCampo.split(",");
    tam = arrayCampos.length;        

	if(campos!="123456"){
		for (i = 0; i < tam; i++){
			
			var $el = jQuery("#" + arrayCampos[i]);
			
			if ($el.is("div,span") === false) {
				//alert('não é div: '+arrayCampos[i]);
				$el.html("");
			}else{
				if(sinal==1){ // comparar se e for igual
					if(temValor(valoresCompara,valorCompara)){
						if(mostrar)		
							$el.css("display", "block"); 
						else
							$el.css("display", "none");
					}
				}else{ // comparar se e diferente
					if(!temValor(valoresCompara,valorCompara)){
						if(mostrar)		
							$el.css("display", "block"); 
						else
							$el.css("display", "none");
					}
				}
			}		       
		}
	}
}

function mostrarCampoUnidade(campos,valorCampo,valorCompara,mostrar,sinal){ 
    //alert(campos);
    arrayCampos = campos.split("*");
    
	var $el1 = jQuery("#" + arrayCampos[0]);
	var $el2 = jQuery("#" + arrayCampos[1]);
	var $el3 = jQuery("#" + arrayCampos[2]);	
	var $el4 = jQuery("#" + arrayCampos[3]); //label vara	
	var $el5 = jQuery("#" + arrayCampos[4]); // label funcionarios
	
	if ($el3.val()=='D'){ //defensor
		$el=$el2; //vara
		$oc=$el1;
		$exL=$el4;
	}else{ //servidor
		$el=$el1; //funcionario	
		$oc=$el2;
		$exL=$el5;
	}	
	if(sinal==0){// comparar se e diferente
		if(valorCampo!=valorCompara){
			if(mostrar){						
				$el.css("display", "block"); 
				$oc.css("display", "none"); 
				$exL.css("display", "block"); 
			}else{
				$el.css("display", "none");
				$oc.css("display", "block");
				$exL.css("display", "none"); 
			}
		}
	}	
}


jQuery(document).bind("ready", function(){

    lc = new LoadingController();
    
});

LoadingController = function(){

    /**
     * @private
     */
    var $loadingElement = jQuery("#nowLoading");
    
    /**
     * @public
     */
    return {
    
        /**
         * Mostra o indicador de carregamento
         * @param {Object} sourceElement
         */
        start: function(requestObject){
            $loadingElement.fadeIn("normal");		
        },
        
        /**
         * Esconde o indicador de carregamento
         * @param {Object} sourceElement
         */
        stop: function(requestObject){
            $loadingElement.fadeOut("normal");
        }
        
    };
};


jQuery(function(){
        jQuery('.tbody tr')
            .mouseover(function(){
                jQuery(this).addClass('over');
            })
            .mouseout(function(){
                jQuery(this).removeClass('over');
            });
});

jQuery(document).ready(function(){
	
	
	jQuery(".telefone").mask("(99) 9999-9999");	
	jQuery(".cpf").mask("999.999.999-99");
	jQuery(".cnpj").mask("99.999.999/9999-99");
	jQuery(".cep").mask("99999-999");
	jQuery(".data").mask("99/99/9999");
	jQuery(".num_unica").mask("9999999-99.9999.999.9999");
	jQuery(".num_anterior").mask("9999999-9/9999");
});

function comparaCampos(campo1, campo2, msg){        
        //alert(campo1+campo2);
    if (document.getElementById(campo1).value != document.getElementById(campo2).value) {
        alert(msg);
    }
}
