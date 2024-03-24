jQuery(document).ready(function (){
	jQuery('.grid td').each(function(index) {
                var altura_coluna2 = jQuery(this).width();
                var tam_th = jQuery('.grid th').eq(index).width();
                var tam_td = jQuery(this).width();

                if(tam_th > tam_td){
                    jQuery(this).width(tam_th)
                }else{
                    jQuery('.grid th').eq(index).width(tam_td);
                }
                if(index == (jQuery(".grid td").eq(0).children().size() - 1)){
                    return false;
                }
	});


});