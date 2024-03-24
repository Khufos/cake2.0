<?php echo $this->Form->create('PjeAvisoPendentes', array('id' => 'formAvisoPje'));?>

    <div id="idlinha1" class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label>Número do processo</label>
                <?= $this->Form->input('numeroProc',['id'=>'filtro_numeroProc', 'type'=>'text', 'class'=>'form-control', 'placeholder'=>'Número do processo','label'=>false]); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Número da intimação</label>
                <?= $this->Form->input('numeroExpediente',['id'=>'filtro_numero_expediente', 'type'=>'text', 'class'=>'form-control', 'placeholder'=>'Número da intimação','label'=>false]); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Terminação numérica</label>
                <div style="height: 34px; padding: 4px 12px; border: 1px solid #ccc; border-radius: 4px;">
                    <label class="radio-inline"><input id="termNumTodas" type="radio" name="data[PjeAvisoPendentes][termNum]" value="-1" checked>Todas</label>
                    <label class="radio-inline"><input type="radio" name="data[PjeAvisoPendentes][termNum]" value="0">Par</label>
                    <label class="radio-inline"><input type="radio" name="data[PjeAvisoPendentes][termNum]" value="1">Ímpar</label>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- <div class="form-group col-md-4">
            <label>Comarca</label>
            <?php
                echo $this->Form->select(
                    'comarcaPje.','',
                    [
                        'id'=>'filtro_comarca',
                        'class'=>'form-control',
                        'multiple'
                    ]
                );
            ?>
        </div> -->

        <div class="col-md-3">
            <div class="form-group">
                <label>Nome da parte </label>
                <?= $this->Form->input('nome',['id'=>'filtro_nome', 'type'=>'text', 'class'=>'form-control', 'placeholder'=>'Nome da parte','label'=>false]); ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>CPF/CNPJ da parte </label>
                <?= $this->Form->input('documentoParte',['id'=>'filtro_documento_parte', 'type'=>'text', 'class'=>'form-control', 'placeholder'=>'CPF/CNPJ da parte','label'=>false]); ?>
            </div>
        </div>

        <div id="selectMarcador" class="col-md-3">
            <div class="form-group">
                <label>Marcadores </label>
                <?php
                    echo $this->Form->input('marcadorPje.', array(
                        'options' => $listaMarcador,
                        'id'=>'filtro_marcador',
                        'class'=>'form-control',
                        'multiple'
                    ));
                ?>
            </div>
        </div>

        <div id="statusSelect" class="col-md-3">
            <div class="form-group">
                <label>Status </label>
                <select id="filtro_status" class="form-control" name="data[PjeAvisoPendentes][status_importacao]">
                    <option value="3">Todos</option>
                    <option value="4" selected>Pendentes</option>
                    <option value="1">Pendente de Ciência</option>
                    <option value="2">Pendente de Resposta</option>
                    <option value="5">Respondidos</option>
                    <option value="6">Intimações Removidas</option>
                </select>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- <div class="form-group col-md-3">
            <label for="prioridadeExpediente">Prioridade</label>
            <?php
                echo $this->Form->select('prioridade_expediente', null,['id'=>'prioridadeExpediente','empty' => 'Selecione...','class'=>'form-control','required']);
            ?>
        </div> -->

        <div class="col-md-6">
            <div class="form-group">
                <label>Orgão julgador colegiado</label>
                <?php

                    $opcoes = [];
                    foreach($orgaosColegiadosLista as $item) {
                        $id = $item['OrgaoColegiados']['id'];
                        $nome = $item['OrgaoColegiados']['nome_orgao'];
                        $encoding = mb_detect_encoding($nome, 'UTF-8', true);
                        if($encoding !== 'UTF-8'){
                            $nome = utf8_encode($nome);
                        }
                        $opcoes[$id] = $nome;
                    }

                    echo $this->Form->select(
                            'OrgaoColegiado',
                            $opcoes,
                            array(
                                'id'=>'orgao_colegiado',
                                'name' => 'OrgaoColegiado',
                                'class' => 'form-control',
                                'empty' => 'Selecione Orgão Colegiado'
                            )
                        );

                ?>
            </div>
        </div>

        <div id="ordenarPor" class="col-md-3">
            <div class="form-group">
                <label>Prioridade (Ordenar Por) </label>
                <select id="filtro_ordenar" class="form-control" name="coluna">
                    <option value="PjeAvisoPendentes.data_expedicao">Data da Intimação</option>
                    <option value="PjeAvisoPendentes.destinatario_pje">Nome da parte PJE</option>
                    <option value="PjeAvisoPendentes.id_aviso">Id da Intimação</option>
                    <option value="PjeAvisoPendentes.cod_orgao_colegiado">Orgão julgador colegiado</option>
                    <option value="cmc.nome">Comarca</option>
                    <option value="PjeAvisoPendentes.descricao_ato">Descrição do ato</option>
                    <option value="PjeAvisoPendentes.prazo*1">Prazo</option>
                    <option value="PjeAvisoPendentes.data_limite_ciencia">Data limite ciência</option>
                    <option value="PjeAvisoPendentes.data_limite_resposta">Data limite resposta</option>
                </select>
            </div>
        </div>

        <div id="sentidoOrdenacao" class="col-md-3">
            <div class="form-group">
                <label>Sentido</label>
                <select id="filtro_sentido" class="form-control" name="ordenacao">
                    <option value="DESC">Decrescente</option>
                    <option value="ASC">Crescente</option>
                </select>
            </div>
        </div>

    </div>

    <div class="row">

        <div id="selectDefensores" class="col-md-4">
            <div class="form-group">
                <label>Defensores</label>
                <?php
                    echo $this->Form->input('defensoresPje.', array(
                        'options' => $defensoresLista,
                        'id'=>'filtro_defensores',
                        'class'=>'form-control',
                        'value'=>$idFunc,
                        'multiple'
                    ));
                ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Grupo</label>
                <?php
                    $opcoes = [];
                    foreach($grupoDefensor as $itemGrupo) {
                        $id = $itemGrupo['gd']['id'];
                        $nome = $itemGrupo['gd']['nome_grupo'];
                        $encoding = mb_detect_encoding($nome, 'UTF-8', true);
                        if($encoding !== 'UTF-8'){
                            $nome = utf8_encode($nome);
                        }
                        $opcoes[$id] = $nome;
                    }

                    echo $this->Form->select(
                            'GrupoDefensor',
                            $opcoes,
                            array(
                                'id'=>'grupo_defensor',
                                'name' => 'grupo_defensor',
                                'class' => 'form-control',
                                'empty' => 'Selecione Grupo',
                                'default' => $grupoDefensorId
                            )
                        );

                    ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="perfilUser">Perfil do PJE para a consulta</label>
                <?php
                    $options = array('CUR' => 'Curadoria Especial', 'NC' => 'Núcleo de Contestação','G'=>'Geral');
                    echo $this->Form->select('perfil_importacao', $options,['id'=>'perfilUser','empty' => 'Selecione...','class'=>'form-control','required', 'default' => $perfilConsulta]);
                ?>
            </div>
        </div>

        <!-- <div class="col-md-4">
            <div class="form-group">
                <label>Data da importação da intimação</label>
                <div class="input-group">
                    <span class="input-group-addon">De</span>
                    <input id="dataImpExp_de" type="date" class="form-control" name="data[PjeAvisoPendentes][impexp_de]">
                    <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Até</span>
                    <input id="dataImpExp_ate" type="date" class="form-control" name="data[PjeAvisoPendentes][impexp_ate]">
                </div>
            </div>
        </div> -->

    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label>Data de criação da intimação </label>
                <div class="input-group">
                    <span class="input-group-addon">De</span>
                    <input id="dataExpdc_de" type="date" class="form-control" name="data[PjeAvisoPendentes][expdc_de]">
                    <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Até</span>
                    <input id="dataExpdc_ate"  type="date" class="form-control" name="data[PjeAvisoPendentes][expdc_ate]">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Data limite ciência</label>
                <div class="input-group">
                    <span class="input-group-addon">De</span>
                    <input id="dataCieExp_de" type="date" class="form-control" name="data[PjeAvisoPendentes][lmtcienc_de]">
                    <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Até</span>
                    <input id="dataCieExp_ate" type="date" class="form-control" name="data[PjeAvisoPendentes][lmtcienc_ate]">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Data limite resposta</label>
                <div class="input-group">
                    <span class="input-group-addon">De</span>
                    <input id="dataManExp_de" type="date" class="form-control" name="data[PjeAvisoPendentes][lmtresp_de]">
                    <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Até</span>
                    <input id="dataManExp_ate" type="date" class="form-control" name="data[PjeAvisoPendentes][lmtresp_ate]">
                </div>
            </div>
        </div>

        <!-- <div class="form-group col-md-4" style="padding-right: 5px; padding-left: 5px;">
            <label>Data limite ciência</label>
            <div class="input-group">
                <span class="input-group-addon">De</span>
                <input id="dataLimManif_de" type="date" class="form-control" name="data[PjeAvisoPendentes][lmtcienc_de]">
                <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Até</span>
                <input id="dataLimManif_ate" type="date" class="form-control" name="data[PjeAvisoPendentes][lmtcienc_ate]">
            </div>
        </div>
        <div class="form-group col-md-4" style="padding-right: 5px; padding-left: 5px;">
            <label>Data limite resposta</label>
            <div class="input-group">
                <span class="input-group-addon">De</span>
                <input id="dataLimResp_de" type="date" class="form-control" name="data[PjeAvisoPendentes][lmtresp_de]">
                <span class="input-group-addon" style="border: 0; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Até</span>
                <input id="dataLimResp_ate" type="date" class="form-control" name="data[PjeAvisoPendentes][lmtresp_ate]">
            </div>
        </div> -->

    </div>

    <div class="row">
        <div class="col-md-12" style="margin-bottom: 0px;">
            <div class="form-group">
                <button type="button" id="filtrarPjeAviso" onclick="filtrarExpediente()" class="btn btn-primary" style="margin-left: 7px;">Filtrar</button>
                <button type="button" id="btnLimparTudo" onclick="limparTudo()" class="btn btn-default" style="margin-left: 7px;">Limpar Tudo</button>
                <?php if($perfilImportacao[0] == true ){?>
                    <!-- <button type="button" id="atualizarExpPje" onclick="atualizarExpediente()" class="btn btn-default glyphicon glyphicon-refresh" title="Atualizar Expediente PJE" style="float: left;"></button> -->
                    <!-- <button type="button" id="limparFiltroPjeAviso" onclick="exibirtodosExpediente()" class="btn btn-default">Exibir Todos</button> -->
                <?php }?>
                <div style="float: left;">
                    <button class="btn btn-default" id="excelExpendietes" type="button" style="margin-left: 7px;">Gerar Excel</button>
                    <button class="btn btn-default" type="button" onclick="gerarPDF()" style="margin-left: 7px;">Gerar PDF</button>
                    <!-- <button class="btn btn-default" type="button" onclick="" style="margin-left: 7px;">Distribuir Intimações</button> -->
                    <button class="btn btn-default" type="button" onclick="atualizarExpediente()" style="margin-left: 7px;">Importar Intimações</button>
                </div>
            </div>
        </div>
    </div>

<?php echo $this->Form->end(); ?>

