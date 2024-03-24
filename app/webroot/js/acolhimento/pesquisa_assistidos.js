$(document).ready(function(){
    $(':submit').on('click', function(e){
            
            alert('dd');
            console.log($('#formAssitido').serialize());
            $.post('pesquisa_ajax', {
                data: $('#formAssitido').serializeArray()
//                data: JSON.parse($("#formAssitido").serialize())
              }).done(function( resp ) {
//                console.log( "Data Loaded: " + resp );
                 $('#example').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "ajax": "scripts/server_processing.php",
                    "deferLoading": 57
                } );
              });
              e.preventDefault();
    });
});
