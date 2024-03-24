// JavaScript Document
<script>
function VerificarEnter(e) {

        var evento = window.event || e;
        var tecla = evento.keyCode || evento.witch;
        if (tecla == 13) {
                alert("Não é permitido apertar a tecla Enter! quando terminado o cadastro aperte o botão concluir ao final do formulário.");
                return false;
        }

}
</script>

