<?php
$link = $this->webroot;
$idAtendente = true;

$logof = $link . "usuarios/logout";
?>
<style>
.modal-aviso {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Cor preta com 50% de transparência */
    overflow: auto;
}

</style>
<!DOCTYPE html>
<html>
<head>
	 <meta name="robots" content="noindex">
     <meta name="googlebot" content="noindex">
	<title>SIGAD - GESTÃO DE ATENDIMENTO</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha512-6HmJ9Y5PZWQVCd4KUwIaSgtDskfsykB+Fvm8Nq98GVCMHstaVoX9jqDdwSyGCbmJy5eLs/DXgDE3SXRS+2B2yA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<?php //if (!$this->Session->read('userDetect')) { ?>
	<!--            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />  -->
	<?php //} ?>
	<?php echo $this->Html->meta('icon', 'img/favicon.png'); ?>
	<!--        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
	<!--        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
	<?php
	echo $this->Html->charset('UTF-8');
	echo $this->Html->css('/bootstrap/css/bootstrap');
	echo $this->Html->css('/bootstrap/css/bootstrap-theme');
	echo $this->Html->css('/bootstrap/css/bootstrap-aplication');
	echo $this->Html->css('validadorJquery/validationEngine.jquery');
	echo $this->Html->css('agenda');
	echo $this->Html->css('botoes');
	echo $this->Html->css('novo-menu');
	echo $this->Html->css('auto_complete');
	echo $this->Html->css('jquery-ui-1.11.4');
	echo $this->Html->css('agendamento');
	echo $this->Html->css('message');
	echo $this->Html->css('/tablesorter/themes/blue/style');
	echo $this->Html->css('fontes');
	echo $this->Html->css('/select2-4.0.1/dist/css/select2');
	echo $this->Html->css('/bootstrap/css/dataTables.bootstrap.min');
	echo $this->Html->css('buttons.dataTables.min');
	echo $this->Html->css('select.bootstrap.min');
	echo $this->Html->css('dataTables.tableTools');
//	echo $this->Html->css('/bootstrap/fonts/font-awesome.min');
	//echo $this->Html->script('jquery/jquery-1.4.2');
	echo $this->Html->script('jquery/jquery-2.1.1.min');
	//echo $this->Html->script('jquery/jquery-1.11.1.min');
	echo $this->Html->script('jquery/jquery-ui-1.11.0');
	echo $this->Html->script('tiny_mce/tiny_mce');
	echo $this->Html->script('/bootstrap/js/bootstrap');
	echo $this->Html->script('jquery/jquery-collapsible');
	echo $this->Html->script('/tablesorter/jquery.tablesorter');
	echo $this->Html->script('/tablesorter/jquery.metadata');
	echo $this->Html->script('validacao');
	echo $this->Html->script('ui.core');
	echo $this->Html->script('jquery/jquery.mask.min');
	echo $this->Html->script('config');
	echo $this->Html->script('operacional');
	echo $this->Html->script('jquery.quicksearch');
	echo $this->Html->script('jquery/jquery.battatech.excelexport');
	echo $this->Html->script('jquery.popupWindow');
	echo $this->Html->script('jquery.stickytableheaders.min.js');

	echo $this->Html->script('/select2-4.0.1/dist/js/select2.full');
	echo $this->Html->script('jquery.dataTables.min');
	echo $this->Html->script('/bootstrap/js/dataTables.bootstrap.min');
	echo $this->Html->script('dataTables.buttons.min');
	echo $this->Html->script('buttons.html5.min');
	echo $this->Html->script('dataTables.select.min');
	echo $this->Html->script('buttons.print.min');
	echo $this->Html->script('dataTables.tableTools.min');
	echo $this->Html->script('pdfmake.min');
	echo $this->Html->script('vfs_fonts');
	echo $this->Html->script('jszip.min');
	echo $this->Html->script('highcharts.js');
	echo $this->Html->script('data.js');
	echo $this->Html->script('drilldown.js');
	echo $this->Html->script('exporting.js');
	echo $this->Html->script('handlebars-v4.0.12.js');

	echo $this->Html->script('jspdf.js');
	echo $this->Html->script('jspdf-autotable.js');
	echo $this->Html->script('printThis.js');

	echo $this->Html->script('lacunaPki.js');

	echo $this->Html->script('FileSaver.js');
	echo $this->Html->script('tableexport.js');


	# Validador jQuery
	echo $this->Html->script('validadorJquery/js/jquery.validationEngine-pt');
	echo $this->Html->script('validadorJquery/js/jquery.validationEngine');
	echo $this->Html->script('jquery/jQueryUiExtends/jquery.dialogextend.min');
	?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126222751-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-126222751-1');
	</script>

	<style>
		/*
		#input_num_unica_menu{
			height: 34px !important;
			padding: 6px 12px !important;
			font-size: 14px !important;
			line-height: 1.42857143 !important;
			color: #555 !important;
			background-color: #fff !important;
			background-image: none !important;
			border: 1px solid #ccc !important;
			border-radius: 4px !important;
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075) !important;
			transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s !important;
		}
		*/
		#filtro_instancia_pje{
			display: block;
		    width: 100%;
			height: 34px;
			padding: 6px 12px;
			font-size: 14px;
			line-height: 1.42857143;
			color: #555;
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			margin-bottom: 0px !important;
		}
		.select2 {
			width:100%!important;
		}
	</style>	
</head>

<body>
	<div class="consultaPJE" align="right">
		<!-- <a  href="#" id="buttonConsulta" class="buttonConsulta">PJE / Consultar Processo</a>  -->
				
		<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar" onclick="myFunction()">
					<span aria-hidden="true">&times;</span>
				</button>
				<br>
				<h5 class="modal-title" id="exampleModalLabel" align="justify">
					Informe o número do processo para realizar a consulta diretamente da nossa integração com o PJE.
				</h5>
			</div>
			<div class="modal-body">
				<form id="processoPJEForm">
				<div class="form-group">
					<input class="form-control num_unica" id="num_unica" method="post" placeholder="Número do Processo" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input>
				</div>
				<?php
					if(isset($solicitacao['processo_pje'])){
						if($solicitacao['processo_pje']){
							echo $this->Html->link("PJE", '/pje/index/'.$solicitacao['numero_processo'], array('class' => "bdpje btn btn-primary",  'target' => '_blank'));
						}
					}
				?>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="myFunction()">Fechar</button>
				<button type="button" class="btn btn-primary" id="consultarBtn">Consultar</button>
			</div>
			</div>
		</div>
		</div>

	</div>
<?php
if (isset($isDefensor) && ($isDefensor)) {
	?>
	<!-- Modal -->
	<!--            <div class="modal fade" id="modalCiente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Agendamento</h4>
                            </div>
                            <div class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>-->
	<?php
}

?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div id="marca">
					<a class="navbar-brand menu" href="#"  title="" alt="">
						<svg width="41" height="30" viewBox="0 0 41 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.5 0V3.33333H40.5V0H0.5ZM0.5 13.3333V16.6667H40.5V13.3333H0.5ZM0.5 26.6667V30H40.5V26.6667H0.5Z" fill="white"/>
						</svg>
					</a>

				<img src="/img/IconDefensoria2.png" alt="logo sigad img" width="31" height="30">
				
				<a 
					class="custom-brand" 
					href="<?php echo $this->webroot; ?>" 
					title="SISTEMA INTEGRADO DE GESTÃO DE ATENDIMENTO" 
					alt="SISTEMA INTEGRADO DE GESTÃO DE ATENDIMENTO"><?php
						$texto = 'SIGAD';
						$amarelo = '#FFD700';
						$vermelho = '#B22222';
						$preto = '#000000';
						$estilo = [
							'display' => 'inline-block',
							'text-align' => 'center',
							'background-color' => '#FF0000',
							'padding-left' => '10px',
							'padding-right' => '10px',
							'border-radius' => '100px'
						];

						$ambiente = Configure::read('AMBIENTE');

						if($ambiente === 'LOCAL') {
							$estilo['background-color'] = $amarelo;
							$estilo['color'] = $preto;

							echo $texto . ' ' . $this->Html->tag(
								'span', 
								'Desenvolvimento', [
								'style' => $this->Html->style($estilo)
							]);
						} else if ($ambiente === 'HOMOLOGACAO') {
							$estilo['background-color'] = $vermelho;

							echo $texto . ' ' . $this->Html->tag(
								'span', 
								'Homologação', [
								'style' => $this->Html->style($estilo)
							]);
						} else {
							echo $texto;
						}
					?>
				</a>

			</div>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<div class="navbar-right">
				<p class="navbar-text" style="font-size: 12px; margin-bottom: 2px;">
					<?php
					$pessoa = $this->Session->read('Pessoa.nome');
					$LogU = $this->Session->read('Usuario.LogU');
					$link = $this->Session->read('webroot');
					$unidade_nome = $this->Session->read('Funcionario.unidade_nome');
					$trocaSenha = $link . "usuarios/trocar_senha";
					$atuacao = $link . "rc_especializada_funcionarios";
					$isDefensor = $this->Session->read('isDefensor');
					$defensorVariosVect = $this->Session->read('defensoresVinculados');
					$isGTIntegracaoPJE = $this->Session->read('isGTIntegracaoPJE');
					?>
				</p>
				<ul class="nav navbar-nav" style="font-size: 13px; ">

					
						<?php $tipoFunc = $this->Session->read('Funcionario.tipo_funcionario');
						if($tipoFunc != 4):?>
							<li class="dropdown" >
								<a href="#" class="dropdown-toggle alinhar-flexbox" id="menu_atuacao" data-toggle="dropdown" title="Minhas Atuações" aria-haspopup="true" aria-expanded="true">
								<?php 	if(isset($defensorVariosVect)):?>
									<svg xmlns="http://www.w3.org/2000/svg" width="20" style="margin-right: 2px" height="20" viewBox="0 0 25 25" fill="none">
										<path d="M12.5 0C5.6 0 0 5.6 0 12.5C0 19.4 5.6 25 12.5 25C19.4 25 25 19.4 25 12.5C25 5.6 19.4 0 12.5 0ZM17.0125 7.925C18.35 7.925 19.425 9 19.425 10.3375C19.425 11.675 18.35 12.75 17.0125 12.75C15.675 12.75 14.6 11.675 14.6 10.3375C14.5875 9 15.675 7.925 17.0125 7.925ZM9.5125 5.95C11.1375 5.95 12.4625 7.275 12.4625 8.9C12.4625 10.525 11.1375 11.85 9.5125 11.85C7.8875 11.85 6.5625 10.525 6.5625 8.9C6.5625 7.2625 7.875 5.95 9.5125 5.95ZM9.5125 17.3625V22.05C6.5125 21.1125 4.1375 18.8 3.0875 15.85C4.4 14.45 7.675 13.7375 9.5125 13.7375C10.175 13.7375 11.0125 13.8375 11.8875 14.0125C9.8375 15.1 9.5125 16.5375 9.5125 17.3625ZM12.5 22.5C12.1625 22.5 11.8375 22.4875 11.5125 22.45V17.3625C11.5125 15.5875 15.1875 14.7 17.0125 14.7C18.35 14.7 20.6625 15.1875 21.8125 16.1375C20.35 19.85 16.7375 22.5 12.5 22.5Z" fill="white"/>
									</svg>
									<?php echo "<div class='nameDef'><span> Def. Vinculo</span> <div class='vinculoDef'>". $NomeDefPrinc ."</div>" ."</div>" ?>
										<?php	if(count($defensorVariosVect) > 1): ?>
										<span class="glyphicon glyphicon-chevron-down chvron-header" aria-hidden="true"></span>
										<?php endif; ?>
								<?php endif; ?>
									</a>
								<?php 	if(isset($defensoresSelectVinculo)):?>
									<ul class="dropdown-menu" aria-labelledby="menu_atuacao">
										<?php 	foreach($defensoresSelectVinculo as $defensorVect):?>
												<li>
													<a href="#" onclick="changeVinculo(event,<?php echo  $defensorVect['f']['id'] ?>,<?php echo  $idVinculoGlobal ?>,<?php echo  $idFuncGlobal ?>)">
														<span class="glyphicon glyphicon-user"aria-hidden="true"></span>
														<?php echo  $defensorVect['p']['nome'];?> 
													</a>
											</li>
										<?php 	endforeach;?>
									</ul>
								<?php endif; ?>

							</li>
						<?php endif; ?> 

						<?php if($tipoFunc == 4):?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" id="menu_atuacao" data-toggle="dropdown" title="Minhas Atuações" aria-haspopup="true" aria-expanded="true">
									<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
										Área de Atuação
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="menu_atuacao">
									<li><a href="<?php echo $atuacao; ?>">Gerenciar</a></li>
								</ul>
							</li>
						<?php endif; ?> 
						<?php if(!\is_null($this->Session->read('isPerfilPainelDefensor')) && $this->Session->read('isPerfilPainelDefensor') === true): ?>
	                        <li>	                            
	                            <a class= "bt_painel_defensor" id="link_painel" target="_blank" 
	                            	href= "<?= Configure::read('URL_ACESSO_PAINEL'); ?>/usuario/login"><p>Painel do Defensor</p></a>
	                        </li>
                    	<?php endif; ?> 
						<li style="margin-right: 10px; margin-top: 8px;">
							<div id="instanciaSelect" >
									<select id="filtro_instancia_pje" name="filtro_instancia_pje" style="">
										<option value="1" selected>1 Grau</option>
										<option value="2">2 Grau</option>
									</select>
							</div>
						</li>
						<li>
							<div>
								<form id="processoPJEForm" style="margin-bottom: 0px; margin-right: 10px;">
									<div class="d-flex justify-content-start input-header-box">
										<input id="input_num_unica_menu" class="num_unica" style="  display: inline !important; width: auto !important;" method="post" placeholder="Número do Processo" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input>
										<button id="consultarBtnIcon" class="num_unica_btn" style="margin: 0px !important;" type="button"><i class="fa fa-search"></i></button>
									</div>
								</form>
							</div>
						</li>
					
					<?php if(!\is_null($this->Session->read('perfilLimitado')) && $this->Session->read('perfilLimitado') === true): ?>
						<li style="margin-left: 5px"><?php echo $this->element('contador_sessao');   ?></li>
					<?php endif; ?>
					<li style="margin-top:3px;">
			
					<?php									
						//if(!empty($this->Session->read()['Funcionario']['tipo_funcionario'])){
							//if(!empty($this->Session->read()['Acolhido']['diasAcolhimento'])){
	 					// Se o funcionário for defensor, o número de dias do acolhido for superior a 90 dias e o usuário faz parte do grupo acolher código 104
	 
								if($this->Session->read()['Funcionario']['tipo_funcionario'] == 4 && 
								   $this->Session->read()['Funcionario']['perfis_usuario'] == 104 && 
								   $this->Session->read()['acolhidoEmAcolhimento'] == true){ 
									   
								echo $this->Html->link($this->Html->div('glyphicon glyphicon-envelope envelopeAcolhido', ''), array(
									'controller' => 'pesProcessos',
									'action' => "pesquisarAcolhidos",
									'class' => "envelopeAcolhido"
										)
										, array(
									'id' => "linkProcesso",
									'class' => 'link-modal',
									'data-target' => "#modal",
									'data-toggle' => "modal",
									'title' => 'Visualizar acolhidos',
									'escape' => false
								));
								
							//}
						//}
					}
					?>
					</li>
					<?php if ((isset($isAtendente) && ($isAtendente)) || (isset($isDefensor) && ($isDefensor))) {   ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle glyphicon glyphicon-bullhorn" data-toggle="dropdown" title="Painel de Agendamentos e Senhas" alt="painel" id="exibir_painelSenha">
								<b><div id="qtd_agd" style="margin-top:-30px; margin-left:15px; color:white; display:none;"></div></b>
							</a>
						</li>

					<?php } if ($MOBILE) { ?>
						<li>
							<?php
							echo $this->Html->link('Versão Mobile', array('controller' => 'mobiles', "action" => 'habilitarLayoutMobile'));
							?>
						</li>
					<?php } ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle glyphicon glyphicon-question-sign" data-toggle="dropdown" title="Ajuda" alt="Ajuda"></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<?php
								$wroot = $this->webroot;
								$caminho = "$wroot./repositorio/cartilha/MANUAL_DO_SIGAD.pdf";
								?>
								<a href="<?php echo $caminho ?>" target="_blanck" title="Visualizar Cartilha do SIGAD">
									Cartilha do Sigad
								</a>
							</li>
						</ul>
					</li>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle glyphicon glyphicon-cog" style="margin-right: 15px" data-toggle="dropdown" title="Configurações" alt="Configurações"></a>
						<ul class="dropdown-menu" role="menu">
							<li style="padding: 3px 20px; font-size: 12px; background-color: #E9E9E9;">
								<?php 
									if (!empty($LogU)) {
										echo "<span> <strong>Usuário:</strong> " . $LogU . "</span>";
									}
									if (!empty($unidade_nome)) { 
										echo "<br>";
										echo "<strong>Unid.:</strong> " . $unidade_nome;
									}
								?>
							</li>
							<li><a href="<?php echo $trocaSenha; ?>">Alterar Senha</a></li>
							<?php if($isGTIntegracaoPJE) : ?>
								<li><a href="javascript:void(0)" onclick="abrirModalPjeSenha()">Informe sua senha do PJE</a></li>
							<?php endif; ?>
							<li><?php echo $this->Html->link('Melhorias do SIGAD2', array('controller' => 'melhoria_aplicadas', 'plugin' => null));
								?></li>
						</ul>
					</li>
				</ul>
				<?php echo $this->Html->link($this->Html->div('glyphicon glyphicon-off', ''), array('action' => 'logout', 'controller' => 'usuarios', 'plugin' => false), array('escape' => false, 'title' => 'Sair', 'class' => 'btn btn-primary', 'style' => 'margin:10px 7px 0 0;'));
				?>

			</div>
		</div>
	</div>
</div>
<div id="Aviso" class="modal modal-aviso" tabindex="10" role="dialog">
    <div class="modal-dialog" role="document" style="width: 800px; ">
        <div class="modal-content">
            <div class="modal-header" style="padding: 3px;">
                <div style="padding: 14px;border: 1px solid #4c574c; background-color: #3f883f;color: white;border-radius: 4px; ">
					<div class="row">
						<div class="col-md-11">
							<h4 class="modal-title">AVISO</h4>

						</div>
						<div class="col-md-1">
							<div onclick="FecharAvisoDefault()" style="color: white; margin: 5px; cursor: pointer;" class="glyphicon glyphicon-remove"></div>
						</div>
						
					</div>

                </div>
            </div>
            <div class="modal-body" style="max-height:1000px;">
                <div id="janelaMarcador" class="well">
                    <div style="width: 100%; max-height: 500px; overflow:auto;">
						<p>Prezadas (os) usuárias (os),</p>
						<p>Informamos que, a partir da data de hoje, está em atividade no SIGAD uma funcionalidade que permite o registro de acessos visando aprimorar a segurança e transparência em nossa plataforma. Este informe tem como objetivo garantir a integridade dos dados, proteger a privacidade dos usuários e fortalecer a confiança em nossos serviços.</p>
						<p>Os registros de acessos terão as seguintes informações: usuário, cargo, unidade de atendimento, data e horário de acesso, o tipo de tela visualizada, e o link que direciona para a tela acessada pelo usuário. Esses dados serão tratados com a máxima confidencialidade, em conformidade com a Lei Geral de Proteção de Dados, somente acessível para os Coordenadores, Coordenadoras e Corregedoria".</p>
						<p>Atenciosamente,</p>
						<p>Comissão Especial para acompanhamento da LGPD na DPE/BA</p>
						<input type="checkbox" name="concordo-lgpd" id="concordo-lgpd" style="margin: 10px; transform: scale(1.3);"/>
						<strong>Estou ciente das informações acima.</strong>
                    </div>
                </div>
            </div>
			<div class="modal-footer" style="padding: 3px;">
            <div style="padding: 6px;border: 1px solid #4a884a6b; background-color: #4a884a6b;border-radius: 4px;">

                <button id="btnFecharModalMarcador" type="button" onclick="atualizarLgpd()" class="btn btn-success" data-dismiss="modal" style="float: none;">Ciente</button>
            </div>
        </div>
        </div>
    </div>
</div>
<cake:nocache>

</cake:nocache>
<!-- Se você gostaria que algum tipo de menu seja mostrado em todas as suas views, insira ele aqui -->
<!-- Large modal -->

<div id="loading" style="display: none;">
	<div id="innerLoading">
		Processando...
		<?php echo $this->Html->image('ajaxBarGreen.gif'); ?>
	</div>
</div>
<div id="header" align="center">

</div>
<div class="noPrint" style="display: none;text-align: center; line-height: 36px; background-color: #FFFF33; font-weight: bold;  font-family: 'Time new Roman'; clear: both; height: 40px; ">
        <span>
            Por motivo de manutenção em nossos servidores, o sistema SIGAD ficará indisponível a partir das 18:30, com
            previsão de retorno às 20:00.
        </span>
</div>
<?php echo $this->element('menu'); ?>
<!-- � aqui que eu quero que minhas views apare�am -->
<div id="principalContainerPaiTela" class="container-fluid">
	<div class="row">
		<?php
		$class = "col-sm-12 col-md-12 main";
		if ((isset($isAtendente) && ($isAtendente)) || (isset($isDefensor) && ($isDefensor)))
			$class = "col-sm-12 col-md-12  main";
		?>
		<div class="<?php echo $class; ?>">

			<div class="noPrint" id="message"><?php echo $this->Session->flash(); ?></div>

			<h3 class="page-header"><?php echo $this->fetch('title'); ?></h3>

			<?php $acoes = $this->element('acoes_assistido');?>
			<?php if (strlen($acoes) > 0) : ?>
				<div class="acoes">
					<?= $acoes ?> <!-- A váriavel precisa ser setada em '$acoesArray'de cada página <Controller> -->
				</div>
			<?php endif; ?>
			
			<div id="titulo">
				<?php
				echo $this->fetch('content');
				?>
				<?php //echo $this->element('sql_dump');  ?>
				<div id="legenda" class="noPrint">
					<?php
					echo isset($legenda) ? $legenda : "";
					?>
				</div>
			</div>
			<div style="clear: both"></div>
			<div class="acoes">
				<?php
				echo $this->element('acoes_assistido');
				?>
			</div>
		</div>
	</div>

</div>
<?php echo $this->element('painel_senha'); ?>
<?=$this->element('Pje/autenticacao') ?>

<!-- Modal content -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="gerenciar_modal" class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>

<div class="modal fade" id="modal2"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="gerenciar_modal" class="modal-dialog modal-lg2">
		<div class="modal-content">
		</div>
	</div>
</div>

<div class="modal fade" id="modal3"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="gerenciar_modal" class="modal-dialog modal-lg3">
		<div class="modal-content">
		</div>
	</div>
</div>


<!-- FIM -->
<?php
echo $this->Js->writeBuffer(array('cache' => FALSE));
?>
<script type="text/javascript">
	$('#modal').on('hidden.bs.modal', function () {
		$(this).removeData('bs.modal');
	});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.12/dist/sweetalert2.all.min.js"></script>

</body>
</html>

<?php
/** MENSAGENS */
$this->Util->setaValorPadrao($msgAlert, '');
if (!empty($msgAlert)) {
	echo "<script> alert('$msgAlert'); </script>";
	unset($msgAlert);
}

$this->Util->setaValorPadrao($redirect, '');
if (!empty($redirect)) {
	echo "<script>
        window.location='$redirect';
    </script>";
	unset($redirect);
}
?>
<script>

function changeVinculo(e,defId,idVinc,idFunc) {
	e.preventDefault();
	
	$.ajax({
		type: "POST",
		url: "<?php echo $this->Html->url(array('controller' => 'vinculo', 'action' => 'changevinculodefensor'), true) ?>",
		data: {
			id_defensor: defId,
			id_vinculo: idVinc,
			id_funcionario: idFunc,
		},
		success: function(response) {
			
			
		}
	});
	alert("Associação do defensor alterada com sucesso!");
	location.reload(true);
}


	//if($('#painel_de_senhas').is(':visible') &&  $("#menu-esquerdo").is(':visible') ){
	//$(".main").removeClass('col-md-12 conteudo-principall conteudo-principal');    $(".main").addClass('t');
	//}

	$('#consultarBtn').click(function(){
		var proc = $('#num_unica').val();
		var url = "/pje/index/" + proc;
		window.open(url);
	});

	$('#consultarBtnIcon').click(function(){
		var proc = $('#input_num_unica_menu').val();
		var instancia = $('#filtro_instancia_pje').val();
		
		var url = "/pje/index/" + proc;
		if(instancia == '2'){
			url = "/pje/index?numeracaoUnica=" + proc + "&urlOrigem=consulta_processo_segundo_grau";
		}
		
		window.open(url);
	});

	if($("#menu-esquerdo").is(":visible") && $("#painel_de_senhas").is(":visible")){
		$(".main").removeClass("conteudo conteudo-principal col-md-12");
		$(".main").addClass("teste");
	}

	/**
	 * Global SweetAlert definition
	 * @param title
	 * @param message
	 */
	function alertError(title, message) {
		swal({
			type: 'error',
			title: title,
			text: message
		});
	}

	jQuery(".num_unica").mask("9999999-99.9999.999.9999");

	$(document).ready(function(){
		$('#buttonConsulta').click(function(){
			$('#exampleModal').modal('show')
		});
	});

	$('#exampleModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Botão que acionou o modal
		var recipient = button.data('whatever') // Extrai informação dos atributos data-*
		var modal = $(this)
	})

	function myFunction() {
		document.getElementById("processoPJEForm").reset();
	}

	$(document).ready(function() {
		$.ajax({
			type: "GET",
			url: "<?php echo $this->Html->url(array('controller' => 'funcionarios', 'action' => 'verificarlgpd?trs=1'), true) ?>",
			datatype: 'json',
			success: function(response) {
				if(response != 1){
					$('#Aviso').addClass('show')
				}
			}
		});
	});
	function FecharAvisoDefault(){
		$('#Aviso').removeClass('show').addClass('fade');
	}
	function atualizarLgpd(){
		check = $("#concordo-lgpd").prop("checked")
		if(check){
			$.ajax({
				type: "POST",
				url: "<?php echo $this->Html->url(array('controller' => 'funcionarios', 'action' => 'updateLgpd?trs=1'), true) ?>",
				datatype: 'json',
				success: function(response) {
					FecharAvisoDefault()
				}
			});
			FecharAvisoDefault();
		}else{
			alert("Marque a caixa, para concordar com as informações.")
		}
	}

</script>
