<?php     
        echo $this->Form->hidden('Contato.model_id', array('value' => $idModel)); 
        echo $this->Form->hidden('Contato.model', array('value' => $model));
        echo $this->Form->hidden('Contato.controller', array('value' => $controller));
        echo $this->Form->hidden('Contato.formulario_id', array('value' => $idFormCont));
    ?>
<div id="cadContato">    
    <legend>Cadastrar novo contato</legend>
    
    <div class="row">
        <div class="col-xs-6 col-md-4">  
            <div class="form-group">
                <label>Responsável:</label>
                <?php
                echo $this->Form->text('Contato.responsavel', array(
                    'value' => $this->Util->setaValorPadrao($dadosAssistido['responsavel'], ''),
                    'class' => 'form-control input-sm',
                    'label' => false));
                ?>
            </div>
        </div> 
        <div class="col-xs-6 col-md-4">  
            <div class="form-group">
                <label>Celular 1 (WhatsApp): </label>
                    
                <?php                        
                echo $this->Form->text('Contato.whatsapp', array(
                    'value' => $this->Util->setaValorPadrao($dadosAssistido['whatsapp'], ''),
                    'class' => 'telefone form-control input-sm',
                    'maxlength' => '15',
                    'label' => false));
                ?>
            </div>
        </div>                     
    </div>
    <div class="row">   
        <div class="col-xs-6 col-md-4">  
            <div class="form-group"> 
                <label>Celular 2: caso seja um número diferente do whatsapp </label>

                <?php
                echo $this->Form->text('Contato.celular', array(
                    'value' => $this->Util->setaValorPadrao($dadosAssistido['celular'], ''),
                    'class' => 'telefone form-control input-sm',
                    'maxlength' => '15',
                    'label' => false));
                ?>
            </div>
        </div>
        <div class="col-xs-6 col-md-4">  
            <div class="form-group">
                <label>E-mail:</label>
                <?php
                echo $this->Form->text('Contato.email', array(
                    'class' => 'validate[custom[email]] form-control input-sm',
                    'value' => $this->Util->setaValorPadrao($dadosAssistido['email'], ''),
                    'label' => false));
                ?>
                <?php echo $this->Form->text('Contato.id', array('value' => $this->Util->setaValorPadrao($dadosAssistido['idContato'], ''), 'type' => 'hidden')) ?>
            </div>
        </div>   
    </div>
    <div class="row">            
        <div class="col-xs-6 col-md-4">  
            <div class="form-group">   
                <label>Comercial:</label>
                <?php
                echo $this->Form->text('Contato.comercial', array(
                    'value' => $this->Util->setaValorPadrao($dadosAssistido['comercial'], ''),
                    'class' => 'telefone form-control input-sm',
                    'maxlength' => '15',
                ));
                ?>
            </div>
        </div> 

        <div class="col-xs-6 col-md-4">  
            <div class="form-group">
                <label>Telefone para Recado:</label>
                <?php
                echo $this->Form->text('Contato.recado', array(
                    'value' => $this->Util->setaValorPadrao($dadosAssistido['recado'], ''),
                    'class' => 'telefone form-control input-sm',
                    'maxlength' => '15',
                    'label' => false));
                ?>
            </div>
        </div>                  
                
    </div>
    
    <div class="row">
        <div class="col-xs-6 col-md-8">
             <?php
                echo $this->Form->button('Salvar', array('id' => 'submitContatoNovo','name' => 'submitContatoNovo', 'type' => 'button', 'class' => 'btn btn-primary'));

                echo $this->Form->button($this->Html->div('glyphicon glyphicon-repeat', '').' Limpar Campos', array('type' => 'reset', 'class' => 'btn btn-default'));
             ?>
        </div>
    </div>   

</div>
<div class="alert alert-success" role="alert" id="edita-alert-success" style="display:none;position:relative;width:auto;">
    Atualizando lista...
</div>
<div class="alert alert-danger" role="alert" id="edita-alert-danger" style="display:none;position:relative;width:auto;">
    Erro ao alterar o contato.
</div> 

<div id="lista_contatos" style="margin-top: 15px">
    
    <table id="listaContatos" class="table table-striped table-responsive table-bordered tablesorter">
        <thead>
            <tr>
                <th>RESPONSÁVEL</th>
                <th>Celular 1 (Whastapp)</th>
                <th>Celular 2</th>
                <th>E-mail</th>
                <th>Telefone Comercial</th>
                <th>Telefone para recado</th>
                <th class="actions" style="min-width: 30px;">OPÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            //FireCake::info($assistidos, 'assistidos');
            foreach ($contatos as $contato):
                ?>
                <tr id="<?= $contato['c']['id'] ?>">
                    
                    <td style="max-width: 134px;">
                        <?php echo $contato['c']['responsavel']; ?>
                    </td>
                    <td>
                        <?php echo $contato['c']['whatsapp']; ?>
                    </td>
                    <td>
                        <?php echo $contato['c']['celular']; ?>
                    </td>
                    <td>
                        <?php echo $contato['c']['email']; ?>
                    </td>
                    <td style="width: 97px;">
                        <?php echo $contato['c']['comercial']; ?>
                    </td>                    
                    <td style="width: 97px;">
                        <?php echo $contato['c']['recado']; ?>
                    </td>
                    <td class="actions" style="min-width: 30px;">
                        <div align="center">
                            <?php
                                                                
                                echo $this->Html->link(
                                    '<div class="glyphicon glyphicon-edit"></div>',
                                    array(
                                        'controller' => 'contatos',
                                        'action' => 'edit',
                                        $contato['c']['id']
                                    ), array(
                                        'title' => 'Editar contato',
                                        'text-decoration ' => 'none',
                                        'target' => '_blank',
                                        'class' => 'link-modal',
                                        'data-target' => "#modal",
                                        'data-toggle' => "modal",
                                        'escape' => false,
                                        'id' => $contato['c']['id']
                                    )
                                );
                            ?>
                            <a id="contato<?= $contato['c']['id'] ?>" class='delete-contato' style="cursor: pointer;">
                                <div class="glyphicon glyphicon-trash"></div>
                            </a>                   
                            
                        </div>
                    </td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#submitContatoNovo").click(function (event) {
            var formulario = $('#ContatoFormularioId').val();
            //alert(formulario);  
            //if ($("#formFundiario").validationEngine('validate')) {
                var form = $("#"+formulario);
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller' => 'contatos', 'action' => 'add_contato_model', '?' => array('trs' => 1)), true) ?>",
                    data: form.serialize(),
                    success: function (response) {
                        alert('Contato cadastrado com sucesso');
                        $("#lista_contatos").load(window.location.href + " #listaContatos" );
//                      $('#edita-alert-success').show(800).delay(5000).hide(5000);
                    }
                });
                return false;
            //}
            event.preventDefault();
        });        
    });

    $(document).ready(function(){
        $('a.delete-contato').click(function(){
            var controller = $('#ContatoController').val();       

            if (confirm("Tem certeza que deseja excluir?"))
            {
                var id = this.id;
                $.post(window.location.origin+'/'+controller+'/delete_contato/'+id.substring(7), function(data){
                    if(data){
                        $('#'+id).parents('tr').hide();
                        alert('Contato removido com sucesso');
//                      $('#edita-alert-success').show(800).delay(800).hide(800);
                    }else{
                        alert('Contato não pôde ser excluído, por favor tente novamente.')
                    }
                });
            }
        });
    });
</script>

