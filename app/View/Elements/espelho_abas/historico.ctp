<?php if ($usuarioCRC == FALSE) { ?>
    <table class="table table-bordered table-striped">
        <caption>INFORMAÇÕES ADICIONAIS</caption>
        <tr>
            <td>
                <label>DEFENSOR/SERVIDOR</label>
            </td>
            <td>
                <label>OBSERVAÇÃO</label>
            </td>
            <td>
                <label>DATA</label>
            </td>
        </tr>
        <?php foreach ($historicos as $key => $value) {
            ?>
            <tr>
                <td>
                    <?php echo $this->Util->setaValorPadrao($value['Funcionario']['nome']); ?>
                </td>
                <td>
                    <?php echo $this->Util->setaValorPadrao($value['AcaoHistorico']['observacao']); ?>
                </td>
                <td>
                    <?php echo $this->Util->setaValorPadrao($value['AcaoHistorico']['data']); ?>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>