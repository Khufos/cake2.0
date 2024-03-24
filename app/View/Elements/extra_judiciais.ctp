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
  background-color: green;
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;
  margin-top: 26px;
  margin-left:2px
}
.buttonlor:hover {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: green;
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;
  margin-top: 26px;
  margin-left:2px
}
.buttonlor:focus {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: green;
  color: white;
  padding: 8px 8px 8px 8px;
  border: 1px solid #CCCCCC;
  border-radius: 5px;
  display: flex;
  margin-top: 26px;
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

align-items: center!important;
height: fit-content;
}

    </style>
    <div class="well2">
                        <legend class="well2-legend" >Extrajudiciais</legend>
                        <div class="col-md-8">
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

                                <div class="form-grouplor-dir">
                                    <?php
                                    $url = $_SERVER['REQUEST_URI'];
                                    $pieces = explode("/", $url);
                                    
                                    if($pieces[2] == 'edit'){
                                        echo $this->Html->link($this->Html->div('glyphicon glyphicon-list-alt', ''), array(
                                                            'controller' => 'atividade_extras',
                                                            'action' => "show_modal_dh/" . $DireitoHumanoIdPage ."/" . $idFunc  ), array(
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Data de movimentação:</label>
                                        <?php echo $this->Form->text('data_inicio2', array('class' => 'data form-control input-sm')); ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group" >
                                <label>Observação:</label>
                                <?php
                                echo $this->Form->textarea('observacao', array('class' => 'form-control input-sm','rows' => '8', 'cols' => '5'));
                                ?>
                            </div>
                        </div>
                        <?php
                        $url = $_SERVER['REQUEST_URI'];
                        $pieces = explode("/", $url);
                        if(!empty($extraJudiciais)){
                            if($pieces[2] == 'edit'){
                                echo $this->Html->link($this->Html->div('', 'Acessar registros anteriores à mudança'), array(
                                                    'controller' => 'atividade_extras',
                                                    'action' => "show_modal_dh_obs/" . $DireitoHumanoIdPage ), array(
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
<script>
    $('#DireitoHumanoDataInicio2').val($.datepicker.formatDate( "dd/mm/yy", new Date()))
</script>