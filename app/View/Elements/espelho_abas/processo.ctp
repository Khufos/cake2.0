<?php
$idProcesso = $this->Util->setaValorPadrao($processo['id'], 0);
if ($idProcesso > 0) {
    ?>
    <span class="label esquerda" id='editProcesso'title="Consulta Processual TJ">
        <?php
        $this->Util->setaValorPadrao($processo['sequencial'], '');

        $sequencial = '';
        if (!empty($processo['sequencial'])) {
            $sequencial = ' - ' . $processo['sequencial'];
        }


        $nomeProcesso = "[" . $processo['numeracao_antiga'] . "] - [" . $processo['numeracao_unica'] . $sequencial . "] / [" . $processo['numeracao_anterior'] . "]";
        echo $this->Html->link($nomeProcesso, array(
            "controller" => "processos",
            "action" => "buscaProcessoTj/$idProcesso"
                ), array(
            "class" => "button",
            "target" => "_blank"
        ));
        ?>
    </span>

    <?php
    if (!isset($edit))
        $edit = true;

    if ($edit) {
        ?>
        <span class="esquerda">
            <?php
            echo $this->Html->link($this->Html->div('glyphicon glyphicon-edit', ''), array(
                'controller' => 'processos',
                'action' => "editarNumeracao/$idProcesso/$divNumeracao?trs=1"), array(
                'class' => 'link-modal btn btn-default',
                'data-target' => "#modal",
                'data-toggle' => "modal",
                'title' => 'Editar Numeração do processo',
                'escape' => false
            ));
            ?>
        </span> 
        <?php
    }
} else {// verificacao id do processo
    ?>
    <span class="label">ND</span>
    <?php
}
?>
