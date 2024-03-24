<?php if($retorno) { ?>
<script type="text/javascript">
    alert("<?php echo $msg?>");

</script>
 <?php } ?>
<?php echo $this->Form->create('Usuario',array('action'=>'index','id'=>'formUsuario'))?>
<fieldset>
    <legend>Usuários</legend>
    <p>
        <?php
        echo $this->Paginator->counter(array(
        'format' => __('Página %page% de %pages%, mostrando %current% em um total de %count% registros.', true)
        ));
        ?></p>
    <table>
        <tr>
            <td>
                <span class="label">Login:</span>
            </td>
            <td colspan='2'>
                <?php echo $this->Form->text('Pessoa.nome',array('class'=>'nome'))?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                // $camposLi="campos";
                echo $this->Form->end('Pesquisar');?>
            </td>
        </tr>
    </table>
    <div class="scroll_space">
        <table  class="grid cabecalhoRel" cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo 'Id';?></th>                
                <th><?php echo 'Login';?></th>
                <th><?php echo 'Nome';?></th>
                <th><?php echo 'Acesso';?></th>
                <th><?php echo 'Situação';?></th>
                <th class="actions"><?php __('Actions');?></th>
            </tr>
        </table>
    </div>
    <div class="scroll">
        <table class="grid">
            <?php
            $i = 0;
            $key = 0;
            FireCake::info($usuarios[0],"usuarios");
            foreach ($usuarios as $usuario):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
				if($usuario['Usuario']['situacao_id'] == 2){
				$class_bloque = "desbloquear_usuario";
				$controller_action="bloqueaSenhaUsuario";
				$msg_title = "Desabilitar usuário";
				$situacaoUsuario ="Habilitado";
				$msg_alert ="Tem certeza que deseja desabilitar o usuário: ".$usuario['Pessoa'][0]['nome']." ?";
				}
				if($usuario['Usuario']['situacao_id'] == 46){
			
				$class_bloque = "bloquear_usuario";
				$controller_action="bloqueaSenhaUsuario";
				$msg_title = "Habilitar usuário";
				$situacaoUsuario ="Desabilitado";
				$msg_alert ="Tem certeza que deseja habilitar o usuário: ".$usuario['Pessoa'][0]['nome']." ?";
				}
				
                ?>
            <tr <?php echo $class;?> >
                <td>
                    <span class="label">
                            <?php echo $usuario['Usuario']['id']; ?>
                    </span>
                </td>                
                <td>
                    <span class="label">
                            <?php echo $usuario['Usuario']['login']; ?>
                    </span>
                </td>
                <td>
                    <span class="label">
                            <?php echo $usuario['Pessoa'][0]['nome']; ?>
                    </span>
                </td>
                <td>
                    <span class="label">
                            <?php
                            if($usuario['Usuario']['acesso'] == "0000-00-00 00:00:00") {
                                $dataDeAcesso = "Nunca logou";
                            }else {
                                $acesso = $usuario['Usuario']['acesso'];
                                $acesso = explode(" ",$acesso);
                                $dataDeAcesso = $util->ddmmaa($acesso[0])." ".$acesso[1];
                            }
                            echo $dataDeAcesso;
                            $key++;
                            ?>
                    </span>
                </td>
                <td>
                  <span class="label">
                <?php	echo $situacaoUsuario  ?>
                 </span>
                </td>
                <td class="actions">
                        <?php
                        echo $this->Html->link($this->Html->div('editar_usuario',''), array('controller'=>'usuarios','action' => 'edit', $usuario['Usuario']['id']),null,null,false);
                        echo $this->Html->link($this->Html->div('resetar_usuario','',array("title"=>'Resetar Senha')),array('controller'=>'usuarios','action' => 'resetaSenhaUsuario', $usuario['Usuario']['id']),array('confirm'=>'Tem certeza que deseja resetar a senha deste usuário?'),null,false);
                    	echo $this->Html->link($this->Html->div($class_bloque,'',array("title"=>$msg_title)), array('controller'=>'usuarios','action' => $controller_action, $usuario['Usuario']['id']),array('confirm'=>$msg_alert),null,false);
                       
                        ?>
                </td>

            </tr>
            <div id="res">
            </div>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="listagem">
        <?php //echo $this->Html->link($this->Html->div('novo_usuario',''), array('action' => 'add'),null,null,false); ?>
    </div>
    <div class="paging">
        <br>
        <?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
        | 	<?php echo $this->Paginator->numbers();?>
        <?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</fieldset>
