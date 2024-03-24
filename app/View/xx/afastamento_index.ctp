<script type="text/javascript">
    $(function(){
        $('#atuacao tr').click(function(event) {
            if (event.target.type !== 'checkbox') {
                $(':checkbox', this).trigger('click');
            }
        });
    });
</script>

<style type="text/css">
    .bg-primary {
        color: #fff;
        background-color: #419641;
    }
    .table {
        margin-bottom: 0px;
        background: #fff;
    }
    .table-bordered {
        border: 0px;
    }
    .tamanho{
        max-height: 55vh;

        padding: 20px 0px;
    }
    .botao {
        text-align: right;
        padding-top: 15px;
        margin-right: 15px;
    }
    .form-group {
        margin-top: 10px;
    }
    .main .page-header {
        display: none;
    }
    .page-header.lor {
        display: block
    }
    ul li span {
        border: 1px solid #ddd;
        background-color: #e3e3e3 !important;
        font-weight: bold;
    
    }
</style>

<?= $this->Form->create(false, array('controller' => 'Corregedoria', 'action' => 'afastamento_index')); ?>
    <?php
    $Afastamento_id = isset($afastamento['Afastamento']['id']) ? $afastamento['Afastamento']['id'] : 0;
    ?>
    <input type="hidden" id="btnHidden" name="id_afastamento" value="<?= $Afastamento_id ?>">

    <h3 class="page-header lor">ÁREA DE AFASTAMENTO</h3>
    <div class="well">
        <div class="tamanho">
            <div class="row">


                <div class="form-group">
                    <div class="col-sm-4">
                        <label class="control-label">
                            Nome do Defensor
                        </label>
                        <?php
                        $tipo_Afastamento_id = isset($afastamento['Afastamento']['tipo_afastamento_id']) ? $afastamento['Afastamento']['tipo_afastamento_id'] : false;
                        $args = array(
                            'default' => $tipo_Afastamento_id,
                            'class' => 'Trecho validate[required] form-control input-sm',
                            'empty' => 'Selecione',
                        );
                        echo $this->Form->select('funcionarios_id',$funcionarios, $args);
                        ?>
                                
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-sm-4">
                        <label class="control-label">
                            Comarca:
                        </label>
                        <?php
                        $tipo_Afastamento_id = isset($afastamento['Afastamento']['tipo_afastamento_id']) ? $afastamento['Afastamento']['tipo_afastamento_id'] : false;
                        $args = array(
                            'default' => $tipo_Afastamento_id,
                            'class' => 'Trecho validate[required] form-control input-sm',
                            'empty' => 'Selecione',
                        );
                        echo $this->Form->select('comarca_id',$comarcas, $args);

                        ?>
                                
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-sm-4">
                        <label class="control-label">
                            Motivo do afastamento:
                        </label>
                        <?php
                        $tipo_Afastamento_id = isset($afastamento['Afastamento']['tipo_afastamento_id']) ? $afastamento['Afastamento']['tipo_afastamento_id'] : false;
                        $args = array(
                            'default' => $tipo_Afastamento_id,
                            'class' => 'Trecho validate[required] form-control input-sm',
                            'empty' => 'Selecione',
                        );
                        echo $this->Form->select('tipo_afastamento_id',$tipo_Afastamento, $args);
                        ?>
                                
                    </div>
                </div> 

            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-4">
                    <?php
                     $data_inicio = isset($afastamento['Afastamento']['data_inicio']) ? $afastamento['Afastamento']['data_inicio'] : null;
                    ?>

                        <label class="control-label"> Data Inicio:</label>
                        <?php echo $this->Form->text('data_inicio', array('class' => 'data form-control input-sm')); ?>
                       
                    </div>

                    <div class="col-sm-4">

                    <?php
                     $data_fim = isset($afastamento['Afastamento']['data_fim']) ? $afastamento['Afastamento']['data_fim'] : null;
                    ?>
                        <label class="control-label">Data Fim:</label>
                        <?php echo $this->Form->text('data_fim', array('class' => 'data form-control input-sm')); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="botao">
                <button id="limparDocumento" onclick="clearForm()"  class="btn btn-default">Limpar</button>
                    <?= $this->Form->button(__('Pesquisar'),[
                        'class' => 'btn btn-primary'
                        ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="bg-primary">
                        <th>Nome do Defensor</th>
                        <th>Comarca</th>
                        <th class="text-center">DATA INICIO</th>
                        <th class="text-center">DATA FIM</th>
                        <th>MOTIVO DO AFASTAMENTO</th>
                    </tr>
                </thead>

                <tbody>
                <?php   ?>
                    <?php foreach ($listaDeAfastamento as $afastamento): ?>
                        <tr>
                            <td><?= $afastamento['pe']['nome'] ?></td>
                            <td><?= $afastamento['c']['nome'] ?></td>

                            <td class="text-center"><?= date("d-m-Y", strtotime($afastamento['Afastamento']['data_inicio']));?></td>
                            <td class="text-center"><?= date("d-m-Y", strtotime($afastamento['Afastamento']['data_fim']));?></td>
                            <td>
                                <?= $afastamento['ta']['nome'] ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                        <?php
                            // In your view (index.ctp)
                            $prevPage1 = $currentPage1 > 1 ? $currentPage1 - 1 : 1;
                            $nextPage1 = $currentPage1 < $totalPages1 ? $currentPage1 + 1 : $totalPages1;

                            $sfunc_id='x';
                            $scom_id='x';
                            $stipo_id='x';
                            $sdt_i='x';
                            $sdt_f='x';

                            if(isset($this->request->data['funcionarios_id'])){
                                $sfunc_id = $this->request->data['funcionarios_id'];
                            }

                            if (isset($this->request->data['comarca_id'])) {
                                $scom_id = $this->request->data['comarca_id'];
                            }
                            
                            if (isset($this->request->data['tipo_afastamento_id'])) {
                                $stipo_id = $this->request->data['tipo_afastamento_id'];
                            }
                            
                            if (isset($this->request->data['data_inicio'])) {
                                $sdt_i = $this->request->data['data_inicio'];
                            }
                            
                            if (isset($this->request->data['data_fim'])) {
                                $sdt_f = $this->request->data['data_fim'];
                            }

                        ?>
 
                        <tr class="classOcultar">
                            <td id="paginAviso2" colspan="7" style="vertical-align: middle;">
                                <ul id="btn_navegacao2" class="pagination" style="margin: 0px;">
                                    <li id="btnprev2">
                                        <?= '<a href="?md=9&f_id='.$sfunc_id.'&com_id='.$scom_id.'&tipo_id='.$stipo_id.'&sdt_i='.$sdt_i.'&sdt_f='.$sdt_f.'&page1=' . $prevPage1 . '">«</a>' ?>
                                    </li>
                                    <li id="btnnumbers">
                                        <?php
                                        $range = 3; // Adjust the range as needed
                        
                                        // Display the first page
                                        if ($currentPage1 > $range + 1) {
                                            echo '<a href="?md=9&f_id='.$sfunc_id.'&com_id='.$scom_id.'&tipo_id='.$stipo_id.'&sdt_i='.$sdt_i.'&sdt_f='.$sdt_f.'&page1=1">1</a>';
                                            if ($currentPage1 > $range + 2) {
                                                echo '<span>...</span>';
                                            }
                                        }
                        
                                        // Display the pages within the range
                                        for ($x = max(1, $currentPage1 - $range); $x <= min($totalPages1 , $currentPage1 + $range); $x++) {
                                            if ($x == $currentPage1) {
                                                echo '<span>' . $x . '</span>';
                                            } else {
                                                echo '<a href="?md=9&f_id='.$sfunc_id.'&com_id='.$scom_id.'&tipo_id='.$stipo_id.'&sdt_i='.$sdt_i.'&sdt_f='.$sdt_f.'&page1=' . $x . '">' . $x . '</a>';
                                            }
                                        }
                        
                                        // Display the last page
                                        if ($currentPage1 < $totalPages1 - $range) {
                                            if ($currentPage1 < $totalPages1 - $range - 1) {
                                                echo '<span>...</span>';
                                            }
                                            echo '<a href="?md=9&f_id='.$sfunc_id.'&com_id='.$scom_id.'&tipo_id='.$stipo_id.'&sdt_i='.$sdt_i.'&sdt_f='.$sdt_f.'&page1=' . $totalPages1 . '">' . $totalPages1 . '</a>';
                                        }
                                        ?>
                                    </li>
                                    <li id="btnnext">
                                        <?= '<a href="?md=9&f_id='.$sfunc_id.'&com_id='.$scom_id.'&tipo_id='.$stipo_id.'&sdt_i='.$sdt_i.'&sdt_f='.$sdt_f.'&page1=' . $nextPage1 . '">»</a>' ?>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
    
<?= $this->Form->end() ?>
<script>

var $LimparFiltro = $(".Trecho").select2();
$(document).ready(function() {
    $('#RcEspecializadaFuncionarioEspecializadaId').change(function() {
        var id = $(this).val(); 
        Defensor(id); 
    });
});

function Defensor(id){
    $.ajax({
        url: '/rc_especializada_funcionarios/buscarDefensor/'+id+'?trs=1',
        dataType: 'json',
        type: "GET",
        success: function(data){
            var select = $('#RcEspecializadaFuncionarioFuncionarioId'); 
            select.val('');
            select.find('option:not(:first)').remove();

            if (Object.keys(data).length === 0) {
                select.empty().append($('<option>', {
                    text: 'Vazio', 
                    value: ''
                }));
            } else {
                $.each(data, function(key, value) {
                    select.append($('<option>', {
                        value: key,
                        text: value
                    }));
                });
            }
            select.val(select.find('option:first').val());
        }
    })
}

function clearForm() {
    event.preventDefault();
    // Get all form elements and reset their values
    // Clear form fields
    window.location.href = window.location.href.split('?')[0]; // Clear POST data
}
</script>
