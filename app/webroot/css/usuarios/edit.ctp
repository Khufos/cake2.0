<fieldset>
    <legend><?php __('Editar Usuario');?></legend>
    <?php echo $this->Form->create('Usuario');?>
    <?php echo $this->Form->input('id'); ?>
    <table>
        <tr>
            <td>
                Nome:
            </td>
            <td>
                <?php echo $this->Form->text('nome',array('value'=>$nome,'disabled' =>true));?>
            </td>
        </tr>
        <tr>
            <td class="direita">
                Perfil:
            </td>
            <td>
                <?php
                //FireCake::info($perfisUsuario,"perfisUsuario");
                echo $this->Form->select('PerfisUsuario.perfil_id',$perfis,$perfisUsuario,array('multiple'=>'multiple'));?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="direita">
                <?php
                    echo $ajax->submit('Relacionar',
                    array(
                    'class'=>'direita',
                    'before'=>'limpaCampos(\'res\')',
                    'loading'=>'lc.start(request)',
                    'complete'=>'lc.stop(request)',
                    'id' =>'relacionar',
                    'url'=>array('controller'=>'perfis_usuarios','action'=>'add?trs=1'),
                    'update'=>'res',
                    'frequency' => 1)
                    );
                ?>
                </span>
            </td>
        </tr>
    </table>
    <div id="res"></div>
    <BR>
    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Usuario.id')), null, sprintf(__('Tem certeza que deseja excluir o registro %s?', true), $this->Form->value('Usuario.id'))); ?>
    <BR>
    <?php echo $this->Html->link(__('Listar Usuários', true), array('action' => 'index'));?>
</fieldset>

