<?php $idListaPedido = uniqid(); ?>
<div id="<?php echo $idListaPedido; ?>">
    <?php
    $this->Util->setaValorPadrao($resultadoIndeferido, 13);
    $this->Util->setaValorPadrao($habilitaPedido[0], 59);
    $this->Util->setaValorPadrao($habilitaPedido[1], 63);
    ?>
    <style type="text/css">
        .bloqueado{
            background-color: #CCCCCC;
        }
        .hide{
            display:none;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var idIndeferido = <?php echo($resultadoIndeferido); ?>;
            var idVistaMP = <?php echo($habilitaPedido[0]); ?>;
            var idDeligencia = <?php echo($habilitaPedido[1]); ?>;

            $('.situacaoPedido').change(function () { // controla a exibição do resultado e data do pedido
                var indice = $(this).attr('indice');
                var idSituacao = $(this).val();

                if (idSituacao == 58) { //habilita Pedidos Protocolados
                    $('.hide' + indice).css('display', 'table-cell');
                } else {
                    $('.hide' + indice).css('display', 'none');
                }
                if (idSituacao == idDeligencia || idSituacao == idVistaMP) { //habilita
                    $('.resultadoSituacao' + indice).removeAttr('disabled');
                    $('.resultadoSituacao' + indice).removeClass('bloqueado');

                } else { // desabilita
                    $('.resultadoSituacao' + indice).attr('disabled', 'disabled');
                    $('.pedidoIndeferido' + indice).attr('disabled', 'disabled');
                    $('.resultadoSituacao' + indice).val('');
                    $('.resultadoSituacao' + indice).addClass('bloqueado');
                    $('.pedidoIndeferido' + indice).addClass('bloqueado');
                }

            });

            $('.resultadoPedido').change(function () { // controla a exibição da data de renovação e recurso
                var indice = $(this).attr('indice');
                var idResultado = $(this).val();
                if (idResultado == idIndeferido) { // habilita
                    $('.pedidoIndeferido' + indice).removeAttr('disabled');
                    $('.pedidoIndeferido' + indice).removeClass('bloqueado');
                    $('.resultadoSituacao' + indice).removeClass('bloqueado');

                } else { // desabilita
                    $('.pedidoIndeferido' + indice).attr('disabled', 'disabled');
                    $('.resultadoSituacao' + indice).removeClass('bloqueado');
                    $('.pedidoIndeferido' + indice).addClass('bloqueado');

                }
            });

            $('.resultadoRecurso').change(function () { // controla o cauculo da data para  progressão
                var indice = $(this).attr('indice');
                $('.pedidoIndeferido' + indice).removeAttr('disabled');
                $('.resultadoSituacao' + indice).removeClass('bloqueado');
            });
        });
    </script>

    <?php
    $condBeneficios = $this->Util->setaValorPadrao($condBeneficios, false);
    !empty($condBeneficios) ? $idSIni = NULL : $idSIni;
    foreach ($pedidos as $key => $value) {
        ?>
        <table class="table">
            <tr>
                <td>Situa&ccedil;&atilde;o:</td>
                <td>Data:</td>
                <td>Resultado:</td>
                <td>Data:</td>
            </tr>
            <tr>
                <td>
                    <?php
                    $idSistuacao = $this->Util->setaValorPadrao($value['Pedido']['situacao_id'], $idSIni);
                    $idPedido = $this->Util->setaValorPadrao($value['Pedido']['id'], null);
                    $args = array(
                        'default' => $idSistuacao,
                        'class' => 'form-control input-sm situacaoPedido',
                        'indice' => $key,
                        'id' => uniqid()
                    );
                    echo $this->Form->select("$labelPedido." . $key . ".situacao_id", $situacoes, $args);
                    echo $this->Form->hidden("$labelPedido.$key.id", array('value' => $idPedido, 'id' => uniqid()));
                    $disabled = "disabled";
                    $date = '';
                    $sResult = array($habilitaPedido[0], $habilitaPedido[1]); // Concluso Juiz, Vista MP
                    if (in_array($idSistuacao, $sResult)) { // situação que modifica o resultado
                        $disabled = "";
                        $date = 'date';
                    }
                    ?>
                </td>
                <td>
                    <div class="form-group">
                        <?php
                        $data = $this->Util->ddmmaa($this->Util->setaValorPadrao($value['Pedido']['data'], date('Y-m-d')));
                        $args = array(
                            'class' => 'form-control input-sm data resultadoSituacao',
                            'data-date-format' => 'DD/MM/YYYY',
                            'type' => 'text',
                            'label' => false,
                            'value' => $data,
                            'id' => uniqid()
                        );

                        echo $this->Form->text("$labelPedido.$key.data", $args);
                        ?>
                    </div>
                </td>
                <td>
                    <?php
                    $idResultado = $this->Util->setaValorPadrao($value['Resultado']['id'], null);
                    $idTresultado = $this->Util->setaValorPadrao($value['Resultado']['tipo_resultado_id'], null);

                    $args = array(
                        'default' => $idTresultado,
                        'disabled' => $disabled,
                        'class' => "form-control input-sm resultadoPedido resultadoSituacao$key",
                        'indice' => $key,
                        'empty' => 'AGUARDANDO RESULTADO',
                        'id' => uniqid()
                    );
                    echo $this->Form->select("$labelPedido." . $key . ".Resultado.tipo_resultado_id", $tipoResultados, $args);

                    echo $this->Form->hidden("$labelPedido.$key.resultado_id", array('value' => $idResultado, 'id' => uniqid()));
                    echo $this->Form->hidden("$labelPedido.$key.Resultado.id", array('value' => $idResultado, 'id' => uniqid()));
                    $disabledR = "disabled";
                    $dateR = '';
                    if ($idTresultado == $idResIndeferido) { // if is deferido  enabled recurs
                        $disabledR = "";
                        $dateR = 'date';
                    }
                    ?>
                </td>
                <td>
                    <div class="form-group">
                        <div class='input-group <?php echo $date; ?>' id='data_resultado<?php echo $key ?>'>
                            <?php
                            $dataResultado = $this->Util->ddmmaa($this->Util->setaValorPadrao($value['Resultado']['data_resultado'], null));
                            $args = array(
                                'class' => "form-control input-sm data resultadoSituacao$key",
                                'data-date-format' => 'DD/MM/YYYY',
                                'value' => $dataResultado,
                                'id' => uniqid(),
                                'disabled' => $disabled
                            );
                            echo $this->Form->text("$labelPedido.$key.Resultado.data_resultado", $args);
                            ?>
                        </div>
                    </div>
                </td>
            </tr>
            <!-- Exibir quando o pedido for Indeferido-->

            <?php
            if ($value['Pedido']['situacao_id'] == 58) {
                $hide = 'true';
            } else {
                $hide = 'hide';
            }

            if ($hide == 'true') {
                ?>
                <tr>
                    <td>
                        <div class="hide<?php echo($key); ?> <?php echo($hide); ?>">
                            <ul style="list-style:none">
                                <li><span class="label esquerda">Nº do Pedido Protocolado:</span></li>
                                <li><?php echo $this->Form->text("$labelPedido." . $key . ".numero_pedido", array('value' => $this->Util->setaValorPadrao($value['Pedido']['numero_pedido'], null), 'indice' => $key, 'id' => uniqid())); ?></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php
            }

            if (!$condBeneficios) {
                ?>
                <tr style="background-color: #CCCCCC;">
                    <td colspan="4">
                        <div class="col-md-4">
                            <label>Data Renova&ccedil;&atilde;o: </label>
                            <div class="form-group">
                                <div class='input-group <?php echo $date; ?>' id='data_renovacao<?php echo $key ?>'>
                                    <?php
                                    $dataRenovacao = $this->Util->ddmmaa($this->Util->setaValorPadrao($value['Pedido']['data_renovacao'], null));
                                    array('value' => $dataRenovacao,
                                        'disabled' => $disabled,
                                        'data-date-format' => 'DD/MM/YYYY',
                                        'class' => "data pedidoIndeferido$key",
                                        'id' => uniqid());

                                    echo $this->Form->text("$labelPedido.$key.data_renovacao", $args);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $this->Util->setaValorPadrao($edicao, false);
                        if ($edicao) {
                            if ($dataRenovacao) {
                                echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
                                    'controller' => 'execucao_penais',
                                    'action' => "novoPedido", $labelPedido, $idPedido, '?' => array('trs' => '1')
                                        ), array(
                                    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                    'before' => $this->Js->get('#loading')->effect('show'),
                                    'success' => $this->Js->get('#loading')->effect('hide'),
                                    'div' => false,
                                    'complete' => 'refreshJquery();runEffect();',
                                    'update' => '#' . $idListaPedido,
                                    'method' => 'POST',
                                    'async' => true,
                                    'dataExpression' => true,
                                    'title' => 'Gera um novo pedido',
                                    'class' => 'btn btn-default',
                                    'escape' => false,
                                    'confirm' => 'Deseja realmente gerar um novo pedido?'
                                ));
                            }
                        }
                        ?>


                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td>Recurso:</td>
                <td>Data:</td>
                <td>Resultado:</td>
                <td>Data:</td>
            </tr>
            <tr>
                <td>
                    <?php
                    $idTipoRecurso = $this->Util->setaValorPadrao($value['Recurso']['tipo_recurso_id'], null);
                    $idRecurso = $this->Util->setaValorPadrao($value['Recurso']['id'], null);
                    $args = array(
                        'default' => $idTipoRecurso,
                        'disabled' => $disabledR,
                        'class' => "form-control input-sm pedidoIndeferido$key",
                        'id' => uniqid(),
                        'empty' => 'SEM RECURSO'
                    );
                    echo $this->Form->select("$labelPedido." . $key . ".Recurso.tipo_recurso_id", $tipoRecursos, $args);
                    echo $this->Form->hidden("$labelPedido." . $key . ".Recurso.id", array('value' => $idRecurso, 'id' => uniqid()));
                    ?>
                </td>
                <td>
                    <div class="form-group">
                        <div class='input-group <?php echo $dateR; ?>' id='data_recurso<?php echo $key ?>'>
                            <?php
                            $dataRecurso = $this->Util->ddmmaa($this->Util->setaValorPadrao($value['Recurso']['data_recurso'], null));
                            $args = array(
                                'class' => "form-control input-sm data pedidoIndeferido$key",
                                'data-date-format' => 'DD/MM/YYYY',
                                'type' => 'text',
                                'label' => false,
                                'disabled' => $disabledR,
                                'value' => $dataRecurso,
                                'id' => uniqid()
                            );

                            echo $this->Form->text("$labelPedido.$key.Recurso.data_recurso", $args);
                            ?>
                        </div>
                    </div>
                </td>
                <td>
                    <?php
                    $idTipoResultadoR = $this->Util->setaValorPadrao($value['ResultadoR']['tipo_resultado_id'], null); // resultado do recurso
                    $idResultadoR = $this->Util->setaValorPadrao($value['ResultadoR']['id'], null); // resultado do recurso
                    $args = array(
                        'default' => $idTipoResultadoR,
                        'disabled' => $disabledR,
                        'class' => "form-control input-sm pedidoIndeferido$key",
                        'id' => uniqid(),
                        'empty' => 'AGUARDANDO RESULTADO',
                        'indice' => $key
                    );
                    echo $this->Form->select("$labelPedido." . $key . ".Recurso.tipo_resultado_id", $tipoResultadoRecurso, $args);
                    echo $this->Form->hidden("$labelPedido." . $key . ".Recurso.resultado_id", array('value' => $idResultadoR, 'id' => uniqid()));
                    ?>
                </td>
                <td>
                    <div class="form-group">
                        <div class='input-group <?php echo $dateR; ?>' id='data_resultado<?php echo $key ?>'>
                            <?php
                            $dataResultaR = $this->Util->ddmmaa($this->Util->setaValorPadrao($value['ResultadoR']['data_resultado'], null)); // data do resultado do recurso
                            $args = array(
                                'class' => "form-control input-sm data pedidoIndeferido$key",
                                'data-date-format' => 'DD/MM/YYYY',
                                'type' => 'text',
                                'label' => false,
                                'disabled' => $disabledR,
                                'value' => $dataResultaR,
                                'id' => uniqid()
                            );
                            echo $this->Form->text("$labelPedido.$key.Recurso.data_resultado", $args);
                            ?>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    <?php } ?>
</div>
