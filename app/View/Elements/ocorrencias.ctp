<h4>HISTÓRICO DE ATENDIMENTOS</h4>
<table class="table table-bordered table-striped">    
        <tr>
            <th>DATA DE CADASTRO</th>
            <th>NÚMERO</th>
            <th>ESPECIALIZADA</th>
            <th>TIPO DE AÇÃO</th>
            <th>SITUAÇÃO</th>           
            <th>VISUALIZAR</th>           
        </tr>    
    <tbody>
        <?php
        $i = 0;
        foreach ($outrosHistoricos as $acao):
            $chave = $acao['vwextrato']['model'] . "." . $acao['vwextrato']['id'];
            ?>
            <tr>
                <td>
                    <?php
                    if (empty($acao['vwextrato']['momento']) or $acao['vwextrato']['momento'] == "0000-00-00") {
                        echo "ND";
                    } else {
                        echo $this->Util->aammddHis($acao['vwextrato']['momento']);
                    }
                    ?>
                </td>
                <td><?php echo $this->Util->setaValorPadrao($acao['vwextrato']['numero']); ?></td>
                <td>
                    <?php
                        if($acao['vwextrato']['model']=='plantao_atendimentos'){
                            $x = $arrayModel[$acao['vwextrato']['model']];
                            foreach ($x as $key => $value){
                                if($key == $acao['vwextrato']['id'] ){
                                    echo $this->Util->setaValorPadrao($value);                                   
                                }                       
                            }
                        }else{
                            echo $this->Util->setaValorPadrao($arrayModel[$acao['vwextrato']['model']]);
                        }
                         
                   ?> 
                
               </td>
                <td>
                    <?php
                    unset($nome);
                    $tipoAcao = $acao['vwextrato']['tipoAcao'];
                    $nome = strlen($tipoAcao) > 20 ? substr($tipoAcao, 0, 20) . '...' : $tipoAcao;
                    ?>
                    <span title="<?php echo $tipoAcao; ?>"><?php echo $nome; ?>
                </td>
                <td>
                    <?php
                    unset($nome);
                    $situacao = $acao['vwextrato']['situacao'];
                    $nome = strlen($situacao) > 20 ? substr($situacao, 0, 20) . '...' : $situacao;
                    ?>
                    <span title="<?php echo $situacao; ?>"><?php echo $nome; ?>
                </td>                
                    <td>
                        <?php
                        
                        echo $this->Html->link(
                                $this->Html->div('glyphicon glyphicon-eye-open', ''), array(
                            'controller' => 'assistidos',
                            'action' => "detalhes/$chave/true/?trs=1/"
                                ), array(
                                    'class' => 'visualizar_dados_acao', 
                                    'escape' => false, 
                                    'title' => 'Visualizar',                                      
                                    'data-target' => "#modal",
                                    'data-toggle' => "modal",
                                    'id' => $acao['vwextrato']['model'] . $acao['vwextrato']['id'] . 'v'));
                        ?>
                    </td>               
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>