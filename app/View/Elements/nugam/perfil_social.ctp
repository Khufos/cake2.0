<?php $completoIncompleto = array('0' => 'INCOMPLETO', '1' => 'COMPLETO'); ?>
<?php $arrayEscolaridade = array('0' => 'ANALFABETO', '1' => 'NÃO SE APLICA'); ?>
<?php $simNao = array('0' => 'NÃO', '1' => 'SIM'); ?>

<div class="row">
    <div class="col-xs-12 col-md-4 form-group">
        <label>Está estudando atualmente:</label>
        <?php 
        echo $this->Form->select('PerfilSocialAssistido.estuda_atualmente', $simNao, array(
                    'default' => $this->Util->setaValorPadrao($dadosAssistido['PerfilSocialAssistido']['estuda_atualmente'],null),
                    'class' => 'form-control selectMultiplo',
                    'label' => false,
                    'empty' => 'selecione'
                ));
        ?>
    </div>

    <div class="col-xs-12 col-md-4 form-group">
        <label>Escolaridade:</label>
        <?php  
            echo $this->Form->select('PessoaFisica.escolaridade_id', $escolaridades, array(
                'default' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['escolaridade_id'], null),
                'class' => 'form-control selectMultiplo',
                'label' => false,
                'empty' => 'selecione'
            ));
        ?>
    </div>
    
    <div class="col-xs-12 col-md-4 form-group">
            <label>Recebe benefício do Programa Bolsa Família:</label>
            <?php  
                echo $this->Form->select('PerfilSocialAssistido.recebe_bolsa_familia', $simNao, array(
                    'default' => $this->Util->setaValorPadrao($dadosAssistido['PerfilSocialAssistido']['recebe_bolsa_familia'], null),
                    'class' => 'form-control selectMultiplo',
                    'label' => false,
                    'empty' => 'selecione'
                ));
            ?>
    </div>
    

</div>

<div class="row">
        <div class="col-xs-12 col-md-4 form-group">
            <label>Valor do Bolsa Família:</label>
            <?php  
                echo $this->Form->text('PerfilSocialAssistido.valor_bolsa_familia', array(
                                'value' => $this->Util->setaValorPadrao($dadosAssistido['PerfilSocialAssistido']['valor_bolsa_familia'], ''),
                                'class' => 'form-control input-sm',
                                'label' => false));              
            ?>
        </div>
        
        <div class="col-xs-6 col-md-4 form-group">
                        
            <label>Quantas Pessoas Moram em sua casa, incluindo você?</label>
            <?php
            $args = array(
                'default' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['nucleo_familiar_id'], ''),
                'class' => 'form-control selectMultiplo',
                'label' => false,
                'empty' => 'selecione'
            );
            echo $this->Form->select('PessoaFisica.nucleo_familiar_id', $qtdFilhos, $args);
            ?>
                        
        </div>
        
        <div class="col-xs-6 col-md-4 form-group">
                        
            <label>Tem algum problema de saúde ou deficiência?</label>
            <?php
            $args = array(
                'default' => $this->Util->setaValorPadrao($dadosAssistido['TipoDeficiencia']['nome'], ''),
                'class' => 'form-control selectMultiplo',
                'label' => false,
                'empty' => 'selecione'
            );
            echo $this->Form->select('PessoaFisica.tipo_deficiencia_id', $tipoDeficiencias, $args);
            ?>
        </div>
    
    </div>

    <div class="row">

        <div class="col-xs-6 col-md-4 form-group">
            <label>Problema de saúde ou deficiência em familiar?</label>
            <?php
            $args = array(
                'default' => $this->Util->setaValorPadrao($dadosAssistido['PerfilSocialAssistido']['problema_saude_familiar'], ''),
                'class' => 'form-control selectMultiplo',
                'label' => false,
                'empty' => 'selecione'
            );
            echo $this->Form->select('PerfilSocialAssistido.problema_saude_familiar', $simNao, $args);
            ?>

        </div>
        
        <div class="col-xs-6 col-md-4 form-group">
            <label>Participa de alguma associação e/ou cooperativa?</label>
            <?php
            $args = array(
                'default' => $this->Util->setaValorPadrao($dadosAssistido['PerfilSocialAssistido']['participa_associacao'], ''),
                'class' => 'form-control selectMultiplo',
                'label' => false,
                'empty' => 'selecione'
            );
            echo $this->Form->select('PerfilSocialAssistido.participa_associacao', $simNao, $args);
            ?>

        </div>
        
    </div>