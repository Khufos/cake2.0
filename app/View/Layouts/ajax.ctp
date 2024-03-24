<?php
$populaCampos = $this->Util->setaValorPadrao($populaCampos, false);
if (!empty($populaCampos)) {
    ?>
    <script type="text/javascript">
        preencheCampos('<?php echo $campos; ?>','<?php echo $valores; ?>');
    </script>
    <?php
}

if (!empty($msg)) {
    echo $msg;
}

if (!empty($msgAlert)){
    echo "<script type='text/javascript'> alert('$msgAlert'); </script>";
}

if (!empty($redirect))
    echo "<script>
        window.location='$redirect';
        lc.start('request');
    </script>";

if (!empty($limpaCampos))
    echo "<script> limpaCampos('$limpaCampos') </script>";

if (!empty($abrirJanela)) {
    ?>
    <script type="text/javascript">
        window.open('<?php echo $link; ?>', '_blank');
    </script>
    <?php
}
?>

<?php
    echo $this->fetch('content');
?>
