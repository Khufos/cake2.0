<?php
$idAtendente = true;

$logof = $link . "usuarios/logout";
$pessoa = $this->Session->read('Pessoa.nome');
$link = $this->Session->read('webroot');
$logout = $link . "usuarios/logout";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>SIGAD - GESTÃO DE ATENDIMENTO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />  
        <?php
        echo $this->Html->css('/bootstrap/css/bootstrap');
        echo $this->Html->css('/bootstrap/css/bootstrap-theme');
        echo $this->Html->css('/bootstrap/css/bootstrap-aplication');
        echo $this->Html->css('validadorJquery/validationEngine.jquery');
        echo $this->Html->css('agenda');
        echo $this->Html->css('auto_complete');
        echo $this->Html->css('jquery-ui-1.11.4');
        echo $this->Html->css('agendamento');
        //echo $this->Html->css('message');
        echo $this->Html->css('/tablesorter/themes/blue/style');
        //echo $this->Html->script('jquery/jquery-1.4.2');
        echo $this->Html->script('jquery/jquery-1.11.1.min');
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
    </head>
    <body>
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
                        <?php echo $this->Html->image('IconDefensoria.png'); ?>
                        <a class="navbar-brand" href="<?php echo $this->webroot; ?>">SIGAD</a> 
                    </div>                    
                </div>
                <div id="navbar" class="navbar-collapse collapse">   
                    <div class="navbar-right">
                        <p class="navbar-text">
                            <?php
                            $pessoa = $this->Session->read('Pessoa.nome');
                            $link = $this->Session->read('webroot');
                            $trocaSenha = $link . "usuarios/trocar_senha";
                            if (!empty($pessoa)) {
                                echo "<span>" . $pessoa . "</span>";
                            }
                            ?>
                        </p>
                        <ul  class="nav navbar-nav">
<!--                            <li><?php //echo $this->element('contador_sessao');   ?></li>-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configurações<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo $trocaSenha; ?>">Alterar Senha</a></li>
                                    <li><a href="javascript:void(0)" onclick="abrirModalPjeSenha()">Alterar Senha do PJE</a></li>
                                    <li><?php echo $this->Html->link('Melhorias do SIGAD', array('controller' => 'melhoria_aplicadas', 'plugin' => null));
                            ?></li>
                                </ul>
                            </li>
                            <li>
                                <?php
                                $wroot = $this->webroot;
                                $caminho = $wroot . "repositorio/cartilha/CARTILHA_SIGAD.pdf";
                                ?> 
                                <a href="<?php echo $caminho ?>" target="_blanck" title="Visualizar Cartilha do SIGAD">
                                    Cartilha do Sigad
                                </a>
                            </li>
                            <li>
                                <?php
                                 echo $this->Html->link('Versão Web', array('controller' => 'mobiles', "action" => 'desabilitarLayoutMobile'));
                                ?> 
                            </li>
                        </ul>                        
                        <?php echo $this->Html->link($this->Html->div('glyphicon glyphicon-off', ''), array('action' => 'logout', 'controller' => 'usuarios', 'plugin' => false), array('escape' => false, 'title' => 'Sair', 'class' => 'btn btn-primary', 'style' => 'margin:10px 7px 0 0;'));
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div id="loading" style="display: none;">
            <div id="innerLoading">
                Processando...
                <?php echo $this->Html->image('ajaxBarGreen.gif'); ?>
            </div>
        </div>
        <div id="container-fluid">
            <div class="noPrint" id="message" title="Click aqui para fechar esta mensagem.">
                <?php echo $this->Session->flash(); ?>                    
            </div>
            <?php if($this->fetch('title') != 'mobiles'){ ?>
            <h3 class="page-header"><?php echo $this->fetch('title'); ?></h3>
            <?php } ?>
            <?php
            echo $this->fetch('content');
            ?>
        </div>        
    </body>

</html>
<?php
echo $this->Js->writeBuffer(array('cache' => FALSE));
?>
<?=$this->element('Pje/autenticacao') ?>
<?php
/** MENSAGENS */
$this->Util->setaValorPadrao($msgAlert, '');
if (!empty($msgAlert)) {
    echo "<script> alert('$msgAlert ') </script>";
    unset($msgAlert);
}

$this->Util->setaValorPadrao($redirect, '');
if (!empty($redirect)) {
    echo "<script>
        window.location='$redirect';
        lc.start('request');
    </script>";
    unset($redirect);
}
?>
