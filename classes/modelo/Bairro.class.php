<?php

require_once(__DIR__ . "/./Cidade.class.php");

class Bairro {

    private $id;
    private $nome;
    private $cidade;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = strtoupper($nome);
    }

    public function setCidade(Cidade $cidade) {
        $this->cidade = $cidade;
    }

}
