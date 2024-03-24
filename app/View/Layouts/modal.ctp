<div id="loading" style="display: none;" class="ui-corner-all">
    <div id="innerLoading">
        Processando...
        <?php echo $this->Html->image('ajaxBarGreen.gif'); ?>
    </div>
</div>        
<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo __($titulo) ?></h4>
    </div>
    <div class="modal-body">
        <?php echo $this->fetch('content'); ?>
    </div>	
    <div class="modal-footer">
        <?php echo $this->fetch('button'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="FecharModal">Fechar</button>
    </div>	
</div>

