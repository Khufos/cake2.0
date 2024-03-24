<script type="text/javascript">
    $(document).ready(function () {
//        $("#opener").click(function () {
//            showContentModal(250, 680, '#dialog', 'Histórico', '#opener');
//        });

        $(".btnModeloRecurso").click(function () {
            $("#nowLoading").ajaxStart(function () {
                $(this).css("z-index", 99999);
                $(this).show();
            });

            var index = $(this).attr("index");
            var controller = $(this).attr("controller");
            $.ajax({
                url: "<?php echo $this->webroot ?>documentos/addDoc/<?php echo $idForm ?>/Recurso/" + controller + "?trs=1&index=" + $(this).attr("index"),
                type: "POST",
                data: $("#<?php echo $idForm ?>").serializeArray(),
                success: function (data) {
                    $("#RecursoContent" + index).empty().html(data).show();
                }
            });

            $("#nowLoading").ajaxStop(function () {
                $(this).hide();
            });
        });
    });
</script>
<div id="recursos">
    <?php
    $tipoRecursos = $this->Session->read('tipoRecursos');
    $tpResultRecurso = $this->Session->read('tpResultRecurso');
    FireCake::info($recursos, "\$recursos");
    if (!empty($recursos)) {
        foreach ($recursos as $key => $value) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $key + 1 ?>º Recurso Adotado:</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Recurso Adotado:</label>
                                <?php
                                echo $this->Form->select("Recurso.$key.tipo_recurso_id", $tipoRecursos, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Data:</label>
                                <?php echo $this->Form->input("Recurso.$key.data_recurso", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $this->Util->ddmmaa($value['Recurso']['data_recurso'])));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Resultado:</label>
                                <?php
                                echo $this->Form->select("Recurso.$key.tipo_resultado_id", $tpResultRecurso, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                                ?>

                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Data:</label>
                                <?php echo $this->Form->input("Recurso.$key.data_resultado", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $this->Util->ddmmaa($value['Recurso']['Resultado']['data_resultado'])));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Pré-Questionamento?</label>
                                <?php
                                $attributes = array('legend' => false, 'value' => $value['Recurso']['pre_questionamento'], 'separator' => '&nbsp;&nbsp;');
                                echo $this->Form->radio("Recurso.$key.pre_questionamento", $simNao, $attributes);

                                echo $this->Form->input("$modelAssocRecurso." . $key . ".id", array('type' => 'hidden', 'value' => $value["$modelAssocRecurso"]['id']));
                                echo $this->Form->input("Recurso.$key.id", array('value' => $value['Recurso']['id'], 'type' => 'hidden'));
//                        if (!empty($value['Recurso']['documento_id'])) { // Existe documento associado?
//                            echo $this->Html->link($this->Html->image("icones32/page_search.png", array("alt" => "Visualizar", "border" => 0)), array("controller" => 'documentos', "action" => "gerarPdf/" . $value['Recurso']['documento_id']), array('escape' => false, "target" => '_blank'));
//                        } else {
//                            //echo $this->Form->button('Modelo de Documento', array("class" => 'btnModeloRecurso', "id" => $key, "controller" => $this->params['controller']));
//                            echo $this->Form->input("Recurso.$key.modelo_documento_id", array('type' => 'hidden'));
//                            echo $this->Form->input("Recurso.$key.conteudo", array('type' => 'hidden'));
//                        }
//                        // ID Oculto do documento
//                        echo $this->Form->input("Recurso.$key.documento_id", array('value' => $value['Recurso']['documento_id'], 'type' => 'hidden'));
                                ?>
                            </div>
                        </div>
                    </div>            
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <div id="RecursoContent<?php echo $key ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">1º Recurso Adotado:</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Recurso Adotado:</label>
                            <?php
                            echo $this->Form->select('Recurso.0.tipo_recurso_id', $tipoRecursos, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm'));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Data:</label>
                            <?php echo $this->Form->input("Recurso.0.data_recurso", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Resultado:</label>
                            <?php
                            echo $this->Form->select('Recurso.0.tipo_resultado_id', $tpResultRecurso, array('empty' => 'Selecione', 'class' => 'nome form-control input-sm'));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Data:</label>
                            <?php echo $this->Form->input("Recurso.0.data_resultado", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label>Prequestionamento ?</label>
                            <?php
                            $attributes = array('legend' => false, 'separator' => '&nbsp;&nbsp;');
                            echo $this->Form->radio('Recurso.0.pre_questionamento', $simNao, $attributes);
                            ?>
                        </div>
                    </div>
                    <?php
                    //echo $this->Form->button('Modelo de Documento', array("class" => 'btnModeloRecurso', "index" => 0, "controller" => $this->params['controller']));
//                    echo $this->Form->input('Recurso.0.modelo_documento_id', array('type' => 'hidden'));
//                    echo $this->Form->input('Recurso.0.conteudo', array('type' => 'hidden'));
                    ?>
                    </td>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="row">
    <div class="col-xs-6 col-md-4">
        <div class="form-group">
            <?php
            echo $this->Js->link($this->Html->div('glyphicon glyphicon-plus-sign', ''), array(
                'controller' => 'recursos',
                'action' => "novoRecurso/-1/$idForm/$modelAssocRecurso/" . $this->params['controller'] . "?trs=1"), array(
                'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                'div' => false,
                'complete' => 'refreshJquery();',
                'update' => '#recursos',
                'method' => 'POST',
                'async' => true,
                'dataExpression' => true,
                'title' => 'Novo',
                'class' => 'btn btn-default',
                'escape' => false
            ));
            ?>
        </div>
    </div>
</div>