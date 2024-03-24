<?php
if (!empty($regimes)) {
    ?>
    <div id="regimes">
        <?php
        unset($regimes['ExecucaoPenaisRegime']);
        foreach ($regimes as $key => $value) {
            ?>
            <table class="table table-bordered table-striped">
                <caption><?php echo $key == 0 ? 'Regime Atual' : ($key + 1) . "° Regime"; ?></caption>
                <tr>
                    <td>
                        <?php
                        if (($key == 0)) {
                            echo ('Regime Atual');
                        } else {
                            $contRegima = $key + 1;
                            echo($contRegima . 'º Regime');
                        }
                        ?>
                    </td>
                    <td>
                        <label>Data</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $this->Util->setaValorPadrao($tipoRegimes[$value['tipo_regime_id']]); ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Util->ddmmaa($value['data']);
                        ?>
                    </td>
                </tr>

                <?php
                if (!empty($value['Regime']['Pedido'])) {
                    $pedidos = $value['Regime']['Pedido'];
                    ?>
                    <tr>
                        <td colspan="3">
                            <h4>Pedido(s)</h4>
                            <?php
                            $this->Util->setaValorPadrao($pedidos, array());
                            foreach ($pedidos as $keyP => $valueP) {
                                ?>
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td>
                                            <label>Situa&ccedil;&atilde;o:</label>
                                        </td>
                                        <td>
                                            <label>Data:</label>
                                        </td>
                                        <td>
                                            <label>Resultado:</label>
                                        </td>
                                        <td>
                                            <label>Data:</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                            $idPedido = $this->Util->setaValorPadrao(($valueP['Pedido']['id']), null);
                                            echo $this->Util->setaValorPadrao($situacoes[$valueP['Pedido']['situacao_id']]);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['Pedido']['data'], null));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $idResultado = $this->Util->setaValorPadrao(($valueP['Resultado']['id']), null);
                                            echo $this->Util->setaValorPadrao($tipoResultados[$valueP['Resultado']['tipo_resultado_id']]);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['Resultado']['data_resultado'], null));
                                            ?>
                                        </td>
                                    </tr>



                                    <!-- Exibir quando o pedido for Indeferido-->
                                    <tr>
                                        <td colspan="2">
                                            &nbsp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <label>Data Renova&ccedil;&atilde;o:</label>
                                            <?php
                                            echo$this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['Pedido']['data_renovacao']), null);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp
                                        </td>
                                    </tr>
                                    <tr style="background-color: #CCCCCC;">
                                        <td colspan="4">
                                            <label>Recurso</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Tipo de Recurso:</label>
                                        </td>
                                        <td>
                                            <label>
                                                Data:
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                Resultado:
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                Data:
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                            $idTipoRecurso = $this->Util->setaValorPadrao($valueP['Recurso']['tipo_recurso_id'], null);
                                            echo $this->Util->setaValorPadrao($tipoRecursos[$idTipoRecurso]);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['Recurso']['data_recurso'], null));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $idTipoResultadoR = $this->Util->setaValorPadrao($valueP['ResultadoR']['tipo_resultado_id'], null); // resultado do recurso
                                            echo $this->Util->setaValorPadrao($tipoResultados[$idTipoResultadoR]); // resultado do recurso
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['ResultadoR']['data_resultado'], null)); // data do resultado do recurso
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $historico = $valueP['Pedido']['Historico'];
                                    if ($historico) {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                &nbsp
                                            </td>
                                        </tr>
                                        <tr style="background-color: #CCCCCC;">
                                            <td colspan="4">
                                                <label>Histórico do pedido</label>
                                            </td>
                                        </tr>
                                        <?php foreach ($historico as $keyH => $valueH) { ?>

                                            <tr>

                                                <td>
                                                    <label>Situa&ccedil;&atilde;o:</label>
                                                </td>
                                                <td>
                                                    <label>Data:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Util->setaValorPadrao($valueH['Situacao']['nome']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueH['HistoricoPedido']['data'], null));
                                                    ?>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    }
                                    ?>

                                </table>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
    <br />
<?php } ?>

