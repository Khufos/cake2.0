<script type="text/javascript">
    $(document).ready(function () {
        getAvisosByDefensor();
    <?php
    if (isset($isDefensor) && ($isDefensor)) {
        ?>
            window.setInterval("getAvisosByDefensor()", <?php echo $tempo; ?>);
    <?php } ?>

    });
</script>


<div id="" style="padding: 5px;">
    <div class='col-md-12'>
        <legend style="margin-top: 20px;">Expediente(s)</legend>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Aviso</th>
                </tr>
            </thead>
            <tbody id="lista_avisos_def">

            </tbody>
            
        </table>
    </div>
</div>