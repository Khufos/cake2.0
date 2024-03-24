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
$assistidoS = $this->Session->read('Pesquisa.assistido');
$tipoS = $this->Session->read('Pesquisa.tipo');
$this->Util->setaValorPadrao($tipo, $tipoS);
$this->Util->setaValorPadrao($assistidos, $assistidoS);
$this->Util->setaValorPadrao($opcoesListagem, null);
$this->Util->setaValorPadrao($acoesArray, explode('-', $opcoesListagem));

if (isset($assistidos) && !empty($assistidos)) {

    if ($tipo == 'F') {
        ?>
        <?php
        $this->Util->setaValorPadrao($action, 'campos');
        echo $this->Html->link(
                $this->Html->div('glyphicons-user-add', 'Adicionar Assistido'), array('controller' => "assistidos", 'action' => "$action/1/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
        );
        ?>
        <button class="btn btn-default marginbottom10" onclick="ImportarAssistido()">Importar Assistido do PJE</button>
        <div>
            <table id="filtroAssistido" class="table table-striped table-responsive table-bordered tablesorter">
                <thead>
                    <tr>
                        <th>N° DA TRIAGEM</th>
                        <th>ASSISTIDO</th>
                        <th>DATA NASCIMENTO</th>
                        <th>NOME DA MÃE</th>
                        <th>CIDADE</th>                        
                        <th>NÚMERO DO PROCESSO</th>
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

                            <td style="width: 10%;">
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
                            <td style="width: 24%;">
                                <?php 
                                    if(!empty($assistido['Pessoa']['nome_social']) && $assistido['Pessoa']['nome_social']!="ND"){
                                        echo utf8_encode($assistido['Pessoa']['nome_social']);
                                        echo ' <br><i style="font-size:11px">(Nome civil: '.utf8_encode($assistido['Pessoa']['nome']).')</i>';
                                    }else
                                        echo utf8_encode($assistido['Pessoa']['nome']);
                                    if($assistido['Assistido']['reu_preso'] == 1){?>
                                        <div class="badge bg-primary text-wrap" title="Réu preso" style="background-color: #0078aa; color: white; border-radius: 0px; padding: 2px 3px; font-size: 11px;">RP</div>
                                    <?php }
                                ?>
                            <?php
                                if(isset($MarcadorSelec)){
                                    foreach ($MarcadorSelec as $key => $marcadores) :
                                        if($assistido['Assistido']['id'] == $marcadores['map']['assistido_id']){?>
                                            <div class="badge bg-primary text-wrap" style="background-color: <?=$marcadores['cor']['hexadecimal']?>; color: <?=$marcadores['cor']['cor_fonte']?>; margin-top: 5px;"><?=$marcadores['marc']['nome']?></div><?php
                                        }
                                    endforeach;
                                }
                            ?>
                            </td>

                            <td style="width: 8%;" align="center">
                                <?php
                                if ($assistido['PessoaFisica']['nascimento'] == "0000-00-00" || empty($assistido['PessoaFisica']['nascimento'])) {
                                    echo "-";
                                } else {
                                    echo $this->Util->ddmmaa($assistido['PessoaFisica']['nascimento']);
                                }
                                ?>
                            </td>
                            <td style="width: 23%;">
                                
                                <?php echo utf8_encode($assistido['PessoaFisica']['nome_mae']); ?>
                            </td>
                            <td style="width: 10%;">
                                <?php echo utf8_encode($assistido['Cidade']['nome']); ?>
                            </td>
                            

                            <td style="width: 15%;" align="center">
                                <?php
                                // $dtCad = explode(' ', $assistido['Pessoa']['data_cadastro']);
                                // echo $this->Util->ddmmaa($dtCad[0]);
                                if (!empty($idsProcessos[$idAssistido])) {
                                    $idsProcessos[$idAssistido] = str_replace(',', '<br/>', $idsProcessos[$idAssistido]);
                                    $arrayProc = str_split($idsProcessos[$idAssistido], 30);
                                    foreach ($arrayProc as $i => $value) {
                                        $agendamento = "SELECT acoes.id FROM acoes inner processos on (processos.id = acoes.processo_id) WHERE processos.numeracao_unica = '$arrayProc[$i]' AND processos.assistido_id= $idAssistido";
                                        if (!empty($agendamento)) {
                                            echo $arrayProc[$i];
                                        }
                                    }
                                }
                                ?>                       
                            </td>
                            <td class="actions" style="width: 10%;" align="center">
                                <span>
                                    <?php
                                    foreach ($acoesArray as $key => $value) {
                                        if(!empty($acoesAssistA[$value])){
                                            echo $this->Html->link($this->Html->div($classesA[$value], ''), array(
                                                'controller' => $controllerA[$value],
                                                'action' => $acoesAssistA[$value],
                                                $assistido['Assistido']['id']), array('escape' => false,                                                
                                                'title' => $this->Util->__($acoesAssistA[$value]))
                                            );
                                        }else{
                                            echo $this->Html->link($this->Html->div($classesA[$value], ''), array(
                                                'controller' => $controllerA[$value],
                                                'action' => $acoesAssistA[$value],
                                                $assistido['Assistido']['id']), array('escape' => false,
                                                 'title' => $this->Util->__($acoesAssistA[$value] . ' ' . Inflector::singularize($controllerA[$value])))                                                
                                            );
                                        }
                                    }
                                    ?>
                                </span>
                             <!--   <?php if($perfilDefensor == true){ ?>
                                    <span><div style="cursor: pointer; color: #136938" class="glyphicon glyphicon-tags" title="Marcador" onclick="gerenciarMarcador( <?=$assistido['Assistido']['id']?>,'<?=$_SERVER['REQUEST_URI']?>')"></div></span>
                                <?php } ?> --> 
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>

        <?php } else if ($tipo == 'J') { ?>
            <?php
            $this->Util->setaValorPadrao($action, 'campos');
            echo $this->Html->link(
                    $this->Html->div('glyphicons-user-add', 'Adicionar Assistido'), array('controller' => "assistidos", 'action' => "$action/1/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
            );
            ?>
            <button class="btn btn-default marginbottom10" onclick="ImportarAssistido()">Importar Assistido do PJE</button>

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
        <?php } else if ($tipo == 'C') { ?>
            <?php
            $this->Util->setaValorPadrao($action, 'campos');
            echo $this->Html->link(
                    $this->Html->div('glyphicons-user-add', 'Adicionar Assistido'), array('controller' => "assistidos", 'action' => "$action/1/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
            );
            ?>
            <button class="btn btn-default marginbottom10" onclick="ImportarAssistido()">Importar Assistido do PJE</button>

            <table id="filtroAssistido" class="table table-striped table-responsive table-bordered tablesorter">
                <thead>
                    <tr>
                        <th>NÚMERO DA TRIAGEM</th>
                        <th>NOME DO GRUPO</th>
                        <th>DECLARANTE</th>
                        <th>CIDADE</th>
                        <th>DATA CADASTRO</th>
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
        <?php } ?>   

    </div>
    <div id="marcadorExpediente"></div>
    <h3>Frequência de Atendimento até <?php echo date('d/m/Y'); ?> (Hoje)</h3>
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

    <div class="listagem" style="width:400px">

    </div>
<?php } else { ?>
    <script type="text/javascript">
        alert('Nenhum assistido encontrado.')
    </script>
    <?php
    $this->Util->setaValorPadrao($action, 'campos');
    echo $this->Html->link(
            $this->Html->div('glyphicons-user-add', 'Adicionar Assistido'), array('controller' => "assistidos", 'action' => "$action/1/$tipo"), array('escape' => false, 'class' => 'btn btn-default marginbottom10')
    );
?>
    <button class="btn btn-default marginbottom10" onclick="ImportarAssistido()">Importar Assistido do PJE</button>
<?php
}
?>
<div id="ImportarAssitido"></div>

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

    function gerenciarMarcador(id, urlPag){
        $.ajax({
            url: '/assistidos_marcadores/marcador/'+id+'?urlAtual='+urlPag+'&trs=1',
            type: "GET",
            datatype: 'html',
            success: function(data) {
                $("#marcadorExpediente").html(data);
                $('#addMarcador').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        });
    }

    function ImportarAssistido(){
        $.ajax({
            url: '/importar_assistido_pje/importar?trs=1',
            type: "GET",
            datatype: 'html',
            success: function(data) {
                $("#ImportarAssitido").html(data);
                $('#import').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        });
    }
</script>
