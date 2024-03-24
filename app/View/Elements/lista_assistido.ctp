<script type="text/javascript">
<?php
$idAgendamento = $this->Session->read('FilaSenha.agendamento');
$isDefensor = $this->Session->read('isDefensor');
$id_pessoa = $this->Session->read('Pessoa.id');
?>
    $(document).ready(function () {

        getAssistidosPresentesByDefensor(<?php echo $id_pessoa; ?>);

<?php if (!empty($idAgendamento)) { ?>
            //$("#<?php //echo $idAgendamento;          ?>" ).hide();
<?php } ?>

    });
    function atender(idAgendamento) {
        $.ajax({
            url: '<?php echo $this->webroot; ?>fila/fila_senhas/atenderSenhaAgendamento/' + idAgendamento + '/?trs=1',
            type: 'POST',
            success: function () {

            }
        });
        $.ajax({
            url: '<?php echo $this->webroot; ?>historicos/salvaHistoricoAtendido/' + idAgendamento + '/?trs=1',
            type: 'POST',
            success: function (data) {
                $('#alert_defensor').html(data);
                $("#" + idAgendamento).hide();
            }
        });
    }
    function cancelar(idAgendamento) {
        if (confirm('Deseja realmente cancelar este atendimento?')) {
            $.ajax({
                url: '<?php echo $this->webroot; ?>fila/fila_senhas/cancelarSenhaAgendamento/' + idAgendamento + '/?trs=1',
                type: 'POST',
                success: function () {

                }
            });
            $.ajax({
                url: '<?php echo $this->webroot; ?>historicos/salvaHistoricoCancelado/' + idAgendamento + '/?trs=1',
                type: 'POST',
                success: function (data) {
                    //$('#alert_defensor').html(data);
                    $("#" + idAgendamento).hide();
                    alert("Atendimento Cancelado!");
                    window.setTimeout('location.reload()', 3000);
                }
            });
        }
    }
    function chamarSenhaAgendamento(idAgendamento) {
        $.ajax({
            url: '<?php echo $this->webroot; ?>fila/fila_senhas/chamarSenhaAgendamento/' + idAgendamento + '/?trs=1',
            type: 'POST',
            success: function (data) {
                $("#resAtender").html(data);
            }
        });
    }

<?php
$this->Util->setaValorPadrao($verificaAssistidoPresente, false);
$this->Util->setaValorPadrao($tempo, 60000);
//$tempo = 30000;


$class[10] = "espera";
$class[24] = "remanejado";
$class[32] = "atendido";
$class[39] = "presente";
$class[40] = "ciente";
$class[43] = "cancelado";
$class['p'] = "plantao";

if (isset($isDefensor) && ($isDefensor)) {
    ?>
        window.setInterval("getAssistidosPresentesByDefensor(<?php echo $id_pessoa; ?>)", <?php echo $tempo; ?>);
<?php } ?>

</script>


<div id="lst_assistido_presente" style="padding: 5px;">
    <div class='col-md-12'>
        <legend>Agendamento(s)</legend>
        <table class="lst_assistido table table-bordered table-striped" id="lst_assistido">
            <tr>
                <th>Assistido</th>
                <!-- <th>Situação</th> -->
            </tr>
            <?php

            if (isset($lista) && !empty($lista)) {
                foreach ($lista as $key => $value) { // especializadas
                    $esp = $key;
                    $agendamentos = $value;
                    //asort($agendamentos);
                    //fb::info($agendamentos);
                    ?>
                    <tr class="listCaption">
                        <td align="center" colspan="3">
                            <?php echo $esp ?>
                        </td>
                    <tr>
                        <?php
                        foreach ($agendamentos as $k => $v) {
                            $idAgendamento = $k;
                            $assistido = $v['assistido'];
                            $classe = $class[$v['situacao']];
							$hora_agendada = $v['hora_agendada'];
                            $hora_chegada = $v['hora_chegada'];
							if (!empty($v['prioridade']))
							$priod = $v['prioridade'];
                            ?>
                        <tr>							
							
                            <td title="<?php echo $assistido; ?>">
								<?php if (!empty($v['prioridade'])) echo $priod; ?>
								<?php echo substr($assistido, 0, 100) . " ..." ?>
							<br/>							                               
								<b>Situação:</b> <?php echo $classe; ?><br>	
                                <b>Hora de presença:</b> <?php echo $hora_chegada; ?>
                                <br>							
								<b>Horário agendado:</b> <?php echo $hora_agendada; ?>
								<br>
                                <?php
                                $camposLi = "resProximo*PesquisaSenha";
                                if ($v['situacao'] == $idSitucaoCiente) { // so atende se estiver como ciente
                                    echo $this->Html->link($this->Html->div("glyphicon glyphicon-circle-arrow-right", ''), "javascript:void(0);", array('class' => 'icone-agendamento atender', 'id' => 'atender', 'onclick' => "javascript:atender($idAgendamento)", 'escape' => false, 'title' => 'ATENDER ASSISTIDO'));
                                    echo $this->Html->link($this->Html->div("glyphicon glyphicon-bullhorn", ''), "javascript:void(0);", array('class' => 'icone-agendamento chamar', 'id' => $idAgendamento, 'onclick' => "javascript:chamarSenhaAgendamento($idAgendamento)", 'escape' => false, 'title' => 'Chamar Assistido'));
                                    echo $this->Html->link($this->Html->div("glyphicon glyphicon-remove-circle", ''), "javascript:void(0);", array('class' => 'icone-agendamento cancelar', 'id' => $idAgendamento, 'onclick' => "javascript:cancelar($idAgendamento)", 'escape' => false, 'title' => 'Cancelar Atendimento'));
                                } else {
                                }
                                ?>
								
								

                            </td>
                            <!-- <td align="center" title="<?php echo $classe; ?>">
                                <div style="cursor: help; border:2px solid #CCCCCC;" class="situacaoAgen <?php echo $classe; ?>">
                                    &nbsp;
                                </div>
								Horário agendado: <?php echo $hora_agendada; ?>
                            </td> -->
                        </tr>

                        <?php
                    }
                }
            }
            ?>
        </table>

        <?php
        if (empty($lista)) {
            ?>
            <table class="lst_assistido table table-bordered table-striped" id="lst_sem_assistido">
                <tr>
                    <td colspan="2">Nenhum Assistido Presente.</td>
                </tr>
            </table>
            <?php
        }
        ?>
    </div>
</div>
<div id="resAtender" class="oculto"></div>
<div id="alert_defensor" class="alertDefensor">
    <?php echo $this->Form->hidden('Agendamento.hora_ultima_chamada'); ?>
</div>
