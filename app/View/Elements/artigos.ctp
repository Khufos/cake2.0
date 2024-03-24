<?php
$idArtigos = uniqid();
?>
<div id="<?php echo $idArtigos; ?>" class="bg-warning" style="padding: 20px">

    <?php
    $this->Util->setaValorPadrao($artigos, array(1));
    $k = 0;
    FireCake::info($artigos,'artigos');
    foreach ($artigos as $k => $v) {
        ?>
        <div>
            <div class="row">
                <div class="col-md-4">  
                    <div class="form-group">
                        <label>N&ordm; do Artigo / Lei:</label>
                        <?php echo $this->Form->text("Artigo.$k.nome", array('class' => 'form-control input-sm', 'value' => $v['Artigo']['nome'])); ?>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-4">  
                        <label>Tipo de Crime:</label>
                        <?php
                        $args = array(
                            'default' => $v['TipoCrime']['id'],
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Artigo.$k.tipo_crime_id", $tipoCrimes, $args);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"> 
                    <label>Contra o Patrimônio:</label>
                    <div class="form-group">                    
                        <?php
                        $attributes = array('label' => false, 'hiddenField' => false);

                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Artigo.$k.contra_patrimonio", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div> 
                <div class="col-md-4"> 
                    <label>Grave Ameaça:</label>
                    <div class="form-group">
                        <?php
                        $attributes = array('default' => $v['Artigo']['grave_ameaca'], 'label' => false, 'hiddenField' => false);

                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Artigo.$k.grave_ameaca", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Viol&ecirc;ncia a Pessoa :</label>
                    <div class="form-group">                        
                        <?php
                        $attributes = array('default' => $v['Artigo']['violencia_pessoa'], 'label' => false, 'hiddenField' => false);
                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Artigo.$k.violencia_pessoa", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">  
                    <label>Hediondo:</label>
                    <div class="form-group">                        
                        <?php
                        $attributes = array('default' => $v['Artigo']['hediondo'], 'label' => false, 'hiddenField' => false);
                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Artigo.$k.hediondo", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div> 
                <div class="col-md-4">
                    <label>Reincidente espec&iacute;fico em hediondo:</label>
                    <div class="form-group">                            
                        <?php
                        $attributes = array('default' => $v['Artigo']['reincidente'], 'label' => false, 'hiddenField' => false);
                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Artigo.$k.reincidente", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-3">
                    <label>Pena de Multa:</label>
                    <div class="form-group">                            
                        <?php
                        $attributes = array('default' => $v['Artigo']['pena_multa'], 'label' => false, 'hiddenField' => false);
                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Artigo.$k.pena_multa", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-3">  
                    <div class="form-group">
                        <label>Multa :</label>
                        <?php echo $this->Form->text("Artigo.$k.multa", array('class' => 'form-control input-sm', 'value' => $v['Artigo']['multa'])); ?>
                    </div>
                </div> 
            </div>
            <div class="row">                
                <div class="col-md-2"> 
                    <div class="form-group">
                        <label>Pena:</label>
                        <?php echo $this->Form->text("Artigo.$k.ano_pena", array('placeholder' => 'Anos', 'class' => 'form-control input-sm', 'value' => $v['Pena']['ano_pena'])); ?>
                    </div>
                </div>
                <div class="col-md-2">  
                    <div class="form-group">
                        <label>Meses</label>
                        <?php
                        $args = array(
                            'default' => $v['Pena']['mes_pena'],
                            'empty' => 'Selecione Meses',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Artigo.$k.mes_pena", $meses, $args);
                        ?>
                    </div>
                </div> 
                <div class="col-md-2">  
                    <div class="form-group">
                        <label>Dias</label>
                        <?php
                        $args = array(
                            'default' => $v['Pena']['dia_pena'],
                            'empty' => 'Selecione Dias',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Artigo.$k.dia_pena", $dias, $args);
                        ?>
                    </div>
                </div>                    
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-3">
                    <label>Substitui&ccedil;&atilde;o:</label>
                    <div class="form-group">
                        <?php
                        $attributes = array('default' => $v['Pena']['substituicao'], 'label' => false, 'hiddenField' => false);
                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Artigo.$k.Pena.substituicao", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Anos</label>
                        <?php echo $this->Form->text("Artigo.$k.SubstituicaoPena.ano", array('class' => 'form-control input-sm', 'value' => $v['SubstituicaoPena']['ano'])); ?>
                    </div>                        
                </div>
                <div class="col-md-2">
                    <div class="form-group">                      
                        <label>Meses</label>
                        <?php
                        $args = array(
                            'default' => $v['SubstituicaoPena']['mes'],
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Artigo.$k.SubstituicaoPena.mes", $meses, $args);
                        ?>                           
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group"> 
                        <label>Dias</label>
                        <?php
                        $args = array(
                            'default' => $v['SubstituicaoPena']['dia'],
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Artigo.$k.SubstituicaoPena.dia", $dias, $args);
                        echo $this->Form->hidden("Artigo.$k.SubstituicaoPena.id", array('value' => $v['SubstituicaoPena']['id']));
                        ?>                            
                    </div>
                </div>
                <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Observa&ccedil;&atilde;o:</label>
                        <?php
                        echo $this->Form->text("Artigo.$k.SubstituicaoPena.descricao", array('class' => 'form-control input-sm', 'value' => $v['SubstituicaoPena']['descricao']));
                        ?>
                    </div>
                </div>                
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-3">  
                    <label>Suspens&atilde;o:</label>
                    <div class="form-group">                        
                        <?php
                        $attributes = array('default' => $v['Pena']['suspensao'], 'label' => false, 'hiddenField' => false);
                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Artigo.$k.Pena.suspensao", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div> 
                <div class="col-md-2"> 
                    <div class="form-group">
                        <label>Anos</label>
                        <?php echo $this->Form->text("Artigo.$k.SuspensaoPena.ano", array('class' => 'form-control input-sm', 'value' => $v['SuspensaoPena']['ano'])); ?>                        
                    </div>
                </div>
                <div class="col-md-2"> 
                    <div class="form-group">
                        <label>Meses</label>
                        <?php
                        $args = array(
                            'default' => $v['SuspensaoPena']['mes'],
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Artigo.$k.SuspensaoPena.mes", $meses, $args);
                        ?>
                    </div>
                </div>  
                <div class="col-md-2"> 
                    <div class="form-group">
                        <label>Dias</label> 
                        <?php
                        $args = array(
                            'default' => $v['SuspensaoPena']['dia'],
                            'empty' => 'Selecione',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select("Artigo.$k.SuspensaoPena.dia", $dias, $args);
                        echo $this->Form->hidden("Artigo.$k.SuspensaoPena.id", array('value' => $v['SubstituicaoPena']['id']));
                        ?>
                    </div>
                </div> 
                <div class="col-md-3"> 
                    <div class="form-group">
                        <label>Observa&ccedil;&atilde;o:</label>
                        <?php
                        echo $this->Form->text("Artigo.$k.SuspensaoPena.descricao", array('class' => 'form-control input-sm', 'value' => $v['SubstituicaoPena']['descricao']));
                        ?>                        
                    </div>
                </div>
            </div>
        </div>
        <?php
        $k++;
    }
    ?>

</div>

<?php
echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
    'controller' => 'execucao_penais',
    'action' => "novoArtigo/-1/$modelAssocArtigo?trs=1"), array(
    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
    'before' => $this->Js->get('#loading')->effect('show'),
    'success' => $this->Js->get('#loading')->effect('hide'),
    'div' => false,
    'complete' => 'refreshJquery();runEffect();',
    'update' => '#' . $idArtigos,
    'method' => 'POST',
    'async' => true,
    'dataExpression' => true,
    'title' => 'Novo',
    'class' => 'btn btn-default',
    'escape' => false
));
?>


