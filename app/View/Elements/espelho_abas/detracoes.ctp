<?php if (!empty($detracoes)) { ?>
    <div id="detracoes">
        <table class="table table-bordered table-striped">
            <caption> Detrações</caption>
            <?php
            foreach ($detracoes as $key => $value) {
                ?>
                <tr>
                    <td>
                        <label>Data da Prisão:</label>
                    </td>
                    <td>
                        <?php echo $this->Util->setaValorPadrao($this->Util->ddmmaa($value['data_prisao'])); ?>
                    </td>
                    <td>
                        <label>
                            Data da Soltura:&nbsp;&nbsp;
                        </label>
                        <?php echo $this->Util->setaValorPadrao($this->Util->ddmmaa($value['data_soltura'])); ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <br />
<?php } ?>
   