
<div id="livramentos">
    <div class="direita">
        <?php
        $idLivramento = $this->Util->setaValorPadrao($livramentos['Livramento']['id'], 0);

        $idSituacao = $this->Util->setaValorPadrao($livramentos['Livramento']['situacao_id'], null);
        $idExecucaoPenalLivramento = $this->Util->setaValorPadrao($livramentos['ExecucaoPenaisLivramento']['id'], null);
        if ($idSIni != $idSituacao && $idLivramento > 0) { // verifica se a situação do livramento ja saiu da situação inicial
            ?>
            <?php
            echo $this->Html->link($this->Html->div('glyphicon glyphicon-search', ''), array(
                'controller' => 'execucao_penais',
                'action' => "revogar_livramento/$idLivramento?trs=1"), array(
                'div' => false,
                'method' => 'POST',
                'async' => true,
                'dataExpression' => true,
                'title' => 'Revogação da Condicional',
                'class' => 'link-modal btn btn-default',
                'data-target' => "#modal",
                'data-toggle' => "modal",
                'escape' => false
            ));
            ?>
        <?php } ?>
    </div>
    <br/>
    <br/>
    <?php
    $this->Util->setaValorPadrao($livramentos, array(1));
    ?>
    <table class="table table-bordered">
        <tr>            
            <td>
                <label>
                    Data. do Livramento
                </label>
            </td>
            <td>
                <label>
                    Situa&ccedil;&atilde;o Livramento
                </label>
            </td>
            <?php if ($edicao) { ?>
                <td align="right" style="text-align:right;">
                    <?php
                    echo $this->Html->link($this->Html->div('glyphicon glyphicon-search', ''), array(
                        'controller' => 'execucao_Penais',
                        'action' => "buscaLivramentos/$idExecucaoPenal?trs=1"), array(
                        'div' => false,
                        'method' => 'POST',
                        'async' => true,
                        'dataExpression' => true,
                        'title' => 'Histórico do Livramento',
                        'class' => 'link-modal btn btn-default',
                        'data-target' => "#modal",
                        'data-toggle' => "modal",
                        'escape' => false
                    ));
                    ?>
                </td>
            <?php } ?>
        </tr>
        <tr>            
            <td>
                <div class="form-group">
                    <?php
                    $data = $this->Util->ddmmaa($this->Util->setaValorPadrao($livramentos['Livramento']['data'], $dataLivramento));
                    $args = array(
                        'class' => "form-control input-sm data",
                        'data-date-format' => 'DD/MM/YYYY',
                        'type' => 'text',
                        'label' => false,
                        'value' => $data
                    );
                    echo $this->Form->text("Livramento.data", $args);
                    echo $this->Form->hidden("Livramento.id", array('value' => $idLivramento, 'id' => uniqid()));
                    echo $this->Form->hidden("ExecucaoPenaisLivramento.id", array('id' => uniqid(), 'value' => $idExecucaoPenalLivramento));
                    ?>
                </div>
            </td>

            <td colspan="2">
                <span class="esquerda label_bold" >
                    <?php
                    $idSituacao = $this->Util->setaValorPadrao($livramentos['Livramento']['situacao_id'], $idSIni);
                    echo $this->Util->setaValorPadrao($situcoesLivramento[$idSituacao]);
                    ?>
                </span>
            </td>
        </tr>                   
        <tr>
            <td>
                &nbsp;
            </td>
        </tr>        
        <tr>
            <td colspan="4">
                <h3 class="captionA">Pedido(s)</h3>
                <?php
                $habilitaPedido[0] = '59';
                $habilitaPedido[1] = '63';
                $chave = uniqid(); // evitar conflito com os pedidos da aba de regime
                $this->Util->setaValorPadrao($livramentos['Livramento']['Pedidos'], array($chave => array(1)));
                $pedidos = $livramentos['Livramento']['Pedidos'];
                if (count($pedidos) == 0) { # nao tem pedidos: coloca a data do livramento
                    $pedidos[$chave]['Pedido']['livramento_id'] = $livramentos['Livramento']['id'];
                    $pedidos[$chave]['Pedido']['data'] = $dataLivramento;
                }
                // FireCake::info($pedidos, "\$pedidosLivramento");
                echo $this->element('pedidos', array('pedidos' => $pedidos, 'labelPedido' => 'pedidoL', 'habilitaPedido' => $habilitaPedido)
                );
                ?>
            </td>
        </tr>
    </table> 
    <br>
</div>

<br>
<?php
if ($idSIni != $idSituacao && $idLivramento > 0) { // verifica se a situação do livramento ja saiu da situação inicial
    $this->Util->setaValorPadrao($livramentos['Livramento']['Suspensoes'], array(array(1)));
    $suspensoes = $livramentos['Livramento']['Suspensoes'];
    echo $this->element('suspensoes'
            , array(
        'suspensoes' => $suspensoes,
        'idLivramento' => $idLivramento
            )
    );
}
?> 
<br>
<br>