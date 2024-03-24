<div id="tabExpedientes" class="principal pagina-autos scroll-y">
    <div class="container-fluid content">
        <div class="row">
            <div class="col-md-12">
                <h5 class="tab-titulo">Expedientes</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="container-fluid rich-panel">
                    <div class="row">
                        <div class="col-md-12 rich-panel-header">Partes</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <table class="expedientes-tabela">
                                <thead>
                                    <tr class="subthead">
                                        <th>Ato de comunicação</th>
                                        <th style="text-align: center !important;">Data limite prevista para ciência ou manifestação</th>
                                        <th style="text-align: center !important;">Documentos</th>
                                        <th style="text-align: center !important;">Fechado</th>
                                    </tr>
                                </thread>
                                <tfoot>
                                    <tr class="rich-table-footer"><td class="rich-table-footercell" colspan="4" scope="colgroup"></td></tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach($expedientes as $expediente): ?>
                                        <tr>

                                            <td class="text-left">

                                                <div class="container-fluid expedicao-item">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php echo utf8_encode($expediente["pje_aviso_pendentes"]["descricao_ato"]) . " (" . $expediente["pje_aviso_pendentes"]["id_aviso"] .  ")"; ?>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h6><?php echo utf8_encode($expediente["pje_aviso_pendentes"]["destinatario_pje"]); ?></h6>
                                                        </div>
                                                    </div>
                                                    <?php if(isset($expediente["processo"]["representante"]) && !empty($expediente["processo"]["representante"])): ?>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php echo "Representante: " . utf8_encode($expediente["processo"]["representante"]); ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php echo "Expedição eletrônica (" . $expediente["pje_aviso_pendentes"]["data_expedicao"] . ")"; ?>
                                                        </div>
                                                    </div>

                                                    <?php if(isset($expediente["movimentacoes"]) && isset($expediente["movimentacoes"]["ciencia_registrada"])): ?>
                                                        <div class="row">
                                                            <div class="col-md-12"><?=$expediente["movimentacoes"]["ciencia_registrada"] ?></div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="row">
                                                        <div class="col-md-12"><?="Prazo: " . $expediente["pje_aviso_pendentes"]["prazo"] . " dia(s)"?></div>
                                                    </div>

                                                </div>

                                            </td>

                                            <td class="text-center">

                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <h6><div class="col-md-12"><?=$expediente["pje_aviso_pendentes"]["data_limite"]?></div></h6>
                                                    </div>
                                                    <div class="row">
                                                        <h6><div class="col-md-12"><?=$expediente["pje_aviso_pendentes"]["mensagem_por_ciencia"]?></div></h6>
                                                    </div>
                                                </div>

                                            </td>

                                            <td class="text-center">
                                                <?php  $pje_aviso_pendentes= $expediente['pje_aviso_pendentes'];?> 
                                                <?php if(isset($expediente['movimentacao']['tipo_movimentacao_id']) && $expediente['movimentacao']['tipo_movimentacao_id'] == 1): ?>
                                                    <a target="_blank" title="Visualizar ato" class="btn btn-default btn-sm" 
                                                    onclick="visualExpediente(
                                                        '<?php echo $pje_aviso_pendentes['id_aviso']; ?>', 
                                                        null, false)">
                                                        <i class="fa fa-external-link" aria-hidden="true"></i> <span class="sr-only">Visualizar ato</span>
                                                    </a>
                                                <?php else: ?>
                                                    <div     
                                                                                                            
                                                        class="glyphicon glyphicon-search" 
                                                        style="cursor: pointer; background-color: red;color: white; padding: 2px 4px;" 
                                                        title="Tomar Ciência"
                                                        onclick="tomarCiencia(
                                                            '<?= $pje_aviso_pendentes['id']?>',
                                                            '<?= $pje_aviso_pendentes['processo_id']?>',
                                                            '<?= $pje_aviso_pendentes['atuacao_id']?>',
                                                            '<?= $pje_aviso_pendentes['id_aviso']?>',
                                                            '<?= $_SERVER['REQUEST_URI']?>'
                                                            )"></div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if ($expediente['pje_aviso_pendentes']['aviso_respondido'] == 0){
                                                        echo "NÃO";
                                                    } else{
                                                        echo "SIM";
                                                    }
                                                ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align: right !important;">
                            <?php echo $msgTotal; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>