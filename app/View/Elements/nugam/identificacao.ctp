<?php // debug($dadosAssistido); ?>

<div class="tab-pane fade in active" id="identificacao">
    
<!--
<caption class="captionA">
    I-IDENTIFICAÇÃO
</caption>
-->
<?php #print_r($dadosAssistido['Pessoa']); ?>
            <div class="row">
                <div class="col-xs-12 col-md-4 form-group">
                    <label>Nome:</label>
                    <?php 
                    echo $this->Form->text('Pessoa.nome', array(
                                'value' => $dadosAssistido['Pessoa']['nome'],
                                'class' => 'nome form-control input-sm validate[required]',
                                'label' => false));
                    ?>
                    <?php echo $this->Form->input('PessoaFisica.id', array('type' => 'hidden', 'value' => $pessoaFisicaId)); ?>
                </div>
            
                <div class="col-xs-12 col-md-4 form-group">
                        <label>Apelido:</label>
                        <?php
                            echo $this->Form->text('PessoaFisica.apelido', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['apelido'], ''),
                                'class' => 'form-control input-sm',
                                'label' => false));
                        ?>
                </div>
            
                <div class="col-xs-12 col-md-4 form-group">
                    <label>Sexo:</label>
                    <?php
                            $args = array(
                                'default' => $dadosAssistido['PessoaFisica']['sexo'],
                                'class' => 'form-control selectMultiplo',
                                'label' => false,
                                'empty' => 'SELECIONE'
                            );
                            echo $this->Form->select('PessoaFisica.sexo', $generos, $args);
                            ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 form-group">
                        <label>Data Nascimento:</label>
                        <?php
                            echo $this->Form->text('PessoaFisica.nascimento', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['nascimento'], ''),
                                'class' => 'form-control input-sm data',
                                'label' => false));
                            ?>
                </div>
            
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label>Idade: </label>
                        
                        <?php
                            echo $this->Form->text('PessoaFisica.idade', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['idade'], ''),
                                'class' => 'data form-control input-sm',
                                'label' => false));
                            
                        ?>
                    </div>
                </div>
            
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label>Naturalidade: </label>
                        <?php
                            echo $this->Form->text('PessoaFisica.naturalidade', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['naturalidade'], ''),
                                'class' => 'form-control input-sm',
                                'label' => false));
                            ?>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label>Autodeclaração de cor: </label>
                        <?php 
                        $args = array(
                                'default' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['raca_id'], null),
                                'class' => 'form-control selectMultiplo',
                                'label' => false,
                                'empty' => 'SELECIONE'
                            );
                            echo $this->Form->select('PessoaFisica.raca_id', $racas, $args);
                            ?>
                    </div>
                </div>
            
            
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label>RG: </label>
                        <?php
                            echo $this->Form->text('PessoaFisica.rg', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['numero_documento'], ''),
                                'class' => 'form-control input-sm',
                                'label' => false));
                            ?>
                    </div>
                </div>
            
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label>CPF: </label>
                        <?php
                            echo $this->Form->text('PessoaFisica.cpf', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['cpf'], ''),
                                'class' => 'form-control input-sm validate[funcCall[isCPF]] cpf',
                                'label' => false));
                            ?>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label>Endereço: </label>
                        <?php
                            echo $this->Form->text('Endereco.logradouro_descricao', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['Endereco']['logradouro_descricao'], ''),
                                'class' => 'form-control input-sm',
                                'label' => false));
                            ?>
                    </div>
                </div>
            
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label>Bairro: </label>
                        <?php
                            echo $this->Form->text('Endereco.bairro_descricao', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['Endereco']['bairro_descricao'], ''),
                                'class' => 'form-control input-sm',
                                'label' => false));
                            ?>
                    </div>
                </div>
            
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label>Celular: </label>
                        <?php
                            echo $this->Form->text('Contato.celular', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['Contato']['celular'], ''),
                                'class' => 'form-control input-sm',
                                'label' => false));
                            ?>
                    </div>
                </div>
            </div>
    
            <div class="row">

            </div>
        
</div>

<script>


</script>
