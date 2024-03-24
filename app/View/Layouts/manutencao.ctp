<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>SIGAD - GESTÃO DE ATENDIMENTO</title>
        <!--<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">-->
        <?php
        echo $this->Html->charset('UTF-8');
        echo $this->Html->css('default');
        echo $this->Html->css('operacional');
        echo $this->Html->css('botoes');
        echo $this->Html->css('ui.all');
        echo $this->Html->css('jquery-ui');
        echo $this->Html->css('login');
        
        echo $this->Html->css('jAlert/jquery.alerts');
        echo $this->Html->css('validadorJquery/validationEngine.jquery');
        echo $this->Html->css('message');

        echo $this->Html->script('jquery/jquery-1.4.2');

        echo $this->Html->script('jquery/jquery-collapsible');

        echo $this->Html->script('validacao');
        echo $this->Html->script('thickbox');
        echo $this->Html->script('ddaccordion');
        echo $this->Html->script('ui.core');

        echo $this->Html->script('botoes');

        echo $this->Html->script('operacional');
        echo $this->Html->script('jquery/jquery-mask');
        echo $this->Html->script('jquery/jquery-ui-1.8.2.min');
        
        # Validador jQuery
        echo $this->Html->script('validadorJquery/js/jquery.validationEngine');
        echo $this->Html->script('validadorJquery/js/jquery.validationEngine-pt');

        ?>
    </head>
      <link rel="icon" href="/sigad/img/favicon.png" type="image/png">
    <body>
        <div id="tudo">                        
            <!-- Se você gostaria que algum tipo de menu seja mostrado em todas as suas views, insira ele aqui -->
            <div id="box_principal" >                
                <div id="header" align="center">
                    <div id="topo_sigad"></div>
                    <div id="ft"></div>
                </div>
                <div id="barra_topo"> 
                    <span>Sistema Integrado de Gestão de Atendimento</span> 
                </div>                
                <div id="box_content" class="content"> 
                    <div class="noPrint" id="message" title="Click aqui para fechar esta mensagem.">
                        <?php $this->Session->flash(); ?>                    
                    </div>
                    <div id="aba_principal">                        
                        <div id="titulo">
                       	  <br /><br />
                            <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:50px">
                              <tr>
                                <td><h1>Desculpe! Estamos em manutenção.</h1>
                            <p><h3 align="justify" style="color:red;">Estamos trabalhando para melhorar esta funcionalidade do sistema. Os demais recursos estão disponíveis para uso.</h3></p>
                            </td>
                              </tr>
                              <tr>
                                <td align="center"><h2><a href="javascript: history.go(-1)">Voltar para o sistema</a></h2></td>
                              </tr>
                            </table>
                      </div>
                    </div>
                </div>
            </div>
            <div id="rodape">
                <table width="100%">
                    <tr> 
                        <td align="center" id="font_rodape"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DEFENSORIA PÚBLICA DO ESTADO DA BAHIA</td>
                        <td id="bandeira" align="center"></td>

                    </tr>
                </table>
            </div>
            <!-- </div> -->
            <!-- Adicione um rodap� para cada p�gina mostrada -->
        </div>
    </body>
</html>