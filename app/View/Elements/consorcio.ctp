<div class="panel panel-default">    
    <div class="panel-body">
		<div id="containerAddConsorcio">
			<?php if(count($DadosConsumidor['ConsConsorcio']) == 0): ?>
				<div class="row">
					<div class="col-xs-6 col-md-3">
						<div class="form-group">
							<label>Nome:</label>
							<?php echo $this->Form->select('ConsConsorcio.0.consorcio_id', $consorcios, array('empty' => 'Selecione', 'class' => 'form-control input-sm')); ?>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="form-group">
							<label>Pedido revisional de cobrança:</label><br/>
							<?php
							echo $this->Form->radio('ConsConsorcio.0.pedido_revisional_cobranca', array(0 => 'Não', 1 => 'Sim'), array('legend' => false, 'separator' => '&nbsp;&nbsp;'));
							?>
						</div>
					</div>
				</div>
			<?php else: ?>
				<?php foreach ($DadosConsumidor['ConsConsorcio'] as $k => $data): ?>
					<div class="row">
						<?php if ($k > 0) echo "<hr/>" ?>
						<div class="col-xs-6 col-md-3">
							<div class="form-group">
								<label>Nome:</label>
								<?php echo $this->Form->select("ConsConsorcio.$k.consorcio_id", $consorcios, array('empty' => 'Selecione', 'class' => 'form-control input-sm', 'value' => $DadosConsumidor['ConsConsorcio'][$k]['consorcio_id'])); ?>
							</div>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="form-group">
								<label>Pedido revisional de cobrança:</label><br/>
								<?php
								echo $this->Form->radio("ConsConsorcio.$k.pedido_revisional_cobranca", array(0 => 'Não', 1 => 'Sim'), array('default' => $DadosConsumidor['ConsConsorcio'][$k]['pedido_revisional_cobranca'], 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
								?>
							</div>
						</div>
						<div class="col-xs-2 col-md-1">
							<a class="btn btn-danger btn-remover-consorcio" href="#" title="Remover">
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
				<a class="btn btn-default" id="addConsorcio" href="#">
					<i class="fa fa-plus"></i> Adicionar
				</a>
			</div>

		</div>
   </div>
</div>



<script id="consorcio-template" type="text/x-handlebars-template">
	<div class="row">
		<hr/>
		<div class="col-xs-6 col-md-3">
			<div class="form-group">
				<label>Nome:</label>

				<select name="data[ConsConsorcio][{{count}}][consorcio_id]" value="{{consorcioId}}" class="form-control select-consorcio">
					<option>Selecione</option>
					<?php foreach ($consorcios as $key => $seg): ?>
						<option value="<?= $key ?>"> <?= $seg ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-xs-6 col-md-4">
			<div class="form-group">
				<label>Pedido revisional de cobrança:</label><br>

				<input type="radio" name="data[ConsConsorcio][{{count}}][pedido_revisional_cobranca]" value="0">
				<label>Não</label>

				<input type="radio" name="data[ConsConsorcio][{{count}}][pedido_revisional_cobranca]" value="1">
				<label>Sim</label>
			</div>
		</div>
		<div class="col-xs-2 col-md-1">
			<a class="btn btn-danger btn-remover-consorcio" href="#" title="Remover">
				<i class="fa fa-trash"></i>
			</a>
		</div>
	</div>
</script>


<script type="text/javascript">
	$(function () {
		var consorcio = $('#containerAddConsorcio .row').length;
		$('#addConsorcio').click(function (e) {
			e.preventDefault();
			var templateConsorcio = Handlebars.compile($('#consorcio-template').html());

			$('#containerAddConsorcio').append(templateConsorcio({
				count: consorcio++,
			}))

			$('.select-consorcio').select2();
		});

		$(document).on('click', '.btn-remover-consorcio', function (e) {
			var that = $(this);

			e.preventDefault();

			swal({
				title: 'Atenção!',
				text: "Tem certeza que deseja remover este consórcio da ação?",
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

