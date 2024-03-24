
<?php

$checkAtivo = "";
$checkPassivo = "";
$checkTerceiros = "";

$poloContrarioSigla = $poloContrario == "passivo" ? "PA" : "AT";
$poloContrarioSigla = $poloContrario != "ativo" && $poloContrarioSigla == "AT" ? "TC" : "AT";
if($cadastroIncompleto && $poloAssistido == $poloContrarioSigla){
    
    $checkAtivo = $poloContrarioSigla == "AT"? "checked" : "";
    $checkPassivo = $poloContrarioSigla == "PA"? "checked" : "";
    $checkTerceiros = $poloContrarioSigla == "TC"? "checked" : "";

}else{

    $checkAtivo = "checked";
    $checkPassivo = "";
    $checkTerceiros = "";
    
    if($poloContrario == "passivo" || $poloPassivo_default) {
        $checkTerceiros = "";
        $checkAtivo = "";
        $checkPassivo = "checked";
    }else if($poloContrario == "terceiro"){
        $checkTerceiros = "checked";
        $checkAtivo = "";
        $checkPassivo = "";
    }

}

$poloPassivoShowRadio = true;
$poloPassivoMensagem = "Selecione um Réu";
if(!$reus){
    $poloPassivoShowRadio = false;
    $poloPassivoMensagem = "Polo passivo inexistente";
}

?>

<div class="col-md-4">
<div class="form-group" id="novoAutor">
    <label for="PeticionamentoIntermediarioAutores">
        <input class="form-check-input" type="radio" name="flexRadioAssistido" id="flexRadioAssistidoAutor" onclick="setAssistido('ativo');" <?=$checkAtivo?>>
        Polo Ativo:
        <span class="span-sem-assistido">(Assistido não consta na base do SIGAD)</span>
    </label>
    <div class="row">
        <div class="col-md-10">
            <?php
                echo $this->Form->select(
                    'PeticionamentoIntermediario.Autores',
                    $autores,
                    array(
                        'name' => 'Autores[]',
                        'class' => 'form-control input-sm select2-type',
                        'empty' => 'Selecione um Autor',
                        'required' => true,
                        'default' => count($autorId)?$autorId[0]:[]));
            ?>
            <script>
                <?php if (count($autorId) > 1) { ?>
                    document.addEventListener("DOMContentLoaded", function() {
                        var selectContainer = document.getElementById("BtnAdicionaPoloAtivo");
                        selectContainer.appendChild(addPoloAtivo());
                });
                <?php } ?>
            </script>
        </div>
        <div class="col-md-1" style="padding: 5px 0px 8px 0px;">
            <a id="linkAutores" href="#" target="_blank" title="Exibir Extrato"><div class="glyphicon glyphicon glyphicon-file"></div></a>
            <a id="BtnAdicionaPoloAtivo" title="Adicionar Polo Ativo" onclick="addPoloAtivo()"><i class="glyphicon glyphicon glyphicon-plus-sign"></i></a>
        </div>
    </div>
    <div class="row" id="addPoloAtivo">
        <!-- <div class="col-md-11">
        </div> -->
    </div>
    <?php if (isset($representantesAtivosLabel) && !empty($representantesAtivosLabel)) : ?>
        <div class="row">
            <p style="margin: 10px 15px;"><b>Representante(s): </b><?php echo $representantesAtivosLabel; ?></p>
        </div>
    <?php endif; ?>
</div>
</div>

<div class="col-md-4">
<div class="form-group" id="novoReu">
    <label for="PeticionamentoIntermediarioReus">
        <?php if($poloPassivoShowRadio): ?>
            <input class="form-check-input" type="radio" name="flexRadioAssistido" id="flexRadioAssistidoReu" onclick="setAssistido('passivo');" <?=$checkPassivo?>>
        <?php endif; ?>
        Polo Passivo:
        <span class="span-sem-assistido">(Assistido não consta na base do SIGAD)</span>
    </label>
    <div class="row">
        <div class="col-md-10">
            <?php
                echo $this->Form->select(
                    'PeticionamentoIntermediario.Reus',
                    $reus,
                    array(
                        'name' => 'Reus[]',
                        'class' => 'form-control input-sm select2-type',
                        'empty' => $poloPassivoMensagem,
                        'required' => true,
                        'onchange' => 'javascript:changeAssistidoReu(this);',
                        'default' => count($reuId)?$reuId[0]:[]));
            ?>
            <script>
                <?php if (count($reuId) > 1) { ?>
                    document.addEventListener("DOMContentLoaded", function() {
                        var selectContainer = document.getElementById("BtnAdicionaPoloPassivo");
                        selectContainer.appendChild(addPoloPassivo());
                });
                <?php } ?>
            </script>
        </div>
        <div class="col-md-1" style="padding: 5px 0px 8px 0px;">
            <a id = "linkReus" href="#" target="_blank" title="Exibir Extrato"><div class="glyphicon glyphicon glyphicon-file"></div></a>
            <?php if($poloPassivoShowRadio): ?>
                <a id="BtnAdicionaPoloPassivo" title="Adicionar Polo Passivo" onclick="addPoloPassivo()"><i class="glyphicon glyphicon glyphicon-plus-sign"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row" id="addPoloPassivo">
        <!-- <div class="col-md-11" >
        </div> -->
    </div>
    <?php if (isset($representantesPassivosLabel) && !empty($representantesPassivosLabel)) : ?>
        <div class="row">
            <p style="margin: 10px 15px;"><b>Representante(s): </b><?php echo $representantesPassivosLabel; ?></p>
        </div>
    <?php endif; ?>
</div>
</div>

<?php if ($outrosInteressados): ?>

    <div class="col-md-4">
        <div class="form-group">
            <label for="PeticionamentoIntermediarioOutrosInteressados">
                <input class="form-check-input" type="radio" name="flexRadioAssistido" id="flexRadioAssistidoInteressado" onclick="setAssistido('terceiro');" <?=$checkTerceiros?>>
                Outros Interessados:
                <?php if(!$idAssistidoOutros): ?>
                    <span class="span-sem-assistido">(Assistido não consta na base do SIGAD)</span>
                <?php endif; ?>
            </label>
            <div class="row">
                <div class="col-md-10">
                    <?php
                        echo $this->Form->select(
                            'PeticionamentoIntermediario.OutrosInteressados',
                            $this->Util->setaValorPadrao($outrosInteressados, null),
                            array(
                                'name' => 'OutrosInteressados',
                                'class' => 'form-control input-sm select2-type',
                                'empty' => 'Selecione um Interessado',
                                'required' => true,
                                'default' => $interessadoId));
                    ?>
                </div>
                <div class="col-md-1" style="padding: 5px 0px 8px 0px;">
                    <?php if($idAssistidoOutros): ?>
                        <a href="/assistidos/extrato/<?php echo $idAssistidoOutros; ?>" target="_blank" title="Exibir Extrato"><div class="glyphicon glyphicon glyphicon-file"></div></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<script>
    <?php if ($checkAtivo === "checked") { ?>
        document.addEventListener("DOMContentLoaded", function() {
            var selectContainer = document.getElementById("flexRadioAssistidoAutor");
            selectContainer.click();
        });
    <?php } ?>
    <?php if ($checkPassivo === "checked") { ?>
        document.addEventListener("DOMContentLoaded", function() {
            var selectContainer = document.getElementById("flexRadioAssistidoReu");
            selectContainer.click();
        });
    <?php } ?>
</script>