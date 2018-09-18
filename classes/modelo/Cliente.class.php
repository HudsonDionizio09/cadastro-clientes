<?php

require_once(__DIR__ . "/./Sexo.class.php");
require_once(__DIR__ . "/./UnidadeFederativa.class.php");
require_once(__DIR__ . "/./Cidade.class.php");
require_once(__DIR__ . "/./Bairro.class.php");

class Cliente {

    private $id;
    private $nome;
    private $sobrenome;
    private $data;
    private $sexo;
    private $cpf;
    private $cep;
    private $unidadefederativa;
    private $cidade;
    private $bairro;
    private $logradouro;
    private $observacao;
    private $email;

    public function __construct() {
        $this->sexo = new Sexo();
    }

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
        $this->nome = strtoupper($nome);
    }

    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome){
        $this->sobrenome = strtoupper($sobrenome);
    }

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getSexo(){
        return $this->sexo;
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
        $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
        // Valida tamanho
        if (strlen($cpf) != 11)
            return false;
        // Calcula e confere primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Calcula e confere segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
    }

    public function getCep(){
        return $this->cep;
    }

    public function setCep($cep){
        $this->cep = $cep;
    }

    public function getUnidadeFederativa(){
        return $this->unidadefederativa;
    }

    public function setUnidadeFederativa(UnidadeFederativa $unidadefederativa){
        $this->unidadefederativa = $unidadefederativa;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade($cidade){
        $this->cidade = $cidade;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function setBairro($bairro){
        $this->bairro = $bairro;
    }

    public function getLogradouro(){
        return $this->logradouro;
    }

    public function setLogradouro($logradouro){
        $this->logradouro = $logradouro;
    }

    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }
}