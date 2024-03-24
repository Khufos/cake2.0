<div class="panel panel-default">
    <div class="panel-body">

		<div id="containerAddSeguradoras">
			<?php if(count($DadosConsumidor['ConsSeguradora']) == 0): ?>
				<div class="row">
					<div class="col-xs-6 col-md-3">
						<div class="form-group">
							<label>Nome:</label>
							<?php echo $this->Form->select('ConsSeguradora.0.seguradora_id', $seguradoras, array('empty' => 'Selecione', 'class' => 'form-control input-sm')); ?>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="form-group">
							<label>Pedido revisional de cobrança:</label><br/>
							<?php
							echo $this->Form->radio('ConsSeguradora.0.pedido_revisional_cobranca', array(0 => 'Não', 1 => 'Sim'), array('legend' => false, 'separator' => '&nbsp;&nbsp;'));
							?>
						</div>
					</div>
				</div>

			<?php else: ?>
				<?php foreach ($DadosConsumidor['ConsSeguradora'] as $k => $data): ?>
					<div class="row">
						<?php if ($k > 0) echo "<hr/>" ?>
						<div class="col-xs-6 col-md-3">
							<div class="form-group">
								<label>Nome:</label>

								<?php $seguradoraID = $DadosConsumidor['ConsSeguradora'][$k]['seguradora_id']; ?>

								<?php echo $this->Form->select("ConsSeguradora.$k.seguradora_id", $seguradoras, array('empty' => 'Selecione', 'class' => 'form-control input-sm', 'value' => $seguradoraID)); ?>
							</div>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="form-group">
								<label>Pedido revisional de cobrança:</label><br/>
								<?php
								echo $this->Form->radio("ConsSeguradora.$k.pedido_revisional_cobranca", array(0 => 'Não', 1 => 'Sim'), array('default' => $DadosConsumidor['ConsSeguradora'][$k]['pedido_revisional_cobranca'], 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
								?>
							</div>
						</div>		
						<div class="col-xs-2 col-md-1">
							<a class="btn btn-danger btn-remover-seguradora" href="#" title="Remover">
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
				<a class="btn btn-default" id="addSeguradora" href="#">
					<i class="fa fa-plus"></i> Adicionar
				</a>
			</div>

		</div>
   </div>
</div>


<script id="seguradora-template" type="text/x-handlebars-template">
	<div class="row">
		<hr/>
		<div class="col-xs-6 col-md-3">
			<div class="form-group">
				<label>Nome:</label>

				<select name="data[ConsSeguradora][{{count}}][seguradora_id]" value="{{seguradoraId}}" class="form-control select-seguradora">
					<option>Selecione</option>
					<?php foreach ($seguradoras as $key => $seg): ?>
						<option value="<?= $key ?>"> <?= $seg ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-xs-6 col-md-4">
			<div class="form-group">
				<label>Pedido revisional de cobrança:</label><br>

				<input type="radio" name="data[ConsSeguradora][{{count}}][pedido_revisional_cobranca]" value="0">
				<label>Não</label>

				<input type="radio" name="data[ConsSeguradora][{{count}}][pedido_revisional_cobranca]" value="1">
				<label>Sim</label>
			</div>
		</div>
		<div class="col-xs-2 col-md-1">
			<a class="btn btn-danger btn-remover-seguradora" href="#" title="Remover">
				<i class="fa fa-trash"></i>
			</a>
		</div>
	</div>
</script>


<script type="text/javascript">
	$(function () {
		var seguradoras = $('#containerAddSeguradoras .row').length;

		$('#addSeguradora').click(function (e) {
			e.preventDefault();
			var templateSeguradoras = Handlebars.compile($('#seguradora-template').html());

			$('#containerAddSeguradoras').append(templateSeguradoras({
				count: seguradoras++,
			}))

			$('.select-seguradora').select2();
		});

		$(document).on('click', '.btn-remover-seguradora', function (e) {
			var that = $(this);

			e.preventDefault();

			swal({
				title: 'Atenção!',
				text: "Tem certeza que deseja remover esta seguradora da ação?",
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

