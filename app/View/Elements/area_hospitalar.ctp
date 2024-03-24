<script type="text/javascript">

    $(document).ready(function () {
        
        $("#SaudeTipoInternamentoHospitalarTipoInternamento").on("change click", function () { 
          var arr = [];
          $( "#SaudeTipoInternamentoHospitalarTipoInternamento option:selected" ).each(function() {
            arr.push($(this).text());
          });
          
          if($.inArray("Outros", arr) !== -1){
              $( "#SaudesInternamentos" ).css( "display", "block" );
          }else{
              $( "#SaudesInternamentos" ).css( "display", "none" );
          }
        })
        
        $("#SaudeTipoCirurgiaTipoCirurgia").on("change click", function () { 
          var arr = [];
          $( "#SaudeTipoCirurgiaTipoCirurgia option:selected" ).each(function() {
            arr.push($(this).text());
          });
          
          if($.inArray("OUTRAS", arr) !== -1){
              $( "#SaudesCirurgias" ).css( "display", "block" );
          }else{
              $( "#SaudesCirurgias" ).css( "display", "none" );
          }
        })
        
        $("#SaudeTipoMaterialHospitalarTipoMaterialHospitalar").on("change click", function () { 
          var arr = [];
          $( "#SaudeTipoMaterialHospitalarTipoMaterialHospitalar option:selected" ).each(function() {
            arr.push($(this).text());
          });
          
          if($.inArray("Outros", arr) !== -1){
              $( "#SaudesMateriais" ).css( "display", "block" );
          }else{
              $( "#SaudesMateriais" ).css( "display", "none" );
          }
        })
    });
    
</script>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Internamento:</label>
                <?php 
                echo $this->Form->select('SaudeTipoInternamentoHospitalar.tipo_internamento', $tipoInternamentoHospitalar, array('empty' => 'Selecione', 'class' => 'form-control input-sm internamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($interHospSel, null)));
                ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Cirurgia:</label>
            <?php
                echo $this->Form->select('SaudeTipoCirurgia.tipo_cirurgia', $tipoCirurgias, array('empty' => 'Selecione', 'class' => 'form-control input-sm cirurgia set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($tipoCirurSel, null)));
            ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
                <label>Material:</label>
                <?php
                    echo $this->Form->select('SaudeTipoMaterialHospitalar.tipo_material_hospitalar', $materialHosptalar, array('empty' => 'Selecione', 'class' => 'form-control input-sm material set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($matHospSel, null)));
                ?>
        </div>
    </div>
</div>  
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php $exibirOutrosInt = (isset($outrosInternamentos) && $outrosInternamentos) ? 'display: block' : 'display: none'; ?>
            <div id="SaudesInternamentos" style="<?php echo $exibirOutrosInt; ?>">
                <label>Outros Internamentos:</label>
                    <?php 
                    echo $this->Form->textarea('outros_internamentos', array('class' => 'form-control input-sm'));
                    ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <?php $exibirOutrasCir = (isset($outrasCirurgias) && $outrasCirurgias) ? 'display: block' : 'display: none'; ?>
            <div id="SaudesCirurgias" style="<?php echo $exibirOutrasCir; ?>">
                <label>Outras Cirurgias:</label>
                <?php
                    echo $this->Form->textarea('outras_cirurgias', array('class' => 'form-control input-sm'));
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <?php $exibirOutrosMat = (isset($outrosMateriais) && $outrosMateriais) ? 'display: block' : 'display: none'; ?>
            <div id="SaudesMateriais" style="<?php echo $exibirOutrosMat; ?>">
                <label>Outros Materiais:</label>
                <?php
                    echo $this->Form->textarea('outros_materiais', array('class' => 'form-control input-sm'));
                ?>
            </div>
        </div>
    </div>
</div>  