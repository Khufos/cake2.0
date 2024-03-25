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
        $this->autoRender = false; // Desabilita a renderização de uma view.
        
        // Verifica se os dados necessários estão presentes.
        if (isset($this->request->data['IdDefensor']) && isset($this->request->data['dataInicio']) && isset($this->request->data['dataFim'])) {
            $IdDefensor = $this->request->data['IdDefensor'];
            $DataRetificadaInicio = $this->request->data['dataInicio'];
            $DataRetificadaFim = $this->request->data['dataFim'];
    
            // Carrega o modelo necessário.
            $this->loadModel('Filme');
            
            // Chama a função do modelo e passa os dados.
            $result = $this->Filme->alterandoDataRetificada($IdDefensor, $DataRetificadaInicio, $DataRetificadaFim);
    
            // Exemplo de como retornar uma resposta JSON
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Falha ao atualizar os dados.']);
            }
        } else {
            // Resposta caso algum dado esteja faltando.
            echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
        }
    }
    public function addVitima($id = null) {
        pr($id);
        die();
        $assistido_id = $_POST['assistido_id'];
    }
}