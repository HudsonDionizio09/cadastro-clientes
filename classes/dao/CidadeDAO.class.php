<?php

require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Cidade.class.php");
require_once(__DIR__ . "/../modelo/UnidadeFederativa.class.php");

class CidadeDAO {

    private $conexao;

    function __construct() {
        $this->conexao = Conexao::get();
    }

    public function findAll() {
        $sql = "SELECT * FROM tb_cidades LEFT JOIN tb_ufs ON uf_id=cid_uf_id";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $cidades = array();
        foreach ($rows as $row) {
            $uf = new UnidadeFederativa();
            $uf->setId($row['UF_ID']);
            $uf->setNome($row['UF_NOME']);
            $uf->setSigla($row['UF_SIGLA']);
            $cidade = new Cidade();
            $cidade->setId($row['CID_ID']);
            $cidade->setNome($row['CID_NOME']);
            $cidade->setUnidadeFederativa($uf);
            array_push($cidades, $cidade);
        }
        return $cidades;
    }

    public function findById($id) {
        $sql = "SELECT * FROM tb_cidades LEFT JOIN tb_ufs ON uf_id=cid_uf_id WHERE cid_id=:id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $row = $statement->fetch();
        $uf = new UnidadeFederativa();
        $uf->setId($row['UF_ID']);
        $uf->setNome($row['UF_NOME']);
        $uf->setSigla($row['UF_SIGLA']);
        $cidade = new Cidade();
        $cidade->setId($row['CID_ID']);
        $cidade->setNome($row['CID_NOME']);
        $cidade->setUnidadeFederativa($uf);
        return $cidade;
    }

    public function findByUnidadeFederativa(UnidadeFederativa $uf) {
        $sql = "SELECT * FROM tb_cidades LEFT JOIN tb_ufs ON uf_id=cid_uf_id WHERE uf_id=:uf_id";
        $statement = $this->conexao->prepare($sql);
        $uf_id = $uf->getId();
        $statement->bindParam(':uf_id', $uf_id);
        $statement->execute();
        $rows = $statement->fetchAll();
        $cidades = array();
        foreach ($rows as $row) {
            $uf = new UnidadeFederativa();
            $uf->setId($row['UF_ID']);
            $uf->setNome($row['UF_NOME']);
            $uf->setSigla($row['UF_SIGLA']);
            $cidade = new Cidade();
            $cidade->setId($row['CID_ID']);
            $cidade->setNome($row['CID_NOME']);
            $cidade->setUnidadeFederativa($uf);
            array_push($cidades, $cidade);
        }
        return $cidades;
    }

}
