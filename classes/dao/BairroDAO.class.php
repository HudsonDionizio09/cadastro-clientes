<?php

require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/UnidadeFederativa.class.php");
require_once(__DIR__ . "/../modelo/Cidade.class.php");
require_once(__DIR__ . "/../modelo/Bairro.class.php");

class BairroDAO {

    private $conexao;

    function __construct() {
        $this->conexao = Conexao::get();
    }

    public function findAll() {
        $sql = "SELECT * FROM tb_bairros LEFT JOIN tb_cidades ON cid_id=cid_id LEFT JOIN tb_ufs ON uf_id=cid_uf_id";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $bairros = array();
        foreach ($rows as $row) {
            $uf = new UnidadeFederativa();
            $uf->setId($row['UF_ID']);
            $uf->setNome($row['UF_NOME']);
            $uf->setSigla($row['UF_SIGLA']);
            $cidade = new Cidade();
            $cidade->setId($row['CID_ID']);
            $cidade->setNome($row['CID_NOME']);
            $cidade->setUnidadeFederativa($uf);
            $bairro = new Bairro();
            $bairro->setId($row['BAI_ID']);
            $bairro->setNome($row['BAI_NOME']);
            $bairro->setCidade($cidade);
            array_push($bairros, $bairro);
        }
        return $bairros;
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

    public function findByCidade(Cidade $cidade) {
        $sql = "SELECT * FROM tb_bairros LEFT JOIN tb_cidades ON cid_id=bai_cid_id LEFT JOIN tb_ufs ON uf_id=cid_uf_id WHERE cid_id=:cid_id";
        $statement = $this->conexao->prepare($sql);
        $cid_id = $cidade->getId();
        $statement->bindParam(':cid_id', $cid_id);
        $statement->execute();
        $rows = $statement->fetchAll();
        $bairros = array();
        foreach ($rows as $row) {
            $uf = new UnidadeFederativa();
            $uf->setId($row['UF_ID']);
            $uf->setNome($row['UF_NOME']);
            $uf->setSigla($row['UF_SIGLA']);
            $cidade = new Cidade();
            $cidade->setId($row['CID_ID']);
            $cidade->setNome($row['CID_NOME']);
            $cidade->setUnidadeFederativa($uf);
            $bairro = new Bairro();
            $bairro->setId($row['BAI_ID']);
            $bairro->setNome($row['BAI_NOME']);
            $bairro->setCidade($cidade);
            array_push($bairros, $bairro);
        }
        return $bairros;
    }

}
