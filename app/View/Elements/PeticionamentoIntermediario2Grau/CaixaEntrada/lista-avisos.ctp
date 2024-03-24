<div id="modalListaAvisos" class="modal my-modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog my-modal-dialog" role="document" style="width: 60%;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <div style="padding: 10px; color: #fff; background-color: #419641">
                    <h4 id="titulo-modal-avisos" class="modal-title" style="font-size: medium;">Expedientes associados ao processo:</h4>
                </div>                
            </div>
            <div class="modal-body" style="background: #fff">
                <div class="row" style="padding-left: 8px; padding-right: 8px;overflow-y: scroll;max-height: 300px;">
                    <table id="tabela-avisos-associados" class="table table-bordered table-striped">
                        <thead>
                            <th style='text-align:center;vertical-align: middle;'>Selecione</br><input type="checkbox" id="checkTodosAvisosAssociados"></th>
                            <th style='vertical-align: middle;'>Número</th>
                            <th style='vertical-align: middle;'>Destinatário</th>
                            <th style='vertical-align: middle;'>Data de expedição de intimação</th>
                            <th style='vertical-align: middle;'>Data limite de manifestação</th>
                            <th style='vertical-align: middle;'>Status do prazo</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" style="padding: 5px">
                <div style="padding: 6px; background-color: #e1e1e1">
                    <button id="btnVoltarModalAssociados" type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float:none" style="margin-right: 8px;">Voltar</button>
                    <button id="btnTomarCienciaAssociados" type="button" class="btn btn-primary btn-sm">Tomar Ciência</button>
                </div>
            </div>
        </div>
    </div>
</div>
