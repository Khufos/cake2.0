<?php if (!empty($partes)) { ?>
    <table cellpadding="0" cellspacing="0"  border="1" class="tableImp bordaFina" align="center" width="695px">
        <caption class="captionA"> Partes do caso</caption>
        <?php
        foreach ($partes as $key => $value) {
            ?>
            <tr>
                <td>
                    <span class="label direita">
                        Nome:
                    </span>
                </td>
                <td>
                    <span class="label esquerda">
                        <?php echo $value['Pessoa']['nome']; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label direita">
                        Nacionalidade:
                    </span>
                </td>
                <td>
                    <span class="esquerda label">
                        <?php echo $this->Util->setaValorPadrao($value['PessoaFisica']['nacionalidade']); ?>
                    </span>
                    <span class="label direita">                        
                        Naturalidade:
                        <?php echo $this->Util->setaValorPadrao($value['PessoaFisica']['naturalidade']); ?>                        
                    </span>                    
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label direita">Tipo Documento:</span>
                </td>
                <td>
                    <span class="esquerda label">
                        <?php
                        echo $this->Util->setaValorPadrao($tipoDoc[$value['PessoaFisica']['tipo_documento_id']]);
                        ?>
                    </span>                
                    <span class="direita label">
                        Documento:                                    
                        <?php echo $this->Util->setaValorPadrao($value['PessoaFisica']['numero_documento']); ?>                    
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label direita">Residencial:</span>
                </td>
                <td>
                    <span class="label esquerda">
                        <?php
                        echo $this->Util->setaValorPadrao($value ['Contato']['residencial']);
                        ?>
                    </span>
                    <span class="label direita">
                        Celular:
                        <?php
                        echo $this->Util->setaValorPadrao($value ['Contato']['celular'],"&nbsp&nbsp&nbsp&nbsp&nbsp");
                        ?>
                    </span>
                    <span class="label direita">
                        Recado:                        
                        <?php
                        echo $this->Util->setaValorPadrao($value ['Contato']['recado'],'&nbsp&nbsp&nbsp&nbsp&nbsp');
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label direita">UF:</span>
                </td>
                <td>
                    <span class="label esquerda">
                        <?php
                        echo $this->Util->setaValorPadrao($estados[$value['Endereco']['estado']]);
                        ?>                        
                    </span>

                    <span class="label direita">
                        Cidade:
                        <?php
                        $cidades = $value['cidades'];
                        echo $this->Util->setaValorPadrao($cidades[$value['Endereco']['cidade_id']]);
                        ?>
                    </span>

                </td>
            </tr>            
            <tr>
                <td>
                    <span class="label direita">Bairro:</span>
                </td>
                <td>
                    <span class="label esquerda">
                        <?php
                        echo $this->Util->setaValorPadrao($value ['Endereco']['bairro_descricao']);
                        ?>
                    </span>

                    <span class="label direita">                        
                        <?php
                        echo $this->Util->setaValorPadrao($value ['Endereco']['logradouro']);
                        ?>
                    </span>
                </td>
            </tr>                                    
            <tr>
                <td>
                    <span class="label direita">Logradouro:</span>
                </td>
                <td>
                    <span class="label esquerda">
                        <?php
                        echo $this->Util->setaValorPadrao($value ['Endereco']['logradouro']);
                        ?>                        
                    </span>
                </td>
            </tr>                                            
            <tr>
                <td>
                    <span class="label direita">Complemento:</span>
                </td>
                <td>
                    <span class="label esquerda">
                        <?php
                        echo $this->Util->setaValorPadrao($value ['Endereco']['referencia']);
                        ?>
                    </span>
                    <span class="label direita">                        
                        N&ordm;
                        <?php
                        echo $this->Util->setaValorPadrao($value ['Endereco']['numero']);
                        ?>
                    </span>
                </td>
            </tr>                                                                                 
        <?php } ?>
    </table>

<?php } ?>         