<script type="text/javascript">
    $(document).ready(function () {
        $("#tipoDoc").change(function () {
            /*Verifica se o tipo do documento escolhido é CPF*/
            if ($(this).val() == 102) {
                $("#FiltroDocumento").addClass("cpf");
            } else {
                $("#FiltroDocumento").removeClass("cpf").unmask();
            }
            refreshJquery();
        });

        var tipoPessoa = $('#PessoaTipo').val();
        if (tipoPessoa !== 'F') {
            var form = $("#formAssitido");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller' => 'assistidos', 'action' => 'filtro', '?' => array('trs' => 1))) ?>",
                data: form.serialize(),
                success: function (response) {
                    $('#filtro').html(response);
                }
            });
        }
		var tamanho = 15;
        $("#FiltroTriagem").keyup(function (valor) {
            var Valor = $("#FiltroTriagem").val();
            var regx = "/[^0-9]/g";
            Valor = Valor.replace(eval(regx), '');
            if(Valor.length <= tamanho){
            
             return $("#FiltroTriagem").val(Valor);
            }else{
            alert('Tamanho Máximo: '+tamanho+' Caracteres!');
             return $("#FiltroTriagem").val('');
            }
           
      
        });

        
       //$('#FiltroTriagem').mask('000000000000000'); 
       $('#TipoAtendimentoId').select2();
       $('#tipoDoc').select2();
       $('#FiltroCidadeId').select2();
       $('#FiltroUnidadeDefensorialId').select2();
       $('#PessoaTipo').select2();

        $("input[name='data[Filtro][mostrar_assis_pesquisados]']").click(function(){

            var valor = $("input[name='data[Filtro][mostrar_assis_pesquisados]']:checked"). val();

            if(valor == 1){
                
                //$("#PessoaTipo").prop("disabled", true);
                $("#TipoAtendimentoId").prop("disabled", true);
                $("#FiltroTriagem").prop("disabled", true);
                $("#FiltroNascimento").prop("disabled", true);
                $("#FiltroCidadeId").prop("disabled", true);
                $("#FiltroUnidadeDefensorialId").prop("disabled", true);
                $("#FiltroNome").prop("disabled", true);
                $("#FiltroNomeMae").prop("disabled", true);
                $("#FiltroNomePai").prop("disabled", true);
                $("#tipoDoc").prop("disabled", true);
                $("#FiltroDocumento").prop("disabled", true);
                $("#FiltroNumeracaoUnica").prop("disabled", true);

            }else{
               // $("#PessoaTipo").prop("disabled", false);
                $("#TipoAtendimentoId").prop("disabled", false);
                $("#FiltroTriagem").prop("disabled", false);
                $("#FiltroNascimento").prop("disabled", false);
                $("#FiltroCidadeId").prop("disabled", false);
                $("#FiltroUnidadeDefensorialId").prop("disabled", false);
                $("#FiltroNome").prop("disabled", false);
                $("#FiltroNomeMae").prop("disabled", false);
                $("#FiltroNomePai").prop("disabled", false);
                $("#tipoDoc").prop("disabled", false);
                $("#FiltroDocumento").prop("disabled", false);
                $("#FiltroNumeracaoUnica").prop("disabled", false);
            }
        });

        

    });

</script>
<div class="well">
    <?php echo $this->Form->create('precadastro', array('id' => 'formAssitido')); ?>
    <legend><?php echo __('Localizar'); ?></legend>
    <?php if ($selecaoTipoPessoa) { ?>
    <div class="row">
        <div class="col-xs-6 col-md-4">
            <div class="form-group">
                <label>Tipo de Pessoa:</label>
                    <?php
                    echo $this->Form->input('Pessoa.tipo', array(
                        'options' => $tipoPessoa,
                        'class' => 'form-control input-sm',
                        'selected' => $tipo,
                        'label' => false
                            )
                    );
                    $camposLi = "resPesquisa";
                    $this->Js->get('#PessoaTipo')->event('change', $this->Js->request(
                                    array(
                                'controller' => 'assistidos',
                                'action' => 'filtro?trs=1'
                                    ), array(
                                'complete' => 'refreshJquery();',
                                'before' => "limpaCampos('" . $camposLi . "');",
                                'async' => true,
                                'dataExpression' => true,
                                'data' => $this->Js->serializeForm(
                                        array(
                                            'isForm' => true,
                                            'inline' => true
                                        )
                                ),
                                'update' => '#filtro',
                                'method ' => 'POST'
                                    )
                    ));
                    ?>
            </div>
        </div>
        <div class="col-xs-6 col-md-4">
            <div class="form-group">                    
                <label>Especializada:</label>
                    
                    <select name="data[TipoAtendimento][id]" class="form-control input-sm" id="TipoAtendimentoId">
                        <option value="<?= $idEspecializada ?>">FUNDIÁRIO</option>
                        <option value="0">TODAS</option>
                    </select>
                           
            </div>
        </div>
        <div class="col-xs-6 col-md-4">
            <div class="form-group" id="assistidosUltimo">
                <label>Buscar os últimos assistidos atendidos por mim?</label><br/>
                <?php 
                    //echo $this->Form->checkbox('Filtro.mostrar_assis_pesquisados');
                    echo $this->Form->radio('Filtro.mostrar_assis_pesquisados', 
                        array(1 => 'SIM', 0 => 'Trazer todos os registros'), 
                        array('legend' => false, 'separator' => '&nbsp;&nbsp;', 'default' => 0)
                    ); 
                ?>    
            </div>
        </div>
    </div>
        <?php
    } else {
        echo $this->Form->hidden('Pessoa.tipo', array('value' => $tipo));
    }
    ?>
    <div id="filtro">
        <?php if ($tipo == 'F') { ?>
        <div class="row">
            
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Triagem:</label>
                        <?php echo $this->Form->text('Filtro.triagem', array('class' => 'form-control input-sm')); ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Nome do Assistido:</label>
                        <?php
                        echo $this->Form->text('Filtro.nome', array('id' => 'FiltroNome', 'class' => 'form-control input-sm'));
                        echo $this->Jmycake->autocomplete('FiltroNome', 'Pessoa/nome', 'assistidos', 'formAssitido');
                        ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Nome da Mãe:</label>
                        <?php
                        echo $this->Form->text('Filtro.nome_mae', array('id' => 'FiltroNomeMae', 'class' => 'nome form-control input-sm'));
                        //echo $this->Jmycake->autocomplete('FiltroNomeMae', 'PessoaFisica/nome_mae', 'assistidos', 'formAssitido');
                        ?>
                </div>
            </div>           
            
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Unidade Defensorial:</label>                       
                    <?php
                       echo $this->Form->input('Filtro.unidade_defensorial_id', array(
                            'options' => $unidadesDefensorias,
                            'class' => "form-control input-sm",
                            'empty' => 'TODAS',
                            'label' => false
                        ));

                       //---------------------------------------- AJAX

                        $this->Js->get('#FiltroUnidadeDefensorialId')->event('change', $this->Js->request(
                                        array(
                                    'controller' => 'atuacoes_unidade_defensoriais',
                                    'action' => "buscaAtuacaoUnidade/?trs=1"
                                        ), array(
                                    'async' => true,
                                    'dataExpression' => true,
                                    'data' => $this->Js->serializeForm(
                                            array(
                                                'isForm' => true,
                                                'inline' => true
                                            )
                                    ),
                                    'update' => '#FiltroAtuacaoId',
                                    'method ' => 'POST'
                                        )
                        ));
                        ?>                    
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Unidade Judiciária:</label>                       
                    <?php
                       echo $this->Form->input('Filtro.atuacao_id', array(
                            'options' => $atuacoes,
                            'class' => "form-control input-sm",
                            'empty' => 'TODAS',
                            'label' => false
                        ));
                    ?> 
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Área ZEIS:</label>                       
                    <?php
                       echo $this->Form->input('Filtro.area_zeis_id', array(
                            'options' => $areaszeis,
                            'class' => "form-control input-sm",
                            'empty' => 'TODAS',
                            'label' => false
                        ));
                    ?>

                </div>
            </div> 
            
            
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Tipo de Documento:</label>
                        <?php echo $this->Form->select('Filtro.tipoDoc', $tipoDoc, array("id" => "tipoDoc", 'class' => "form-control input-sm")) ?>
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Documento de identificação:</label>
                        <?php echo $this->Form->text('Filtro.documento', array('class' => 'form-control input-sm')) ?>
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label> Número do Processo:</label>
                        <?php
                        echo $this->Form->text('Filtro.numeracao_unica', array('class' => "form-control input-sm num_unica"));
                        ?>
                </div>
            </div>
        </div>
        <h4 style="font-size: 12px; color: red;">Evite duplicidade! Priorize o filtro "Documento de identificação" para localizar com maior precisão.</h4>

        <?php } elseif ($tipo == 'J') { ?>
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Triagem:</label>
                        <?php echo $this->Form->text('Filtro.triagem', array('class' => 'form-control input-sm')) ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Razão Social:</label>
                        <?php
                        echo $this->Form->text('Filtro.nome', array('class' => 'nome form-control input-sm'));
                        echo $this->Jmycake->autocomplete('FiltroNome', 'Pessoa/nome', 'assistidos', $formulario);
                        ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>CNPJ:</label>
                        <?php echo $this->Form->text('Filtro.cnpj', array('class' => 'cnpj form-control input-sm')) ?> 
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label> Número do Processo:</label>
                        <?php
                        echo $this->Form->text('Filtro.numeracao_unica', array('class' => "form-control input-sm num_unica"));
                        ?>
                </div>
            </div>
             </div>
        <h4 style="font-size: 12px; color: red;">Evite duplicidade! Priorize o filtro "Documento de identificação" para localizar com maior precisão.</h4>
        <?php } elseif ($tipo == 'C') { ?>
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Triagem:</label>
                        <?php echo $this->Form->text('Filtro.triagem') ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Nome do Grupo:</label>
                        <?php
                        echo $this->Form->text('Filtro.nome', array('id' => 'nomeC', 'class' => 'nome form-control input-sm'));
                        echo $this->Jmycake->autocomplete('nomeC', 'Pessoa/nome', 'assistidos', 'formAssitido');
                        ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Declarante:</label>
                        <?php echo $this->Form->text('Filtro.representante', array('class' => 'form-control input-sm')); ?>   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Unidade Defensorial:</label>                       
                    <?php
                       echo $this->Form->input('Filtro.unidade_defensorial_id', array(
                            'options' => $unidadesDefensorias,
                            'class' => "form-control input-sm",
                            'empty' => 'TODAS',
                            'label' => false
                        ));

                       //---------------------------------------- AJAX

                        $this->Js->get('#FiltroUnidadeDefensorialId')->event('change', $this->Js->request(
                                        array(
                                    'controller' => 'atuacoes_unidade_defensoriais',
                                    'action' => "buscaAtuacaoUnidade/?trs=1"
                                        ), array(
                                    'async' => true,
                                    'dataExpression' => true,
                                    'data' => $this->Js->serializeForm(
                                            array(
                                                'isForm' => true,
                                                'inline' => true
                                            )
                                    ),
                                    'update' => '#FiltroAtuacaoId',
                                    'method ' => 'POST'
                                        )
                        ));
                        ?>                    
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Unidade Judiciária:</label>                       
                    <?php
                       echo $this->Form->input('Filtro.atuacao_id', array(
                            'options' => $atuacoes,
                            'class' => "form-control input-sm",
                            'empty' => 'TODAS',
                            'label' => false
                        ));
                    ?> 
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Área ZEIS:</label>                       
                    <?php
                       echo $this->Form->input('Filtro.area_zeis_id', array(
                            'options' => $areaszeis,
                            'class' => "form-control input-sm",
                            'empty' => 'TODAS',
                            'label' => false
                        ));
                    ?>

                </div>
            </div> 
            
            
        </div>
        <?php } ?>
    </div>    
    
    <div class="row">
        <div class="col-md-12">
            <?php
            $this->Util->setaValorPadrao($action, 'campos');
            echo $this->Js->submit('Pesquisar', array(
                'class' => 'btn btn-primary',
                'div' => false,
                'url' => array('action' => "pesquisar/$opcoesListagem/$action?trs=1", 'controller' => 'fundiarios', 'plugin' => null),
                'update' => '#resPesquisa')
            );
            echo $this->Form->button($this->Html->div('glyphicon glyphicon-repeat', '').' Limpar Filtro', array('type' => 'reset', 'class' => 'btn btn-default'));
            ?>
        </div>
    </div>

</div>
<div id="resPesquisa"></div>
