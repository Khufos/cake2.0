<cake:nocache>
    <?php
# expandir o módulo selecionado
    if (!isset($idModulo)) {
        $idModulo = 0;
    }
    $menuMobile = $this->Session->read('menuMobile');
    ?>
    <?php
    if (!empty($menuMobile)) {
        echo $menuMobile;
    }
    ?>   
</cake:nocache>
