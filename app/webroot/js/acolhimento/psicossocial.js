$( document ).ready(function() {
  $('#exibir_social').on('click', function(e){
      e.preventDefault();
      $('#form_social').toggle('slow');
       $(this).text(function(i, text){
          return text === "Ocultar Psicossocial" ? "Exibir Psicossocial" : "Ocultar Psicossocial";
      });
  });
});
