<?php
if (!empty($artigos)) { // se existir artigo
    $camposLi = "$idBlocoArtigo";
    $remote = $this->Js->request(
            array('action' => "buscaArtigosCondenacao/$idProcesso/true?trs=1"), array('update' => "#$idBlocoArtigo")
    );
    foreach ($artigos as $k => $v) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" style="clear:both;">
                Artigo
                <?php
                if ($remover) {
                    $idArtigo = $v['Artigo']['id'];
                    $artigo = $v['Artigo']['nome'];
                    echo $this->Js->link($this->Html->div('glyphicon glyphicon-remove-circle', '') . ' Remover', array(
                        'controller' => 'execucao_penais',
                        'action' => "apagar_artigo/$idArtigo?trs=1")
                            , array(
                        'update' => "#resArtigo",
                        'title' => 'Remover',
                        'class' => 'btn btn-default btn-sm',
                        'style' => 'float: right',
                        'complete' => "refreshJquery(); $remote",
                        'confirm' => "Tem Certeza que deseja apagar o artigo: '$artigo' ?",
                        'escape' => false
                    ));
                    
                    echo $this->Js->writeBuffer();
                }
                ?>
            </div>
            <table class="table table-bordered table-striped" id="<?php echo $idBlocoArtigo; ?>">

                <tr>
                    <td width="140px">
                        <span class="label_bold direita"> N&ordm; do Artigo / Lei:</span>
                    </td>
                    <td>
                        <?php
                        echo $v['Artigo']['nome'];
                        ?>
                        <label>Hediondo:</label>
                        <?php
                        $r = $v['Artigo']['hediondo'];
                        echo $this->Util->setaValorPadrao($simNao[$r]);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tipo de Crime:</label>
                    </td>
                    <td>
                        <?php
                        $tpCrime = $v['TipoCrime']['nome'];
                        ?>
                        <label title="<?php echo $tpCrime; ?>">
                            <?php
                            echo (strlen($tpCrime) > 50) ? substr($tpCrime, 0, 50) . '...' : $tpCrime;
                            ?>
                        </label>

                        <label>Reincidente espec&iacute;fico em crime hediondo:</label>
                        <?php
                        $r = $v['Artigo']['reincidente'];
                        echo $this->Util->setaValorPadrao($simNao[$r]);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Grave Ameaça:</label>
                    </td>
                    <td>
                        <?php
                        $ga = $v['Artigo']['grave_ameaca'];
                        echo $this->Util->setaValorPadrao($simNao[$ga]);
                        ?>
                        <label>Viol&ecirc;ncia a Pessoa :</label>
                        <?php
                        $vp = $v['Artigo']['violencia_pessoa'];
                        echo $this->Util->setaValorPadrao($simNao[$vp]);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Pena de Multa:</label>
                    </td>
                    <td>
                        <?php
                        $pm = $v['Artigo']['pena_multa'];
                        echo $this->Util->setaValorPadrao($simNao[$pm]);
                        ?>
                        <label>Multa :</label>
                        <?php
                        echo $v['Artigo']['multa'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Pena:</label>
                    </td>
                    <td>
                        (<?php echo $v['Pena']['ano_pena']; ?> Anos)(<?php echo $v['Pena']['mes_pena']; ?> Meses) (<?php echo $v['Pena']['dia_pena']; ?> Dias)
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Substitui&ccedil;&atilde;o:</label>
                    </td>
                    <td>
                        <?php
                        $sb = $this->Util->setaValorPadrao($v['Pena']['substituicao'], 0);
                        echo $simNao[$sb];
                        if ($simNao[$sb] == 'Sim') {
                            ?>
                            (<?php echo $v['SubstituicaoPena']['ano']; ?> Anos)(<?php echo $v['SubstituicaoPena']['mes']; ?> Meses)(<?php echo $v['SubstituicaoPena']['dia']; ?> Dias)
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Observa&ccedil;&atilde;o</label>
                    </td>
                    <td>                    
                        <?php
                        echo $v['SubstituicaoPena']['descricao'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Suspens&atilde;o:</label>
                    </td>
                    <td>
                        <?php
                        $sp = $this->Util->setaValorPadrao($v['Pena']['suspensao'], 0);
                        echo $simNao[$sp];
                        if ($simNao[$sp] == 'Sim') {
                            ?>
                            (<?php echo $v['SuspensaoPena']['ano']; ?> Anos)(<?php echo $v['SuspensaoPena']['mes']; ?> Meses)(<?php echo $v['SuspensaoPena']['dia']; ?> Dias)
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Observa&ccedil;&atilde;o:</label>
                    </td>
                    <td>                    
                        <?php
                        echo $v['SuspensaoPena']['descricao'];
                        ?>
                    </td>
                </tr>
            </table>

            <div id="resArtigo"></div>
        </div>
    <?php } ?>

    <?php
}
?>
