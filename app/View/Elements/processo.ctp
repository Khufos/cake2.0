<div style="float: left;">

    <table class="table" style="background-color: #FFFFE0; width: 100%" >
        <tr>
            <td>
                <label><span title='[Num. antiga] - [Num. anterior] / [Num. unica]'>Processo:</span></label>
            </td>
            <td class="wrapper">
                    <?php
                    
                    echo $this->Form->hidden("$model.assistido_id", array('value' => $idAssistido));
                    $this->Util->setaValorPadrao($idProcesso, 0);
                    $this->Util->setaValorPadrao($instancia, 1);

                    # processos do assistido
                    if (!empty($processosA)) {
                        foreach ($processosA as $key => $numeroProcesso) {
                            $caracteres = array('-', '[', ']', '/', ' ');
                            $processosA[$key] = str_replace($caracteres, array('', '', '', '', ''), $numeroProcesso);
                            $consultaProcesso = $processosA[$key];
                            $chave = $key;
                            
                        }
                    }

                    $args = array(
                        'default' => $idProcesso,
                        'label' => false,
                        'empty' => 'Selecione'
                    );
                    echo $this->Form->select("$model.processo_id", $processosA, $args);
                    $this->Util->setaValorPadrao($cadEdit, true);
                    $instanciaform =  isset($instanciaform) ? $instanciaform : 1;

                    $this->Js->get("#$model" . "ProcessoId")->event('change', $this->Js->request(
                       
                                    array(
                                'controller' => 'processos',
                                'action' => "processoTj/$model/$cadEdit/$idAssistido/$divProcesso/$idForm/$instanciaform?trs=1"
                                    ), array(
                                'async' => true,
                                'dataExpression' => true,
                                'data' => $this->Js->serializeForm(
                                        array(
                                            'isForm' => true,
                                            'inline' => true
                                        )
                                ),
                                'update' => '#' . $divProcesso,
                                'method ' => 'POST'
                                    )
                    ));
                    echo $this->Js->writeBuffer();
                    ?>
                    <!-- Cadastro e Edição -->
                        <?php

                        if ($cadEdit) {

                            if($model == "Curadoria"){
                                // Chamar para sortear as curadorias
                                echo $this->Html->link('sortear', 
                                    array(
                                        'controller' => 'ProcessoSorteios',
                                        'action' => 'gerenciar', $model, $idAssistido, $instanciaform, $idProcesso, $divProcesso, $idForm,
                                        '?' => array('trs' => '1')
                                    ), 
                                    array(
                                        'id' => "linkProcesso",
                                        'class' => 'link-modal',
                                        'data-target' => "#modal",
                                        'data-toggle' => "modal",
                                        'title' => 'Cadastrar / Editar processo'
                                    )
                                );
                            }

                            if($model != "Curadoria"){
                                
                                echo $this->Html->link('gerenciar', 
                                    array(
                                        'controller' => 'processos',
                                        'action' => 'gerenciar', $model, $idAssistido, $instanciaform, $idProcesso, $divProcesso, $idForm,
                                        '?' => array('trs' => '1')
                                    ), 
                                    array(
                                        'id' => "linkProcesso",
                                        'class' => 'link-modal',
                                        'data-target' => "#modal",
                                        'data-toggle' => "modal",
                                        'title' => 'Cadastrar / Editar processo'
                                    )
                                );
                            }
                            if($model == "JuizadoCriminal")
                            {
                                echo "  ";
                                // Chamar para sortear as DP's do Criminal
                                echo $this->Html->link('Sortear',
                                    array(
                                        'controller' => 'sorteio_processo_criminais',
                                        'action' => 'gerenciar', $model, $idAssistido, $instancia, $idProcesso, $divProcesso, $idForm,
                                        '?' => array('trs' => '1')
                                    ),
                                    array(
                                        'id' => "linkProcesso",
                                        'class' => 'link-modal',
                                        'data-target' => "#modal",
                                        'data-toggle' => "modal",
                                        'title' => 'Cadastrar / Editar processo'
                                    )
                                );
                            }
                        }
    // ESSA FUNÇÃO FOI COMENTADA E DESATIVADA TEMPORARIAMENTE POIS A CLASSE QUE FAZIA A INTEGRAÇÃO COM O ESAJ FOI DESATUALIZADA.
    //                    if ($processosA > 0) {
    //                        $link = $this->webroot . "processos/consultaProcessual/$consultaProcesso";
    //                        echo $this->Form->button("Consulta Processual", array('onClick' => "window.open('$link','_blank')"));
    //                        $this->Util->setaValorPadrao($tpAcao, 'ND');
    //                        $this->Util->setaValorPadrao($comarca, 'ND');
    //                        $this->Util->setaValorPadrao($unidadeDP, 'ND');
    //                        $this->Util->setaValorPadrao($atuacao, 'ND');
    //                        $distribuicao = "$comarca / $unidadeDP / $atuacao";
    //                    }
                        
?>
            </td>
        </tr>
        <?php if ($idProcesso > 0) { ?>
            <tr>
                <td>
                    <span class="label_bold direita"> Tipo de A&ccedil;&atilde;o:</span>
                </td>
                <td>
                    <span class="esquerda" style="font-size: x-small">
                        <?php echo $tpAcao; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label_bold direita"> Distribui&ccedil;&atilde;o:</span>
                </td>
                <td>
                    <span class="esquerda" style="font-size: x-small">    
                        <?php // echo $this->Util->setaValorPadrao($distribuicao, 'ND'); 
                        ?>
                        <?php echo $this->Util->setaValorPadrao($comarca, 'ND') . ' / ' . $this->Util->setaValorPadrao($atuacao, 'ND') . ' / '. $this->Util->setaValorPadrao($unidadeDP, 'ND'); ?>
                    </span>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<div style="">
    <?php 
        
        if(isset($processoExiste['Processo']['processo_pje'])){
            echo "<div class='displayrow'> ";
                if($processoExiste['Processo']['processo_pje'] && $btnPje){
                    echo $this->Html->link("Consultar", '/pje/index/'.$processoExiste['Processo']['numeracao_unica'], array('class' => "bdpje btn btn-primary", 'style' => 'margin-top: 5px; margin-left: 10px;', 'target' => '_blank'));
                }

                if($processoExiste['Processo']['processo_pje'] && $btnPeticoes){

                    echo '<a href="#RelObservacao2" id="btnExpedientesIndex"class="btn btn-primary" style="margin-top: 5px; margin-left: 10px;" role="tab" data-toggle="tab">Expedientes</a>';
                
                    echo '<a href='. $urlPeticionar .' id="" class="btn btn-success" target="_blank" style="margin-top: 5px; margin-left: 10px;" >Peticionar</a>';
                }
            echo "</div> ";
           
            
        }if(isset($processoPje)){
            if($processoPje && $btnPje) {
                echo $this->Html->link("Consultar", '/pje/index/'.$processoExiste['Processo']['numeracao_unica'], array('class' => "bdpje btn btn-primary", 'style' => 'margin-top: 5px; margin-left: 10px;', 'target' => '_blank'));
            }
        }
    ?>
</div>
<script>
    $("#AcaoProcessoId" ).change(function() {
        alert('Para vincular as modificações do processo na Ação , clique no botão [enviar]');
    });
    $(function () {

        //$("#AcaoProcessoId option:contains(2342423-42.3423.4.32.4234)").attr('selected', true);
        //var numUnica = document.querySelector('#AcaoProcessoId');
        //console.log(numUnica.options[numUnica.selectedIndex].value);
        
        //console.log(test)
       /* $('.pje').hide();
        
        if(numUnica != null){        
            var numeroP = numUnica.options[numUnica.selectedIndex].text;      
            var valida = ConsultarProcessoPJE(numeroP);
        }
        
        */
    });
    /*
    $( ".pje" ).click(function() {
        var numUnica = document.querySelector('#AcaoProcessoId')
        //local
        window.open( "http://"+window.location.host+"/pje/index/"+numUnica.options[numUnica.selectedIndex].text,'_blank')
        //produção
        //window.open( "https://"+window.location.host+"/pje/index/"+numUnica.options[numUnica.selectedIndex].text,'_blank')

    });
    
    $( ".bdpje" ).click(function() {
        var numUnica = document.querySelector('#AcaoProcessoId')
        //local
        window.open( "http://"+window.location.host+"/pje/index/"+numUnica.options[numUnica.selectedIndex].text,'_blank')
        //produção
        //window.open( "https://"+window.location.host+"/pje/index/"+numUnica.options[numUnica.selectedIndex].text,'_blank')
    });
    
    function ConsultarProcessoPJE(num){        

        var requestOptions = {
            method: 'GET',
            redirect: 'follow',
        };

        fetch("https://ws-dpe.defensoria.ba.def.br/integracao-pje-v2/api/v1/consultar-processo/"+num, requestOptions)
        .then(response => response.text())
        .then(result => { 
            setTimeout(() =>{ 
                if(JSON.parse(result).sucesso == true)
                $(".pje").show();             
            })    
        
        })
        .catch(error => console.log('error', error));
        
    }
    */
</script>
