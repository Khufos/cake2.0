function exibirUnidadePrisional(){
    // 2 refere-se a opção reciclagem nos presídios do combo Projetos
    if($.inArray("2", $("#NugamAtendimentoProjetoNugamProjetoId").val()) !== -1){
         $('#exibeUnidadePrisional').show('slow');
    }else{
         $('#exibeUnidadePrisional').hide('slow');
    }
     
 }
$(document).ready(function(){
    $(".autocompletar").select2();
    $("#NugamAtendimentoProjetoNugamProjetoId").change(function() {
        exibirUnidadePrisional();
    });
});
exibirUnidadePrisional();


 
