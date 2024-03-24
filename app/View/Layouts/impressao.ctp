

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
        <title><?php echo $title_for_layout ?></title>
        <?php
        echo $this->Html->charset('UTF-8');
        //echo $this->Html->css('/bootstrap/css/bootstrap');
        echo $this->Html->css('/bootstrap/css/bootstrap-impressao');
        echo $this->Html->script('jquery/jquery-1.10.2');
        echo $this->Html->script('/bootstrap/js/bootstrap');
        echo $this->Html->script('jquery/jquery.battatech.excelexport');
        ?>
        <style type="text/css">
            @media print {
                #imprimir{
                    display: none;
                }
                .help{
                    display: none;
                }
            }
            #noPrint{
                display: none;
            }

            .help{
                background:#FFFACD;
                height: 25px;
                text-align: center;
                width: 100%;
                margin-bottom: 10px;
                padding: 3px;
            }

            html table{
                border:1px solid #000 !important;
                border-collapse: collapse;
            }

            html table td{
                border:1px solid #000 !important;
            }

            html table th{
                border:1px solid #000 !important;
            }
        </style>
    </head>
<?php 
    $logado = $this->Session->read('logado');

    if (!$logado) {
        die('');
    }

?>
    <body>
        <div class='help'>Para Visualizar Impressão: Pressione Alt Clique em Arquivo em seguida 'Visualizar Impressão'.</div>
        <div id="loading" style="display: none;">
            <div id="innerLoading">
                Processando...
                <?php echo $this->Html->image('ajaxBarGreen.gif'); ?>
            </div>
        </div>	<!-- /modal-header -->
        <div align="center">
            <div align="center">
                <?php echo $this->Html->image('marca_relatorio.png'); ?>
            </div>
            <span>
                Data de Emissão: <?php echo date("d/m/Y H:i:s"); ?>
            </span><br/>

            <div id="impressao" class="col-md-12">               
                <?php
                echo $this->fetch('content');
                ?>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript" DEFER="DEFER">
    jQuery(window).load(function () {
        setTimeout(function () {
            window.print();
        }, 1000);
//        60000 = 1 min;
    });
</script>