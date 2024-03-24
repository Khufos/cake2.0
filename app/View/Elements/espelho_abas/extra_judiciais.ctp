<?php
if (!empty($extraJudiciais)) {
    ?>
    <table cellpadding="0" cellspacing="0"  border="1" class="tableImp bordaFina" align="center" width="695px">
        <caption class="captionA"> Atividades Extrajudiciais</caption>
        <thead>
            <tr>
                <td width="668"><span class="label_bold">Observação:</span></td>
                <td width="210"><span class="label_bold">Data:</span></td>
                <td width="191"><span class="label_bold">Documento:</span></td>
            </tr>
        </thead>
        <?php
        foreach ($extraJudiciais as $key => $value) {
            ?>            
            <tr>
                <td>
                    <span class="label">
                        <?php echo $value['ExtraJudicial']['observacao']; ?>
                    </span>                        
                </td>
                <td valign="top">
                    <span class="label">                        
                        <?php echo $this->Util->ddmmaa($value['ExtraJudicial']['data']); ?>
                    </span>
                </td>
                <td valign="top">
                    &nbsp;
                    <?php
                    if (!empty($value['ExtraJudicial']['documento_id'])) { // Existe documento associado?                        
                        echo $this->Html->link($this->Html->image("icones32/page_search.png", array("alt" => "Visualizar", "border" => 0)), array("controller" => 'documentos', "action" => "gerarPdf/" . $value['documento_id']), array('escape' => false, "target" => '_blank'));
                    }
                    ?>
                </td>
            </tr>            
        <?php } ?>
    </table>
    <br />
<?php } ?>