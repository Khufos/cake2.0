<style type="text/css">
    .filtro-rel caption{
        text-align: left;
    }
    .filtro-rel td{
        border: none;
        text-align: left;
    }
</style>
<?php if(isset($filtroUtilizado) && count($filtroUtilizado) > 0){ ?>
<table align="left" border="0" class="filtro-rel" width="100%">
    <caption>
        Filtro(s) utilizado(s) no relatório
    </caption>
    <?php
    foreach($filtroUtilizado as $key => $value){ ?>
    <tr>
        <td>
            <b><?php echo $value['campo']; ?></b>
            <?php echo $value['operador']; ?>
            <?php echo $value['valor']; ?>
        </td>
    </tr>
    <?php } ?>
</table>
<?php } ?>