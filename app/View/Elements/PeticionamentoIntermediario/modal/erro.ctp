<?php
/**
 * @param string $id
 * @param string $titulo
 * @param string $corpo
 * @param string $botaoUnico
 * @param string $botaoUnicoAcao
 */
?>

<div id="<?php echo $id; ?>" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <div style="padding: 10px; color: #fff; background-color: #cd0000">
                    <h4 class="modal-title" style="font-size: medium;">
                        <?php echo $titulo ?>
                    </h4>
                </div>                
            </div>
            <div class="modal-body" style="background: #fff">
                <?php echo $corpo; ?>
            </div>
            <div class="modal-footer" style="padding: 5px">
                <div style="background-color: #e1e1e1">
                    <button id="botaoUnico" type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                        <?php echo $botaoUnico ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.querySelector("#<?php echo $id; ?> #botaoUnico").addEventListener('click', (ev) => <?php echo $botaoUnicoAcao ?: 'false'; ?>);
</script>