<style>
  .selected, .selected:focus {
    background-color: #0075FF !important;
    color: white !important;
    border-color: #ccc !important;
  }
</style>

<div class="modal fade" id="modalPeticionamentoIntermediarioEditorTags" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
				<br>
				<h5 id="modalTitle" class="modal-title">
					Selecione a TAG que deseja adicionar
				</h5>
                <input type="hidden" id="origemModal" value="0" />
			</div>
			<div class="modal-body">

                <!-- TAG: Número do processo -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Número do processo'),
                                    array(
                                        'id' => 'btnTagNumProcesso',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Defensor -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Defensor'),
                                    array(
                                        'id' => 'btnTagDefensor',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Polo ativo -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Polo ativo'),
                                    array(
                                        'id' => 'btnTagPoloAtivo',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Polo passivo -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Polo passivo'),
                                    array(
                                        'id' => 'btnTagPoloPassivo',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Outros interessados -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Outros interessados'),
                                    array(
                                        'id' => 'btnTagOutrosInteressados',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Classe judicial -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Classe judicial'),
                                    array(
                                        'id' => 'btnTagClasseJudicial',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Assunto -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Assunto'),
                                    array(
                                        'id' => 'btnTagAssunto',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Comarca -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Comarca (jurisdição)'),
                                    array(
                                        'id' => 'btnTagComarca',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Autuacao -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Autuação'),
                                    array(
                                        'id' => 'btnTagAutuacao',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- TAG: Órgão julgador -->
                <div class="row" style="margin-bottom: 4px;">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            <?php echo $this->Form->button(
                                    $this->Html->div(null, 'Órgão julgador'),
                                    array(
                                        'id' => 'btnTagOrgaoJulgador',
                                        'class' => 'btn btn-default',
                                        'type' => 'button',
                                        'style' => 'width: 100%',
                                        'onclick' => 'selecionaNovaTag(this)'
                                    )
                            ); ?>
                        </div>
                    </div>
                </div>

			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnConfirmarTags" onclick="aplicarTags();">Confirmar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-left: 8px;">Cancelar</button>
			</div>
		</div>
	</div>
</div>
