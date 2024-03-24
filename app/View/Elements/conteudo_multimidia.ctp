<script type="text/javascript">
    $(document).ready(function () {
        $("#loading").ajaxStart(function () {
            $(this).show();
        });
        //Title para os radios
        $("#FilaPainelPlaylistsLocalVideo0").next().attr('title', 'Caso o vídeo esteja na internet (link).');
        $("#FilaPainelPlaylistsLocalVideo0").attr('title', 'Caso o vídeo esteja na internet (link).');
        $("#FilaPainelPlaylistsLocalVideo1").next().attr('title', 'Caso o vídeo esteja em seu computador.');
        $("#FilaPainelPlaylistsLocalVideo1").attr('title', 'Caso o vídeo esteja em seu computador.');

        //Adciona novo conteudo fazendo apend em outra div e modificando os nomes do fields dinamicamente.
        $('#linkAddConteudo').click(function () {
            var qtdTablesDiv = $('#contentConteudo table').length;
            var tblProx = qtdTablesDiv + 1;
            $("#conteudo").attr('id', "conteudo" + tblProx);
            $('#contentConteudo').append($('#contentNovoConteudo').html());
            $('#conteudo' + qtdTablesDiv).nextAll().attr('id', "conteudo" + tblProx);
            $("#FilaPainelPlaylistsTipoConteudo").attr('id', "FilaPainelPlaylists" + tblProx + "TipoConteudo").attr('name', "data[FilaPainelPlaylists][" + tblProx + "][tipo_conteudo]");
            $("#FilaPainelPlaylistsDescricaoImagem").attr('id', "FilaPainelPlaylists" + tblProx + "DescricaoImagem").attr('name', "data[FilaPainelPlaylists][" + tblProx + "][descricao_imagem]");
            $("#FilaPainelPlaylistsDescricaoVideo").attr('id', "FilaPainelPlaylists" + tblProx + "DescricaoVideo").attr('name', "data[FilaPainelPlaylists][" + tblProx + "][descricao_video]");
            $("#FilaPainelPlaylistsArquivoImagem").attr('id', "FilaPainelPlaylists" + tblProx + "ArquivoImagem").attr('name', "data[FilaPainelPlaylists][" + tblProx + "][arquivo_imagem]");
            $("#FilaPainelPlaylistsArquivoVideo").attr('id', "FilaPainelPlaylists" + tblProx + "ArquivoVideo").attr('name', "data[FilaPainelPlaylists][" + tblProx + "][arquivo_video]");

        });
        //Remove conteúdo
        $('body').on('click', '#linkExcluiConteudo', function () {
            $(this).parent('span').parent('td').parent('tr').parent('tbody').parent('table').remove();
        });
        //Mostra os campos referentes ao tipo de conteúdos imagem ou vídeo
        $('body').on('change', '.tipo-conteudo', function () {
            var selecao = $('.tipo-conteudo').val();
            if (selecao === 'I') {
                $(this).parent('td').parent('tr').next().show();
                $(this).parent('td').parent('tr').next().next().hide();
            } else if (selecao === 'V') {
                $(this).parent('td').parent('tr').next().next().show();
                $(this).parent('td').parent('tr').next().hide();
            }
        });
        //Validação do arquivo selecionado
        $('body').on('change', '*:file', function () {
            //Validação da extensão do arquivo
            var arquivo = $(this).val();
            var tipo = $(this).attr('class');
            var res = comprovaExtensao(arquivo, tipo);
            if (!res) {
                alert('Arquivo selecionado não é válido. Selecione um permitido!');
                $(this).attr('value', null);
            }
            //Validação do tamanho do arquivo
            if (tipo === 'file-imagem') {
                size = 2097; //2M 
            } else if (tipo === 'file-video') {
                size = 25600; //25M
            }
            var id = $(this).attr('id');
            var upload = document.getElementById(id);
            var tamanho = (upload.files[0].size) / 1024;
            if (tamanho > size) {
                alert('Arquivo ultrapassa o tamanho permitido. Selecione um arquivo com tamanho válido!');
                $(this).attr('value', null);
            }
        });
        //Exclui conteúdo logicamente e fisicamente
        $('body').on('click', '.exluirConteudo', function () {
            var id = $(this).attr('id');
            if (confirm('Deseja realmente excluir o conteúdo?')){
                excluiConteudoPlaylist(id);
            }
        });
    });

    function excluiConteudoPlaylist(id) {
        $.ajax({
            url: "<?php echo $this->webroot; ?>fila/fila_paineis/excluiConteudoPlaylist/" + id + '?trs=1',
            success: function () {
                $('#loading').fadeOut();
                $("#" + id).parent('td').parent('tr').remove();
            }
        });
    }
    function comprovaExtensao(arquivo, tipo) {
        if (tipo === 'file-imagem') {
            extensoes_permitidas = new Array(".jpg", ".jpeg", ".png");
        } else if (tipo === 'file-video') {
            extensoes_permitidas = new Array(".mp4");
        }
        extensao = (arquivo.substring(arquivo.lastIndexOf("."))).toLowerCase();
        permitida = false;
        for (var i = 0; i < extensoes_permitidas.length; i++) {
            if (extensoes_permitidas[i] == extensao) {
                permitida = true;
                break;
            }
        }
        if (!permitida) {
            return 0;
        } else {
            return 1;
        }
    }

</script>
<div id="playlist">
    <?php if (!empty($playlist)) {
        ?>
        <table class="table-bordered table table-striped">
            <thead>
                <tr>
                    <th align="center" width="100px">Tipo conteúdo</th>
                    <th align="center">Descrição</th>
                    <th align="center">Pré-visualização</th>
                    <th align="center" width="60px">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Playlist salva
                foreach ($playlist as $key => $value) {
                    ?>
                    <tr>
                        <td align="center"><?php echo $value['FilaPainelPlaylists']['tipo_conteudo'] == 'I' ? 'IMAGEM' : 'VIDEO'; ?></td>
                        <?php if ($value['FilaPainelPlaylists']['tipo_conteudo'] == 'I') { ?>
                            <td align="center"><?php echo $this->Util->setaValorPadrao($value['FilaPainelPlaylists']['descricao'], "--"); ?></td>
                            <td align="center"><?php echo $this->Html->image("/" . $value['FilaPainelPlaylists']['caminho_fisico'], array('style' => 'max-width:150px'), false, false, '200px', false); ?></td>
                        <?php } else if ($value['FilaPainelPlaylists']['tipo_conteudo'] == 'V') {
                            ?>                          
                            <td align="center"><?php echo $this->Util->setaValorPadrao($value['FilaPainelPlaylists']['descricao'], "--"); ?></td>
                            <td align="center"><?php echo $this->Html->link($this->Html->image('knob/Play Green.png'), "/" . $value['FilaPainelPlaylists']['caminho_fisico'], array('target' => '_blank', 'escape' => false)); ?></td>  
                            <?php
                        }
                        ?>
                        <td align="center">                                
                            <?php echo $this->Html->image('knob/error.png', array('id' => $value['FilaPainelPlaylists']['id'], 'class' => 'exluirConteudo', 'escape' => false)); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php }  # Novo Conteúdo para Playlist  ?>
    <span class="label_bold">
        <?php echo $this->Html->link('[+]', 'javascript:void(0);', array('id' => 'linkAddConteudo', 'title' => 'Adicionar Conteúdo')); ?>


        <div id="contentConteudo"></div>
        <div id="contentNovoConteudo" style="display: none;">
            <table id="conteudo" class="cabecalhoRel borda_fina" border="0" style="margin-bottom: 5px; max-width: 100%;">
                <tr>
                    <td><span class="label_bold direita">Conteúdo:</td>
                    <td colspan="3">
                        <?php
                        $options = array('I' => 'Imagem', 'V' => 'Vídeo');
                        $args = array(
                            'class' => 'validate[required] tipo-conteudo',
                            'name' => 'data[FilaPainelPlaylists][0][tipo_conteudo]',
                            'empty' => 'Selecione'
                        );
                        echo $this->Form->select("FilaPainelPlaylists.tipo_conteudo", $options, $args);
                        ?>
                    </td>
                </tr>
                <tr class="imagem" style="display: none;">
                    <td><span class="label direita">Descrição:</td>
                    <td><?php echo $this->Form->input("FilaPainelPlaylists.descricao_imagem", array("size" => 50, "maxlength" => 200, "label" => false, 'name' => 'data[FilaPainelPlaylists][0][descricao_imagem]')); ?></td>
                    <td><?php echo $this->Form->file("FilaPainelPlaylists.arquivo_imagem", array("size" => 15, 'style' => "max-width: 330px;", 'class' => 'file-imagem', 'name' => 'data[FilaPainelPlaylists][0][arquivo_imagem]')); ?>
                        <span class="label_bold esquerda">Arquivos permitidos: .jpg/.jpeg /.png <span style="color: red; font-size: 10px" >("Tamanho máximo 2MB")
                                </td>               
                                </tr>
                                <tr class="video" style="display: none;">
                                    <td><span class="label direita">Descrição:</td>
                                    <td><?php echo $this->Form->input("FilaPainelPlaylists.descricao_video", array("size" => 50, "maxlength" => 200, "label" => false, 'name' => 'data[FilaPainelPlaylists][0][descricao_video]')); ?></td>
                                    <td class="esquerda"><?php echo $this->Form->file("FilaPainelPlaylists.arquivo_video", array("size" => 15, 'class' => 'file-video', 'name' => 'data[FilaPainelPlaylists][0][arquivo_video]')); ?>
                                        <span class="label_bold direita">Arquivos permitidos: .mp4 <span style="color: red; font-size: 10px" >("Tamanho máximo 25MB")
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label_bold">
                                                            <?php
                                                            echo $this->Html->link('[-]', 'javascript:void(0);', array('style' => 'color: red;', 'id' => 'linkExcluiConteudo', 'title' => 'Remover Conteúdo'));
                                                            ?>


                                                    </td>
                                                </tr>
                                                </table>
                                                </div>
                                                </div>
                                                <div id="resPlaylist"></div>