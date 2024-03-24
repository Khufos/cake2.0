<?php
//echo $this->Html->link(
//        $this->Html->image('icone_grafico/grafico.png', array('escape' => false)), array('controller' => 'trabalhos', 'action' => 'graficoAtividades?trs=1'), array('escape' => false, 'class' => 'thickbox', 'title' => 'Gráfico de atividades')
//);
?>
<table class="table table-bordered table-striped">
    <caption align="top">
        <p align="center">Anexo II</p>
        <p align="center">CRIME E EXECUÇÕES PENAIS</p>
        <p align="center">RELATÓRIO GERAL DE ATIVIDADES DE <?php echo date('Y'); ?></p>
        <p align="center">INCICADRES ESPECIAIS DE RESULTADOS</p>
    </caption>
    <thead>
        <tr class="gridTitulo gridTituloBorda">
            <th rowspan="2"  scope="col"><span >Atividades</span></th>
            <th colspan="6"  scope="col"><span >Semestre</span></th>
            <th rowspan="2"  scope="col"><span >Total</span></th>
            <th colspan="6"  scope="col"><span >Semestre</span></th>
            <th  scope="col" rowspan="2"><span >Total</span></th>
            <th rowspan="2"  scope="col"><span >TOTAL ANO</span></th>
        </tr>
        <tr class="gridTitulo gridTituloBorda">
            <th ><span >JAN</span></th>
            <th ><span >FEV</span></th>
            <th ><span >MAR</span></th>
            <th ><span >ABR</span></th>
            <th ><span >MAI</span></th>
            <th ><span >JUN</span></th>
            <th ><span >JUL</span></th>
            <th ><span >AGO</span></th>
            <th ><span >SET</span></th>
            <th ><span >OUT</span></th>
            <th ><span >NOV</span></th>
            <th ><span >DEZ</span></th>
            <th >&nbsp;</td>        </tr>
    </thead>
    <tbody class="zebra">            
        <?php
        $tot_janeiro = 0;
        $tot_fevereiro = 0;
        $tot_marco = 0;
        $tot_abril = 0;
        $tot_maio = 0;
        $tot_junho = 0;
        $tot_julho = 0;
        $tot_agosto = 0;
        $tot_setembro = 0;
        $tot_outubro = 0;
        $tot_novembro = 0;
        $tot_dezembro = 0;
        $tot_semestre_1 = 0;
        $tot_semestre_2 = 0;
        $tot_ano_geral = 0;
        $i = 0;
        $chart1 = array();
        $chart2 = array();
        foreach ($atividades as $key => $value) {
            $especializada_tipo_atividade_id = key($value);
            $value = $value[key($value)];
            $qtd_semestre = 0;
            $qtd_semestre_2 = 0;
            $qtd_ano = 0;
            ?>
            <tr align="right" class="gridBordaTd">
                <td><?php echo $key; ?></td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['1'], '0');
                    echo $this->Html->link($value['1'], array('controller' => 'trabalhos', 'action' => "add/1/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre += $value['1'];
                    $tot_janeiro += $value['1'];
                    ?>                </td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['2'], '0');
                    echo $this->Html->link($value['2'], array('controller' => 'trabalhos', 'action' => "add/2/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre += $value['2'];
                    $tot_fevereiro += $value['2'];
                    ?>            </td>
                <td>        
                    <?php
                    $this->Util->setaValorPadrao($value['3'], '0');
                    echo $this->Html->link($value['3'], array('controller' => 'trabalhos', 'action' => "add/3/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre += $value['3'];
                    $tot_marco += $value['3'];
                    ?>            </td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['4'], '0');
                    echo $this->Html->link($value['4'], array('controller' => 'trabalhos', 'action' => "add/4/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre += $value['4'];
                    $tot_abril += $value['4'];
                    ?>            </td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['5'], '0');
                    echo $this->Html->link($value['5'], array('controller' => 'trabalhos', 'action' => "add/5/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre += $value['5'];
                    $tot_maio += $value['5'];
                    ?>            </td>
                <td>        
                    <?php
                    $this->Util->setaValorPadrao($value['6'], '0');
                    echo $this->Html->link($value['6'], array('controller' => 'trabalhos', 'action' => "add/6/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre += $value['6'];
                    $tot_junho += $value['6'];
                    ?>            </td>
                <td>
                    <strong>                        
                        <?php
                        echo $qtd_semestre;
                        $qtd_ano += $qtd_semestre;
                        $tot_semestre_1 += $qtd_semestre;
                        ?>            
                    </strong>
                </td>
                <td>       
                    <?php
                    $this->Util->setaValorPadrao($value['7'], '0');
                    echo $this->Html->link($value['7'], array('controller' => 'trabalhos', 'action' => "add/7/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre_2 += $value['7'];
                    $tot_julho += $value['7'];
                    ?>            </td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['8'], '0');
                    echo $this->Html->link($value['8'], array('controller' => 'trabalhos', 'action' => "add/8/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre_2 += $value['8'];
                    $tot_agosto += $value['8'];
                    ?>            </td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['9'], '0');
                    echo $this->Html->link($value['9'], array('controller' => 'trabalhos', 'action' => "add/9/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre_2 += $value['9'];
                    $tot_setembro += $value['9'];
                    ?>            </td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['10'], '0');
                    echo $this->Html->link($value['10'], array('controller' => 'trabalhos', 'action' => "add/10/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre_2 += $value['10'];
                    $tot_outubro += $value['10'];
                    ?>            </td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['11'], '0');
                    echo $this->Html->link($value['11'], array('controller' => 'trabalhos', 'action' => "add/11/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre_2 += $value['11'];
                    $tot_novembro += $value['11'];
                    ?>            </td>
                <td>
                    <?php
                    $this->Util->setaValorPadrao($value['12'], '0');
                    echo $this->Html->link($value['12'], array('controller' => 'trabalhos', 'action' => "add/12/$especializada_tipo_atividade_id"), array(
                            'class' => 'link-modal',
                            'data-target' => "#modal",
                            'data-toggle' => "modal"));
                    $qtd_semestre_2 += $value['12'];
                    $tot_dezembro += $value['12'];
                    ?>            </td>
                <td>
                    <strong>
                        <?php
                        echo $qtd_semestre_2;
                        $qtd_ano += $qtd_semestre_2;
                        $tot_semestre_2 += $qtd_semestre_2;
                        ?>            
                    </strong>
                </td>
                <td>
                    <strong>
                        <?php
                        $chart1[$key] = $qtd_ano;
                        echo $qtd_ano;
                        $tot_ano_geral += $qtd_ano;
                        ?>               
                    </strong>
                </td>
            </tr>
        <?php } ?>
        <tr align="right">
            <td><span ><b>Total Geral das atividades em <?php echo date('Y'); ?></b></span></td>
            <td><strong><?php
                    echo $tot_janeiro;
                    if ($tot_janeiro > 0)
                        $chart2['Janeiro'] = $tot_janeiro;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_fevereiro;
                    if ($tot_fevereiro > 0)
                        $chart2['Fevereiro'] = $tot_fevereiro;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_marco;
                    if ($tot_marco > 0)
                        $chart2['Março'] = $tot_marco;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_abril;
                    if ($tot_abril > 0)
                        $chart2['Abril'] = $tot_abril;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_maio;
                    if ($tot_maio > 0)
                        $chart2['Maio'] = $tot_maio;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_junho;
                    if ($tot_junho > 0)
                        $chart2['Junho'] = $tot_junho;
                    ?></strong></td>
            <td><strong><?php echo $tot_semestre_1; ?></strong></td>
            <td><strong><?php
                    echo $tot_julho;
                    if ($tot_julho > 0)
                        $chart2['Julho'] = $tot_julho;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_agosto;
                    if ($tot_agosto > 0)
                        $chart2['Agosto'] = $tot_agosto;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_setembro;
                    if ($tot_setembro > 0)
                        $chart2['Setembro'] = $tot_setembro;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_outubro;
                    if ($tot_outubro > 0)
                        $chart2['Outubro'] = $tot_outubro;
                    ?></strong></td>
            <td><strong><?php
                    echo $tot_novembro;
                    if ($tot_novembro > 0)
                        $chart2['Novembro'] = $tot_novembro;
                    ?></strong></td>
            <td><strong><?php
echo $tot_dezembro;
if ($tot_dezembro > 0)
    $chart2['Dezembro'] = $tot_dezembro;
?></strong></td>
            <td><strong><?php echo $tot_semestre_2; ?></strong></td>
            <td><strong><?php echo $tot_ano_geral; ?></strong></td>
        </tr>
    </tbody>
</table>
<br />

<!-- Chart 1 -->
<?php
if (isset($grafico)) {
// Montando o data graph
    $data1 = '[';
    $data2 = '[';
    $temp = array();
    $temp2 = array();
    foreach ($chart1 as $atividade => $qtd) {
        $temp[] = $qtd;
        $temp2[] = "'" . $atividade . "'";
    }
    $temp = implode(',', $temp);
    $data1 .= $temp . ']';
    $data2 .= implode(',', $temp2) . ']';
    ?>
    <div id="chart1"></div>
    <script type="text/javascript">
        $(document).ready(function () {
            var s1 = <?php echo $data1; ?>;
            var ticks = <?php echo $data2; ?>;
            plot1 = $.jqplot('chart1', [s1], {
                seriesDefaults: {
                    renderer: $.jqplot.BarRenderer,
                    pointLabels: {show: true}
                },
                title: {
                    text: 'Total ano x Atividade', // title for the plot,
                    show: true
                },
                axesDefaults: {
                    show: false


                },
                axes: {
                    xaxis: {
                        renderer: $.jqplot.CategoryAxisRenderer,
                        ticks: ticks
                    }
                },
                highlighter: {show: false}
            });
        });
    </script>
    <!-- Chart 6 -->
    <?php
    $data_graph = '[';
    $temp = array();
    foreach ($chart2 as $key => $value) {
        $temp[] = "['" . $key . "'," . $value . ']';
    }
    $data_graph .= implode(',', $temp) . ']';
//FireCake::info($data_graph, "\$data_graph");
    ?>
    <br />
    <br />
    <br />
    <div id="chart6" style="margin-top:20px; margin-left:20px; width:300px; height:200px;" align="center"></div>
    <br />
    <br />
    <br />
    <script type="text/javascript">
        $(document).ready(function () {
            plot6 = $.jqplot('chart6', [<?php echo $data_graph; ?>], {
                seriesDefaults: {
                    renderer: $.jqplot.PieRenderer
                },
                title: {
                    text: 'Total mês x Atividade', // title for the plot,
                    show: true
                },
                legend: {
                    show: true,
                    placement: 'outside',
                    location: 'e',
                    fontSize: '14px',
                    width: '245px'
                }
            });
        });
    </script>
    <?php
} else {
    echo $this->Html->link($this->Html->div('glyphicon glyphicon-signal', '').' Vizualizar Gráfico', array(
        'controller' => 'trabalhos',
        'action' => 'grafico_atividades', $especializada_id, $especializada_tipo_atividade_id,
        '?' => array('trs' => '1')
            )
            , array(
        'target' => "_blank",
        'title' => 'Cadastrar / Editar processo',
        'class' => 'btn btn-default',
        'escape' => false
    ));
}
?>