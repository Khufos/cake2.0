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

    });
</script>
<div class="well">
    <?php echo $this->Form->create('precadastro', array('id' => 'formAssitido')); ?>
    <legend><?php echo __('Localizar'); ?></legend>
    <?php if ($selecaoTipoPessoa) { ?>
    <div class="row">
        <div class="col-xs-6 col-md-3">
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
                                'action' => 'busca?trs=1'
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
        
    </div>
        <?php
    } else {
        echo $this->Form->hidden('Pessoa.tipo', array('value' => $tipo));
    }
    ?>
    <div id="filtro">
        <?php if ($tipo == 'F') { ?>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="form-group">
                    <label>Nome do Assistido:</label>
                        <?php
                        echo $this->Form->text('Filtro.nome', array('id' => 'FiltroNome', 'class' => 'nome form-control input-sm'));
                        echo $this->Jmycake->autocomplete('FiltroNome', 'Pessoa/nome', 'assistidos', 'formAssitido');
                        ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="form-group">
                    <label>Tipo de Documento:</label>
                        <?php echo $this->Form->select('Filtro.tipoDoc', $tipoDoc, array("id" => "tipoDoc", 'class' => "form-control input-sm")) ?>
                </div>
            </div>

            <div class="col-xs-6 col-md-3">
                <div class="form-group">
                    <label>Documento de identificação:</label>
                        <?php echo $this->Form->text('Filtro.documento', array('class' => 'form-control input-sm')) ?>
                </div>
            </div>
        </div>
        

        <?php } elseif ($tipo == 'J') { ?>
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <label>Razão Social:</label>
                        <?php
                        echo $this->Form->text('Filtro.nome', array('class' => 'nome form-control input-sm'));
                        echo $this->Jmycake->autocomplete('FiltroNome', 'Pessoa/nome', 'assistidos', $formulario);
                        ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="form-group">
                    <label>CNPJ:</label>
                        <?php echo $this->Form->text('Filtro.cnpj', array('class' => 'cnpj form-control input-sm')) ?> 
                </div>
            </div>
        </div>
        <?php } elseif ($tipo == 'C') { ?>
        <div class="row">
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
        <?php } ?>
    </div>    
    <h4 style="font-size: 12px; color: red;">Evite duplicidade! Priorize o filtro "Documento de identificação" para localizar com maior precisão.</h4>
    <div class="row">
        <div class="col-md-12">
            <?php 
            $this->Util->setaValorPadrao($action, 'campos');
            echo $this->Js->submit('Pesquisar', array(
                'class' => 'btn btn-primary',
                'div' => false,
                'url' => array('action' => "buscar/$opcoesListagem/$action?trs=1", 'controller' => 'assistidos', 'plugin' => null),
                'update' => '#resPesquisa')
            );
            echo $this->Form->button($this->Html->div('glyphicon glyphicon-repeat', '').' Limpar Filtro', array('type' => 'reset', 'class' => 'btn btn-default'));
            ?>
        </div>
    </div>

</div>
<div id="resPesquisa"></div>
