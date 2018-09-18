<?php 
require_once(__DIR__ ."/../classes/modelo/Cliente.class.php");
require_once(__DIR__ ."/../classes/modelo/Sexo.class.php");
require_once(__DIR__ ."/../classes/modelo/Bairro.class.php");
require_once(__DIR__ ."/../classes/modelo/Cidade.class.php");
require_once(__DIR__ ."/../classes/modelo/UnidadeFederativa.class.php");
require_once(__DIR__ ."/../classes/dao/ClienteDAO.class.php");
require_once(__DIR__ ."/../classes/dao/SexoDAO.class.php");
require_once(__DIR__ ."/../classes/dao/BairroDAO.class.php");
require_once(__DIR__ ."/../classes/dao/CidadeDAO.class.php");
require_once(__DIR__ ."/../classes/dao/UnidadeFederativaDAO.class.php");

$cliente = new Cliente();
$clienteDAO = new ClienteDAO();
$sexoDAO = new SexoDAO();

if (isset($_GET['id'])) {
  $cliente = $clienteDAO->findById($_GET['id']);
}


if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
  $cliente->setId($_POST['id']);
  $cliente->setNome($_POST['nome']);
  $cliente->setSobrenome($_POST['sobrenome']);
  $cliente->setData($_POST['nascimento']);
  $cliente->setCpf($_POST['cpf']);
  $cliente->setSexo($_POST['sexo']);
  $cliente->setCep($_POST['cep']);
  $cliente->setLogradouro($_POST['logradouro']);
  $cliente->setObservacao($_POST['observacao']);
  $cliente->setBairro($_POST['bairro']);
  $cliente->setEmail($_POST['email']);

  $clienteDAO->save($cliente);
  //var_dump($cliente);
  if ($cliente->getId() == 0) {
     $cliente->setId(null);
  }
  if ($_POST['id'] != '') {
      $cliente->setId($_POST['ID']);
  }

  header('location: index.php');
}else{

}
$ufdao = new UnidadeFederativaDAO();
$ufs = $ufdao->findAll();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="icon" href="../assets/img/usuario.png">
    <link rel="stylesheet" href="../assets/css/all.css">
    <title>Cadastro de Clientes</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"><!-- nav bar -->
<a class="navbar-brand" href="../index.php">
    <img src="../assets/img/home.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Inicio
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Cadastrar</a>
      <a class="nav-item nav-link active" href="../listar/index.php">Listar</a>
    </div>
</div>
</nav>
<div class="container"> <!--Início do container-->
<div class="row" style="margin-top: 50px;">
<form method="post" action="index.php"><!--Incio do Formulario-->
<input type="hidden" name="id" value="<?=$cliente->getId();?>">
<div class="form-group"><legend>Cliente</legend>
    <div class="form-group">
      <label for="text">Nome:</label>
      <input type="text" class="form-control" name="nome" id="nome" maxlength="40"  placeholder="Digite  seu nome"  required value="<?=$cliente->getNome();?>">
    </div>
      <div class="form-group">
      <label for="text">Sobrenome:</label>
      <input type="text" class="form-control" name="sobrenome" id="sobrenome" maxlength="40" placeholder="Digite seu Sobrenome"  required value="<?=$cliente->getSobrenome();?>">
      </div>
      <div class="form-group">
          <label for="nascimento">Data de Nascimento:</label>
          <input type="date" id="nascimento" name="nascimento" class="form-control"  required value="<?=$cliente->getData();?>"/>
        </div>
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" name="cpf" id="cpf" maxlength="14" placeholder="Por Favor Digite o CPF! " require value="<?=$cliente->getCpf();?>">
      </div>
      <div class="form-group">
      <div class="form-group"><legend>Sexo</legend>
      </div>
      <div class="custom-control custom-radio custom-control-inline"> 
        <input class="custom-control-input" id="customRadioInline1" type="radio" name="sexo" value="1">
        <label class="custom-control-label" for="customRadioInline1">Masculino</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
         <input class="custom-control-input" id="customRadioInline2" type="radio" name="sexo" value="2">
        <label class="custom-control-label" for="customRadioInline2">Feminino</label>
      </div>
      </div>
      <div class="row">
    <div class="col">
      <label for="cep">CEP:</label>
      <input type="text" class="form-control" name="cep"  maxlength="10" placeholder="Digite seu CEP" value="<?=$cliente->getCep();?>">
    </div>
    <div class="col">
      <label for="logradouro">Logradouro:</label>
      <input type="text" class="form-control" name ="logradouro" maxlength="60" placeholder="Digite seu Logradouro" value="<?=$cliente->getLogradouro();?>">
    </div>
    <div class="form-group">
    				<label for="observacao">Adicional:</label>
    				<textarea class="form-control" id="observacao" name="observacao" maxlength="50  " placeholder="Referência" rows="1" value="<?=$cliente->getObservacao();?>"></textarea>
            <br/>
    </div>
</div>
  <div class="form-group col-md-6" id="div_uf">
    <label for="uf">Estado</label>
    <select class="form-control" name="uf" id="uf" onchange="show_cidades(this.value);">
      <option value="0" selected disabled>Selecione</option>
        <?php foreach($ufs as $uf): ?>
          <option value="<?=$uf->getId();?>">
            <?=$uf->getNome();?>
          </option>
        <?php endforeach; ?>
      </select>
      <div id="div_cidade">
      <label for="cidade">Cidade</label>
      <select class="form-control" name="cidade" id="cidade" onchange="show_bairros(this.value);">
          <option value="0" selected disabled>Selecione</option>
      </select>
      </div>
    <div id="div_bairro">
      <label for="bairro">Bairro</label>
      <select class="form-control" name="bairro" id="bairro">
        <option value="0" selected disabled>Selecione</option>
      </select> 
    </div>
    <div class="form-row">
    <div class="form-group col-md-12">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu E-mail">
    </div>
    </div>
     <div class="form-group"><!--Butões-->
    <input type="submit" class="btn btn-primary" name="salvar" value="Salvar" onclick="return confirmaSalvar();"> 
    <input type="submit" class="btn btn-danger" name="limpar" value="limpar"onclick="return confirmaLimpar();">
</div>
</form><!--Fim do Formulario-->
</div> <!--Fim do container -->
</div>
</body>
<script src="../assets/js/ajax_enderecos.js"></script>
<script src="../assets/js/cadastro.js"></script>
</html>