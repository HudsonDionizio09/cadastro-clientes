<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Sexo.class.php");
require_once(__DIR__ . "/../modelo/Bairro.class.php");
require_once(__DIR__ . "/../modelo/Cidade.class.php");
require_once(__DIR__ . "/../modelo/UnidadeFederativa.class.php");
class ClienteDAO {
    
    private $conexao;
    function __construct() {
        $this->conexao = Conexao::get();
    }
    private function insert(Cliente $cliente) {

        try {


            $statement = $this->conexao->prepare("INSERT INTO tb_clientes (CLI_NOME, CLI_SOBRENOME, CLI_DATA, CLI_CPF, CLI_SEX_ID, 
        CLI_CEP, CLI_LOGRADOURO, CLI_OBSERVACOES, CLI_BAI_ID, CLI_EMAIL)  
                            
        VALUES (:nome, :sobrenome, :nascimento, :cpf, :sexo, 
                 :cep, :logradouro, :observacoes, :bairro, 
                :email)");
            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':sobrenome', $sobrenome);
            $statement->bindParam(':nascimento', $nascimento);
            $statement->bindParam(':cpf', $cpf);
            $statement->bindParam(':sexo', $sexo);
            $statement->bindParam(':cep', $cep);
            $statement->bindParam(':logradouro', $logradouro);
            $statement->bindParam(':observacoes', $observacoes);
            $statement->bindParam(':bairro', $bairro);
            $statement->bindParam(':email', $email);

            $nome = $cliente->getNome();
            $sobrenome = $cliente->getSobrenome();
            $nascimento = $cliente->getData();
            $cpf = $cliente->getCpf();
            $sexo = $cliente->getSexo();
            $cep = $cliente->getCep();
            $logradouro = $cliente->getLogradouro();
            $observacoes = $cliente->getObservacao();
            $bairro = $cliente->getBairro();
            $email = $cliente->getEmail();
            
            $statement->execute();
            return $this->findById($this->conexao->lastInsertId());
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function update(Cliente $cliente) {
        $sql = "UPDATE tb_clientes 
                SET CLI_NOME=:nome, CLI_SOBRENOME=:sobrenome,
                    CLI_DATA=:nascimento, CLI_CPF=:cpf,
                    CLI_SEX_ID=:sexo, CLI_CEP=:cep,
                    CLI_LOGRADOURO=:logradouro, CLI_OBSERVACOES=:observacoes,
                    CLI_BAI_ID=:bairro, CLI_EMAIL=:email
                WHERE CLI_ID=:ID";
        try {
            $statement = $this->conexao->prepare($sql);
            $nome = $cliente->getNome();
            $sobrenome = $cliente->getSobrenome();
            $nascimento = $cliente->getData();
            $cpf = $cliente->getCpf();
            $sexo = $cliente->getSexo();
            $cep = $cliente->getCep();
            $logradouro = $cliente->getLogradouro();
            $observacoes = $cliente->getObservacao();
            $bairro = $cliente->getBairro();
            $email = $cliente->getEmail();
            $id = $cliente->getId();

            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':sobrenome', $sobrenome);
            $statement->bindParam(':nascimento', $nascimento);
            $statement->bindParam(':cpf', $cpf);
           $statement->bindParam(':sexo', $sexo);
            $statement->bindParam(':cep', $cep);
            $statement->bindParam(':logradouro', $logradouro);
            $statement->bindParam(':observacoes', $observacoes);
            $statement->bindParam(':bairro', $bairro);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':id', $id);

            $statement->execute();
            return $this->findById($id);
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    
    public function save(Cliente $cliente) {
        echo $cliente->getId();
        if (empty($cliente->getId())) {
            return $this->insert($cliente);
        } else {
            return $this->update($cliente);
        }
    }

    public function remove($id) {
        $sql = "DELETE FROM tb_clientes WHERE CLI_ID=:ID";
        try {
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findAll() {
        $sql = "SELECT * FROM tb_clientes 
        JOIN tb_sexos ON SEX_ID=CLI_SEX_ID 
        JOIN tb_bairros ON BAI_ID=CLI_BAI_ID
        LEFT JOIN tb_cidades ON CID_ID=BAI_CID_ID 
        LEFT JOIN tb_ufs ON UF_ID=CID_UF_ID";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $clientes = array();
        foreach ($rows as $row) {

            $uf = new UnidadeFederativa();
            $uf->setId($row['UF_ID']);
            $uf->setNome($row['UF_NOME']);
            $uf->setSigla($row['UF_SIGLA']);
            
            $cidade = new Cidade();
            $cidade->setId($row['CID_ID']);
            $cidade->setNome($row['CID_NOME']);
            
            $bairro = new Bairro();
            $bairro->setId($row['BAI_ID']);
            $bairro->setNome($row['BAI_NOME']);
            
            $sexo = new Sexo();
            $sexo->setId($row['SEX_ID']);
            $sexo->setSigla($row['SEX_SIGLA']);
            
            $cliente = new Cliente();
            $cliente->setId($row['CLI_ID']);
            $cliente->setNome($row['CLI_NOME']);
            $cliente->setSobrenome($row['CLI_SOBRENOME']);
            $cliente->setData($row['CLI_DATA']);
            $cliente->setSexo($sexo);
            $cliente->setBairro($bairro);
            $cliente->setCidade($cidade);
            $cliente->setUnidadeFederativa($uf);

            array_push($clientes, $cliente);
        }
        return $clientes;
    }

    public function findById($id) {
        $sql = "SELECT * FROM tb_clientes WHERE CLI_ID=:ID";
        $statement = $this->conexao->prepare($sql);
        $statement->bindParam(':ID', $id);
        $statement->execute();
        $row = $statement->fetch();
        $cliente = new Cliente();
        $cliente->setId($row['CLI_ID']);
        $cliente->setNome($row['CLI_NOME']);
        $cliente->setSobrenome($row['CLI_SOBRENOME']);
        $cliente->setData($row['CLI_DATA']);
        $cliente->setCpf($row['CLI_CPF']);
        $cliente->setSexo($row['CLI_SEX_ID']);
        $cliente->setCep($row['CLI_CEP']);
        $cliente->setLogradouro($row['CLI_LOGRADOURO']);
        $cliente->setObservacao($row['CLI_OBSERVACOES']);
        $cliente->setBairro($row['CLI_BAI_ID']);
        $cliente->setEmail($row['CLI_EMAIL']);
        return $cliente;
    }
}