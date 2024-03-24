<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mt-28">
                Anexar a partir do:
                <i class="fa fa-info-circle" style="cursor:hand;" data-toggle="tooltip" data-placement="right" title=".PDF, .DOC, .XLS"></i>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 d-flex justify-content-between">

            <input
                type="file"
                id="fileInput"
                name="fileUploaded[]"
                hidden="true"
                style="display:none"
                accept="application/pdf"
                multiple
            />

            <!-- Botão: Computador -->
            <?php
            echo $this->Form->button(
                $this->Html->div(null, '<i class="fa fa-paperclip"></i> Computador'),
                array(
                    'type' => 'button',
                    'class' => 'btn btn-default',
                    'id' => 'btnComputador'
                )
            ); ?>

            <!-- Botão: SIGAD -->
            <?php
                if(!$peticaoResumida){
                    echo $this->Html->tag('button',
                    $this->Html->div(null, '<i class="fa fa-database"></i> SIGAD'),
                        array(
                            'class' => 'btn btn-default ml-4',
                            'id' => 'btnSigad'
                        )
                    );
                }
            ?>

        </div>
    </div>

    <div class="row mt-8">
        <div class="col-md-12" id="lista_anexos">
            <table id="table_anexos" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Doc. Principal</th>
                        <th>Ordenação</th>
                        <th style="min-width: 400px;">Documento</th>
                        <th>Tipo do Documento</th>
                        <th>Descrição</th>
                        <th style="min-width: 90px;">Sigiloso</th>
                        <th class="actions" colspan="2" style="width:100px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!isset($id) || empty($id)) : ?>
                        <tr class="nosort">
                            <th colspan="7" class="text-center">Nenhum anexo</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../../js/jquery-ui-1.13.2/jquery-ui.min.js"></script>

<!-- JS: Eventos -->
<script>

    $("#btnComputador").on('click', function() {
        if(envioAgendado) {
            var msg = "O agendamento de envio offline para esse processo será cancelado. Deseja continuar?";
            if(!confirm(msg)) return;
        }

        $("#fileInput").click();
    });

    $('#btnSigad').on('click', function(event) {

        <?php if($cadastroIncompleto): ?>
            setLocalStorage('<?php echo $id; ?>');

            event.preventDefault();

            var pessoaNome = $("#PeticionamentoIntermediarioAutores option:selected").text();
            if($("#flexRadioAssistidoReu").is(":checked")){
                pessoaNome = $("#PeticionamentoIntermediarioReus option:selected").text();
            }else if($("#flexRadioAssistidoInteressado").is(":checked")){
                pessoaNome = $("#PeticionamentoIntermediarioOutrosInteressados option:selected").text();
            }

            var idRef = <?php echo $id; ?>;

            $.ajax({
                url: "/peticionamento_intermediarios/obter_assistido_id/",
                type: "POST",
                datatype: 'json',
                async: false,
                data: {
                    pessoaNome: encodeURIComponent(pessoaNome)
                },
                success: function(result) {

                    result = result.trim();
                    var url;
                    if(!result || typeof result === 'undefined'){
                        url = '/peticionamento_intermediarios/anexos_sigad/' + idRef + '?trs=1';
                    }else{
                        url = '/peticionamento_intermediarios/anexos_sigad/' + idRef + '?trs=1&assistido_id=' + result;
                    }

                    window.location.href = url;

                },
                error: function(error) {
                    alert('Não foi possível verificar a existência do assistido.');
                }
            });

        <?php else: ?>

            event.preventDefault();
            const url = '<?php echo $this->Html->url([
                'controller' => 'peticionamento_intermediarios',
                'action' => 'anexos_sigad',
                $id,
                '?' => ['trs' => 1]
            ]);?>';

            window.location.href = url;

        <?php endif; ?>

    });

    //Adiciona novo anexo
    $("#fileInput").on('change', function(e) {

        function exibirMensagemDeErro(errMsg) {
            alert(errMsg);
        }

        var fileSelected = e.target.files[0];

        if (!fileSelected) {
            return;
        }

        var fileName = fileSelected.name;
        var fileType = fileSelected.type;

        if (!fileName || !fileType) {
            alert("O arquivo selecionado é inválido.");
            return;
        }

        if (fileType != 'application/pdf' &&
            fileType != 'application/doc' &&
            fileType != 'application/xls' &&
            fileType != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            alert("O arquivo selecionado é inválido.");
            return;
        }

        var form = document.getElementById('formEdit');
        var model = document.getElementById('fileInput');
        var formData = new FormData(form);
        formData.append('cancelarAgendamento', envioAgendado);

        const url = "<?php
            echo $this->Html->url([
                'controller' => 'PeticionamentoIntermediarios',
                'action' => 'upload_multiplos_anexos',
                '?' => ['trs' => 1]
                ]);
            ?>";

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR) {
                envioAgendado = false;
                               
                reloadAnexosTable();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                exibirMensagemDeErro(jqXHR.responseText);
            },
            complete: function(jqXHR, textStatus) {
                $("#fileInput").val(null);
            }
        });
    });

</script>

<!-- JS: Procedimentos/rotinas -->
<script>

    const ANEXO_ORIGEM_IMPORTACAO_SIGAD = '1';
    const ANEXO_ORIGEM_UPLOAD = '2';
    const ANEXO_ORIGEM_EDITOR_DE_PETICIONAMENTO_INTERMEDIARIO = '3';

    const listaDeopcoesDeTipoDeDocumento = JSON.parse('<?php echo json_encode($tipoDocumentos) ?>');
    const listaDeopcoesDeParaSimNao = JSON.parse('<?php echo json_encode($simnao) ?>');
    const listaTodosAtosPraticados = JSON.parse('<?php echo $todosAtosPraticados ?>');

    var CACHE_DE_ANEXOS = [];
    let descricaoOriginal = '';

    var tipoDocumentoEmAtualizacao = false;

    function criarLinhaNaTabelaParaOArquivo(dado, tabela) {
        const anexoId = dado['Anexo'].id;
        const origemDoAnexo = dado['AnexosPeticionamentoIntermediarios'].tipo_origem_anexos_id;

        let acaoDeRemocao = null;
        let textoDoTooltip = null;
        let alertarAlteracaoNoAnexo = false;
        switch(origemDoAnexo) {
            case ANEXO_ORIGEM_IMPORTACAO_SIGAD:
                acaoDeRemocao = `remover_importacao_de_anexo(${anexoId}, 'remover_importacao_de_anexo_sigad')`;
                textoDoTooltip = 'Anexo importado do SIGAD.';
                alertarAlteracaoNoAnexo = true;
                break;
            case ANEXO_ORIGEM_EDITOR_DE_PETICIONAMENTO_INTERMEDIARIO:
                acaoDeRemocao = `remover_importacao_de_anexo(${dado['Anexo'].id}, 'remover_anexo_do_editor_sigad')`;
                textoDoTooltip = 'Anexo criado através do editor de peticionamento.';
                break;
            case ANEXO_ORIGEM_UPLOAD:
                acaoDeRemocao = `delete_anexo(${anexoId})`;
                textoDoTooltip = 'Anexo criado a partir do computador.';
                break;
            default:
                throw new Error(`Origem do arquivo não identificada.
                Id da origem: ${origemDoAnexo}.
                Id do anexo: ${anexoId}.`
                );
        }

        let tr = document.createElement('tr');
        tr.setAttribute('id', `linha_${anexoId}`);

        let selecaoDeArquivo = document.createElement('td');
        selecaoDeArquivo.classList.add('text-center');

        let selecao = document.createElement('input');
        selecao.type = 'radio';
        selecao.name = 'AnexoSelecionado';
        selecao.required = true;
        selecao.value = anexoId;
        selecao.checked = selecao.value == anexoIdSelecionado;
        selecao.addEventListener('change', function(ev) {
            anexoIdSelecionado = ev.target.value;

            document
                .getElementById(`TipoDocumento_${anexoId}`)
                .dispatchEvent(new Event('change'));
        });

        selecaoDeArquivo.appendChild(selecao);

        let ordenacao = document.createElement('td');
        let posicaoInput = document.createElement('input');
        posicaoInput.type = 'hidden';
        posicaoInput.name = `Posicao[${anexoId}]`;
        posicaoInput.value = CACHE_DE_ANEXOS.indexOf(dado);

        let posicaoAcoes = document.createElement('div');
        posicaoAcoes.classList.add('seletor-posicao');

        let posicaoTexto = document.createElement('span');
        posicaoTexto.textContent = CACHE_DE_ANEXOS.indexOf(dado) + 1;
        posicaoAcoes.appendChild(posicaoTexto);

        ordenacao.appendChild(posicaoInput);
        ordenacao.appendChild(posicaoAcoes);

        let nomeDoArquivo = document.createElement('td');
        nomeDoArquivo.innerText = dado.Anexo.filename;

        let descricao = document.createElement('td');

        let descricaoInput = document.createElement('input');
        descricaoInput.type = 'text';
        descricaoInput.id = `Descricao_${anexoId}`;
        descricaoInput.name = `Descricao[${anexoId}]`;
        descricaoInput.classList.add('nome', 'form-control', 'input-sm', 'anexo-descricao');
        descricaoInput.required = true;
        descricaoInput.value = dado.Anexo.descricao;
        descricaoInput.addEventListener('change', (e) => {
            dado.Anexo.descricao = e.target.value;
        });

        if(alertarAlteracaoNoAnexo) {
            descricaoInput.addEventListener('focusin', salvarValorAtualDaDescricaoDoAnexo);
            descricaoInput.addEventListener('focusout', confirmarAlteracaoDeDescricaoDoAnexo);
        }


        descricao.appendChild(descricaoInput);

        let tipoDeDocumento = document.createElement('td');
        let tipoDeDocumentoSelect = document.createElement('select');
        tipoDeDocumentoSelect.id = `TipoDocumento_${anexoId}`;
        tipoDeDocumentoSelect.name = `TipoDocumento[${anexoId}]`;
        tipoDeDocumentoSelect.classList.add('form-control', 'input-sm', 'anexo-tipo');
        tipoDeDocumentoSelect.required = true;
        tipoDeDocumentoSelect.addEventListener('change', (e) => {
            if(selecao.value === anexoIdSelecionado) {
                const _tipoDeDocumentoId = e.target.value;
                atualizarAto(_tipoDeDocumentoId);
            }
        });

        tipoDeDocumentoSelect.addEventListener('change', (e) => {
            if(descricaoInput.value==='' && tipoDeDocumentoSelect.value!==''){
                descricaoInput.value=listaDeopcoesDeTipoDeDocumento[tipoDeDocumentoSelect.value];
                dado.Anexo.descricao = descricaoInput.value;
            }
        });

        tipoDeDocumentoSelect.add(new Option('Selecione Tipo do Documento', ''));
        Object.keys(listaDeopcoesDeTipoDeDocumento).forEach((index) => {
            tipoDeDocumentoSelect.add(new Option(listaDeopcoesDeTipoDeDocumento[index], index));
        });

        if(dado.AnexosPeticionamentoIntermediarios.tipo_documento_processual_id) {
            tipoDeDocumentoSelect.value = dado.AnexosPeticionamentoIntermediarios.tipo_documento_processual_id
        }else{
            let _optionPeticao = "31";
            tipoDeDocumentoSelect.value = _optionPeticao;
            descricaoInput.value=listaDeopcoesDeTipoDeDocumento[_optionPeticao];
        }

        tipoDeDocumentoSelect.addEventListener('change', (e) => {
            dado.AnexosPeticionamentoIntermediarios.tipo_documento_processual_id = e.target.value;
            alteraTipoDocumentoEmLote(e);
        });

        let tipoDeDocumentoDivFlex = document.createElement('div');
        tipoDeDocumentoDivFlex.classList.add('d-flex', 'justify-content-start');

        let tipoDocCheck = document.createElement('input');
        tipoDocCheck.id = `tipoDocCheck_${anexoId}`;
        tipoDocCheck.type = 'checkbox';
        tipoDocCheck.name = 'tipoDocCheck';
        tipoDocCheck.classList.add("tipoDocCheck");
        tipoDocCheck.checked = false;
        tipoDocCheck.addEventListener('change', function(e) {
            
        });

        tipoDeDocumentoDivFlex.appendChild(tipoDocCheck);
        tipoDeDocumentoDivFlex.appendChild(tipoDeDocumentoSelect);

        tipoDeDocumento.appendChild(tipoDeDocumentoDivFlex);

        let sigilo = document.createElement('td');
        let sigiloSelect = document.createElement('select');
        sigiloSelect.name = `Sigiloso[${anexoId}]`;
        sigiloSelect.classList.add('form-control', 'input-sm');
        sigiloSelect.required = true;

        Object.keys(listaDeopcoesDeParaSimNao).forEach((index) => {
            sigiloSelect.add(new Option(listaDeopcoesDeParaSimNao[index], index));
        });

        sigiloSelect.value = dado.Anexo.sigiloso ?? '0';

        sigiloSelect.addEventListener('change', (e) => {
            dado.Anexo.sigiloso = e.target.value;
        });

        sigilo.appendChild(sigiloSelect);

        let actions = document.createElement('td');
        actions.classList.add('actions');

        //Botão de download da lista de anexos

        let download = document.createElement('a');
        download.setAttribute('href', `/peticionamento_intermediarios/anexo_download/${anexoId}`);
        download.setAttribute('target', `_/peticionamento_intermediarios/anexo_download/${anexoId}`);
        download.setAttribute('title', 'Download');
        download.setAttribute('text-decoration', 'none');

        let downloadIcon = document.createElement('div');
        downloadIcon.classList.add('fa');
        downloadIcon.classList.add('fa-download');

        download.appendChild(downloadIcon);

        //Botão de remover da lista de anexos

        let remove = document.createElement('a');
        remove.setAttribute('onclick', acaoDeRemocao);
        remove.setAttribute('id', `v${anexoId}`);
        remove.setAttribute('title', 'Excluir');
        remove.classList.add('delete-anexo');

        let deleteIcon = document.createElement('div');
        deleteIcon.classList.add('fa');
        deleteIcon.classList.add('fa-trash');

        remove.appendChild(deleteIcon);

        let origemDoAnexoIcon = document.createElement('i');
        origemDoAnexoIcon.classList.add('fa', 'fa-question-circle', 'icon-button-default');
        origemDoAnexoIcon.setAttribute('title', textoDoTooltip);

        //Botão de editar da lista de anexos

        var docIsTemp = (dado['EditorTexto']['id'] != null);
        let btnEditDocument = document.createElement('a');
        if(docIsTemp){
            let btnEditDocumentIcon = document.createElement('div');
            btnEditDocumentIcon.classList.add('fa');
            btnEditDocumentIcon.classList.add('fa-edit');

            // btnEditDocument.setAttribute('href', '/peticionamento_intermediarios_editor_textos/edit/' + dado['AnexosPeticionamentoIntermediarios']['id']);
            btnEditDocument.setAttribute('onclick', 'editarDocumentoEditor("' + dado['AnexosPeticionamentoIntermediarios']['id'] + '", "' + anexoId + '")');
            btnEditDocument.setAttribute('title', 'Editar');
            btnEditDocument.appendChild(btnEditDocumentIcon);
        }

        actions.appendChild(download);
        actions.appendChild(remove);
        actions.appendChild(origemDoAnexoIcon);

        if(docIsTemp){
            actions.appendChild(btnEditDocument);
        }

        tr.appendChild(selecaoDeArquivo);
        tr.appendChild(ordenacao);
        tr.appendChild(nomeDoArquivo);
        tr.appendChild(tipoDeDocumento);
        tr.appendChild(descricao);
        tr.appendChild(sigilo);
        tr.appendChild(actions);

        tabela.appendChild(tr);

        if(selecao.value === anexoIdSelecionado) {
            document
                .getElementById(`TipoDocumento_${anexoId}`)
                .dispatchEvent(new Event('change'));
        }

        <?php if ($cadastroIncompleto) : ?>
            $(`#sig_${dado['Anexo'].id} select`).val('0');
        <?php endif; ?>

    }

    function getIndexAnexo(anexoId){
        var index = null;
        CACHE_DE_ANEXOS.forEach(function(item) {
            if(item.Anexo.id === anexoId){
                index = CACHE_DE_ANEXOS.indexOf(item);
            }
        });

        return index;
    }

    function adicionarMensagemDeTabelaVazia(tabela) {
        let tr = document.createElement('tr');
        tr.classList.add('nosort');
        tr.setAttribute('id', 'mensagem-tabela-vazia');

        let td = document.createElement('td');
        td.classList.add('text-center');
        td.setAttribute('colspan', 7);
        td.innerText = 'Nenhum anexo';

        tr.appendChild(td);
        tabela.appendChild(tr);
    }

    function removerMensagemDeTabelaVazia() {
        let element = document.getElementById('mensagem-tabela-vazia');
        if (element) {
            element.remove();
        }
    }

    function limparTabelaDeAnexos() {
        const tabela = document.querySelector('#table_anexos > tbody');
        [...tabela.children].forEach(e => {
            tabela.removeChild(e);
        });
    }

    function popularTabelaDeAnexos() {
        limparTabelaDeAnexos();

        var dados = CACHE_DE_ANEXOS;

        const tabela = document.querySelector('#table_anexos > tbody');

        if (dados.length === 0) {
            adicionarMensagemDeTabelaVazia(tabela);
            limparAtoPraticado();
            return;
        }

        removerMensagemDeTabelaVazia();
        dados.forEach(e => criarLinhaNaTabelaParaOArquivo(e, tabela));

        var firstRowSelector = 'tbody.ui-sortable tr:nth-child(1)';
        if(dados.length === 1){
            $(firstRowSelector).addClass('nosort');
        }else if(dados.length > 1 && $(firstRowSelector).hasClass('nosort')){
            $(firstRowSelector).removeClass('nosort');
        }
        
        salvarProgresso();
    }

    function selecionarAnexoPorDefault(anexoId) {
        if(anexoIdSelecionado) return;
        anexoIdSelecionado = anexoId;
    }

    function popularCacheDeAnexos(result) {
        var dados = eval("(" + result + ")");
        if(CACHE_DE_ANEXOS.length === 0){
            dados.forEach(e => {
                selecionarAnexoPorDefault(e.Anexo.id);

                let elementoJaExisteEmCache = CACHE_DE_ANEXOS
                    .filter(i => i.Anexo.id === e.Anexo.id)
                    .length > 0;

                if(elementoJaExisteEmCache) return;

                CACHE_DE_ANEXOS.push(e);
            });
        } else {
            dados.forEach(e => {
                selecionarAnexoPorDefault(e.Anexo.id);

                let elementoJaExisteEmCache = CACHE_DE_ANEXOS
                    .filter(i => i.Anexo.id === e.Anexo.id)
                    .length > 0;

                if(elementoJaExisteEmCache) return;

                e.AnexosPeticionamentoIntermediarios.tipo_origem_anexos_id == ANEXO_ORIGEM_EDITOR_DE_PETICIONAMENTO_INTERMEDIARIO
                ? CACHE_DE_ANEXOS.unshift(e)
                : CACHE_DE_ANEXOS.push(e);
            });
        }
    }

    function removerAnexoDoCache(anexoId) {
        const anexos = CACHE_DE_ANEXOS.filter((value) => value.Anexo.id == anexoId);

        if(!anexos) return;

        if (anexos.length > 1) {
            console.error('Falha ao remover do cache. Foi localizado mais de 1 anexo com o mesmo id.');
            return;
        }

        const index = CACHE_DE_ANEXOS.indexOf(anexos[0]);
        CACHE_DE_ANEXOS.splice(index, 1);

        if(anexoIdSelecionado == anexoId) {
            anexoIdSelecionado = null;
        }
    }

    function reloadAnexosTable() {

        <?php if($cadastroIncompleto): ?>
            if(listaAtualizada){
                listaAtualizada = false;
                return;
            }
        <?php endif ?>

        var idPet = $('#id').val();
        $.ajax({
            url: "/peticionamento_intermediarios/list_anexos/",
            type: "POST",
            datatype: 'json',
            data: {
                idPet: idPet
            },
            success: popularCacheDeAnexos,
            complete: function(_, __) {
                popularTabelaDeAnexos();
            }
        });
    }

    function delete_anexo(anexoId) {
        let url = '<?php echo $this->Html->url(['controller' => 'PeticionamentoIntermediarios', 'action' => 'anexo_delete', $id]) ?>';

        var msg = "Tem certeza que deseja excluir?";
        if(envioAgendado) {
            msg = "O agendamento de envio offline para esse processo será cancelado. " + msg;
        }

        if(!confirm(msg)) return;

        $.ajax({
            type: "POST",
            url: url,
            data: { 'anexoId': anexoId, 'cancelarAgendamento': envioAgendado },
            success: function(data) {
                envioAgendado = false;
                removerAnexoDoCache(anexoId);
                reloadAnexosTable();
            },
            error: function() {
                alert('O anexo não pôde ser excluído, por favor tente novamente.');
            },
            complete: function() {}
        });
    }

    function remover_importacao_de_anexo(anexoId, action) {
        var msg = "Deseja desassociar o arquivo?";
        if(envioAgendado) {
	        msg = "O agendamento de envio offline para esse processo será cancelado. " + msg;
        }

        if (!confirm(msg)) {
            return false;
        }
        const idAtual = '<?php echo $id; ?>';
        const url = '/peticionamento_intermediarios/' + action + "/" + idAtual;

        $.ajax({
            url: url,
            type: 'POST',
            data: {'anexoId': anexoId, 'cancelarAgendamento': envioAgendado},
            success: function(data) {
                envioAgendado = false;
                removerAnexoDoCache(anexoId);
                reloadAnexosTable();

                if(anexoIdEdicao == anexoId){
                    cancelarDocumentoEditor();
                }
            },
            error: function(_, __, ___) {
                alert('O anexo não pôde ser removido, por favor tente novamente.');
            }
        });

        return true;
    }

    function salvarValorAtualDaDescricaoDoAnexo(event) {
        descricaoOriginal = event.target.value;
    }

    function confirmarAlteracaoDeDescricaoDoAnexo(event) {
        const mensagem = 'A nova descrição também será alterada nos anexos do assistido.';

        if(event.target.value == descricaoOriginal) return;

        let alteracaoConfirmada = confirm(mensagem);

        if(!alteracaoConfirmada) {
            event.target.value = descricaoOriginal;
        };
    }

</script>

<!-- JS: Efeito de arrastar linha na tabela -->
<script>
	$(function() {
	  $("#table_anexos > tbody").sortable({
        cursor: "grabbing",
        items: "tr:not(.nosort)",
        start: function( event, ui ) {
            $(ui.item).addClass("linha-selecionada");
        },
        stop: function( event, ui ) {
            $(ui.item).removeClass("linha-selecionada");

            const arrayTabelaHtml = getTableArray();
            atualizaCacheAnexos(arrayTabelaHtml);
        }
      });
	});

    function getTableArray(){
        var arrayTabelaHtml = [];
        $("table#table_anexos tr").each(function(indexLinhaAtual) {

            var idLinhaAtual = $("table#table_anexos tr")[indexLinhaAtual].id;
            if(typeof idLinhaAtual === 'undefined' || idLinhaAtual === ''){
                return;
            }

            var idAnexo = idLinhaAtual.replace('linha_', '');
            arrayTabelaHtml.push({
                posicao : indexLinhaAtual,
                linhaId : idLinhaAtual,
                anexoId : idAnexo
            });

        });
        return arrayTabelaHtml;
    }

    function atualizaCacheAnexos(arrayTabelaHtml){

        var novoArrayCache = [];
        arrayTabelaHtml.forEach(function(itemHtml) {

            CACHE_DE_ANEXOS.forEach(function(item) {
                if(item.Anexo.id != itemHtml.anexoId){
                    return;
                }
                novoArrayCache.push(item);
            });

            var index = itemHtml.posicao - 1;
            $("#" + itemHtml.linhaId + " > td:nth-child(2) > input").val(index);
            $("#" + itemHtml.linhaId + " > td:nth-child(2) > div > span").html(itemHtml.posicao);

        });

        CACHE_DE_ANEXOS = novoArrayCache;

    }

    function alteraTipoDocumentoEmLote(elemento){

        if(tipoDocumentoEmAtualizacao){
            return;
        }
        
        tipoDocumentoEmAtualizacao = true;

        var _elemId = elemento.target.id;
        var _selValue = elemento.target.value;
        var _anexoId = _elemId.replace("TipoDocumento_", "");

        if(!$("#tipoDocCheck_" + _anexoId)[0].checked){
            tipoDocumentoEmAtualizacao = false;
            return;
        }

        $("[name^=tipoDocCheck]").each(function(index, element){
            
            let idAnexo = element.id;
            idAnexo = idAnexo.replace("tipoDocCheck_", "");
            if(idAnexo == _anexoId){
                return;
            }

            let valorCheck = element.checked;
            if(valorCheck){
                let _selectId = "#TipoDocumento_" + idAnexo;
                $(_selectId).val(_selValue).trigger('change');

                let _inputDesc = "#Descricao_" + idAnexo;
                if ($(_inputDesc).val() === '') {
                    $(_inputDesc).val(listaDeopcoesDeTipoDeDocumento[_selValue]);
                }
            }

        });

        tipoDocumentoEmAtualizacao = false;

    }

</script>