<table class="table table-bordered table-striped">
    <caption class="captionA">ESPELHO DO ASSISTIDO(A)</caption>
    <tr>
        <td>
            <label>Tipo de Pessoa:</label>
        </td>
        <td>
            <?php echo $tipoPessoa[$tipo]; ?>
        </td>
        <td>
            <label>N° Triagem:</label>
        </td>
        <td>
            <?php echo $this->Util->setaValorPadrao($dados['triagem']); ?>
        </td>
    </tr>
    <?php if ($tipo == 'F') { ?>
        <tr>
            <td>
                <label>Nome:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['pessoa_nome']); ?>
            </td>
            <td>
                <label>Gênero:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['opcao_genero']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Identidade de Gênero:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['identidade_genero']); ?>
            </td>
            <td>
                <label>Orientação Sexual:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['orientacao_sexual']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Nome da Mãe:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['nome_mae']); ?>
            </td>
            <td>
                <label>Nome do Pai:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['nome_pai']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Nascimento:</label>
            </td>
            <td>
                <?php
                if (!empty($dados['nascimento']) && $dados['nascimento'] != "0000-00-00") {
                    echo $this->Util->ddmmaa($dados['nascimento']);
                } else {
                    echo "ND";
                }
                ?>
            </td>
            <td>
                <label>Apelido:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['apelido']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>CPF:</label>
            </td>
            <td>
                <?php
                echo $this->Util->setaValorPadrao($dados['cpf']);
                ?>
            </td>
            <td>
                <label>Escolaridade:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['escolaridade']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Nacionalidade:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['nacionalidade']); ?>
            </td>
            <td>
                <label>Naturalidade:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['naturalidade']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Profissão:&nbsp </label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['profissao']); ?>
            </td>
            <td>
                <label>Renda:&nbsp </label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['renda']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Qtd Filhos:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['quantidade_filho']); ?>
            </td>
            <td>
                <label>Núcleo Familiar:&nbsp </label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['nucleo_familiar']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Residência:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['tipo_residencia']); ?>
            </td>
            <td>
                <label>Estado Civil:&nbsp </label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['estado_civil']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Religião/Crença:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['religiao']); ?>
            </td>
            <td>
                <label>Raça:&nbsp </label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['raca']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Tipo deficiência:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['tipo_deficiencia']); ?>
            </td>
            <td>
                <label>Tipo Documento:&nbsp </label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['tipo_documento']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Documento:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['numero_documento']); ?>
            </td>
            <td colspan="2">
            </td>
        </tr>
    <?php } elseif ($tipo == 'J') {
        ?>
        <tr>
            <td>
                <label>Razão Social:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['nome']); ?>
            </td>
            <td>
                <label>Nome Fantasia:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['nome_fantasia']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Atividade Principal:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['atividade_principal']); ?>
            </td>
            <td>
                <label>CNPJ:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['cnpj']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Inscrição Municipal:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['inscricao_municipal']); ?>
            </td>
            <td>
                <label>Inscrição Estadual:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['inscricao_estadual']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Data Início:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['data_inicio']); ?>
            </td>
            <td>
                <label>Data Fim:</label>
            </td>
            <td>
                <?php echo $this->Util->setaValorPadrao($dados['data_fim']); ?>
            </td>
        </tr>
    <?php } elseif ($tipo == 'C') { ?>
        <tr>
            <td>
                <label>Nome do Grupo: </label>
            </td>
            <td colspan='4'>
                <?php echo $this->Util->setaValorPadrao($dados['Pessoa_nome']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Nome do Declarante:</label>
            </td>
            <td colspan='4'>
                <?php echo $this->Util->setaValorPadrao($dados['Pessoa_representante']); ?>
            </td>
        </tr>
    <?php } ?>

</table>
<br>
<table class="table table-bordered table-striped">
    <caption>CONTATO</caption>
    <tr>
        <td width="100px">
            <label>Whatsapp:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['whatsapp']);
            ?>
        </td>
    </tr>    
    <tr>
        <td width="100px">
            <label>Residencial:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['residencial']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Celular:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['celular']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Comercial:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['comercial']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Recado:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['recado']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Email:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['email']);
            ?>
        </td>
    </tr>
</table>
<br>
<table class="table table-bordered table-striped">
    <caption>ENDEREÇO</caption>
    <tr>
        <td width="100px"><label>CEP:</label></td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['cep']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>UF:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['estado']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Cidade:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['cidade']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Bairro:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['bairro_descricao']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Logradouro:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['logradouro_descricao']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Nº:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['numero']);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Complemento:</label>
        </td>
        <td>
            <?php
            echo $this->Util->setaValorPadrao($dados['referencia']);
            ?>
        </td>
    </tr>
</table>
<br>
<table class="table table-bordered table-striped">
    <caption class="captionA">OBSERVAÇÃO</caption>
    <tr>
        <td>

            <?php
            echo $this->Util->setaValorPadrao($observacao);
            ?>

        </td>
    </tr>
</table>

<?php
if ($exibirImprimir) {
    echo $this->Html->link($this->Html->div('print', 'Imprimir'), array(
        'controller' => 'assistidos',
        'action' => "view", $dados['idAssistido'], true), array('title' => 'Imprimir',
        'target' => '_blank',
        'escape' => false,
        'class' => 'btn btn-default marginbottom10'));
}
?>


