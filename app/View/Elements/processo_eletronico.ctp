<?php 
    // está acontecendo um erro ao carregar o web service
?>

<fieldset>
    <legend>Tribunal de Justiça</legend>
    <div id="tj">			
        <?=
        $this->Html->link('Ajuizar ação', array(
            'controller' => 'processos',
            'action' => 'ajuizar/Familia/' . $idFamilia,
            '?' => array('trs' => '1')), 
                array(
                    'class' => 'link-modal btn btn-default',
                    'title' => 'TJBA - Ajuizamento',
                    'data-target' => "#modal",
                    'data-toggle' => "modal"
                    )
                );
        ?>
    </div>
</fieldset>