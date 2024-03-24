jQuery(function(){
      jQuery("#FichaMensagem").keyup(function(){
         var limite  = 1500
         var tamanho = jQuery(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         jQuery("#qtdCaracteres").text(contador)
         
         if(tamanho >= limite){
            var txt = jQuery(this).val().substring(0, limite)
            jQuery(this).val(txt)
         }
      })
      
})