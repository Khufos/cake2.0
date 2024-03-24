<script type="text/javascript">
    var key = <?php echo!empty($qtdPartes) ? $qtdPartes : 0 ?>;
    $(document).ready(function () {
        $("body").delegate('select.grau_parentesco', 'change', function () {
            /*Verifica se o outro*/
            if ($(this).val() === 20) {
                $(this).next("input.outro_grau_parentesco").show();
            } else {
                $(this).next("input.outro_grau_parentesco").hide();
            }
        });

        $(".tipo_documento").change(function () {
            /*Verifica se o tipo do documento escolhido é CPF*/
            if ($(".tipo_documento").val() == 102) {
                $(".doc").addClass("cpf");
            } else {
                $("body").live(".button").delegate("click", function () {
                    $("#btnPesquisar").click();
                });
            }
        });

        $("body").delegate('.remove-btn', 'click', function () {
            key = key - 1;
            $(this).parent().parent().parent().remove();
        });

        $("#btnPesquisar").click(function () {
            $.ajax({
                type: "POST",
                url: '<?php echo $this->webroot; ?>' + 'pessoas/verificaEntradaDefensoria/PES/0?trs=1',
                data: $("#Parte0Nome").serialize(),
                success: function (data) {
                    $("#resEntradaDPE").html(data);
                },
                complete: function () {
                    refreshJquery();
                }
            });
        });

        
    });

    function adicionarParteJuridica(id, nome, nomeFantasia, cnpj) {
        $('#selDadosParte').after("<table class='table table-bordered table-striped' id='tblRelPartes'>    <tr> \n\
                <input type = 'hidden' name='data[Parte][" + key + "][pessoa_id]' value='" + id + "'> \n\
                <th> Razão Social </th> <th> Nome Fantasia </th> <th> CNPJ </th> <th> Opções </th> </tr>   <tr align='center'> \n\
                    <td>" + nome + "</td> <td>" + nomeFantasia + "</td> <td class='noPrint' align='center'>" + cnpj + "</td>\n\
                <td> <input type = 'button' class='remove-btn btn btn-default' value='remover'></td>     \n\
                </tr> \n\
                     </table>");
//        $('#selDadosParte').after("<div class='col-md-12'><div class='row well well-sm'><div class='col-md-3'><div class='form-group'> \n\
//                                            <input type = 'hidden' name='data[Parte][" + key + "][pessoa_id]' value='" + id + "'> \n\
//                                            <input class='form-control input-sm' type = 'text' size='52' disabled='disabled'  value = '" + nome + "'></div></div>\n\
//                                          <div class='col-md-3'><div class='form-group'> \n\
//                                           <input type = 'button' class='remove-btn btn btn-default' value='remover'></div></div>\n\
//                                        </div></div>");


        key = key + 1;
    }

    function excluirParte(id, model) {
        var options = {percent: 0};
        var efeito = "blind";

        $.ajax({
            url: "<?= $this->Html->url(array('controller' => 'partes', 'action' => 'excluirParteContraria', '?' => array('trs' => 1)), true) ?>",
            type: 'POST',
            data: {"data": [{"id": id, "model": model}]},
            success: function (data) {
                $("#field" + id + "").hide(efeito, options, 1000, "callback");
                key = key - 1;
            }
        });
    }

    /* Id -> IdPessoa, nome -> Nome da Pessoa */
    function adicionarParte(id, nome) {
        $('#selDadosParte').after("<div class='col-md-12'><div class='row well well-sm'><div class='col-md-3'><div class='form-group'> \n\
                                            <input type = 'hidden' name='data[Parte][" + key + "][pessoa_id]' value='" + id + "'> \n\
                                            <input class='form-control input-sm' type = 'text' size='52' disabled='disabled'  value = '" + nome + "'></div></div><div class='col-md-3'><div class='form-group'> \
<?php echo $this->params['controller'] == 'idosos' ? 'Grau de Relação:' : 'Grau de Parentesco:'; ?> \n\
                                            </div></div><div class='col-md-3'><div class='form-group'><select class='grau_parentesco form-control input-sm' name='data[Parte][" + key + "][grau_parentesco]' id='GrauParentesto" + key + "'>\n\
                                            <option value=''> Selecione </option>\n\
<?php
if(isset($optionsGrauParentesco)){
foreach ($optionsGrauParentesco as $chave => $valor) {
    echo "<option value=" . $chave . "> $valor </option> "
    ?>\n\
<?php } }?>\n\
                                            </select>\n\
                                           <input type = 'text' class='outro_grau_parentesco' size='20' name='data[Parte][" + key + "][grau_parentesco_outro]'></div></div><div class='col-md-3'><div class='form-group'> \n\
                                           <input type = 'button' class='remove-btn btn btn-default' value='remover'></div></div>\n\
                                        </div></div>");
        $(".outro_grau_parentesco").hide();
        key = key + 1;
    }
</script>
<style type="text/css">
    #selDadosParte{
        list-style-type:none; 
    }    
</style>

<div id="partes">
    <div class="form-parte row">              
        <div class="col-lg-6">
            <div class="input-group">
                <?php
                echo $this->Form->text('Parte.0.nome', array('class' => 'nome form-control', 'placeholder' => 'Nome'));
                ?>
                <span class="input-group-btn">
                    <?php
                    echo $this->Form->button("Pesquisar", array('class' => 'btn btn-default', 'id' => 'btnPesquisar', 'escape' => false, 'type' => 'button'));
                    ?>
                </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="quebra"></div> <!-- Quebra a linha -->      
    </div>

    <div class="oculto" id="idEntradas" >
        <div id="resCadastroPessoa"></div>
        <div id="resEntradaDPE"></div>
    </div>
    <br/>
    <span id="selDadosParte">
        <?php echo $this->element('listar_partes', array('partes' => $this->Util->setaValorPadrao($partes, null) )); ?>
    </span>
    <div class="clearfix"></div>
</div> 