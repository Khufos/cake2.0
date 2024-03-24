<html> 
    <head> 
        <title>SIGAD</title> 

        <meta http-equiv="Refresh" content="<?php echo $time ?>;url=<?php echo $curl; ?>"/> 
        <style type="text/css">
            #flashLink{
                font-family: arial;
                font-size:26px;
                font-weight:500;
                text-align:center;
                color:#000;
                text-decoration:none;
                outline:none;
            }

            .center{
                position:absolute;
                top:50%;
                left:50%;
                margin-left:-200px;
                margin-top:-25px;
            }

            body {
                background: url('<?php echo $this->webroot; ?>img/bg4.png');
            }
        </style>
    </head> 
    <body>     
        <table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="center" >
            <tr align="center">
                <td> <span>&nbsp;<a id="flashLink" href="<?php echo $curl ?>"><?php echo $msg; ?></a></span></td>
            </tr>
            <tr align="center">
                <td><?php echo $this->Html->image("ajaxBarGreen.gif") ?></td>
            </tr>  	
        </table>
    </body> 
</html>