<div id="reslogado">
    <?php echo $this->Form->create('Usuario', array('id' => 'formUsuario')); ?>
    <table style="margin-top: 20px;">        
        <tr>
            <td>
                <span class="label">
                    Tipo de Funcionário:
                </span>
            </td>
            <td>
                <?php 
                echo $this->Form->select('Filtro.tipo_funcionario', $tipoFunc);
                unset($load);
                $load = $ajax->observeField('FiltroTipoFuncionario',
                        array(
                        'class' => 'direita',
                        'loading' => 'lc.start(request)',
                        'complete' => 'lc.stop(request);',
                        'update' => 'reslogado',
                        'url' => array('action' => 'logados?trs=1')
                        )
                );
                echo $load;
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label direita">
                    Comarca:
                </span>
            </td>
            <td>
                <?php 
                echo $this->Form->select('Filtro.comarca_id', $comarcas);

                unset($load);
                $load = $ajax->observeField('FiltroComarcaId',
                        array(
                        'class' => 'direita',
                        'loading' => 'lc.start(request)',
                        'complete' => 'lc.stop(request);',
                        'update' => 'reslogado',
                        'url' => array('action' => 'logados?trs=1')
                        )
                );
                echo $load;
           
                echo $ajax->observeField('FiltroComarcaId',
                        array(
                        'class' => 'direita',
                        'loading' => 'lc.start(request)',
                        'complete' => 'lc.stop(request);',
                        'update' => 'FiltroUnidadeId',
                        'url' => array(
                            'controller'=>'comarcas',
                            'action' => 'buscaComarcaUnidade?trs=1'
                        )
                    )
                );               
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label direita">
                    Unidade:
                </span>
            </td>
            <td>
                <?php 
                echo $this->Form->select('Filtro.unidade_id','','','','Selecione a comarca');               
                echo $ajax->observeField('FiltroUnidadeId',
                        array(
                        'class' => 'direita',
                        'loading' => 'lc.start(request)',
                        'complete' => 'lc.stop(request);',
                        'update' => 'reslogado',
                        'url' => array('action' => 'logados?trs=1')
                        )
                );             
                ?>
            </td>
        </tr>
        <tr>            
            <td>
                <?php

                echo $ajax->link($this->Html->image('atualizar.png', array('border' => 0)), array('action' => $action),
                array(
                'loading' => 'lc.start(request)',
                'complete' => 'lc.stop(request);refreshJquery();',
                'update' => 'reslogado',
                'with' => "Form.serialize( $('formUsuario') )"
                ), null, false
                );

                ?>
            </td>
        </tr>
    </table>

    <fieldset>
        <!--
        <legend style="font-weight: normal;">
            <?php
            $contador = count($usuarioLogados);
            ?>            
        </legend>
        -->
     <legend id="qtdUsuarios"></legend>
        <?php if ($contador > 0) {
            ?>
        <div style=" overflow-y:scroll; width: auto; max-height: 500px;
             text-align: center; float: left; clear: both;border: 3px solid #869378;
             border-right: none;">
            <table border="1" style="margin-top: 20px;" class="borda cabecalhoRel">
                <th>COMARCA</th>
                <th>POSTO DE ATENDIMENTO</th>
                <th>USUÁRIOS LOGADOS</th>
                <th>ÚLTIMA AÇÃO</th>
                <th>TIPO DE FUNCIONÁRIO</th>
                    <?php
                    $i = 0;
                    $c = -1;
                    $contador = 0;
                    //FireCake::info($usuarioLogados, "\$usuarioLogados");
                    foreach ($usuarioLogados as $key => $value) {
                        $c++;                        
                        $class = null;
                        if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                        }
                        $ultimasAcoes = $value['Registro']['ultimas_acoes'];
                        $idPessoa = $value['Registro']['pessoa_id'];
                        if($value['Registro']['ultimas_acoes'][0]['acao'] != "logout"){ // Se a ultima ação do usuário for diferente de "logout" ele não exibe mais o usuário
                        ?>
                <tr <?php echo $class; ?> >
                    <td style="text-align: center; padding: 5px">
                        <span class="label">
                            <?php echo $value['Comarca']['nome'] ?>
                        </span>
                    </td>
                    <td style="text-align: center; padding: 5px">
                        <span class="label">
                            <?php echo $util->setaValorPadrao($value['Unidade']['nome']); ?>
                        </span>
                    </td>
                    <td style="text-align: center; padding: 5px">
                        <span class="label">
                            <a id="p<?php echo $idPessoa; ?>" title="Clique aqui para visualisar as 5 ultimas ações deste usuário"><?php echo strtoupper($value['Registro']['nome']); ?></a>
                        </span>
                    </td>
                    <td style="text-align: center; padding: 5px">
                        <span class="label">
                                    <?php echo $value[0]['hora'] . ' h' ?>
                        </span>
                    </td>
                    <td style="text-align: center; padding: 5px">
                        <span class="label">
                                    <?php echo $value['Registro']['tipo_funcionario'] ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align="center">
                        <div style="display:none;" id="detalhes<?php echo $idPessoa ?>">
                            <table border="1" style="border-style: solid; border-width: 1px; border-collapse: collapse; margin-top: 15px; margin-bottom: 15px; width: 100%;">
                                <th>
                                    TELA ACESSADA
                                </th>
                                <th>
                                    AÇÃO
                                </th>
                                <th>
                                    HORÁRIO DA AÇÃO
                                </th>
                                <th>
                                    IP
                                </th>
                                        <?php
                                        $flag = true;
                                        foreach ($ultimasAcoes as $k => $v) {
                                            if($flag){                                                
                                                $contador ++;
                                                $flag = false;
                                            }
                                        ?>
                                <tr>
                                    <td>
                                        <span class="label">
                                                        <?php echo $v['tela']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="label">
                                                        <?php echo $v['acao']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="label">
                                                        <?php echo $v['hora']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="label">
                                                        <?php echo $v['ip']; ?>
                                        </span>
                                    </td>
                                </tr>
                                            <?php } ?>
                            </table>
                        </div>
                    </td>
                </tr>
                <script type="text/javascript">
                    jQuery("#p<?php echo $idPessoa ?>").click(function () {
                        jQuery("#detalhes<?php echo $idPessoa ?>").slideToggle("fast");;
                    });
                </script>

                    <?php }
                    }
                    ?>
            </table>
        </div>
        <span class="esquerda hide" id="spanResultado">Existe(m) <b>[<?php echo $contador; ?>]</b> usuário(s) logado(s) no SIGAD</span>
            <?php } ?>
    </fieldset>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#qtdUsuarios').append(jQuery('#spanResultado').text());
    });
</script>