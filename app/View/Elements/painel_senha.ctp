<style type="text/css">
	/*    #minimized-dialog-container{
            background-color: #88947C;
        }
        .ui-dialog-titlebar{
            background-color: #88947C;
        }*/
</style>

<?php
//echo $this->Html->script('jquery/jQueryUiExtends/jquery.dialogextend.min');
//echo $this->Html->script('jquery/jQueryUiExtends/jquery.dialogextend.pack');


if ((isset($isAtendente) && ($isAtendente)) || (isset($isDefensor) && ($isDefensor))) {
    ?>

	<div class="col-sm-3 col-md-2 sidebar-right" id="painel_de_senhas" style="display:none;">
		<?php
        if (isset($isAtendente) && ($isAtendente)) {
            ?>
			<div id="gestaFila" class="box-gestao-fila noPrint">
				<legend>Gestão de Senhas</legend>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$.ajax({
						url: '<?php echo $this->webroot; ?>' + 'fila/fila_senhas/atendimento?trs=1',
						type: 'GET',
						before: function() {
							$('#loading').show();
						},
						success: function(data) {
							$('#gestaFila').append(data);
							$('#loading').hide();
						},
						cache: false
					});
				});
			</script>
			<?php } ?>
				<?php
        //FireCake::info($isDefensor, "\$isDefensor");
		
        if (isset($isDefensor) && ($isDefensor)) {
            ?>
					<div id="lista_assistidos" class="noPrint">
						<?php echo $this->element('lista_assistido'); ?>
					</div>
					<div id="lista_expediente" class="noPrint" >
						<?php echo $this->element('lista_expediente'); ?>
					</div>
					<?php 
        }elseif(isset($perfilAtende) && ($perfilAtende)){
			
			?>
						<div id="lista_assistidos" class="noPrint">
							<?php echo $this->element('lista_assistido_servidor'); ?>
						</div>
						<?php
		
	}
	?>
	</div>

	<?php } ?>




		<script>
			// script novo para exibir e ocultar painel - rafaela fernandes 13/04/208
			$("#exibir_painelSenha").click(function() {

				$("#painel_de_senhas").toggle("fade", function() {


					if ($("#painel_de_senhas").is(":visible")) {
						$(".main").addClass("conteudo-right-painel");
					} else {
						$(".main").removeClass("conteudo-right-painel");
					}

					if ($("#menu-esquerdo").is(":visible")) {
						$(".main").toggleClass("conteudo-menor");
					}


				});



			})
		</script>