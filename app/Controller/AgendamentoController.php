<?php
class AgendamentoController extends AppController{

    function altera_situacao_agendamento_ausente(){
        $this->autoRender = false;
        if (isset($this->data['funcionarioID']) && isset($this->data['agendamentoID'])) {
            $funcionarioID = $this->data['funcionarioID'];
            $agendamentoID = $this->data['agendamentoID'];
            var_dump(  $funcionarioID);
            die();
            
          
        } 
    }




}




?>