<?php
if($_POST['page'] == 1) { 
    ?>
    <style type="text/css" >
    .recente{
        background-color: #98FB98;
        /*        border-right: 2px solid green;*/

    }
    .medio{
        background-color: #ADD8E6;
        /*        border-right: 2px solid yellow;*/

    }
    .antigo{
        background-color: #EEE9BF;
        /*        border-right: 2px solid red;*/

    }
    .naoAtendido{
        background-color: #CD5C5C;
        /*        border-right: 2px solid blue;*/

    }
    .legenda td{
        padding-left: 10px;
    }
    .aviso{
        margin-right: 4px;
    }
    </style>
    <?php
}

$assistidoS = $this->Session->read('Pesquisa.assistido');
$tipoS = $this->Session->read('Pesquisa.tipo');
$this->Util->setaValorPadrao($tipo, $tipoS);
$this->Util->setaValorPadrao($assistidos, $assistidoS);
$this->Util->setaValorPadrao($opcoesListagem, null);
$this->Util->setaValorPadrao($acoesArray, explode('-', $opcoesListagem));

if (isset($assistidos) && !empty($assistidos)) {
    //print_r($assistidos);
    ?>
    <div>
    <?php
    if ($tipo == 'F') {
        $this->Util->setaValorPadrao($action, 'campos');
        if($_POST['page'] == 1) { 
            echo $this->Html->link(
                $this->Html->div('glyphicons-user-add', 'Adicionar Assistido'), array('controller' => "assistidos", 'action' => "$action/1/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
            );
        }
        ?>
        <table id="filtroAssistido" class="table table-striped table-responsive table-bordered tablesorter">
            <thead>
                <tr>
                    <th>N° DA TRIAGEM</th>
                    <th>ASSISTIDO</th>  
                    <!--                      
                    <th>NOME DA MÃE</th>  
                    -->                      
                    <th>UNIDADE DEFENSORIAL</th>
                    <th>UNIDADE JUDICIÁRIA</th>                        
                    <th>ÁREA ZEIS</th>
                    <th>OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($assistidos as $assistido):
                    ?>
                    <tr>

                        <?php
                        $idAssistido = $assistido['Assistido']['id'];
                        $momento = isset($idsUltimoAtendimentoAssistidos[$idAssistido]) ? $idsUltimoAtendimentoAssistidos[$idAssistido] : NULL;

                        $difData = $this->Util->diffDate(date("Y-m-d"), $momento);
                        if ($momento == 0) {
                            $classe = "naoAtendido";
                        } elseif ($difData > 60) {
                            $classe = "antigo";
                        } elseif ($difData > 30) {
                            $classe = "medio";
                        } else {
                            $classe = "recente";
                        }

                        if (!empty($momento) && $momento != "0000-00-00") {
                            $momento = $this->Util->aammddHis($momento);
                        } else {
                            $momento = "ND";
                        }
                        ?>

                        <td style="width: 134px;">
                            <div class="aviso <?php echo $classe; ?>" title="Data do último atendimento: <?php echo $momento; ?>"></div>                           
                            <div>
                                <?php
                                echo $this->Html->link(
                                        $this->Html->div('', $assistido['Assistido']['numero_triagem']), array('controller' => 'assistidos', 'action' => 'view', $assistido['Assistido']['id'], 2, 1), array('title' => 'Visualizar Espelho',
                                    'text-decoration ' => 'none',
                                    'target' => '_blank',
                                    'class' => 'link-modal',
                                    'data-target' => "#modal",
                                    'data-toggle' => "modal",
                                    'bgcolor' => "$classe",
                                    'escape' => false));
                                ?>
                            </div>
                        </td>
                        <td style="max-width: 134px;">
                            <?php         
                                if(!empty($assistido['Pessoa']['nome_social'])){
                                    echo $assistido['Pessoa']['nome_social'];
                                    echo '<br><i style="font-size:11px">(Nome civil: '.utf8_encode($assistido['Pessoa']['nome']).')</i>';
                                }else echo utf8_encode($assistido['Pessoa']['nome']);
                            ?>
                        </td>
                        <!--                            
                        <td style="max-width: 134px;">
                            
                            <?php 
                            //echo utf8_encode($assistido['PessoaFisica']['nome_mae']); 
                            ?>
                        </td>
                        -->
                        <td style="max-width: 97px;">
                            <?php echo $assistido['UnidadeDefensorial']['nome']; ?>
                        </td>
                        <td style="max-width: 97px;">
                            <?php echo $assistido['Atuacao']['nome']; ?>
                        </td>
                        <td style="max-width: 97px;">
                            <?php echo $assistido['AreaZeis']['nome']; ?>
                        </td>
                        
                        <td class="actions" style="min-width: 30px;" align="center">
                            <span>
                                <?php
                                foreach ($acoesArray as $key => $value) {
                                    echo $this->Html->link($this->Html->div($classesA[$value], ''), array(
                                        'controller' => $controllerA[$value],
                                        'action' => $acoesAssistA[$value],
                                        $assistido['Assistido']['id']), array('escape' => false,
                                        'title' => $this->Util->__($acoesAssistA[$value] . ' ' . Inflector::singularize($controllerA[$value])))
                                    );
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php 
    } 
    else if ($tipo == 'J') { 
        $this->Util->setaValorPadrao($action, 'campos');
        if($_POST['page'] == 1) { 
            echo $this->Html->link(
                $this->Html->div('glyphicons-user-add', 'Adicionar Assistido'), array('controller' => "assistidos", 'action' => "$action/1/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
            );
        }
        ?>
        <table id="filtroAssistido" class="table table-striped table-responsive table-bordered tablesorter">
            <thead>
                <tr>
                    <th>NÚMERO DA TRIAGEM</th>
                    <th>RAZÃO SOCIAL</th>
                    <th>CNPJ</th>
                    <th>CIDADE</th>
                    <th>DATA CADASTRO</th>
                    <th class="actions" style="min-width: 30px;">OPÇÕES</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;
                foreach ($assistidos as $assistido):
                    ?>
                    <tr>

                        <?php
                        $idAssistido = $assistido['Assistido']['id'];
                        $momento = isset($idsUltimoAtendimentoAssistidos[$idAssistido]) ? $idsUltimoAtendimentoAssistidos[$idAssistido] : NULL;

                        $difData = $this->Util->diffDate(date("Y-m-d"), $momento);
                        if ($momento == 0) {
                            $classe = "naoAtendido";
                        } elseif ($difData > 60) {
                            $classe = "antigo";
                        } elseif ($difData > 30) {
                            $classe = "medio";
                        } else {
                            $classe = "recente";
                        }
                        //FireCake::info($classe, '$cor');
                        if (!empty($momento) && $momento != "0000-00-00") {
                            $momento = $this->Util->aammddHis($momento);
                        } else {
                            $momento = "ND";
                        }
                        ?>

                        <td style="width: 134px;">
                            <div class="aviso <?php echo $classe; ?>" title="Data do último atendimento: <?php echo $momento; ?>">
                            </div>
                            <div>
                                <?php
                                echo $this->Html->link(
                                        $this->Html->div('', $assistido['Assistido']['numero_triagem']), array('controller' => 'assistidos', 'action' => 'view', $assistido['Assistido']['id'], 2, 1), array('title' => 'Visualizar Espelho',
                                    'text-decoration ' => 'none',
                                    'target' => '_blank',
                                    'class' => 'link-modal',
                                    'data-target' => "#modal",
                                    'data-toggle' => "modal",
                                    'bgcolor' => "$classe",
                                    'escape' => false));
                                ?>
                            </div>
                        </td>
                        <td style="max-width: 134px;">                               
                            <?php echo utf8_encode($assistido['Pessoa']['nome']); ?>
                        </td>
                        <td>
                            <?php echo $assistido['PessoaJuridica']['cnpj']; ?>
                        </td>
                        <td style="max-width: 80px;">
                            <?php echo utf8_encode($assistido['Cidade']['nome']); ?>
                        </td>

                        <td style="width: 97px;">
                            <?php
                            $dtCad = explode(" ", $this->Util->aammddHis($this->Util->setaValorPadrao($assistido['Pessoa']['data_cadastro'], null)));
                            echo $dtCad[0];
                            ?>
                        </td>
                        <td class="actions" style="min-width: 30px;">
                            <div align="center">
                                <?php
                                foreach ($acoesArray as $key => $value) {
                                    echo $this->Html->link($this->Html->div($classesA[$value], ''), array(
                                        'controller' => $controllerA[$value],
                                        'action' => $acoesAssistA[$value],
                                        $assistido['Assistido']['id']), array('escape' => false));
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>

            </tbody>
        </table>
        <?php 
    } 
    else if ($tipo == 'C') { 
        $this->Util->setaValorPadrao($action, 'campos');
        if($_POST['page'] == 1) { 
            echo $this->Html->link(
                $this->Html->div('glyphicons-user-add', 'Adicionar Assistido'), array('controller' => "assistidos", 'action' => "$action/1/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
            );
        }
        ?>
        <table id="filtroAssistido" class="table table-striped table-responsive table-bordered tablesorter">
            <thead>
                <tr>
                    <th>NÚMERO DA TRIAGEM</th>
                    <th>NOME DO GRUPO</th>
                    <th>DECLARANTE</th>
                    <th>UNIDADE DEFENSORIAL - DEFESA</th>
                    <th>UNIDADE DEFENSORIAL - CUSTOS</th>
                    <th>UNIDADE JUDICIÁRIA</th> 
                    <th>INÍCIO DA ATUAÇÃO</th> 
                    <th>ÁREA ZEIS</th>
                    <th class="actions" style="min-width: 30px;">OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                //FireCake::info($assistidos, 'assistidos');
                foreach ($assistidos as $assistido):
                    
                    ?>
                    <tr>

                        <?php
                        $idAssistido = $assistido['Assistido']['id'];
                        $momento = isset($idsUltimoAtendimentoAssistidos[$idAssistido]) ? $idsUltimoAtendimentoAssistidos[$idAssistido] : NULL;

                        $difData = $this->Util->diffDate(date("Y-m-d"), $momento);
                        if ($momento == 0) {
                            $classe = "naoAtendido";
                        } elseif ($difData > 60) {
                            $classe = "antigo";
                        } elseif ($difData > 30) {
                            $classe = "medio";
                        } else {
                            $classe = "recente";
                        }
                        //FireCake::info($classe, '$cor');
                        if (!empty($momento) && $momento != "0000-00-00") {
                            $momento = $this->Util->aammddHis($momento);
                        } else {
                            $momento = "ND";
                        }
                        ?>

                        <td style="width: 134px;">
                            <div class="aviso <?php echo $classe; ?>" title="Data do último atendimento: <?php echo $momento; ?>">
                            </div>
                            <div>
                                <?php
                                echo $this->Html->link(
                                        $this->Html->div('', $assistido['Assistido']['numero_triagem']), array('controller' => 'assistidos', 'action' => 'view', $assistido['Assistido']['id'], 2, 1), array('title' => 'Visualizar Espelho',
                                    'text-decoration ' => 'none',
                                    'target' => '_blank',
                                    'class' => 'link-modal',
                                    'data-target' => "#modal",
                                    'data-toggle' => "modal",
                                    'bgcolor' => "$classe",
                                    'escape' => false));
                                ?>
                            </div>
                        </td>
                        <td style="max-width: 134px;">
                            <?php echo $assistido['Pessoa']['nome']; ?>
                        </td>
                        <td>
                            <?php echo $assistido['Pessoa']['representante']; ?>
                        </td>
                        <td>
                            <?php 
                                echo $assistido['UnidadeDefensorialDef']['nome'];                                
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo $assistido['UnidadeDefensorialCust']['nome'];
                            ?>
                        </td>
                        <td style="max-width: 97px;">
                            <?php echo $assistido['Atuacao']['nome']; ?>
                        </td>
                        <td style="width: 97px;">
                            <?php
                            $dtCad = explode(" ", $this->Util->ddmmaa($this->Util->setaValorPadrao($assistido['FundiarioColetivo']['inicio_atuacao'], null)));
                            echo $dtCad[0];
                            ?>
                        </td>
                        <td style="width: 97px;">
                            <?php echo $assistido['AreaZeis']['nome']; ?>                                
                        </td>
                        <td class="actions" style="min-width: 30px;">
                            <div align="center">
                                <?php
                                foreach ($acoesArray as $key => $value) {
                                    echo $this->Html->link($this->Html->div($classesA[$value], ''), array(
                                        'controller' => $controllerA[$value],
                                        'action' => $acoesAssistA[$value],
                                        $assistido['Assistido']['id']), array('escape' => false));
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>

            </tbody>
        </table>
        <?php    
    }
    else if ($tipo == 'E') { 
        $this->Util->setaValorPadrao($action, 'campos');
        if($_POST['page'] == 1) { 
            echo $this->Html->link(
                $this->Html->div('glyphicons-user-add', 'Adicionar novo registro'), array('controller' => "fundiarios", 'action' => "add"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
            );
        }
        ?>
        <table id="filtroAssistido" class="table table-striped table-responsive table-bordered tablesorter">
            <thead>
                <tr>
                    <th>NÚMERO DA TRIAGEM</th>
                    <th>TÍTULO ATUAÇÃO</th>
                    <th>TEMÁTICA</th>
                    <th>ÓRGÃO/ENTIDADE</th>
                    <th>UNID. DEFENSORIAL</th>
                    <th>INÍCIO ATUAÇÃO</th>
                    <th class="actions" style="min-width: 30px;">OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                //FireCake::info($assistidos, 'assistidos');
                foreach ($assistidos as $assistido):
                    ?>
                    <tr>

                        <?php
                        $idAssistido = $assistido['Assistido']['id'];
                        $momento = isset($idsUltimoAtendimentoAssistidos[$idAssistido]) ? $idsUltimoAtendimentoAssistidos[$idAssistido] : NULL;

                        $difData = $this->Util->diffDate(date("Y-m-d"), $momento);
                        if ($momento == 0) {
                            $classe = "naoAtendido";
                        } elseif ($difData > 60) {
                            $classe = "antigo";
                        } elseif ($difData > 30) {
                            $classe = "medio";
                        } else {
                            $classe = "recente";
                        }
                        //FireCake::info($classe, '$cor');
                        if (!empty($momento) && $momento != "0000-00-00") {
                            $momento = $this->Util->aammddHis($momento);
                        } else {
                            $momento = "ND";
                        }
                        ?>

                        <td style="width: 134px;">
                            <div class="aviso <?php echo $classe; ?>" title="Data do último atendimento: <?php echo $momento; ?>">
                            </div>
                            <div>
                                <?php echo $assistido['Assistido']['numero_triagem']; 
                                ?>
                                
                            </div>
                        </td>
                        <td style="max-width: 134px;">
                            <?php echo $assistido['Pessoa']['nome']; ?>
                        </td>
                        <td>
                            <?php echo $assistido['Tematica']['nome']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($assistido['tb']['nome']); ?>
                        </td>
                        <td>
                            <?php echo $assistido['UnidadeDefensorial']['nome']; ?>
                        </td>
                        <td style="width: 97px;">
                            <?php
                            $dtCad = explode(" ", $this->Util->ddmmaa($this->Util->setaValorPadrao($assistido['FundiarioExtrajudicial']['inicio_atuacao'], null)));
                            echo $dtCad[0];
                            ?>
                        </td>
                        <td class="actions" style="min-width: 30px;">
                            <div align="center">
                                <?php
                                foreach ($acoesArray as $key => $value) {
                                    echo $this->Html->link($this->Html->div($classesA[$value], ''), array(
                                        'controller' => $controllerA[$value],
                                        'action' => $acoesAssistA[$value],
                                        $assistido['Assistido']['id']), array('escape' => false));
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>

            </tbody>
        </table>
        <?php 
    } 
    ?>   
    </div>
    <button id="bt-mais-resultados" class="btn btn-primary right">Carregar mais resultados...</button>
    <?php 
    if($_POST['page'] == 1) { 
        ?>
        <h3 id="box-rodape">Frequência de Atendimento até <?php echo date('d/m/Y'); ?> (Hoje)</h3>
        <table class="table table-striped frequencia-atendimento">
            <tr>
                <td>
                    <div class="aviso recente"></div>
                </td>
                <td>Inferior a 30 dias</td>
                <td>
                    <div class="aviso medio"></div>
                </td>
                <td>Entre 31 - 60 dias</td>
                <td>
                    <div class="aviso antigo"></div>
                </td>
                <td>Superior a 60 dias</td>
                <td>
                    <div class="aviso naoAtendido"></div>
                </td>
                <td>Apenas cadastrado</td>
            </tr>
        </table>
        <div class="listagem" style="width:400px"></div>
        <script>
            if(($('#FiltroNome').val()!='' && typeof $('#FiltroNome').val()!=='undefined') || 
                ($('#nomeC').val()!='' && typeof $('#nomeC').val()!=='undefined')) {
                $('#bt-mais-resultados').hide();
            }
        </script>
        <?php 
    } 

} 
else { 
    if ($tipo == 'E') { ?>
        <script type="text/javascript">
            alert('Nenhum Registro Extrajudicial Encontrado.')
        </script>
        <?php
        $this->Util->setaValorPadrao($action, 'campos');
        echo $this->Html->link(
                    $this->Html->div('glyphicons-user-add', 'Adicionar novo registro'), array('controller' => "fundiarios", 'action' => "add/0/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
        );
    } else { ?>
        <script type="text/javascript">
            alert('Nenhum assistido encontrado.')
        </script>
        <?php
        $this->Util->setaValorPadrao($action, 'campos');
        echo $this->Html->link(
                $this->Html->div('glyphicons-user-add', 'Adicionar Assistido'), array('controller' => "assistidos", 'action' => "$action/1/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
        );
    }
}
?>
<script type="text/javascript">
    //Tentativa de carregar o adicionar ações de especializadas por ajax, mas no momento não é possivel pois tem que preparar pois por exemplos as ações não da pra ser carregada
    //na pagina tambem.
    //    $(document).ready(function () {
    //        $(".glyphicon-plus-sign").click(function (event) {
    //            var url = $(this).parent().attr('href');
    //            $.ajax({
    //                url: url,
    //                success: function (response) {
    //                    $('#titulo').fadeOut('slow');
    //                    $('#titulo').empty();                    
    //                    $('#titulo').html(response);
    //                    $('#titulo').fadeIn('slow');
    //                },
    //                complete:function () {
    //                    refreshJquery();
    //                }
    //            });
    //            event.preventDefault();
    //        });
    //    });
</script>
