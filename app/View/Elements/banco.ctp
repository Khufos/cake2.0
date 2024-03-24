<style>
    .select2 {
        width:100%!important;
    }
</style>
<div class="panel panel-default">
    <div class="panel-body">

		<div id="containerAddBanco">
			<div class="row">
				<div class="col-xs-6 col-md-4">
					<div class="form-group">
						<label>Banco:</label>

						<?php echo $this->Form->select('ConsBancoServicoContratado.0.banco_id', $bancos, array('empty' => 'Selecione', 'class' => 'form-control input-sm')); ?>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 ">
					<div class="form-group">
						<label>Serviço Contratado:</label>
						<?php echo $this->Form->select("ConsBancoServicoContratado.0.servico_contratado_id", $servicoContratados, array('class' => 'form-control input-sm', 'multiple'=>'multiple')); ?>
					</div>
				</div>
			</div>

		</div>

		<hr/>
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-default" id="addBanco" href="#">
					<i class="fa fa-plus"></i> Adicionar
				</a>
			</div>

		</div>
   </div>
</div>

<script id="banco-template" type="text/x-handlebars-template">
	<div class="row">
		<hr/>
		<div class="col-xs-6 col-md-4">
			<div class="form-group">
				<label>Nome:</label>

				<select name="data[ConsBancoServicoContratado][{{count}}][banco_id]" value="{{bancoId}}" class="form-control select-banco">
					<option>Selecione</option>
					<?php foreach ($bancos as $key => $seg): ?>
						<option value="<?= $key ?>"> <?= $seg ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="col-xs-6 col-md-4">
			<div class="form-group">
				<label>Serviço Contratado:</label>
				<select name="data[ConsBancoServicoContratado][{{count}}][servico_contratado_id][]" class="form-control select-banco" multiple="multiple">
					<option>Selecione</option>
					<?php foreach ($servicoContratados as $key => $seg): ?>
						<option value="<?= $key ?>"> <?= $seg ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="col-xs-2 col-md-1">
			<a class="btn btn-danger btn-remover-banco" href="#" title="Remover">
				<i class="fa fa-trash"></i>
			</a>
		</div>
	</div>
</script>

<?php //d($DadosConsumidor['ConsBancoServicoContratado']) ?>

<script type="text/javascript">
	$(function () {
		var banco=1;
		$('#addBanco').click(function (e) {
			e.preventDefault();
			var templateBanco = Handlebars.compile($('#banco-template').html());

			$('#containerAddBanco').append(templateBanco({
				count: banco++,
			}))

			$('.select-banco').select2();
		});

		$(document).on('click', '.btn-remover-banco', function (e) {
			var that = $(this);

			e.preventDefault();

			swal({
				title: 'Atenção!',
				text: "Tem certeza que deseja remover este banco da ação?",
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


		<?php if (isset($bancosSelecionados)): ?>
			var bancosSelecionados = <?= json_encode($bancosSelecionados) ?>;
			var servicosPorBanco = <?= json_encode($servicosPorBanco) ?>;


			var primeiroBanco = bancosSelecionados[0];
			$($('#containerAddBanco .row:first select')[0]).val(primeiroBanco).trigger('change');
			$($('#containerAddBanco .row:first select')[1]).val(servicosPorBanco[primeiroBanco]).trigger('change');

			for (var i=1; i<bancosSelecionados.length; i++) {
				$('#addBanco').click()

				var oBanco = bancosSelecionados[i];
				var selectBanco = $($('#containerAddBanco .row')[i]).find('select')[0];
				var selectServicos = $($('#containerAddBanco .row')[i]).find('select')[1];

				$(selectBanco).val(oBanco).trigger('change');
				$(selectServicos).val(servicosPorBanco[oBanco]).trigger('change');
			}

		<?php endif; ?>
	});
</script>

