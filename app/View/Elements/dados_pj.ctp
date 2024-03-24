<tr>
    <td>
        <span class="label direita">
            Representante:
        </span>
    </td>
    <td>
        <?php  
        if(isset($dadosPessoaJuridica) && !empty ($dadosPessoaJuridica)){
            echo $dadosPessoaJuridica['representante'];
        }else {
            echo $dados["representante"];
        }
     ?>
    </td>
</tr>
<tr>
    <td>
        <span class="label direita">
            Data início:
        </span>
    </td>
    <td>
        <span class="label">
            <?php
            if (!strcmp($dadosPessoaJuridica['data_inicio'],  "0000-00-00") || !strcmp($dados['data_inicio'], "0000-00-00")){
                echo "ND";
                
            }else if (isset($dados['data_inicio']) && !empty ($dados['data_inicio']) ){
                echo  $this->Util->ddmmaa($dados['data_inicio']);
            }else {
                echo $this->Util->ddmmaa($dadosPessoaJuridica['data_inicio']);
            }
            ?>
        </span>
    </td>
</tr>
<tr>
    <td>
        <span class="label direita">
            Data fim:
        </span>
    </td>
    <td>
        <span class="label">

            <?php
            if (!strcmp($dadosPessoaJuridica['data_fim'], "0000-00-00") || !strcmp($dados['data_fim'], "0000-00-00"))
                echo "ND";
            else
                echo $this->Util->ddmmaa($dadosPessoaJuridica['data_fim']) . $this->Util->ddmmaa($dados['data_fim']) ;
                ?>
        </span>
    </td>
</tr>