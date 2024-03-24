<div id="tabDocumentos" class="principal pagina-autos scroll-y">
    <div id="PainelDocumentos" class="custom-panel">
        <div class="well" style="width: 30%; margin-left: 25px;">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Id a partir de</label>
                        <input id="id_de" name="id_de" onkeyup="apenasNumeros(this)">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Até</label>
                        <input id="id_ate" name="id_ate" onkeyup="apenasNumeros(this)">
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" id="documentos_pesquisar">Pesquisar</button>
                    <button class="btn btn-default" id="documentos_limpar">Limpar</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid rich-panel" id="documentos" style="margin-left: 25px; margin-right: 25px; padding-bottom: 10px;">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="tab-titulo">Documentos</h5>
                </div>
            </div>
            <table class="table table-striped" id="tabela_documentos">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Juntada em</th>
                        <th>Documento</th>
                        <th>Tipo</th>
                        <th>Anexo</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>