<div id="testemunha">
    <?php
//FireCake::info($model,'model');
    $qtd = 1;
    if ($edit && !empty($testemunhas)) {  // Redesenha as existentes 
        foreach ($testemunhas as $key => $value) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Testemunha <?php echo $qtd ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome:</label>
                                <?php
                                echo $this->Form->text("Testemunha.$key.nome", array('class' => 'nome form-control input-sm', 'value' => $value['tbl']['testemunha']));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo:</label>
                                <?php
                                $args = array('class' => 'form-control input-sm', 'default' => $value['tbl']['idTipoTestemunha']);
                                echo $this->Form->select("Testemunha.$key.tipo", $tipoTestemunhas, $args);
                                ?>
                                <div class="hide" id="idEntradas">
                                    <div id="resEntradaDPE"></div>                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nacionalidade:</label>
                                <?php echo $this->Form->text("Testemunha.$key.nacionalidade", array('value' => $value['tbl']['nacionalidade'], 'class' => 'form-control input-sm')); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Naturalidade:</label>
                                <?php echo $this->Form->text("Testemunha.$key.naturalidade", array('value' => $value['tbl']['naturalidade'], 'class' => 'form-control input-sm')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo Documento:</label>
                                <?php
                                $args = array('class' => 'form-control input-sm', 'default' => $value['tbl']['idTipoDocumento']);
                                echo $this->Form->select("Testemunha.$key.tipo_documento_id", $tipoDoc, $args)
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Documento:</label>
                                <?php echo $this->Form->text("Testemunha.$key.numero_documento", array('value' => $value['tbl']['numero_documento'], 'class' => 'form-control input-sm')) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <span class="asterisco">*</span>
                                <label>Residencial (ou principal):</label>
                                <?php
                                echo $this->Form->text("Testemunha.$key.residencial", array(
                                    'value' => $value['tbl']['residencial'],
                                    'class' => 'telefone  validate[required] form-control input-sm',
                                    'maxlength' => '15',
                                    'label' => false));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group"> 
                                <label>Celular:</label>
                                <?php
                                echo $this->Form->text("Testemunha.$key.celular", array(
                                    'value' => $value['tbl']['celular'],
                                    'class' => 'telefone form-control input-sm',
                                    'maxlength' => '15',
                                    'label' => false));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label>Recado:</label>
                                <?php
                                echo $this->Form->text("Testemunha.$key.recado", array(
                                    'value' => $value['tbl']['recado'],
                                    'class' => 'telefone form-control input-sm',
                                    'maxlength' => '15',
                                    'label' => false));
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">        
                                <label>CEP:<span class='loader-populi'><?php echo $this->Html->image('loader-populi.png'); ?></span></label>
                                <?php
                                $this->Js->get('#cep')->event('blur', $this->Js->request(
                                                array(
                                            'controller' => 'logradouros',
                                            'action' => 'getEnderecoByCep/1?trs=1'
                                                ), array(
                                            'before' => '$("#cep").prev().find("span").show()',
                                            'complete' => '$("#cep").prev().find("span").hide()',
                                            'async' => true,
                                            'dataExpression' => true,
                                            'data' => $this->Js->serializeForm(
                                                    array(
                                                        'isForm' => true,
                                                        'inline' => true
                                                    )
                                            ),
                                            'update' => '#resEndereco',
                                            'method ' => 'POST'
                                                )
                                ));
                                echo $this->Form->text("Testemunha.$key.cep", array(
                                    'value' => $value['tbl']['cep'],
                                    'class' => 'cep form-control input-sm',
                                    'id' => 'cep',
                                    'label' => false));
                                ?>
                                (só números)
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label><span class="asterisco">*</span>UF:
                                    <span class='loader-populi'><?php echo $this->Html->image('loader-populi.png'); ?></span>
                                </label>
                                <?php
                                $args = array(
                                    'class' => 'validate[required] form-control input-sm',
                                    'default' => $value['tbl']['idEstado'],
                                    'empty' => 'Selecione',
                                    'label' => false
                                );
                                echo $this->Form->select("Testemunha.$key.estado", $estados, $args);

                                $this->Js->get('#EnderecoEstado')->event('change', $this->Js->request(
                                                array(
                                            'controller' => 'enderecos',
                                            'action' => 'populaSelectDinamico/CD/1?trs=1'
                                                ), array(
                                            'before' => '$("#EnderecoEstado").prev().find("span").show()',
                                            'complete' => '$("#EnderecoEstado").prev().find("span").hide()',
                                            'async' => true,
                                            'dataExpression' => true,
                                            'data' => $this->Js->serializeForm(
                                                    array(
                                                        'isForm' => true,
                                                        'inline' => true
                                                    )
                                            ),
                                            'update' => '#Testemunha' . $key . 'CidadeId',
                                            'method ' => 'POST'
                                                )
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label><span class="asterisco">*</span>Cidade:</label>
                                <?php
                                $args = array(
                                    'class' => 'validate[required] form-control input-sm',
                                    'default' => $value['tbl']['cidade_id'],
                                    'empty' => 'Selecione',
                                    'label' => false
                                );
                                echo $this->Form->select("Testemunha.$key.cidade_id", $value['tbl']['cidades'], $args);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label>Bairro:</label>
                                <?php
                                echo $this->Form->text("Testemunha.$key.bairro_descricao", array(
                                    'value' => $value['tbl']['bairro_descricao'],
                                    'class' => 'nome form-control input-sm',
                                    'label' => false));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label><span class="asterisco">*</span>Logradouro:</label>
                                <?php
                                echo $this->Form->text("Testemunha.$key.logradouro_descricao", array(
                                    'value' => $value['tbl']['logradouro_descricao'],
                                    'class' => 'validate[required] form-control input-sm',
                                    'label' => false));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">      
                                <label>Nº:</label>
                                <?php
                                echo $this->Form->text("Testemunha.$key.numero", array(
                                    'class' => 'form-control input-sm',
                                    'value' => $value['tbl']['numero'],
                                    'label' => false));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4">  
                            <div class="form-group">
                                <label>Complemento:</label>
                                <?php
                                echo $this->Form->text("Testemunha.$key.referencia", array(
                                    'class' => 'form-control input-sm',
                                    'value' => $value['tbl']['referencia'],
                                    'label' => false
                                ));
                                ?>

                                <div id="resAssistido"></div>
                                <div id="resEndereco"></div>
                            </div>
                        </div>
                    </div>


                    <!-- Id's Ocultos -->
                    <?php echo $this->Form->text("ProcessoAdministrativosTestemunha.$key.id", array('type' => 'hidden', 'value' => $value['tbl']['idProcessoAdministrativoTestemunha'])); ?>                
                    <?php echo $this->Form->text("Testemunha.$key.id", array('type' => 'hidden', 'value' => $value['tbl']['idTestemunha'])); ?>
                    <?php echo $this->Form->text("Testemunha.$key.idPessoa", array('type' => 'hidden', 'value' => $value['tbl']['idPessoa'])); ?>
                    <?php echo $this->Form->text("Testemunha.$key.idPessoaFisica", array('type' => 'hidden', 'value' => $value['tbl']['idPessoaFisica'])); ?>
                    <?php echo $this->Form->text("Testemunha.$key.idEndereco", array('type' => 'hidden', 'value' => $value['tbl']['idEndereco'])); ?>
                    <?php echo $this->Form->text("Testemunha.$key.idContato", array('type' => 'hidden', 'value' => $value['tbl']['idContato'])); ?>
                    <!-- Id's Ocultos -->
                </div>
            </div>
            <?php
            $qtd++;
        }
    } else { // Primeiro 
        $key = 0;
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Testemunha <?php echo $qtd ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nome:</label>
                            <?php
                            echo $this->Form->text("Testemunha.$key.nome", array('class' => 'nome form-control input-sm'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo:</label>
                            <?php
                            $args = array('class' => 'form-control input-sm');
                            echo $this->Form->select("Testemunha.$key.tipo", $tipoTestemunhas, $args);
                            ?>
                            <div class="hide" id="idEntradas">
                                <div id="resEntradaDPE"></div>                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nacionalidade:</label>
                            <?php echo $this->Form->text("Testemunha.$key.nacionalidade", array('class' => 'form-control input-sm')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Naturalidade:</label>
                            <?php echo $this->Form->text("Testemunha.$key.naturalidade", array('class' => 'form-control input-sm')); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo Documento:</label>
                            <?php
                            $args = array('class' => 'form-control input-sm');
                            echo $this->Form->select("Testemunha.$key.tipo_documento_id", $tipoDoc, $args)
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Documento:</label>
                            <?php echo $this->Form->text("Testemunha.$key.numero_documento", array('class' => 'form-control input-sm')) ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <span class="asterisco">*</span>
                            <label>Residencial (ou principal):</label>
                            <?php
                            echo $this->Form->text("Testemunha.$key.residencial", array(
                                'class' => 'telefone  validate[required] form-control input-sm',
                                'maxlength' => '15',
                                'label' => false));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group"> 
                            <label>Celular:</label>
                            <?php
                            echo $this->Form->text("Testemunha.$key.celular", array(
                                'class' => 'telefone form-control input-sm',
                                'maxlength' => '15',
                                'label' => false));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <label>Recado:</label>
                            <?php
                            echo $this->Form->text("Testemunha.$key.recado", array(
                                'class' => 'telefone form-control input-sm',
                                'maxlength' => '15',
                                'label' => false));
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">          
                            <label>CEP:<span class='loader-populi'><?php echo $this->Html->image('loader-populi.png'); ?></span></label>
                            <?php
                            $this->Js->get('#cep')->event('blur', $this->Js->request(
                                            array(
                                        'controller' => 'logradouros',
                                        'action' => 'getEnderecoByCep/1?trs=1'
                                            ), array(
                                        'before' => '$("#cep").prev().find("span").show()',
                                        'complete' => '$("#cep").prev().find("span").hide()',
                                        'async' => true,
                                        'dataExpression' => true,
                                        'data' => $this->Js->serializeForm(
                                                array(
                                                    'isForm' => true,
                                                    'inline' => true
                                                )
                                        ),
                                        'update' => '#resEndereco',
                                        'method ' => 'POST'
                                            )
                            ));
                            echo $this->Form->text('Endereco.cep', array(
                                'class' => 'cep form-control input-sm',
                                'id' => 'cep',
                                'label' => false));
                            ?>
                            (só números)
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <label><span class="asterisco">*</span>UF:
                                <span class='loader-populi'><?php echo $this->Html->image('loader-populi.png'); ?></span>
                            </label>
                            <?php
                            $args = array(
                                'class' => 'validate[required] form-control input-sm',
                                'empty' => 'Selecione',
                                'label' => false
                            );
                            echo $this->Form->select("Testemunha.$key.estado", $estados, $args);

                            $this->Js->get('#EnderecoEstado')->event('change', $this->Js->request(
                                            array(
                                        'controller' => 'enderecos',
                                        'action' => 'populaSelectDinamico/CD/1?trs=1'
                                            ), array(
                                        'before' => '$("#EnderecoEstado").prev().find("span").show()',
                                        'complete' => '$("#EnderecoEstado").prev().find("span").hide()',
                                        'async' => true,
                                        'dataExpression' => true,
                                        'data' => $this->Js->serializeForm(
                                                array(
                                                    'isForm' => true,
                                                    'inline' => true
                                                )
                                        ),
                                        'update' => '#Testemunha' . $key . 'CidadeId',
                                        'method ' => 'POST'
                                            )
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <label>*Cidade:</label>
                            <?php
                            $this->Util->setaValorPadrao($cidade);
                            $args = array(
                                'class' => 'validate[required] form-control input-sm',
                                'empty' => 'Selecione',
                                'label' => false
                            );
                            echo $this->Form->select("Testemunha.$key.cidade_id", $cidade, $args);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <label>Bairro:</label>
                            <?php
                            echo $this->Form->text("Testemunha.$key.bairro_descricao", array(
                                'class' => 'nome form-control input-sm',
                                'label' => false));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <label><span class="asterisco">*</span>Logradouro:</label>
                            <?php
                            echo $this->Form->text("Testemunha.$key.logradouro_descricao", array(
                                'class' => 'validate[required] form-control input-sm',
                                'label' => false));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">      
                            <label>Nº:</label>
                            <?php
                            echo $this->Form->text("Testemunha.$key.numero", array(
                                'class' => 'form-control input-sm',
                                'label' => false));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-4">  
                        <div class="form-group">
                            <label>Complemento:</label>
                            <?php
                            echo $this->Form->text("Testemunha.$key.referencia", array(
                                'class' => 'form-control input-sm',
                                'maxLength' => 200,
                                'label' => false
                            ));
                            ?>

                            <div id="resAssistido"></div>
                            <div id="resEndereco"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
    'controller' => 'testemunhas',
    'action' => "novaTestemunha/-1/$model?trs=1"), array(
    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
    'complete' => 'refreshJquery();',
    'update' => '#testemunha',
    'div' => false,
    'method' => 'POST',
    'async' => true,
    'class' => 'btn btn-default',
    'title' => 'Nova Testemunha',
    'dataExpression' => true,
    'escape' => false)
);
?>
