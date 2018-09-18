<?php

class UnidadeFederativa{

    private $id;
    private $nome;
    private $sigla;

    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getSigla(){
        return $this->sigla;
    }
    
    public function setId($id){
        $this->id = $id;
    }
   
    public function setNome($nome){
        $this->nome = strtoupper($nome);
    }
    
    public function setSigla($sigla){
        $this->sigla = strtoupper($sigla);
    }
}