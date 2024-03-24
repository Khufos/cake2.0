<?php if (!empty($remicoes)) { ?>
    <div id="remicoes">
        <table class="table table-bordered table-striped">
            <caption class="captionA"> Remições</caption>
            <?php
            foreach ($remicoes as $key => $value) {
                ?>
                <tr>
                    <td width="110px">
                        Data:                    
                    </td>
                    <td width="250px">
                        <?php 
                            $this->Util->setaValorPadrao($value['data'], null);
                            echo $this->Util->setaValorPadrao($this->Util->ddmmaa($value['data'])); 
                        ?>
                    </td>
                    <td>
                        Qtd. dias:  
                        <?php echo $this->Util->setaValorPadrao($value['quantidade_dias']); ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <br />
<?php } ?>