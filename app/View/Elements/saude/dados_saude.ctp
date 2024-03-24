
<div id="inf_saude">
                    <?php echo $this->Form->hidden('Saude.id', array('type' => 'hidden'));?>
                    <?php if(isset($autismo) && $autismo){
                        echo '<div class="infoenf">';
                            echo "Assistido apresenta autismo";
                        echo '</div>';
                            }
                    ?>
                    <div class="row">
                        
                        <div class="col-md-3 form-group">
                            <label>
                                Origem do Encaminhamento para a DP:
                            </label>
                            <?php
                            echo $this->Form->select('Saude.origens_encaminhamento_id', $origens, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>
                                    Internamento:
                                </label>
                                <?php
                                echo $this->Form->select('Saude.tipo_internamento_id', $tipoInternamento, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                                <label>
                                    Home Care / Assistência Domiciliar:
                                </label>
                                <?php
                                echo $this->Form->select('Saude.assistencia_domiciliar', $simNao, array('empty' => 'Selecione', 'class' => 'form-control input-sm'));
                                ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Falecimento:</label>
                            <?php echo $this->Form->select('Saude.falecimento', $simNao, array('empty' => 'Selecione', 'class' => 'form-control input-sm')); ?>
                        </div>
                        <div class="col-md-3">
                            <?php $exibirDataObito = (isset($falecimento) && $falecimento) ? 'display: block' : 'display: none'; ?>
                            <div id="DataObito" style="<?php echo $exibirDataObito; ?>">
                                <div class="form-group">
                                    <label>Data Óbito:</label>
                                    <?php echo $this->Form->input("Saude.data_obito", array('class' => 'form-control input-sm data', 'data-date-format' => 'DD/MM/YYYY', 'type' => 'text', 'label' => false, 'value' => $saude['Saude']['data_obito'])); ?>
                                </div>
                            </div>
                        </div>
                    </div>                    
                   
    <div class="row">
                    <!--    <div class="col-md-12 form-group">
                            <label>Assunto / Providência / Medidas:</label>
                            <?php // echo $this->Form->textarea('Saude.assunto_providencia_medida', array('class' => 'form-control input-sm')); ?>
                        </div>  -->
                    </div>
                </div>
