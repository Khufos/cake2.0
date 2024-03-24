<table border="0">
    <tr>
        <td style="padding-bottom:15px;">
            <span class="label direita">
                Pena:
            </span>
        </td>
        <td colspan=3 style="padding-bottom:15px;">
            <span class="esquerda">
                <?php echo $this->Form->text('Pena.ano_pena', array('style' => 'width:26px'), $anos); ?>
                <span class="label">Anos</span>
            </span>

            <span class="esquerda">
                <?php echo $this->Form->select('Pena.mes_pena', $meses); ?>
                <span class="label">Meses</span>
            </span>
            <span class="esquerda">
                <?php echo $this->Form->select('Pena.dia_pena', $dias); ?>
                <span class="label">Dias</span>
            </span>
        </td>
    </tr>
    <tr>
        <td style="padding-bottom:15px;">
            <span class="label direita">Interrupção Pena:</span>
        </td>
        <td colspan=3 style="padding-bottom:15px;">
            <span class="esquerda">
                <?php echo $this->Form->text('Pena.ano_interrupcao', array('style' => 'width:26px'), $anos); ?>
                <span class="label">Anos</span>
            </span>

            <span class="esquerda">
                <?php echo $this->Form->select('Pena.mes_interrupcao', $meses); ?>
                <span class="label">Meses</span>
            </span>
            <span class="esquerda">
                <?php echo $this->Form->select('Pena.dia_interrupcao', $dias); ?>
                <span class="label">Dias</span>
            </span>
        </td>
    </tr>
    <tr>
        <td style="padding-bottom:15px;">
            <span class="label direita">Remição:</span>
        </td>
        <td colspan=3 style="padding-bottom:15px;">
            <span class="esquerda">
                <?php echo $this->Form->text('Pena.ano_remissao', array('style' => 'width:26px'), $anos); ?>
                <span class="label">Anos</span>
            </span>

            <span class="esquerda">
                <?php echo $this->Form->select('Pena.mes_remissao', $meses); ?>
                <span class="label">Meses</span>
            </span>
            <span class="esquerda">
                <?php echo $this->Form->select('Pena.dia_remissao', $dias); ?>
                <span class="label">Dias</span>
            </span>
        </td>
    </tr>
    <tr>
        <td style="padding-bottom:15px;">
            <span class="label direita">Regime Pena:</span>
        </td>
        <td style="padding-bottom:15px;">
            <?php echo $this->Form->select('Pena.regime_id', $regimes); ?>
        </td>
    </tr>
    <tr>
        <td style="padding-bottom:15px;">
            <span class="direita">
                <span class="label">Data Progressão:</span>
            </span>
        </td>
        <td colspan=2 style="padding-bottom:15px;">
            <span class="esquerda">
                <?php echo $this->Form->text('Pena.data_progressao', array('class' => 'data')); ?>
            </span>

            <span class="direita">
                <span class="label">&nbsp Data Condicional:</span>
                <span>
                    <?php echo $this->Form->text('data_condicional', array('class' => 'data')); ?>
                </span>
            </span>
        </td>
    </tr>
    <tr>
        <td style="padding-bottom:15px;">
            <span class="label direita">Data Extinção:</span>
        </td>
        <td style="padding-bottom:15px;">
            <span>
                <?php echo $this->Form->text('Pena.data_extincao', array('class' => 'data')); ?>
            </span>
        </td>
    </tr>
</table>