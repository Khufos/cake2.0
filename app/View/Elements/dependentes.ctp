<div id="dependente">
    <?php
    $qtd = 1;
    if (!empty($dependentes)) {  // Redesenha as existentes
        foreach ($dependentes as $key => $value) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Dependente <?php echo $qtd ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>Nome:</label>
                                <?php
                                echo $this->Form->text("Dependente.$key.nome", array('class' => 'nome form-control input-sm', 'value' => $value['tbl']['nome']));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>Nacionalidade:</label>
                                <?php echo $this->Form->text("Dependente.$key.nacionalidade", array('class' => 'form-control input-sm', 'value' => $value['tbl']['nacionalidade'])); ?>
                            </div>
                        </div>
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>Naturalidade:</label>
                                <?php echo $this->Form->text("Dependente.$key.naturalidade", array('class' => 'form-control input-sm', 'value' => $value['tbl']['naturalidade'])); ?>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>Nascimento:</label>
                                <?php
                                $args = array(
                                    'class' => "form-control input-sm data",
                                    'data-date-format' => 'DD/MM/YYYY',
                                    'type' => 'text',
                                    'label' => false,
                                    'value' => $this->Util->ddmmaa($value['tbl']['nascimento'])
                                );
                                echo $this->Form->text("Dependente.$key.nascimento", $args);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>Deficiência?</label>
                                <?php
                                $value['tbl']['tipo_deficiencia_id'] = $this->Util->setaValorPadrao($value['tbl']['tipo_deficiencia_id'], NULL);
                                $args = array(
                                    'default' => $value['tbl']['tipo_deficiencia_id'],
                                    'empty' => 'Selecione',
                                    'class' => 'form-control input-sm'
                                );
                                echo $this->Form->select("Dependente.$key.tipo_deficiencia_id", $tipoDeficiencias, $args);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>Escolaridade:</label>
                                <?php
                                $args = array(
                                    'default' => $value['tbl']['escolaridade'],
                                    'empty' => 'Selecione',
                                    'class' => 'form-control input-sm'
                                );
                                echo $this->Form->select("Dependente.$key.escolaridade", $escolaridades, $args);
                                ?>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>CEP:</label>
                                <?php
                                echo $this->Form->text("Dependente.$key.cep", array('class' => 'cep form-control input-sm', 'id' => 'cep', 'value' => $value['tbl']['cep']));
                                ?>
                                (só números)
                            </div>
                        </div>
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>UF:</label>
                                <?php
                                $args = array(
                                    'default' => $value['tbl']['idEstado'],
                                    'empty' => 'Selecione',
                                    'class' => 'form-control input-sm'
                                );
                                echo $this->Form->select("Dependente.$key.estado", $estados, $args);


                                $this->Js->get('#Dependente' . $key . 'Estado')->event('change', $this->Js->request(
                                                array(
                                            'controller' => 'enderecos',
                                            'action' => 'populaSelectDinamico/CD/1?trs=1'
                                                ), array(
                                            'before' => '$(\'#loading\').show();',
                                            'complete' => '$(\'#loading\').hide();',
                                            'async' => true,
                                            'dataExpression' => true,
                                            'data' => $this->Js->serializeForm(
                                                    array(
                                                        'isForm' => true,
                                                        'inline' => true
                                                    )
                                            ),
                                            'update' => '#Dependente' . $key . 'CidadeId',
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
                                    'default' => $value['tbl']['cidade_id'],
                                    'empty' => 'Selecione',
                                    'class' => 'form-control input-sm'
                                );
                                echo $this->Form->select("Dependente.$key.cidade_id", $value['tbl']['cidades'], $args);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">  
                            <div class="form-group">
                                <label>Bairro:</label>
                                <?php
                                echo $this->Form->text("Dependente.$key.bairro_descricao", array('class' => 'nome form-control input-sm', 'value' => $value['tbl']['bairro_descricao']));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">  
                            <div class="form-group">
                                <label>Logradouro:</label>
                                <?php
                                echo $this->Form->text("Dependente.$key.logradouro_descricao", array('class' => 'nome form-control input-sm', 'value' => $value['tbl']['logradouro_descricao']));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">  
                            <div class="form-group">
                                <label> Nº:</label>

                                <?php
                                echo $this->Form->text("Dependente.$key.numero", array(
                                    'maxLength' => '5',
                                    'value' => $value['tbl']['numero'],
                                    'class' => 'nome form-control input-sm'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">  
                            <div class="form-group">
                                <label>Complemento:</label>
                                <?php
                                echo $this->Form->text("Dependente.$key.referencia", array(
                                    'maxLength' => 200,
                                    'value' => $value['tbl']['referencia'],
                                    'class' => 'nome form-control input-sm'
                                ));
                                ?>
                                <!-- Id's Ocultos -->
                                <?php echo $this->Form->text("Dependente.$key.idAssistidoDependente", array('type' => 'hidden', 'value' => $value['tbl']['idAssistidoDependente'])); ?>
                                <?php echo $this->Form->text("Dependente.$key.id", array('type' => 'hidden', 'value' => $value['tbl']['idDependente'])); ?>
                                <?php echo $this->Form->text("Dependente.$key.idPessoa", array('type' => 'hidden', 'value' => $value['tbl']['idPessoa'])); ?>
                                <?php echo $this->Form->text("Dependente.$key.idPessoaFisica", array('type' => 'hidden', 'value' => $value['tbl']['idPessoaFisica'])); ?>
                                <?php echo $this->Form->text("Dependente.$key.idEndereco", array('type' => 'hidden', 'value' => $value['tbl']['idEndereco'])); ?>
                                <!-- Id's Ocultos -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $qtd++;
        }
    } else { // Primeiro 
        $key = 0;
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Dependente <?php echo $qtd ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>Nome:</label>
                            <?php echo $this->Form->text("Dependente.$key.nome", array('class' => 'nome form-control input-sm')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>Nacionalidade:</label> 
                            <?php echo $this->Form->text("Dependente.$key.nacionalidade", array('class' => 'form-control input-sm')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>Naturalidade:</label>
                            <?php echo $this->Form->text("Dependente.$key.naturalidade", array('class' => 'form-control input-sm')); ?>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>Nascimento:</label>
                            <?php
                            $args = array(
                                'class' => "form-control input-sm data",
                                'data-date-format' => 'DD/MM/YYYY',
                                'type' => 'text',
                                'label' => false
                            );
                            echo $this->Form->text("Dependente.$key.nascimento", $args);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>Deficiência?</label>
                            <?php
                            echo $this->Form->select("Dependente.$key.tipo_deficiencia_id", $tipoDeficiencias, array('class' => 'form-control input-sm', 'empty' => 'Selecione'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>Escolaridade:</label>
                            <?php
                            echo $this->Form->select("Dependente.$key.escolaridade", $escolaridades, array('class' => 'form-control input-sm', 'empty' => 'Selecione'));
                            ?>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>CEP:</label>
                            <?php
                            echo $this->Form->text("Dependente.$key.cep", array('class' => 'cep form-control input-sm', 'id' => 'cep'));
                            ?>
                            (só números)
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <div class="form-group">
                            <label>UF:</label>
                            <?php
                            $args = array(
                                'empty' => 'Selecione',
                                'class' => 'form-control input-sm'
                            );
                            echo $this->Form->select("Dependente.$key.estado", $estados, $args);


                            //---------------------------------------- AJAX

                            $this->Js->get('#Dependente0Estado')->event('change', $this->Js->request(
                                            array(
                                        'controller' => 'enderecos',
                                        'action' => 'populaSelectDinamico/CD/1?trs=1'
                                            ), array(
                                        'before' => '$(\'#loading\').show();',
                                        'complete' => '$(\'#loading\').hide();',
                                        'async' => true,
                                        'dataExpression' => true,
                                        'data' => $this->Js->serializeForm(
                                                array(
                                                    'isForm' => true,
                                                    'inline' => true
                                                )
                                        ),
                                        'update' => '#Dependente0CidadeId',
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
                            $this->Util->setaValorPadrao($cidade);
                            $args = array(
                                'empty' => 'Selecione',
                                'class' => 'form-control input-sm'
                            );
                            echo $this->Form->select("Dependente.$key.cidade_id", $cidade, $args);
                            ?>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-3">  
                        <div class="form-group">
                            <label>Bairro:</label>
                            <?php
                            echo $this->Form->text("Dependente.$key.bairro_descricao", array('class' => 'form-control input-sm'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                            <label>Logradouro:</label>
                            <?php
                            echo $this->Form->text("Dependente.$key.logradouro_descricao", array('class' => 'form-control input-sm'));
                            ?>

                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                            <label>Nº:</label>
                            <?php
                            echo $this->Form->text("Dependente.$key.numero", array(
                                'class' => 'form-control input-sm'
                            ));
                            ?>

                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                            <label>Complemento:</label>
                            <?php
                            echo $this->Form->text("Dependente.$key.referencia", array(
                                'class' => 'form-control input-sm'
                            ));
                            ?>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    <?php } ?>
</div>
<?php
echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
    'controller' => 'dependentes',
    'action' => "novoDependente/-1/$model/$modelAssocDep?trs=1"), array(
    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
    'div' => false,
    'complete' => 'refreshJquery();',
    'update' => '#dependente',
    'method' => 'POST',
    'async' => true,
    'dataExpression' => true,
    'title' => 'Novo',
    'class' => 'btn btn-default',
    'escape' => false
));
?>
