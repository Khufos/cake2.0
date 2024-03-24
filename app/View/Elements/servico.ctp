<div class="panel panel-default">
    <div class="panel-body">
		<div id="containerAddServicos">
			<?php if(count($DadosConsumidor['ConsServico']) == 0): ?>
				<div class="row">
					<div class="col-xs-6 col-md-3">
						<div class="form-group">
							<label>Nome:</label>

							<?php echo $this->Form->select("ConsServico.0.servico_id", $servicos, array('empty' => 'Selecione', 'class' => 'form-control input-sm')); ?>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="form-group">
							<label>Pedido revisional de cobrança:</label><br/>
							<?php
							echo $this->Form->radio('ConsServico.0.pedido_revisional_cobranca', array(0 => 'Não', 1 => 'Sim'), array('legend' => false, 'separator' => '&nbsp;&nbsp;'));
							?>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="form-group">
							<label>Interrupção de fornecimento:</label><br/>
							<?php
							echo $this->Form->radio('ConsServico.0.interrupcao_fornecimento', array(0 => 'Não', 1 => 'Sim'), array('legend' => false, 'separator' => '&nbsp;&nbsp;'));
							?>
						</div>
					</div>
				</div>
			<?php else: ?>
				<?php foreach ($DadosConsumidor['ConsServico'] as $k => $kira): ?>
					<div class="row">
						<?php if ($k > 0) echo "<hr/>" ?>

						<?php echo $this->Form->hidden("ConsServico.$k.id", ['value' => $DadosConsumidor['ConsServico'][$k]['id']]); ?>

						<div class="col-xs-6 col-md-3">
							<div class="form-group">
								<label>Nome:</label>

								<?php echo $this->Form->select("ConsServico.$k.servico_id", $servicos, array('empty' => 'Selecione', 'class' => 'form-control input-sm', 'value' => $DadosConsumidor['ConsServico'][$k]['servico_id'])); ?>
							</div>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="form-group">
								<label>Pedido revisional de cobrança:</label><br/>
								<?php
								echo $this->Form->radio("ConsServico.$k.pedido_revisional_cobranca", array(0 => 'Não', 1 => 'Sim'), array('legend' => false, 'separator' => '&nbsp;&nbsp;', 'value' => $DadosConsumidor['ConsServico'][$k]['pedido_revisional_cobranca']));
								?>
							</div>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="form-group">
								<label>Interrupção de fornecimento:</label><br/>
								<?php
								echo $this->Form->radio("ConsServico.$k.interrupcao_fornecimento", array(0 => 'Não', 1 => 'Sim'), array('legend' => false, 'separator' => '&nbsp;&nbsp;', 'value' => $DadosConsumidor['ConsServico'][$k]['interrupcao_fornecimento']));
								?>
							</div>
						</div>

						<div class="col-xs-2 col-md-1">
							<a class="btn btn-danger btn-remover-servico" href="#" title="Remover">
								<i class="fa fa-trash"></i>
							</a>
						</div>
					</div>

				<?php endforeach; ?>
			<?php endif; ?>

		</div>

		<hr/>
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-default" id="addServicos" href="#">
					<i class="fa fa-plus"></i> Adicionar
				</a>
			</div>

		</div>
   </div>
</div>



<script id="servico-template" type="text/x-handlebars-template">
	<div class="row">
		<hr/>
		<div class="col-xs-6 col-md-3">
			<div class="form-group">
				<label>Nome:</label>

				<select name="data[ConsServico][{{count}}][servico_id]" value="{{servicoId}}" class="form-control select-servico">
					<option>Selecione</option>
					<?php foreach ($servicos as $key => $seg): ?>
						<option value="<?= $key ?>"> <?= $seg ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-xs-6 col-md-4">
			<div class="form-group">
				<label>Pedido revisional de cobrança:</label><br>

				<input type="radio" name="data[ConsServico][{{count}}][pedido_revisional_cobranca]" value="0">
				<label>Não</label>

				<input type="radio" name="data[ConsServico][{{count}}][pedido_revisional_cobranca]" value="1">
				<label>Sim</label>
			</div>
		</div>
		<div class="col-xs-6 col-md-4">
			<div class="form-group">
				<label>Interrupção de fornecimento:</label><br>

				<input type="radio" name="data[ConsServico][{{count}}][interrupcao_fornecimento]" value="0">
				<label>Não</label>

				<input type="radio" name="data[ConsServico][{{count}}][interrupcao_fornecimento]" value="1">
				<label>Sim</label>
			</div>
		</div>
		<div class="col-xs-2 col-md-1">
			<a class="btn btn-danger btn-remover-servico" href="#" title="Remover">
				<i class="fa fa-trash"></i>
			</a>
		</div>
	</div>
</script>


<script type="text/javascript">
	$(function () {
		var servico = $('#containerAddServicos .row').length;
		$('#addServicos').click(function (e) {
			e.preventDefault();
			var templateServico = Handlebars.compile($('#servico-template').html());

			$('#containerAddServicos').append(templateServico({
				count: servico++,
			}))

			$('.select-servico').select2();
		});

		$(document).on('click', '.btn-remover-servico', function (e) {
			var that = $(this);

			e.preventDefault();

			swal({
				title: 'Atenção!',
				text: "Tem certeza que deseja remover este serviço da ação?",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#136938',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, remover!',
				cancelButtonText: 'Não, cancelar',
				reverseButtons: true,
			}).then((result) => {
				if (result.value) {
					that.parent().parent().remove();
				}
			});
		});
	});
</script>
