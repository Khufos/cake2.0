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
    
    public function add($id = null) {
        $id = $this->request->data('id');
        exit($id);
    }
    
    public function recive($id = null) {
        $id = $this->request->data;
        pr($id);
        die();

        
    }

    public function addVitima($id = null) {
        pr($id);
        die();
        $assistido_id = $_POST['assistido_id'];
    }
}