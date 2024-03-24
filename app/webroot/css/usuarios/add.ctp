<div class="pessoas form">
    <?php echo $this->Form->create('Pessoa');?>
    <fieldset>
        <legend>
            <?php __('Cadastro Usuário');?>
        </legend>
        <table>
            <tr>
                <td align="right">

                    <span class="direita"> Nome:</span>
                </td>
                <td>
                    <?php echo $this->Form->text('nome',array('maxLength'=>100,'style'=>'width:300px')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="direita"> Email:</span>
                </td>
                <td>
                    <?php echo $this->Form->text('Contato.email',array('maxLength'=>100,'style'=>'width:300px')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="direita">Perfil:</span>
                </td>
                <td>
                    <?php
                    echo $this->Form->select(
                    'Usuario.perfil_id',$perfis,'','',
                    "Selecione"
                    );
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <?php
                    echo $ajax->submit('Salvar',
                    array(
                    'class'=>'direita',
                    'loading'=>'lc.start(request)',
                    'complete'=>'lc.stop(request)',
                    'id' =>'salvar',
                    'url'=>array('controller'=>'usuarios','action'=>'add'),
                    'update'=>'resUsuario',
                    'frequency' => 1)
                    );
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <div id=resUsuario></div>
                </td>
            </tr>
        </table>
    </fieldset>
</div>
<!--<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Pessoas', true), array('action' => 'index'));?></li>
	</ul>
</div>-->
