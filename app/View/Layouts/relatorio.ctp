<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title_for_layout?></title>
         <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
<?php
    echo $this->Html->charset('UTF-8');
    echo $this->Html->css('operacional');
    echo $this->Html->css('impressao');
    echo $this->Html->script('prototype');
    echo $this->Html->css('/bootstrap/css/bootstrap');
    echo $this->Html->css('/bootstrap/css/bootstrap-impressao');
    echo $this->Html->script('jquery/jquery-1.10.2');
    echo $this->Html->script('/bootstrap/js/bootstrap');
    echo $this->Html->script('jquery/jquery.battatech.excelexport');
?>
    </head>
    <body>
        <div align="center" style="margin-bottom: 15px;">
            <div align="center">
        <?php echo $this->Html->image('marca_relatorio.png'); ?>
            </div>
            <span>
                Data de Emissão: <?php echo date("d/m/Y H:i:s"); ?>
            </span><br/>
            <div id="impressao">
    <?php
        echo $this->fetch('content');
    ?>
            </div> 
        </div>
    </body>
</html>