<?php
/**
 * @abstract Exibição dos links de opçoes na listagem do assistido
 * @author Jailson Boa Morte
 */
if (!empty($acoesArray)) {
    ?>
    <div style="float:right">
        <?php foreach ($acoesArray as $key => $value) { ?>
            <?php
            # Verifica se existem parametros para os links
            $param = '';
            if (isset($parametroAcoes)) {
                if (is_array($parametroAcoes)) {
                    $param = isset($parametroAcoes[$value]) ? $parametroAcoes[$value] : NULL;
                } else {
                    $param = $parametroAcoes;
                }
            }

            if (!empty($value)) {
                $this->Util->setaValorPadrao($paramsLink[$value], array());
                $paramsLink[$value] = $paramsLink[$value] + array('escape' => false, 'class' => 'btn btn-default');
                echo str_ireplace('%2F','/',trim($this->Html->link($this->Html->div($classesA[$value], ''), array('controller' => $controllerA[$value], 'action' => $acoesAssistA[$value].'/'.$param), $paramsLink[$value])));                
                
            }
            ?>
        <?php } ?>
    </div>
<?php } ?>