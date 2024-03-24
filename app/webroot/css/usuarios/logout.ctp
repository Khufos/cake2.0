<div class="usuarios form">
<?php echo $this->Form->create('Usuario');?>
	<fieldset>
 		<legend><?php __('Add Usuario');?></legend>
	<?php
		echo $this->Form->input('Id');
		echo $this->Form->select('perfil_id',$perfis);
		echo $this->Form->input('login');
		echo $this->Form->input('senha');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('action' => 'index'));?></li>
	</ul>
</div>
