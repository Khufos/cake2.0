$(document).ready(function () {
   
    $("#submit").click(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "familia_sucessoes/add",
            //$(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                console.log("teste" + response);
                //$('#resAssistido').html(response);
            }
        });
    });

    
});
