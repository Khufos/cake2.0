<div id="tabAutos" class="principal pagina-autos scroll-y">
    <div class="container-fluid content">
        <div class="visible-xs-block mt-50 menu-mobile">
            <div class="btn-group btn-group-justified btn-tab-group" role="group">
                <a href="#divTimeLine" class="btn btn-flat active"><i class="fa fa-list-ul mr-5"></i>Cronologia</a>
                <a href="#detalheDocumento" class="btn btn-flat"><i class="fa fa-file mr-5"></i>Documentos</a>
                <a href="#documentosFavoritos" class="btn btn-flat"><i class="fa fa-star mr-5"></i>Favoritos</a>
            </div>
        </div>
        <!-- BARRA DE PESQUISA EM DOCUMENTOS -->
        <div id="divTimeLine" class="col-sm-3 timeline open mobile-open">

            <div class="pesquisa affix-top" data-spy="affix" data-offset-top="10" data-target=".timeline">
                <div class="input-group"><input id="divTimeLine:txtPesquisa" type="text" name="divTimeLine:txtPesquisa" class="form-control placeholder" title="Pesquisar documentos ou movimentos" placeholder="">

                    <div class="input-group-btn">

                        <div class="btn-group drop-menu">
                            <a class="btn btn-flat btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Filtros" alt="Ícone de filtro">
                                <i class="fa fa-filter"></i>
                                <span class="sr-only">Ícone de filtro</span>
                            </a>
                            <ul class="dropdown-menu filtros">
                                <li>
                                    <a class="btn-inverter-ordenacao" href="#" onclick="ordenarTimeLine(TIMELINE_EM_ORDEM_CRESCENTE)">
                                        <i class="fa fa-sort-amount-desc mr-10"></i>Inverter ordenação
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-flat btn-default hidden-sm" href="#" id="divTimeLine:btnPesquisar" name="divTimeLine:btnPesquisar" onclick="_pesquisar()" title="Pesquisar">
                            <i class="fa fa-search text-muted"></i>
                            <span class="sr-only">Ícone de lupa</span>
                        </a>
                        <a class="btn btn-flat btn-default hidden-sm" href="#" id="divTimeLine:btnAtualizar" name="divTimeLine:btnAtualizar" onclick="recarregarPagina()" title="Atualizar">
                            <i class="fa fa-refresh text-muted"></i>
                            <span class="sr-only">Ícone de atualizar</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- BARRA LATERAL DE DOCUMENTOS E MOVIMENTOS -->
            <div id="divTimeLine:divEventosTimeLine" class="eventos-timeline scroll-y barra_docs_movimentos">
                <input type="hidden" id="totalPaginas" value="1">
                <input type="hidden" id="paginaAtual" value="1">
                <div id="divTimeLine:eventosTimeLineElement">
                    <?php foreach($processo['PjeProcessoMovimento'] as $movimentoKey => $movimento): ?>
                        <!-- MOVIMENTO 1 -->
                        <div class="card-exibicao media interno tipo-M">
                            <!-- Bolinha -->
                            <div class="media-left">
                                <span class="icon-auto sistema tip-right"></span>
                            </div>
                            <div class="media-body box ">
                                <div id="<?php echo $movimento['identificador_movimento']; ?>">
                                    <i
                                        class="fa fa-bullhorn mr-10  tip"
                                        style="display: none;">
                                    </i>
                                    <span class="text-upper texto-movimento"><?php echo $movimento['complemento']; ?></span>
                                </div>

                                <div class="anexos">
                                    <?php if($movimento['pje_processo_documento_id'] != null): ?>
                                        <?php foreach($processo['PjeProcessoDocumento'] as $documentoKey => $documento): ?>
                                            <?php if($movimento['pje_processo_documento_id'] == $documento['documento_id']): ?>
                                                <?php $titulo = $documento['documento_id'] . ' - ' . $documento['descricao']; ?>
                                                <a
                                                    href="#"
                                                    id="<?php echo $documento['documento_id']; ?>"
                                                    onclick="exibirDocumento('<?php echo $documento['documento_id']; ?>', '<?php echo $titulo; ?>')">
                                                    <i class="fa fa-file-pdf-o mr-10 tip" aria-hidden="true"></i>
                                                    <span class="nome-documento"><?php echo $titulo; ?></span>
                                                    <i class="fa fa-clipboard" title="Copiar Documento" onclick="copiarDocumento(<?php echo $documento['documento_id']; ?>)" style="font-size: small; padding-left: 7px;"></i>
                                                </a>
                                                <ul class="tree">
                                                    <?php foreach($processo['PjeProcessoDocumento'] as $documentoKeyFilho => $documentoFilho): ?>
                                                        <?php if($documentoFilho['id_documento_vinculado'] == $documento['documento_id']): ?>
                                                            <?php $titulo = $documentoFilho['documento_id'] . ' - ' . $documentoFilho['descricao']; ?>
                                                            <li>
                                                                <a
                                                                    href="#"
                                                                    id="<?php echo $documentoFilho['documento_id']; ?>"
                                                                    onclick="exibirDocumento('<?php echo $documentoFilho['documento_id']; ?>', '<?php echo $titulo; ?>')">
                                                                    <i class="fa fa-file-pdf-o mr-10"></i>
                                                                    <span class="nome-documento"><?php echo $titulo; ?></span>
                                                                    <i class="fa fa-clipboard" title="Copiar Documento" onclick="copiarDocumento(<?php echo $documentoFilho['documento_id']; ?>)" style="font-size: small; padding-left: 7px;"></i>
                                                                </a>
                                                            </li>
                                                            <?php unset($processo['PjeProcessoDocumento'][$documentoKeyFilho]); ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <?php unset($processo['PjeProcessoDocumento'][$documentoKey]); ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                </div>
                                <div class="col-sm-12">
                                    <small class="data-hora text-muted pull-right"><?php echo date_format(date_create($movimento['data_hora']), 'Y-m-d H:i:s'); ?></small>
                                </div>
                            </div>
                        </div>
                        <?php unset($processo['PjeProcessoMovimento'][$movimentoKey]); ?>
                    <?php endforeach; ?>
                    <?php foreach($processo['PjeProcessoDocumento'] as $documentoKey => $documento): ?>
                        <?php if($documento['id_documento_vinculado'] != null) continue; ?>

                        <div class="card-exibicao media interno tipo-D">
                        <!-- Bolinha -->
                        <div class="media-left">
                            <span class="icon-auto sistema tip-right"></span>
                        </div>
                        <div class="media-body box">
                            <div class="anexos">
                                <?php $titulo = $documento['documento_id'] . ' - ' . $documento['descricao']; ?>
                                <a
                                    href="#"
                                    id="<?php echo $documento['documento_id']; ?>"
                                    onclick="exibirDocumento('<?php echo $documento['documento_id']; ?>', '<?php echo $titulo; ?>')">
                                    <i class="fa fa-file-pdf-o mr-10 tip" aria-hidden="true"></i>
                                    <span class="nome-documento"><?php echo $titulo; ?></span>
                                    <i class="fa fa-clipboard" title="Copiar Documento" onclick="copiarDocumento(<?php echo $documento['documento_id']; ?>)" style="font-size: small; padding-left: 7px;"></i>
                                </a>
                                <ul class="tree">
                                    <?php foreach($processo['PjeProcessoDocumento'] as $documentoKeyFilho => $documentoFilho): ?>
                                        <?php if($documentoFilho['id_documento_vinculado'] == $documento['documento_id']): ?>
                                            <?php $titulo = $documentoFilho['documento_id'] . ' - ' . $documentoFilho['descricao']; ?>
                                            <li>
                                                <a
                                                    href="#"
                                                    id="<?php echo $documentoFilho['documento_id']; ?>"
                                                    onclick="exibirDocumento('<?php echo $documentoFilho['documento_id']; ?>', '<?php echo $titulo; ?>')">
                                                    <i class="fa fa-file-pdf-o mr-10"></i>
                                                    <span class="nome-documento"><?php echo $titulo; ?></span>
                                                    <i class="fa fa-clipboard" title="Copiar Documento" onclick="copiarDocumento(<?php echo $documentoFilho['documento_id']; ?>)" style="font-size: small; padding-left: 7px;"></i>
                                                </a>
                                            </li>
                                            <?php unset($processo['PjeProcessoDocumento'][$documentoKeyFilho]); ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <?php unset($processo['PjeProcessoDocumento'][$documentoKey]); ?>
                            </div>
                            <div class="col-sm-12">
                                <small class="data-hora text-muted pull-right"><?php echo date_format(date_create($documento['data_hora']), 'Y-m-d H:i:s'); ?></small>
                            </div>
                        </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div id="detalheDocumento" class="col-xs-12 no-scroll detalhe-documento box timeline-open mobile-close">
            <div class="timeline-tab hidden-xs">
                <a class="btn btn-flat btn-timeline" title="Exibir cronologia" href="#">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </div>
            <!-- TITULO IFRAME -->
            <div id="detalheDocumento:tituloDocumento" class="row">
                <div id="detalheDocumento:j_id437" class="titulo-documento header-exibicao col-md-12 mt-5 mb-10">
                    <h3 class="media-heading">
                        <a href="#" title="Abrir documento em outra página" onclick="">
                            <span id="tituloDocumento"></span></a>
                    </h3>
                    <a id="btnPeticionar" href="<?php echo $urlPeticionar ?>" type="button" class="btn btn-success" target="_blank">Peticionar</a>
                </div>
                <div id="detalheDocumento:toolbarDocumento" class="menu-documento col-md-12">
                    <div class="hidden-xs hidden-sm col-md-4"></div>
                    <div class="col-xs-6 col-sm-6 col-md-4 text-center">

                        <ul class="nav nav-pills btn-documento">
                            <li><a class="btn-anterior" href="#" id="detalheDocumento:primeiroDocumento" name="detalheDocumento:primeiroDocumento" onclick="_abrirPrimeiroAnexo()" title="Primeiro documento">
                                    <i class="fa fa-arrow-left fa-first" aria-hidden="true"></i>
                                    <span class="sr-only">Ícone de seta para esquerda</span></a>
                            </li>
                            <li><a class="btn-anterior" href="#" id="detalheDocumento:documentoAnterior" name="detalheDocumento:documentoAnterior" onclick="_abrirAnexoAnterior()" title="Documento anterior">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    <span class="sr-only">Ícone de seta para esquerda</span></a>
                            </li>
                            <li><span id="contador-paginas" class="contador-paginas" title="Contagem de documentos"></span>
                            </li>
                            <li><a class="btn-proximo" href="#" id="detalheDocumento:proximoDocumento" name="detalheDocumento:proximoDocumento" onclick="_abrirProximoAnexo()" title="Próximo documento">
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    <span class="sr-only">Ícone de seta para direita</span></a>
                            </li>
                            <li><a class="btn-proximo" href="#" id="detalheDocumento:ultimoDocumento" name="detalheDocumento:ultimoDocumento" onclick="_abrirUltimoAnexo()" title="Último documento">
                                    <i class="fa fa-arrow-right fa-last" aria-hidden="true"></i>
                                    <span class="sr-only">Ícone de seta para direita</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- IFRAME -->
            <div id="detalheDocumento:quadroDocumento" class="quadro-preview">
                <div id="detalheDocumento:docBinario" class="container-fluid content scroll-y">
                    <iframe id="frameBinario" src="" width="100%" height="100%" style="border:5px #717171 solid; z-index:0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>