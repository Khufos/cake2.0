<script type="text/javascript">

    $(document).ready(function () {
        
        $("#TipoConsultaSaudeTipoConsulta").on("change click", function () { 
          var arr = [];
          $( "#TipoConsultaSaudeTipoConsulta option:selected" ).each(function() {
            arr.push($(this).text());
          });
          
          if($.inArray("Outras", arr) !== -1){
              $( "#SaudesConsultas" ).css( "display", "block" );
          }else{
              $( "#SaudesConsultas" ).css( "display", "none" );
          }
        })
        
        $("#TipoExameSaudeTipoExame").on("change click", function () { 
          var arr = [];
          $( "#TipoExameSaudeTipoExame option:selected" ).each(function() {
            arr.push($(this).text());
          });
          
          if($.inArray("Outros", arr) !== -1){
              $( "#SaudesExames" ).css( "display", "block" );
          }else{
              $( "#SaudesExames" ).css( "display", "none" );
          }
        })

        //Javascript para exibir Outros referente a Ortese e Protese
        $("#SaudeOrteseProteseOrteseProtese").on("change click", function () { 
          var arr = [];
          $( "#SaudeOrteseProteseOrteseProtese option:selected" ).each(function() {
            arr.push($(this).text());
          });
          
          if($.inArray("Outros", arr) !== -1){
              $( "#OrteseProtese" ).css( "display", "block" );
          }else{
              $( "#OrteseProtese" ).css( "display", "none" );
          }
        })

        //Javascript para exibir Outros referente a Medicamento
        $("#SaudeMedicamentoMedicamento").on("change click", function () { 
          var arr = [];
          $( "#SaudeMedicamentoMedicamento option:selected" ).each(function() {
            arr.push($(this).text());
          });
          
          if($.inArray("Outros", arr) !== -1){
              $( "#SaudesMedicamentos" ).css( "display", "block" );
          }else{
              $( "#SaudesMedicamentos" ).css( "display", "none" );
          }
        })

        //Javascript para exibir Outros referente a Insumo
        $("#SaudeInsumoInsumo").on("change click", function () { 
          var arr = [];
          $( "#SaudeInsumoInsumo option:selected" ).each(function() {
            arr.push($(this).text());
          });
          
          if($.inArray("Outros", arr) !== -1){
              $( "#SaudesInsumos" ).css( "display", "block" );
          }else{
              $( "#SaudesInsumos" ).css( "display", "none" );
          }
        })

    });
    
</script>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
                <label>Consultas/Acompanhamentos:</label>
                <?php
                echo $this->Form->select('TipoConsultaSaude.tipo_consulta', $tipoConsultas, array('empty' => 'Selecione', 'class' => 'form-control input-sm consulta set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($consultaSel, null)));
                ?>
        </div>
    </div>

	<div class="col-md-3">
        <div class="form-group">
            
                <label>Exames:</label>
                <?php echo $this->Form->select('TipoExameSaude.tipo_exame', $tipoExames, array('empty' => 'Selecione', 'class' => 'form-control input-sm exame set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($exameSel, null))); ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            
                <label>Órtese/Prótese/Outros:</label>
                <?php
                echo $this->Form->select('SaudeOrteseProtese.ortese_protese', $orteseProtese, array('empty' => 'Selecione', 'class' => 'form-control ortese_protese set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($orteseProteseSel, null)));
                ?>
                
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php $exibirOutrasCons = (isset($outrasConsultas) && $outrasConsultas) ? 'display: block' : 'display: none'; ?>
            <div id="SaudesConsultas" style="<?php echo $exibirOutrasCons; ?>">
                <label>Outras Consultas:</label>
                <?php
                echo $this->Form->textarea('Saude.outras_consultas', array('class' => 'form-control input-sm'));
                ?>
            </div>    
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php $exibirOutrosExam = (isset($outrosExames) && $outrosExames) ? 'display: block' : 'display: none'; ?>
            <div id="SaudesExames" style="<?php echo $exibirOutrosExam; ?>">
                <label>Outros Exames:</label>
                <?php
                echo $this->Form->textarea('Saude.outros_exames', array('class' => 'form-control input-sm'));
                ?>
            </div>
        </div>
    </div>

<!-- Rotina para exibir detalhes de Outros referente a ORTESE e PROTESE -->
    <div class="col-md-3">
        <div class="form-group">
            <?php $exibirOutrosOrt = (isset($outrosOrteseProteses) && $outrosOrteseProteses) ? 'display: block' : 'display: none'; ?>
            <div id="OrteseProtese" style="<?php echo $exibirOutrosOrt; ?>">
                <label>Outros Órtese/Prótese:</label>
                <?php
                echo $this->Form->textarea('Saude.outros_ortese_proteses', array('class' => 'form-control input-sm'));
                ?>
            </div>
        </div>
    </div>

</div>

<div class="row">
   <div class="col-md-3">
        <div class="form-group">
            <label>Medicamento:</label>
            <?php echo $this->Form->select('SaudeMedicamento.medicamento', $medicamentos, array('empty' => 'Selecione', 'class' => 'form-control input-sm medicamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $medicamentoSel)); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Insumos:</label>
            <?php echo $this->Form->select('SaudeInsumo.insumo', $insumos, array('empty' => 'Selecione', 'class' => 'form-control input-sm insumo set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($insumoSel, null))); ?>
        </div>
    </div>
</div>

<div class="row">
<!-- Rotina para exibir detalhes de Outros referente a MEDICAMENTO -->
    <div class="col-md-3">
        <?php $exibirOutrosMed = (isset($outrosMedicamentos) && $outrosMedicamentos) ? 'display: block' : 'display: none'; ?>
        <div id="SaudesMedicamentos" style="<?php echo $exibirOutrosMed; ?>">
            <div class="form-group">
                <label>Outros Medicamentos:</label>
                <?php echo $this->Form->textarea('Saude.outros_medicamentos', array('class' => 'form-control input-sm validate[required]')); ?>
            </div>
        </div>    
    </div> 
    <div class="col-md-3">
        <?php $exibirOutrosIns = (isset($outrosInsumos) && $outrosInsumos) ? 'display: block' : 'display: none'; ?>
        <div id="SaudesInsumos" style="<?php echo $exibirOutrosIns; ?>">
            <div class="form-group">
                <label>Outros Insumos:</label>
                <?php echo $this->Form->textarea('Saude.outros_insumos', array('class' => 'form-control input-sm validate[required]')); ?>
            </div>
        </div>    
    </div> 
</div>
