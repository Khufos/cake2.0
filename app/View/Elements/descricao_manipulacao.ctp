<script type="text/javascript">
    $(document).ready(function (){
        $("AcaoHistoricoTipoDescricao").change(function(){
            // your code here
        });
    });
</script>

<div id="info_aba">
    <ul>
        <li><a href="#informacoes">Informações Adicionais</a></li>
    </ul>
    <sub>
        <a id="removeEdition" class="explicacao" href="javascript: return false;"></a>
    </sub>
    <div id="informacoes">
        <!--<span>
        <?php
        $tD[1] = 'Informação do atendimento';
        $tD[2] = 'Informação Extra';
        $tD[3] = 'Atendiemnto não realizado';
        //echo $this->Form->radio('AcaoHistorico.tipo_descricao', $tD, array('separator' => '&nbsp&nbsp', 'legend' => false));
        ?>
        </span>-->
        <table>
            <!--
            <tr style="display: none;">
                <td>
                    <span class="label_bold direita"> *Justificativa:</span>
                </td>
                <td>
                    <span>
            <?php //echo $this->Form->select('AcaoHistorico.motivo_id', $motivos, null, null, false) ?>
                    </span>
                </td>
            </tr>
            -->
            <tr>
                <td>
                    <span class="esquerda">
                        <?php
                        echo $this->Form->textarea('AcaoHistorico.observacao', array('maxLength' => 1500, 'cols' => 40, 'rows' => 5));
                        echo $this->Form->hidden('AcaoHistorico.id');
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2">

                </td>
            </tr>
        </table>
    </div>
</div>
