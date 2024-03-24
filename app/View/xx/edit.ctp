<?= $this->Html->css('../css/perfilafastamento/style.css') ?>



<body class="visitor-portal-container">

    <div class="container-fluid">
        <h3 class="page-header">Detalhar Afastamento do Defensor</h3>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-striped">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav navbar-left">
                            <li><?php echo $this->Js->link('INFORMAÇÕES DO PERFIL', '/atores', array('class' => 'nav-link')) ?></li>
                            <li><?php echo $this->Js->link('CRIAR UM OBSERVAÇÃO', '/atores', array('class' => 'nav-link')) ?></li>
                            <li><?php echo $this->Js->link('OBSERVAÇÕES', '/atores', array('class' => 'nav-link')) ?></li>
                            <li><?php echo $this->Js->link('DATA RETIFICAS', '/atores', array('class' => 'nav-link')) ?></li>
                        </ul>
                    </nav>
                    <tr>
                        <th style="width: 150px;">Nome Defensor:</th>
                        <td><?php echo $data['p']['nome'] ?> </td>
                        <th style="width: 150px;">Data Registro:</th>
                        <td><?php echo data_formate($data['Afastamento']['data_cadastro']) ?></strong> </td>

                    <tr>
                    <tr>
                        <th>Comarca:</th>
                        <td><?php echo $data['Comarca']['comarca_nome'] ?></td>
                        <th>Data Inicio:</th>
                        <td><?php echo data_formate($data['Afastamento']['data_inicio']) ?></td>
                    <tr>
                    <tr>
                        <th>Unidade:</th>
                        <td><?php echo $data['Unidade']['unidade_nome'] ?></td>
                        <th>Data Fim:</th>
                        <td><?php echo data_formate($data['Afastamento']['data_fim']) ?></td>
                    <tr>
                    <tr>
                        <th>Tipo Afastamento:</th>
                        <?php
                        echo $this->Form->create('TipoAfastamento', array('url' => array('action' => 'edit', $data['TipoAfastamento']['id'])));
                        echo $this->Form->input('tipo_afastamento_nome', array('default' => $data['TipoAfastamento']['tipo_afastamento_nome']));
                        echo $this->Form->submit('Save', array('class' => 'btn btn-primary'));
                        echo $this->Form->end();
                        ?>
                        <td><?php echo $data['TipoAfastamento']['tipo_afastamento_nome'] ?></td>
                        <th style="background: #e6bbad;">Data Retificada:</th>
                        
                        <td style="background: #e6bbad;"><?php echo data_formate($data['Afastamento']['data_fim']) . ' - ' . data_formate($data['Afastamento']['data_fim']) ?>
                           
                        </td>
                    </tr>

                </table>


            </div>

        </div>

        <h3 class="page-header">Motivo do Afastamento</h3>
        <div class="row">
            <div class="bio ">
                <div class="card-body pb-2 text-left ">
                    <div class="form-group">
                        <textarea class="custom-textarea" rows="5" readonly><?php echo $textoComSubstituicao = replaceNewlines($data['Afastamento']['observacao']) ?></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>

    </div>

</body>

</html>





<?php

function replaceNewlines($text)
{
    // Substitui quebras de linha não precedidas por um ponto por espaços
    $text = preg_replace('/(?<!\.)\r?\n/', ' ', $text);
    return $text;
}

function data_formate($data)
{
    // Substitui quebras de linha não precedidas por um ponto por espaços
    $dataCadastro = new DateTime($data);
    $dataCad = $dataCadastro->format('d/m/Y');
    return $dataCad;
}




?>





<script>
    $('h3.page-header').first().remove();
</script>




<style>
    .form-label {
        background-color: #eee;
    }

    .custom-textarea {
        text-align: justify;
        height: 496px;
        width: 100%;
        /* Use a largura desejada em porcentagem ou uma unidade relativa */
        max-width: 1822px;
        /* Defina uma largura máxima se necessário */
        /* Impede o redimensionamento pelo usuário */
        padding: 30px;
        resize: none;
        outline: none;
        border: 1.5px solid;
        border-color: gray;
        border-radius: 4px;
        margin: 5px;


    }

    .custom-textarea:hover {
        border-color: green;

    }

    h4 {
        margin-bottom: -4px;
    }
</style>