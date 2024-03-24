<?php if (!empty($medidas)) { ?>
<div id="medidas">

<table cellpadding="0" cellspacing="0"  border="1" class="tableImp bordaFina" align="center" width="695px">
 
           <caption class="captionA"> Medidas </caption>
        <?php
        $j = 0;
        FireCake::info($medidas, '$medidass');
        foreach ($medidas as $key => $med) {

            $j++;
            ?>


           <tr align="center">
            <td >
                <span class="label_bold">
                            <?php echo $j; ?>º Medida Adotada                </span>            </td>
          <td >
                <span class="label_bold">
        				Data                </span>            </td>
          <td >
                <span class="label_bold">
        				Resultado                </span>            </td>
          <td >
                <span class="label_bold">
        				Data                </span>            </td>
      </tr>
        <tr>
            <td style="padding-bottom:-15px; padding-right:10px;">
                <span class="esquerda label">
                            <?php echo $this->Util->setaValorPadrao($tipoMedida[$med['Medida']['tipo_medida_id']]); ?>
                </span>
            </td>
            <td>
                <span class="esquerda label" style="padding-top:-15px; padding-right:10px;">
                            <?php echo $this->Util->ddmmaa($med['Medida']['data_medida']); ?>
                </span>
            </td>
            <td>
                <span class="esquerda label" style=" padding-right:10px;">
                            <?php echo $this->Util->setaValorPadrao($tipoResultados[$med['Medida']['Resultado']['tipo_resultado_id']]); ?>
                </span>
            </td>
            <td>
                <span class="esquerda label" style="padding-right:10px;">
                            <?php
                            echo $this->Util->ddmmaa($med['Medida']['Resultado']['data_resultado']);

                           /* echo $this->Form->input("$modelAssociaMedida.$key.id", array('value' => $med[$modelAssociaMedida]['id'], 'type' => 'hidden'));
                            echo $this->Form->input("Medida.$key.id", array('value' => $med['Medida']['id'], 'type' => 'hidden'));
                            echo $this->Form->input("Resultado.$key.id", array('value' => $med['Medida']['Resultado']['id'], 'type' => 'hidden'));
                           */ ?>
                </span>
            </td>
        </tr>
                 <?php } ?>
    </table>
</div>
<br />
    <?php } ?>

