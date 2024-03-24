<div id="saude">

    <?php if (count($saudes) > 0) { // Redesenha as existentes ?>
        <?php
        foreach ($saudes as $key => $val) {
            FireCake::info($val, "\$val");
            ?>
            <div class="row">
                <div class="col-md-4">  
                    <div class="form-group">
                        <label>Tipo da doença:</label>
                        <?php echo $this->Form->select("Saude.$key.tipo_doenca_id", $tipoDoencas, array('class' => 'form-control input-sm', 'default' => $val['AssistidosTipoDoenca']['tipo_doenca_id'])); ?>
                    </div>
                </div>
                <div class="col-md-4">  
                    <div class="form-group">
                        <label>Data início da doença:</label>
                        <?php
                        if (!empty($val['AssistidosTipoDoenca']['data_ini_doenca']) && $val['AssistidosTipoDoenca']['data_ini_doenca'] != '0000-00-00') {
                            $val['AssistidosTipoDoenca']['data_ini_doenca'] = $this->Util->ddmmaa($val['AssistidosTipoDoenca']['data_ini_doenca']);
                        } else {
                            $val['AssistidosTipoDoenca']['data_ini_doenca'] = "";
                        }
                        $args = array(
                            'class' => "form-control input-sm data",
                            'data-date-format' => 'DD/MM/YYYY',
                            'type' => 'text',
                            'label' => false,
                            'value' => $val['AssistidosTipoDoenca']['data_ini_doenca']
                        );
                        echo $this->Form->text("Saude.$key.data_ini_doenca", $args);
                        ?>
                    </div>
                </div>
                <div class="col-md-4"> 
                    <label class="control-label">Doença grave ou permanente?</label> 
                    <div class="form-group">                            
                        <?php
                        $attributes = array('label' => false, 'hiddenField' => false, 'value' => $val['AssistidosTipoDoenca']['doenca_grave'], 'class' => 'radioDoencaGrave', 'chave' => "$key");

                        $options = array();
                        foreach ($simNao as $key => $value) {
                            $options[] = array($key => $value);
                        }

                        foreach ($options as $option) {
                            ?>
                            <label class='radio-inline'>
                                <?php echo $this->Form->radio("Saude.$key.doenca_grave", $option, $attributes); ?>
                            </label>
                            <?php
                        }
                        ?>

                        <?php
                        if ($val['AssistidosTipoDoenca']['doenca_grave'] == '1') {
                            $class = "";
                        } elseif ($val['AssistidosTipoDoenca']['doenca_grave'] == '0') {
                            $class = "hide";
                        }
                        echo $this->Form->text("Saude.$key.descricao_doenca_grave", array('style' => "width: 400px;", 'value' => $val['AssistidosTipoDoenca']['descricao_doenca_grave'], 'class' => "$class"));
                        ?>

                        <!-- Ids ocultos -->
                        <?php echo $this->Form->hidden("Saude.$key.idAssistidoTipoDoenca", array('value' => $val['AssistidosTipoDoenca']['id'])); ?>
                    </div>
                </div>
            </div> 
        <?php } ?>

    <?php } else { // 1º    ?>
        <div class="row">
            <div class="col-md-4">  
                <div class="form-group">
                    <label>Tipo da doença:</label>
                    <?php echo $this->Form->select("Saude.0.tipo_doenca_id", $tipoDoencas, array('class' => 'form-control input-sm')); ?>
                </div>
            </div>
            <div class="col-md-4">  
                <div class="form-group">
                    <label>Data início da doença:</label>
                    <?php
                    $args = array(
                        'class' => "form-control input-sm data",
                        'data-date-format' => 'DD/MM/YYYY',
                        'type' => 'text',
                        'label' => false
                    );
                    echo $this->Form->text("Saude.0.data_ini_doenca", $args);
                    ?>
                </div>
            </div>
            <div class="col-md-4">  
                <label>Doença grave ou permanente?</label>
                <div class="form-group">                                           
                    <?php
                    $attributes = array('label' => false, 'hiddenField' => false, 'class' => 'radioDoencaGrave', 'chave' => "0");

                    $options = array();
                    foreach ($simNao as $key => $value) {
                        $options[] = array($key => $value);
                    }

                    foreach ($options as $option) {
                        ?>
                        <label class='radio-inline'>
                            <?php echo $this->Form->radio('Saude.0.doenca_grave', $option, $attributes); ?>
                        </label>
                        <?php
                    }
                    ?>
                    <?php echo $this->Form->input("Saude.0.descricao_doenca_grave", array('class' => 'form-control input-sm oculto', 'label' => array('class' => 'oculto', 'text' => 'Qual?'))); ?>
                </div>
            </div>
        </div> 
    <?php } ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.radioDoencaGrave').click(function () {
                var vlr = $(this).val();
                var chave = $(this).attr('chave');
                var idElement = "#Saude" + chave + "DescricaoDoencaGrave";
                if (vlr == '1') {
                    $(idElement).show();
                    $(idElement).prev('label').show();
                }
                if (vlr == '0') {
                    $(idElement).hide();
                    $(idElement).prev('label').hide();
                }
            });
        });
    </script>
</div>
<?php
echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
    'controller' => 'assistidos_tipo_doencas',
    'action' => "novoTipoDoenca/-1/$model?trs=1"), array(
    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
    'before' => $this->Js->get('#loading')->effect('show'),
    'success' => $this->Js->get('#loading')->effect('hide'),
    'div' => false,
    'complete' => 'refreshJquery();runEffect();',
    'update' => '#saude',
    'method' => 'POST',
    'async' => true,
    'dataExpression' => true,
    'title' => 'Novo',
    'class' => 'btn btn-default',
    'escape' => false
));
?>