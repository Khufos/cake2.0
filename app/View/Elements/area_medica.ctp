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
          
          if($.inArray("OUTROS", arr) !== -1){
              $( "#SaudesExames" ).css( "display", "block" );
          }else{
              $( "#SaudesExames" ).css( "display", "none" );
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
            
                <label>Órtese/Prótese:</label>
                <?php
                echo $this->Form->select('ortese_protese', $orteseProtese, array('empty' => 'Selecione', 'class' => 'form-control ortese_protese set-width-multiselect', 'multiple'=>'multiple', 'value' => $orteseProteseSel));
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
                echo $this->Form->textarea('outras_consultas', array('class' => 'form-control input-sm'));
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
                echo $this->Form->textarea('outros_exames', array('class' => 'form-control input-sm'));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
   <div class="col-md-3">
        <div class="form-group">
            <label>Medicamento:</label>
            <?php echo $this->Form->select('medicamento', $medicamentos, array('empty' => 'Selecione', 'class' => 'form-control input-sm medicamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $medicamentoSel)); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Insumos:</label>
            <?php echo $this->Form->select('insumo', $insumos, array('empty' => 'Selecione', 'class' => 'form-control input-sm insumo set-width-multiselect', 'multiple'=>'multiple', 'value' => $insumoSel)); ?>
        </div>
    </div>
    <div class="col-md-3">
        <?php $exibirOutrosIns = (isset($outrosInsumos) && $outrosInsumos) ? 'display: block' : 'display: none'; ?>
        <div id="SaudesInsumos" style="<?php echo $exibirOutrosIns; ?>">
            <div class="form-group">
                <label>Outros Insumos:</label>
                <?php echo $this->Form->textarea('outros_insumos', array('class' => 'form-control input-sm validate[required]')); ?>
            </div>
        </div>    
    </div> 
</div>
