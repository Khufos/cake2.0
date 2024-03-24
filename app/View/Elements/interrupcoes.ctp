<div id="interrupcoes">
    <table class="table table-bordered">
        <thead><tr>
                <th><label>Data Início</label></th>
                <th><label>Data Fim</label></th>
                <th><label>Intervalo</label></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <?php
        $perTotalInterrupcao = array('a' => 0, 'm' => 0, 'd' => 0);
        $this->Util->setaValorPadrao($remover, -1);
        $key = 0;
        ?>
        <?php
        $this->Util->setaValorPadrao($interrupcoes, array());
        foreach ($interrupcoes as $key => $value) {
            if ($key != $remover) {
                ?>                
                <tr>
                    <td>
                        <div class="form-group">
                            <?php
                            $args = array(
                                'class' => "form-control input-sm data",
                                'data-date-format' => 'DD/MM/YYYY',
                                'type' => 'text',
                                'label' => false,
                                'value' => $this->Util->ddmmaa($value['data_inicio'])
                            );
                            echo $this->Form->text("Interrupcao.$key.data_inicio", $args);
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php
                            $args = array(
                                'class' => "form-control input-sm data difDateInterrupcao",
                                'indice' => $key,
                                'idDif' => 'interrupcao_' . $key,
                                'data-date-format' => 'DD/MM/YYYY',
                                'type' => 'text',
                                'label' => false,
                                'value' => $this->Util->ddmmaa($value['data_fim'])
                            );
                            echo $this->Form->text("Interrupcao.$key.data_fim", $args);

                            $diferenca = $this->Util->difDatasDMA($this->Util->aammdd($value['data_inicio']), $this->Util->aammdd($value['data_fim']));
                            $perTotalInterrupcao['a'] += $diferenca['a'];
                            $perTotalInterrupcao['m'] += $diferenca['m'];
                            $perTotalInterrupcao['d'] += $diferenca['d'];
                            ?>
                        </div>
                    </td>
                    <td id="interrupcao_<?php echo $key; ?>" class="label esquerda"><?= $this->Util->formataParaDMA($diferenca) ?></td>
                    <td>
                        <?php
                        if (empty($value['id'])) {
                            echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                'controller' => 'interrupcoes',
                                'action' => "novaInterrupcao/$key/$idForm?trs=1"), array(
                                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                'before' => $this->Js->get('#loading')->effect('show'),
                                'success' => $this->Js->get('#loading')->effect('hide'),
                                'update' => '#interrupcoes',
                                'div' => false,
                                'method' => 'POST',
                                'async' => true,
                                'class' => 'btn btn-default margintop20',
                                'title' => 'Apagar',
                                'dataExpression' => true,
                                'complete' => 'refreshJquery();',
                                'escape' => false)
                            );
                            echo $this->Js->writeBuffer();
                        } else {
                            $idInterrupcao = $value['id'];
                            $idExecucaoPenal = $value['execucao_penal_id'];

                            echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                'controller' => 'execucao_penais',
                                'action' => "apagaInterrupcao/$idInterrupcao/$idExecucaoPenal?trs=1"), array(
                                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                'before' => $this->Js->get('#loading')->effect('show'),
                                'success' => $this->Js->get('#loading')->effect('hide'),
                                'update' => '#interrupcoes',
                                'div' => false,
                                'method' => 'POST',
                                'async' => true,
                                'class' => 'btn btn-default margintop20',
                                'title' => 'Apagar',
                                'dataExpression' => true,
                                'escape' => false,
                                'complete' => 'refreshJquery();')
                            );
                            echo $this->Js->writeBuffer();
                        }
                        echo $this->Form->text("Interrupcao.$key.id", array('type' => 'hidden', 'value' => isset($value['id']) ? $value['id'] : ''));
                        echo $this->Form->text("Interrupcao.$key.execucao_penal_id", array('type' => 'hidden', 'value' => isset($value['execucao_penal_id']) ? $value['execucao_penal_id'] : ''));
                        ?>
                    </td>
                </tr>
                <?php
            }
        }

        $key++;
        if ($remover == -1) {
            ?>
            <tr>
                <td>
                    <div class="form-group">
                        <?php
                        $args = array(
                            'class' => "form-control input-sm data",
                            'data-date-format' => 'DD/MM/YYYY',
                            'type' => 'text',
                            'label' => false
                        );
                        echo $this->Form->text("Interrupcao.$key.data_inicio", $args);
                        ?>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <?php
                        $args = array(
                            'class' => "form-control input-sm data difDateInterrupcao",
                            'data-date-format' => 'DD/MM/YYYY',
                            'type' => 'text',
                            'label' => false,
                            'indice' => $key,
                            'idDif' => 'interrupcao_' . $key
                        );
                        echo $this->Form->text("Interrupcao.$key.data_fim", $args);
                        ?>                            
                    </div>
                </td>
                <td align="left"><span id="interrupcao_<?php echo $key ?>" class="label"></span></td>
                <td colspan="4">
                    <?php
                    echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                        'controller' => 'interrupcoes',
                        'action' => "novaInterrupcao/$key/$idForm?trs=1"), array(
                        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                        'before' => $this->Js->get('#loading')->effect('show'),
                        'success' => $this->Js->get('#loading')->effect('hide'),
                        'update' => '#interrupcoes',
                        'div' => false,
                        'method' => 'POST',
                        'async' => true,
                        'class' => 'btn btn-default margintop20',
                        'title' => 'Apagar',
                        'dataExpression' => true,
                        'escape' => false)
                    );
                    echo $this->Js->writeBuffer();
                    ?>
                </td>
            <?php }
            ?>
        </tr>
        <tr>
            <td colspan="2"><label>Total</label></td>
            <td colspan="2">
                <b><?php
                    # Calcula a diferença de dias do total da interrupção
                    $diasInterrupcao = ((($perTotalInterrupcao['d'] / 30) - intval($perTotalInterrupcao['d'] / 30)) * 30);
                    $mesesEmDiasInterrupcao = intval($perTotalInterrupcao['d'] / 30);

                    # Calcula a diferença de meses do total da interrupção
                    $mesesInterrupcao = (((($perTotalInterrupcao['m'] + $mesesEmDiasInterrupcao) / 12) - intval(($perTotalInterrupcao['m'] + $mesesEmDiasInterrupcao) / 12)) * 12);
                    $anosEmMesesInterrupcao = intval(($perTotalInterrupcao['m'] + $mesesEmDiasInterrupcao) / 12);

                    # Calcula a diferença de anos do total da interrupção
                    $anosInterrupcao = ($perTotalInterrupcao['a'] + $anosEmMesesInterrupcao);

                    echo $anosInterrupcao . 'a ' . $mesesInterrupcao . 'm ' . $diasInterrupcao . 'd';
                    ?></b>
            </td>
        </tr>
    </table>

    <?php
    echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
        'controller' => 'interrupcoes',
        'action' => "novaInterrupcao/-1/$idForm?trs=1"), array(
        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
        'before' => $this->Js->get('#loading')->effect('show'),
        'success' => $this->Js->get('#loading')->effect('hide'),
        'div' => false,
        'complete' => 'refreshJquery();runEffect();',
        'update' => '#interrupcoes',
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

<script type="text/javascript">
    $(document).ready(function () {
        $('.difDateInterrupcao').change(function () {
            console.log('passei aqui - interrupcao');
            var indice = $(this).attr('indice');
            var idDif = $(this).attr('idDif');
            var dtI = $('#Interrupcao' + indice + 'DataInicio').val();
            var dtF = $('#Interrupcao' + indice + 'DataFim').val();

            diferenca(dtI, dtF, idDif);
        });
    });
</script>
