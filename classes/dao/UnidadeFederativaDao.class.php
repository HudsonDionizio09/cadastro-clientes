<?php

require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__. "/../modelo/UnidadeFederativa.class.php");

class UnidadeFederativaDAO {
        
    private $conexao;
    
    function __construct() {
        $this->conexao = Conexao::get();
    }
    
    public function findAll() {
        $sql = "SELECT * FROM tb_ufs";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $ufs = array();
        foreach ($rows as $row) {
            $uf = new UnidadeFederativa();
            $uf->setId($row['UF_ID']);
            $uf->setNome($row['UF_NOME']);
            $uf->setSigla($row['UF_SIGLA']);
            array_push($ufs, $uf);
        }
        return $ufs;
    }

    public function findById($id) {
        $sql = "SELECT * FROM tb_ufs WHERE uf_id=:id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $row = $statement->fetch();
        $uf = new UnidadeFederativa();
        $uf->setId($row['UF_ID']);
        $uf->setNome($row['UF_NOME']);
        $uf->setSigla($row['UF_SIGLA']);
        return $uf;
    }
}