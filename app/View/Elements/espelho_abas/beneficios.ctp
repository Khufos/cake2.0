<?php
//FireCake::info($beneficios, 'b');
if (!empty($beneficios)) {
    ?>
    <div id="beneficios">
        <table class="table table-bordered table-striped">
            <caption>Direitos</caption>
    <?php foreach ($beneficios as $key => $value) { ?>
                <tr>
                    <td>
                        <label><?= $key ?>º Direito:</label>
                        <?= $this->Util->setaValorPadrao($tipoBeneficios[$value['tipo_beneficio_id']]); ?>
                    </td>
                    <td>
                        <label>Data: </label>
                        <?= $this->Util->ddmmaa($value['data_beneficio']) ?></td>
                    <td><?= $value['observacao'] ?></td>
                </tr>        
    <?php } ?>
        </table>
    </div>
    <br />
<?php } ?>
