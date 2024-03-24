(function($) {
    $(document).bind("initTrule", function() {
        // Atalho para os validadores
        var _valid = $.fn.trule.validators;
		
        // Define configura��es globais
        $().trule({
            messages: window.messages,
            firstErro: function(r) {
                r.oRef.focus();
            },
            error: function(r, msg) {
                $(r.oRef)
                .addClass("classeDeErroNoCampo")
                .removeClass("classeDeSucessoNoCampo")
					
                $("#"+r.oRef.getAttribute("name")+"_BoxError")
                .show()
                .addClass("classeDeErroNaMensagem")
                .removeClass("classeDeSucessoNaMensagem")
                .text(msg);
            },
            success: function(r, msg) {
                $(r.oRef)
                .addClass("classeDeSucessoNoCampo")
                .removeClass("classeDeErroNoCampo")
					
                $("#"+r.oRef.getAttribute("name")+"_BoxError")
                .show()
                .addClass("classeDeSucessoNaMensagem")
                .removeClass("classeDeErroNaMensagem")
                .text("");
            }
        });
		
        $(".validateDDDTelefone").trule().addRule({
            name: "validateDDDTelefone",
            event: "blur",
            rule: function() {
                return true;
            },
            mask: "(99) 9999-9999"
        })
		
        // Adiciona handles de evento ao submit dos formul�rios
        $("form").bind("submit", function(event) {
            if (!$(this).trule().validateAll())
                event.preventDefault();
        });
    });
})($);