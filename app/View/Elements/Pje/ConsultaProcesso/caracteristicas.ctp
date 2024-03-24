<div id="tabCaracteristicas" class="principal pagina-autos scroll-y">
    <div id="PainelCaracteristicas" class="custom-panel">
        <div class="container-fluid rich-panel" id="caracteristicas">
            <div class="header-panel">
                <h5 class="tab-titulo">Características do Processo</h5>
            </div>
            <table class="caracteristicas-tabela" style="width: 100%;">
                <tbody>
                    <tr class="viewColumn">
                        <td colspan="3">
                            <div class="name">
                                <label>Segredo de Justiça?</label>
                            </div>
                            <div class="col-ml-12" style="text-align: left;">
                                <?php echo $sigilo == "0" ? "Não" : "Sim";?>
                            </div>
                        </td>
                        <td colspan="3">
                            <div class="name">
                                <label>Justiça Gratuita?</label>
                            </div>
                            <div class="col-ml-12">
                                <?php echo $justicaGratuita == "0" ? "Não" : "Sim";?>
                            </div>
                        </td>
                        <td colspan="3">
                            <div class="name">
                                <label>Pedido de Liminar/Antecipação de Tutela?</label>
                            </div>
                            <div class="col-ml-12">
                                <?php echo $tutelaLiminar == "0" ? "Não" : "Sim";?>
                            </div>
                        </td>
                        <td colspan="3">
                            <div class="name">
                                <label>Há Dependência?</label>
                            </div>
                            <div class="col-ml-12">
                                <?php echo "Não";?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <div class="container-fluid rich-panel" id="prioridade">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="tab-titulo">Prioridade Processual</h5>
                </div>
            </div>
            <table class="prioridade-tabela" style="width: 100%;">
                <thead>
                    <tr class="viewColumn">
                        <td colspan="3">
                            <div class="name">
                                <label>Prioridade de Processo</label>
                            </div>
                            <div class="col-ml-12" id="prioridadeProcesso">
                                <?php echo $prioridade == null ? "0 resultados encontrados" : str_replace("\n", "<br>", $prioridade); ?>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>