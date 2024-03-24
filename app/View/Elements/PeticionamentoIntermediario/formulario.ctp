
<style>
    .container-fluid {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        margin-bottom: 15px;
    }

    .msg-alert-row {
        background: #ffdf0026 !important;
        padding: 6px 0px;
        border: 1px solid #ffdf0026;
        color: #AF3D44;
        margin-bottom: 6px;
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }
</style>

<?php echo $this->Form->create(
    'PeticionamentoIntermediarios',
    array(
        'type' => 'file',
        'action' => 'protocolar',
        'id' => 'formEdit',
        'enctype' => 'multipart/form-data',
        'method' => 'post'
        )
    ) ?>
<fieldset>

    <?php
    if (!isset($MsgErrorLoad) || empty($MsgErrorLoad)) :
    ?>

        <?php
            if($ShowPainelProcesso){
                echo $this->element('PeticionamentoIntermediario/paineis/processos');
            }

            if($ShowPainelIntimacao){
                echo $this->element('PeticionamentoIntermediario/paineis/intimacoes');
            }

            if($ShowPainelElaboracao){
                echo $this->element('PeticionamentoIntermediario/paineis/elaboracao');
            }

            if($ShowPainelInformacoes){
                echo $this->element('PeticionamentoIntermediario/paineis/informacoes');
            }
        ?>

    <?php else : ?>

        <div class="well">
            <div class="row">
                <?php echo $MsgErrorLoad; ?>
            </div>
        </div>

    <?php endif; ?>

    <div class="container-fluid" id="divSenhaPje" style="display: none;"><div class="row msg-alert-row"><div class="col-md-12"><span id="msgSenhaPje"></span></div></div></div>
    <div>

        <?php
        if (!isset($MsgErrorLoad) || empty($MsgErrorLoad)) :

            if($showProtocolarBtn){
                echo $this->Form->button(
                    'Protocolar',
                    array(
                        'formaction' => Router::url(
                            array('controller' => 'peticionamento_intermediarios', 'action' => 'protocolar')
                        ),
                        'class' => 'btn btn-primary',
                        'style' => 'float: right; margin-left: 8px;',
                        'id' => 'btnProtocolar'
                    )
                );
            }

            if($showRascunhoBtn){
                echo $this->Form->button(
                    'Salvar Rascunho',
                    array(
                        'formaction' => Router::url(
                            array('controller' => 'peticionamento_intermediarios', 'action' => 'salvarRascunho')
                        ),
                        'class' => 'btn btn-default',
                        'style' => $showProtocolarBtn ? 'float: right;' : 'float: right; margin-left: 8px;',
                        'id' => 'btnSalvarRascunho'
                    )
                );
            }

        endif;
        ?>

        <a href="<?php echo $urlVoltar; ?>" class="btn btn-default" id="btnVoltar" type="button" style="float: right; margin-right: 8px;">Voltar</a>
        
    </div>

    <?php if ($cadastroIncompleto) : ?>
        <input type="hidden" name="comarcaId" id="comarcaId" value="<?php echo $comarcaId; ?>" />
        <input type="hidden" name="unidadeDefensorialId" id="unidadeDefensorialId" value="<?php echo $unidadeDefensorialId; ?>" />
        <input type="hidden" name="cadastroIncompleto" value="true"/>
    <?php else: ?>
        <input type="hidden" name="assistidoSelecionado" id="assistidoSelecionado" value="<?php echo $assistidoSelecionado; ?>" />
    <?php endif; ?>

    <input type="hidden" name="poloAssistido" id="poloAssistido" value="<?php echo $poloAssistido; ?>" />
    <input type="hidden" name="peticaoResumida" id="peticaoResumida" value="<?php echo $peticaoResumida ? 'true' : 'false'; ?>" />
    <input type="hidden" name="atuacaoId" id="atuacaoId" value="<?php echo $atuacaoId; ?>" />
    <input type="hidden" name="apiInfoPje" id="apiInfoPje" />
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
    <input type="hidden" name="NumeroProcesso" id="PeticionamentoIntermediarioNumeroProcesso" value="<?php echo $numeroProcesso; ?>" />
    <input type="hidden" name="InstanciaPje" id="PeticionamentoIntermediarioInstanciaPje" value="<?php echo $instanciaPje; ?>" />
    <input type="hidden" name="EspecializadaId" id="EspecializadaId" />
    <input type="hidden" name="DataModificacao" id="DataModificacao" value="<?php echo date('Y-m-d') ?>"/>
    <input type="hidden" name="FuncionarioId" id="FuncionarioId" value="<?php echo $funcionarioId; ?>" />
    <input type="hidden" name="DefensorId" id="DefensorId" value="<?php echo $defensorId; ?>" />
    <input type="hidden" name="RedirectEdit" id="RedirectEdit" value="false" />

    </fieldset>

<?php
echo $this->Form->end();
?>