<?php
App::uses('AppController', 'Controller');

class FilmesController extends AppController {
   
    public function index() {
        $fields = array('Filme.id','Filme.nome','Filme.ano','Filme.duracao','Filme.idioma','Filme.genero_id','dataRetificadaI','dataRetificadaF');
        $order = array('Filme.nome' => 'asc');
        $conditions = array();
        
        $filmes = $this->Filme->find('all', array(
            'fields' => $fields,
            'order' => $order,
            'conditions' => $conditions,
            'recursive' => -1
        ));
        $this->set(compact('filmes'));
    }
    
    public function add() {
        $this->autoRender = false;
        var_dump($this->request->data);
        die();
    
    }
    public function recive() {
        $this->autoRender = false;
        if (isset($this->data['IdDefensor']) && isset($this->data['dataInicio']) && isset($this->data['dataFim'])) {
            $IdDefensor= $this->data['IdDefensor'];
            $DataRetificadaInicio = $this->data['dataInicio'];
            $DataRetificadaFim = $this->data['dataFim'];
            var_dump($IdDefensor);
            
          
        } 

        
    }

    public function addVitima($id = null) {
        pr($id);
        die();
        $assistido_id = $_POST['assistido_id'];
    }
}