<script type="text/javascript">
    $(document).ready(function () {
        printHistoricoAtendimento();
        $('.historicoCasos').click(function () { // exibe tabela de supensão       
            $('#tableHistoricoCasos').slideToggle('slow');
        });

        $('#Imprimir').click(function () {
            var checado = false;
            $(".printHistorico tr").find(".cbAcao").each(function (index) {
                if ($(this).is(':checked'))
                    checado = true;

            });

            if (!checado) {
                alert("Deve ser selecionado uma ação");
                return false;
            }
        });
    });
</script>
<?php // debug($historicos);
if (!empty($historicos)) { // Existir histórico
    echo $this->Form->create('acaoHistorico', array('id' => 'formAcaoHistorico', "action" => 'imprimir', "target" => '_blank'));
    ?>   
    <h4>Histórico de manipulação da especializada</h4>
    <div class="well">     

        <h3> <?php $this->Util->setaValorPadrao($numero) ?></h3>
        <div class="scroll-area">
            <table class="table historico printHistorico" id="tableHistoricoCasos">   
                <tr>
                    <th><?php echo $this->Form->checkbox('check', array("class" => 'checked', 'hiddenField' => false)); ?></th>
                    <th with="150px">DEFENSOR/SERVIDOR</th>
                    <th>OBSERVA&Ccedil;&Atilde;O</th>
                    <th>ORIENTAÇÃO SOCIAL</th>
                    <th>ORIENTAÇÃO JURÍDICA</th>
                    <th>DATA</th>
                    <th>EDITAR</th>
                </tr>
                <?php
                $i = 0;
                $key = 0;
//                debug($historicos);
                foreach ($historicos as $historico):
                    ?>
                    <tr>
                        <td align="justify"><?php echo $this->Form->checkbox('id' . $i, array('hiddenField' => false, "value" => $historico['AcaoHistorico']['id'], "name" => 'data[AcaoHistorico][id][]', 'class' => 'validade[required] cbAcao')); ?></td>
                        <td align="justify"><?php echo trim($historico['Pessoa']['nome']); ?></td>
                        <td class="content" style="text-align: justify;"><?php echo nl2br(wordwrap($historico['AcaoHistorico']['observacao'], 73, ' ', true)); ?></td>
                        <td class="social" style="text-align: justify;"><?php echo nl2br(wordwrap($historico['AcaoHistorico']['orientacao_social'], 73, ' ', true)); ?></td>
                        <td class="juridica" style="text-align: justify;"><?php echo nl2br(wordwrap($historico['AcaoHistorico']['orientacao_juridica'], 73, ' ', true)); ?></td>
                        <td><?php echo $this->Util->aammddHis($historico['AcaoHistorico']['data']); ?></td>
                        <td>
                            <?php
                            if ($idFunc == $historico['AcaoHistorico']['funcionario_id']) {
                                if (!empty($fromHistoricoAgendamento)) {
                                    if ($idAcao) {
                                        echo $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), array(
                                            'controller' => 'acoes',
                                            'action' => 'edit', $historico['AcaoHistorico']['acao_id']
                                                ), array(
                                            'escape' => false,
                                            'target' => '_blank',
                                            "id" => $historico['AcaoHistorico']['id'])
                                        );
                                    } else if ($idConciliacao) {
                                        echo $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), array(
                                            'controller' => 'conciliacoes',
                                            'action' => 'edit', $historico['AcaoHistorico']['conciliacao_id']
                                                ), array(
                                            'escape' => false,
                                            'target' => '_blank',
                                            "id" => $historico['AcaoHistorico']['id'])
                                        );
                                    }
                                } else {
                                    echo ($idFunc == $historico['AcaoHistorico']['funcionario_id']) ? $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), "javascript: return false;", array('escape' => false, "id" => $historico['AcaoHistorico']['id'])) : "-";
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $key++;
                endforeach;
                ?>
            </table>
        </div>
        <div style="float: left;">
            <label>
                <span class="label_bold">Exibir Defensor/Servidor na impressão?</span>&nbsp;
            </label>
            <?php
            echo $this->Form->radio('AcaoHistorico.exibe_func', array(1 => 'Sim', 0 => 'Não'), array('default' => 0, 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
            ?>
        </div>
        <div style="float: right;">
            <?php echo $this->Form->input('AcaoHistorico.assistido_id', array('type' => 'hidden', 'value' => key($assistido))); ?>
            <?php
            echo $this->Form->submit('Imprimir', array(
                'id' => 'Imprimir',
                'class' => 'btn btn-default marginbottom10'));
            echo $this->Form->end();
            ?>
        </div>
        <div class="clearfix"></div>
    </div> 
<?php } ?>