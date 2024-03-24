<style type="text/css">
    .boxFont{
        font-weight: bold;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('.box').change(function () {
            var indice = $(this).attr('indice');
            if (this.checked) {
                $('#' + indice).addClass('boxFont');
            } else {
                $('#' + indice).removeClass('boxFont');
            }
        });

        $('.remicaoDtFinal').change(function () {
            var idx = $(this).attr('idx');
            console.log(idx);
            if ($('#tpRemicao' + idx).val() == 'T') {
                dias = date_diff($('#dtIniRemicao' + idx).val(), $('#dtFinalRemicao' + idx).val());
                console.log(dias);
                $('#qtdeDiasRemidos' + idx).val(dias);
            }
        });
    });

</script>
<div id="remicoes">
    <table class="table table-bordered">
        <thead><tr>
                <th>Tipo de Remição*</th>
                <th>mês/ano início</th>
                <th>mês/ano fim</th>
                <th>Total Dias/Horas*</span></th>
                <th>Progressão de Regime?*</th>
                <th>Excluir</th>
            </tr></thead>
        <tbody class="zebra">
            <?php
            $key = 0;
            if (!empty($remicoes)) {
                foreach ($remicoes as $key => $remicao) {
                    ?>        
                    <tr>
                        <td>
                            <div class="form-group">                                
                                <?php
                                $args = array('class' => 'form-control input-sm', 'label' => false, 'value' => $remicao['Remicao']['tipo_remicao'], 'id' => "tpRemicao$key");
                                echo $this->Form->select("Remicao.$key.tipo_remicao", array('E' => 'Estudo', 'T' => 'Trabalho'), $args);
                                ?>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <?php
                                $args = array(
                                    'class' => "form-control input-sm data mesAno",
                                    'data-date-format' => 'DD/MM/YYYY',
                                    'type' => 'text',
                                    'label' => false,
                                    'value' => $this->Util->ddmmaa($remicao['Remicao']['dt_inicio']),
                                    'id' => "dtIniRemicao$key"
                                );
                                echo $this->Form->text("Remicao.$key.dt_inicio", $args);
                                ?>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <?php
                                $args = array(
                                    'class' => "form-control input-sm data mesAno remicaoDtFinal",
                                    'data-date-format' => 'DD/MM/YYYY',
                                    'type' => 'text',
                                    'label' => false,
                                    'value' => $this->Util->ddmmaa($remicao['Remicao']['dt_fim']),
                                    'id' => "dtFinalRemicao$key",
                                    'idx' => $key
                                );
                                echo $this->Form->text("Remicao.$key.dt_fim", $args);
                                ?>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <?php
                                    echo $this->Form->text("Remicao.$key.qtde", array('class' => 'form-control input-sm', 'value' => $remicao['Remicao']['qtde'], 'size' => 4, 'id' => "qtdeDiasRemidos$key"));
                                    ?>
                                    <span style="cursor: help" class="input-group-addon" id="basic-addon2" title ='Informe a quantidade total de dias ou horas. O sistema realizará o cálculo de acordo com o Tipo de Remição.'><strong>?</strong></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <?php
                                $args = array('class' => 'form-control input-sm', 'value' => $remicao['Remicao']['progressao_regime'], 'label' => false);
                                echo $this->Form->select("Remicao.$key.progressao_regime", array(1 => 'Sim', 0 => 'Não'), $args);
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                            echo $this->Form->text("Remicao.$key.id", array('type' => 'hidden', 'value' => $remicao['Remicao']['id']));
                            echo $this->Form->text("Remicao.$key.execucao_penal_id", array('type' => 'hidden', 'value' => $remicao['Remicao']['execucao_penal_id']));
                            if (empty($remicao['Remicao']['id'])) {
                                echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                    'controller' => 'remicoes',
                                    'action' => "novaRemicao/$key/$idForm?trs=1"), array(
                                    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                    'before' => $this->Js->get('#loading')->effect('show'),
                                    'success' => $this->Js->get('#loading')->effect('hide'),
                                    'update' => '#remicoes',
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
                                $idRemicao = $remicao['Remicao']['id'];
                                $idExecucaoPenal = $remicao['Remicao']['execucao_penal_id'];

                                echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', ''), array(
                                    'controller' => 'execucao_penais',
                                    'action' => "apagaRemicao/$idRemicao/$idExecucaoPenal?trs=1"), array(
                                    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                                    'before' => $this->Js->get('#loading')->effect('show'),
                                    'success' => $this->Js->get('#loading')->effect('hide'),
                                    'update' => '#remicoes',
                                    'div' => false,
                                    'method' => 'POST',
                                    'async' => true,
                                    'class' => 'btn btn-default margintop20',
                                    'title' => 'Apagar',
                                    'dataExpression' => true,
                                    'complete' => 'refreshJquery();',
                                    'confirm' => 'Deseja realmente remover a remição?',
                                    'escape' => false)
                                );
                                echo $this->Js->writeBuffer();
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                    <?php } ?>
                <?php } else { ?>
                <tr>
                    <td>
                        <div class="form-group">
                            <?php
                            $args = array('class' => 'form-control input-sm', 'label' => false);
                            echo $this->Form->select("Remicao.0.tipo_remicao", array('E' => 'Estudo', 'T' => 'Trabalho'), $args);
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php
                            $args = array(
                                'class' => "form-control input-sm data mesAno",
                                'data-date-format' => 'DD/MM/YYYY',
                                'type' => 'text',
                                'label' => false
                            );
                            echo $this->Form->text("Remicao.0.dt_inicio", $args);
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php
                            $args = array(
                                'class' => "form-control input-sm data mesAno",
                                'data-date-format' => 'DD/MM/YYYY',
                                'type' => 'text',
                                'label' => false
                            );
                            echo $this->Form->text("Remicao.0.dt_fim", $args);
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="input-group">
                                <?php
                                echo $this->Form->text("Remicao.0.qtde", array('class' => 'form-control input-sm', 'size' => 4));
                                ?>
                                <span style="cursor: help" class="input-group-addon" id="basic-addon2" title ='Informe a quantidade total de dias ou horas. O sistema realizará o cálculo de acordo com o Tipo de Remição.'><strong>?</strong></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php
                            $args = array('class' => 'form-control input-sm', 'label' => false);
                            echo $this->Form->select("Remicao.0.progressao_regime", array(1 => 'Sim', 0 => 'Não'), $args);
                            ?>
                        </div>
                    </td>
                    <td align="center">-</td>
                </tr>
            <?php } ?>
    </table>

    <span class="novoItem ui-corner-bottom" >
        <?php
        echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
            'controller' => 'remicoes',
            'action' => "novaRemicao/-1/$idForm?trs=1"), array(
            'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
            'before' => $this->Js->get('#loading')->effect('show'),
            'success' => $this->Js->get('#loading')->effect('hide'),
            'div' => false,
            'complete' => 'refreshJquery();runEffect();',
            'update' => '#remicoes',
            'method' => 'POST',
            'async' => true,
            'dataExpression' => true,
            'title' => 'Novo',
            'class' => 'btn btn-default',
            'escape' => false
        ));
        echo $this->Js->writeBuffer();
        ?>
    </span>
</div>
