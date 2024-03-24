<div id="regimes">
    <?php
    $this->Util->setaValorPadrao($regimes, array(1));
    $idRegime = $this->Util->setaValorPadrao($regimes['Regime']['id'], null);
    ?>
    <table class="table table-bordered">
        <tr>
            <td><label>*Regime Atual:</label></td>
            <td><label>*Data In&iacute;cio:</label></td>
            <td><label>Data da audiência:</label></td>
            <td><label>Prev. de progress&atilde;o:</label></td>
            <td>
                <?php
                $this->Util->setaValorPadrao($edicao, false);
                if ($edicao) {
                    ?>
                    <?php
                    echo $this->Html->link($this->Html->div('glyphicon glyphicon-search', ''), array(
                        'controller' => 'execucao_Penais',
                        'action' => "buscaRegimes/$idExecucaoPenal?trs=1"), array(
                        'div' => false,
                        'method' => 'POST',
                        'async' => true,
                        'dataExpression' => true,
                        'title' => 'Histórico do Regime',
                        'class' => 'link-modal btn btn-default',
                        'data-target' => "#modal",
                        'data-toggle' => "modal",
                        'escape' => false
                    ));
                    ?>
                <?php } ?>
            </td>
        </tr>            
        <tr>
            <td>
                <?php
                $idTregime = $this->Util->setaValorPadrao($regimes['Regime']['tipo_regime_id'], null);
                $arg = array(
                    'default' => $idTregime,
                    'class' => 'form-control input-sm validate[required]',
                    'empty' => 'Selecione'
                );
                echo $this->Form->select("Regime.tipo_regime_id", $tipoRegimes, $arg);

                $idExecucaoPenalRegime = $this->Util->setaValorPadrao($regimes['ExecucaoPenaisRegime']['id'], null);
                echo $this->Form->hidden("Regime.id", array('value' => $idRegime, 'id' => uniqid()));
                echo $this->Form->hidden("ExecucaoPenaisRegime.id", array('id' => uniqid(), 'value' => $idExecucaoPenalRegime));
                ?>
            </td>
            <td>
                <div class="form-group">
                    <?php
                    $data = $this->Util->ddmmaa($this->Util->setaValorPadrao($regimes['Regime']['data'], null));
                    $args = array(
                        'class' => "form-control input-sm data validate[required]",
                        'data-date-format' => 'DD/MM/YYYY',
                        'type' => 'text',
                        'label' => false,
                        'value' => $data
                    );
                    echo $this->Form->text("Regime.data", $args);
                    ?>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <?php
                    $data = $this->Util->ddmmaa($this->Util->setaValorPadrao($regimes['Regime']['dt_audiencia'], ''));
                    $args = array(
                        'class' => "form-control input-sm data",
                        'data-date-format' => 'DD/MM/YYYY',
                        'type' => 'text',
                        'label' => false,
                        'value' => $data,
                        'id' => uniqid()
                    );
                    echo $this->Form->text("Regime.dt_audiencia", $args);
                    ?>
                </div>
            </td>
            <td colspan="2">
                <span class="esquerda label_bold" >
                    <?php
                    echo $this->Util->ddmmaa($dataProgressao);
                    ?>
                </span>
            </td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <h3 class="captionA">Pedido(s)</h3>
                <?php
//                FireCake::info($realizaPedido, "\$realizaPedido");
                $this->Util->setaValorPadrao($realizaPedido, true);
                if ($realizaPedido) {
                    $this->Util->setaValorPadrao($regimes['Regime']['Pedidos'], array(array(1)));
                    $pedidos = $regimes['Regime']['Pedidos'];
                    if (count($pedidos) == 0) { # nao tem pedidos: coloca a data da progresso
                        $pedidos[0]['Pedido']['regime_id'] = $regimes['Regime']['id'];
                        $pedidos[0]['Pedido']['data'] = $dataProgressao;
                    }
                    echo $this->element('pedidos', array('pedidos' => $pedidos, 'labelPedido' => 'pedidoR'));
                    //FireCake::info($pedidos, 'pedidos');
                }
                ?>
            </td>
        </tr>

    </table>    
</div>

<?php
$this->Util->setaValorPadrao($regressao, false);
if ($regressao) {
    ?>
    <?php
    $this->Util->setaValorPadrao($idExecucaoPenal, 0);
    echo $this->Html->link($this->Html->div('glyphicon glyphicon-search', ''), array(
        'controller' => 'execucao_penais',
        'action' => "regredir/$idExecucaoPenal?trs=1"), array(
        'div' => false,
        'method' => 'POST',
        'async' => true,
        'dataExpression' => true,
        'title' => 'Regressão do Regime',
        'class' => 'link-modal btn btn-default',
        'data-target' => "#modal",
        'data-toggle' => "modal",
        'escape' => false
    ));
    ?>
<?php } ?>
