<?php
$idBlocoSuspensao = uniqid();
$this->Util->setaValorPadrao($idLivramento, 0);
$this->Util->setaValorPadrao($remover, null);
$this->Util->setaValorPadrao($display, 'none'); // exibição das suspensoes
?>

<div id="divSuspensoes" style="display: '<?php echo $display ?>';">    
    <table class="padrao borda" style="width:80%;" >
        <tr>
            <td colspan="4"> 
                <h3 class="captionA">Suspens&atilde;o(&otilde;es)</h3>
                <?php
                if (count($suspensoes) == 0) { // não h´acondenação
                    $suspensoes = array(array(1));
                }

                foreach ($suspensoes as $ks => $vs) { // suspensões cadastradas            
                    //FireCake::info($vs, "\$vs");
                    ?>
                    <table class="borda" style="width:600px">
                        <tr> 
                            <td colspan="3">
                                <?php
                                $idSuspensao = $this->Util->setaValorPadrao($vs['Suspensao']['id'], 0);
                                if ($idSuspensao > 0) {// edição
                                    ?> 
                                    <span class="direita novoItem ui-corner-bottom" title='Remover Suspensão'>
                                        <?php
                                        echo $ajax->link(
                                                "Remover " . $this->Html->image("icones16/delete.png")
                                                , array(
                                            'controller' => 'execucao_penais',
                                            'action' => "remover_suspensao",
                                            $idSuspensao,
                                            '?' => array('trs' => '1')
                                                )
                                                , array(
                                            'indicator' => 'loading',
                                            'update' => "divSuspensoes",
                                            'complete' => "refreshJquery();"
                                                )
                                                , "Tem Certeza que deseja remover a suspensao ?", array('escape' => false)
                                        );
                                        ?>
                                    </span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="esquerda label">
                                    Motivo:
                                </span>
                            </td>
                            <td>
                                <span class="esquerda label">
                                    Data:
                                </span>
                            </td>
                            <td>
                                <span class="esquerda label">
                                    Situa&ccedil;&atilde;o:
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    $idMotivo = $this->Util->setaValorPadrao($vs['Suspensao']['motivo_id'], null);
                                    $idSuspensao = $this->Util->setaValorPadrao($vs['Suspensao']['id'], null);
                                    echo $this->Form->select("Suspensao." . $ks . ".motivo_id"
                                            , $motivostadoSuspensao
                                            , $idMotivo
                                            , array('id' => uniqid(), 'style' => 'width: 225px'
                                            )
                                    );
                                    echo $this->Form->hidden("Suspensao.$ks.id", array('value' => $idSuspensao, 'id' => uniqid()));
                                    ?>
                                    &nbsp;
                                </span>
                            </td>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    $dataS = $this->Util->ddmmaa($this->Util->setaValorPadrao($vs['Suspensao']['data'], null));
                                    echo $this->Form->text("Suspensao." . $ks . ".data", array('class' => 'data', 'id' => uniqid(), 'value' => $dataS));
                                    ?>
                                </span>
                            </td>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    $idSituacaoS = $this->Util->setaValorPadrao($vs['Suspensao']['situacao_id']);
                                    $idSuspensao = $this->Util->setaValorPadrao($vs['Suspensao']['id'], null);
                                    echo $this->Form->select("Suspensao." . $ks . ".situacao_id"
                                            , $situacoesSuspensao
                                            , $idSituacaoS
                                            , array('id' => uniqid(), 'style' => 'width: 225px')
                                    );
                                    ?>
                                    &nbsp;
                                </span>
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
                                    Data:
                                </span>
                            </td>
                            <td>
                                <span class="esquerda label">
                                    &nbsp;
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    $idResultadoS = $this->Util->setaValorPadrao($vs['Resultado']['id'], null);
                                    $idTresultadoS = $this->Util->setaValorPadrao($vs['Resultado']['tipo_resultado_id'], null);

                                    echo $this->Form->select("Suspensao." . $ks . ".Resultado.tipo_resultado_id", $tipoResultadoSuspensao, $idTresultadoS
                                            , array(
                                        'value' => $idTresultadoS
                                        , 'class' => "resultadoPedido resultadoSituacao$ks"
                                        , 'indice' => $ks, 'id' => uniqid(), 'style' => 'width:225px'
                                            ), '[sem resultado]'
                                    );
                                    echo $this->Form->hidden("Suspensao.$ks.resultado_id", array('value' => $idResultadoS, 'id' => uniqid()));
                                    echo $this->Form->hidden("Suspensao.$ks.Resultado.id", array('value' => $idResultadoS, 'id' => uniqid()));
                                    ?>
                                    &nbsp;
                                </span>
                            </td>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    $dataResultado = $this->Util->ddmmaa($this->Util->setaValorPadrao($vs['Resultado']['data_resultado'], null));
                                    echo $this->Form->text("Suspensao." . $ks . ".Resultado.data_resultado", array('value' => $dataResultado, 'class' => "data", 'id' => uniqid()));
                                    ?>
                                </span>
                            </td>
                            <td>
                                <span class="esquerda label">
                                    &nbsp;
                                </span>
                            </td>
                        </tr>                            
                    </table>
                    <?php
                }
                $ks++;
                if ($remover == -1) { // nova suspensao
                    ?>
                    <table class="borda" style="width:600px">                        
                        <tr>
                            <td>
                                <span class="esquerda label">
                                    Motivo:
                                </span>
                            </td>
                            <td>
                                <span class="esquerda label">
                                    Data:
                                </span>
                            </td>
                            <td>
                                <span class="esquerda label">
                                    Situa&ccedil;&atilde;o:
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    echo $this->Form->select("Suspensao." . $ks . ".motivo_id"
                                            , $motivostadoSuspensao
                                            , $idMotivo
                                            , array('id' => uniqid(), 'style' => 'width: 225px'
                                            )
                                    );
                                    ?>
                                    &nbsp;
                                </span>
                            </td>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    echo $this->Form->text("Suspensao." . $ks . ".data", array('class' => 'data', 'id' => uniqid()));
                                    ?>
                                </span>
                            </td>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    echo $this->Form->select("Suspensao." . $ks . ".situacao_id"
                                            , $situacoesSuspensao
                                            , null
                                            , array('id' => uniqid(), 'style' => 'width: 225px')
                                    );
                                    ?>
                                    &nbsp;
                                </span>
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
                                    Data:
                                </span>
                            </td>
                            <td>
                                <span class="esquerda label">
                                    &nbsp;
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    echo $this->Form->select("Suspensao." . $ks . ".Resultado.tipo_resultado_id", $tipoResultadoSuspensao, $idTresultadoS
                                            , array(
                                        'value' => $idTresultadoS
                                        , 'indice' => $ks, 'id' => uniqid(), 'style' => 'width:225px'
                                            ), '[sem resultado]'
                                    );
                                    ?>
                                    &nbsp;
                                </span>
                            </td>
                            <td>
                                <span class="esquerda">
                                    <?php
                                    echo $this->Form->text("Suspensao." . $ks . ".Resultado.data_resultado", array('class' => "data", 'id' => uniqid()));
                                    ?>
                                </span>
                            </td>
                            <td>
                                <span class="esquerda label">
                                    &nbsp;
                                </span>
                            </td>
                        </tr>  
                    </table>
                <?php } ?>    
                <span class="direita novoItem ui-corner-bottom">
                    <?php
                    //FireCake::info($idForm, 'idForm');
                    echo $ajax->link(
                            "Nova Suspensão " . $this->Html->image("icones16/add.png")
                            , array(
                        'controller' => 'execucao_penais',
                        'action' => "novaSuspensao/-1/$modelAssocSuspencao?trs=1"
                            ), array('with' => "Form.serialize( $('formExecucao') )",
                        'update' => 'divSuspensoes',
                        'complete' => 'refreshJquery()',
                        'indicator' => 'loading',
                            ), null, false
                    );
                    ?>
                </span>
            </td>
        </tr>
    </table>
</div>
<div id="resSuspensao"></div>