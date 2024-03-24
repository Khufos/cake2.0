                    <?php echo $this->Form->hidden('Saude.id', array('type' => 'hidden'));?>
                    <?php if(isset($autismo) && $autismo){
                        echo '<div class="infoenf">';
                            echo "Assistido apresenta autismo";
                        echo '</div>';
                            }
                    ?>
<!--                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo $NomeAux = ($tipo == 'F') ? 'Assistido(a):' : 'Nome do Grupo:'; ?></label><br/>
                                <?php echo current($assistido) ?>
                                &nbsp;                      
                            </div>
                        </div>
			
                    </div>-->
                        <?php echo $this->Form->input('Saude.assistido_id', array('type' => 'hidden', 'value' => key($assistido))); ?>                
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><span class="obrigatorio">*</span>Comarca:</label>
                                <?php echo $this->Form->select('Saude.comarca_id', $comarcas, array('empty' => 'Selecione', 'class' => 'form-control input-sm validate[required]')); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo de Demanda:</label>
                                <?php echo $this->Form->select('Saude.tipo_acao_id', $tipoAcao, array('empty' => 'Selecione', 'class' => 'form-control input-sm')); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <span class="obrigatorio">*</span><label>Quem será demandado?</label><br/>
                                <?php
                                echo $this->Form->select('Saude.demandado', $listDemandados, array('empty' => 'Selecione', 'class' => 'form-control input-sm validate[required]'));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php $exibirMun = (isset($this->data['Saude']['cidade_demandada']) && (($this->data['Saude']['demandado'] == 1) || ($this->data['Saude']['demandado'] == 3) )) ? 'display: block' : 'display: none'; ?>
                                <div  id="municipios" style="<?php echo $exibirMun; ?>">
                                    <label>Municipio demandado:</label>
                                   
                                    <?php
                                    //$cidades = $this->Util->setaValorPadrao($dadosAssistido['cidade'], null);
                                    if (!empty($municipio)) {
                                        $idCidade = key($municipio);
                                        $cidades = array_map("utf8_encode", $municipio);
                                    }
                                    $args = array(
                                        'class' => 'form-control input-sm',
                                        'empty' => 'Selecione',
                                        'label' => false
                                    );
                                    echo $this->Form->select('Saude.cidade_demandada', $cidades, $args);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <span class="obrigatorio">*</span><label>Plantão Fim de Semana:</label>
                                <div class="form-group">  
                                <?php
                                $option1 = array('0' => 'Não');
                                $option2 = array('1' => 'Sim');
                                $attributes = array('label' => false, 'hiddenField' => false, 'class' => 'validate[required]');
                                ?>
                                <label class='radio-inline'>
                                    <?php echo $this->Form->radio('Saude.plantao_fim_semana', $option1, $attributes); ?>
                                </label>
                                <label class='radio-inline'>
                                    <?php echo $this->Form->radio('Saude.plantao_fim_semana', $option2, $attributes); ?>
                                </label>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <span class="obrigatorio">*</span><label>Plantão Carnaval/Micareta:</label>
                                <div class="form-group">  
                                <?php
                                $attributes = array('label' => false, 'hiddenField' => false, 'class' => 'validate[required]');
                                ?>
                                <label class='radio-inline'>
                                    <?php echo $this->Form->radio('Saude.plantao_carnaval', $option1, $attributes); ?>
                                </label>
                                <label class='radio-inline'>
                                    <?php echo $this->Form->radio('Saude.plantao_carnaval', $option2, $attributes); ?>
                                </label>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <span class="obrigatorio">*</span>
                            <label class="control-label">
                                Plantão Recesso Forense:
                            </label>
                            <div class="form-group">  
                                <?php
                                $attributes = array('label' => false, 'hiddenField' => false, 'class' => 'validate[required]');
                                ?>
                                <label class='radio-inline'>
                                    <?php echo $this->Form->radio('Saude.plantao_forense', $option1, $attributes); ?>
                                </label>
                                <label class='radio-inline'>
                                    <?php echo $this->Form->radio('Saude.plantao_forense', $option2, $attributes); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    
    
                
<?php echo $this->Html->script('saude/dados.js');