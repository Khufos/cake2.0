<div class="row">

<?php echo $this->element('PeticionamentoIntermediario/processos/campos_assistidos_alteracao'); ?>

</div>

<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            <label>Defensor:</label>
            <div class="row">
                <div class="col-md-10">
                    <?php echo $this->Form->select(
                        'PeticionamentoIntermediario.Defensor',
                        $this->Util->setaValorPadrao($defensores, null),
                        array(
                            'name' => 'Defensor',
                            'class' => 'form-control input-sm select2-type',
                            'empty' => 'Selecione Defensor',
                            'required' => true,
                            'readonly' => $defensorId ? true : false,
                            'disabled' => $defensorId ? true : false,
                            'default' => $defensorId)
                        );
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="UnidadeDefensorial">Unidade Defensorial:</label>
            <div class="row">
                <div class="col-md-10">
                    <?php
                        $opcoes = [
                            'name' => 'UnidadeDefensorial',
                            'class' => 'form-control input-sm',
                            'empty' => 'Selecione Unidade Defensorial',
                            'required' => $cadastroIncompleto,
                            'readonly' => !$cadastroIncompleto,
                            'disabled' => !$cadastroIncompleto
                        ];

                        if(!$cadastroIncompleto || !empty($unidadeDefensorialId)) {
                            $opcoes['value'] = $unidadeDefensorialId;
                        }

                        echo $this->Form->select('UnidadeDefensoriais.Nome', $unidadesDefensorias, $opcoes); 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php if($instanciaPje == 2):?>
    
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="OrgaoJulgador">Órgão Julgador:</label>
                    <div class="row">
                        <div class="col-md-10">
                            <?php
                                echo $this->Form->text('OrgaoJulgador', array('name' => 'OrgaoJulgador', 'class' => 'form-control input-sm', 'required' => false, 'readonly' => true, 'value' => $orgaoJulgadorNome));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="col-md-4">
            <div class="form-group">
                <label for="Comarca">Comarca:</label>
                <div class="row">
                    <div class="col-md-10">
                        <?php
                            $opcoes = [
                                'name' => 'Comarca',
                                'class' => 'form-control input-sm',
                                'empty' => 'Selecione Comarca',
                                'required' => $cadastroIncompleto,
                                'readonly' => !$cadastroIncompleto,
                                'disabled' => !$cadastroIncompleto
                            ];

                            if(!$cadastroIncompleto || !empty($comarcaId)) {
                                $opcoes['value'] = $comarcaId;
                            }

                            echo $this->Form->select('comarcaIdSelect', $comarcas, $opcoes);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php if($instanciaPje == 2):?>
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="OrgaoColegiado">Órgão Julgador Colegiado:</label>
                <div class="row">
                    <div class="col-md-10">
                        <?php
                            echo $this->Form->text('OrgaoColegiado', array('name' => 'OrgaoColegiado', 'class' => 'form-control input-sm', 'required' => false, 'readonly' => true, 'value' => $orgaoColegiadoNome));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="AtuacoesNome">Unidade Judicial:</label>
                <div class="row">
                    <div class="col-md-10">
                        <?php
                        if (isset($AtuacaoNome) && !empty($AtuacaoNome)) {
                            echo $this->Form->text('Atuacoes.Nome', array('name' => 'UnidadeJudicial', 'class' => 'form-control input-sm', 'required' => false, 'readonly' => true, 'value' => $AtuacaoNome));
                        } else {
                            echo $this->Form->select('Atuacoes.Nome', $this->Util->setaValorPadrao($atuacoes, null), array('name' => 'Atuacoes', 'class' => 'form-control input-sm select2-type', 'empty' => 'Selecione uma Atuação', 'required' => true, 'value' => $atuacaoId));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>