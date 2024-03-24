<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $title_for_layout?></title>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <?php 
    echo $this->Html->charset('UTF-8');
    echo $this->Html->css('/bootstrap/css/bootstrap');
    echo $this->Html->script('jquery/jquery-1.10.2');
    echo $this->Html->script('/bootstrap/js/bootstrap');
    ?>
    <link rel="icon" href="/sigad/img/fav-icon-2.png" type="image/png">
</head>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.noPrint').hide();
    });
    </script>
<body>
	<div id="loading" style="display: none;" class="ui-corner-all">
    	<div id="innerLoading">
        	Processando...
            <?php echo $this->Html->image('ajaxBarGreen.gif'); ?>
        </div>
    </div>	<!-- /modal-header -->
    <div align="center">
        <div align="center" style="margin-bottom: 15px;">
            <?php echo $this->Html->image('logo_login.JPG',array('alt'=>'Logo Defensoria')); ?>
        </div>
        <span class="direita label">
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