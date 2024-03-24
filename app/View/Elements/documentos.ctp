<?php
$this->Util->setaValorPadrao($exibeTipoPeticoes, false);
$this->Util->setaValorPadrao($edit, false);
if ($edit) {
    ?>
    <fieldset>
        <legend id="idHisDocumento">Histórico de Documentos</legend>
        <?php if (!empty($historicosDocumentos)) { ?>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>FUNCIONÁRIO / DEFENSOR</th>
                    <th>TIPO OFÍCIO / TIPO PETIÇÃO</th>
                    <th>DATA</th>
                    <th>OBSERVAÇÃO</th>
                    <th>VISUALIZAR</th>
                </tr>
                <?php
                $i = 0;
                foreach ($historicosDocumentos as $historico):
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
                    $dataDoc = explode(" ", $historico['tbl']['momento']);
                    ?>
                    <tr <?php echo $class; ?>  title="<?php echo $dataDoc[1] ?>">
                        <td align="justify" <?php echo $class; ?>>
                            <?php echo $this->Util->setaValorPadrao($historico['tbl']['funcionario']); ?>
                        </td>
                        <td>
                            <?php echo $this->Util->setaValorPadrao($historico['tbl']['tipoOficio']) . " / " . $this->Util->setaValorPadrao($historico['tbl']['tipoPeticao']); ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($dataDoc[0])) {
                                echo $this->Util->ddmmaa($dataDoc[0]);
                            } else {
                                echo "ND";
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $this->Util->setaValorPadrao($historico['tbl']['observacao']); ?>
                        </td>
                        <td align="center" width="100">
                            <?php
                            echo ($idFunc == $historico['tbl']['funcionario_id']) ? $this->Js->link(
                                            $this->Html->div('glyphicon glyphicon-edit', ''), array('controller' => 'documentos', 'action' => 'editDocEspecializada', $historico['tbl']['id'], '?trs=1'), array(
                                        'update' => '#resBuscaDocumento',
                                        'complete' => 'refreshJquery();',
                                        'title' => 'Editar',
                                        'escape' => false
                                    )) : "";
                            ?>
                            <?php
                            echo $this->Html->link($this->Html->div('glyphicon glyphicon-search', ''), array('controller' => 'documentos', 'action' => 'gerarPdf', $historico['tbl']['id']), array('target' => '_blank', 'title' => 'Visualizar Documento', 'escape' => false));
                            ?>
                            <?php
                            echo ($idFunc == $historico['tbl']['funcionario_id']) ? $this->Js->link(
                                            $this->Html->div('glyphicon glyphicon-remove', ''), array('controller' => 'documentos', 'action' => 'deleteDocEspecializada', $historico['tbl']['id'], $idEspecializada, $idFunc, $modelAssocDoc, $model, '?trs=1'), array(
                                        'update' => '#resBuscaDocumento',
                                        'title' => 'Apagar',
                                        'confirm' => "Deseja mesmo apagar esse documento?",
                                        'escape' => false
                                    )) : "";
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php } else { ?>
            <table class="table">
                <tr align="center">
                    <td align="center"><?php echo $this->Html->image('icones16/warning16.png') ?> Nenhum documento encontrado.</td>
                </tr>
            </table>
        <?php } ?>
    </fieldset>
<?php } ?>
<div id="modulo-documento">
    <div id="editPanel" class="oculto">
        <?php echo $this->Form->button('Desfazer edição', array('class' => 'btn btn-default', 'id' => 'desfazer-edicao', 'type' => 'button')); ?>
    </div>
    <div id="buscaDocumentoPorTipo">    
        <legend><h4>Buscar por Tipo Ofício/Petição:</h4></legend>
        <div class="row">            
            <div class="col-md-4">
                <div class="form-group">
                    <span class="asterisco">*</span>
                    <label>Tipo de Ofício:</label>
                    <?php
                    $args = array(
                        'onChange' => "limpaCampos('ModeloDocumentoTipoPeticaoId')",
                        'empty' => 'Selecione um tipo de ofício',
                        'class' => 'form-control input-sm'
                    );
                    echo $this->Form->select('ModeloDocumento.tipo_oficio_id', $tipoOficios, $args);

                    $this->Js->get('#ModeloDocumentoTipoOficioId')->event('change', $this->Js->request(
                                    array(
                                'controller' => 'modelo_documentos',
                                'action' => "buscaModeloDocumento/O/" . $model . "?trs=1"
                                    ), array(
                                'before' => '$("#loading").show()',
                                'complete' => '$("#loading").hide()',
                                'async' => true,
                                'dataExpression' => true,
                                'data' => $this->Js->serializeForm(
                                        array(
                                            'isForm' => false,
                                            'inline' => true
                                        )
                                ),
                                'update' => '#resBuscaDocumento',
                                'method ' => 'POST'
                                    )
                    ));

                    $this->Js->get('#ModeloDocumentoTipoOficioId')->event('change', $this->Js->request(
                                    array(
                                'controller' => 'documentos',
                                'action' => 'documentoOutros?trs=1'
                                    ), array(
                                'before' => '$("#loading").show()',
                                'complete' => '$("#loading").hide()',
                                'async' => true,
                                'dataExpression' => true,
                                'data' => $this->Js->serializeForm(
                                        array(
                                            'isForm' => false,
                                            'inline' => true
                                        )
                                ),
                                'update' => '#resOutroTpDocumento',
                                'method ' => 'POST'
                                    )
                    ));
                    ?>
                </div>
            </div>
            <?php if ($exibeTipoPeticoes) { ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <span class="asterisco">*</span>
                        <label>Tipo de Petição:</label>
                        <?php
                        $args = array(
                            'onChange' => "limpaCampos('ModeloDocumentoTipoOficioId')",
                            'empty' => 'Selecione um tipo de petição',
                            'class' => 'form-control input-sm'
                        );
                        echo $this->Form->select('ModeloDocumento.tipo_peticao_id', $tipoPeticoes, $args);

                        $this->Js->get('#ModeloDocumentoTipoPeticaoId')->event('change', $this->Js->request(
                                        array(
                                    'controller' => 'modelo_documentos',
                                    'action' => "buscaModeloDocumento/P/" . $model . "?trs=1"
                                        ), array(
                                    'before' => '$("#loading").show()',
                                    'complete' => '$("#loading").hide()',
                                    'async' => true,
                                    'dataExpression' => true,
                                    'data' => $this->Js->serializeForm(
                                            array(
                                                'isForm' => false,
                                                'inline' => true
                                            )
                                    ),
                                    'update' => '#resBuscaDocumento',
                                    'method ' => 'POST'
                                        )
                        ));

                        $this->Js->get('#ModeloDocumentoTipoPeticaoId')->event('change', $this->Js->request(
                                        array(
                                    'controller' => 'documentos',
                                    'action' => 'documentoOutros?trs=1'
                                        ), array(
                                    'before' => '$("#loading").show()',
                                    'complete' => '$("#loading").hide()',
                                    'async' => true,
                                    'dataExpression' => true,
                                    'data' => $this->Js->serializeForm(
                                            array(
                                                'isForm' => false,
                                                'inline' => true
                                            )
                                    ),
                                    'update' => '#resOutroTpDocumento',
                                    'method ' => 'POST'
                                        )
                        ));
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8" id="buscaDocumentoByNome">
            <legend><h4>Buscar por Nome/Descrição:</h4></legend>
            <div class="input-group">     
                <?php
                echo $this->Form->text('ModeloDocumento.nome', array('escape' => false, 'name' => 'data[ModeloDocumento][nome]', 'class' => 'form-control'));
                ?>    

                <?php
                if ($exibeTipoPeticoes) {
                    $block = 1;
                } else {
                    $block = 0;
                }
                ?>
                <span class="input-group-btn">
                    <?php
                    echo $this->Js->submit('Pesquisar', array(
                        'class' => 'btn btn-primary',
                        'before' => $this->Js->get('#loading')->effect('show'),
                        'success' => $this->Js->get('#loading')->effect('hide'),
                        'div' => false,
                        'complete' => 'refreshJquery();runEffect();',
                        'url' => array('controller' => 'modelo_documentos', 'action' => "buscaModeloByNome/" . $block . "/" . $model . "?trs=1", 'plugin' => null),
                        'update' => '#resBuscaDocumento')
                    );
                    ?>
                </span>
            </div>
        </div>
    </div>
    <table>
        <tr>
            <td colspan="2">
                <div id="resOutroTpDocumento" class="esquerda"></div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <div id="resEditDocumento"></div>
                <div id="resBuscaDocumento"></div> <br/>
                <div id="resInclusao">
                    <?php
                    echo $this->Form->hidden('Documento.assistido_id', array('value' => $idAssistido));
                    echo $this->Form->textarea('Documento.conteudo', array('class' => 'mceEditorEspecific'))
                    ?>
                </div>
                <div id="resBuscaDocumentoByNome"></div>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#desfazer-edicao').click(function(){
           $('#resEditDocumento').remove(); 
           $('#modulo-documento').removeClass('well');
           tinyMCE.activeEditor.setContent("");
           $('#editPanel').hide(); 
        });
    });

    $(document).ready(function(){
        $("#ModeloDocumentoTipoOficioId").select2();
    });

    $(document).ready(function(){
        $("#ModeloDocumentoTipoPeticaoId").select2();
    });

</script>