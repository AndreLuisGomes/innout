<?php

// Define uma classe base chamada Model
class Model {

    // Nome da tabela que será usada no banco (substituído pelas classes filhas)
    protected static $tablename = '';

    // Lista de colunas da tabela (normalmente definida nas classes filhas)
    protected static $columns = [];

    // Armazena dinamicamente os valores dos atributos do objeto
    protected $values = [];

    // Construtor que recebe um array associativo e carrega os dados no objeto
    function __construct($arr) {
        $this->loadFromArray($arr);
    }

    // Método que preenche os valores do objeto a partir de um array
    public function loadFromArray($arr) {
        if ($arr) {
            foreach ($arr as $key => $value) {
                // Aqui está o truque: ele chama o __set dinamicamente
                $this->$key = $value;
            }
        }
    }

    // Getter mágico: é chamado automaticamente ao tentar acessar uma propriedade inexistente diretamente
    public function __get($key) {
        return $this->values[$key];
    }

    // Setter mágico: é chamado automaticamente ao tentar definir uma propriedade inexistente diretamente
    public function __set($key, $value) {
        $this->values[$key] = $value;
    }

    public static function getSelect( $filters = [], $columns = '*'){
        $sql = 'SELECT ${columns} FROM ' . static::tablename;
        return $sql;
    }
    
    private static function getFilters($filters){

    }

}
