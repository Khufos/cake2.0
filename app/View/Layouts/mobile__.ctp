<?php
$pessoa = $this->Session->read('Pessoa.nome');
$link = $this->Session->read('webroot');
$logout = $link . "usuarios/logout";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>SIGAD - GESTÃO DE ATENDIMENTO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />  
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <?php
        echo $this->Html->charset('UTF-8');
        echo $this->Html->css('jqueryMobile/sigad.min');
        echo $this->Html->css('jqueryMobile/jquery.mobile.icons.min');

        //echo $this->Html->script('jquery/jquery-1.10.2');
        ?>
        <!--        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />-->
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>
        <div data-role="page" data-theme="a">
            <div data-role="header" data-position="inline" data-position="fixed">
                <h2>SIGAD</h2>    
            </div>
            <div role="main" class="ui-content" data-theme="a">
                <?php
                echo $this->fetch('content');
                ?>
            </div> 

            <div data-role="footer" data-theme="a" data-position="fixed">
                <a href="<?php echo $logout; ?>" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ui-btn-icon-left ui-icon-power">Sair</a>
            </div><!-- /footer -->
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