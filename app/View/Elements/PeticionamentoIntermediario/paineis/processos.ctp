<div id="PainelProcesso" class="custom-panel">
    <div class="header-panel">
        <span><i onclick="expandirPainel('#PainelProcesso');" class="fa fa-caret-down"></i><span id="NumeracaoUnicaLabel" class="header-panel-label">Número do processo:</span></span>
        <i class="fa fa-clipboard" id="btnCopiarProcesso" title="Copiar Processo" style="font-size: medium; padding-left: 8px;"></i>
    </div>
    <div class="well">
        <?php echo $this->element('PeticionamentoIntermediario/processos/campos'); ?>
    </div>
</div>