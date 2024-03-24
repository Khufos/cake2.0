<style type="text/css">
    .borda{
        border-style: solid;
        border-width: 2px;
        margin-bottom: 3px;
        border-color: black;
    }
</style>
<?php
if (!empty($familiares)) {
    $qtd = 1;
    //FireCake::info($familiares, "familiares");
    //FireCake::info($idForm, "idForm");
    $exibir[0] = "hide";
    $exibir[1] = "show";
    ?>
    <div id="familiares">
        <?php
        foreach ($familiares as $key => $value) {
            //FireCake::info($value, 'value');
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>*Nome:</label>
                        <?php echo $this->Form->text("Pessoa.$key.nome", array('class' => 'nome', 'value' => $value['Pessoa']['nome'])); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>*Grau de parentesco:</label>
                        <?php echo $this->Form->text("Familiar.$key.grau_parentesco", array('style' => 'width:200px', 'value' => $value['Familiar']['grau_parentesco'])); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <h4> Contato </h4>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Residencial:</label>
                        <?php
                        echo $this->Form->text("Contato.$key.residencial", array(
                            'style' => 'width:120px',
                            'class' => 'telefone',
                            'value' => $value['Contato']['residencial'])
                        );
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Celular:</label>
                        <?php
                        echo $this->Form->text("Contato.$key.celular", array(
                            'style' => 'width:120px',
                            'class' => 'telefone',
                            'value' => $value['Contato']['celular']
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Recado:</label>
                        <?php
                        echo $this->Form->text("Contato.$key.recado", array(
                            'style' => 'width:120px',
                            'class' => 'telefone',
                            'value' => $value['Contato']['recado']
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <legend>Endereço</legend>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>UF:</label>
                        <?php
                        $args = array(
                            'default' => $value['Endereco']['estado'],
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Endereco.$key.estado", $estados, $args);

                        $this->Js->get("#Endereco" . $key . "Estado")->event('change', $this->Js->request(
                                        array(
                                    'controller' => 'enderecos',
                                    'action' => "populaSelectDinamico/CD/1?trs=1"
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
                                    'update' => "#Endereco" . $key . "CidadeId",
                                    'method ' => 'POST'
                                        )
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cidade:</label>
                        <?php
                        $args = array(
                            'default' => $value['Endereco']['cidade_id'],
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Endereco.$key.cidade_id", array_map("utf8_encode", $value['Enderecos']['cidades']), $args);
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Bairro:</label>
                        <?php
                        echo $this->Form->text("Endereco.$key.bairro_descricao", array('value' => $value['Endereco']['bairro_descricao'], 'class' => 'form-control input-sm'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Logradouro:</label>
                        <?php
                        echo $this->Form->text("Endereco.$key.logradouro_descricao", array('value' => $value['Endereco']['logradouro_descricao']));
                        ?>            
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nº:</label>
                        <?php
                        echo $this->Form->text("Endereco.$key.numero", array(
                            'style' => 'width:50px',
                            'maxLength' => '5',
                            'value' => $value['Endereco']['numero']
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Complemento:</label>
                        <?php
                        echo $this->Form->text("Endereco.$key.referencia", array(
                            'style' => 'width:350px',
                            'maxLength' => 200,
                            'value' => $value['Endereco']['referencia']
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Renda Familiar:</label>
                        <?php
                        $args = array(
                            'default' => $value['PessoaFisica']['renda_id'],
                            'empty' => 'Selecione'
                        );
                        echo $this->Form->select("PessoaFisica.$key.renda_id", $rendas, $args);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>A família recebe algum benefício do governo ?</label>
                    <div class="form-group">                       
                        <?php
                        $radio = $this->Util->setaValorPadrao($value['beneficio_governo_rd'], 0);

                        $attributes = array('label' => false, 'hiddenField' => false, 'class' => 'radioDoencaGrave', 'ativar' => "#beneficio_governo$key", 'default' => 0);

                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Familiar.$key.beneficio_governo_rd", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                        <div id="beneficio_governo<?php echo $key; ?>" class="<?php echo $exibir[$radio]; ?>">
                            <?php
                            echo $this->Form->text("Familiar.$key.beneficio_governo", array('value' => $value['Familiar']['beneficio_governo'], 'maxLenght' => 250, 'style' => 'width:500px'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Tipo de Residência:</label>
                    <div class="form-group">
                        <?php
                        $args = array(
                            'default' => $value['PessoaFisica']['tipo_residencia_id'],
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("PessoaFisica.$key.tipo_residencia_id", $tipoResidencias, $args);
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Alguém na família tem problema de saúde ?</label>
                    <div class="form-group">                        
                        <?php
                        $radio = $this->Util->setaValorPadrao($value['problema_saude_rd'], 0);
                        $attributes = array('label' => false, 'hiddenField' => false, 'class' => 'radioDoencaGrave', 'ativar' => "#problema_saude$key", 'default' => 0);

                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Familiar.$key.problema_saude_rd", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>

                        <div id="problema_saude<?php echo $key; ?>" class="<?php echo $exibir[$radio]; ?>">
                            <?php
                            echo $this->Form->text("Familiar.$key.problema_saude", array('value' => $value['Familiar']['problema_saude'], 'maxLenght' => 250, 'style' => 'width:500px'));
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Id's Ocultos -->
                <?php echo $this->Form->text("Familiar.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['Familiar']['id'], ""))); ?>
                <?php echo $this->Form->text("Contato.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['Contato']['id'], ""))); ?>
                <?php echo $this->Form->text("Endereco.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['Endereco']['id'], ""))); ?>
                <?php echo $this->Form->text("Pessoa.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['Pessoa']['id'], ""))); ?>
                <?php echo $this->Form->text("PessoaFisica.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['PessoaFisica']['id'], ""))); ?>
                <?php echo $this->Form->text("$modelAssociacao.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value['Familiar'][$modelAssociacao], ""))); ?>
                <!-- Id's Ocultos -->
            </div>

        <?php } # fim  do loop ?>
    </div>
    <?php
    echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
        'controller' => 'familiares',
        'action' => "novoFamiliar/-1/$model?trs=1"), array(
        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
        'before' => $this->Js->get('#loading')->effect('show'),
        'success' => $this->Js->get('#loading')->effect('hide'),
        'div' => false,
        'complete' => 'refreshJquery();runEffect();',
        'update' => '#familiares',
        'method' => 'POST',
        'async' => true,
        'dataExpression' => true,
        'title' => 'Novo',
        'class' => 'btn btn-default',
        'escape' => false
    ));
} else { # não existe familar associado
    $dadosFamiliares = $this->Js->request(
            array(
        'controller' => 'familiares',
        'action' => "add/AssistenciaPreso?trs=1"
            ), array(
        'update' => '#dados_familiares',
        'complete' => 'refreshJquery();'
            )
    );
    ?>

    <script type="text/javascript">
    <?php echo $dadosFamiliares; ?>
    </script>
<?php } ?>