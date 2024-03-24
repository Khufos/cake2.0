<div id="condenacoes">
    <h4>CONDENAÇÕES</h4>
    <?php
    $camposLi = "condenacoes";
    $remote = $this->Js->request(
            array(
                'action' => "buscaCondenacaoExecucao/$idExecucaoPenal?trs=1",
                'update' => 'abaCondencoes'));

    foreach ($condenacoes as $key => $value) {
        $idCondenacao = $value['ExecucaoPenaisProcesso']['id'];
        $idTableCondenacao = "blocoCondenacao$idCondenacao";
        $idBlocoArtigo = "blocoArtigo$idCondenacao";
        $nomeProcesso = $value['Processo']['numeracao_unica'] . "" . $value['Processo']['numeracao_anterior'] . " - " . $value['Processo']['instancia'];
        $idProcesso = $value['Processo']['id'];
        $qtdArtigos = count($value['artigos']);
        ?>
        <h3><?php echo "$nomeProcesso &nbsp - $qtdArtigos artigo(s)" ?></h3>
        <div id="<?php echo $idTableCondenacao ?>">
            <table class="table table-bordered table-striped">			
                <tr>
                    <td>
                        <label>Processo:</label>
                    </td>
                    <td>
                        <?php
                        echo $value['Processo']['numeracao_antiga'] . ' / ' . $value['Processo']['numeracao_anterior'] . ' / ' . $value['Processo']['numeracao_unica'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Data do Fato:</label>
                    </td>
                    <td>
                        <?php echo $this->Util->setaValorPadrao($this->Util->ddmmaa($value['ExecucaoPenaisProcesso']['data_fato'])); ?>
                        <label>Data da prisão:</label>
                        <?php echo $this->Util->setaValorPadrao($this->Util->ddmmaa($value['ExecucaoPenaisProcesso']['data_prisao'])); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Comarca de Tramitação do Processo">
                            CTP:
                        </label>
                    </td>
                    <td>
                        <?php
                        echo $this->Util->setaValorPadrao($value['CMT']['nome']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Unidade DP:
                    </td>
                    <td colspan="2">
                        <?php
                        echo $this->Util->setaValorPadrao($value['UnidadeDefensorial']['nome']);
                        //---------------------------------------- AJAX
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Unidade Judiciária de Atuação">
                            UJA:
                        </label>
                    </td>
                    <td>
                        <?php
                        echo $this->Util->setaValorPadrao($value['Atuacao']['nome']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Comarca da prisão">
                            Comarca P.:
                        </label>
                    </td>
                    <td>
                        <?php
                        echo $this->Util->setaValorPadrao($value['CP']['nome']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Reincidente Geral ?</label>
                    </td>
                    <td>
                        <?php
                        $r = $value['ExecucaoPenaisProcesso']['reincidente_geral'];
                        echo $this->Util->setaValorPadrao($simNao[$r]);
                        ?>                        

                        <label> Unificado ?:</label>
                        <?php
                        $u = $value['ExecucaoPenaisProcesso']['unificado'];
                        //FireCake::info($u);
                        echo $this->Util->setaValorPadrao($simNao[$r]);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Medida de Seguran&ccedil;a:
                    </td>
                    <td>
                        <?php
                        $ms = $this->Util->setaValorPadrao($value['ExecucaoPenaisProcesso']['medida_seguranca'], 0);
                        echo $this->Util->setaValorPadrao($simNao[$ms]);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" id="blocoArtigo<?php echo $value['ExecucaoPenaisProcesso']['id'] ?>">
                        <?php
                        $artigos = $value['artigos'];
                        echo $this->element(
                                '/espelho_abas/artigos'
                                , array(
                            'artigos' => $artigos
                            , 'idBlocoArtigo' => $idBlocoArtigo
                            , 'idProcesso' => $idProcesso
                            , 'remover' => ($remover = false))
                        );
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php } ?>
</div>
