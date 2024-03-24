<style>
	.select2 {
		width:100%!important;
	}
</style>
<div class="panel panel-default">
    <div class="panel-body">

		<div id="containerAddPlanoSaude">

			<?php if(count($DadosConsumidor['ConsPlanoSaude']) == 0): ?>
				<div class="row">
					<div class="col-xs-6 col-md-4">
						<div class="form-group">
							<label>Plano:</label>
							<?php echo $this->Form->select("ConsPlanoSaude.0.plano_saude_id", $planoSaudes, array('empty' => 'Selecione', 'class' => 'form-control input-sm select-plano')); ?>
						</div>
					</div>

					<div class="col-xs-6 col-md-4">
						<div class="form-group">
							<label>Demandas:</label>
							<?php echo $this->Form->select("ConsPlanoSaude.0.demandas", $tipoDemandas, array('class' => 'form-control input-sm select-demandas', 'multiple'=>'multiple')); ?>
						</div>
					</div>

					<div class="col-xs-6 col-md-4 input-demanda input-consulta" style="display: none">
						<div class="form-group">
							<label>Consultas:</label>
							<?php echo $this->Form->select('ConsPlanoSaude.0.demanda_tipo_consulta', $tipoConsultas, array('class' => 'form-control input-sm consulta set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($consultaSel, null))); ?>
						</div>
					</div>

					<div class="col-xs-6 col-md-4 input-demanda input-exame" style="display: none">
						<div class="form-group">
							<label>Exames:</label>
							<?php echo $this->Form->select('ConsPlanoSaude.0.demanda_tipo_exame', $tipoExames, array('class' => 'form-control input-sm exame set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($exameSel, null))); ?>
						</div>
					</div>

					<div class="col-xs-6 col-md-4 input-demanda input-cirurgia" style="display: none">
						<div class="form-group">
							<label>Cirurgias:</label>
							<?php echo $this->Form->select('ConsPlanoSaude.0.demanda_tipo_cirurgia', $tipoCirurgias, array('class' => 'form-control input-sm cirurgia set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($tipoCirurSel, null))); ?>
						</div>
					</div>

					<div class="col-xs-6 col-md-4 input-demanda input-internamento"style="display: none">
						<div class="form-group">
							<label>Internamentos:</label>
							<?php
							echo $this->Form->select('ConsPlanoSaude.0.demanda_tipo_internamento', $tipoInternamentoHospitalar, array('class' => 'form-control input-sm internamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($interHospSel, null)));
							?>
						</div>
					</div>

					<div class="col-xs-6 col-md-4 input-demanda input-medicamento" style="display: none">
						<div class="form-group">
							<label>Medicamentos:</label>
							<?php echo $this->Form->select('ConsPlanoSaude.0.demanda_tipo_medicamento', $medicamentos, array('class' => 'form-control input-sm medicamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $medicamentoSel)); ?>
						</div>
					</div>
				</div>
			<?php else: ?>
				<?php for ($k=0; $k<count($demandasPorPlano); $k++): ?>
					<div class="row">
						<?php if ($k != 0 ): ?>
							<hr/>
						<?php endif; ?>




						<div class="col-xs-6 col-md-4">
							<div class="form-group">
								<label>Plano:</label>
								<?php echo $this->Form->select("ConsPlanoSaude.$k.plano_saude_id", $planoSaudes, array('empty' => 'Selecione', 'class' => 'form-control input-sm select-plano')); ?>
							</div>
						</div>

						<div class="col-xs-6 col-md-4">
							<div class="form-group">
								<label>Demandas:</label>
								<?php echo $this->Form->select("ConsPlanoSaude.$k.demandas", $tipoDemandas, array('class' => 'form-control input-sm select-demandas', 'multiple'=>'multiple')); ?>
							</div>
						</div>

						<div class="col-xs-6 col-md-4 input-demanda input-consulta" style="display: none">
							<div class="form-group">
								<label>Consultas:</label>
								<?php echo $this->Form->select("ConsPlanoSaude.$k.demanda_tipo_consulta", $tipoConsultas, array('class' => 'form-control input-sm consulta set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($consultaSel, null))); ?>
							</div>
						</div>

						<div class="col-xs-6 col-md-4 input-demanda input-exame" style="display: none">
							<div class="form-group">
								<label>Exames:</label>
								<?php echo $this->Form->select("ConsPlanoSaude.$k.demanda_tipo_exame", $tipoExames, array('class' => 'form-control input-sm exame set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($exameSel, null))); ?>
							</div>
						</div>

						<div class="col-xs-6 col-md-4 input-demanda input-cirurgia" style="display: none">
							<div class="form-group">
								<label>Cirurgias:</label>
								<?php echo $this->Form->select("ConsPlanoSaude.$k.demanda_tipo_cirurgia", $tipoCirurgias, array('class' => 'form-control input-sm cirurgia set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($tipoCirurSel, null))); ?>
							</div>
						</div>

						<div class="col-xs-6 col-md-4 input-demanda input-internamento"style="display: none">
							<div class="form-group">
								<label>Internamentos:</label>
								<?php
								echo $this->Form->select("ConsPlanoSaude.$k.demanda_tipo_internamento", $tipoInternamentoHospitalar, array('class' => 'form-control input-sm internamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($interHospSel, null)));
								?>
							</div>
						</div>

						<div class="col-xs-6 col-md-4 input-demanda input-medicamento" style="display: none">
							<div class="form-group">
								<label>Medicamentos:</label>
								<?php echo $this->Form->select("ConsPlanoSaude.$k.demanda_tipo_medicamento", $medicamentos, array('class' => 'form-control input-sm medicamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $medicamentoSel)); ?>
							</div>
						</div>

						<div class="col-md-12">
							<a class="btn btn-danger btn-remover-plano-saude pull-right" href="#" title="Remover">
								<i class="fa fa-trash"></i>
							</a>
						</div>
					</div>


				<?php endfor; ?>
			<?php endif; ?>


		</div>


<!--		<div class="row">-->
<!--			<div class="col-md-12">-->
<!--				<a href="/enfermidades/novaEnfermidade/-1/formSaude/EnfermidadesSaude/saudes?trs=1" class="btn btn-default" id="link-96211686" title="Novo"><div class="glyphicon glyphicon-plus-sign"></div></a>-->
<!--			</div>-->
<!--		</div>-->


		<hr/>
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-default" id="addPlanoSaude" href="#">
					<i class="fa fa-plus"></i> Adicionar
				</a>
			</div>

		</div>

   </div>
</div>




<script id="plano-saude-template" type="text/x-handlebars-template">
	<div class="row">
		<hr>
		<div class="col-xs-6 col-md-4">
			<div class="form-group">
				<label>Plano:</label>
				<?php echo $this->Form->select("ConsPlanoSaude.{{count}}.plano_saude_id", $planoSaudes, array('empty' => 'Selecione', 'class' => 'form-control input-sm select-plano')); ?>
			</div>
		</div>

		<div class="col-xs-6 col-md-4">
			<div class="form-group">
				<label>Demandas:</label>
				<?php echo $this->Form->select("ConsPlanoSaude.{{count}}.demandas", $tipoDemandas, array('class' => 'form-control input-sm select-demandas', 'multiple'=>'multiple')); ?>
			</div>
		</div>


		<div class="col-xs-6 col-md-4 input-demanda input-consulta" style="display: none">
			<div class="form-group">
				<label>Consultas:</label>
				<?php echo $this->Form->select('ConsPlanoSaude.{{count}}.demanda_tipo_consulta', $tipoConsultas, array('class' => 'form-control input-sm consulta set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($consultaSel, null))); ?>
			</div>
		</div>

		<div class="col-xs-6 col-md-4 input-demanda input-exame" style="display: none">
			<div class="form-group">
				<label>Exames:</label>
				<?php echo $this->Form->select('ConsPlanoSaude.{{count}}.demanda_tipo_exame', $tipoExames, array('class' => 'form-control input-sm exame set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($exameSel, null))); ?>
			</div>
		</div>

		<div class="col-xs-6 col-md-4 input-demanda input-cirurgia" style="display: none">
			<div class="form-group">
				<label>Cirurgias:</label>
				<?php echo $this->Form->select('ConsPlanoSaude.{{count}}.demanda_tipo_cirurgia', $tipoCirurgias, array('class' => 'form-control input-sm cirurgia set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($tipoCirurSel, null))); ?>
			</div>
		</div>

		<div class="col-xs-6 col-md-4 input-demanda input-internamento"style="display: none">
			<div class="form-group">
				<label>Internamentos:</label>
				<?php
				echo $this->Form->select('ConsPlanoSaude.{{count}}.demanda_tipo_internamento', $tipoInternamentoHospitalar, array('class' => 'form-control input-sm internamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $this->Util->setaValorPadrao($interHospSel, null)));
				?>
			</div>
		</div>

		<div class="col-xs-6 col-md-4 input-demanda input-medicamento" style="display: none">
			<div class="form-group">
				<label>Medicamentos:</label>
				<?php echo $this->Form->select('ConsPlanoSaude.{{count}}.demanda_tipo_medicamento', $medicamentos, array('class' => 'form-control input-sm medicamento set-width-multiselect', 'multiple'=>'multiple', 'value' => $medicamentoSel)); ?>
			</div>
		</div>

		<div class="col-md-12">
			<a class="btn btn-danger btn-remover-plano-saude pull-right" href="#" title="Remover">
				<i class="fa fa-trash"></i>
			</a>
		</div>
	</div>
</script>


<script type="text/javascript">
	$(document).ready(function () {

		$("#containerAddPlanoSaude select").select2();

		$(document).on('change', '.select-demandas', function () {

			// $('.input-demanda select').select2('val', "");
			$(this).closest('.row').find('.input-demanda').hide();

			var demandas = $(this).val();
			// console.log(demandas);
			var that = $(this);
			if (demandas != null) demandas.forEach(function (d) {
				console.log(that.parents('.row'));

				switch (d) {
					case '1': that.closest('.row').find('.input-cirurgia').show(); break;
					case '2': that.closest('.row').find('.input-consulta').show(); break;
					case '3': that.closest('.row').find('.input-exame').show(); break;
					case '4': that.closest('.row').find('.input-internamento').show(); break;
					case '5': that.closest('.row').find('.input-medicamento').show(); break;
				}
			});
		});

		<?php if (isset($demandasPorPlano)) : ?>
			var data = <?= json_encode($demandasPorPlano) ?>;
		<?php endif; ?>

		// Gzuis me perdoe por misturar php html e javascript dessa forma

		<?php if(isset($planosSelecionados)) foreach ($planosSelecionados as $k => $plano): ?>

			var row = $('#containerAddPlanoSaude .row')[<?= $k ?>];

			$(row).find('.select-plano').val(<?= $plano ?>).trigger('change');
			$(row).find('.select-demandas').val(data[<?= $plano ?>]['demandas_selecionadas']).trigger('change');

			<?php foreach ($demandasPorPlano[$plano]['demandas'] as $i => $dp): ?>
				var demandas = data[<?= $plano?>]['demandas'][<?= $i ?>];
				switch ('<?= $i ?>') {
					case '1': $(row).find('.cirurgia').val(demandas).trigger('change'); break;
					case '2': $(row).find('.consulta').val(demandas).trigger('change'); break;
					case '3': $(row).find('.exame').val(demandas).trigger('change'); break;
					case '4': $(row).find('.internamento').val(demandas).trigger('change'); break;
					case '5': $(row).find('.medicamento').val(demandas).trigger('change'); break;
				}
			<?php endforeach; ?>

		<?php endforeach; ?>

		var plano = $('#containerAddPlanoSaude .row').length;

		$('#addPlanoSaude').click(function (e) {
			e.preventDefault();
			var templatePlano = Handlebars.compile($('#plano-saude-template').html());

			$('#containerAddPlanoSaude').append(templatePlano({ count: plano++ }));

			$("#containerAddPlanoSaude select").select2();
		});

		$(document).on('click', '.btn-remover-plano-saude', function (e) {
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

