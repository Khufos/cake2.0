<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title_for_layout ?></title>
         <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
        <?php
        echo $this->Html->charset('UTF-8');
        echo $this->Html->css('/bootstrap/css/bootstrap');
        echo $this->Html->css('/bootstrap/css/bootstrap-impressao');
        echo $this->Html->script('jquery/jquery-1.10.2');
        echo $this->Html->script('/bootstrap/js/bootstrap');
        ?>
        <link rel="icon" href="/sigad/img/fav-icon-2.png" type="image/png" />
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
        </style>
    </head>
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
            </div><br/>            
            <div id="impressao">               
                <?php
                echo $this->fetch('content');
                ?>
            </div>
        </div>
    </body>
</html>
