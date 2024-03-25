<?php

class Filme extends AppModel {
    
    public $belongsTo = array(
        'Genero'
    );

    // Relacionamentos que estão atualmente comentados
    public $hasMany = array(
        'Critica'
    );

    public $hasAndBelongsToMany = array(
        'Ator'
    );

    // Regras de validação para os campos nome e duracao
    public $validate = array(
        'nome' => array(
            'rule' => 'notBlank',
            'message' => 'Informe o nome, por favor'
        ),
        'duracao' => array(
            'rule' => 'notBlank',
            'message' => 'Informe a duração, por favor'
        )
    );

   
    
        public function updateFilmeByIdAndDataRetificada($id, $dataRetificadaI, $dataRetificadaF, $dataToUpdate) {
            // Condições para encontrar o filme a ser atualizado
            $conditions = array(
                'Filme.id' => $id,
                'Filme.dataRetificadaI' => $dataRetificadaI,
                'Filme.dataRetificadaF' => $dataRetificadaF
            );
    
            // Atualiza os dados do filme
            // O primeiro parâmetro é um array com os campos a serem atualizados e seus novos valores
            // O segundo parâmetro é um array com as condições para a atualização
            return $this->updateAll(
                $dataToUpdate,
                $conditions
            );
        }
    }
    





?>