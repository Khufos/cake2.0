<script type="text/javascript">

    var key = <?php echo!empty($qtdPartes) ? $qtdPartes : 0 ?>;
    $(document).ready(function() {

        $(".remove-btn").on('click', function() {
            key = key - 1;
            $(this).parent().remove();
        });

});
function AdcionarPessoaColetivo(idColetivo, id) {
     $.ajax({
            url: "<?= $this->Html->url(array('controller' => 'assistidos', 'action' => 'addAssistidoColetivo', '?' => array('trs' => 1)), true) ?>",
            type: 'POST',
            data: {"data": [{"idColetivo": idColetivo,"id": id}]},
            success: function (data) {
                $("#selDados").html(data);
            
            }
        });

}
function excluirPessoaColetivo(id) {
        
        $.ajax({
            url: "<?= $this->Html->url(array('controller' => 'assistidos', 'action' => 'excluirPessoaColetivo', '?' => array('trs' => 1)), true) ?>",
            type: 'POST',
            data: {"data": [{"id": id}]},
            success: function (data) {
                  $("#resEndereco0").html(data);
                  $("#field" + id + "").remove();
                key = key - 1;
            }
        });
    }

 
</script>
<?php

if($idPessoa['Assistido']['pessoa_id']){

$AssistidosColetivo = $this->Js->request(
        array(
    'controller' => 'assistidos',
    'action' => "listAddAssistidoColetivo/".$idPessoa['Assistido']['pessoa_id']."?trs=1"
        ), array(
    'async' => true,
    'dataExpression' => true,
    'update' => '#selDados',
    'method ' => 'POST'
        )
);


}
?>


<script type="text/javascript">
<?php echo $AssistidosColetivo; ?>
</script>
<style type="text/css">
    #selDadosParte{
        list-style-type:none; 
    }    
</style>


<div id="partes">
    <div class="form-parte row">              
        <div class="col-lg-6">
            <div class="input-group">

            <?php
            echo $this->Form->text('Assistido.nome', array('class' => 'nome form-control', 'placeholder' => 'Nome'));
            echo $this->Form->hidden('Assistido.idPessoaColetivo', array('value' => $idPessoa['Assistido']['pessoa_id']));
            //echo $this->Form->button("Pesquisar", array('class' => 'botao direita', 'id' => 'btnPesquisar', 'escape' => false)); ?>
           <span class="input-group-btn">
               
            
           <?php              
            echo $this->Js->submit('Pesquisar', array(
    'class' => 'btn btn-default',
    'id' => 'btnPesquisar',
    'before' => $this->Js->get('#loading')->effect('show'),
    'success' => $this->Js->get('#loading')->effect('hide'),
    'div' => false,
    'complete' => 'refreshJquery();',
    'data' => $this->Js->serializeForm(
                                            array(
                                                'isForm' => true,
                                                'inline' => true
                                            )
                                    ),            
    'url' => array('controller' => 'assistidos','action' => "getAssistidosByName?trs=1"),
    'update' => '#resEntradaDPE')
);


            ?>
        </span>     
   
        <div class="quebra"></div> <!-- Quebra a linha -->
        
   </div>
</div>
 </div>       
     <div class="oculto" id="idEntradas" >
        <div id="resEntradaDPE"></div>
    </div>

    <div class="quebra"></div> <!-- Quebra a linha -->
    <div class="quebra"></div> <!-- Quebra a linha -->    
    <div id="selDados"></div>
    <div class="quebra"></div> <!-- Quebra a linha -->                

    <div id="resEndereco0"></div>
    <div id="resDados"></div>


 </div>           
<?php echo $this->Js->writeBuffer();?>