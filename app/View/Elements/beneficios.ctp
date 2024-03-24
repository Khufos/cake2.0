<div id="beneficios">
    <?php
    $this->Util->setaValorPadrao($remover, -1);
    $key = 0;
    if (!empty($beneficios)) {
        foreach ($beneficios as $key => $value) {
            if ($key != $remover) {
                ?>
                <table class="table">
                    <caption><?php echo($key) ?>º Direito Adotado</caption>
                    <tbody bgcolor=" <?= (($key % 2) == 0) ? '#E4F5EF' : '#FFFFFF' ?>">
                        <tr>
                            <td>Direito Adotado:</td>
                            <td>Data:</td>
                            <td>Observação:</td> 
                            <td>
                                <?php if (empty($value['Beneficio']['id'])) { ?>
                                    <?php
                                    if ($key > 1) {
                                        echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                            'controller' => 'beneficios',
                                            'action' => "novoBeneficio/$key/$modelAssocBeneficio/$idForm?trs=1"), array(
                                            'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                            'complete' => 'refreshJquery();',
                                            'update' => '#beneficios',
                                            'div' => false,
                                            'method' => 'POST',
                                            'async' => true,
                                            'class' => 'margintop20',
                                            'title' => 'Apagar',
                                            'dataExpression' => true,
                                            'escape' => false)
                                        );
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <div class="form-group">
                                    <?php
                                    $args = array(
                                        'default' => $value['tipo_beneficio_id'],
                                        'empty' => 'Selecione',
                                        'class' => 'form-control input-sm'
                                    );
                                    echo $this->Form->select("Beneficio.$key.tipo_beneficio_id", $tipoBeneficios, $args);
                                    ?>
                                </div>    
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->text("Beneficio.$key.data_beneficio", array('class' => 'data resultadoSituacao form-control input-sm', 'value' => $this->Util->ddmmaa($this->Util->setaValorPadrao($value['data_beneficio'], null))));
                                    echo $this->Form->text("Beneficio.$key.id", array('type' => 'hidden', 'value' => $value['id']));
                                    echo $this->Form->text("$modelAssocBeneficio.$key.id", array('type' => 'hidden', 'value' => $this->Util->setaValorPadrao($value[$modelAssocBeneficio][$key]['id'], null)));
                                    ?>
                                </div>
                            </td>
                            <td colspan="2"><?= $this->Form->textarea("Beneficio.$key.observacao", array('value' => $this->Util->setaValorPadrao($value['observacao'], ''), 'class' => 'form-control input-sm')) ?></td>

                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h4 class="captionA">Pedido(s)</h4>
                                <?php
                                $this->Util->setaValorPadrao($add, false); // Verifica se é add ou edit 
                                if ($add) { // add
                                    $chave = uniqid(); // evitar conflito com os pedidos da aba de regime
                                    unset($pedidos);
                                    $pedidos["Pedido$key"] = $beneficios[$key]['Pedido'][0];
                                } else { // edit
                                    unset($pedidos);
                                    $pedidos["Pedido$key"] = $beneficios[$key]['Pedido'][0];
                                }

                                echo $this->element('pedidos', array('pedidos' => $pedidos, 'condBeneficios' => 'true', 'labelPedido' => 'pedidoB'));
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
        }
    }

    $key++;
    if ($add) {
        if ($remover == -1) {
            ?>
            <table class="table">
                <caption><?php echo($key) ?>º Direito Adotado</caption>
                <tbody bgcolor=" <?= (($key % 2) == 0) ? '#E4F5EF' : '#FFFFFF' ?>">
                    <tr>
                        <td><?php echo $key ?>º Direito Adotado:</td>
                        <td>Data:</td>
                        <td>Observação:</td>
                        <td>
                            <?php
                            if (empty($value['Beneficio']['id'])) {
                                if ($key > 1) {
                                    echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                        'controller' => 'beneficios',
                                        'action' => "novoBeneficio/$key/$modelAssocBeneficio/$idForm?trs=1"), array(
                                        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                        'complete' => 'refreshJquery();',
                                        'update' => '#beneficios',
                                        'div' => false,
                                        'method' => 'POST',
                                        'async' => true,
                                        'class' => 'margintop20',
                                        'title' => 'Apagar',
                                        'dataExpression' => true,
                                        'escape' => false)
                                    );
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <?php
                                $args = array(
                                    'class' => 'form-control input-sm validate[required]',
                                    'empty' => 'Selecione'
                                );
                                echo $this->Form->select("Beneficio.$key.tipo_beneficio_id", $tipoBeneficios, $args);
                                ?>
                            </div> 
                        </td>
                        <td>
                            <div class="form-group">
                                <?php
                                $args = array('class' => 'form-control input-sm data resultadoSituacao', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false);
                                echo $this->Form->text("Beneficio.$key.data_beneficio", $args);
                                echo $this->Form->text("Beneficio.$key.id", array('type' => 'hidden'));
                                ?>
                            </div>
                        </td>
                        <td colspan="2"><?= $this->Form->textarea("Beneficio.$key.observacao", array('class' => 'form-control input-sm')) ?></td>

                    </tr>
                    <tr>
                        <td colspan="5">
                            <h4 class="captionA">Pedido(s)</h4>
                            <?php
                            $this->Util->setaValorPadrao($add, false); // Verifica se é add ou edit
                            if ($add) { // add
                                unset($beneficios);
                                $chave = uniqid(); // evitar conflito com os pedidos da aba de regime
                                $this->Util->setaValorPadrao($beneficios['Beneficio']['Pedidos'], array($chave => array(1)));
                                $pedidos = $beneficios['Beneficio']['Pedidos'];
                                $pedidos[$chave]['Pedido']['beneficio_id'] = $this->Util->setaValorPadrao($beneficios['Beneficio']['id'], 0);
                            } else { // edit
                                $pedidos = $beneficios['Beneficio']['Pedidos'];
                                $pedidos[$key - 1]['Pedido']['beneficio_id'] = $beneficios['Beneficio']['id'];
                            }
                            echo $this->element('pedidos', array('pedidos' => $pedidos, 'condBeneficios' => 'true', 'labelPedido' => 'pedidoB'));
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
        }
    }
    ?>
    <?php
    echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
        'controller' => 'beneficios',
        'action' => "novoBeneficio/-1/$modelAssocBeneficio/$idForm" . "?trs=1"), array(
        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
        'div' => false,
        'complete' => 'refreshJquery();',
        'update' => '#beneficios',
        'method' => 'POST',
        'async' => true,
        'dataExpression' => true,
        'title' => 'Novo',
        'class' => 'btn btn-default',
        'escape' => false
    ));
    echo $this->Js->writeBuffer();
    ?>
</div>


