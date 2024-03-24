<tr>
    <td>
        <span class="label direita">
            Representante:
        </span>
    </td>
    <td>
        <span class="label esquerda">
            <?php if(isset($dadosCasoColetivo['representante']) && !empty($dadosCasoColetivo['representante'])){
                echo $dadosCasoColetivo['representante'];
                
            }else{
                if(isset($dados['pessoa_representante']) && !empty($dados['pessoa_representante'])){
                        echo $dados['pessoa_representante'];
                }else{
                    echo 'Não informado';
                }
             }
            ?>
        </span>
    </td>
</tr>