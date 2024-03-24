<script>
    $(document).ready(function () {
    $(".selectMultiplo").select2();
    $(".selectMaterialColetado").select2();
    }
    );
</script>

<div class="row">
    <div id="matColDinamico">
        <div class="col-xs-12 col-md-3 form-group">
            <label>Quais materiais são coletados:</label>
            <?php
            echo $this->Form->select('NugamAtendimentoMaterialColetado.nugam_material_coletado_id', $listaMaterialColetado,
                array(
                    'default' => $this->Util->setaValorPadrao($NugamAtendimentoMaterialColetado['NugamAtendimentoMaterialColetado']['nugam_material_coletado_id'], null),
                    'class' => 'form-control input-sm selectMaterialColetado set-width-multiselect',
                    'label' => false,
                    'empty' => 'selecione', 
                )
            );
            ?>
        </div>

        <div class="col-xs-12 col-md-3 form-group">
            <label>Volume médio mensal:</label>
            <?php
                echo $this->Form->text('NugamAtendimentoMaterialColetado.qtd_media', 
                array('class' => 'form-control input-sm',
                        'label' => false,
                )
            );
            ?>
        </div> 
    </div>
    <div class="col-xs-12 col-md-3 form-group">
        <label>Forma de armazenamento:</label>
        <?php
        echo $this->Form->select('NugamAtendimentoFormaArmazenamento.nugam_forma_armazenamento_id', $listaFormaArmazenamento,
            array(
                'default' => $this->Util->setaValorPadrao($NugamAtendimentoFormaArmazenamento['NugamAtendimentoFormaArmazenamento']['nugam_forma_armazenamento_id'], null),
                'class' => 'form-control input-sm selectMultiplo',
                'label' => false,
                //'multiple' => 'multiple',
                'empty' => 'selecione'
            )
        );
        ?>
    </div>

    <div class="col-xs-12 col-md-3 form-group">
        <label>Condição de armazenamento:</label>
        <?php
        
        $argss = array(
            'class' => 'form-control input-sm validate[required] autocompletar set-width-multiselect',
            'multiple'=>'multiple',
            'value' => !empty($condArmazSel) ? $condArmazSel : '');
        echo $this->Form->select('NugamAtendimentoCondicaoArmazenamento.nugam_condicao_armazenamento_id', $listaCondicaoArmazenamento, $argss);
        ?>
    </div>  
</div>

<div class="row">

    <div class="col-xs-12 col-md-3 form-group">
        <label>Cidade em que coleta:</label>
        <?php
        echo $this->Form->select('NugamTrabalhoRenda.cidade_coleta_id', 
                                    array_map("utf8_encode", $listaCidades), 
                                        array(
                                            'empty' => 'selecione',
                                            'class' => 'form-control selectMultiplo', 
                                            'label' => false
                                        )
                                    );


        
           /* $args = array(
                    'default' => $this->Util->setaValorPadrao($dadosAssistido['PessoaFisica']['raca_id'], null),
                    'class' => 'form-control selectMultiplo',
                    'label' => false,
                    'empty' => 'SELECIONE'
                );
                echo $this->Form->select('PessoaFisica.raca_id', $racas, $args);*/
                            


             $this->Js->get('#NugamTrabalhoRendaCidadeColeta')->event('change', $this->Js->request(
                 array(
                    'controller' => 'enderecos', 
                    'action' => 'populaSelect/B/1?trs=1' // populaSelectBairro/CD/1?trs=1
                ),
                array(
                    'before' => '$("#NugamTrabalhoRendaCidadeColeta").prev().find("span").show()', 
                    'complete' => '$("#NugamTrabalhoRendaCidadeColeta").prev().find("span").hide()', 
                    'async' => true, 
                    'dataExpression' => true, 
                    'data' => $this->Js->serializeForm(array('isForm' => true,'inline' => true)), 
                    'update' => '#NugamTrabalhoRendaBairroColetaId',
                    'method ' => 'POST'
                )
            )
        );
        ?>
    </div>

    <div class="col-xs-12 col-md-3 form-group">
        <label>Bairro em que coleta:</label>
        <?php
        echo $this->Form->select('NugamTrabalhoRenda.bairro_coleta_id', 
                                array_map("utf8_encode", $listaBairros), 
                                    array(
                                        'empty' => 'selecione', 
                                        'class' => 'form-control selectMultiplo',
                                        //'selected' => $id_bairro, 
                                        'label' => false,
                                        'id' => 'NugamTrabalhoRendaBairroColetaId'
                                    )
                            );
 
        ?>
    </div> 
</div>

<div class="row">

    <div class="col-xs-12 col-md-4 form-group">
        <label>Destinação do material reciclável:</label>
        <?php
        echo $this->Form->text('NugamTrabalhoRenda.destino_reciclavel', 
            array(
                'value' => $this->Util->setaValorPadrao($dadosAssistido['NugamTrabalhoRenda']['destino_reciclavel'], null),
                'class' => 'form-control input-sm',
                'label' => false,
            )
        );
        ?>
    </div>


    <div class="col-xs-12 col-md-4 form-group">
        <label>Destinação do material não reciclável:</label>
        <?php
        echo $this->Form->text('NugamTrabalhoRenda.destino_nao_reciclavel', 
            array(
                'value' => $this->Util->setaValorPadrao($dadosAssistido['NugamTrabalhoRenda']['destino_nao_reciclavel'], null),
                'class' => 'form-control input-sm',
                'label' => false,
            )
        );
        ?>
    </div>  

    <div class="col-xs-12 col-md-4 form-group">
        <label>Renda média mensal obtida com a coleta:</label>
        <?php
        echo $this->Form->text('NugamTrabalhoRenda.renda_media_coleta',
            array(
                //'value' => $this->Util->setaValorPadrao($dadosAssistido['NugamTrabalhoRenda']['renda_media_coleta'], ''),
                'class' => 'form-control input-sm',
                'label' => false,
            )
        );
        ?>
    </div>

</div>

<div class="row">

    <div class="col-xs-12 col-md-4 form-group">
        <label>Possui outras fontes de renda:</label>
        <?php
        echo $this->Form->select('NugamTrabalhoRenda.outra_renda_id', $listaOutrasRendas,
            array(
                'default' => $this->Util->setaValorPadrao($dadosAssistido['NugamTrabalhoRenda']['outra_renda_id'], ''),
                'class' => 'form-control input-sm selectMultiplo set-width-multiselect',
                'label' => false,
                'empty' => 'selecione', 
                //'multiple' => 'multiple',
            )
        );
        ?>
    </div>   

    <div class="col-xs-12 col-md-4 form-group">
        <label>Valor das outras fontes de renda:</label>
        <?php
        echo $this->Form->text('NugamTrabalhoRenda.outra_renda', 
            array(
                'value' => $this->Util->setaValorPadrao($dadosAssistido['NugamTrabalhoRenda']['outra_renda'], ''),
                'class' => 'form-control input-sm',
                'label' => false,
            )
        );
        ?>
    </div>  

</div>

