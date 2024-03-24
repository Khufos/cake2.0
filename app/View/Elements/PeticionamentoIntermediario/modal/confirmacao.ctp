<?php
/**
 * @param string $id
 * @param string $titulo
 * @param string $corpo
 * @param string $botaoSucesso
 * @param string $botaoSucessoAcao
 * @param string $botaoFalha
 * @param string $botaoFalhaAcao
 */
?>

<div id="<?php echo $id; ?>" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <div style="padding: 10px; color: #fff; background-color: #419641">
                    <h4 class="modal-title" style="font-size: medium;">
                        <?php echo $titulo ?>
                    </h4>
                </div>                
            </div>
            <div class="modal-body" style="background: #fff">
                <?php echo $corpo; ?>
            </div>
            <div class="modal-footer" style="padding: 5px">
                <div style="padding: 6px; background-color: #e1e1e1">
                    <button id="botaoSucesso" type="button" class="btn btn-primary btn-sm" style="float:none">
                        <?php echo $botaoSucesso ?>
                    </button>
                    <button id="botaoFalha" type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                        <?php echo $botaoFalha ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.querySelector("#<?php echo $id; ?> #botaoSucesso").addEventListener('click', (ev) => <?php echo $botaoSucessoAcao ?: 'false'; ?>);
    document.querySelector("#<?php echo $id; ?> #botaoFalha").addEventListener('click', (ev) => <?php echo $botaoFalhaAcao ?: 'false'; ?>);
</script>