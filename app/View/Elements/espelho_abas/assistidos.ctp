
<?php
/**
 * @abstract Exibição dos links de opçoes na listagem do assistido
 * @author Jailson Boa Morte 
 */
//FireCake::info($assistidosCaso, 'assistido');
if (!empty($assistidosCaso)) {
    ?>            
    <table cellpadding="0" cellspacing="0"  border="1" class="tableImp bordaFina" align="center" width="695px">
        <caption class="captionA"> Assistido do caso</caption>
        <thead>
            <tr>
                <th>
                    <span class="label">
                        Triagem
                    </span>
                </th>
                <th>
                    <span class="label">
                        Nome
                    </span>
                </th>
                <th>
                    <span class="label">
                        CPF
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($assistidosCaso as $key => $value) {
                //FireCake::info($value, "\$value");
                ?>

                <tr>
                    <td>
                        <span class="label">
                            <?php
                            echo $value['Assistido']['numero_triagem'];
                            ?>
                        </span>
                    </td>
                    <td>
                        <span class="label">
                            <?php
                            echo $value['Pessoa']['nome'];
                            ?>
                        </span>
                    </td>
                    <td>
                        <?php
                        echo $this->Util->setaValorPadrao($value['PessoaFisica']['cpf']);
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>          
<?php } ?>
