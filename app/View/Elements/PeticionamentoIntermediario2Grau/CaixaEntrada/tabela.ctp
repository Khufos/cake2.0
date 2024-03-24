<div id="conteudoTabelaAviso">
    <h4>Avisos Pendentes PJE</h4>    
    <table id="tblExpedientePje" class="table table-bordered table-striped" style="margin-bottom: 0px;">
        <thead>
            <tr>
                <th style="vertical-align: middle;">Nome da parte</th>
                <th style="vertical-align: middle; text-align: center;">Nº do processo</th>
                <th style="vertical-align: middle; text-align: center;">Nº da intimação</th>
                <!-- <th style="vertical-align: middle; text-align: center;">Comarca</th> -->
                <th style="vertical-align: middle; text-align: center;">Orgão julgador colegiado</th>
                <th style="vertical-align: middle; text-align: center;">Status</th>
                <th style="vertical-align: middle; text-align: center;">Perfil PJE</th>
                <th style="vertical-align: middle; text-align: center;">Descrição do ato</th>
                <th style="vertical-align: middle; text-align: center;">Data de criação da intimação</th>
                <!-- <th style="vertical-align: middle; text-align: center;">Data de importação do expedição</th> -->
                <th style="vertical-align: middle; text-align: center;">Prazo</th>
                <th style="vertical-align: middle; text-align: center;">Data limite para ciência</th>
                <th style="vertical-align: middle; text-align: center;">Data limite para resposta</th>
                <!-- <th style="vertical-align: middle; text-align: center;">Marcadores</th> -->
                <!-- <th style="vertical-align: middle; text-align: center;">Data limite para ciência</th>
                <th style="vertical-align: middle; text-align: center;">Data limite para resposta</th> -->
                <th class = "classOcultar" style="vertical-align: middle; text-align: center;" colspan="6">Opção</th>
            </tr>
        </thead>
        <tbody id="corpoAvisoPend">
            <?php
                foreach ($avisoPendente as $key => $aviso) :?>
                    <tr>
                        <td style="vertical-align: middle;">
                            <p style='font-size: 12px; margin: 0px;'>
                                <b>SIGAD: </b><a href="/assistidos/extrato/<?=$aviso['ass']['id']?>" target="_blank"><?=$aviso['pass']['nome']?></a><br>
                                <b>PJE:   </b><?=$aviso['PjeAvisoPendentes']['destinatario_pje']?>
                            </p>
                        </td>
                        <td style="vertical-align: middle;">
                            <a class="numeroProcMask" href="/pje/index?numeracaoUnica=<?=$aviso['PjeAvisoPendentes']['processo_numeracao_unica']?>&urlOrigem=consulta_processo_segundo_grau" target="_blank"><?=$aviso['PjeAvisoPendentes']['processo_numeracao_unica']?></a></br>
                            <?php
                                if(isset($MarcadorSelec)){
                                    foreach ($MarcadorSelec as $key => $marcadores) :
                                        if($aviso['PjeAvisoPendentes']['id'] == $marcadores['map']['pje_aviso_pendente_id']){?>
                                            <div class="badge bg-primary text-wrap" style="background-color: <?=$marcadores['cor']['hexadecimal']?>; color: <?=$marcadores['cor']['cor_fonte']?>; margin-top: 5px;"><?=$marcadores['marc']['nome']?></div><?php
                                        }
                                    endforeach;
                                }
                            ?>
                        </td>
                        <td style="vertical-align: middle; text-align: center;"><?=$aviso['PjeAvisoPendentes']['id_aviso']; ?></td>
                        <!-- <td style="vertical-align: middle; text-align: center;"><?=utf8_encode($aviso['cmc']['nome']); ?></td>                         -->
                        <!-- <td style="vertical-align: middle;"><?=$aviso['atuc']['nome'];
                            if($aviso['mov']['tipo_movimentacao_id'] == 1){?><br>
                                <?php if($aviso['mov']['ciencia_automatica'] == 1){ ?>
                                    <i style='font-size: 11px;'>
                                        O Sistema PJE tomou ciência automática no dia <?=$this->Util->ddmmaaHis($aviso['mov']['data_movimentacao']);?>
                                    </i><?php
                                }else { ?>
                                    <i style='font-size: 11px;'>
                                        <?=$aviso['pssfunc']['nome']?> tomou ciência no dia <?=$this->Util->ddmmaaHis($aviso['mov']['data_movimentacao']);?>
                                    </i><?php 
                                }
                            }?>
                        </td> -->
                        <td style="vertical-align: middle;">
                            <?=$aviso['OrgaoColegiados']['nome_orgao'];?>
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            <?php 
                                if($aviso['PjeAvisoPendentes']['aviso_removido'] == '1'){
                                    echo "Intimação Removida";
                                }else{
                                    if($aviso['PjeAvisoPendentes']['aviso_respondido'] == '1'){
                                        echo "Respondido";
                                    }elseif($aviso['PjeAvisoPendentes']['aviso_respondido'] == '0' && $aviso['mov']['tipo_movimentacao_id'] == 1){
                                        echo "Pendente de Resposta";
                                    }else{
                                        echo "Pendente de Ciência";
                                    }
                                }
                            ?>
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            <?php 
                                if($aviso['PjeAvisoPendentes']['perfil_importacao'] == 'CUR'){
                                    echo "Curadoria Especial (CUR)";
                                }elseif($aviso['PjeAvisoPendentes']['perfil_importacao'] == 'NC'){
                                    echo "Núcleo de Contestação (NC)";
                                }elseif($aviso['PjeAvisoPendentes']['perfil_importacao'] == 'G'){
                                    echo "Geral (G)";
                                }
                            ?>
                        </td>
                        <td style="vertical-align: middle; text-align: center;"><?=utf8_encode($aviso['PjeAvisoPendentes']['descricao_ato']); ?></td>
                        <td style="vertical-align: middle; text-align: center;"><?=$this->Util->ddmmaaHis($aviso['PjeAvisoPendentes']['data_expedicao'])?></td>
                        <!-- <td style="vertical-align: middle; text-align: center;"><?=$this->Util->ddmmaaHis($aviso['PjeAvisoPendentes']['data_importacao'])?></td> -->
                        <td style="vertical-align: middle; text-align: center;"><?=$aviso['PjeAvisoPendentes']['prazo']; ?></td>
                        <td style="vertical-align: middle; text-align: center;"><?=$this->Util->ddmmaaHis($aviso['PjeAvisoPendentes']['data_limite_ciencia'])?></td>
                        <td style="vertical-align: middle; text-align: center;"><?=$this->Util->ddmmaaHis($aviso['PjeAvisoPendentes']['data_limite_resposta'])?></td>
                        <!-- <td style="vertical-align: middle; text-align: center;">
                            <?php if(count($aviso['marcador']) > 0): ?>
                                <?php foreach($aviso['marcador'] as $marcadores): ?>
                                    <div class="badge bg-primary text-wrap" style="background-color: <?=$marcadores['cor']['hexadecimal']?>; color: <?=$marcadores['cor']['cor_fonte']?>; margin-top: 5px;"><?=$marcadores['marc']['nome']?></div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </td> -->
                        <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><input type="checkbox" name="selecAviso[]" class="checkAviso" value="<?=$aviso['PjeAvisoPendentes']['id']?>,<?=$aviso['prc']['id']?>,<?=$aviso['atuc']['id']?>,<?=$aviso['PjeAvisoPendentes']['id_aviso']?>,<?=$aviso['PjeAvisoPendentes']['pje_descricao_ato_id']?>"></td><?php
                            if($aviso['mov']['tipo_movimentacao_id'] == 1){?>
                                <?php if($aviso['PjeAvisoPendentes']['aviso_removido'] == '0' && $aviso['PjeAvisoPendentes']['aviso_respondido'] == '0'):?>
                                    <td style="vertical-align: middle; text-align: center;"><a class="glyphicon glyphicon-share-alt" title="Responder" href="/PeticionamentoIntermediarios/edit?rota_anterior=/PjeController/index/<?=$aviso['PjeAvisoPendentes']['processo_numeracao_unica']?>&numeracao_unica=<?=$aviso['PjeAvisoPendentes']['processo_numeracao_unica']?>&idAvisoPje=<?=$aviso['PjeAvisoPendentes']['id']?>&url_origem=consulta_processo_segundo_grau" target="_blank"></a></td>
                                <?php endif; ?>
                                <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div style="cursor: pointer;" class="glyphicon glyphicon-eye-open" title="Visualizar Intimação" onclick="visualExpediente('<?=$aviso['PjeAvisoPendentes']['id_aviso']?>','<?=$_SERVER['REQUEST_URI']?>')"></div></td><?php
                            }
                            else{?>
                                <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div class="glyphicon glyphicon-search" style="cursor: pointer; background-color: red;color: white; padding: 2px 4px;" title="Tomar Ciência" onclick="tomarCiencia('<?=$aviso['PjeAvisoPendentes']['id']?>','<?=$aviso['prc']['id']?>','<?=$aviso['atuc']['id']?>','<?=$aviso['PjeAvisoPendentes']['id_aviso']?>','<?=$_SERVER['REQUEST_URI']?>',<?=$userAuth?>,<?=$aviso['PjeAvisoPendentes']['pje_descricao_ato_id']?>,<?= $idFunc ?>)"></div></td><?php
                            }?>
                        <?php if($aviso['PjeAvisoPendentes']['aviso_removido'] == 0){ ?>
                            <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div style="cursor: pointer;" class="glyphicon glyphicon-trash" title="Excluir Intimação" onclick="excluirAviso(<?=$aviso['PjeAvisoPendentes']['id']?>,'<?=$_SERVER['REQUEST_URI']?>')"></div></td>
                        <?php } ?>
                        <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div style="cursor: pointer;" class="glyphicon glyphicon-tags" title="Marcador" onclick="gerenciarMarcador(<?=$aviso['PjeAvisoPendentes']['id']?>,'<?=$_SERVER['REQUEST_URI']?>')"></div></td>                                                                     
                        <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div style="cursor: pointer;" class="glyphicon glyphicon-book" title="Mover para Grupo" onclick="moverParaGrupo(<?=$aviso['PjeAvisoPendentes']['id']?>)"></div></td>
                        <td class = "classOcultar" style="vertical-align: middle; text-align: center;"><div style="cursor: pointer;" class="glyphicon glyphicon-calendar" title="Movimentações" onclick="exibirHistorico(<?=$aviso['PjeAvisoPendentes']['id']?>)"></div></td>
                    </tr><?php
                endforeach;
            ?>
            <tr style="position: sticky;">
                <td id="infAviso" colspan="19" class="alert alert-success" style="position:relative; padding:14px"><?=$this->Paginator->counter(array('format' => '<strong>Página %page% de %pages%</strong>, exibindo %current% registros de um total de <strong>%count%</strong>, exibindo do registro %start% até o %end%'));?></td>
            </tr>
            <tr class = "classOcultar">
                <td id="paginAviso" colspan="8" style="vertical-align: middle;">
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
                <td colspan="3" style="vertical-align: middle; text-align: center;"><input type="checkbox" id="checkTodosExpediente"> Selecionar todas as intimações</td>
                <td colspan="8" style="vertical-align: middle;">
                    <label for="">Com os Itens Selecionados:</label>
                    <div class="input-group" style="margin-bottom: 0px;">
                        <select class="form-control" id="selecItem">
                            <option value="0">O que deseja fazer?</option>
                            <option value="1">Tomar Ciência</option>
                            <option value="2">Excluir Intimação</option>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="executarLote('<?= $idFunc ?>','<?=$userAuth?>','<?=$_SERVER['REQUEST_URI']?>')">Executar</button>
                        </span>
                    </div>
                </td>
            </tr>
            <script>
                const divNumber = document.getElementById("btnnumbers");
                for (child of divNumber.children){
                    url = child.href;
                    child.setAttribute("onclick", "atualizarPaginacao('"+url+"')");
                    child.removeAttribute("href");
                    child.removeAttribute("href");
                }
                const divPrev = document.getElementById("btnprev");
                for (child of divPrev.children){
                    url = child.href;
                    child.setAttribute("onclick", "atualizarPaginacao('"+url+"')");
                    child.removeAttribute("href");
                    child.removeAttribute("href");
                }
                const divNext = document.getElementById("btnnext");
                for (child of divNext.children){
                    url = child.href;
                    child.setAttribute("onclick", "atualizarPaginacao('"+url+"')");
                    child.removeAttribute("href");
                    child.removeAttribute("href");
                }

                var checados = [];
                $(".checkAviso").click(function(e) {
                    if ($(this).prop( "checked")){    
                        checados.push($(this).val());       
                    }
                    else{
                        checados.splice(checados.indexOf($(this).val()), 1);              
                    }
                });
                
                $("#checkTodosExpediente").click(function(){
                    checados = [];
                    $('.checkAviso').not(this).prop('checked', this.checked);
                    var exped = document.getElementsByClassName("checkAviso");
                    for(var i =0; i< exped.length; i++){
                        if ($(exped[i]).prop( "checked")){ 
                            checados.push($(exped[i]).val()); 
                        }
                    }
                }); 
            </script>
        </tbody>
    </table>
</div>

<!-- JS: Variaveis que são atualizadas conforme a pesquisa -->
<script id='variaveisJs' type='text/javascript' >
    var listaAvisoPendente = JSON.parse(JSON.stringify(<?=json_encode($avisoPendente)?>));
</script>