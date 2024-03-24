<script type="text/javascript">
    jQuery( "#UsuarioLogin" ).focus();
</script>
<?php echo $this->Form->create("Usuario", array("action" => 'login', "id" => 'formLogin')); ?>
<div align="center">
    <table width="400" border="1" align="center" cellpadding="0" cellspacing="3" class="login">
        <tr>
            <td><span class="label">Usuário</span></td>
            <td><?php echo $this->Form->input("login", array("style" => "width:150", "label" => false)) ?></td>
        </tr>
        <tr>
            <td>
                <span class="label">Senha</span>
            <td><?php echo $this->Form->input("senha", array("style" => "width:100", "label" => false, "type" => 'password')) ?></td>
            </td>            
        </tr>        
        <tr>
            <td align="right"><?php echo $this->Html->image("logo/cadeadoLogin.jpg", array("border" => 0)) ?></td>
        </tr>
        <tr>
            <td align="center"><?php echo $this->Form->button('Autenticar', array("id" => 'btnAutenticar', "type" => 'button', "class" => 'uiButton')); ?></td>
        </tr>        
    </table>
</div>
<?php echo $this->Form->end() ?>  
