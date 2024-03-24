<?php if (!empty($partes)) { ?>
    <span align="center"><strong>Parte(s) desse Caso.</strong></span>
    <?php
    foreach ($partes as $key => $value) {
        /*echo '<pre>';
        print_r($value);
        echo '</pre>';
        die(aqui);*/
        ?>
        <div class="panel panel-success" id="field<?php echo $value[$modelAssociaParte]['id'] ?>">
            <div class="panel-body">
                <div class="col-md-3">
                    <label class="labelEsqueda">
                        <?php echo $value['Pessoa']['tipo'] == "F" ? 'Nome:' :  'Razão Social:'; ?><br/>
                        <?php
                        echo $this->Html->link($value['Pessoa']['nome'], array(
                            "controller" => "pessoas",
                            "action" => "dadosParteContraria", $value['Parte']['pessoa_id'], '?' => array('trs' => 1)), array(
                            'title' => 'Atualizar Parte',
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal",
                            'complete' => 'refreshJquery();',
                            'update' => '#resDados'
                                )
                        );
                        ?>
                    </label>
                </div>

                <?php if ($value['Pessoa']['tipo'] == "F") { ?>
                    <div class="col-md-3">
                        <label class="labelEsqueda">
                            Mãe:<br/>
                            <?php echo $value['PessoaFisica']['nome_mae'] ?>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <label class="labelEsqueda">
                            <?php echo $this->params['controller'] == 'idosos' ? 'Grau de Relação:' : 'Grau de Parentesco:'; ?><br/>
                            <?php
                            echo $this->Form->select("Parte.$key.grau_parentesco", $optionsGrauParentesco, array(
                                'default' => $value[$modelAssociaParte]['grau_parentesco_id'],
                                'class' => 'grau_parentesco form-control input-sm',
                                'escape' => false,
                                'empty' => 'Selecione')
                            );
                            echo '&nbsp;';
                            echo $this->Form->text("Parte.$key.outro_grau_parentesco", array('class' => 'outro_grau_parentesco hide', 'value' => $value[$modelAssociaParte]['grau_parentesco_outro']));
                            ?>
                        </label>
                    </div>
                <?php } elseif ($value['Pessoa']['tipo'] == "J") { ?>
                    <div class="col-md-3">
                        <label class="labelEsqueda">
                            Nome Fantasia:<br/>
                            <?php echo $this->Util->setaValorPadrao($value['PessoaJuridica']['nome_fantasia']); ?>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <label class="labelEsqueda">
                            CNPJ:<br/>
                            <?php echo $this->Util->setaValorPadrao($value['PessoaJuridica']['cnpj']); ?>
                        </label>
                    </div>
                <?php } ?> 
                <div class="col-md-3">
                    <label class="direita center" >
                        <?php
                        echo $this->Html->link($this->Html->div('glyphicon glyphicon-remove-circle', '') . ' Excluir', "javascript:excluirParte(" . $value[$modelAssociaParte]['id'] . ",'" . $modelAssociaParte . "')", array(
                            'escape' => false,
                            'class' => 'btn btn-danger',
                            'title' => 'Excluir Parte Contrária.',
                            'confirm' => "Tem certeza que deseja excluir a parte contraria " . $value['Pessoa']['nome'] . " ?"));
                        ?>
                    </label>
                </div>

                <label>
                    <!-- Id's Ocultos -->
                    <?php echo $this->Form->text("$modelAssociaParte.$key.id", array('type' => 'hidden', 'value' => $value[$modelAssociaParte]['id'])); ?>
                    <?php echo $this->Form->text("Parte.$key.pessoa_id", array('type' => 'hidden', 'value' => $value['Parte']['pessoa_id'])); ?>
                    <?php echo $this->Form->text("Parte.$key.contato_id", array('type' => 'hidden', 'value' => $value['Contato']['id'])); ?>
                    <?php echo $this->Form->text("Parte.$key.endereco_id", array('type' => 'hidden', 'value' => $value['Endereco']['id'])); ?>
                    <?php
                    if ($value['Pessoa']['tipo'] == "F") {
                        echo $this->Form->text("Parte.$key.pessoa_fisica_id", array('type' => 'hidden', 'value' => $value['PessoaFisica']['id']));
                    } else {
                        echo $this->Form->text("Parte.$key.pessoa_juridica_id", array('type' => 'hidden', 'value' => $value['PessoaJuridica']['id']));
                    }
                    ?>
                    <!-- Id's Ocultos -->
                </label>
            </div>
        </div>

    <?php } ?>
<?php } ?>


<div class="quebra"></div> <!-- Quebra a linha -->                

<div id="resEndereco0"></div>