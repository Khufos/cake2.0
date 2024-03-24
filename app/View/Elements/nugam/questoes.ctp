<?php // debug($dadosAssistido); ?>
<table class="table table-bordered table-striped">
    <caption class="captionA">
            I-IDENTIFICAÇÃO
    </caption>
    </tr>
    <tr>
        <td>
            Nome:
        </td>
        <td>
            <?= $dadosAssistido['Pessoa']['nome'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Apelido:
        </td>
        <td>
            <?= $dadosAssistido['PessoaFisica']['apelido'] ?>
        </td>
        <td>
            Sexo
        </td>
        <td>
            <?= $dadosAssistido['PessoaFisica']['sexo'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Data Nascimento:
        </td>
        <td>
            <?= $dadosAssistido['PessoaFisica']['nascimento'] ?>
        </td>
        <td>
            Idade:
        </td>
        <td>
            <?= $dadosAssistido['PessoaFisica']['nascimento'] ?>
        </td>
        <td>
            Naturalidade:
        </td>
        <td>
            <?= $dadosAssistido['PessoaFisica']['naturalidade'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Estado civil:
        </td>
        <td>
            <?= $dadosAssistido['EstadoCivil']['nome'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Autodeclaração de cor:
        </td>
        <td>
            <?= $dadosAssistido['Raca']['nome'] ?>
        </td>
    </tr>
    <tr>
        <td>
            RG:
        </td>
        <td>
            ----
        </td>
        <td>
            CPF:
        </td>
        <td>
            <?= $dadosAssistido['PessoaFisica']['cpf'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Endereço:
        </td>
        <td>
            <?= $dadosAssistido['Endereco']['logradouro_descricao'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Bairro:
        </td>
        <td>
            <?= $dadosAssistido['Endereco']['bairro_descricao'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Telefones:
        </td>
        <td>
            <?= $dadosAssistido['Contato']['celular'] ?>
        </td>
    </tr>
</table>
<?php 
$args = array('empty' => "Selecione",
            'class' => 'form-control input-sm');
$simNao = array('0' => 'Não', '1' => 'Sim');
$completoIncompleto = array('0' => 'Incompleto', '1' => 'Completo');
?>
<table class="table table-bordered table-striped">
    <caption class="captionA">
            II-PERFIL SOCIAL
    </caption>
    <tr>
        <td>
            Está estudando atualmente:
        </td>
        <td>
            <?php echo $this->Form->select('estuda_atualmente', $simNao, $args);?>
        </td>
    </tr>
    <tr>
        <td>
            Escolaridade:
        </td>
        <td>
            <?= $dadosAssistido['Escolaridade']['nome'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Ensino fundamental 1° à 4° Série:
        </td>
        <td>
            <?php echo $this->Form->select('fundamental_1', $completoIncompleto, $args);?>
        </td>
    </tr>
    <tr>
        <td>
            5° à 8° Série:
        </td>
        <td>
            <?php echo $this->Form->select('fundamental_2', $completoIncompleto, $args);?>
        </td>
    </tr>
    <tr>
        <td>
            Ensino médio 1° ao 3° Ano:
        </td>
        <td>
            <?php echo $this->Form->select('nivel_medio', $completoIncompleto, $args);?>
        </td>
    </tr>
    <tr>
        <td>
            Ensino Superior:
        </td>
        <td>
            <?php echo $this->Form->select('superior', $completoIncompleto, $args);?>
        </td>
    </tr>
    <tr>
        <td>
            Recebe benefício do Programa Bolsa Família:
        </td>
        <td>
            <?php echo $this->Form->select('bolsa_familia', $simNao, $args);?>
        </td>
        
        <td>
            R$: <?php echo $this->Form->text('valor_bolsa_familia', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
    <tr>
        <td>
            Quantas Pessoas Moram em sua casa, incluindo você?
        </td>
        <td>
            <?= $dadosAssistido['PessoaFisica']['nucleo_familiar_id'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Tem algum problema de saúde ou deficiência?
        </td>
        <td>
            <?= $dadosAssistido['TipoDeficiencia']['nome'] ?>
        </td>
    </tr>
    <tr>
        <td>
            Ou em algum membro da família?
        </td>
        <td>
            <?php echo $this->Form->select('deficiencia_parente', $simNao, $args);?>
        </td>
    </tr>
    <tr>
        <td>
            Participa de alguma associação e/ou cooperativa?
        </td>
        <td>
            <?php echo $this->Form->select('cooperativa', $simNao, $args);?>
        </td>
    </tr>
</table>
<table class="table table-bordered table-striped">
    <caption class="captionA">
            III-TRABALHO E RENDA
    </caption>
    </tr>
    <tr>
        <td>
            Possui outras fontes de renda?
        </td>
        <td>
            <?php echo $this->Form->text('outras_rendas', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
    <tr>
        <td>
            Quais materiais são coletados?
        </td>
        <td>
            <?php echo $this->Form->text('materiais_coletados', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
    <tr>
        <td>
            Volume médio mensal?
        </td>
        <td>
            <?php echo $this->Form->text('volume_medio', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
    <tr>
        <td>
            Locais que coleta com maior frequência?
        </td>
        <td>
            <?php echo $this->Form->text('locais_coleta', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
    <tr>
        <td>
            Condição de armazenamento:
        </td>
        <td>
            <?php echo $this->Form->text('condicao_armazenamento', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
    <tr>
        <td>
            Forma de armazenamento:
        </td>
        <td>
            <?php echo $this->Form->text('forma_armazenamento', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
    <tr>
        <td>
            Destinação do material reciclável:
        </td>
        <td>
            <?php echo $this->Form->text('destinacao_reciclavel', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
        <td>
            Destinação do material não reciclável:
        </td>
        <td>
            <?php echo $this->Form->text('destinacao_nao_reciclavel', array('type' => 'text', 'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
    <tr>
        <td>
            Renda média mensal obtida com a coleta:
        </td>
        <td>
            <?php echo $this->Form->text('renda_media', array('type' => 'text',  'class' => 'form-control input-sm')); ?>
        </td>
    </tr>
</table>
<div id="gridResumo"></div>