

    <div id="dialogoFormularioPadrao" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: 5px;">
                    <div style="padding: 10px; color: #fff; background-color: #419641">
                        <h4 class="modal-title" style="font-size: medium;">Autenticação PJE</h4>
                    </div>                
                </div>
                <div class="modal-body" style="background: #fff">
                    <form id="formAutentPje" class="form-horizontal">
                        <div class="form-group" style="margin-bottom: -15px;">
                            <label for="senhaPje" class="col-sm-2 control-label">Senha</label>
                            <div class="col-sm-10">
                                <input type="password" name="senhaAutenticacaoPje" class="form-control" id="senhaPje" placeholder="Informe sua senha do PJE">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="padding: 5px">
                    <div style="padding: 6px; background-color: #e1e1e1">
                        <button id="btnmodalform" type="button" class="btn btn-primary btn-sm" style="float:none">Confirmar</button>
                        <button id="btnmodalformSegund" type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dialogoConfirmacaoPadrao" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width: 470px;">
            <div class="modal-content">
                <div class="modal-header" style="padding: 5px;">
                    <div style="padding: 10px; color: #fff; background-color: #419641">
                        <h4 class="modal-title" style="font-size: medium;">Confirmação</h4>
                    </div>                
                </div>
                <div class="modal-body" style="background: #fff">
                    <div class="row" style="display: flex;align-items: center;">
                        <span style="font-size: 30px; color: #419641" class="glyphicon glyphicon-question-sign col-md-1" aria-hidden="true"></span>
                        <div class="col-md-11" id="txtMsgConfirmacao"></div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 5px">
                    <div style="padding: 6px; background-color: #e1e1e1">
                        <button id="btnmodalPrincipal" type="button" class="btn btn-primary btn-sm" style="float:none"></button>
                        <button id="btnmodalSegundario" type="button" class="btn btn-default btn-sm"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dialogoAvisoPadrao" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width: 470px;">
            <div class="modal-content">
                <div class="modal-header" style="padding: 5px;">
                    <div id="rotulo" style="padding: 10px; color: #fff;">
                        <h4 id="ttlModal"class="modal-title" style="font-size: medium;"></h4>
                    </div>                
                </div>
                <div class="modal-body" style="background: #fff">
                    <div class="row" style="display: flex;align-items: center;">
                        <span id="iconeModal" style="font-size: 30px" class="glyphicon col-md-1" aria-hidden="true"></span>
                        <div class="col-md-11" id="txtMsgAviso"></div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 5px">
                    <div style="padding: 6px; background-color: #e1e1e1">
                        <button id="btnModalAviso" type="button" class="btn btn-default btn-sm" style="float:none">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dialogoSituacaoExped" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: 5px;">
                    <div style="padding: 10px; color: #fff; background-color: #419641">
                        <h4 class="modal-title" style="font-size: medium;">Situação dos Expedientes</h4>
                    </div> 
                </div>
                <div class="modal-body" style="background: #fff; padding: 5px;">
                    <div id="sitExpedPje" class="row" style="margin-right: 0px; margin-left: 0px;"></div>
                </div>
                <div class="modal-footer" style="padding: 5px">
                    <div style="padding: 6px; background-color: #e1e1e1">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float:none">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

