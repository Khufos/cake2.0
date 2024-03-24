<style>
#contentLeft {
	float: center;
	width: 600px;
}

#contentLeft tr {
	margin: 0 50px 4px 0;
	padding: 10px;
	background-color:#00CCCC;
	border: #CCCCCC solid 1px;
	color:#fff;
}
#contentLeft h3 {
	margin: 0 50px 4px 0;
	color: #CC0000;
        text-align: center;
        float: center;
        font-weight: bold;
        width: 600px;
}
#contentWrap {
	width: 700px;
	margin: 0 auto;
	height: auto;
	overflow: hidden;
}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        
         //Reordernar paines fisicamente
        $('.testeClick').live('click', function() {
            $.alerts.okButton = "Sim";
            $.alerts.cancelButton = "Não";
            var id = $(this).attr('id');
      
            //var data = ('#divLista').sortable('toArray').toString();;
            if (jConfirm('Deseja realmente atualizar a ordem dos paines ?', '', function(r) {
                if (r) {
                    atualizaPlaylist(id);
                }
            }))
                ;
        });
         
         
        $('#divLista').sortable({
            //axis: "y",// eixo vertical ou horizontal
            cursor: "move",
            revert: true,
            opacity: 0.6,
            // revert: false (deixa o item imediatamente)

         }).disableSelection();
         // Return a helper with preserved width of cells
       $('#sortable').sortable().disableSelection();
         
     
     });
     
     function fixHelper(e,ui){
         ui.children().each(function() {
                    $(this).width($(this).width());
            });
            return ui;
     }
        
    function atualizaPlaylist(id) {
      var order = $('#sortable').sortable('serialize');
      //alert(order);
      $.ajax({
            type: 'POST',
            async: true,
            cache: false,
            url: "<?php echo $this->webroot; ?>fila/fila_paineis/atualizaPaineis/",
            data: order,
            success: function(response) {
                 if(response.erro){
                    jAlert(data.msg, 'Atenção');
                    
                }else{
                    alert("Paineis Reordenados com Sucesso!!");
                    window.location = "<?php echo $this->webroot; ?>fila/fila_paineis/edit/" + id + '?trs=1';
                }
             //$('#loading').fadeOut();
             //$("#").parent('td').parent('tr').remove();
            },
            error : function() {
                alert("false");
            }
        });
   }
  
    function delayer(){
       window.location = "<?php echo $this->webroot; ?>fila/fila_paineis/listagem";
    }
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */?>
<div id="contentWrap">
           <div id="contentLeft">
               <h3>*Obs: Movimente os paineis para mudar a ordem dos mesmos. Para salvar a nova ordem clique no botão para atualizar</h3>
               <table id="sort" class="cabecalhoRel borda_fina" title="Atualiza Paineis" width="100%">
                <thead>
                    <tr><th>Ordem Apresentação</th><th>Tipo Conteúdo</th><th>Descrição</th><th>Pré-visualização</th></tr>
                </thead>
                <tbody id='sortable'>
                        <?php $count = 1; ?>
                            <?php foreach ($playlist as $key => $value):?>
                           <tr id='FilaPainelPlaylists_<?php echo $value['FilaPainelPlaylists']['id']?>'>
                           <td align="center">
                               <span class="label"><?php echo $count; ?></span></td>
                           <td align="center">
                                 <span class="label"><?php echo $value['FilaPainelPlaylists']['tipo_conteudo'] == 'I' ? 'IMAGEM' : 'VIDEO'; ?></span>
                           </td>
                           <td align="center">
                               <span class="label"><?php echo $value['FilaPainelPlaylists']['descricao']; ?></span>
                           </td>
                           <td align="center">
                               <?php if ($value['FilaPainelPlaylists']['tipo_conteudo'] == 'I') { ?>
                                   <span class="label"><?php echo $this->Html->image("/" . $value['FilaPainelPlaylists']['caminho_fisico'], array('style' => 'max-width:150px'), false, false, '200px', false); ?></span>
                                    <?php }else if ($value['FilaPainelPlaylists']['tipo_conteudo'] == 'V') {
                                    ?>                          
                                    <span class="label"></span><?php echo $this->Html->image('knob/Play Green.png'); ?> 
                                    <?php  }  ?>
                           </td>
                            
                          </tr>
                           <?php $count++; ?>
                            <?php endforeach; ?>

                </tbody>
            </table>
                
           </div>
    <div>
    <?php echo $this->Html->image('knob/Valid Blue.png', array('id' => $id,'class' => 'testeClick', 'escape' => false, 'name' => 'Atualizar')); ?>
    </div>
</div>      
               
              




