<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title_for_layout ?></title>
        <?php
        echo $this->Html->charset('UTF-8');
        echo $this->Html->css('jquery.jqplot');
        echo $this->Html->css('/bootstrap/css/bootstrap');
        echo $this->Html->css('/bootstrap/css/bootstrap-impressao');

        //echo $this->Html->script('dist/jquery');
        echo $this->Html->script('jquery/jquery-1.4.2');
        echo $this->Html->script('dist/jquery.jqplot');
//echo $this->Html->script('dist/plugins/jqplot.pieRenderer.min');
        echo $this->Html->script('dist/plugins/jqplot.donutRenderer.min');
        echo $this->Html->script('dist/plugins/jqplot.barRenderer.min');
        echo $this->Html->script('dist/plugins/jqplot.pointLabels');
        echo $this->Html->script('dist/plugins/jqplot.pieRenderer');
        echo $this->Html->script('dist/plugins/jqplot.highlighter');
        echo $this->Html->script('dist/plugins/jqplot.categoryAxisRenderer');
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
                border-style:inset;
                border-width: thin;
                height: 25px;
                font-weight: bold;
                text-align: center;
                width: 100%;
                margin-bottom:20px;
                padding-top: 3px;
            }
        </style>
    </head>
    <body>
        <div id="loading" style="display: none;">
            <div id="innerLoading">
                Processando...
                <?php echo $this->Html->image('ajaxBarGreen.gif'); ?>
            </div>
        </div>	<!-- /modal-header -->
        <div align="center">
            <div class='help'>Para Visualizar Impressão: Pressione alt Clique em Arquivo e em seguida 'Visualizar Impressão'.</div>
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