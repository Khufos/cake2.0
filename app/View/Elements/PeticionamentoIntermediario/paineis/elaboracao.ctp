<div id="PainelElaboracao" class="custom-panel">
    <div class="header-panel">
        <span>
            <?php if($peticaoResumida): ?>
                <i class="fa fa-caret-right" style="cursor:none !important;"></i>
            <?php else: ?>
                <i onclick="expandirPainel('#PainelElaboracao');" class="fa fa-caret-down"></i>
            <?php endif; ?>
            <span class="header-panel-label">
                <?php 
                if($peticaoResumida){
                    echo "Número do processo: " . $numeroProcesso;
                }else{
                    echo "Elaborar petição / Anexar documentos";
                }
                ?>
            </span>
        </span>
    </div>
    <div class="well">

        <?php if($peticaoResumida): ?>
            <h3 style="margin-top:0px !important;">Elaborar petição / Anexar documentos</h3>
        <?php endif; ?>

        <h4>Editor de documentos</h4>
        <div class="row">
            <div class="col-md-12">
                <div id="editorDocumento"></div>
            </div>
        </div>

        <?php echo $this->element('PeticionamentoIntermediario/anexos/tabela', array('data' => null)); ?>

    </div>
</div>