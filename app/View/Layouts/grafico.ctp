<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Relat&oacute;rio</title>

<?php
	echo $this->Html->script('jquery/jquery-1.4.2');
	echo $this->Html->script('FusionCharts');
	echo $this->Html->script('operacional');
	echo $this->Html->script('jquery/jquery-mask');
	echo $this->Html->script('jquery/jquery-ui-1.8.2.min');
	echo $this->Html->script('jquery/jquery-1.4.2.min');
	
	echo $this->Html->css('jquery-ui');
?>

</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<style type="text/css">
    body{
        margin:0px;
    }

    .comarca{
        border-style:solid;
        border-width:1px;
    }

    h1{
        font-family:Arial, Helvetica, sans-serif;
        font-size:24pt;
        margin:25px 0px 0px 0px;
        text-align:center;
    }

    h2{
        font-family:"Times New Roman", Times, serif;
        font-size:15pt;
        margin:0px 0px 20px 0px;
        text-align:center;
    }
	
	#graphControls{
        height:70px;
		width:320px;
		margin:0 auto;
		margin-top:-22px;
		display:none;
		background-image:url(/sigad/img/bgGraphControl.png);
		background-repeat:repeat-x;
    }
	
	#graphControls input{
        border-style:solid;
		border-width:1px;
		border-color:#000000;		
    }
	
	a{
		outline:none;
	}
	
	#arrowdown{
		background-color:#FFFFFF;
		width:100%;
		text-align:center;
		margin-top:-22px;
		cursor:pointer;
    }
	
	div.ui-datepicker{
 		font-size: 55%;
	}
</style>
<script type="text/javascript">
    jQuery(document).ready(function(){
		jQuery("#graphPeriod").show();
		
		/* Avanca relatorio */
		jQuery("#btNext").click(function(){
			jQuery("#frmGraph").submit();
		});
		
		/* Volta relatorio */
		jQuery("#btNext").click(function(){
			jQuery("#frmGraph").submit();
		});
		
		
		/* Play ou pause no relatorio */
		var time = 30000;
		jQuery("#btPause").click(function(){			
		}).toggle(function(){
				time = 0;
				jQuery("#imgPlayPause").attr("src", "/sigad/img/icones24/pause24.png");
			}, 
			function(){
				time = 30000;				
				jQuery("#imgPlayPause").attr("src", "/sigad/img/icones24/play24.png");
			}
		);
		
		
		/* Atualiza pagina a cada N segundos definido na variavel time */	
        setInterval(function(){
			if(time > 0){
            	jQuery("#frmGraph").submit();
			}
        }, time);
		

		/* Exibe/Oculta menu de controles para exibição do grafico */
		jQuery("#arrowdown").toggle(
			function(){
				jQuery(this).css("margin-top", "0px");
				jQuery("#graphControls").slideDown("slow");
			},			
			function(){				
				jQuery("#graphControls").slideUp("slow", function(){
					jQuery("#arrowdown").css("margin-top", "-22px");
				});
			}
		);
    });
</script>
<form name="form1" method="post" action="">
<div id="graphPeriod">
<div id="graphControls" class="ui-corner-bottom">
  <table width="94%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="41%"><b>In&iacute;cio</b></td>
      <td width="41%"><b>Fim</b></td>
      <td width="18%" rowspan="2" valign="bottom"><?php echo $this->Form->submit("Filtrar")?></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input("dt_inicio", array("size" => 12, "label" => false, "class" => 'data')) ?></td>
      <td><?php echo $this->Form->input("dt_fim", array("size" => 12, "label" => false, "class" => 'data')) ?></td>
    </tr>
    <tr align="center">
      <td colspan="3">      
	  <?php echo $this->Html->link($this->Html->image("icones24/prev24.png", array("alt" => 'Voltar', "border" => 0, "title" => 'Voltar')), "javascript:history.go(-1)", array("escape" => false, "id" => 'btPrev')); ?>
      &nbsp;&nbsp;&nbsp;
	  <?php echo $this->Html->link($this->Html->image("icones24/play24.png", array("alt" => 'Voltar', "border" => 0, "title" => 'Play / Pause', "id" => 'imgPlayPause')), "javascript:void(0)", array("escape" => false, "id" => 'btPause')); ?>
      &nbsp;&nbsp;&nbsp;
	  <?php echo $this->Html->link($this->Html->image("icones24/next24.png", array("alt" => 'Voltar', "border" => 0, "title" => 'Avançar')), "javascript:void(0)", array("escape" => false, "id" => 'btNext')); ?></td>
      </tr>
  </table>
</div>
<div id="arrowdown"><?php echo $this->Html->image('arrow-down.jpg', array('title' => 'Configurar', "align" => 'center'))?></div>
</div>
</form>
<div id="impressao">
<?php
	echo $this->fetch('content'); 
	echo $cakeDebug;
?>
</div></body>
</html>