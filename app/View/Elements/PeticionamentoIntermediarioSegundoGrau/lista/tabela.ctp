<table id="restelas" class="table table-bordered table-striped">
    <tr>
        <th>Nome do Assistido</th>
        <th>Nº Triagem</th>
        <th>Nº Processo</th>
        <th>Órgão Julgador Colegiado</th>
        <th>Órgão Julgador</th>
        <th>Data Limite da Manifestação mais próxima</th>
        <th>Quantidade de intimações</th>
        <th>Marcadores</th>
        <th>Status do Peticionamento</th>
        <th>Última Modificação</th>
        <th><?php echo $this->Form->checkBox('checkbox1', array('checked' => false)); ?></th>
        <th class="actions" colspan="3"><?php echo "Ações"; ?></th>
    </tr>
    <?php
    if(count($lista_peticoes) > 0):
        $i = 0;
        $hasAgendamento = false;
        foreach ($lista_peticoes as $item):
            $i++;
            $peticionamentoStatus = $item['PeticionamentoIntermediario']['status_peticionamento_intermediario_id'];
            if($peticionamentoStatus == 4) {
                $hasAgendamento = true;
            }
            ?>
            <tr 
                id="registro_<?php echo $item['PeticionamentoIntermediario']['id']; ?>" 
                <?php echo $peticionamentoStatus == 4 ? "style='background: #ffdf0026'" : ""; ?>
                class="<?php echo $peticionamentoStatus == 4 ? "peticionamento-agendado" : "" ?>"
            >
                <td>
                    <?php 
                        $assistidoNomePje = $item['PeticionamentoIntermediariosAssistidos']['assistido_nome_pje'];
                        if(isset($assistidoNomePje) && !empty($assistidoNomePje)){
                            echo "<a target = '_blank' href='/assistidos/extrato/". $item['Assistido']['id'] ."'><strong>SIGAD:</strong> " . $item['Pessoa']['nome'] . "<br/><strong>PJE: </strong>" . $assistidoNomePje . "</a>"; 
                        }else if(isset($item['Assistido']) && isset($item['Assistido']['id'])){
                            echo "<a target = '_blank' href='/assistidos/extrato/". $item['Assistido']['id'] ."'>" . $item['Pessoa']['nome'] . "</a>";
                        }else{
                            echo "Assistido não definido";
                        }
                    ?>
                </td>
                <td>
                    <?php echo "<a target = '_blank' href='/assistidos/extrato/". $item['Assistido']['id'] ."'>" . $item['Assistido']['numero_triagem'] . "</a>"; ?>
                </td>
                <td>
                    <a href="/pje/index/<?= $numero_processo = $item['Processo']['numeracao_unica']; ?>" title="<?= $numero_processo; ?>" target="_blank">
                        <?= $numero_processo; ?>
                    </a>
                </td>
                
                <td>
                    <?php echo $item['OrgaoColegiado']['nome_orgao']; ?>
                </td>
                <td>
                    <?php echo $item['OrgaoJulgador']['nome_orgao']; ?>
                </td>

                <td>
                    <?php 
                        $data = $item['PeticionamentoIntermediario']['data_limite_manifestacao'];
                        echo $data
                            ? date_format(date_create($data), 'd/m/Y')
                            : 'Sem Prazo';
                    ?>
                </td>
                <td><?php echo $item['PeticionamentoIntermediario']['total_intimacoes']; ?></td>
                <td>
                    <?php if(isset($item['Marcadores'])): ?> 
                        <?php foreach ($item['Marcadores'] as $chave => $valor): ?>

                            <div class="badge bg-primary text-wrap" style="background-color: <?= $valor['Cores']['hexadecimal'] ?>; color: <?= $valor['Cores']['cor_fonte'] ?>;"><?= $valor['Marcadores']['nome'] ?></div>
                    
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td> 
                <td>
                    <?php
                        $data_protocolo = isset($item['PeticionamentoIntermediario']['data_protocolo'])?$item['PeticionamentoIntermediario']['data_protocolo']:null;
                        $data_protocolo = is_null($data_protocolo)?'':' em '.date('d/m/Y', strtotime($data_protocolo));
                        $data_protocolo = $item['StatusPeticionamento']['nome']==="Protocolado"?$data_protocolo:"";
                        $item['StatusPeticionamento']['nome'].=$data_protocolo;
                    ?>
                    <?= $item['StatusPeticionamento']['nome'] ?>
                </td>
                <td>
                    <?php 
                        $data = $item['PeticionamentoIntermediario']['data_modificacao'];
                        echo $data
                            ? date_format(date_create($data), 'd/m/Y')
                            : 'N/A';
                    ?>
                </td>                               
                <td>
                    <?php 
                    if ($item['PeticionamentoIntermediario']['status_peticionamento_intermediario_id'] == "1" || $item['PeticionamentoIntermediario']['status_peticionamento_intermediario_id'] == "4") {
                        echo $this->Form->checkBox('checkbox_' . $item['PeticionamentoIntermediario']['id'], array('checked' => false, 'name' => 'item[]', 'onclick' => 'eventoSelecaoRegistro("' . $item['PeticionamentoIntermediario']['id'] . '")','value' => $item['PeticionamentoIntermediario']['id']));          
                    }
                    ?>  
                </td>
                <td class="actions">
                    <?php 
                        if($showBtnEditar && ($item['PeticionamentoIntermediario']['status_peticionamento_intermediario_id'] == "1" || $item['PeticionamentoIntermediario']['status_peticionamento_intermediario_id'] == "4")){
                            $itemEdit = $item['PeticionamentoIntermediario']['id'];
                            if($instancia == 2){
                                $itemEdit .= '?url_origem=consulta_processo_segundo_grau';
                            }
                            echo $this->Html->link($this->Html->div('fa fa-edit', '', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Editar petição')), array('action' => 'edit', $itemEdit), array('escape' => false, 'target' => '_blank')); 
                        }
                    ?>
                    <a href="visualizar_documentos/<?php echo $item['PeticionamentoIntermediario']['id']; ?>/consulta_processo_segundo_grau" data-toggle="tooltip" data-placement="right" title="Visualizar documentos">
                        <div class="fa fa-folder-open"></div>
                    </a>
                    <?php if($this->Session->read('isDefensor') && ($item['PeticionamentoIntermediario']['status_peticionamento_intermediario_id'] == "1" || $item['PeticionamentoIntermediario']['status_peticionamento_intermediario_id'] == "4")): ?>
                        <i class="fa fa-trash botao-acoes" aria-hidden="true" title="Excluir peticionamento" onclick="exibirPopupDeExclusao('<?php echo $item['PeticionamentoIntermediario']['id']; ?>')"></i>
                    <?php endif; ?>
                    <?php if($this->Session->read('isDefensor') && $item['PeticionamentoIntermediario']['status_peticionamento_intermediario_id'] === "2"): ?>
                        <?= $this->Html->link($this->Html->div('fa fa-download', '', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Baixar recibo')), array('action' => 'recibo_download', $item['PeticionamentoIntermediario']['id']),  array('escape' => false, 'target' => '_blank'));  ?>
                    <?php endif; ?>
                </td>
            </tr>
    <?php
        endforeach;
    else:
    ?>
    <tr>
        <th class="text-center" colspan="11"><?php echo "Nenhuma petição encontrada!"; ?></th>
    </tr>
    <?php
    endif;
    ?>
    <tr style="position: sticky;">
        <td id="infAviso" colspan="14" class="alert alert-success" style="position:relative; padding:14px"><?=$this->Paginator->counter(array('format' => '<strong>Página %page% de %pages%</strong>, exibindo %current% registros de um total de <strong>%count%</strong>, exibindo do registro %start% até o %end%'));?></td>
    </tr>
    <tr>
        <td id="paginAviso" colspan="4" style="vertical-align: middle;">
            <ul id="btn_navegacao" class="pagination" style="margin: 0px;">
                <li id="btnprev">
                    <?=$this->Paginator->prev(
                        '« ',
                        ['tag'   => false],
                        null,
                        ['class' => 'disabled']
                    )?>
                </li>
                <li id="btnnumbers">
                    <?=$this->Paginator->numbers(
                        [
                            'currentTag'    => 'span',
                            'separator'     => false,
                            'tag'           => false
                        ]);
                    ?>
                </li>
                <li id="btnnext">
                    <?=$this->Paginator->next(
                        '» ',
                        ['tag'   => false],
                        null,
                        ['class' => 'disabled']
                    )?>
                </li>
            </ul>
        </td>
    </tr>
</table>