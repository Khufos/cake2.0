<div class="panel panel-default">
    <div class="panel-body">
		<div id="containerAddInstituicao">
			<?php if(count($DadosConsumidor['ConsInstituicao']) == 0): ?>
				<div class="row">
					<div class="col-xs-6 col-md-3">
						<div class="form-group">
							<label>Nome:</label>
							<?php
							echo $this->Form->select('ConsInstituicao.0.instituicao_id',$instituicoes, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
							?>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="form-group">
							<label>Pedido revisional de cobrança:</label><br/>
							<?php
							echo $this->Form->radio('ConsInstituicao.0.pedido_revisional_cobranca', array(0 => 'Não', 1 => 'Sim'), array('legend' => false, 'separator' => '&nbsp;&nbsp;'));
							?>
						</div>
					</div>
				</div>

			<?php else: ?>
				<?php foreach ($DadosConsumidor['ConsInstituicao'] as $k => $data): ?>
					<div class="row">
						<?php if ($k > 0) echo "<hr/>" ?>
						<div class="col-xs-6 col-md-3">
							<div class="form-group">
								<label>Nome:</label>

								<?php
								echo $this->Form->select("ConsInstituicao.$k.instituicao_id",$instituicoes, array('empty' => 'Selecione', 'class' => 'form-control input-sm', 'value' => $DadosConsumidor['ConsInstituicao'][$k]['instituicao_id']));
								?>
							</div>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="form-group">
								<label>Pedido revisional de cobrança:</label><br/>
								<?php
								echo $this->Form->radio("ConsInstituicao.$k.pedido_revisional_cobranca", array(0 => 'Não', 1 => 'Sim'), array('default' => $DadosConsumidor['ConsInstituicao'][$k]['pedido_revisional_cobranca'], 'legend' => false, 'separator' => '&nbsp;&nbsp;'));
								?>
							</div>
						</div>
						<div class="col-xs-2 col-md-1">
							<a class="btn btn-danger btn-remover-instituicao" href="#" title="Remover">
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
                <a class="btn btn-default" id="addInstituicao" href="#">
                    <i class="fa fa-plus"></i> Adicionar
                </a>
            </div>
        </div>

   </div>
</div>

<script id="instituicao-template" type="text/x-handlebars-template">
    <div class="row">
        <hr/>
        <div class="col-xs-6 col-md-3">
            <div class="form-group">
                <label>Nome:</label>

                <select name="data[ConsInstituicao][{{count}}][instituicao_id]" value="{{instituicaoId}}" class="form-control select-instituicao">
                    <option>Selecione</option>
                    <?php foreach ($instituicoes as $key => $seg): ?>
                        <option value="<?= $key ?>"> <?= $seg ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-md-4">
            <div class="form-group">
                <label>Pedido revisional de cobrança:</label><br>

                <input type="radio" name="data[ConsInstituicao][{{count}}][pedido_revisional_cobranca]" value="0">
                <label>Não</label>

                <input type="radio" name="data[ConsInstituicao][{{count}}][pedido_revisional_cobranca]" value="1">
                <label>Sim</label>
            </div>
        </div>
        <div class="col-xs-2 col-md-1">
            <a class="btn btn-danger btn-remover-instituicao" href="#" title="Remover">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</script>


<script type="text/javascript">
    $(function () {
        var instituicoes = $('#containerAddInstituicao .row').length;;
        $('#addInstituicao').click(function (e) {
            e.preventDefault();
            var templateInstituicoes = Handlebars.compile($('#instituicao-template').html());

            $('#containerAddInstituicao').append(templateInstituicoes({
                count: instituicoes++,
            }))

            $('.select-instituicao').select2();
        });

        $(document).on('click', '.btn-remover-instituicao', function (e) {
            var that = $(this);

            e.preventDefault();

            swal({
                title: 'Atenção!',
                text: "Tem certeza que deseja remover esta faculdade da ação?",
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



