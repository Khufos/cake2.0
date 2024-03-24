<div id="resumo">
    <!--DADOS GERAIS-->
    <table class="table table-bordered">
        <caption class="captionA"> DADOS GERAIS </caption>
        <tr>
            <td>N&uacute;mero Execu&ccedil;&atilde;o</td>
            <td><?php echo $this->Util->setaValorPadrao($numExecucao); ?></td>
        </tr>
        <tr>
            <td>Nome do Setenciado:</td>
            <td>
                <?php echo current($assistido) ?>
            </td>
        </tr>
        <tr>
            <td>Pena Total:</td>
            <td><?php echo $this->Util->formataParaDMA(current($dadosCondenacao['ttPena'])); ?></td>
        </tr>
    </table>

    <!-- CONDENAÇÕES-->
    <?php if (isset($dadosCondenacao['artigos'])) { ?>
        <table class="table table-bordered">
            <caption class="captionA"> CONDENA&Ccedil;&Otilde;ES </caption>
            <tr class="label_bold">
                <th>Pena</th>
                <th>Dt do Fato</th>
                <th>In&iacute;cio da Cond</th>
                <th>Hediondo</th>
                <th>Reincidente</th>
                <th>Fr. Prog.Reg.</th>
                <th>Fr. Liv. Cond.</th>
            </tr>
            <?php
            $artigos = $dadosCondenacao['artigos'];
            foreach ($artigos as $key => $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['pena']['a'] . "a" . $value['pena']['m'] . 'm' . $value['pena']['d'] . "d"; ?>
                    </td>
                    <td><?php echo $this->Util->ddmmaa($value['data_fato']); ?></td>
                    <td><?php echo $this->Util->ddmmaa($value['data_prisao']); ?></td>
                    <td><?php echo $simNao[$value['hediondo']]; ?></td>
                    <td><?php echo $simNao[$value['reincidente']]; ?></td>
                    <td><?php echo $value['p']['fracao']; ?></td>
                    <td><?php echo $value['l']['fracao']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <div>Não há condenaçoes</div>
    <?php } ?>
    <br>
    <table class="table table-bordered">
        <tr>
            <td >
                Data de Prisão Definitiva:
            </td>
            <td>
                <?php
                echo $this->Util->ddmmaa(current($dadosPenaCumprida['dtInicio']));
                //FireCake::info($dadosPenaCumprida, "\$dadosPenaCumprida");
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Total Interrupções:
            </td>
            <td>
                <?php
                echo $this->Util->formataParaDMA($dadosPenaCumprida['ttInterrupcao']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Total Detrações:
            </td>
            <td>
                <?php
                echo $this->Util->formataParaDMA($dadosPenaCumprida['ttDetracao']);
                ?>
                &nbsp;&nbsp;
                Considerar detra&ccedil;&otilde;es para redu&ccedil;&atilde;o da pena imposta: <span class="label_bold"><?php echo $simNao[$dadosPenaCumprida['reducao_pena']] ?></span>

            </td>
        </tr>
        <tr>
            <td>
                Total de Remições:
            </td>
            <td>
                <?php
                $this->Util->setaValorPadrao($dadosPenaCumprida['ttRemicao'], 0);
                echo $dadosPenaCumprida['ttRemicao'];
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Remições para Progressão:
            </td>
            <td>
                <?php
                echo $dadosPenaCumprida['ttRemicaoPR'];
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr></hr>
            </td>
        </tr>
    </table>
    <br>
    <!-- PROGRESSÃO -->
    <table class="table table-bordered">
        <caption class="captionA"> PARA PROGRESSÃO DE REGIME </caption>
        <tr>
            <td>Regime:</td>
            <td>
                <?php
                $idTpRegimeAtual = $regimes['Regime']['tipo_regime_id']; // pega o regime atual
                $idTpRegimeProgressao = array_search($idTpRegimeAtual, $progressaoRegime); // busca o identificador do regime atual
                $idTpRegimeProgressao++; // incrementa para o proximo regime
                $idTpRegimeProgressao = $this->Util->setaValorPadrao($progressaoRegime[$idTpRegimeProgressao], null); // pega o id do proximo regime
                $regimeProgresssao = $this->Util->setaValorPadrao($tipoRegimes[$idTpRegimeProgressao], 'SEM PROGRESSÃO'); // pega descrição do regime para progresão
                echo $tipoRegimes[$idTpRegimeAtual] . ' -> ' . $regimeProgresssao;
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Data-base:
            </td>
            <td>
                <?php
                echo $this->Util->ddmmaa($dadosPenaCumprida['dtBase']) . " (" . $dadosPenaCumprida['labelDtBase'] . ")";
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Pena Cumprida:
            </td>
            <td>
                (Data-base - Data Início) - Interrupção + Detração
            </td>
        </tr>
        <tr>
            <td>

            </td>
            <td>
                <?php
                $ttDetracao = $dadosPenaCumprida['reducao_pena'];
                if ($dadosPenaCumprida['reducao_pena'] == 0) {
                    $ttDetracao = array('a' => 0, 'm' => 0, 'd' => 0);
                }
                echo "(" . $this->Util->ddmmaa($dadosPenaCumprida['dtBase'])
                . '-' .
                $this->Util->ddmmaa(current($dadosPenaCumprida['dtInicio']))
                . ") - "
                . $this->Util->formataParaDMA($dadosPenaCumprida['ttInterrupcao'])
                . "+"
                . $this->Util->formataParaDMA($ttDetracao);
                ?>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <?php
                $diffData = $this->Util->difDatasDMA(current($dadosPenaCumprida['dtInicio']), $dadosPenaCumprida['dtBase']);
                echo $this->Util->formataParaDMA($diffData)
                . " - " . $this->Util->formataParaDMA($dadosPenaCumprida['ttInterrupcao'])
                . " + "
                . $this->Util->formataParaDMA($ttDetracao);
                ;
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Somatória das penas:
            </td>
            <td>
                <?php echo $this->Util->formataParaDMA(current($dadosCondenacao['ttPena'])); ?>
            </td>
        </tr>
        <tr>
            <td>
                Pena Cumprida Até a Data-base:
            </td>
            <td>
                <?php echo $this->Util->formataParaDMA($dadosPenaCumprida['penaCumpridaDtBase']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
        </tr>
        <tr>
            <td>
                Cálculo da Fração:
            </td>
            <td>
                (Pena Total - Pena Cumprida) * Fração
            </td>
        </tr>
        <?php
        $somaFracao = 0;

        foreach ($dadosProgressao as $key => $value) { // varre as frações das condenações
            $ttPenaFracao = $this->Util->setaValorPadrao($dadosCondenacao['ttPenaFracao'][$key], null);
            $qtdDiaFracao = $this->Util->converteDMAparaDias($ttPenaFracao);
            if ($qtdDiaFracao > 0) { # só exibe se houve pena para a fração
                ?>
                <tr>
                    <td>
                        Fra&ccedil;&atilde;o ( <?php echo $key ?> ):
                    </td>
                    <td>
                        <?php
                        $diffDMA = $this->Util->subtrairDMA($ttPenaFracao, $value);
                        $frCum = floor($this->Util->converteDMAparaDias($diffDMA) * $valorFracao[$key]);
                        $somaFracao+=$frCum;
                        $pCump = $this->Util->formataParaDMA($this->Util->converteParaDMA($frCum));
                        $diffDMA = $this->Util->formataParaDMA($diffDMA);
                        echo "( " . $this->Util->formataParaDMA($ttPenaFracao)
                        . " - "
                        . $this->Util->formataParaDMA($value)
                        . " ) "
                        . " * " . $key . ' => ' . $diffDMA . ' * ' . $key . ' = ' . $pCump
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>
                Fórmula do Requisito Temporal:
            </td>
            <td>
                Data-base + Soma das Frações + Interrupção  - Detração - Remição - 1 dia
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <?php
                $ttDetracao = $this->Util->formataParaDMA($dadosPenaCumprida['ttDetracao']);
                if ($dadosPenaCumprida['reducao_pena'] == 1) { // não calcula novamente a detração
                    $ttDetracao = $this->Util->formataParaDMA(array('a' => 0, 'm' => 0, 'd' => 0));
                }
                echo $this->Util->ddmmaa($dadosPenaCumprida['dtBase']) . ' + '
                . $this->Util->formataParaDMA($this->Util->converteParaDMA($somaFracao))
                . ' + '
                . $this->Util->formataParaDMA(array('a' => 0, 'm' => 0, 'd' => 0))
                . ' - '
                . $ttDetracao
                . ' - '
                . $dadosPenaCumprida['ttRemicaoPR'] . "d"
                . ' - 1d';
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Data do Requisito Temporal:
            </td>
            <td>
                <?php
                $dtPR = $dadosPenaCumprida['dtPR'];
                echo $this->Util->ddmmaa($dtPR);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr></hr>
            </td>
        </tr>
    </table>
    <br>
    <!-- LIVRAMENTO -->
    <table class="table table-bordered">
        <caption class="captionA"> PARA LIVRAMENTO CONDICIONAL </caption>
        <tr>
            <td>
                Data-base:
            </td>
            <td>
                <?php
                $dtBaseLC = $this->Util->setaValorPadrao($dadosLivramento['dtBaseLC'], null);
                echo $this->Util->ddmmaa($dtBaseLC);
                ?>
            </td>
        </tr>
        <?php
        foreach ($dadosCondenacao['somaFracaoLC'] as $k => $v) {
            $qDiaLc = $this->Util->converteDMAparaDias($v);
            if ($qDiaLc > 0) {
                //FireCake::info($v, "\$v");
                ?>
                <tr>
                    <td>
                        Fra&ccedil;&atilde;o( <?php echo $k; ?> * <?php
                        $somaPenaLC = $this->Util->setaValorPadrao($dadosCondenacao['somaPenaLC'][$k], null);
                        echo $this->Util->formataParaDMA($somaPenaLC);
                        ?>):
                    </td>
                    <td>
                        <?php echo $this->Util->formataParaDMA($v); ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td>&nbsp;

            </td>
        </tr>
        <tr>
            <td>
                Fórmula do Requisito Temporal:
            </td>
            <td>
                Data-base + Soma das Frações + Interrupção - Detração - Remição - 1 dia
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <?php
                $ttInterrupcaoLC = $this->Util->setaValorPadrao($dadosLivramento['ttInterrupcaoLC'], null);
                echo $this->Util->ddmmaa($dtBaseLC) . ' + ' .
                $this->Util->formataParaDMA($dadosCondenacao['ttFracaoLC']) . ' + ' .
                $this->Util->formataParaDMA($ttInterrupcaoLC) . ' - ' .
                $this->Util->formataParaDMA($dadosPenaCumprida['ttDetracao']) . ' - ' .
                $dadosPenaCumprida['ttRemicao'] . 'd - ' .
                " 1d";
                ;
                ?>
            </td>
        </tr>
        <tr>
            <td>                
                Data do Requisito Temporal:
            </td>
            <td>
                <?php echo $this->Util->ddmmaa($dadosLivramento['dataLC']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr></hr>
            </td>
        </tr>
    </table>
    <br>
    <!-- TÉRMINO -->
    <table class="table table-bordered">
        <caption class="captionA"> TÉRMINO DA PENA</caption>
        <tr>
            <td>
                Fórmula do Requisito Temporal:
            </td>
            <td>
                Dt. Ini. de cuprimento + Pena Total + Interrupção - Detração - Remição - 1 dia
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <?php
                echo $this->Util->ddmmaa(current($dadosPenaCumprida['dtInicio'])) . " + " .
                $this->Util->formataParaDMA(current($dadosCondenacao['ttPena'])) . " + " .
                $this->Util->formataParaDMA($dadosPenaCumprida['ttInterrupcao']) . " - " .
                $this->Util->formataParaDMA($dadosPenaCumprida['ttDetracao']) . " - " .
                $dadosPenaCumprida['ttRemicao'] . "d - 1d";
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Data do Término da Pena:
            </td>
            <td>
                <?php
                echo $this->Util->ddmmaa($dadosPenaCumprida['dtTermino']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Pena cumprida at&eacute; data atual:
            </td>
            <td>
                <?php
                echo $this->Util->formataParaDMA($dadosPenaCumprida['penaCumpridaDtAtual']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Pena restante a partir da data atual:
            </td>
            <td>
                <?php
                echo $this->Util->formataParaDMA($dadosPenaCumprida['penaRestante']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Pena Total:
            </td>
            <td>
                <?php
                echo $this->Util->formataParaDMA($this->Util->somarDMA($dadosPenaCumprida['penaRestante'], $dadosPenaCumprida['penaCumpridaDtAtual']));
                ?>
            </td>
        </tr>
        <tr>
            <td><hr /></td>
        </tr>
    </table>    
</div>

