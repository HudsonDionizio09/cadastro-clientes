<?php

class Sexo {

    private $id;
    private $nome;
    private $sigla;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getSigla(){
        return $this->sigla;
    }

    public function setSigla($sigla){
        $this->sigla = $sigla;
    }
}