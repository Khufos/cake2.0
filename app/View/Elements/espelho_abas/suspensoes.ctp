<?php
//FireCake::info($suspensoes, "\$suspensoesEspelho");
//FireCake::info($execucaoPenaisLivramento, "\$execucaoPenaisLivramento");
if (!empty($suspensoes)) {
    ?>
    <table class="table table-bordered table-striped">
        <caption>Suspens&atilde;o(&otilde;es)</caption>
        <?php
        foreach ($suspensoes as $ks => $vs) { // suspensões cadastradas
            $quebraL = ($ks >= 1) ? '</table> <br>
                    <table cellpadding="0" cellspacing="0"  border="1" class="tableImp" align="center" width="695px">' : '';
            ?>
            <?php echo ($quebraL); ?>
            <tr>
                <td>
                    <label>Motivo</label>
                </td>
                <td>
                    <label>Data</label>
                </td>
                <td>
                    <label>Situa&ccedil;&atilde;o</label>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    $idMotivo = $this->Util->setaValorPadrao($vs['Suspensao']['motivo_id'], null);
                    $idSuspensao = $this->Util->setaValorPadrao($vs['Suspensao']['id'], null);
                    echo $this->Util->setaValorPadrao($motivostadoSuspensao[$idMotivo], null);
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Util->ddmmaa($this->Util->setaValorPadrao($vs['Suspensao']['data'], null));
                    // echo $this->Form->text("Suspensao." . $ks . ".data", array('class' => 'data', 'id' => uniqid(), 'value' => $dataS));
                    ?>
                </td>
                <td>                   
                    <?php
                    $idSituacaoS = $this->Util->setaValorPadrao($vs['Suspensao']['situacao_id']);
                    // $idSuspensao = $this->Util->setaValorPadrao($vs['Suspensao']['id'], null);
                    echo $this->Util->setaValorPadrao($situacoesSuspensao[$idSituacaoS]);
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Resultado</label>
                </td>
                <td>
                    <label>Data</label>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    $idResultadoS = $this->Util->setaValorPadrao($vs['Resultado']['id'], null);
                    $idTresultadoS = $this->Util->setaValorPadrao($vs['Resultado']['tipo_resultado_id'], null);

                    echo $this->Util->setaValorPadrao($tipoResultadoSuspensao[$idTresultadoS]);
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Util->ddmmaa($this->Util->setaValorPadrao($vs['Resultado']['data_resultado']));
                    ?>
                </td>
                <td>
                        &nbsp;
                </td>
            </tr>                            

        <?php } ?>    
    </table>

<?php } ?>