<?php if (!empty($interrupcoes)) { ?>
    <div id="interrupcoes">
        <table class="table table-bordered table-striped">
            <?php
            foreach ($interrupcoes as $key => $value) {
                ?>
                <caption> Interrupções</caption>
                <tr>
                    <td>
                        <label>Data Início:</label>
                    </td>
                    <td>
                        <?php echo $this->Util->setaValorPadrao($this->Util->ddmmaa($value['data_inicio'])); ?>
                    </td>
                    <td>
                        <label>Data Fim:</label>
                        <?php echo $this->Util->setaValorPadrao($this->Util->ddmmaa($value['data_fim'])); ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <br />
<?php } ?>