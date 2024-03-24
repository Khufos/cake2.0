<div class="navbar-secundaria">

    <div style="float:right !important;">
        <ul class="nav navbar-nav" style="width: 60px;">
            <li class="dropdown drop-menu mais-detalhes">
                <a
                    href="#"
                    class="titulo-topo dropdown-toggle navbar-secundaria-titulo"
                    title="Menu"
                    alt="Menu"
                    data-toggle="dropdown"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="true"
                    >
                    <i class="fa fa-bars hamburguer-menu"></i>
                </a>

                <ul class="dropdown-menu hamburguer-opcoes">
                    <li>
                        <a onclick="setNovaOpcao('tabAutos');">Autos</a>
                    </li>
                    <?php if(!$isSegundoGrau): ?>
                        <li>
                            <a onclick="setNovaOpcao('tabExpedientes');">Expedientes</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a onclick="setNovaOpcao('tabCaracteristicas');">Características</a>
                    </li>
                    <li>
                        <a onclick="clickOpcaoDocumentos()">Documentos</a>
                    </li>
                </ul>

            </li>
        </ul>
    </div>

    <div style="float:right !important;">
        <ul class="nav navbar-nav">
            <li class="dropdown dropdownload drop-menu mais-detalhes2">
                <a 
                    href="#" 
                    class="titulo-topo dropdown-toggle navbar-secundaria-titulo" 
                    title="Download do Documento" 
                    alt="Download do Documento" 
                    role="button" 
                    aria-haspopup="true" 
                    aria-expanded="true"
                    >
                    <i class="fa fa-download hamburguer-menu"></i>          
                </a>
                <ul class="dropdown-menu" style="width: 500px !important; right: 0; position: absolute; left: auto;">
                    <form id="formDownloadDocumento">
                    <div class="col-xs-12 col-sm-12">
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="cbTipoDocumento">Tipo de documento</label>
                            <select id="cbTipoDocumento" name="cbTipoDocumento" class="form-control" size="1">
                                <option value="">Selecione</option>
                                <?php foreach ($listaTipoDocumentos['tipo_documento'] as $tipoDoc) { ?>
                                    <option value="<?php echo $tipoDoc->id; ?>"><?php echo $tipoDoc->label; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                        
                    <div class="col-xs-12 col-sm-12">
                        <div class="form-group col-xs-6 col-md-6">
                            <label for="idDe">ID a partir de</label>
                            <input id="idDe" type="text" name="idDe" class="form-control" onkeyup="apenasNumeros(this)">
                        </div>
                        <div class="form-group col-xs-6 col-md-6">
                            <label for="idAte">Até</label>
                            <input id="idAte" type="text" name="idAte" class="form-control" onkeyup="apenasNumeros(this)">
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12">
                        <div class="form-group col-xs-6 col-md-6">
                            <label for="dtInicio">Período de</label>

                            <?php echo $this->Form->text('Periodo.i', array('class' => 'form-control input-sm data', array(
                                                    'onChange' => 'limpaCampos(\'resPesquisa\')',
                                                    'value' => date('d/m/Y'),
                                                    'class' => "form-control input-sm"))); ?>
                        </div>
                                
            
                        <div class="form-group col-xs-6 col-md-6">
                            <label for="dtFim" class="btn-block">Até</label>

                            <?php echo $this->Form->text('Periodo.f', array('class' => 'form-control input-sm data', array(
                                'onChange' => 'limpaCampos(\'resPesquisa\')',
                                'value' => date('d/m/Y'),
                                'class' => "form-control input-sm"))); ?>
                        </div>
                    </div>
                            
                            
                    <div class="col-xs-12 col-sm-12">
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="cbCronologia">Cronologia</label>
                            <select id="cbCronologia" name="cbCronologia" class="form-control" size="1">
                                <option value="DESC" selected="selected">Decrescente</option>
                                <option value="ASC">Crescente</option>
                            </select>
                        </div>
                    </div>
                            
                    <div class="col-xs-12 col-md-12">
                        <input id="downloadProcesso" type="submit" name="downloadProcesso" value="Download" class="btn btn-primary">
                        <input id="btnCancelarDownload" type="reset" value="Cancelar" class="btn btn-default">
                    </div>
                    </form>
                </ul>
            </li>
        </ul>
    </div>

    <div class="container-fluid" style="padding-left: 0px !important;">
        <ul class="nav navbar-nav">
            <li class="dropdown drop-menu mais-detalhes">
                <a
                    href="#"
                    class="titulo-topo dropdown-toggle navbar-secundaria-titulo"
                    title="Mais detalhes"
                    alt="Mais detalhes"
                    data-toggle="dropdown"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="true"
                    ><span class="numeracao-unica"><?php echo $processo['PjeProcesso']['numeracao_unica']; ?></span>
                    <span class="caret pull-right mt-20"></span>
                    <small><?php echo $descricaoProcesso; ?></small>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="visible-xs-block menu-mobile">
                            <!-- REFERENCIAS DE COLUNAS -->
                            <div class="btn-group btn-group-justified btn-tab-group" role="group">
                                <a href="#maisDetalhes" class="btn btn-flat active">Detalhes</a>
                                <a href="#poloAtivo" class="btn btn-flat">Polo Ativo</a>
                                <a href="#poloPassivo" class="btn btn-flat">Polo Passivo</a>
                                <a href="#outrosInteressados" class="btn btn-flat">Outros Interessados</a>
                            </div>
                        </div>

                        <!-- COLUNA DE DETALHES -->
                        <div id="maisDetalhes" class="col-sm-3 col-xs-12 mobile-open scroll-y" style="display:block">
                            <dl class="dl-horizontal">
                                <dt>Classe judicial</dt>
                                <dd>
                                    <?php 
                                        $_ = $processo['PjeProcessoDadosBasico']['classe_judicial'];
                                        $classeJudicialdescricao = $_['descricao'];
                                        $classeJudicialId = $_['id'];
                                        echo "$classeJudicialdescricao ($classeJudicialId)";
                                    ?>
                                </dd>
                                <dt>Assunto</dt>
                                <dd>
                                    <ul>
                                        <?php if(isset($assuntos)): ?>
                                            <?php foreach($assuntos as $assunto): ?>
                                                <li><?php
                                                    $assuntoDescricao = $assunto['PjeProcessoAssuntoJudicial']['descricao'];
                                                    $assuntoId = $assunto['PjeProcessoAssuntoJudicial']['id'];
                                                    echo "$assuntoDescricao ($assuntoId)";
                                                ?></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </dd>

                                <dt>Jurisdição</dt>
                                <dd><?php echo $processo['PjeProcessoDadosBasico']['nome_localidade']; ?></dd>

                                <dt>Autuação</dt>
                                <dd><?php
                                    echo $autuacao;
                                ?></dd>

                                <dt>Última distribuição</dt>
                                <dd><?php echo $ultimaDistribuicao; ?></dd>

                                <dt>Valor da causa</dt>
                                <dd><?php
                                    $valor = CakeNumber::currency(
                                        $processo['PjeProcessoDadosBasico']['valor_causa'],
                                        'USD', [
                                            'places' => 2,
                                            'before' => 'R$ ',
                                            'thousands' => '.',
                                            'decimals' => ','
                                        ]);
                                    echo $valor;
                                ?></dd>

                                <dt>Segredo de justiça?</dt>
                                <dd><?php echo $processo['PjeProcessoDadosBasico']['nivel_sigilo'] > 0 ? 'SIM' : 'NÃO'; ?></dd>

                                <!-- ESTE DADO NAO EXISTE NO MNI
                                <dt>Juízo 100% digital?</dt>
                                <dd>**NÃO</dd>
                                -->

                                <dt>Justiça gratuita?</dt>
                                <dd><?php echo $processo['PjeProcessoDadosBasico']['justica_gratuita'] ? 'SIM' : 'NÃO'; ?></dd>

                                <dt>Tutela/liminar?</dt>
                                <dd><?php echo $processo['PjeProcessoDadosBasico']['tutela_liminar'] ? 'SIM' : 'NÃO'; ?></dd>

                                <dt>Prioridade?</dt>
                                <dd><?php echo $processo['PjeProcessoDadosBasico']['prioridade'] ?: 'NÃO'; ?></dd>
                            </dl>
                            <div>
                                <dl class="dl-horizontal">
                                    <dt>Órgão Colegiado</dt>
                                    <dd><?php echo $processo['PjeProcessoDadosBasico']['orgao_colegiado']['nome']; ?></dd>
                                </dl>
                            </div>
                            <div>
                                <dl class="dl-horizontal">
                                    <dt>Órgão julgador</dt>
                                    <dd><?php echo $processo['PjeProcessoDadosBasico']['nome_orgao_julgador']; ?></dd>
                                </dl>
                            </div>
                            <div>
                                <dl class="dl-horizontal">
                                    <dt>Cargo judicial</dt>
                                    <dd><?php echo $processo['PjeProcessoDadosBasico']['cargo_judicial'] ?></dd>
                                </dl>
                            </div>
                            <div>
                                <dl class="dl-horizontal">
                                    <dt>Relator</dt>
                                    <dd><?php echo $processo['PjeProcessoDadosBasico']['relator']; ?></dd>
                                </dl>
                            </div>
                            <div>
                                <dl class="dl-horizontal">
                                    <dt>Competência</dt>
                                    <dd><?php echo $competencia['descricao']; ?></dd>
                                </dl>
                            </div>
                        </div>
                        <?php
                            $POLO_ATIVO = 1;
                            $POLO_PASSIVO = 2;
                            $TERCEIRO = 3;
                        ?>
                        <!-- POLO ATIVO -->
                        <div id="poloAtivo" class="col-sm-3 col-xs-12 mobile-close scroll-y">
                            <?php echo $this->element('Pje/assistido', [
                                    'assistidos' => $processo['PjeProcessoAssistido'],
                                    'tipoAssistido' => $POLO_ATIVO,
                                    'titulo' => 'Polo ativo',
                                    'classeIcone' => 'icon-auto PA mr-5'
                                ]);
                            ?>
                        </div>
                        <!-- POLO PASSIVO -->
                        <div id="poloPassivo" class="col-sm-3 col-xs-12 mobile-close scroll-y">
                            <?php echo $this->element('Pje/assistido', [
                                    'assistidos' => $processo['PjeProcessoAssistido'],
                                    'tipoAssistido' => $POLO_PASSIVO,
                                    'titulo' => 'Polo passivo',
                                    'classeIcone' => 'icon-auto PP mr-5'
                                ]);
                            ?>
                        </div>
                        <!-- OUTROS INTERESSADOS -->
                        <div id="outrosInteressados" class="col-sm-3 col-xs-12 mobile-close scroll-y">
                            <?php echo $this->element('Pje/assistido', [
                                    'assistidos' => $processo['PjeProcessoAssistido'],
                                    'tipoAssistido' => $TERCEIRO,
                                    'titulo' => 'Outros Interessados',
                                    'classeIcone' => 'icon-auto OU mr-5'
                                ]);
                            ?>
                        </div>
                        <?php
                            if(count($processo['PjeProcessoDadosBasico']['processo_vinculado']) > 0) :
                                $processoVinculado = $processo['PjeProcessoDadosBasico']['processo_vinculado'];
                        ?>
                            <!-- Recursos Internos -->
                            <div id="recursosInternos" class="col-sm-9 col-xs-12 mobile-close scroll-y">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="icon-auto mr-5"></span>
                                                <span>Recursos Internos</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <i class="fa fa-folder-open-o mr-10"></i>
                                                    <span><?= $processoVinculado[0]['@attributes']['numeroProcesso'] ?></span>
                                                    &nbsp;[Principal]
                                                    <?php for($i = 1; $i < count($processoVinculado); $i++){ ?>
                                                        <ul class="tree">
                                                            <li>
                                                                <i class="fa fa-folder-open-o mr-10"></i>
                                                                <span>
                                                                    <?= $processoVinculado[$i]['@attributes']['numeroProcesso'] ?>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </li>
        </ul>
        <a
            href="#"
            class="titulo-topo dropdown-toggle navbar-secundaria-titulo"
            title="Copiar Processo"
            role="button"
            aria-haspopup="true"
            aria-expanded="true"
            >
            <i class="fa fa-clipboard hamburguer-menu" onclick="copiarProcesso()" style="font-size: small; padding-top: 20px;"></i>
        </a>
    </div>

</div>