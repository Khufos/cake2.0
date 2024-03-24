<div class="usuarios form">
    <?php echo $this->Form->create('Usuario');?>
    <fieldset>
        <legend><?php __('Trocar Senha');?></legend>
        <table>
            <tr>
                <td>
                    <span class="esquerda">Perfil(is):</span>
                </td>
                <td>
                    <?php echo $this->Form->text('perfil_id',array('disabled'=>true,'value'=>$perfis));?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="esquerda">Nome:</span>
                </td>
                <td>
                    <?php echo $this->Form->text('nome',array('value'=>$nome,'disabled'=>true,'style'=>'width:400px'));?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="esquerda">Login:</span>
                </td>
                <td>
                    <?php echo $this->Form->text('login',array('value'=>$login,'disabled'=>true,'style'=>'width:200px'));?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="esquerda">Nova Senha:</span>
                </td>
                <td>
                    <?php echo $this->Form->text('senha1',array('maxLength'=>10,'type'=>'password'));?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="esquerda">Confirmar Senha:</span>
                </td>
                <td>
                    <?php echo $this->Form->text('senha',array('maxLength'=>10,'type'=>'password','OnChange'=>'comparaCampos(\'UsuarioSenha\',\'UsuarioSenha1\',\'Senhas Diferentes\')'));?>
                </td>
            </tr>
            <?php echo $this->Form->text('id',array('value'=>$id,'type'=>'hidden'));?>
            <tr>
                <td colspan=2>
                    <?php
                    $camposLi="resUsuario";
                    echo $ajax->submit('Alterar',
                    array(
                    'class'=>'direita',
                    'loading'=>'lc.start(request)',
                    'complete'=>'lc.stop(request)',
                    'before'=>"limpaCampos('".$camposLi."');",
                    'id' =>'alterar',
                    'url'=>array('action'=>'trocar_senha'),
                    'update'=>'resUsuario',
                    'frequency' => 1)
                    );
                    ?>
                </td>
            </tr>
        </table>
        <div id="resUsuario"> </div>
    </fieldset>
</div>
<!--<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('action' => 'index'));?></li>
	</ul>
</div>-->
