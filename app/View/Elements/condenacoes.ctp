<style type="text/css">
    .borda{
        padding: 1px;
        border-collapse: separate;
        width: 100%;
    }
</style>

<div id="condenacoes">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $this->Util->setaValorPadrao($idCondenacaoEdit, 0);
        $remote = $this->Js->request(array(
            'action' => "buscaCondenacaoExecucao/$idExecucaoPenal?trs=1"), array(
            'update' => 'abaCondencoes'
                )
        );

        $condenacoes[] = array(1);
        $this->Util->setaValorPadrao($sel, 0);
        $i = 0;
        foreach ($condenacoes as $key => $value) {
            $idCondenacao = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['id'], 0);
            $idTableCondenacao = "blocoCondenacao$idCondenacao";
            $idBlocoArtigo = "blocoArtigo$idCondenacao";
            if ($idCondenacao > 0) {
                $nomeProcesso = "[" . $value['Processo']['numeracao_antiga'] . "] - [" . $value['Processo']['numeracao_anterior'] . " ] / [" . $value['Processo']['numeracao_unica'] . " - " . $value['Processo']['instancia'] . "]";
                $idProcesso = $value['Processo']['id'];
                $qtdArtigos = count($value['artigos']);
            } else {
                $nomeProcesso = 'Nova Condenação';
                $qtdArtigos = 0;
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">      
                    <h4 class="panel-title" title='[Num. antiga] - [Num. anterior] / [Num. unica]'>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                            <?php echo "$nomeProcesso &nbsp - $qtdArtigos artigo(s)" ?>
                        </a>
                    </h4>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                    <div class="panel-body">
                        <div id="<?php echo $idTableCondenacao ?>">
                            <?php if ($idCondenacaoEdit != $idCondenacao) { // apenas vizualiza as inforamções    ?>
                                <div class="row">
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <?php
                                            echo $this->Js->link($this->Html->div('glyphicon glyphicon-trash', '').' Apagar Condenação', array(
                                                'controller' => 'execucao_penais',
                                                'action' => "apagar_condenacao/$idCondenacao?trs=1"), array(
                                                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                                'before' => $this->Js->get('#loading')->effect('show'),
                                                'success' => $this->Js->get('#loading')->effect('hide'),
                                                'update' => '#resExecucaoProcesso',
                                                'div' => false,
                                                'method' => 'POST',
                                                'async' => true,
                                                'class' => 'btn btn-default margintop20',
                                                'title' => 'Apagar',
                                                'confirm' => "Tem Certeza que deseja apagar a condenação ?",
                                                'dataExpression' => true,
                                                'escape' => false)
                                            );
                                            echo $this->Js->writeBuffer();
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <?php
                                            $idCondenacao = $value['ExecucaoPenaisProcesso']['id'];

                                            echo $this->Js->link($this->Html->div('glyphicon glyphicon-edit', '').' Editar Condenação', array(
                                                'controller' => 'execucao_penais',
                                                'action' => "condenacoes/$idCondenacao/$idExecucaoPenal/$key?trs=1"), array(
                                                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                                'before' => $this->Js->get('#loading')->effect('show'),
                                                'success' => $this->Js->get('#loading')->effect('hide'),
                                                'update' => '#condenacoes',
                                                'div' => false,
                                                'method' => 'POST',
                                                'async' => true,
                                                'class' => 'btn btn-default margintop20',
                                                'title' => 'Apagar',
                                                'dataExpression' => true,
                                                'escape' => false)
                                            );
                                            echo $this->Js->writeBuffer();
                                            ?>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <?php $divNumeracao = uniqid('divNume'); ?>
                                            <label>Processo:</label>
                                            <div id='<?php echo $divNumeracao; ?>'>
                                                <?php
                                                echo $this->element('/espelho_abas/processo', array('divNumeracao' => $divNumeracao, 'processo' => $this->Util->setaValorPadrao($value['Processo'], array())));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <label>Data do Fato:</label>
                                            <?php echo $this->Util->ddmmaa($this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['data_fato'])); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <label>Data in&iacute;cio do cumprimento da pena:</label>
                                            <?php echo $this->Util->ddmmaa($this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['data_prisao'])); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label>CTP:</label>
                                            <?php
                                            echo $this->Util->setaValorPadrao($value['CMT']['nome']);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label title="Comarca de Tramitação do Processo">
                                                Bairro da Ocorr&ecirc;ncia:
                                            </label>
                                            <?php
                                            $this->Util->setaValorPadrao($value['bairros'], null);
                                            $bairros = $value['bairros'];
                                            $bairro = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['bairro_id'], null);
                                            echo $this->Util->setaValorPadrao($bairros[$bairro]);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label>Unidade DP:</label>
                                            <?php
                                            echo $this->Util->setaValorPadrao($value['UnidadeDefensorial']['nome']);
                                            //---------------------------------------- AJAX
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <div title="Unidade Judiciária de Atuação" class="label_bold direita">
                                                UJA:
                                            </div>
                                            <?php
                                            echo $this->Util->setaValorPadrao($value['Atuacao']['nome']);
                                            ?>
                                        </div>
                                    </div>
                                </div>    

                                <div class="row">
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label title="Comarca da prisão">Comarca da Prisão:</label>
                                            <?php
                                            echo $this->Util->setaValorPadrao($value['CP']['nome']);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Defensor:</label>
                                            <?php
                                            echo $this->Util->setaValorPadrao($value['Pessoa']['nome']);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Juizo da Condenação:</label>
                                            <?= $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['juizo_condenacao']) ?>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Reincidente Geral:</label>
                                            <?php
                                            $r = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['reincidente_geral'], 0);
                                            echo $this->Util->setaValorPadrao($simNao[$r]);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Medida de Seguran&ccedil;a:</label>
                                            <?php
                                            $ms = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['medida_seguranca'], 0);
                                            echo $this->Util->setaValorPadrao($simNao[$ms]);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Unificado:</label>
                                            <?php
                                            $u = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['unificado'], 0);
                                            if ($u) {
                                                echo $this->Html->link($value['ExecucaoPenalUnificada']['numero'], array(
                                                    'controller' => 'execucao_penais',
                                                    'action' => 'espelho', $value['ExecucaoPenalUnificada']['id'] . '?trs=1&width=710&height=640'
                                                        ), array(
                                                    'title' => 'Espelho da Ação',
                                                    'class' => 'thickbox'
                                                        ));
                                            } else {
                                                echo $simNao[$u];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">  
                                        <div class="form-group">
                                            <div id="blocoArtigo<?php echo $value['ExecucaoPenaisProcesso']['id'] ?>">
                                                <?php
                                                $artigos = $this->Util->setaValorPadrao($value['artigos'], array());
                                                echo $this->element('/espelho_abas/artigos', array(
                                                    'artigos' => $artigos, 
                                                    'idBlocoArtigo' => $idBlocoArtigo, 
                                                    'idProcesso' => $idProcesso, 
                                                    'remover' => ($remover = true))
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                            <?php } else { // edita a condenação     ?>
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <?php
                                            $idFormExecucao = 'formExecucao';
                                            echo $this->Form->hidden('ExecucaoPenaisProcesso.execucao_penal_id', array('value' => $this->Util->setaValorPadrao($idExecucaoPenal, null)));
                                            $idProcCondena = $this->Util->setaValorPadrao($value['Processo']['id'], null);
                                            echo $this->Form->hidden('ExecucaoPenaisProcesso.id', array('value' => $idCondenacao));
                                            ?>

                                            <?php $divProcesso = uniqid('dProcesso'); ?>
                                            <div id="<?php echo $divProcesso; ?>" colspan="2">
                                                <?php
                                                $this->Util->setaValorPadrao($value['tpAcao']);

                                                echo $this->element('processo', array(
                                                    'model' => 'ExecucaoPenaisProcesso',
                                                    'idProcesso' => $idProcCondena,
                                                    'idForm' => 'formExecucao',
                                                    'processosA' => $processosDisponiveis,
                                                    'tpAcao' => $value['tpAcao'],
                                                    'cadEdit' => true,
                                                    'idAssistido' => $idAssistido,
                                                    'divProcesso' => $divProcesso,
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <label>Data do Fato:</label>
                                            <?php
                                            $dataFato = $this->Util->ddmmaa($this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['data_fato'], null));
                                            $args = array(
                                                'class' => "form-control input-sm data",
                                                'data-date-format' => 'DD/MM/YYYY',
                                                'type' => 'text',
                                                'label' => false,
                                                'value' => $dataFato
                                            );
                                            echo $this->Form->text('ExecucaoPenaisProcesso.data_fato', $args);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <label>Data in&iacute;cio do cumprimento da pena:</label>
                                            <?php
                                            $dataPrisao = $this->Util->ddmmaa($this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['data_prisao'], null));
                                            $args = array(
                                                'class' => "form-control input-sm data",
                                                'data-date-format' => 'DD/MM/YYYY',
                                                'type' => 'text',
                                                'label' => false,
                                                'value' => $dataPrisao
                                            );
                                            echo $this->Form->text('ExecucaoPenaisProcesso.data_prisao', $args);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label title="Comarca de Tramitação do Processo">
                                                CTP:
                                            </label>

                                            <?php
                                            $cmt = $this->Util->setaValorPadrao($value['CMT']['id'], null);
                                            $args = array(
                                                'default' => $cmt,
                                                'empty' => 'Selecione',
                                                'class' => 'form-control input-sm'
                                            );
                                            echo $this->Form->select('ExecucaoPenaisProcesso.comarca_tramitacao', $comarcas, $args);

                                            $this->Js->get('#ExecucaoPenaisProcessoComarcaTramitacao')->event('change', $this->Js->request(
                                                            array(
                                                        'controller' => 'unidade_defensoriais',
                                                        'action' => "buscaUnidadeDefensorialComarca?trs=1'"
                                                            ), array(
                                                        'before' => '$("#loading").show()',
                                                        'complete' => '$("#loading").hide()',
                                                        'async' => true,
                                                        'dataExpression' => true,
                                                        'data' => $this->Js->serializeForm(
                                                                array(
                                                                    'isForm' => true,
                                                                    'inline' => true
                                                                )
                                                        ),
                                                        'update' => '#ExecucaoPenaisProcessoUnidadeDefensorialId',
                                                        'method ' => 'POST'
                                                            )
                                            ));
                                            echo $this->Js->writeBuffer();
                                            $this->Js->get('#ExecucaoPenaisProcessoComarcaTramitacao')->event('change', $this->Js->request(
                                                            array(
                                                        'controller' => 'bairros',
                                                        'action' => "getBairrosByComarca?trs=1"
                                                            ), array(
                                                        'before' => '$("#loading").show()',
                                                        'complete' => '$("#loading").hide()',
                                                        'async' => true,
                                                        'dataExpression' => true,
                                                        'data' => $this->Js->serializeForm(
                                                                array(
                                                                    'isForm' => true,
                                                                    'inline' => true
                                                                )
                                                        ),
                                                        'update' => '#ExecucaoPenaisProcessoBairroId',
                                                        'method ' => 'POST'
                                                            )
                                            ));
                                            echo $this->Js->writeBuffer();
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label>Bairro de Ocorrência:</label>
                                            <?php
                                            $this->Util->setaValorPadrao($value['bairros'], null);
                                            $bairros = $value['bairros'];
                                            $bairro = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['bairro_id'], null);
                                            $args = array(
                                                'default' => $bairro,
                                                'empty' => 'Selecione a comarca de tramitação',
                                                'class' => 'form-control input-sm'
                                            );
                                            echo $this->Form->select('ExecucaoPenaisProcesso.bairro_id', $bairros, $args);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label>Unidade DP:</label>
                                            <?php
                                            $uDef = $this->Util->setaValorPadrao($value['UnidadeDefensorial']['id'], null);
                                            $this->Util->setaValorPadrao($value['unidadesDP'], array());
                                            $args = array(
                                                'default' => $uDef,
                                                'empty' => 'Selecione',
                                                'class' => 'form-control input-sm'
                                            );
                                            echo $this->Form->select('ExecucaoPenaisProcesso.unidade_defensorial_id', $value['unidadesDP'], $args);
                                            //---------------------------------------- AJAX

                                            $this->Js->get('#ExecucaoPenaisProcessoUnidadeDefensorialId')->event('change', $this->Js->request(
                                                            array(
                                                        'controller' => 'atuacoes_unidade_defensoriais',
                                                        'action' => "buscaAtuacaoUnidade/?trs=1"
                                                            ), array(
                                                        'before' => '$("#loading").show()',
                                                        'complete' => '$("#loading").hide()',
                                                        'async' => true,
                                                        'dataExpression' => true,
                                                        'data' => $this->Js->serializeForm(
                                                                array(
                                                                    'isForm' => true,
                                                                    'inline' => true
                                                                )
                                                        ),
                                                        'update' => '#ExecucaoPenaisProcessoAtuacaoId',
                                                        'method ' => 'POST'
                                                            )
                                            ));
                                            echo $this->Js->writeBuffer();
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label title="Unidade Judiciária de Atuação">
                                                UJA:
                                            </label>
                                            <?php
                                            $aAtua = $this->Util->setaValorPadrao($value['Atuacao']['id'], null);
                                            $this->Util->setaValorPadrao($value['atuacoes'], null);
                                            $args = array(
                                                'default' => $aAtua,
                                                'empty' => 'Selecione',
                                                'class' => 'form-control input-sm'
                                            );
                                            echo $this->Form->select('ExecucaoPenaisProcesso.atuacao_id', $value['atuacoes'], $args);
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label title="Comarca da prisão">Comarca da Prisão:</label>
                                            <?php
                                            $cp = $this->Util->setaValorPadrao($value['CP']['id'], null);
                                            $args = array(
                                                'default' => $cp,
                                                'empty' => 'Selecione',
                                                'class' => 'form-control input-sm'
                                            );
                                            echo $this->Form->select('ExecucaoPenaisProcesso.comarca_prisao', $comarcas, $args);
//---------------------------------------- AJAX

                                            $this->Js->get('#ExecucaoPenaisProcessoComarcaPrisao')->event('change', $this->Js->request(
                                                            array(
                                                        'controller' => 'especializadas',
                                                        'action' => "buscaDefensoresEspecializada/ExecucaoPenaisProcesso/$idEspecializadaExecucaoPenal?trs=1"
                                                            ), array(
                                                        'before' => '$("#loading").show()',
                                                        'complete' => '$("#loading").hide()',
                                                        'async' => true,
                                                        'dataExpression' => true,
                                                        'data' => $this->Js->serializeForm(
                                                                array(
                                                                    'isForm' => true,
                                                                    'inline' => true
                                                                )
                                                        ),
                                                        'update' => '#ExecucaoPenaisProcessoFuncionarioId',
                                                        'method ' => 'POST'
                                                            )
                                            ));
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Defensor:</label>
                                            <?php
                                            $buscaDefensorComarca = isset($buscaDefensorComarca) ? $buscaDefensorComarca : array();
                                            $idFuncionario = isset($idFuncionario) ? $idFuncionario : NULL;
                                            $args = array(
                                                'default' => $idFuncionario,
                                                'empty' => 'Selecione',
                                                'class' => 'form-control input-sm'
                                            );
                                            echo $this->Form->select('ExecucaoPenaisProcesso.funcionario_id', $buscaDefensorComarca, $args);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Juizo da Condenação:</label>
                                            <?php
                                            $juizo_condenaco = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['juizo_condenacao']);
                                            echo $this->Form->text('ExecucaoPenaisProcesso.juizo_condenacao', array('class' => 'form-control input-sm', 'value' => $juizo_condenaco));
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"> 
                                        <label>Reincidente Geral:</label>
                                        <div class="form-group">                                
                                            <?php
                                            $rg = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['reicidente_geral'], 0);
                                            $attributes = array('default' => $rg, 'legend' => false, 'separator' => '&nbsp&nbsp');
                                            echo $this->Form->radio('ExecucaoPenaisProcesso.reincidente_geral', $simNao, $attributes);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">  
                                        <label>Medida de Seguran&ccedil;a:</label>
                                        <div class="form-group">                                
                                            <?php
                                            $ms = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['medida_seguranca'], 0);
                                            $attributes = array('default' => $ms, 'legend' => false, 'separator' => '&nbsp&nbsp');
                                            echo $this->Form->radio('ExecucaoPenaisProcesso.medida_seguranca', $simNao, $attributes);
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">  
                                        <label>Unificado:</label>
                                        <div class="form-group">                                
                                            <?php
                                            $uni = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['unificado'], 0);
                                            $attributes = array('default' => $uni, 'legend' => false, 'separator' => '&nbsp&nbsp');
                                            echo $this->Form->radio("ExecucaoPenaisProcesso.unificado", $simNao, $attributes);
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <div id="processoUnificado" class="<?= ($uni) ? '' : 'hide' ?>">
                                                <label>Execução penal unificada:</label>
                                                <?php
                                                $execucoes = $this->Util->setaValorPadrao($execucoes, array());
                                                echo $this->Form->select('ExecucaoPenal.execucao_penal_id', $execucoes, array('class' => 'form-control input-sm'));
                                                ?>

                                            </div>
                                        </div>
                                    </div>                        
                                </div>
                                <div class="row">
                                    <div class="col-md-12">  
                                        <div class="form-group">
                                            <div id="blocoArtigo<?php echo $value['ExecucaoPenaisProcesso']['id'] ?>">
                                                <?php
                                                $artigos = $this->Util->setaValorPadrao($value['artigos'], array(1));
                                                echo $this->element('artigos', array('idForm' => $idFormExecucao, 'artigos' => $artigos));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } // fim edição condenacao
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++;
        }
        ?>
    </div>
    <div id="resExecucaoProcesso"></div>
    <script type="text/javascript">
        $(function () {
//            $("#acordion").accordion({
//                autoHeight: false,
//                active:<?php //echo $sel;    ?>
//            });

            $('[name="data[ExecucaoPenaisProcesso][unificado]"]').change(function () {
                if ($(this).val() == '1') {
                    $('#processoUnificado').removeClass('hide');
                } else {
                    $('#processoUnificado').addClass('hide');
                }
            });
        });
    </script>
</div>