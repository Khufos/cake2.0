<style>
    input#senhaAutenticacaoPjeElement {
        -webkit-text-security: disc;
        text-security: disc;
    }
</style>

<div id="modalSenhaPje" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="background-color: #aabdaf;">
            <div class="modal-header" style="padding: 5px; text-align: center;">
                <div style="padding: 10px;">
                    <h4 class="modal-title">Autenticação PJE</h4>
                </div>                
            </div>
            <div class="modal-body" style="background: #fff; text-align: center;">
                <div style="margin-bottom: 15px;"><b>Essa senha será utilizada nas integrações entre o SIGAD e o PJE, quando não for necessário o uso do token</b></div>
                <form id="formAutentPje" class="form-horizontal" >
                    <div class="form-group" style="margin-right: 0; margin-left: 0; margin-bottom: 0;">
                        <input type="text" name="senhaAutenticacaoPjeElement" autocomplete="off" class="form-control" id="senhaAutenticacaoPjeElement" placeholder="Informe sua senha do PJE">
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 5px;">
                <div style="padding: 6px;">
                    <button id="btnSalvarSenhaPje" onclick="salvarSenhaPje()" type="button" class="btn btn-primary btn-sm" style="float:none">Confirmar</button>
                    <button id="btnmodalformSegund" type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialogoAvisoPadraoSenhaPje" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width: 470px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <div id="rotuloSenhaPje" style="padding: 10px; color: #fff;">
                    <h4 id="ttlModalSenhaPje"class="modal-title" style="font-size: medium;"></h4>
                </div>                
            </div>
            <div class="modal-body" style="background: #fff">
                <div class="row" style="display: flex;align-items: center;">
                    <span id="iconeModalSenhaPje" style="font-size: 30px" class="glyphicon col-md-1" aria-hidden="true"></span>
                    <div class="col-md-11" id="txtMsgAvisoSenhaPje"></div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 5px">
                <div style="padding: 6px; background-color: #e1e1e1">
                    <button id="fecharModalAvisoSenhaPje" type="button" class="btn btn-default btn-sm" style="float:none" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    

    $(document).ready(function () {

        $("#btnModalSenhaPje").click(function(){
            abrirModalPjeSenha();
        });

    });

    function abrirModalPjeSenha() {
        $("#senhaAutenticacaoPjeElement").val("");
        $("#modalSenhaPje").modal({
            keyboard: false,
            backdrop: 'static'
        });
    }

    function modalPjeSenha(json){
        //Status false => Modal de Erro
        //Status true => Modal de Sucesso
        txtMsgAvisoSenhaPje.innerHTML = json.msg;
        if(json.status == false){
            $("#rotuloSenhaPje").css("background-color", "#d52626");
            $("#rotuloSenhaPje").css("color", "#fff");
            $("#iconeModalSenhaPje").removeClass("glyphicon-warning-sign glyphicon-ok-sign").addClass("glyphicon-remove-sign");
            $("#iconeModalSenhaPje").css("color", "#d52626");
            ttlModalSenhaPje.innerHTML = "Ops! Algo deu errado";

            $("#fecharModalAvisoSenhaPje").attr("onclick", "abrirModalPjeSenha()");
        } else {
            $("#rotuloSenhaPje").css("background-color", "rgb(84, 164, 55)");
            $("#rotuloSenhaPje").css("color", "#fff");
            $("#iconeModalSenhaPje").removeClass("glyphicon-warning-sign glyphicon-remove-sign").addClass("glyphicon-ok-sign");
            $("#iconeModalSenhaPje").css("color", "rgb(84, 164, 55)");
            ttlModalSenhaPje.innerHTML = "Sucesso";

            $("#fecharModalAvisoSenhaPje").attr("onclick", "");
        }
        
        $("#dialogoAvisoPadraoSenhaPje").modal({
            keyboard: false,
            backdrop: 'static'
        });
    }

    function validarSenhaPje(fun) {
        var retornoSenhaPje;
        var instanciaAtual = instanciaPje;

        $.ajax({
            url: "/peticionamento_intermediarios/validar_senha_pje/" + instanciaAtual,
            type: "GET",
            datatype: 'json',
            async: true,
            success: fun
        });

        return retornoSenhaPje;
    }

    function salvarSenhaPje() {
        var senhaAutenticacaoPjeElement = $("#senhaAutenticacaoPjeElement").val();
        var instanciaAtual = instanciaPje;

        if(senhaAutenticacaoPjeElement == "") {
            alert("Informe a Senha do PJE");
            return;
        }

        $.ajax({
            url: "/peticionamento_intermediarios/salvar_senha_pje/",
            type: "POST",
            datatype: 'json',
            data: {
                senhaAutenticacaoPje: senhaAutenticacaoPjeElement,
                instancia: instanciaAtual
            },
            success: function(result) {
                var json = JSON.parse(result.trim());

                $("#modalSenhaPje").modal('hide');
                modalPjeSenha(json)
            }
        });
    }

</script>