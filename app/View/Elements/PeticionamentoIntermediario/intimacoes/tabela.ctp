<div class="container-fluid">
    <table id="tabela-intimacoes" class="table table-bordered">
        <tr>
            <th class="text-center">Selecione</th>
            <th class="text-center">Número</th>
            <th class="text-center">Destinatário</th>
            <th class="text-center">Data de Expedição da Intimação</th>
            <th class="text-center">Data limite de manifestação</th>
            <th class="text-center">Status do prazo</th>
            <th class="text-center">Opção</th>
        </tr>
        <?php foreach($intimacoes as $intimacao): ?>
            <?php 
                $tooltipSiglaPerfil = "";
                if(isset($intimacao['PjeAvisoPendentes']['perfil_importacao'])){
                    $tooltipSiglaPerfil = "G - Geral";
                    if($intimacao['PjeAvisoPendentes']['perfil_importacao'] == "NC"){
                        $tooltipSiglaPerfil = "NC - Núcleo de Contestação";
                    }elseif($intimacao['PjeAvisoPendentes']['perfil_importacao'] == "CUR"){
                        $tooltipSiglaPerfil = "CUR - Curadoria";
                    }                                    
                }
            ?>

            <tr>
                <td class="text-center"><?php
                    $intimacaoId = $intimacao['PjeAvisoPendentes']['id'];
                    echo $this->Form->checkbox("intimacao.$intimacaoId", [
                        'value' => 1,
                        'disabled' => $intimacao['Movimentacoes']['tipo_movimentacao_id'] != 1,
                        'checked' => !is_null($intimacao['PjeAvisoPendentesPeticionamentoIntermediarios']['id']) 
                    ]);
                ?>
                </td>
                <td class="text-center" title="<?php echo $tooltipSiglaPerfil; ?>">
                    <?php 
                        if(isset($intimacao['PjeAvisoPendentes']['perfil_importacao'])){
                            echo "(" . $intimacao['PjeAvisoPendentes']['perfil_importacao'] . ") " . $intimacao['PjeAvisoPendentes']['id_aviso'];
                        }else{
                            echo $intimacao['PjeAvisoPendentes']['id_aviso'];
                        }
                    ?>
                </td>
                <td class="text-center">
                    <?php 
                        if(isset($intimacao['PjeAvisoPendentes']['destinatario_pje'])){
                            $destinatarioTemp = $intimacao['PjeAvisoPendentes']['destinatario_pje'];
                            $destinatarioTemp = mb_strtolower($destinatarioTemp, 'UTF-8');
                            $destinatarioTemp = ucwords($destinatarioTemp);
                            echo $destinatarioTemp;
                        }else{
                            echo "Não definido";
                        }
                    ?>
                </td>
                <td class="text-center"><?php echo $this->Time->format($intimacao['PjeAvisoPendentes']['data_expedicao'], '%d/%m/%Y'); ?></td>
                <td class="text-center"><?php 
                    echo $intimacao['Movimentacoes']['tipo_movimentacao_id'] == 1 
                        ? $this->Time->format($intimacao['PjeAvisoPendentes']['data_limite_resposta'], '%d/%m/%Y')
                        : $this->Time->format($intimacao['PjeAvisoPendentes']['data_limite_ciencia'], '%d/%m/%Y');
                    ?>
                </td>
                <td class="text-center"><?php 
                    $dataAtual = new DateTime();
                    $dataAlvo = $intimacao['Movimentacoes']['tipo_movimentacao_id'] == 1 
                        ? new DateTime($intimacao['PjeAvisoPendentes']['data_limite_resposta'])
                        : new DateTime($intimacao['PjeAvisoPendentes']['data_limite_ciencia']);
                    
                    echo $dataAtual > $dataAlvo
                        ? 'Vencido'
                        : 'Em curso';
                    ?></td>
                <?php if($intimacao['Movimentacoes']['tipo_movimentacao_id'] == 1): ?>
                    <td class="text-center">
                        <div 
                            style="cursor: pointer;" 
                            class="glyphicon glyphicon-eye-open" 
                            title="Visualizar Expediente"
                            onclick="visualExpediente(
                                '<?php echo $intimacao['PjeAvisoPendentes']['id_aviso']; ?>', null, false
                            )"></div>
                    </td>
                <?php else: ?>
                    <td class="text-center">
                        <div 
                            class="glyphicon glyphicon-search" 
                            style="cursor: pointer; background-color: red;color: white; padding: 2px 4px;" 
                            title="Tomar Ciência"
                            onclick="tomarCienciaSigad(
                                '<?php echo $intimacao['PjeAvisoPendentes']['id']; ?>',
                                '<?php echo $intimacao['PjeAvisoPendentes']['processo_id']; ?>',
                                '<?php echo $intimacao['PjeAvisoPendentes']['id_aviso']; ?>',
                                '<?php echo $_SERVER['REQUEST_URI']; ?>',
                                <?php echo $userAuth; ?>,
                                <?php echo $intimacao['PjeAvisoPendentes']['pje_descricao_ato_id']; ?>,
                                <?php echo $idFunc; ?>
                            )"></div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>