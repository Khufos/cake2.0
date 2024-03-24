<!-- Modal -->
<div class="modal fade" id="modalObterAutorizacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitação de acesso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Para ter acesso a este anexo é necessário ter permissão. Caso queira solicitar acesso clique no botão "Solicitar autorização".
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>&nbsp;
                <button type="button" class="btn btn-primary" id="solicitarAutorizacao">Solicitar autorização</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal -->
<!--Estilo Toggle expandir todos -->
<style>

.containerToggle{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    width: 210px;
    margin-top: 10px;
    margin-bottom: 10px;
    border: none;
    outline: none;
    color: #fff;
    background: #057F62;
    font-size: 19px;
    font-weight: 500;
    border-radius: 10px;
    padding: 5px;

}
#texto-botao{
    margin: 0;
    padding: 5px;
    font-size: 14px;
}

.divToggle{
    display: flex;
    align-items: center;
    margin: 0;
    padding: 0;
    width: 50px;
    height: 26px;
    background: #b8b6b6; 
    border-radius: 14px;
    position: relative;
}
.toggle{

    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
    background: #fff;
    width: 20px;
    height: 20px;
    border-radius: 100px;
    position: absolute;
    transition: .3s;
    right: 3px;
}

.hide-process{

    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    width: 20px;
    margin-top: 10px;
    margin-bottom: 10px;
    border: none;
    outline: none;
    color: #fff;
    font-size: 19px;
    font-weight: 500;
    border-radius: 100px;
    transition: .3s;
    right: calc(100% - 36px - -12px);
}

.hide-process .toggle{
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    position: absolute;
    /* transform: translateX(-1.8px); */

}
/* .hide-process .divToggle{
    display: flex;
    align-items: center;
    margin: 0;
    padding: 0;
    width: 64px;
    height: 29px;
    background: #C3C3C3; 
    border-radius: 10px;
    cursor: pointer;
    padding-left: 23px;
    position: relative;
} */
.ativo{
    background-color:#2EBD59;
}
.glyphicon-remove {
    color: transparent;
    font-size: 14px;
}
.glyphicon-ok {
    font-size: 12px;
    color: #2EBD59;
}
.visualizar_dados_acao_todos{
    width: 100%; /* Ocupa toda a largura disponível da div pai */
    height: 100%; /* Ocupa toda a altura disponível da div pai */
    display: block; /* Transforma o link em um elemento de bloco */
    position: absolute; /* Garante que o link ocupe toda a área da div pai */
    top: 3;
    left: 3;
    z-index: 1; /* Certifica-se de que o link esteja acima de outros elementos */
    background-color: transparent; /* Torna o link invisível */
}

.conteudo-tabela-sigiloso{

color: #FF0000;
font-weight: 500;

}


.paragrafo-icon{

font-size: 11px;
font-weight: 600;

}

.icons-acoes{

display: flex;
justify-content: center;
align-items: center;
gap: 10px;

}

.icons-acoes a{
text-decoration: none;
color: inherit;
cursor: pointer;

}

.icon-box{

width: 43px;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;

}

.conteudo-tabela{

font-size: 14px;
text-align: center;

}

</style>

<table align="center" class="table table-bordered table-striped">
    <caption class="captionA"><strong>DADOS PESSOAIS</strong></caption>
    <?php if ($tipo == 'F') { ?>
        <tr>
            <td><label>Nome: </label></td>
            <td><?php 
                if(!empty($this->Form->value('Pessoa.nome_social') && $this->Form->value('Pessoa.nome_social')!='ND')){
                    echo $this->Form->value('Pessoa.nome_social');
                    echo ' <br><i style="font-size:11px">(Nome civil: '.utf8_encode($this->Form->value('Pessoa.nome')).')</i>'; 
                }else
                    echo $this->Form->value('Pessoa.nome');
                 ?></td>
            <td><label>Número Triagem:</label></td>
            <td><?php echo $triagem; ?></td>
        </tr>
        <tr>
            <td><label>Cidade:</label></td>
            <td><?php echo utf8_encode($this->Form->value('Pessoa.cidade')); ?></td>
            <td><label>Nome Mãe</label></td>
            <td>
                <?php
                $nome_mae = $this->Form->value('PessoaFisica.nome_mae');
                echo $this->Util->setaValorPadrao($nome_mae, 'ND'); ?>
            </td>
        </tr>
        <tr>
            <td><label>Nascimento:</label></td>
            <td>
                <?php
                if ($this->Form->value('PessoaFisica.nascimento') == "00/00/0000") {
                    echo "ND";
                } else {
                    $birthdate =  $this->Form->value('PessoaFisica.nascimento') ;
                if($birthdate){
                    $birthdate = DateTime::createFromFormat('d/m/Y', $birthdate);
                    $currentDate = new DateTime();
                    $age = $birthdate->diff($currentDate)->y;
                    echo $this->Form->value('PessoaFisica.nascimento') . ' ' . '(' . $age .' anos )';
                }else {
                    echo "ND";
                }

                }
                ?>
            <td><label>CPF:</label></td>
            <td>
                <?php
                $cpf = $this->Form->value('PessoaFisica.cpf');
                echo $this->Util->setaValorPadrao($cpf, 'ND'); ?>
            </td>
        </tr>

    <?php } elseif ($tipo == 'J') { ?>
        <tr>
            <td><label>Razão Social:</label></td>
            <td><?php echo $this->Form->value('Pessoa.nome') ?></td>
            <td><label>Número Triagem2:</label></td>
            <td>
                <?php echo $triagem; ?>
            </td>
        </tr>
        <tr>
            <td><label>Nome Fantasia:</label></td>
            <td colspan="3"><?php echo $this->Form->value('PessoaJuridica.nome_fantasia', array('class' => 'nome')) ?></td>
        </tr>
        <tr>
            <td><label>Atividade Principal:</label></td>
            <td><?php echo $this->Form->value('PessoaJuridica.atividade_principal') ?></td>
            <td><label>CNPJ:</label></td>
            <td>
                <?php echo $this->Form->value('PessoaJuridica.cnpj') ?>
            </td>
        </tr>
        <tr>
            <td><label>Inscrição Municipal:</label></td>
            <td>
                <?php echo $this->Form->value('PessoaJuridica.inscricao_municipal') ?>
            </td>
            <td><label>Inscrição Estadual:</label></td>
            <td>
                <?php echo $this->Form->value('PessoaJuridica.inscricao_estadual') ?>
            </td>
        </tr>
    <?php } elseif ($tipo == 'C') { ?>
        <tr>
            <td><label>Nome do Grupo:</label></td>
            <td><?php echo $this->Form->value('Pessoa.nome') ?></td>
            <td><label>Número Triagem3:</label></td>
            <td>
                <?php echo $triagem ?>
            </td>
        </tr>
        <tr>
            <td><label>Nome do Declarante:</label></td>
            <td><?php echo $this->Form->value('Pessoa.representante') ?></td>
            <td><label>Qtde Assistido(s):</label></td>
            <td>
                <?php echo $this->Form->value('Assistido.qtde') ?>
            </td>
        </tr>
    <?php } ?>
</table>
<!--
<table align="center" class="table table-bordered table-striped">
    <p class="captionA" style="color: #777; font-weight: bold; font-size: 13px">MARCADORES</p>
    <div class="well">
        <div class="form-group">
            <?php
                if(isset($MarcadorSelec)){
                    foreach ($MarcadorSelec as $key => $marcadores) :
                        if($idAssistido == $marcadores['map']['assistido_id']){?>
                            <div class="badge bg-primary text-wrap" style="background-color: <?=$marcadores['cor']['hexadecimal']?>; color: <?=$marcadores['cor']['cor_fonte']?>; margin-top: 5px;"><?=$marcadores['marc']['nome']?></div><?php
                        }
                    endforeach;
                }
            ?>
        </div>
        <?php if($perfilDefensor == true){ ?>
            <button class="btn btn-primary" onclick="gerenciarMarcador( <?=$idAssistido?>,'<?=$_SERVER['REQUEST_URI']?>')"><span>Adicionar Marcador <div style="cursor: pointer; color: white" class="glyphicon glyphicon-tags" title="Marcador" ></div></span>
        <?php } ?> 
    </div> 
</table>-->
<script type="text/javascript">
    var anexoID = "";
    var funcionarioCorrente = "";
    let toggleAtivo = false;
    $(document).ready(function() {        
        funcionarioCorrente = <?php echo json_encode(!empty($dadosLogado) ? $dadosLogado : ""); ?>;
        $('.visualizar_dados_acao').click(function(event) {            
            event.preventDefault();
            let extrato = <?php echo json_encode($extrato); ?>;
            var btn = $(this);
            var url = btn.attr('href');
            toggleAtivo = false;
            $.ajax({
                type: "GET",
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                    btn.addClass('disabled');
                    if ($('.panel-heading').length == extrato.length){
                        btnProcessos.classList.toggle('hide-process');
                        icone.classList.remove('glyphicon-remove');
                        icone.classList.add('glyphicon-ok');
                        divToggle.classList.add('ativo');
                        toggleAtivo = true;
                    }
                },
                url: url
            }).done(function(data) {
                $('#detalhes').append(data);
            });
        });
        // função para visualizar os detalhes de todas as ações
        $('.visualizar_dados_acao_todos').click(function(event) {            
            event.preventDefault();
            if(toggleAtivo == false){
                $('#detalhes').empty();
            $('.visualizar_dados_acao').each(function(index, element) {
                let btn = $(element);
                let url = btn.attr('href');
                $.ajax({
                    type: "GET",
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    complete: function() {
                        $('#loading').hide();
                        btn.addClass('disabled');
                    },
                    url: url
                }).done(function(data) {
                    $('#detalhes').append(data); 
                });
            });
            toggleAtivo = true;
            }
        });
        atualizar();
        //funçao para funcionamento do toggle
        
        const btnProcessos = document.querySelector('.toggle');
        const divToggle = document.querySelector('.divToggle');
        const icone = document.querySelector('#iconeToggle');
       if (btnProcessos){
            btnProcessos.addEventListener('click', (event) => {
                event.preventDefault();
                btnProcessos.classList.toggle('hide-process');
                if(btnProcessos.classList.contains('hide-process') && toggleAtivo==true){
                    icone.classList.remove('glyphicon-ok');
                    icone.classList.add('glyphicon-remove');
                    divToggle.classList.remove('ativo');
                    $('#detalhes').empty();
                    // $('.visualizar_dados_acao_todos').removeClass('disabled');
                    $('.visualizar_dados_acao').removeClass('disabled');
                    toggleAtivo = false;
                } else {
                    icone.classList.remove('glyphicon-remove');
                    icone.classList.add('glyphicon-ok');
                    divToggle.classList.add('ativo');
                }
            });
        }
        // função para reabilitar o toggle visualizar todos
        $(document).on('click', '.close-box-hist', function() {
            let extrato = <?php echo json_encode($extrato); ?>;
            let btnTodos =  $('.visualizar_dados_acao_todos');
            if (!btnTodos.data('indice-cliques')) {
            btnTodos.data('indice-cliques', 0); 
            }
            let contadorCliques = btnTodos.data('indice-cliques');
            contadorCliques++;
            btnTodos.data('indice-cliques', contadorCliques); 
            if(contadorCliques !== 0){
                if(!btnProcessos.classList.contains('hide-process')){
                    btnProcessos.classList.toggle('hide-process');
                }
                icone.classList.remove('glyphicon-ok');
                icone.classList.add('glyphicon-remove');
                divToggle.classList.remove('ativo');
                toggleAtivo = false;
                btnTodos.data('indice-cliques', 0); 
            }
        });
    });
</script>
<!-- ############################################## CONTATO-->
<?php if (!$impressao) { ?>
    <div class="well">
        <ul class="nav nav-tabs" role="tablist">
            <li id="hist" class="active"><a href="#historico" role="tab" data-toggle="tab">HISTÓRICO</a></li>
            <li class=""><a href="#agendamento" role="tab" data-toggle="tab">AGENDAMENTOS</a></li>
            <li id="liAbaAssistidos"><a href="#anexo" role="tab" data-toggle="tab">ANEXOS</a></li>
            <li id=""><a href="#atividade_extrajudicial" role="tab" data-toggle="tab">ATIVIDADES EXTRAJUDICIAIS</a></li>
            <li id=""><a href="#processos" role="tab" data-toggle="tab">ATOS PROCESSUAIS</a></li>
            <li id=""><a href="#audiencias" role="tab" data-toggle="tab">AUDIÊNCIAS (PAINEL)</a></li>
            <li id=""><a href="#extrajudicial" role="tab" data-toggle="tab">RESOLUÇÃO EXTRAJUDICIAL (PAINEL)</a></li>
            <?php if($perfilDisponivel){?>
            <li id="reg_aces"><a href="#registroAcesso" role="tab" data-toggle="tab">REGISTROS DE ACESSOS</a></li>
            <?php }?>
            <?php if($perfil_corregedoria){?>
                <li id=""><a href="#corregedoria" role="tab" data-toggle="tab">CORREGEDORIA</a></li>
            <?php }?>
            <?php if($perfilSipa[0]){ ?>
                <li id=""><a href="#sipasalvos" role="tab" data-toggle="tab">SIPA - CÁLCULOS SALVOS</a></li>
            <?php } ?>

        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="historico">
            
                        
                <?php
                    if (!empty($extrato)) { ?>
                        <p style="margin: 0px; display: flex; justify-content: flex-end; align-items: center;">
                        <span style="
                        display: inline-block; 
                        width: 15px; 
                        height: 15px;
                        background-color: #f9f4a8;
                        border:#777777 solid 1px;
                        margin-right:5px;
                        "></span>Esta cor sinaliza que a ação foi movimentada e/ou criada pelo usuário</p>
                <?php }?>

                    
                <div style="display: flex; flex-direction:column-reverse; align-items: flex-end;">
                    <table class="table table-bordered table-striped">
                      
                        
                            <tr>
                                <th>DATA DE CADASTRO</th>
                                <th>NÚMERO</th>
                                <th>ESPECIALIZADA</th>
                                <th>TIPO DE AÇÃO</th>
                                <th>PROCESSO</th>
                                <th>SITUAÇÃO</th>
                                <?php if (empty($impressao)) { ?>
                                    <th>VISUALIZAR</th>
                                <?php } ?>
                            </tr>


                            <tbody>
                                <?php
                                $i = 0;
                                $anterior = '';
                            
                                if (!empty($extrato)) {
                                    $indice = 0;
                                    foreach ($extrato as $acao) :
                                        if ($anterior != $acao['vwextrato']['model']) {
                                            echo "<tr><td colspan = '7' bgcolor='#C4F0CD'>" . $this->Util->setaValorPadrao($arrayModel[$acao['vwextrato']['model']], $acao['vwextrato']['model']) . "</td></tr>";
                                        }
                                    
                                        $anterior = $acao['vwextrato']['model'];
                                        $chave = $acao['vwextrato']['link'] . "." . $acao['vwextrato']['id'];

                                ?>
                                        <tr style="background: <?php echo ($arrayUsuario[$indice]) ? '#f9f4a8' : '#f9f9f9'; ?>;">
                                            <td>
                                                <?php
                                                if (empty($acao['vwextrato']['momento']) or $acao['vwextrato']['momento'] == "0000-00-00") {
                                                    echo "ND";
                                                } else {
                                                    echo $this->Util->aammddHis($acao['vwextrato']['momento']);
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $this->Util->setaValorPadrao($acao['vwextrato']['numero']); ?></td>
                                            <td>
                                                <?php
                                                echo $this->Util->setaValorPadrao($arrayModel[$acao['vwextrato']['model']]);
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                unset($nome);
                                                $tipoAcao = $acao['vwextrato']['tipoAcao'];
                                                $nome = strlen($tipoAcao) > 20 ? substr($tipoAcao, 0, 20) . '...' : $tipoAcao;
                                                ?>
                                                <span title="<?php echo $tipoAcao; ?>"><?php echo $nome; ?>
                                            </td>
                                            <td><?php echo $this->Util->setaValorPadrao($acao['vwextrato']['processo']); ?></td>
                                            <td>
                                                <?php
                                                unset($nome);
                                                $situacao = empty($acao['vwextrato']['situacao']) ? 'ND' : $acao['vwextrato']['situacao'];
                                                $nome = strlen($situacao) > 20 ? substr($situacao, 0, 20) . '...' : $situacao;
                                                ?>
                                                <span title="<?php echo $situacao; ?>"><?php echo $nome; ?>
                                            </td>
                                            
                                            <?php if (empty($impressao)) { ?>
                                                <td>
                                                    <?php
                                                    $backgroudEye = $arrayUsuario[$indice] ? '#f9f4a8' : '#f9f9f9';
                                                    echo $this->Html->link($this->Html->div('glyphicon glyphicon-eye-open', '', ['style' => 
                                                    "background-color: $backgroudEye; 
                                                    line-height:2;
                                                    " ]), array(
                                                        'controller' => 'assistidos',
                                                        'action' => "detalhes/$chave/$idAssistido?trs=1"
                                                    ), array('class' => 'visualizar_dados_acao', 'escape' => false, 'title' => 'Vizualizar', 'id' => $acao['vwextrato']['link'] . $acao['vwextrato']['id'] . 'v'));
                                                    ?>
                                                </td>
                                            <?php $indice++; } ?>
                                        </tr>
                                    <?php
                                    endforeach;
                                } else {
                                    ?>
                                    <td colspan="8"> <?php echo "NÃO EXISTE HISTÓRICO PARA O ASSISTIDO." ?></td>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: space-between; width: 100%; align-items: flex-end;">
                            <p style="font-weight: bold; color: #777777;">HISTÓRICO</p>
                            <?php 
                                if (!empty($extrato)) { ?>

                                <div style="display: flex; align-items: flex-end;">
                                     <!-- <a href="#" class="glyphicon glyphicon-eye-close" id="recolherTodos" style="word-spacing: -10px; padding-bottom:5px;"> Recolher Todos</a> -->
                                   <div class="containerToggle">
                                        <p id="texto-botao">Expandir Todos </p>
                                        <div class="divToggle">
                                            <div class="toggle hide-process">
                                                <?php echo $this->Html->link($this->Html->div('glyphicon glyphicon-remove', '', ['id' => 'iconeToggle']), array(
                                            'controller' => 'assistidos',
                                            'action' => "detalhes/$chave/$idAssistido?trs=1"
                                        ), array('class' => 'visualizar_dados_acao_todos', 'escape' => false, 'title' => 'Detalhar todos', 'id' => $acao['vwextrato']['link'] . $acao['vwextrato']['id'] . 'v')); 
                                        ?></div>
                                        </div>
                                    </div>   
                                   
                                </div>
                            <?php } ?> 
                        </div>
                    </div>                    
            </div>
            <div class="tab-pane fade " id="agendamento">
                <table class="table table-bordered table-striped">
                    <caption><strong>AGENDAMENTOS</strong></caption>
                    <thead>
                        <tr>
                            <th title="Situação">Sit.</th>
                            <th title="Área de Atuação">AT</th>
                            <!--th>CADASTRO</th-->
                            <!--<th>ASSISTIDO</th>-->
                            <th>TIPO DE AÇÃO</th>
                            <th>DATA DO AGENDAMENTO</th>
                            <th>DEFENSOR(A) / SERVIDOR (A) / SALA</th>
                            <th>SITUAÇÃO</th>
                            <th title="Ação">AC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $arrayClasses[0] = 'inicial';
                        $arrayClasses[1] = 'retorno';
                        $arrayClasses[25] = 'plantao';
                //                       debug($agendamentos);
                        if (!empty($agendamentos)) {
                            foreach ($agendamentos as $agendamento) :
                                $t = $agendamento['tipo_atendimento'];
                                $arrayAcao = isset($agendamento['acao_id']) ? array("controller" => "acoes", "action" => "edit", $agendamento['acao_id']) : array("controller" => "conciliacoes", "action" => "edit", $agendamento['conciliacao_id']);
                        ?>
                                <tr title="<?php echo strtoupper($arrayClasses[$t]) ?>">
                                    <td><span id="legenda_<?php echo $arrayClasses[$t]; ?>"></span></td>
                                    <td title="<?php echo $agendamento['especializada']; ?>"><?php echo $agendamento['sigla_especializada']; ?></td>
                                    <!--td><?php //echo $this->Util->ddmmaa($agendamento['data_cadastro']); 
                                            ?></td-->
                                    <!--        
                                    <td><?php //echo $agendamento['assistido_nome']; 
                                        //if(!empty($this->Form->value('Pessoa.nome_social') && $this->Form->value('Pessoa.nome_social')!='ND'))
                                           // echo '<br><i style="font-size:11px">(Nome social: '.$this->Form->value('Pessoa.nome_social').')</i>';
                                        ?>
                                    </td> -->
                                    <td><?php echo $agendamento['tipo_acoes'] ?></td>
                                    <td><?php echo $this->Util->ddmmaa($agendamento['datas_agendas']) . '<br>' . $agendamento['horas_agendas']; ?></td>
                                    <td><?php  
                                        if($agendamento['tipo_funcionario'] == 4){
                                                    echo 'Def. ';
                                            }                                           
                                            echo ($agendamento['conciliacao_id'] > 0) ? strtoupper($agendamento['salas']) : strtoupper($agendamento['defensor']); 
                                            
                                        ?>
                                    </td>
                                    <td><?php echo $agendamento['situacao']; ?></td>
                                    <td title="Ação">                                       
                                        <?php
                                            echo $this->Html->link($this->Html->div('glyphicon glyphicon-new-window', ''),
                                             $arrayAcao,
                                              array("target" => "_blank", "escape" => false, "style" => "font-size:12px")); 
                                        ?>                                           
                                        
                                    </td>

                                </tr>
                            <?php
                            endforeach;
                        } else {
                            ?>
                            <td colspan="8"> <?php echo "NÃO EXISTEM AGENDAMENTOS PARA O ASSISTIDO." ?></td>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="anexo">
            <?php echo $this->Form->create('Anexo', array('id' => 'formAnexo', 'enctype' => "multipart/form-data")); ?>
                <div id="resFile">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <span style="color: red;">*</span>
                                <label>Descrição</label>
                                <?php echo $this->Form->input("Anexo.descricao", array("size" => 35, "maxlength" => 120, "label" => false, 'class' => 'form-control input-sm')) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span style="color: red;">*</span>
                                <label>Tipo do Anexo</label>
                                <?php
                                $args = array(
                                    //'empty' => 'Selecione',
                                    'class' => 'form-control input-sm',
                                    'multiple' => 'multiple'
                                );
                                echo $this->Form->select("Anexo.tipo_anexo_id", $tipoAnexos, $args)
                                ?>
                            </div>
                        </div>
                        <div class="outros col-md-4">
                            <?php if (isset($listaDefensores) && $listaDefensores) { ?>
                                <div class="form-group">
                                    <label>Notificar defensor(a)/funcionario(a) por e-mail</label>
                                    <?php
                                    $args = array(
                                        'empty' => 'Selecione',
                                        'class' => 'form-control input-sm autocomplete-def set-width-multiselect',
                                        'multiple' => 'multiple'
                                    );
                                    echo $this->Form->select("Anexo.defensor_notificado_id", $listaDefensores, $args);
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="outros col-md-4">
                            <div class="form-group" id="outros">
                                <label>Outros Tipos de Anexo</label>
                                <?php echo $this->Form->input("Anexo.tipo_anexo_outro", array("size" => 25, "maxlength" => 120, "label" => false)) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <table class="table-striped table table-bordered" style="margin-top: 2%;">
                                <thead>
                                    <tr>
                                        <th style="width: 80%;"><span style="color: red;">* </span>Selecionar o documento</th>
                                        <th>Associar o documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="CampoAnexoArquivo">
                                            <?php echo $this->Form->file('Anexo.arquivo.', array("class" => 'multiple btn btn-default', 'multiple')); ?>

                                        </td>
                                        <td>
                                            <?php
                                            if (isset($anexosSigilosos)) {
                                            echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upload File btn btn-primary', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'anexarDocumentoEdit'));
                                            } else {
                                            echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", ''), "javascript: void(0)", array("class" => 'upFileAnexo File btn btn-primary', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'img-up-0'));
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-4" style="width:300px">
                            <div class="form-group" style="width:300px">
                                <span style="color: red;">*</span>
                                <label>Arquivo</label>
                                <?php //echo $this->Form->file('Anexo.arquivo.', array("class" => 'multiple btn btn-default','multiple')); 
                                //echo $this->Form->input('Anexo.arquivo.', array('type' => 'file', 'multiple')); 
                                ?>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label></label><br>
                                <?php //echo $this->Html->link($this->Html->div("glyphicon glyphicon-upload", 'Enviar'), "javascript: void(0)", array("class" => 'upFileAnexo btn btn-primary ', "escape" => false, "alt" => 'UP', "title" => 'Subir o arquivo', 'id' => 'img-up-0', "style" => "width:300px;")); 
                                ?>
                            </div>
                        </div>
                    </div> -->


                    <h1><sub class="label label-warning lb-anexo">Tamanho máximo permitido: 10MB</sub></h1>




                    <?= $this->Form->hidden('model', array('value' => $model)) ?>
                    <?= $this->Form->hidden('idForm', array('value' => $idForm)) ?>
                    <?php echo $this->Form->input('id'); ?>
                    <?php echo $this->Form->input('Assistido.id', array('type' => 'hidden', 'value' => $idAssistido)); ?>
                    <?= $this->Form->hidden('idFuncLogado', array('value' => $dadosLogado['funcionario_id'])) ?>
                    <?php echo $this->Form->end(); ?>

                    <div class="alert alert-success" role="alert" id="remove-anexo-extrato" style="display:none;position:relative;width:auto;">
                                    Anexo apagado com sucesso.
                    </div>
                    <div class="alert alert-success" role="alert" id="edit-alert-success-anexo-extrato" style="display:none;position:relative;width:auto;">
                        Anexo salvo com sucesso.
                    </div>
                    <div class="alert alert-success" role="alert" id="edit-alert-success-anexo-extrato-email" style="display:none;position:relative;width:auto;">
                        Arquivo anexado e E-mail enviado com sucesso.
                    </div>
                    <div class="alert alert-danger" role="alert" id="edit-alert-danger-anexo-extrato" style="display:none;position:relative;width:auto;">
                        Erro ao anexar e/ou salvar o Anexo.
                    </div>


                    <div id="lista_anexos_extrato" style="margin-top: 15px">
                        <table id="table_anexos_extrato" cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">Data Cadastro</th>
                                    <th width="15%">Cadastrado por</th>
                                    <th width="30%">Descrição</th>
<!--                                    <th width="25%">Arquivo Anexado</th> -->
                                    <th width="10%">Tipo Anexo</th>                    
                                    <th width="10%">Opções</th>
                                    <th width="3%">Download em lote</th>
                                </tr>
                            </thead>
                        </table>     
                        <div id="selecionarTodos" 
                        style="font-size: 12;
                        display: flex;
                        text-align: end;
                        padding-right: 10px;
                        justify-content: flex-end;
                        align-items: center;">
                        </div>
                    </div>




                </div>


                <div class="row" id='downlod-anexos-em-lote' style="margin-top: 3%;">


                    <div class="col-md-4" style="margin-top: 2%;">


                        <div class="form-group">
                            <button class=" btn btn-primary" style="width:300px;" onclick="download_lote()">Download Em Lote</button> &nbsp;
                            <span title="Funcionalidade Permite Realizar Download de Anexos Selecionados de uma Única Vez" class="glyphicon glyphicon-exclamation-sign"></span>
                        </div>
                    </div>

                </div>

            </div>




            

            <div id="atividade_extrajudicial" class="tab-pane fade">
                <?php echo $this->element('atividade_extrajudicial'); ?>
            </div>

            <div id="processos" class="tab-pane fade">
                <?php echo $this->element('processo_painel'); ?>
            </div>
            <?php if($perfil_corregedoria){?>
                <div id="corregedoria" class="tab-pane fade">
                    <?php echo $this->element('corregedoria_painel2'); ?>
                </div>
            <?php }?>
            <div id="audiencias" class="tab-pane fade">
                <?php echo $this->element('audiencia_painel'); ?>
            </div>
            <div id="extrajudicial" class="tab-pane fade">
                <?php echo $this->element('extrajudicial_painel'); ?>
            </div>
            <div id="sipasalvos" class="tab-pane fade">
                <?php echo $this->element('sipas_salvos'); ?>
            </div>

            <div id="registroAcesso" class="tab-pane fade">
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <div class="checkbox">
                            <label>
                                <input id="verif_check" type="checkbox" onclick="verificar()">Filtrar registros por data de acessos
                            </label>
                        </div>
                        <form action="<?php echo "/assistidos/extrato/$idAssistido"?>">
                            <div class="form-group" id="bt_visualizar_acesso">
                                <input type="hidden" id="list_acesso" name="filtro" value="0">
                                <button class="btn btn-primary" type="submit">Exibir todos os acessos</button>
                            </div>
                        </form>
                        <div class="form-group" id="bt_ocultar_acesso" style="display: none;">
                            <button class="btn btn-success" onclick="ocultar()">Ocultar Visualização</button>
                        </div>
                        <div class="form-group form-inline" id="id_registro_acesso" style="display: none;">
                            <div class="form-group">
                                <label class="control-label">De:</label>
                                <input type="date" class="form-control" id="dataInicial" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Até:</label>
                                <input type="date" class="form-control" id="dataFinal" required>
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="obterdata()" class="btn btn-primary" id="filtrar">Filtrar</button>
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="limpar_filtro()" class="btn btn-default" id="filtrar">Limpar filtro</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped" id="lista_tabela" style="display:none">
                    <caption><strong>REGISTROS DE ACESSOS</strong></caption>    
                    <thead>
                        <tr>
                            <th class="text-center">Usuário</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Unidade de atendimento</th>
                            <th class="text-center">Data do acesso</th>
                            <th class="text-center">Hora do acesso</th>
                            <th class="text-center">Tela</th>
                            <th class="text-center">Link de acesso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registro_acesso as $registro) :?>
                            <tr>
                                <td><?=$registro['pes']['nome'] ?></td>
                                <td class="text-center"><?=$registro['tpfunc']['nome'] ?></td>
                                <td class="text-center"><?=$registro['und']['nome'] ?></td>
                                <td class="text-center"><?=$this->Util->ddmmaa($registro['reg']['data'])?></td>
                                <td class="text-center"><?=$registro['reg']['hora']?></td>
                                <td class="text-center"><?=$registro['tl']['nome']?></td>
                                <td class="text-center"><a href="/<?=$registro['reg']['url']?>"><div class="glyphicon glyphicon-link"></div></a></td>
                                
                            </tr>
                        <?php endforeach; ?>
                            <tr><td colspan="7" class="alert alert-success" style="position:relative; padding:14px"><?php echo $this->Paginator->counter(array('format' => '<strong>Página %page% de %pages%</strong>, exibindo %current% registros de um total de <strong>%count%</strong>, exibindo do registro %start% até o %end%'));?></td></tr> 
                            <tr>
                                <td colspan="7">
                                    <ul id="endereco" class="pagination">
                                        <?php echo $this->Paginator->prev(
                                            'Anterior',
                                            [
                                                'class' => 'page-item',
                                                'tag'   => 'li',
                                                'id'    => 'ant'
                                            ]);
                                        ?>
                                        <?php echo $this->Paginator->numbers(
                                            [
                                                'currentTag'    => 'a',
                                                'separator'     => false,
                                                'tag'           => 'li',
                                                'class'         => 'page-item pagina_acesso',
                                                'currentClass'  => 'active',
                                            ]);
                                        ?>
                                        <?php echo $this->Paginator->next(
                                            'Próximo',
                                            [
                                                'class' => 'page-item',
                                                'tag'   =>  'li',
                                                'id'    =>  'prox'
                                            ]);
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                    </tbody>
                </table>                
            </div>

        </div>

    </div>

<?php } else { ?>
    <table class="table table-bordered table-striped">
        <caption><strong>HISTÓRICO</strong></caption>

        <tr>
            <th>DATA DE CADASTRO</th>
            <th>NÚMERO</th>
            <th>ESPECIALIZADA</th>
            <th>TIPO DE AÇÃO</th>
            <th>SITUAÇÃO</th>
            <?php if (empty($impressao)) { ?>
                <th>VISUALIZAR</th>
            <?php } ?>
        </tr>

        <tbody>
            <?php
            $i = 0;
            $indice = 0;
            foreach ($extrato as $acao) :
                $chave = $acao['vwextrato']['link'] . "." . $acao['vwextrato']['id'];
            ?>
                <tr style="background: <?php echo ($arrayUsuario[$indice]) ? '#f9f4a8' : '#f9f9f9'; ?>;">
                    <td>
                        <?php
                        if (empty($acao['vwextrato']['momento']) or $acao['vwextrato']['momento'] == "0000-00-00") {
                            echo "ND";
                        } else {
                            echo $this->Util->aammddHis($acao['vwextrato']['momento']);
                        }
                        ?>
                    </td>
                    <td><?php echo $this->Util->setaValorPadrao($acao['vwextrato']['numero']); ?></td>
                    <td>
                        <?php
                        if ($acao['vwextrato']['model'] == 'plantao_atendimentos') {
                            $x = $arrayModel[$acao['vwextrato']['model']];
                            foreach ($x as $key => $value) {
                                if ($key == $acao['vwextrato']['id']) {
                                    echo $this->Util->setaValorPadrao($value);
                                }
                            }
                        } else {
                            echo $this->Util->setaValorPadrao($arrayModel[$acao['vwextrato']['model']]);
                        }

                        ?>

                    </td>
                    <td>
                        <?php
                        unset($nome);
                        $tipoAcao = $acao['vwextrato']['tipoAcao'];
                        $nome = strlen($tipoAcao) > 20 ? substr($tipoAcao, 0, 20) . '...' : $tipoAcao;
                        ?>
                        <span title="<?php echo $tipoAcao; ?>"><?php echo $nome; ?>
                    </td>
                    <td>
                        <?php
                        unset($nome);
                        $situacao = $acao['vwextrato']['situacao'];
                        $nome = strlen($situacao) > 20 ? substr($situacao, 0, 20) . '...' : $situacao;
                        ?>
                        <span title="<?php echo $situacao; ?>"><?php echo $nome; ?>
                    </td>
                    <?php if (empty($impressao)) { ?>
                        <td>
                        <?php
                            $backgroudEye = $arrayUsuario[$indice] ? '#f9f4a8' : '#f9f9f9';
                            echo $this->Html->link($this->Html->div('glyphicon glyphicon-eye-open', '', ['style' => 
                            "background-color: $backgroudEye; 
                            line-height:2;
                            " ]), array(
                                'controller' => 'assistidos',
                                'action' => "detalhes/$chave/$idAssistido?trs=1"
                            ), array('class' => 'visualizar_dados_acao', 'escape' => false, 'title' => 'Vizualizar', 'id' => $acao['vwextrato']['link'] . $acao['vwextrato']['id'] . 'v'));
                            ?>
                        </td>
                    <?php $indice++;} ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>
<div>
    <?php
    if (!$impressao) {
        echo $this->Html->link($this->Html->div('print', 'Imprimir'), array(
            'controller' => 'assistidos',
            'action' => "extrato", $idAssistido, true
        ), array(
            'title' => 'Imprimir',
            'target' => '_blank',
            'escape' => false,
            'class' => 'btn btn-default marginbottom10'
        ));
    }
    ?>
</div>
<br />
<div id="detalhes"></div>
<div id="marcadorExpediente"></div>


<script>
    var downlod_anexos_em_lote = [];
    var listaDadosFuncionarios = [];
    const queryString = window.location.search;
    

switch (true) {
    case queryString.includes('inst=2'):
        showTabContent('processos');
        break;
    case queryString.includes('inst=3'):
        showTabContent('corregedoria');
        break;
    case queryString.includes('page1'):
        showTabContent('abaPartes');
        break;
    default:
        // Handle the default case if none of the conditions match
        break;
}

    function get_id_anexo_download(checkboxElem) {
        try {
            if (checkboxElem.checked) {
                downlod_anexos_em_lote.push(checkboxElem.value)
            } else {
                downlod_anexos_em_lote = jQuery.grep(downlod_anexos_em_lote, function(value) {
                    return value != checkboxElem.value;
                });

            }

        } catch (error) {
            console.log(error);
        }

    }

    function download_lote() {

        try {

            if (!downlod_anexos_em_lote.length) {

                alert('Nenhum arquivo selecionado');
                return false;
            }

            $.ajax({
                url: '/anexos/anexo_download_lote/?trs=1',
                dataType: 'text',
                data: {
                    // idAnexo: $('.downlod-anexos-em-lote').val()
                    idAnexo: downlod_anexos_em_lote
                },
                success: function(response) {

                    if (response) {
                        location.href = '/anexos/open_zip/' + response + '?trs=1';
                    }
                }
            });

        } catch (error) {

            console.log(error);

        }

    }





    $(document).ready(function() {

        $('.downlod-anexos-em-lote').select2();
        $('#AnexoTipoAnexoId').select2();
        $('.autocomplete-def').select2({});

        $("#ControleMotivo").hide();
        $("#controleFuncionario").hide();

        //Mostra e esconde o campo outros do tipo de anexo
        $("#outros").hide();
        $("#AnexoTipoAnexoId").on("change", function() {
            var outro = $(this).val();
            if (outro === '6') {
                $("#outros").show();
            } else {
                $("#outros").hide();
            }
        });

        $(".AnexoSigiloso").on("change", function() {
            var val = jQuery(this).val();

            if (val == 1) {
                $("#ControleMotivo").show();
            } else {
                $("#ControleMotivo").hide();
            }
        });

        $("#AnexoTipoPermissao").on("change", function() {
            // id 1 => Comarca 
            // id 2 => Grupo 
            // id 3 => Individual 
            var val = jQuery(this).val();

            if (val == 3) {
                $("#controleFuncionario").show();
            } else {
                $("#controleFuncionario").hide();
            }

        });

        //Faz o upload do arquivo
        $('.upFileAnexo').click(function() {

            var form = document.getElementById('formAnexo');
            var model = document.getElementById('AnexoModel');
            var formData = new FormData(form);
            var tamanho = $('#AnexoArquivo').val().length;
            var objText1 = document.getElementById("AnexoArquivo");            

            if ($('#AnexoArquivo').val() === '') {
                alert('Selecione um arquivo');

                return false;
            }
            if ($('#AnexoTipoAnexoId').val() == null || $('#AnexoTipoAnexoId').val() == '') {
                alert('Selecione o tipo de anexo');
                return false;
            }
            if ($('#AnexoDescricao').val() === '') {
                alert('Adicione uma Descrição');

                return false;
            }

            //Verifica se existe a mesma quantidade de arquivos para a quantidade de arquivos
            var qntArquivos = $("#AnexoArquivo")[0].files.length;
            var qntTipoAnexo = $('#AnexoTipoAnexoId').val().length;

            if (qntArquivos != qntTipoAnexo) {
                alert("A quantidade do Tipo do Anexo e a quantidade de Arquivos devem ser iguais");
                return false;
            }

            //Para verificar se o tamanho do arquivo é maior que 10MB
            for (var i = 0; i < qntArquivos; i++) {
                var tamanho = $("#AnexoArquivo")[0].files[i].size;
                if (tamanho > 10485760) {
                    alert("Selecione arquivo menor que 10MB.");
                    return false;
                }
                
                var nome_origem = $("#AnexoArquivo")[0].files[i].name;
                var arquivoOriginal = $("#AnexoArquivo")[0].files[i];
                if ( /[^A-Za-z\d]/.test(nome_origem)) {
                    var remove = /[^a-z0-9|\.]/gi; 
                    var nome_novo = nome_origem.replace(remove, "");
                    
                    var fileName = document.getElementById('AnexoArquivo');
                    
                    Object.defineProperty(arquivoOriginal, 'name', {
                      writable: true,
                      value: nome_novo
                    }); 

                    Object.defineProperty(arquivoOriginal, 'tmp_name', {
                      writable: true,
                      value: nome_novo
                    });           
                   
                    /*
                    alert("O nome do arquivo não pode ter caracter especial."); */
                    //return false;                   
                }
                
            }

            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'upload_multiplos_anexos_extrato', $model, '?' => array('trs' => 1)), true) ?>",
                type: 'POST',
                //beforeSend: showRequest,
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {

                    var d = JSON.stringify(eval("(" + result + ")"));
                    var dados = JSON.parse(d);

                    if (dados.retorno && !(dados.email)) {

                        $('#edit-alert-success-anexo-extrato').show(800).delay(800).hide(800);
                        //                        reloadAnexosExtratoTable();
                        reloadAnexosExtratoTablePainel();
                    } else if (dados.retorno && dados.email) {

                        $('#edit-alert-success-anexo-extrato-email').show(800).delay(800).hide(800);
                    } else {

                        $('#edit-alert-danger-anexo-extrato').show(800).delay(800).hide(800);
                    }

                    //$('#lista_anexos').html(data);
                }
            });
        });

    });


    function showTabContent(tabId) {
        $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
    }
    //Função que vai populando a tabela assim que insere
    var idAssistido = $('#AssistidoId').val();
    var idFuncLogado = $('#AnexoIdFuncLogado').val();
    //    reloadAnexosExtratoTable();
    reloadAnexosExtratoTablePainel();

    function reloadAnexosExtratoTable() {

        $("#downlod-anexos-em-lote").hide();


        $.ajax({
            url: "/anexos/list_anexos_extrato/",
            type: "POST",
            datatype: 'json',
            data: {
                idAssistido: idAssistido
            },
            success: function(result) {

                var dados = eval("(" + result + ")");

                $("#downlod-anexos-em-lote").show();

                //Limpa a tabela
                $("#table_anexos_extrato > tbody").html("");
                var table_row = '';

                //Cria o tbody
                table_row += '<tbody>';

                //Se a tabela  não houver dados
                if (dados.length == 0) {

                    table_row += '<tr>';
                    table_row += '<th colspan="5">Sem cadastros</th>'
                    table_row += '</tr>';

                } else {

                    for (i = 0; i < dados.length; i++) {

                        var remove = /[^a-z0-9|\.| ]/gi; 
                        var nome_novo = dados[i].Anexo.filename.replace(remove, "");

                        //Popula a tabela
                        table_row += '<tr>';
                        table_row += '<td>' + getDataBR(dados[i].Anexo.dt_cadastro) + '</td>';
                        table_row += '<td>' + dados[i].Pessoa.nome + '</td>';
                        table_row += '<td>' + dados[i].Anexo.descricao + '</td>';
                        table_row += '<td>' + dados[i].TipoAnexo.nome + '</td>';


                        table_row += "<td class='actions'>";
                        table_row += link;
                        table_row += "<div class='icons-acoes'>";

                        // Download do anexo
                        table_row += "<div class='icon-box'>";
                        table_row += "<a href='/anexos/anexo_download_extrato/" + dados[i].Anexo.id + "' target='_/anexos/anexo_download_extrato/" + dados[i].Anexo.id + "' title='Download' text-decoration='none' >"
                        table_row += "<img src=''>";
                        table_row += "<svg width='23' height='23' viewBox='0 0 25 25' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='25' height='25' fill='url(#pattern0)'/><defs><pattern id='pattern0' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_10_3' transform='scale(0.0111111)'/></pattern><image id='image0_10_3' width='90' height='90' xlink:href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFKklEQVR4nO2dS4gcRRjH24OvqAcfIWrwoODjEhA3h3Vd7O3/v2Z2xFW8jOd4EBHUBEQR9WY0K0JEURFBkXjxIpgIUVHwEcEHalRQQ0wEJTGCeFDjIwYz8pGe0NR093TP1Gx11dQfvst21XxVv675qvqr6tkoCgoKCgoKCgoKCgoK8llxHJ8GYCPJjwEcJtmzZQCOAPiA5NWRT2q32xcB+MomXOYD/0cpdX3k0UhuHGT6BhvAJtswOQ2wAXxiGySnATbJPxoG9LCXsG2DpWYLCwvXkPy9BPaRJElujFyTbbDUTNrkJewmgvYSdlNBewe7yaC9gt100N7AdgG0F7BdAe08bJdAOw3bNdAipdS8c7BdBO0kbFdBOwfbZdBOwXYdtDOwfQAtUkrFw1KsVvcgbYOlZkqpCycI+8PIlhoI+r5x+lMGW0JIZEu2wTIHhsCe1MiObMk2WK6wBdAMoK2PQoYRTevgQuigfaghRjOAtj7iGEY0rUMKoYP2AfoSo38G8C7JlwA8TXIZwDMkt5P8kuSxgnp/AXgDwIskH5d6ad2tJLdJ7gHAf0N8/0Ly0yomT5Uug35/2GcAWAvguZy6X1SouwbAQ2l2bcA/gOer9gXAD16D7gvA3XVB99Vqta4E8GsAnVEcx+fNz8+fHeUIwFujgO4n8PVQMrUjGsC9mWufKaXWZa/L+eUi0AA2pPH8XwDfKqVuzWnPtjLQ8oaC3Mw8I/m3r6B7AL7JXu90OqeSPFoA+rac0LAxW0Yptb4MNMlnK07gfoEm2et0Oqu1Mgergpa9vlardUam2EkAfgygMQgawFXazfu6BuievnEK4NUAGoOgW63WxRroA3VAA3hAq/9YAI0B0Pvk696HJGFAJruaoLdqoO+pOxmS3ONzjD4k+3Pa9etKVh25oEm+kC2nlLq9CHSRANzhG+i1AG4CkMRxfGbO571ZF7Q8oheVm1rQZZJ1sVZ3pNCRfcI0DPq9yGXQ3W73FJnQMuvnuqHjQa3clpIYfX9BQunEkjDHviO5ENlUXdBKqXUAbiC5lCTJLQCeBPBTQd1KoJVSN2vlXjH1wAJgV1G6wLnlHYutCuijcRyfr7VpnwnQAPY2AnITQAN4WWvPZdr1UUEfS5Lk2qgpsgx6T85oftgEaABvR03SSoJOkmRO1syp3TU3N3dW9vri4uIF+pm5MUBvKJq4ST4q80qak1mWv0U+gS7T0tLSKpIf5QAbCbRS6tI8P+l2ml5+OZoG0CQvSX+sqmcKtNy4PF+ZzGLWx8ExMVbq5LCv4OdJksz0DcATVUFLrlrCQd5Xc3Z29nSZrEg+VfZahGwAa/5PLP3KrG5/rYM2ZQD+lJEDYD+A3ybtb2pBc4UtgGYAbX0UMoxo++BC6GAzTHZZJE3bbrev0DZ7w2RIM4D36rs8o0z+xlcZVR27YAB2tdvtc0z0d3KEhzhuugH4Xo6mmervZOhWcNx0S5IEJvtrnmxFx002jJECDaBZHXTe4Ug9BWrwpppJpToaNi6vkQI1ZeOlUm1D4wiWd55EZHIk59ghr34/mmOAzpz5M25ynGFc0AO7Gg6Hjs0T9Lt5XNB32gZHQ5PhzMzMyembYqZ9bpfPHgu0nNAHsNs2PNYwAO8U9Sddeeww6G+Hsc3b9ODibl8eWLrmYJuDnG2cHBSUlyxdmCBx/A2sc4f057VGQfZV3eMje5SYvVNCqu32+w57p/y3Jdvt9h12gDxp2ABeDyN5wrAD5Mi80tXIljQrdwDAI1VXF/8D+Us57t9ql0MAAAAASUVORK5CYII='/></defs></svg>";
                        table_row += "<p class='paragrafo-icon'>Abrir anexo</p>";
                        table_row += "</a>";
                        table_row += "</div>";
                        
                        $(".downlod-anexos-em-lote").append(new Option(dados[i].Anexo.descricao, dados[i].Anexo.id));

                        if (idFuncLogado == dados[i].Funcionario.id) {
                            // Validação dos icones para anexos criados pelo usuário logado

                            // Deletar anexo
                            table_row += "<div class='icon-box'>";
                            table_row += "<a onclick='delete_anexo_extrato(" + dados[i].Anexo.id + ")'  id='v" + dados[i].Anexo.id + "' class='delete-anexo'>";
                            table_row += "<svg width='23' height='23' viewBox='0 0 25 25' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='25' height='25' fill='url(#pattern5)'/><defs><pattern id='pattern5' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_10_5' transform='scale(0.0111111)'/></pattern><image id='image0_10_5' width='90' height='90' xlink:href='data:image/png;base64,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'/></defs></svg>";
                            table_row += "<p class='paragrafo-icon'>Excluir arquivo</p>";
                            table_row += "</a>";
                            table_row += "</div>";

                            // Informa a situação da permissão para acesso do anexo
                            table_row += "<div class='icon-box'>";
                            table_row += "<svg width='23' height='23' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' fill='url(#pattern1)'/><defs><pattern id='pattern1' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_14_3' transform='scale(0.0111111)'/></pattern><image id='image0_14_3' width='90' height='90' xlink:href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADsklEQVR4nO2dz29MURTHb+JnxE5IKAsRFkKIClFzz4uKmJ5TvxZN/BFKE1ZWFlYaESuxkVhYERbsu0PFj0qwsJG0nXM6JZUqES2e3E5D1Hv9oZ13pm/ONznbefd+5vu+7547uW+cM5lMJpPJZKprFYtvlxVaOfIkFzzKXSB5DSRDQDwKKF8ApdeTPAeUex75nCfZE0XxYu1xLxhF2L8TUK5VoEo8yxryKJeBBjdrz6NmBS0D24H4ARD//A/Akyp8Bt834JMiAkg6PfHY3AH/XZ7ka4ieKHq33NWzDhTLmwDl2XwD/gc4yhN/eHCtq0cViBuBuFxtyL8LuRS18G5XT/KtpV1APDy9E/m7R+7yVOoooOzdd0jWNDbGSxpbSyv8sf4NHstNQHx2IttHZ+DsjxHJNlc3cUFTO9kTf/YkFw8e7181088N0RDyeNovEKW36ej7dS73Dz6cOpM98a255Gkz9TYAyZ1p3P003BkurwKSzqliIsTAfF0rNDGA/CMd9sB5l9d1sk9ZwlUgl07M9zULJCfTYIelX6Glf4vLm2D8gZXmrvlzcqKz0/P6tsuT9lN5R1rHFzK52tevdIkpq5ojstHlRVDZu0heXWTQSISlICB/SnH1FZejFnsoJScvZjUOIL6UMoY+lweFrU5IdvPYbNbJc9V4g5PwMPbIAy4PqjQRkpSPXZmPBflGwhd+1eVBYWMeEh1d6sh6LFFbeaVHuQko3yZ29q7nZmfPk7xJAh32LrTG1NYWL8pdZ+hRPiSCLvJq7bHlSuE2hQTQW9teLdUeW66U1pU5k4FekDJHZyQDnZEMdEYy0HNU6KiABs4AcnfYhZvmp6N4oVZlbvwYUE6HDbJsIRf71gPyS20IkHUh94S5Z+fkeoRMf2Bn4uzxuNCeLOlWAaW9+qCRu7UnCsrliR9VHbRHHtGeKGiDRh6pOmjtSUKNlIEmAx1ru9AcTfrgLDpIH6plNBlodceBOVrUIVl0kD5Ay2iqrbKGhQx0rO1CczTpg7PoIH2oltFkoNUdB+ZoUYdk0UH6AC2jqbbKGhYy0LG2C83RpA/OooP0oVpGk4FWdxyYo0UdkkUH6QO0jKbaKmtYyEDH2i40R5M+OIsO0odqGU0GWt1xYI4WdUgWHaQPsGYy2g4LSXjz5HD1GxY7/hZncvwtnInWvm1BuTzJqYzeAc09dQz5RWbvg5o4dN9Tj5CbqbfBZf7PPyjtIa/y/ID0yCMe+WGIC3uzmclkMplMJpPJZHJ51C+puaC14frxZAAAAABJRU5ErkJggg=='/></defs></svg>";
                            table_row += "<p class='paragrafo-icon'>Acesso liberado </p>";
                            table_row += "</div>";
                            table_row += "</div>";
                        }
                        
                        table_row += "</td>";

                        table_row += "<td>";
                        table_row += "<input align='center' class='anexo' type='checkbox' id='" + i + "' value='" + dados[i].Anexo.id + "' onchange='get_id_anexo_download(this)' >";
                        table_row += "</td>";


                        table_row += '</tr>';
                    }
                }
                table_row += '</tbody>';
                
                $("#table_anexos_extrato").append(table_row);
               
            
            }
        });
    }

    function getDataBR(date) {
        var retorno = date.split("-");
        var dataFormatada =
            retorno[2].substring(0, 2) + "/" + retorno[1] + "/" + retorno[0];

        return dataFormatada;
    }

    function delete_anexo_extrato(idAnexo) {
        if (confirm("Tem certeza que deseja excluir?")) {

            $.post(window.location.origin + '/anexos/anexo_delete_extrato/' + idAnexo, function(data) {
                if (data) {

                    $('#remove-anexo-extrato').show(800).delay(800).hide(800);
                    //alert('Anexo excluído com sucesso.')
                    //                    reloadAnexosExtratoTable();
                    reloadAnexosExtratoTablePainel();
                } else {
                    alert('O anexo não pôde ser excluído, por favor tente novamente.');
                }
            });
        }

    }
      

    function solicitarPermissao(elemento) {
        anexoID = elemento.value;
        elemento.checked = false;
        $('#modalObterAutorizacao').modal();
    }

    function reloadAnexosExtratoTablePainel() {

$("#downlod-anexos-em-lote").hide();


$.ajax({
    url: "/anexos/list_anexos_extrato/",
    //            url: "/anexos/list_anexos_extrato_painel/",
    type: "POST",
    datatype: 'json',
    data: {
        idAssistido: idAssistido
    },
    success: function(result) {
        var dados = eval("(" + result + ")");
        var link = '';

        $("#downlod-anexos-em-lote").show();

        //Limpa a tabela
        $("#table_anexos_extrato > tbody").html("");
        var table_row = '';

        //Cria o tbody
        table_row += '<tbody>';

        //Se a tabela  não houver dados
        if (dados.length == 0) {

            table_row += '<tr>';
            table_row += '<th colspan="5">Sem cadastros</th>'
            table_row += '</tr>';

        } else {
            // função para selecionar todos anexos
            if ($('#selectAll').length === 0) {
                $("#selecionarTodos").append('<label style="margin-top:10px; margin-right:5px">Selecionar todos</label><input for="selectAll" id="selectAll" type="checkbox">'); 
                $("#selectAll").click(function() {
                    if ($(this).prop("checked")) {
                        $("input.anexo[type=checkbox]").prop("checked", $(this).prop("checked"));
                        $("input.anexo[type=checkbox]").click(function() {
                            $("#selectAll").prop("checked", false)
                        });
                        $("input.anexo:checked").each(function() {
                            get_id_anexo_download(this);
                        });
                    } else{
                        $("input.anexo[type=checkbox]").prop("checked", false);
                        $("input.anexo").each(function() {
                            get_id_anexo_download(this);
                        });
                    }  
                });
            }
            for (i = 0; i < dados.length; i++) {
                
                // Foi necessário colocar este filtro aqui porque no sql o delay é muito grande
                //if (dados[i].Anexo.Sigiloso == null || dados[i].Anexo.Sigiloso == 0) {
                    
                    link = "<a href='/anexos/anexo_download_extrato/" + dados[i].Anexo.id + "' target='_/anexos/anexo_download_extrato/" + dados[i].Anexo.id + "' title='Download' text-decoration='none' >";

                    if (dados[i].Anexo.outro === '**Anexo**do**Painel**') {
                        dados[i].TipoAnexo.nome = '';
                    }
                    //teste = dados[i].Anexo.filename;
                    //console.log(teste);

                    var remove = /[^a-z0-9|\.| ]/gi; 
                    var nome_novo = dados[i].Anexo.filename.replace(remove, "");                
                    // Se o valor for 1 é pq o anexo é sigiloso e deve ter tratamento especifico
                    if (dados[i].Anexo.Sigiloso == 1) {

                        //Popula a tabela sigiloso estilizada
                        table_row += '<tr class="conteudo-tabela">';
                        //table_row += '<td>'+dados[i].Anexo.id+'</td>';
                        table_row += '<td class="conteudo-tabela-sigiloso">' + getDataBR(dados[i].Anexo.dt_cadastro) + '</td>';
                        table_row += '<td class="conteudo-tabela-sigiloso">' + dados[i].Pessoa.nome + '</td>';
                        table_row += '<td class="conteudo-tabela-sigiloso" wid>' + dados[i].Anexo.descricao + '</td>';
                        //table_row += '<td>' + nome_novo + '</td>';
                        table_row += '<td class="conteudo-tabela-sigiloso">' + dados[i].TipoAnexo.nome + '</td>';

                        table_row += "<td class='actions'>";
                        table_row += link
                        table_row += "<div class='icons-acoes'>";

                        // Download do anexo
                        table_row += "<div class='icon-box'>";
                        table_row += "<a href='javascript:void(0)' onclick='validarAberturaAnexoSigiloso(" + dados[i].Anexo.id + ")'>"
                        table_row += "<img src=''>";
                        table_row += "<svg width='23' height='23' viewBox='0 0 25 25' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='25' height='25' fill='url(#pattern0)'/><defs><pattern id='pattern0' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_10_3' transform='scale(0.0111111)'/></pattern><image id='image0_10_3' width='90' height='90' xlink:href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFKklEQVR4nO2dS4gcRRjH24OvqAcfIWrwoODjEhA3h3Vd7O3/v2Z2xFW8jOd4EBHUBEQR9WY0K0JEURFBkXjxIpgIUVHwEcEHalRQQ0wEJTGCeFDjIwYz8pGe0NR093TP1Gx11dQfvst21XxVv675qvqr6tkoCgoKCgoKCgoKCgoK8llxHJ8GYCPJjwEcJtmzZQCOAPiA5NWRT2q32xcB+MomXOYD/0cpdX3k0UhuHGT6BhvAJtswOQ2wAXxiGySnATbJPxoG9LCXsG2DpWYLCwvXkPy9BPaRJElujFyTbbDUTNrkJewmgvYSdlNBewe7yaC9gt100N7AdgG0F7BdAe08bJdAOw3bNdAipdS8c7BdBO0kbFdBOwfbZdBOwXYdtDOwfQAtUkrFw1KsVvcgbYOlZkqpCycI+8PIlhoI+r5x+lMGW0JIZEu2wTIHhsCe1MiObMk2WK6wBdAMoK2PQoYRTevgQuigfaghRjOAtj7iGEY0rUMKoYP2AfoSo38G8C7JlwA8TXIZwDMkt5P8kuSxgnp/AXgDwIskH5d6ad2tJLdJ7gHAf0N8/0Ly0yomT5Uug35/2GcAWAvguZy6X1SouwbAQ2l2bcA/gOer9gXAD16D7gvA3XVB99Vqta4E8GsAnVEcx+fNz8+fHeUIwFujgO4n8PVQMrUjGsC9mWufKaXWZa/L+eUi0AA2pPH8XwDfKqVuzWnPtjLQ8oaC3Mw8I/m3r6B7AL7JXu90OqeSPFoA+rac0LAxW0Yptb4MNMlnK07gfoEm2et0Oqu1Mgergpa9vlardUam2EkAfgygMQgawFXazfu6BuievnEK4NUAGoOgW63WxRroA3VAA3hAq/9YAI0B0Pvk696HJGFAJruaoLdqoO+pOxmS3ONzjD4k+3Pa9etKVh25oEm+kC2nlLq9CHSRANzhG+i1AG4CkMRxfGbO571ZF7Q8oheVm1rQZZJ1sVZ3pNCRfcI0DPq9yGXQ3W73FJnQMuvnuqHjQa3clpIYfX9BQunEkjDHviO5ENlUXdBKqXUAbiC5lCTJLQCeBPBTQd1KoJVSN2vlXjH1wAJgV1G6wLnlHYutCuijcRyfr7VpnwnQAPY2AnITQAN4WWvPZdr1UUEfS5Lk2qgpsgx6T85oftgEaABvR03SSoJOkmRO1syp3TU3N3dW9vri4uIF+pm5MUBvKJq4ST4q80qak1mWv0U+gS7T0tLSKpIf5QAbCbRS6tI8P+l2ml5+OZoG0CQvSX+sqmcKtNy4PF+ZzGLWx8ExMVbq5LCv4OdJksz0DcATVUFLrlrCQd5Xc3Z29nSZrEg+VfZahGwAa/5PLP3KrG5/rYM2ZQD+lJEDYD+A3ybtb2pBc4UtgGYAbX0UMoxo++BC6GAzTHZZJE3bbrev0DZ7w2RIM4D36rs8o0z+xlcZVR27YAB2tdvtc0z0d3KEhzhuugH4Xo6mmervZOhWcNx0S5IEJvtrnmxFx002jJECDaBZHXTe4Ug9BWrwpppJpToaNi6vkQI1ZeOlUm1D4wiWd55EZHIk59ghr34/mmOAzpz5M25ynGFc0AO7Gg6Hjs0T9Lt5XNB32gZHQ5PhzMzMyembYqZ9bpfPHgu0nNAHsNs2PNYwAO8U9Sddeeww6G+Hsc3b9ODibl8eWLrmYJuDnG2cHBSUlyxdmCBx/A2sc4f057VGQfZV3eMje5SYvVNCqu32+w57p/y3Jdvt9h12gDxp2ABeDyN5wrAD5Mi80tXIljQrdwDAI1VXF/8D+Us57t9ql0MAAAAASUVORK5CYII='/></defs></svg>";
                        table_row += "<p class='paragrafo-icon'>Abrir anexo</p>";
                        table_row += "</a>";
                        table_row += "</div>";

                    } else {

                        //Popula a tabela não sigiloso
                        table_row += '<tr class="conteudo-tabela">';
                        table_row += '<td>' + getDataBR(dados[i].Anexo.dt_cadastro) + '</td>';
                        table_row += '<td>' + dados[i].Pessoa.nome + '</td>';
                        table_row += '<td>' + dados[i].Anexo.descricao + '</td>';
                        table_row += '<td>' + dados[i].TipoAnexo.nome + '</td>';


                        table_row += "<td class='actions'>";
                        table_row += link;
                        table_row += "<div class='icons-acoes'>";

                        // Download do anexo
                        table_row += "<div class='icon-box'>";
                        table_row += "<a href='/anexos/anexo_download_extrato/" + dados[i].Anexo.id + "' target='_/anexos/anexo_download_extrato/" + dados[i].Anexo.id + "' title='Download' text-decoration='none' >"
                        table_row += "<img src=''>";
                        table_row += "<svg width='23' height='23' viewBox='0 0 25 25' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='25' height='25' fill='url(#pattern0)'/><defs><pattern id='pattern0' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_10_3' transform='scale(0.0111111)'/></pattern><image id='image0_10_3' width='90' height='90' xlink:href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFKklEQVR4nO2dS4gcRRjH24OvqAcfIWrwoODjEhA3h3Vd7O3/v2Z2xFW8jOd4EBHUBEQR9WY0K0JEURFBkXjxIpgIUVHwEcEHalRQQ0wEJTGCeFDjIwYz8pGe0NR093TP1Gx11dQfvst21XxVv675qvqr6tkoCgoKCgoKCgoKCgoK8llxHJ8GYCPJjwEcJtmzZQCOAPiA5NWRT2q32xcB+MomXOYD/0cpdX3k0UhuHGT6BhvAJtswOQ2wAXxiGySnATbJPxoG9LCXsG2DpWYLCwvXkPy9BPaRJElujFyTbbDUTNrkJewmgvYSdlNBewe7yaC9gt100N7AdgG0F7BdAe08bJdAOw3bNdAipdS8c7BdBO0kbFdBOwfbZdBOwXYdtDOwfQAtUkrFw1KsVvcgbYOlZkqpCycI+8PIlhoI+r5x+lMGW0JIZEu2wTIHhsCe1MiObMk2WK6wBdAMoK2PQoYRTevgQuigfaghRjOAtj7iGEY0rUMKoYP2AfoSo38G8C7JlwA8TXIZwDMkt5P8kuSxgnp/AXgDwIskH5d6ad2tJLdJ7gHAf0N8/0Ly0yomT5Uug35/2GcAWAvguZy6X1SouwbAQ2l2bcA/gOer9gXAD16D7gvA3XVB99Vqta4E8GsAnVEcx+fNz8+fHeUIwFujgO4n8PVQMrUjGsC9mWufKaXWZa/L+eUi0AA2pPH8XwDfKqVuzWnPtjLQ8oaC3Mw8I/m3r6B7AL7JXu90OqeSPFoA+rac0LAxW0Yptb4MNMlnK07gfoEm2et0Oqu1Mgergpa9vlardUam2EkAfgygMQgawFXazfu6BuievnEK4NUAGoOgW63WxRroA3VAA3hAq/9YAI0B0Pvk696HJGFAJruaoLdqoO+pOxmS3ONzjD4k+3Pa9etKVh25oEm+kC2nlLq9CHSRANzhG+i1AG4CkMRxfGbO571ZF7Q8oheVm1rQZZJ1sVZ3pNCRfcI0DPq9yGXQ3W73FJnQMuvnuqHjQa3clpIYfX9BQunEkjDHviO5ENlUXdBKqXUAbiC5lCTJLQCeBPBTQd1KoJVSN2vlXjH1wAJgV1G6wLnlHYutCuijcRyfr7VpnwnQAPY2AnITQAN4WWvPZdr1UUEfS5Lk2qgpsgx6T85oftgEaABvR03SSoJOkmRO1syp3TU3N3dW9vri4uIF+pm5MUBvKJq4ST4q80qak1mWv0U+gS7T0tLSKpIf5QAbCbRS6tI8P+l2ml5+OZoG0CQvSX+sqmcKtNy4PF+ZzGLWx8ExMVbq5LCv4OdJksz0DcATVUFLrlrCQd5Xc3Z29nSZrEg+VfZahGwAa/5PLP3KrG5/rYM2ZQD+lJEDYD+A3ybtb2pBc4UtgGYAbX0UMoxo++BC6GAzTHZZJE3bbrev0DZ7w2RIM4D36rs8o0z+xlcZVR27YAB2tdvtc0z0d3KEhzhuugH4Xo6mmervZOhWcNx0S5IEJvtrnmxFx002jJECDaBZHXTe4Ug9BWrwpppJpToaNi6vkQI1ZeOlUm1D4wiWd55EZHIk59ghr34/mmOAzpz5M25ynGFc0AO7Gg6Hjs0T9Lt5XNB32gZHQ5PhzMzMyembYqZ9bpfPHgu0nNAHsNs2PNYwAO8U9Sddeeww6G+Hsc3b9ODibl8eWLrmYJuDnG2cHBSUlyxdmCBx/A2sc4f057VGQfZV3eMje5SYvVNCqu32+w57p/y3Jdvt9h12gDxp2ABeDyN5wrAD5Mi80tXIljQrdwDAI1VXF/8D+Us57t9ql0MAAAAASUVORK5CYII='/></defs></svg>";
                        table_row += "<p class='paragrafo-icon'>Abrir anexo</p>";
                        table_row += "</a>";
                        table_row += "</div>";
                        
                    }

                    //table_row += "<td class='actions'>";
                    //table_row += link
                    //table_row += "<a href='/anexos/anexo_download_extrato/" + dados[i].Anexo.id + "' target='_/anexos/anexo_download_extrato/" + dados[i].Anexo.id + "' title='Download' text-decoration='none' >"
                    //table_row += "<img src=''>";
                    //table_row += "<div class='glyphicon glyphicon-download'></div>";
                    //table_row += "</a>";

                    $(".downlod-anexos-em-lote").append(new Option(dados[i].Anexo.descricao, dados[i].Anexo.id));

                    if (idFuncLogado == dados[i].Funcionario.id && dados[i].Anexo.outro !== '**Anexo**do**Painel**') {
                        // Validação dos icones para anexos criados pelo usuário logado

                        if (dados[i].Anexo.Sigiloso == 1) {

                            // Deletar anexo
                            table_row += "<div class='icon-box'>";
                            table_row += "<a onclick='validarExclusaoAnexoSigiloso(" + dados[i].Anexo.id + ")'>";
                            table_row += "<svg width='23' height='23' viewBox='0 0 25 25' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='25' height='25' fill='url(#pattern5)'/><defs><pattern id='pattern5' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_10_5' transform='scale(0.0111111)'/></pattern><image id='image0_10_5' width='90' height='90' xlink:href='data:image/png;base64,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'/></defs></svg>";
                            table_row += "<p class='paragrafo-icon'>Excluir arquivo</p>";
                            table_row += "</a>";
                            table_row += "</div>";

                            
                        } else {

                            // Deletar anexo
                            table_row += "<div class='icon-box'>";
                            table_row += "<a onclick='delete_anexo_extrato(" + dados[i].Anexo.id + ")'  id='v" + dados[i].Anexo.id + "' class='delete-anexo'>";
                            table_row += "<svg width='23' height='23' viewBox='0 0 25 25' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='25' height='25' fill='url(#pattern5)'/><defs><pattern id='pattern5' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_10_5' transform='scale(0.0111111)'/></pattern><image id='image0_10_5' width='90' height='90' xlink:href='data:image/png;base64,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'/></defs></svg>";
                            table_row += "<p class='paragrafo-icon'>Excluir arquivo</p>";
                            table_row += "</a>";
                            table_row += "</div>";

                        }

                    }

                        //table_row += "<a onclick='delete_anexo_extrato(" + dados[i].Anexo.id + ")'  id='v" + dados[i].Anexo.id + "' class='delete-anexo'>";
                        //table_row += "<div class='glyphicon glyphicon-trash'></div>";
                        //table_row += "</a>";
                    var correspondente = false;
                    
                    if (dados[i].Anexo.Sigiloso == 1 && dados[i].Anexo.Sigiloso != null) {

                        if (idFuncLogado == dados[i].Funcionario.id){
                            correspondente = true;

                            
                        } else {

                            // Comarca
                            if(dados[i]['Anexo']['tipo_permissao_id'] == 1){
                                for (v = 0; v < dados[i]['Anexo']['Sigiloso'].length; v++) {
                                    if (funcionarioCorrente['comarca_id'] == dados[i]['AnexoSigiloso'][v]['AnexosSigiloso']['comarca_id']) {
                                        correspondente = true;
                                        break;
                                    }
                                }
                            } 
                            
                            // Grupo Perfil
                            else if(dados[i]['Anexo']['tipo_permissao_id'] == 2){
                                for (v = 0; v < dados[i]['Anexo']['Sigiloso'].length; v++) {
                                    if(funcionarioCorrente['perfil_usuario_id'] == dados[i]['AnexoSigiloso'][v]['AnexosSigiloso']['perfil_id']){
                                        correspondente = true;
                                        break;  
                                    }

                                }
                            }


                            // Individual
                            else if(dados[i]['Anexo']['tipo_permissao_id'] == 3){
                                for (v = 0; v < dados[i]['Anexo']['Sigiloso'].length; v++) {
                                    if(dados[i]['AnexoSigiloso']){
                                        if (funcionarioCorrente['funcionario_id'] == dados[i]['AnexoSigiloso'][v]['AnexosSigiloso']['funcionario_id']) {
                                            if (dados[i]['AnexoSigiloso'][v]['AnexosSigiloso']['nivel_permissao'] == 1) {
                                                correspondente = true; 
                                                break;
                                            }
                                        
                                        }                                        
                                    }

                                }
                            }

                        }

                        if (correspondente) {

                            // Informa a situação da permissão para acesso do anexo 
                            table_row += "<div class='icon-box'>";
                            table_row += "<svg width='23' height='23' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' fill='url(#pattern1)'/><defs><pattern id='pattern1' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_14_3' transform='scale(0.0111111)'/></pattern><image id='image0_14_3' width='90' height='90' xlink:href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADsklEQVR4nO2dz29MURTHb+JnxE5IKAsRFkKIClFzz4uKmJ5TvxZN/BFKE1ZWFlYaESuxkVhYERbsu0PFj0qwsJG0nXM6JZUqES2e3E5D1Hv9oZ13pm/ONznbefd+5vu+7547uW+cM5lMJpPJZKprFYtvlxVaOfIkFzzKXSB5DSRDQDwKKF8ApdeTPAeUex75nCfZE0XxYu1xLxhF2L8TUK5VoEo8yxryKJeBBjdrz6NmBS0D24H4ARD//A/Akyp8Bt834JMiAkg6PfHY3AH/XZ7ka4ieKHq33NWzDhTLmwDl2XwD/gc4yhN/eHCtq0cViBuBuFxtyL8LuRS18G5XT/KtpV1APDy9E/m7R+7yVOoooOzdd0jWNDbGSxpbSyv8sf4NHstNQHx2IttHZ+DsjxHJNlc3cUFTO9kTf/YkFw8e7181088N0RDyeNovEKW36ej7dS73Dz6cOpM98a255Gkz9TYAyZ1p3P003BkurwKSzqliIsTAfF0rNDGA/CMd9sB5l9d1sk9ZwlUgl07M9zULJCfTYIelX6Glf4vLm2D8gZXmrvlzcqKz0/P6tsuT9lN5R1rHFzK52tevdIkpq5ojstHlRVDZu0heXWTQSISlICB/SnH1FZejFnsoJScvZjUOIL6UMoY+lweFrU5IdvPYbNbJc9V4g5PwMPbIAy4PqjQRkpSPXZmPBflGwhd+1eVBYWMeEh1d6sh6LFFbeaVHuQko3yZ29q7nZmfPk7xJAh32LrTG1NYWL8pdZ+hRPiSCLvJq7bHlSuE2hQTQW9teLdUeW66U1pU5k4FekDJHZyQDnZEMdEYy0HNU6KiABs4AcnfYhZvmp6N4oVZlbvwYUE6HDbJsIRf71gPyS20IkHUh94S5Z+fkeoRMf2Bn4uzxuNCeLOlWAaW9+qCRu7UnCsrliR9VHbRHHtGeKGiDRh6pOmjtSUKNlIEmAx1ru9AcTfrgLDpIH6plNBlodceBOVrUIVl0kD5Ay2iqrbKGhQx0rO1CczTpg7PoIH2oltFkoNUdB+ZoUYdk0UH6AC2jqbbKGhYy0LG2C83RpA/OooP0oVpGk4FWdxyYo0UdkkUH6QO0jKbaKmtYyEDH2i40R5M+OIsO0odqGU0GWt1xYI4WdUgWHaQPsGYy2g4LSXjz5HD1GxY7/hZncvwtnInWvm1BuTzJqYzeAc09dQz5RWbvg5o4dN9Tj5CbqbfBZf7PPyjtIa/y/ID0yCMe+WGIC3uzmclkMplMJpPJZHJ51C+puaC14frxZAAAAABJRU5ErkJggg=='/></defs></svg>";
                            table_row += "<p class='paragrafo-icon'>Acesso liberado</p>";
                            table_row += "</div>";
                            table_row += "</div>";
                            table_row += "</td>";

                            
                            table_row += "<td>";
                            table_row += "<input align='center' class='anexo' type='checkbox' id='" + i + "' value='" + dados[i].Anexo.id + "' onchange='get_id_anexo_download(this)' >";
                            table_row += "</td>";
                            
                        } else {

                            // Informa a situação da permissão para acesso do anexo 
                            table_row += "<div class='icon-box' title='Clique para solicitar permissão de acesso.'>";
                            table_row += "<a href='javascript:void(0)' class='icon-box' onclick='validarAberturaAnexoSigiloso(" + dados[i].Anexo.id + ")'>";
                            table_row += "<svg width='23' height='23' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' fill='url(#pattern3)'/><defs><pattern id='pattern3' patternContentUnits='objectBoundingBox' width='1' height='1'><use xlink:href='#image0_10_6' transform='scale(0.0111111)'/></pattern><image id='image0_10_6' width='90' height='90' xlink:href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADv0lEQVR4nO2dy2sTURTGL4KPlSCi4gMEXQiCKBaU1twTWpHGc6Ko4Na9YH27EUSF6sadG/8BFXFRN65bRPCxECtUEV2ItTkn0SJoFd9GbiModiZtbTInk5wPDoSSMPf+5ptvzr0wU+dMJpPJZDKZWlq53LO5mTxnPckZj9IHJI+B5C0QfwXkgifuB5TLnuQsUHHn1l0jC7XHnCplcWQDoFyqQJXyVMsjf/cot7PE+zflRudrz6NhBduL64D4JhD/nA7gyEJ+75HPZejlAu15NVREAMkFT/xtxoAnuFxGgXifa3V15kqrAeVBrQFHAO9r2Tjx+cJGIC7VG/Jf9bQTeaVrQcjvpnaD4wFPhcMZlM3t22RxW1t5dqjwOfwtg3xk/DvI3yfPbhkOV5Frmbig6k72xB88Se90Wrbw3fAbQPk4ycl7nsnxItf0Nz6snsme+Irvfr30f4/RsfPNMk98dZJj9LvT5VmuWQUkF6rFBBAfq9WxPPLx6nFSPOmatU/2MS1cBUhhd82PibwnDrYn+ZSh4irXbILxxUicu2rn5H/lUU7ER4hcd82kLVRaH7fiC5lc7+MD8rXoLoR/dHSPrHHNIqjsXUR3FzO48U1VXTS8PK4b8cQXXRMtsd/GXLq9SY0DkM/HxFYp9OUu7QpbnRDtpG9Jbm2G3jnuxpjNFzIu7Qr7yRDdaQwkPRYguRVz0k+5tAtQbkRPrnA48bHk+Wj0SZc+l3Z5kidRkwv7FEmPBfLF9pjuY8ilXZU9YZkIWmG/oWtHcUmMo0dd2gUoX6Imt3bv0BylDiiq+/ns0q64VZmz8RjoVMocnZAMdEIy0AnJQM9Q2eyLeUDFQ4B8P+zCxe81p7sqc+N7gHIwtIfJQs69WgHIj7QhQNKFPBjmnpyTWxEy/YGdiLPH40J7sqRbGZSe+oNGvq89UVAuT3y37qA98pj2REEbNPJY3UFrTxIapAw0GeiytgvN0aQPzqKD9KFaRpOBVnccmKNFHZJFB+kDtIymxipbsJCBLmu70BxN+uAsOkgfqmU0GWh1x4E5WtQhWXSQPkDLaGqssgULGeiytgvN0aQPzqKD9KFaRpOBVnccmKNFHZJFB+kDtIymxipbsJCBLmu70BxN+uAsOkgfqmU0GWh1x4E5WtQhWXSQPsCGyWh7WEjCK9ze1X/BYo+/lRN5/C08E6192YJyeZIDCb0DmgdbGPLDxN4H9fuh+8FWhNxFw8td4v/5B6Un5FUz3yA98phHvhPiQuPNZiaTyWQymUwmk8nk6q1f75QqL287nPQAAAAASUVORK5CYII='/></defs></svg>";
                            table_row += "<p class='paragrafo-icon'>Acesso negado</p>";
                            table_row += "</a>";
                            table_row += "</div>";
                            table_row += "</div>";
                            table_row += "</td>";

                            
                            table_row += "<td>";
                            table_row += "<input align='center' type='checkbox' id='" + i + "' value='" + dados[i].Anexo.id + "' onclick='solicitarPermissao(this)' >";
                            table_row += "</td>";
                        }

                    } else {
                        table_row += "<td>";
                        table_row += "<input align='center' class='anexo' type='checkbox' id='" + i + "' value='" + dados[i].Anexo.id + "' onchange='get_id_anexo_download(this)' >";
                        table_row += "</td>";
                    }

        //$.post(uri, function(data){

                    //table_row += "<td>";
                    //table_row += "<input align='center' class='anexo' type='checkbox' id='" + i + "' value='" + dados[i].Anexo.id + "' onchange='get_id_anexo_download(this)' >";
                    //table_row += "</td>";



                    table_row += '</tr>';
                //}

            }
        }
        table_row += '</tbody>';
        $("#table_anexos_extrato").append(table_row);
    }
});
}
 

    
   
        

 // Solicitar autorização para os funcionários para ter acesso ao anexo
    $("#solicitarAutorizacao").on("click", function() {
        try {
            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'anexos', 'action' => 'solicitarAcessoAnexoSigilosoViaEmail',  '?' => array('trs' => 1)), true) ?>",
                type: 'POST',
                data: {
                    "data": [{
                        "idAnexo": anexoID,
                        "idFuncionarioCorrente": funcionarioCorrente['funcionario_id']
                    }]
                },

                success: function(data) {
                    $("#modalObterAutorizacao").modal('hide');
                    alert("E-mail enviado com sucesso.");
                }
            });
        } catch (error) {
            console.log(error);
        }

    });

    //Corrigir caracter especial do nome do anexo.
    function fixString($string)
    {
        
        $map = {
            "Âª": "ª",
            "Âº": "º",
            "Ãƒ": "Ã",
            "Ã‚": "Â",
            "Ã‡": "Ç",
            "Ã‰": "É",
            "ÃŠ": "Ê",
            "Ã�": "Í",
            "Ã“": "Ó",
            "Ã”": "Ô",
            "Ãš": "Ú",
            "Ã¡": "á",
            "Ã¢": "â",
            "Ã£": "ã",
            "Ã§": "ç",
            "Ã©": "é",
            "Ãª": "ê",
            "Ã": "í",
            "Ã³": "ó",
            "Ã´": "ô",
            "Ãº": "ú",
            "\r": "",
            "\t": "",
            "\n": "",
            "í³": "ó",
            "í­": "í",

        };

        for ( $key = 0; $key < $map.length; $key = $key + 1){
            $string =  str_replace($key, $map, $string);
        }
        /*
        foreach($map as $key => $valor) {
            $string = str_replace($key, $valor, $string);
        }
*/
        
        return $string;
    }


    // Existe anexo que é sigiloso por isso é necessário verifiar se quem está abrindo tem permissão
    function validarAberturaAnexoSigiloso(anexoID_) {
        anexoID = anexoID_;
        $.ajax({
            url: "/anexos/validarPrevilegioAberturaAnexoSigiloso/",
            type: "POST",
            datatype: 'json',
            data: {
                anexoID: anexoID_
            },
            success: function(data) {
                console.log(data);
                if (data == true) {
                    //window.open('/anexos/anexo_download_extrato/' + anexoID);
                    jQuery('<form target="_blank" action="' + '/anexos/anexo_download_extrato/' + anexoID_ + '" method="get"></form>').appendTo('body').submit().remove();

                } else {
                    $('#modalObterAutorizacao').modal();
                }
            }

        });
    }

    function showInfoFuncionario(id, nome) {

        //console.log(nome);
        //console.log(id);
        listaDadosFuncionarios.push([id, nome]);
        //console.log(listaDadosFuncionarios);

        montarTabelaFuncionario(listaDadosFuncionarios);

        $('#rowInfoFuncionario').show();
        //$('#nomeAssistido').html(nome);
        }

        $(document).on('keyup', '#buscarNome', function() {

        //var uri = "<?php //echo $this->Html->url(array('controller' => 'amparo_vitimas', 'action' => 'delete')) 
                        ?>" +'/'+ id.substring(1);

        //$.post(uri, function(data){

        var uri = "<?php echo $this->Html->url(array('controller' => 'assistidos', 'action' => 'buscarFuncionario')) ?>" + '/' + $(this).val();

        //if ($(this).val().length > 2) $.get("/assistidos/buscarFuncionario/"+$(this).val(), {}, function (data) {
        if ($(this).val().length > 2) $.get(uri, function(data) {


            data = JSON.parse(data.trim());
            if (data.length > 0) {
                $('#autocompletefuncionarioContainer').html(printAutocompleteFuncionario(data));
            } else {
                $('#autocompletefuncionarioContainer').html("");
            }

            });
        });

    function printAutocompleteFuncionario(data) {
        var ul = "<ul class='autocomplete_live'>";
        for (var i = 0; i < data.length; i++) {
            ul += "<li> <a href='#' onclick='showInfoFuncionario(" + data[i].Funcionario.id + ",\"" + data[i].Pessoa.nome + "\")'>" + data[i].Pessoa.nome + "</a> </li>";


        }
        ul += "</ul>";
        return ul;
    }

    function montarTabelaFuncionario(listaFuncionarios) {

        var table_row = '';
        $("#tabelaFuncionariosModoTabela > tbody").html("");
        table_row = '<tbody>';
        for (var i = 0; i < listaFuncionarios.length; i++) {
            table_row += '<tr>';
            table_row += '<td>' + listaFuncionarios[i][1] + '</td>';
            table_row += '<td>' +
                '<div class="form-group">' +
                '<input type="radio"  name="Anexo.nivel_permissao' + [i] + '" value="0" />' +
                '<label>Pode alterar permissções</label> &nbsp;&nbsp;' +
                '<input type="radio"  name="Anexo.nivel_permissao' + [i] + '" value="1" />' +
                '<label>Visualizar somente</label>' +
                '</td>';
            table_row += '</tr>';
        }
        table_row += '</tbody>';

        $("#tabelaFuncionariosModoTabela").append(table_row);

    }
    //listaFuncionariosModoTabela




    // $('#FiltroNome').click(function(){           
    //     console.log($('#FiltroNome').val());
    //     console.log($('#FiltroNome').prop('name'));            
    //     //alert();
    //     //var abc = $('#FiltroNome').val();
    //     //Console.log(abc);

    // });
    // $("#nomeFuncionario" ).on('click', function() {
    //     alert("@!!");
    //     var abc = $('#nomeFuncionario').val();
    //     Console.log(abc);
    // });
    function printAutocompleteFuncionario(data) {
        var ul = "<ul class='autocomplete_live'>";
        for (var i = 0; i < data.length; i++) {
            ul += "<li> <a href='#' onclick='showInfoFuncionario(" + data[i].Funcionario.id + ",\"" + data[i].Pessoa.nome + "\")'>" + data[i].Pessoa.nome + "</a> </li>";


        }
        ul += "</ul>";
        return ul;
    }

    // Existe anexo que é sigiloso por isso é necessário verifiar se quem está excluíndo tem permissão
    function validarExclusaoAnexoSigiloso(anexoID_) {
        anexoID = anexoID_;
        $.ajax({
            url: "/anexos/validarPrevilegioAnexoSigiloso/",
            type: "POST",
            datatype: 'json',
            data: {
                anexoID: anexoID_
            },
            success: function(data) {
                if (data == true) {
                    delete_anexo_extrato(anexoID_);


                } else {
                    $('#modalObterAutorizacao').modal();
                }
            }
        });
    }

    // Solicitar acesso a um determinado anexo sigiloso
    function solicitarPermissao(elemento) {
        anexoID = elemento.value;
        elemento.checked = false;
        $('#modalObterAutorizacao').modal();
    }

   
    
</script>

<script>
    var cont = 0;
    var crtl = 0;
    function exibir(){
        var url = endereco.baseURI;
        var param = new URL(url);
        var string = param.searchParams.get("filtro");
        if(string ==1){
            mostrar_aba_acesso();
            alternar();
            document.getElementById("verif_check").checked = true;
            $('#id_registro_acesso').toggle();
            $('#bt_ocultar_acesso').toggle();
            var data_start = param.searchParams.get("datainicial");
            var data_end = param.searchParams.get("datafinal");
            document.querySelector('input[id="dataInicial"]').value = data_start;
            document.querySelector('input[id="dataFinal"]').value = data_end;
            crtl =1;
        }
        else if(string==0){
            mostrar_aba_acesso();
            alternar();
            cont=1;
        }
        
    }
    
    function atualizar(){
        document.getElementById("verif_check").checked = false;
        if(ant.href == undefined){
            ant.innerHTML = "<a>Anterior</a>";
            ant.setAttribute("class","disabled");
        }
        if(prox.href == undefined){
            prox.innerHTML = "<a>Próximo</a>";
            prox.setAttribute("class","disabled");
        }
        exibir();
    }
        
    function alternar(){
        $('#bt_visualizar_acesso').toggle();
        $('#bt_ocultar_acesso').toggle();
        $('#lista_tabela').toggle();
    }

    function ocultar(){
        cont=0;
        alternar();
    }

    function verificar(){
        $('#id_registro_acesso').toggle();
        $('#bt_visualizar_acesso').toggle();
        if(cont){
            alternar();
            cont=0;
        }
        if(crtl){
            $('#lista_tabela').toggle();
            crtl =0;
        }
        document.getElementById("dataInicial").value ="";
        document.getElementById("dataFinal").value ="";
    }

    function mostrar_aba_acesso(){
        hist.removeAttribute("class");
        historico.classList.remove("in","active");
        reg_aces.setAttribute("class", "active");
        registroAcesso.classList.add("in","active");
    }

    function obterdata(){
        var inicio, fim, url, urlfinal;
        url = '<?php echo "/assistidos/extrato/$idAssistido"?>';
        inicio = dataInicial.value;
        fim = dataFinal.value;
        urlfinal = url+"?datainicial="+inicio+"&filtro=1"+"&datafinal="+fim;
        window.location.href = urlfinal;
    }
    function limpar_filtro(){
        document.getElementById("dataInicial").value ="";
        document.getElementById("dataFinal").value ="";
    }     

    function gerenciarMarcador(id, urlPag){
        $.ajax({
            url: '/assistidos_marcadores/marcador/'+id+'?urlAtual='+urlPag+'&trs=1',
            type: "GET",
            datatype: 'html',
            success: function(data) {
                $("#marcadorExpediente").html(data);
                $('#addMarcador').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        });
    }
</script>