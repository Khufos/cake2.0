 function adicionarConjugue2(id, nome) {
        $('#selDadosParte').after("<div class='col-md-12'><div class='row well well-sm'><div class='col-md-3'><div class='form-group'> \n\
                                            <input type = 'hidden' name='data[Parte][" + key + "][pessoa_id]' value='" + id + "'> \n\
                                            <input class='form-control input-sm' type = 'text' size='52' disabled='disabled'  value = '" + nome + "'></div></div><div class='col-md-3'><div class='form-group'> \n\
                                           </div></div><div class='col-md-3'><div class='form-group'> \n\
                                           <input type = 'button' class='remove-btn btn btn-default' value='removerdd'></div></div>\n\
                                        </div></div>");
        
        key = key + 1;
    }
    
//function adicionarConjugue33(id, nome) {
//        $('#selDadosParte').after("<div class='col-md-12'><div class='row well well-sm'><div class='col-md-3'><div class='form-group'> \n\
//                                            <input type = 'hidden' name='data[Parte][" + key + "][pessoa_id]' value='" + id + "'> \n\
//                                            <input class='form-control input-sm' type = 'text' size='52' disabled='disabled'  value = '" + nome + "'></div></div><div class='col-md-3'><div class='form-group'> \n\
//<?php echo $this->params['controller'] == 'idosos' ? 'Grau de Relação:' : 'Grau de Parentesco:'; ?> \n\
//                                            </div></div><div class='col-md-3'><div class='form-group'><select class='grau_parentesco form-control input-sm' name='data[Parte][" + key + "][grau_parentesco]' id='GrauParentesto" + key + "'>\n\
//                                            <option value=''> Selecione </option>\n\
//<?php
//foreach ($optionsGrauParentesco as $chave => $valor) {
//    echo "<option value=" . $chave . "> $valor </option> "
//    ?>\n\
//<?php } ?>\n\
//                                            </select>\n\
//                                           <input type = 'text' class='outro_grau_parentesco' size='20' name='data[Parte][" + key + "][grau_parentesco_outro]'></div></div><div class='col-md-3'><div class='form-group'> \n\
//                                           <input type = 'button' class='remove-btn btn btn-default' value='remover'></div></div>\n\
//                                        </div></div>");
//        $(".outro_grau_parentesco").hide();
//        key = key + 1;
//    }    