<?php

require_once(__DIR__ ."/./Conexao.class.php");
require_once(__DIR__ ."/../modelo/Sexo.class.php");

class SexoDAO {


    public function findAll(){
        
        $sql = "SELECT * FROM tb_sexos";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $sexos = array();
        foreach ($result as $row) {
            $sexo = new Sexo();
            $sexo->setId($row['sex_id']);
            $sexo->setNome($row['sex_nome']);
            $sexo->setSigla($row['sex_sigla']);
            array_push($sexos, $sexo);
        }
        return $sexos;
    }

    public function findById($id){

        $sql = "SELECT * FROM tb_sexos WHERE sex_id = $id";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $row = $statement->fetch();
        $sexo = new Sexo();
        $sexo->setId($row['sex_id']);
        $sexo->setNome($row['sex_nome']);
        $sexo->setSigla($row['sex_sigla']);
        return $sexo;
    }
}