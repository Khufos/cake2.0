<fieldset>
    <legend>
        <a id="filtro_assistido" title="Recolher/Expandir">Filtro do assistido(a)</a>
    </legend>
    <table id="table_filtro" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>                  
                    Tipo pessoa:
                </th>
                <th>                   
                    Triagem:
                </th>
                <th>                 
                    Nome:
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
        </thead>
        <tr>
            <td>
                <?php
                $args = array(
                    'default' => 'F',
                    'class' => 'form-control input-sm'
                );
                echo $this->Form->select('Pesquisa.tipo', $tipoPessoa, $args);
                ?>
            </td>
            <td>
                <?php echo $this->Form->text('Pesquisa.triagem', array('class' => 'form-control input-sm')); ?>
            </td>
            <td>
                <?php
                echo $this->Form->text('Pesquisa.nome', array('class' => 'nome form-control input-sm'));
                echo $this->Jmycake->autocomplete('PesquisaNome', 'Pessoa/nome', 'assistidos', "$idForm");
                ?>
            </td>       
            <td>
                <?php
                echo $this->Js->link($this->Html->div('glyphicon glyphicon-search', ''), array(
                    'controller' => 'assistidos',
                    'action' => "simpleFindAssistido/$modelRelacao/$campoModelRelacao/$idModelRelacao/$idForm?trs=1"), array(
                    'data' => $this->Js->get('#' . $idForm . '')->serializeForm(array('isForm' => true, 'inline' => true)),
                    'complete' => 'refreshJquery();',
                    'update' => '#resPesquisa',
                    'div' => false,
                    'method' => 'POST',
                    'async' => true,
                    'class' => 'btn btn-default',
                    'title' => 'Pesquisar',
                    'dataExpression' => true,
                    'escape' => false)
                );
                ?>            
            </td>          
        </tr>   
    </table>
</fieldset>
<div id="resPesquisa"></div><br />
<div id="resAssociacao">
    <?php
    if ($edit && !empty($assistidosCaso)) {
        ?>
        <fieldset>
            <legend>
                <a id="assistidos_fundiarios" title="Recolher/Expandir">Assistido(s) associado(s) a este fundiário</a>
            </legend>    
            <table border="1" class="table table-bordered table-striped" id="table_assistidos_fundiarios">
                <thead>
                    <tr>
                        <th>
                            Triagem
                        </th>
                        <th>
                            Nome
                        </th>
                        <th>
                            Ações
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
                                <?php
                                $idAssistido = $value['Assistido']['id'];
                                echo $value['Assistido']['numero_triagem'];
                                echo $this->Form->hidden("$modelRelacao.$idAssistido.triagem", array('value' => $value['Assistido']['numero_triagem']));
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $value['Pessoa']['nome'];
                                echo $this->Form->hidden("$modelRelacao.$idAssistido.assistido", array('value' => $value['Pessoa']['nome']));
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $this->Form->hidden("$modelRelacao.$idAssistido.assistido_id", array('value' => $value['Assistido']['id']));
                                echo $this->Js->link(
                                        $this->Html->image('icones24/delete.png', array('title' => 'Remover o/a assistido(a)', 'alt' => 'Remover', 'escape' => false)), array(
                                    'controller' => 'assistidos',
                                    'action' => "relacionamentos_assistidos/$modelRelacao/$campoModelRelacao/0/$idAssistido/$idForm/delete?trs=1"
                                        ), array(
                                    'complete' => 'refreshJquery();',
                                    'async' => true,
                                    'dataExpression' => true,
                                    'data' => $this->Js->get("#$idForm")->serializeForm(
                                            array(
                                                'isForm' => true,
                                                'inline' => true
                                            )
                                    ),
                                    'update' => '#resAssociacao',
                                    'escape' => false
                                        )
                                );
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
        <script type="text/javascript">
            $('#assistidos_fundiarios').click(function () {
                $('#table_assistidos_fundiarios').slideToggle('slow');
            });
        </script>
    <?php } ?>
</div>

<script type="text/javascript">
    $('#filtro_assistido').click(function () {
        $('#table_filtro').slideToggle('slow');
    });
</script>