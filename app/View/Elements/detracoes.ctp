<div id="detracoes">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Data da Prisão</th>
                <th>Data da Soltura</th>
                <th>Intervalo</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <?php
        $this->Util->setaValorPadrao($remover, -1);
        $key = 0;
        $perTotalDetracao = array('a' => 0, 'm' => 0, 'd' => 0);
        $detracoes = isset($detracoes) ? $detracoes : array();
        foreach ($detracoes as $key => $value) {
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
                                'value' => $this->Util->ddmmaa($value['data_prisao'])
                            );
                            echo $this->Form->text("Detracao.$key.data_prisao", $args);
                            ?>
                        </div>
                    </td>
                    <td>
                        <?php
                        $args = array(
                            'class' => "form-control input-sm data difDateDetracao",
                            'indice' => $key,
                            'idDif' => 'detracao_' . $key,
                            'data-date-format' => 'DD/MM/YYYY',
                            'type' => 'text',
                            'label' => false,
                            'value' => $this->Util->ddmmaa($value['data_soltura'])
                        );
                        echo $this->Form->text("Detracao.$key.data_soltura", $args);
                        $diferenca = $this->Util->difDatasDMA($this->Util->aammdd($value['data_prisao']), $this->Util->aammdd($value['data_soltura']));
                        $perTotalDetracao['a'] += $diferenca['a'];
                        $perTotalDetracao['m'] += $diferenca['m'];
                        $perTotalDetracao['d'] += $diferenca['d'];
                        ?>
                    </td>
                    <td id="detracao_<?php echo $key; ?>" class="label esquerda"><?= $this->Util->formataParaDMA($diferenca) ?></td>
                    <td>
                        <span class="esquerda">
                            <?php
                            if (empty($value['id'])) {
                                echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                    'controller' => 'detracoes',
                                    'action' => "novaDetracao/$key/$idForm?trs=1"), array(
                                    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                    'before' => $this->Js->get('#loading')->effect('show'),
                                    'success' => $this->Js->get('#loading')->effect('hide'),
                                    'update' => '#detracoes',
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
                                $idDetracao = $value['id'];
                                $idExecucaoPenal = isset($value['execucao_penal_id']) ? $value['execucao_penal_id'] : NULL;

                                echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                    'controller' => 'execucao_penais',
                                    'action' => "apagaDetracao/$idDetracao/$idExecucaoPenal?trs=1"), array(
                                    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                    'before' => $this->Js->get('#loading')->effect('show'),
                                    'success' => $this->Js->get('#loading')->effect('hide'),
                                    'update' => '#detracoes',
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
                            }
                            echo $this->Form->text("Detracao.$key.id", array('type' => 'hidden', 'value' => isset($value['id']) ? $value['id'] : NULL));
                            ?>
                        </span>
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
                        echo $this->Form->text("Detracao.$key.data_prisao", $args);
                        ?>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <?php
                        $args = array(
                            'class' => "form-control input-sm data difDateDetracao",
                            'indice' => $key,
                            'idDif' => 'detracao_' . $key,
                            'data-date-format' => 'DD/MM/YYYY',
                            'type' => 'text',
                            'label' => false
                        );
                        echo $this->Form->text("Detracao.$key.data_soltura", $args);
                        ?>
                    </div>
                </td>
                <td align="left"><span id="detracao_<?php echo $key ?>" class="label"></span></td>
                <td colspan="4">
                    <?php
                    echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                        'controller' => 'detracoes',
                        'action' => "novaDetracao/$key/$idForm?trs=1"), array(
                        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                        'before' => $this->Js->get('#loading')->effect('show'),
                        'success' => $this->Js->get('#loading')->effect('hide'),
                        'update' => '#detracoes',
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
                    ?>
                </td>
            <?php } ?>
        </tr>
        <tr>
            <td colspan="2"><label>Total</label></td>
            <td colspan="2">
                <?php
                # Calcula a diferença de dias do total da interrupção
                $diasDetracao = ((($perTotalDetracao['d'] / 30) - intval($perTotalDetracao['d'] / 30)) * 30);
                $mesesEmDiasDetracao = intval($perTotalDetracao['d'] / 30);

                # Calcula a diferença de meses do total da interrupção
                $mesesDetracao = (((($perTotalDetracao['m'] + $mesesEmDiasDetracao) / 12) - intval(($perTotalDetracao['m'] + $mesesEmDiasDetracao) / 12)) * 12);
                $anosEmMesesDetracao = intval(($perTotalDetracao['m'] + $mesesEmDiasDetracao) / 12);

                # Calcula a diferença de anos do total da interrupção
                $anosDetracao = ($perTotalDetracao['a'] + $anosEmMesesDetracao);

                echo $anosDetracao . 'a ' . $mesesDetracao . 'm ' . $diasDetracao . 'd';
                ?>
            </td>
        </tr>

    </table>
    <?php
    echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
        'controller' => 'detracoes',
        'action' => "novaDetracao/-1/$idForm?trs=1"), array(
        'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
        'before' => $this->Js->get('#loading')->effect('show'),
        'success' => $this->Js->get('#loading')->effect('hide'),
        'div' => false,
        'complete' => 'refreshJquery();runEffect();',
        'update' => '#detracoes',
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
        $('.difDateDetracao').bind('change blur', function () {
            var indice = $(this).attr('indice');
            var idDif = $(this).attr('idDif');
            var dtI = $('#Detracao' + indice + 'DataPrisao').val();
            var dtF = $('#Detracao' + indice + 'DataSoltura').val();

            diferenca(dtI, dtF, idDif);
        });
    });
</script>
