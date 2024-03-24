<script>
    $(document).ready(function () {
        $(".data").on('focusout blur change', function () {
            var liminar = $('.dataliminar').val();
            var cumprimento = $('.datacumprimento').val();
            var tamLiminar = $.trim(liminar);
            var tamCumprimento = $.trim(cumprimento);
            if (tamLiminar.length > 0 && tamCumprimento.length > 0)
            {
                diferenca(liminar, cumprimento, 'resp');
            } else {
                $("#resp").html('');
            }
        });
    });
</script>

<?php
if (!empty($this->data['Saude']['data_liminar']) && !empty($this->data['Saude']['data_cumprimento'])) {
    $diferenca = $this->Util->difDatasDMA($this->Util->aammdd($this->data['Saude']['data_liminar']), $this->Util->aammdd($this->data['Saude']['data_cumprimento']));
    $diferenca['d'] .= "d";
    $diferenca['m'] .= "m";
    $diferenca['a'] .= "a";
    $diferenca = implode(" ", $diferenca);
}
?>
<div class="panel panel-default">
    <div class="panel-heading">Liminar</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="form-group">
                    <label>Tipo:</label>
                    <?php echo $this->Form->select("Saude.tipo_liminar_id", $tipoLiminares, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="form-group">
                    <label>Cumprimento:</label>
                    <?php echo $this->Form->select("Saude.tipo_cumprimento_liminar_id", $tipoCumprimento, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-12">
                <div class="form-group" id="area">
                    <label>Cumprimento da Liminar:</label><br>
                    <div class="col-md-3">
                        Data da liminar: <?php echo $this->Form->input("Saude.data_liminar", array('class' => 'form-control input-sm data dataliminar', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                    </div>
                    <div class="col-md-3">
                        Data de Cumprimento: <?php echo $this->Form->input("Saude.data_cumprimento", array('class' => 'form-control input-sm data datacumprimento', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
                    </div>    
                    <div class="col-md-3">
                        Tempo de Descumprimento Liminar:
                        <div id="resp">
                            <?php echo $this->Util->setaValorPadrao($diferenca, null); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="col-md-3 form-group">
                <label>Bloqueio Verba Pública:</label>
                <?php
                echo $this->Form->select('Saude.bloquieo_verba', $simNao, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                ?>
            </div>
            <div class="col-md-3 form-group">
                <div class="form-group">
                    <label>Aplicada Multa:</label>
                    <?php
                    echo $this->Form->select('Saude.multa', $simNao, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                    ?>
                </div>
            </div>
        </div>
   <!-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Demais procedimentos médicos decorrentes do exame:</label>
                    <?php // echo $this->Form->textArea("Saude.demais_procedimentos", array('class' => 'nome form-control input-sm')); ?>
                </div> 
            </div> 
        </div> 
        <div class="row">
            <div class="col-xs-6 col-md-12">
                <div class="form-group">
                    <div id="ManifestacaoContent0">&nbsp;</div>
                </div>
            </div>
        </div> -->
    </div>
</div>