<?php 	
	echo $this->Form->hidden('Informacoes.formulario_id', array('value' => $idForm));
	echo $this->Form->hidden('InformacoesRestritas.acao_id', array('value' => $ID_Acao));
	echo $this->Form->hidden('InformacoesRestritas.assistido_id', array('value' => $idAssistido));
	echo $this->Form->hidden('InformacoesRestritas.funcionario_id', array('value' => $idFunc));
?>



<div class="alert alert-warning alert-dismissible" role="alert" style="margin: 10px auto; position: inherit; width: auto; text-align: center;">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<strong>Atenção!</strong> Somente o usuário que registrou as informações poderá visualizar os lançamentos nesta aba.
</div>

<div class="form-group" id="cadInfoRest">
	<label for="desc_restrita">Informação Restrita</label>
	<?php echo $this->Form->textarea('InformacoesRestritas.descricao_restrita', array('rows'	=>	'3', 'class' => 'form-control', 'label'	=>	false, 'id'	=>	'desc_restrita',));?>
</div>

<?php echo $this->Form->button('Adicionar', array('id' => 'submitInfRest', 'type' => 'button', 'class' => 'btn btn-primary'));?>

<div id="lista_infor_restrita" style="margin-top: 15px">
	<table class="table table-bordered table-striped" id="lista_tabela">
		<caption><strong>INFORMAÇÃO REGISTRADA</strong></caption>    
		<thead>
			<tr>
				<th>Autor</th>
				<th>Ação vinculada</th>
				<th>Data de criação</th>
				<th>Data de Modificação</th>
				<th class="col-md-4">Descrição</th>
				<th>Ação</th>
			</tr>
		</thead>
		<tbody>
			<?php if(isset($inf_rstd)){
				foreach ($inf_rstd as $infor) :
					if($idFunc == $infor['func']['id']){ ?>
						<tr id="<?= $infor['inf']['id'] ?>">
							<td><?=$infor['ps']['nome'] ?></td>
							<td class="text-center">
								<?php if($infor['ac']['numero']){
										if($infor['inf']['acao_id'] == $ID_Acao){?>
											Ação Atual
											<?php							
												echo $this->Html->link(
													' <div class="glyphicon glyphicon-remove" style="font-size: 12px;"></div>',
													array(
														'controller' => 'informacoes_restritas',
														'action' => 'desvincular_acao',
														$infor['inf']['id']
													), array(
														'title' => 'Desvincular ação',
														'text-decoration ' => 'none',
														'target' => '_blank',
														'class' => 'link-modal',
														'data-target' => "#modal",
														'data-toggle' => "modal",
														'escape' => false
													)
												);
											?>
										<?php } else {?>
											<div class="text-center">
													<a href="/acoes/edit/<?=$infor['inf']['acao_id']?>" target="_blanck" title="Visualizar essa ação"><?php echo($infor['ac']['numero']);?></a>
													<?php							
													echo $this->Html->link(
														' <div class="glyphicon glyphicon-remove" style="font-size: 12px;"></div>',
														array(
															'controller' => 'informacoes_restritas',
															'action' => 'desvincular_acao',
															$infor['inf']['id']
														), array(
															'title' => 'Desvincular ação',
															'text-decoration ' => 'none',
															'target' => '_blank',
															'class' => 'link-modal',
															'data-target' => "#modal",
															'data-toggle' => "modal",
															'escape' => false
														)
													);
												?>
											</div>
										<?php } 
									}?>
							</td>
							<td><?= $this->Util->ddmmaaHis($infor['inf']['data_insert'])?></td>
							<td><?= $this->Util->ddmmaaHis($infor['inf']['data_alter'])?></td>						
							<td><?php echo utf8_decode($infor['inf']['descricao_restrita']) ?></td>
							<td class="text-center"><?php if($idFunc == $infor['func']['id']){?>
								<div class="text-center">
									<?php							
										echo $this->Html->link(
											'<div class="glyphicon glyphicon-edit"></div>',
											array(
												'controller' => 'informacoes_restritas',
												'action' => 'edit',
												$infor['inf']['id']
											), array(
												'title' => 'Editar Informação',
												'text-decoration ' => 'none',
												'target' => '_blank',
												'class' => 'link-modal',
												'data-target' => "#modal",
												'data-toggle' => "modal",
												'escape' => false,
												'id' => $infor['inf']['id']
											)
										);
									?>

									<?php							
										echo $this->Html->link(
											'<div class="glyphicon glyphicon-trash"></div>',
											array(
												'controller' => 'informacoes_restritas',
												'action' => 'delete',
												$infor['inf']['id']
											), array(
												'title' => 'Deletar Informação',
												'text-decoration ' => 'none',
												'target' => '_blank',
												'class' => 'link-modal',
												'data-target' => "#modal",
												'data-toggle' => "modal",
												'escape' => false
											)
										);
									?>
								</div>
								<?php }else{?>
									<div class="glyphicon glyphicon-ban-circle" title="Apenas o autor tem permissão para editar a informação."></div>
								<?php }?>
							</td>
						</tr>			
				<?php } endforeach;
			}?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		var divmodal = document.getElementById('gerenciar_modal');
        divmodal.classList.remove('modal-lg');

		$("#submitInfRest").click(function (event) {
			if(desc_restrita.value != ""){
				var formulario = $('#InformacoesFormularioId').val();
				var form = $("#"+formulario);
				$.ajax({
					type: "POST",
					url: window.location.origin + '/informacoes_restritas/add',
					data: form.serialize(),
					success: function () {                          
						alert("Informação Cadastrada com Sucesso!");
						desc_restrita.value ="";
						document.getElementById("infor_atend").style.display="none";
						document.getElementById("submitFormAcao").style.display="none";
						$("#lista_infor_restrita").load(window.location.href + " #lista_tabela" );                      
					}
				}); 
				event.preventDefault();
			}
			else{
				alert("Formulário em branco!! Por favor, Preencha o campo.")
			}
        });
    });
</script>