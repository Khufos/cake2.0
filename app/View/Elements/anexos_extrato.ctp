<html>
    <body>
        <?php
        echo $this->Html->script('jquery/jquery.form');
        $this->Util->setaValorPadrao($anexos, null);
        $this->Util->setaValorPadrao($excluiAnexo, false);
        if (count($anexos) > 0) { // Mostra os anexos do model 
            ?>
            <table id="tabelaAnexos" class="table-striped table table-bordered">
<caption class="captionA"><strong>ANEXOS</strong></caption>
                <thead>
                    <tr>
                        <th width="25%">Arquivo Anexado</th>
                        <th width="20%">Tipo Anexo</th>
                        <th width="16%">Descrição</th>
                        <th width="17%">Cadastrado por</th>
                        <th width="12%">Dt Cadastro</th>
                        <th width="20%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($anexos as $key => $value) { $model = $value['Model'];?>
                        <tr>
                            <td align="center"><?php echo $value['Anexo']['filename']; ?></td>
                            <?php 
                            $this->Util->setaValorPadrao($idTipoAnexoOutro, null);
                            if (isset($value['Anexo']['tipo_anexo_id']) && $value['Anexo']['tipo_anexo_id'] == $idTipoAnexoOutro) { ?>
                                <td align="center"><?php echo $this->Util->setaValorPadrao($value['TipoAnexo']['nome']) . ": " . $this->Util->setaValorPadrao($value['Anexo']['outro']); ?></td>
                            <?php } else { ?>
                                <td align="center"><?php echo $this->Util->setaValorPadrao($value['TipoAnexo']['nome']); ?></td>                    
                            <?php } ?>
                            <td align="center"><?php echo $this->Util->setaValorPadrao($value['Anexo']['descricao']); ?></td>
                            <td align="center"><?php echo $value['Pessoa']['nome']; ?></td>
                            <td align="center"><?php echo $this->Util->aammddHis($value['Anexo']['dt_cadastro']); ?></td>
                            <td align="center">
                                <?php echo $this->Html->link($this->Html->image('mimetypes/application-pdf.png', array('title' => 'Baixar', 'escape' => false)), array('controller' => 'anexos', 'action' => "view/$model/" . $value['Anexo']['id'] . '?trs=1'), array('target' => '_blank', 'escape' => false)); ?>
                            </td>                    
                        </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
    </body>
</table>    