<?php
/**
 * @param array $assistidos
 * @param int $tipoAssistido
 * @param string $titulo
 * @param string $classeIcone
 */
?>
<table class="table">
    <thead>
        <tr>
            <th>
                <span class="<?php echo $classeIcone ?>"></span>
                <span><?php echo $titulo?></span>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($assistidos as $assistido): ?>
            <?php if($assistido['polo_id'] == $tipoAssistido): ?>
                <tr>
                    <td>
                        <a href="#" id="navbar:j_id127" target="comprovantePeticaoInicial">
                            <span><?php 
                                $assistidoNome = $assistido['nome'];
                                $assistidoDocumento = $assistido['numero_documento_principal'];
                                $assistidoTipoDocumento = $assistido['tipo_pessoa'] == 'juridica'
                                    ? 'CNPJ'
                                    : 'CPF';
                                $classe = strtolower($assistidoTipoDocumento);
                                echo "$assistidoNome - $assistidoTipoDocumento: <span class='$classe'>$assistidoDocumento</span>";
                            ?></span>
                        </a>
                        <?php if(isset($assistido['advogado_nome']) && !is_null($assistido['advogado_nome'])): ?>
                        <ul class="tree">
                            <li>
                                <small class="text-muted">
                                    <i class="fa fa-users mr-10" title="Procuradoria" alt="ícone de grupo"></i>
                                    <span title="Procuradoria" class=""><?php echo $assistido['advogado_nome']; ?></span>
                                </small>
                            </li>
                        </ul>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>