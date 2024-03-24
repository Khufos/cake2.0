
<div id="PainelInformacoes" class="custom-panel">
    <div class="header-panel">
        <span><i onclick="expandirPainel('#PainelInformacoes');" class="fa fa-caret-down"></i><span class="header-panel-label">Informações para o relatório da corregedoria</span></span>
    </div>
    <div class="well">

        <div class="row">
            <?php
            if (!isset($atoPraticado) || empty($atoPraticado)) :
            ?>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="PeticionamentoIntermediariosEspecializada">Informe a Especializada:</label>
                        <?php 
                            echo $this->Form->select(
                                'Especializada', 
                                $especializadasList, 
                                array(
                                    'name' => 'Especializada', 
                                    'class' => 'form-control input-sm select2-type', 
                                    'required' => true, 
                                    'empty' => 'Selecione uma especializada',
                                    'value' => $especializadaId
                                )
                            ); 
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="PeticionamentoIntermediarioAtoPraticado">Ato Praticado:</label>
                    <?php 

                        $opcoes = [];
                        $dadosSelecionados = [];

                        if(!empty($atosPraticados)){
                            foreach($atosPraticados as $ato) {
                                $idAto = $ato['AtoPraticado']['id'];
                                $texto = $ato['AtoPraticado']['nome'];
                                $opcoes[$idAto] = $texto;
                                array_push($dadosSelecionados, $idAto);
                            }
                        }
                        
                        echo $this->Form->select(
                            'PeticionamentoIntermediario.AtoPraticado', 
                            $opcoes,
                            [
                            'name' => 'AtoPraticado[]',
                            'class' => 'form-control input-sm js-example-basic-multiple',
                            'required' => true,
                            'multiple',
                            'value' => $dadosSelecionados
                            ]
                        );
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="PeticionamentoIntermediarioSubstituicao">Em substituição:</label>
                    <?php 
                        echo $this->Form->select(
                            'PeticionamentoIntermediario.Substituicao', 
                            $simnao,
                            array(
                                'name' => 'Substituicao', 
                                'class' => 'form-control input-sm select2-type', 
                                'required' => true, 
                                'value' => $substituicao
                                )
                        ); 
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Informação Complementar:</label>
                    <?php echo $this->Form->input(
                        '', 
                        array(
                            'name' => 'InfoComplementar', 
                            'id' => 'InfoComplementar',
                            'class' => 'form-control input-sm textarea-default', 
                            'type' => 'textarea', 
                            'rows' => '5', 
                            'cols' => '40', 
                            'maxlength' => 2000,
                            'value' => $informacaoComplementar
                        )
                    ); ?>
                    <span 
                        id="contadorDeCaracteresInformacaoComplementar"
                        class="d-flex justify-content-end"
                        ></span>
                </div>
            </div>
        </div>

    </div>
</div>