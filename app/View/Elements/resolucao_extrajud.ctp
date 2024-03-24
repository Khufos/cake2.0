<div class="panel panel-default">
    <!--<div class="panel-heading">Liminar</div>-->
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 form-group">
                    <label>Forma Contato:</label>
                    <?php echo $this->Form->select("forma_contato_id", $formaContato, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>
            </div>
            <div class="col-md-3 form-group">
                    <label>Data Contato:</label>
                    <?php echo $this->Form->input("data_contato", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false)); ?>
            </div>
            <div class="col-md-3 form-group">
                    <label>Órgão Destinatário:</label>
                    <?php echo $this->Form->select("orgao_destinatario_id", $orgaoDest, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm')); ?>    
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Houve Resolução?</label>
                    <?php echo $this->Form->select("resolucao", $simNao, array('class' => 'nome form-control input-sm')); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Ação Proposta?</label>
                    <?php echo $this->Form->select("acao_proposta", $simNao, array('class' => 'nome form-control input-sm')); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-12">
                <div class="form-group">
                    <div id="ManifestacaoContent0">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>