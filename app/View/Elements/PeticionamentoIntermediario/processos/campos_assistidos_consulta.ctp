
<div class="col-md-4">
    <div class="form-group">
        <label for="PeticionamentoIntermediarioNomeAutor">
            <input class="form-check-input" type="radio" id="flexRadioAssistidoAutor">
            Polo Ativo:
        </label>
        <?php if(isset($autor) && is_array($autor) && count($autor) >= 1): ?>

            <?php foreach ($autor as $key => $assistido): ?>

                <?php if (!$assistido['PeticionamentoIntermediariosAssistidos'] || !isset($assistido['PeticionamentoIntermediariosAssistidos']['assistido_id'])) : ?>
                    <span class="span-sem-assistido">(Assistido não consta na base do SIGAD)</span>
                <?php  endif; ?>

                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-10">
                        <?php
                            echo $this->Form->text(
                                'PeticionamentoIntermediario.NomeAutor',
                                array(
                                    'name' => 'NomeAutor',
                                    'class' => 'nome form-control input-sm',
                                    'required' => true,
                                    'readonly' => true,
                                    'value' => strtoupper($assistido['Pessoas']['nome'])));
                        ?>
                    </div>
                    <div class="col-md-1" style="padding: 5px 0px 8px 0px;">
                        <a id="linkAutores_<?=$key?>"  href="/assistidos/extrato/<?php echo $assistido['PeticionamentoIntermediariosAssistidos']['assistido_id']; ?>" target="_blank" title="Exibir Extrato"><div class="glyphicon glyphicon glyphicon-file"></div></a>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <?php if (!$idAssistidoAtivo) : ?>
                <span class="span-sem-assistido">(Assistido não consta na base do SIGAD)</span>
            <?php  endif; ?>

            <div class="row">
                <div class="col-md-10">
                    <?php
                        echo $this->Form->text(
                            'PeticionamentoIntermediario.NomeAutor',
                            array(
                                'name' => 'NomeAutor',
                                'class' => 'nome form-control input-sm',
                                'required' => true,
                                'readonly' => true,
                                'value' => strtoupper($autor)));
                    ?>
                </div>
                <div class="col-md-1" style="padding: 5px 0px 8px 0px;">
                    <a id="linkAutores"  href="/assistidos/extrato/<?php echo $idAssistidoAtivo; ?>" target="_blank" title="Exibir Extrato"><div class="glyphicon glyphicon glyphicon-file"></div></a>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="PeticionamentoIntermediarioNomeReu">
            <input class="form-check-input" type="radio" id="flexRadioAssistidoReu">
            Polo Passivo:
        </label>

        <?php if(isset($reu) && is_array($reu) && count($reu) >= 1): ?>

            <?php foreach ($reu as $key => $assistido): ?>

                <?php if (!$assistido['PeticionamentoIntermediariosAssistidos'] || !isset($assistido['PeticionamentoIntermediariosAssistidos']['assistido_id'])) : ?>
                    <span class="span-sem-assistido">(Assistido não consta na base do SIGAD)</span>
                <?php  endif; ?>

                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-10">
                        <?php
                            echo $this->Form->text(
                                'PeticionamentoIntermediario.NomeReu',
                                array(
                                    'name' => 'NomeReu',
                                    'class' => 'nome form-control input-sm',
                                    'required' => true,
                                    'readonly' => true,
                                    'value' => strtoupper($assistido['Pessoas']['nome'])));
                        ?>
                    </div>
                    <div class="col-md-1" style="padding: 5px 0px 8px 0px;">
                        <a id="linkReus_<?=$key?>"  href="/assistidos/extrato/<?php echo $assistido['PeticionamentoIntermediariosAssistidos']['assistido_id']; ?>" target="_blank" title="Exibir Extrato"><div class="glyphicon glyphicon glyphicon-file"></div></a>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <?php if (!$idAssistidoPassivo) : ?>
                <span class="span-sem-assistido">(Assistido não consta na base do SIGAD)</span>
            <?php  endif; ?>

            <div class="row">
                <div class="col-md-10">
                    <?php
                        echo $this->Form->text(
                            'PeticionamentoIntermediario.NomeReu',
                            array(
                                'name' => 'NomeReu',
                                'class' => 'nome form-control input-sm',
                                'required' => true,
                                'readonly' => true,
                                'value' => strtoupper($reu)));
                    ?>
                </div>
                <div class="col-md-1" style="padding: 5px 0px 8px 0px;">
                    <?php if ($idAssistidoPassivo) : ?>
                        <a id="linkReus"  href="/assistidos/extrato/<?php echo $idAssistidoPassivo; ?>" target="_blank" title="Exibir Extrato"><div class="glyphicon glyphicon glyphicon-file"></div></a>
                    <?php  endif; ?>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<?php if ($terceiro): ?>

    <div class="col-md-4">
        <div class="form-group">
            <label for="PeticionamentoIntermediarioOutrosInteressados">
                <input class="form-check-input" type="radio" id="flexRadioAssistidoInteressado">
                Outros Interessados:
                <?php if(!$idAssistidoOutros): ?>
                    <span class="span-sem-assistido">(Assistido não consta na base do SIGAD)</span>
                <?php endif; ?>
            </label>
            <div class="row">
                <div class="col-md-10">
                    <?php
                        echo $this->Form->text(
                            'PeticionamentoIntermediario.OutrosInteressados',
                            array(
                                'name' => 'NomeOutroInteressado',
                                'class' => 'form-control input-sm',
                                'required' => false,
                                'readonly' => true,
                                'value' => $terceiro));
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