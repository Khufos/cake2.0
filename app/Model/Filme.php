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
}

?>