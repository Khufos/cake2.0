<div class="panel panel-default m-top-10">
<div class="panel-heading"><b> Informações do Atendimento:</b></div>
    <div class="panel-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" id="infor_atend">
                        
                        <sub class="obs-sub-canc"><a id="removeEdition" href="javascript: return false;"></a></sub>
                        <?php
                        echo $this->Form->textarea('AcaoHistorico.observacao', array('class' => 'form-control input-sm obs-text-box','rows' =>'8'));
                        echo $this->Form->input('AcaoHistorico.id', array('type' => 'hidden'));
                        ?>
                        <input type="checkbox" id="incluirComoPendencia" <?php
                        if(empty($this->data['Acao']['id'])) echo 'disabled="disabled" title="Salve a ação para usar este recurso"';
                        ?>> Incluir como pendência

                        <p style="padding: 10px; margin-top: 10px; border: 1px solid #4c574c; background-color: #3f883f;color: white;border-radius: 4px;">As informações desta área não serão contabilizadas no relatório da corregedoria</p>
                    </div>
                </div>
            </div>
     
    </div>

</div>
<style>
    .obs-sub-canc{
        padding-bottom: 30px;
        position: static;
    }
    .obs-text-box{
        margin-top: 10px;
    }
</style>
        
    


