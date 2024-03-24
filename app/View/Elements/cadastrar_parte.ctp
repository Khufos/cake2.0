<script type="text/javascript">
<?php
if (isset($idPessoa)) {
    if ($tipoPessoa == 'J') {
        ?>
            adicionarParteJuridica(<?= $idPessoa ?>, '<?= $nomePessoa ?>');
        <?php
    } else {
        ?>
            adicionarParte(<?= $idPessoa ?>, '<?= $nomePessoa ?>');
        <?php
    }
}
?>
</script>