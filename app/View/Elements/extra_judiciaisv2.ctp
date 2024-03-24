<style>
    @media (min-width: 992px) {
    .modal-lg2 {
        width: 1200px;
        height: 700px;
        overflow: auto;
    }

    }

.linklor {
    margin-left: 20px;
}
.buttonlor {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: rgb(0,123,255);
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;
  
  margin-left:2px
}
.buttonlor:hover {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: rgb(4,112,227);
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;
  
  margin-left:2px
}
.buttonlor:focus {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: rgb(0,123,255);
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;
  
  margin-left:2px
}
.well2-legend{
    margin-bottom: 20px;
    padding-bottom: 15px;
}
.well2 {
    display: flex;
    flex-direction: column;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
    min-height: 150px;
    height: fit-content!important;

    /*
    background-image: -webkit-linear-gradient(top, #e8e8e8 0%, #f5f5f5 100%);
    background-image: -o-linear-gradient(top, #e8e8e8 0%, #f5f5f5 100%);
    background-image: -webkit-gradient(linear, left top, left bottom, from(#e8e8e8), to(#f5f5f5));
    background-image: linear-gradient(to bottom, #e8e8e8 0%, #f5f5f5 100%);
    */
}
    .formlor {
    display: flex;
    width: 100%;
    align-items: center!important;
}
.form-grouplor{
    width: 50%;
    justify-content: center!important; 
    align-items: center!important;
}
.form-grouplor-dir{

    width: 220px;
    display: flex;
    justify-content: center;
    align-content: flex-start;
    height: fit-content;  
}

    </style>
    <!-- Modal-lor1 content -->
    <div id="myModal-lor" class="modal-lor1">
        <div class="modal-lor1-content">
            <div class="modal-lor1-header">
                RELATÓRIO DA CORREGEDORIA
            </div>
            <div class="modal-lor1-body">
                <p>Deseja registrar esse atendimento como caso novo?</p>
            </div>
            <hr></hr>
            <div class="modal-lor1-footer">
                <a class="btn btn-primary" onclick="submitresp(event,1)">Sim</a>
                <a class="btn btn-primary" onclick="submitresp(event,0)">Não</a>
            </div>
        </div>
    </div>
    <div class="well2">
    <input type="hidden" name="flg_atendimento_extrajud" id="flg_atendimento_extrajud" value="1" >
                        <legend class="well2-legend" >Extrajudiciais</legend>
                        <div class="col-md-12">
                            <div class="formlor">

                                <div class="form-grouplor">
                                    
                                    <label>Tipo de atividade</label>
                                    <?php
                                    $tipoAtividade = isset($tipoAtividade) ? $tipoAtividade : array();
                                    $tipoAtividadeIds = isset($tipoAtividadeIds) ? $tipoAtividadeIds : '';
                                    $args = array(
                                        'default' => $tipoAtividadeIds,
                                        'class' => 'form-control input-sm selectMultiplo set-width-multiselect',
                                        'empty' => 'Selecionar',
                                        'multiple' => 'multiple',
                                        //'default' => $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') != "" ? $this->Session->read('dadosAnexoSigilosos.tipo_anexo_id') : "",
                                        //'disabled' => $this->Session->read('dadosAnexoSigilosos') != "" ? true : false
                                    );
                                    echo $this->Form->select("tipoatividade_id", $tipoAtividadeGrouped, $args)
                                    ?>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Data de movimentação:</label>
                                        <?php echo $this->Form->text('data_inicio2', array('class' => 'data form-control input-sm')); ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group-lor">
                                        <label>Em substituição:</label>
                                        <div>
                                        <?php
                                                                
                                        $opcoes = array(0=>'Não',1=>'Sim');
                                        $atributos = array(
                                            'legend'=>false,
                                            'separator'=>'&nbsp&nbsp',
                                        );
                                        echo $this->Form->radio('substituicao_extrj',$opcoes,$atributos);
                                
                                        ?>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-grouplor-dir">
                                    <?php
                                    $url = $_SERVER['REQUEST_URI'];
                                    $pieces = explode("/", $url);
                                    

                                    if($pieces[2] == 'edit'){
                                        echo $this->Html->link($this->Html->div('', 'Visualizar Atividades'), array(
                                                            'controller' => $controller,
                                                            'action' => $tela ."/" . $paramIdPage ."/" . $idFunc2 ), array(
                                                            'title' => 'Editar',
                                                            'class' => ' buttonlor',
                                                            'data-target' => "#modal2",
                                                            'data-toggle' => "modal",
                                                            'escape' => false
                                                        )
                                        );
                                    }
                                    ?>
                                </div>
                                
                            </div>
                                    
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" >
                                <label>Observação:</label>
                                <?php
                                echo $this->Form->textarea('observacao_extrj', array('class' => 'form-control input-sm','rows' => '8', 'cols' => '5'));
                                ?>
                            </div>
                        </div>

                        <?php
                        $url = $_SERVER['REQUEST_URI'];
                        $pieces = explode("/", $url);
                        if(!empty($extraJudiciaisv2)){
                            if($pieces[2] == 'edit'){
                                echo $this->Html->link($this->Html->div('', 'Acessar registros anteriores à mudança'), array(
                                                    'controller' => 'atividade_extras',
                                                    'action' => "show_modal_dh_obs/" . $paramIdPage ."/". $nameAnterior ), array(
                                                    'title' => 'Editar',
                                                    'class' => 'linklor',
                                                    'data-target' => "#modal",
                                                    'data-toggle' => "modal",
                                                    'escape' => false
                                                )
                                );
                            }
                        }
                        ?>

                    </div>
