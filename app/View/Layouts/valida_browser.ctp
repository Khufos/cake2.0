<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Leia-me</title>
 <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
	    
<?php
    echo $this->Html->css('jquery-ui');
    echo $this->Html->css('ui.all');
    echo $this->Html->css('jquery-ui-1.9.0');
    
    echo $this->Html->charset('UTF-8');
    
    echo $this->Html->script('jquery/jquery-1.4.2');
    echo $this->Html->script('jquery/jquery-ui-1.8.2.min');
?>
<script rel="stylesheet">
    jQuery(function() {
        jQuery( "#aviso" ).dialog();
    });
</script>
</head>
<body>
    
    <div align="center" style="margin-bottom: 15px;">
        <?php echo $this->Html->image('logo.jpg',array('alt'=>'Logo Defensoria','width'=>'177px','height'=>'134px')); ?>
    </div>
    <div id="aviso" title="Atenção">
        <?php echo $msg?>
        <br/>
        <?php echo 'Caso não possua baixe '. $this->Html->link('Aqui.','http://www.mozilla.org/pt-BR/download/?product=firefox-16.0.1&os=win&lang=pt-BR',array('class' => 'button', 'target' => '_blank'))?>
    </div>
</body>
</html>