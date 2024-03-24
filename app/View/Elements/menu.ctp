<cake:nocache>
	<?php
# expandir o módulo selecionado
    if (!isset($idModulo)) {
        $idModulo = 0;
    }
    $menu = $this->Session->read('menu');
    ?>
		<div class="col-sm-3 col-md-2 sidebar-left" id="menu-esquerdo" style="display:none">
			<div class="panel-group" id="accordion-menu">
				<?php
            if (!empty($menu))
                echo $menu;
            ?>
			</div>
		</div>
		<?php if (!empty($menu)) { ?>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#m<?php echo $idModulo; ?>').addClass('collapse in');
				});
			</script>
			<?php } ?>
</cake:nocache>






<script>
	// script novo para exibir e ocultar conteudo principal - rafaela fernandes 17/04/208
	$(".menu").click(function() {

		$("#menu-esquerdo").toggle("fade", function() {


			if ($("#menu-esquerdo").is(":visible")) {
				$(".main").addClass("conteudo-left-menu");
			} else {
				$(".main").removeClass("conteudo-left-menu");
			}
			
			if($("#painel_de_senhas").is(":visible")){
				$(".main").toggleClass("conteudo-menor")
			}


		});







	});
</script>