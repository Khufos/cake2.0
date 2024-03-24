<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>SIGAD - GESTÃO DE ATENDIMENTO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"> 
        <?php echo $this->Html->meta('icon', 'img/favicon.png'); ?>
        <?php
        echo $this->Html->charset('UTF-8');
        echo $this->Html->css('/bootstrap/css/bootstrap');
        echo $this->Html->css('/bootstrap/css/bootstrap-theme');
        echo $this->Html->css('/bootstrap/css/bootstrap-aplication');
        echo $this->Html->css('/bootstrap/bootstrapvalidator/dist/css/bootstrapValidator.min');
        echo $this->Html->css('login');
        echo $this->Html->css('message');
		
		echo $this->Html->script('jquery/jquery-2.1.1.min');
    	//echo $this->Html->script('jquery/jquery-1.10.2');
        echo $this->Html->script('/bootstrap/js/bootstrap');
        echo $this->Html->script('/bootstrap/bootstrapvalidator/dist/js/bootstrapValidator.min.js');
        ?>
              
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div id="marca">   
                        <?php echo $this->Html->image('IconDefensoria.png'); ?>
                        <a class="navbar-brand" href="<?php echo $this->webroot; ?>">SIGAD</a>
                        <?php 
                        if(!$MOBILE){ ?>
                        <span>SISTEMA INTEGRADO DE GESTÃO DE ATENDIMENTO</span>   
                        <?php } ?>
                    </div>                    
                </div>                
            </div>
        </div>
        <div id="container-fluid">
            <div class="noPrint" id="message" title="Click aqui para fechar esta mensagem.">
                <?php echo $this->Session->flash(); ?>                    
            </div>                      
            <div id="container-login">
                <div class="col-md-2 col-md-offset-5">  
                    
                    <div id="logo-login">
                        <?php echo $this->Html->image('logo_login.png'); ?>
                    </div>
                    <div class="well">
                    <?php
                    echo $this->fetch('content');
                    ?>
                    </div>
                </div>
            </div>
        </div>
        
    </body>

</html>
<?php
/** MENSAGENS */
$this->Util->setaValorPadrao($msgAlert, '');
if (!empty($msgAlert)) {
    echo "<script> alert('$msgAlert') </script>";
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