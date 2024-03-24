
<?php echo $this->Form->create('PeticionamentoIntermediarios', array('action' => 'segundo_grau', 'id' => 'formIndex')) ?>
<fieldset>
    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome do Assistido:</label>
                    <?php
                    echo $this->Form->text('Pessoa.nome', array('class' => 'nome form-control input-sm', 'required' => false));
                    echo $this->Jmycake->autocomplete('PessoaNome', 'Pessoa/nome', 'assistidos', 'formIndex');
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nº Triagem:</label>
                    <?php echo $this->Form->text('PeticionamentoIntermediario.numero_triagem', array('class' => 'form-control input-sm')); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nº Processo:</label>
                    <?php echo $this->Form->text('PeticionamentoIntermediario.numero_processo', array('class' => 'form-control input-sm')); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Órgão Julgador Colegiado:</label>
                    <?php  

                        $opcoes = [];
                        foreach($orgaosColegiadosLista as $item) {
                            $id = $item['OrgaoColegiados']['id'];
                            $nome = $item['OrgaoColegiados']['nome_orgao'];
                            $encoding = mb_detect_encoding($nome, 'UTF-8', true);
                            if($encoding !== 'UTF-8'){
                                $nome = utf8_encode($nome);
                            }
                            $opcoes[$id] = $nome;
                        }
                    
                        echo $this->Form->select(
                                'OrgaoColegiado', 
                                $opcoes, 
                                array(
                                    'name' => 'PeticionamentoIntermediarioOrgaoColegiado', 
                                    'class' => 'form-control input-sm', 
                                    'empty' => 'Selecione Orgão Colegiado'
                                )
                            );

                    ?> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Órgão Julgador:</label>
                    <?php  

                        $opcoes = [];
                        foreach($orgaosJulgadoresLista as $item) {
                            $id = $item['OrgaoJulgadores']['id'];
                            $nome =  $item['OrgaoJulgadores']['nome_orgao'];
                            $opcoes[$id] = $nome;
                        }
                    
                        echo $this->Form->select(
                                'OrgaoJulgador', 
                                $opcoes, 
                                array(
                                    'name' => 'PeticionamentoIntermediarioOrgaoJulgador', 
                                    'class' => 'form-control input-sm', 
                                    'empty' => 'Selecione Orgão Julgador'
                                )
                            );

                    ?>        
                </div>
            </div>
            
            <div class="col-md-3">
                <label>Data Limite Manifestação:</label>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->Form->text('PeticionamentoIntermediario.datalimitei', array('class' => 'form-control input-sm data', array(
                            'onChange' => 'limpaCampos(\'resPesquisa\')',
                            'value' => date('d/m/Y'),
                            'class' => "form-control input-sm"))); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->text('PeticionamentoIntermediario.datalimitef', array('class' => 'form-control input-sm data', array(
                            'onChange' => 'limpaCampos(\'resPesquisa\')',
                            'value' => date('d/m/Y'),
                            'class' => "form-control input-sm"))); ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                <label>Marcadores </label>
                <?php
                    echo $this->Form->input('marcador.', array(
                        'options' => $listaMarcador,
                        'id'=>'filtro_marcador',
                        'class'=>'form-control',
                        'multiple'
                    ));
                ?>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Status Peticionamento:</label>
                    <?php  

                        $opcoes = [];
                        foreach($statusLista as $item) {
                            $status = $item['StatusPeticionamentoIntermediario'];
                            $id = $item['StatusPeticionamentoIntermediario']['id'];
                            $nome =  $item['StatusPeticionamentoIntermediario']['nome'];
                            $opcoes[$id] = $nome;
                        }
                    
                        echo $this->Form->select(
                                'statusPeticionamentoIntermediario_id', 
                                $opcoes, 
                                array(
                                    'name' => 'StatusPeticionamentoIntermediario', 
                                    'class' => 'form-control input-sm', 
                                    'empty' => 'Selecione Status'
                                )
                            ); 
                    ?>                                   
                </div>
            </div>
            
        </div>
    </div>
    <?php echo $this->Form->submit('Pesquisar', array('id' => 'btnPesquisar', 'class' => 'btn btn-primary')); ?>
    <?php
    if($this->request->is("post")) {
        echo "<a href='/peticionamento_intermediarios/segundo_grau' style='float: left;' >" . $this->Form->button('Limpar Campos', array(
            'class' => 'btn btn-default',
            'type' => 'button',
            'value' => 'reset'
        )) . "</a>";
    } else {
        echo $this->Form->button('Limpar Campos', array(
            'class' => 'btn btn-default',
            'type' => 'reset',
            'value' => 'reset'
        ));
    }
    
    echo $this->Form->end();
    ?>
</fieldset>
<br/>