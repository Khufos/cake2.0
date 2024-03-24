<div id="livramentos">
    <?php
    foreach ($livramentos as $key => $value) {
        ?>
    <table cellpadding="0" cellspacing="0"  border="1" class="tableImp bordaFina" align="center" width="695px">
        <caption class="captionA"><?php echo $key == 0 ? 'Livramento Atual' : ($key+1)."° Livramento"; ?> </caption>
        <tr align="center">
            <td align="center">
                <span class="esquerda label_bold">
                    Data Livramento
                </span>
            </td>    
        </tr>            
        <tr>            
            <td colspan="2">
                <span class="esquerda label" >
    <?php
    echo $this->Util->ddmmaa($this->Util->setaValorPadrao($value['Livramento']['data'], null));
            ?>
                </span>
            </td>
        </tr>
            <?php

    if(!empty($livramentos[$key]['Livramento']['Pedido'])) {
        $pedidos =$livramentos[$key]['Livramento']['Pedido'];
                        ?>
        <tr>
            <td colspan="3">
                <h3 class="captionA">Pedido(s)</h3>
                        <?php

        $this->Util->setaValorPadrao($pedidos, array());
        foreach ($pedidos as $keyP => $valueP) {
            ?>
                <table class="borda" style="width:695px">
                    <tr>
                        <td width="40%">
                            <span class="esquerda label">
                                Situa&ccedil;&atilde;o:
                            </span>
                        </td>
                        <td>
                            <span class="esquerda label">
                                Data:
                            </span>
                        </td>
                        <td>
                            <span class="esquerda label">
                                Resultado:
                            </span>
                        </td>
                        <td>
                            <span class="esquerda label">
                                Data:
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="label esquerda">
            <?php
            $idPedido = $this->Util->setaValorPadrao(($valueP['Pedido']['id']), null);
            echo $this->Util->setaValorPadrao($situacoes[$valueP['Pedido']['situacao_id']]);
            ?>&nbsp;
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda">
            <?php
            echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['Pedido']['data'],null));
            ?>
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda">
                                            <?php
            $idResultado = $this->Util->setaValorPadrao(($valueP['Resultado']['id']), null);
            echo $this->Util->setaValorPadrao($tipoResultados[$valueP['Resultado']['tipo_resultado_id']]);

            ?>
                                &nbsp;
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda">
            <?php
            echo $this->Util->setaValorPadrao ($this->Util->ddmmaa($valueP['Resultado']['data_resultado'], null));
            ?>
                            </span>
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
                            <span class="label esquerda" >Data Renova&ccedil;&atilde;o:
            <?php
            echo$this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['Pedido']['data_renovacao']), null);
            ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            &nbsp
                        </td>
                    </tr>
                    <tr style="background-color: #CCCCCC;">
                        <td colspan="4">
                            <span class="label esquerda"> Recurso  </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="esquerda label">
                                Tipo de Recurso:
                            </span>
                        </td>
                        <td>
                            <span class="esquerda label">
                                Data:
                            </span>
                        </td>
                        <td>
                            <span class="esquerda label">
                                Resultado:
                            </span>
                        </td>
                        <td>
                            <span class="esquerda label">
                                Data:
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="label esquerda">
            <?php
            $idTipoRecurso = $this->Util->setaValorPadrao($valueP['Recurso']['tipo_recurso_id'], null);
            echo $this->Util->setaValorPadrao($tipoRecursos[$idTipoRecurso]);
            ?>
                                &nbsp;
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda">
            <?php
            echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['Recurso']['data_recurso'], null));
            ?>
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda">
            <?php
            $idTipoResultadoR = $this->Util->setaValorPadrao($valueP['ResultadoR']['tipo_resultado_id'], null); // resultado do recurso
            echo $this->Util->setaValorPadrao($tipoResultados[$idTipoResultadoR]); // resultado do recurso
            ?>&nbsp;
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda">
            <?php
            echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueP['ResultadoR']['data_resultado'], null)); // data do resultado do recurso
                                ?>
                            </span>
                        </td>
                    </tr>
            <?php
            $historico = $valueP['Pedido']['Historico'];
            if($historico) { ?>
                    <tr>
                        <td colspan="2">
                            &nbsp
                        </td>
                    </tr>
                    <tr style="background-color: #CCCCCC;">
                        <td colspan="4">
                            <span class="label esquerda" >Histórico do pedido </span>
                        </td>
                    </tr>
                <?php foreach ($historico as $keyH => $valueH) {    ?>
                    <tr>

                        <td>
                            <span class="esquerda label">
                                Situa&ccedil;&atilde;o:
                            </span>
                        </td>
                        <td>
                            <span class="esquerda label">
                                Data:
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <span class="label esquerda">
                    <?php
                    echo $this->Util->setaValorPadrao($valueH['Situacao']['nome']);
                    ?>&nbsp;
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda">
                    <?php
                    echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueH['HistoricoPedido']['data'], null));
                                        ?>
                            </span>
                        </td>
                    </tr>
                    <?php }
                            }
            ?>

                </table>
                    <?php } ?>
            </td>
        </tr>
                <?php }

        if(!empty($livramentos[$key]['Livramento']['Revogacao'])) {
            $revogacao =$livramentos[$key]['Livramento']['Revogacao'];
                            ?>
        <tr>
            <td colspan="3">
                <h3 class="captionA">Revogação(ões)</h3>
                            <?php

            $this->Util->setaValorPadrao($revogacao, array());
            foreach ($revogacao as $keyR => $valueR) {
                ?>
                <table class="borda" style="width:695px">
                    <tr>
                        <td width="40%">
                            <span class="esquerda label">
                                Data:
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda"> Motivo  </span>
                        </td>
                        <td colspan="2">
                            <span class="esquerda label">
                                Observação:
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="label esquerda">
                <?php
                echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueR['Revogacao']['data'],null));
                ?>&nbsp;
                            </span>
                        </td>
                        <td >
                            <span class="label ">
                <?php
                echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueR['Motivo']['nome'],null));
                ?>&nbsp;
                            </span>
                        </td>
                        <td colspan="2">
                            <span class="label esquerda">
                <?php
                $idRevogacao = $this->Util->setaValorPadrao(($valueR['Revogacao']['id']), null);
                echo $this->Util->setaValorPadrao($valueR['Revogacao']['observacao']);
                ?>
                            </span>
                        </td>
                    </tr>
                </table>
        </tr>
                        <?php }
                        }
                if(!empty($livramentos[$key]['Livramento']['Suspensao'])) {

                    $suspensao =$livramentos[$key]['Livramento']['Suspensao'];
                                    ?>
        <tr>
            <td colspan="3">
                <h3 class="captionA">Suspensão(ões)</h3>
                                    <?php

                    $this->Util->setaValorPadrao($suspensao, array());
                    foreach ($suspensao as $keyS => $valueS) {
                        ?>
                <table class="borda" style="width:695px">
                    <tr>
                        <td width="40%">
                            <span class="esquerda label">
                                Data:
                            </span>
                        </td>
                        <td width="36%">
                            <span class="esquerda label">

                                Situa&ccedil;&atilde;o:
                            </span>
                        </td>
                        <td colspan="2">
                            <span class="esquerda label" >
                                Motivo
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="label esquerda">
                        <?php
                        echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueS['Suspensao']['data'],null));
                        ?>&nbsp;
                            </span>
                        </td>
                        <td width="36%">
                            <span class="label">
                        <?php
                        echo $this->Util->setaValorPadrao($this->Util->setaValorPadrao($valueS['Situacao']['nome'],null));
                        ?>&nbsp;
                            </span>
                        </td>
                        <td colspan="2">
                            <span class="label ">
                        <?php
                        echo $this->Util->setaValorPadrao($this->Util->setaValorPadrao($valueS['Motivos']['nome'],null));
                        ?>&nbsp;
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="esquerda label">
                                Resultado:
                            </span>
                        </td>
                        <td>
                            <span class="esquerda label">
                                Data do Resultado:
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="label esquerda">
                        <?php
                        $idResultadoSusp = $this->Util->setaValorPadrao(($valueS['Resultado']['id']), null);
                        echo $this->Util->setaValorPadrao($tipoResult[$valueS['Resultado']['tipo_resultado_id']]);
                        ?>
                                &nbsp;
                            </span>
                        </td>
                        <td>
                            <span class="label esquerda">
                        <?php
                        echo $this->Util->setaValorPadrao($this->Util->ddmmaa($valueS['Resultado']['data_resultado'],null));
                        ?>
                                &nbsp;
                            </span>
                        </td>
                    </tr>

                </table>


                                        <?php }
                                }

                            

                        

    

}
?>

    </table>
</div>
<br />
