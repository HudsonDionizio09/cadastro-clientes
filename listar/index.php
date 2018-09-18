<?php
require_once(__DIR__ . "/../classes/modelo/Cliente.class.php");
require_once(__DIR__ ."/../classes/dao/ClienteDAO.class.php");
$cliente = new Cliente();
$clienteDAO = new ClienteDAO();

if (isset($_GET['editar']) && $_GET['editar'] == 'editar') {
  $cliente = $clienteDAO->findById($_GET['id']);
  var_dump($cliente);
}
if (isset($_POST['remover']) && $_POST['remover'] == 'remover') {
  $clienteDAO->remove($_POST['id']);
  header('location: index.php?');
}

$clientes = $clienteDAO->findAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="icon" href="../assets/img/lista.png">
    <link rel="stylesheet" href="../assets/css/all.css">
</head>
<body>
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
      <a class="nav-item nav-link active" href="../cadastro/index.php">Cadastrar</a>
      <a class="nav-item nav-link active" href="#">Listar</a>
    </div>
  </div>
</nav>
<div class="container">
<div class="row" style="margin-top: 50px;">
<fieldset>
  <legend>Lista de Clientes</legend>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Sobrenome</th>
      <th scope="col">Data de Nascimento</th>
      <th scope="col">Sexo</th>
      <th scope="col">Bairro</th> 
      <th scope="col">Cidade</th> 
      <th scope="col">UF</th> 
      <th colspan="2">AÇÕES</th>                          
    </tr>
  </thead>
  <tbody>
    <?php foreach($clientes as $cliente): ?>
      <tr>
       <td><?=$cliente->getId();?></td>
       <td><?=$cliente->getNome();?></td>
       <td><?=$cliente->getSobrenome();?></td>
       <td><?=$cliente->getData();?></td>
       <td><?=$cliente->getSexo()->getSigla();?></td>
       <td><?=$cliente->getBairro()->getNome();?></td>
       <td><?=$cliente->getCidade()->getNome();?></td>
       <td><?=$cliente->getUnidadeFederativa()->getSigla();?></td>
      <td>
          <form method="get" id="editar" action="../cadastro/index.php">
            <input type="hidden" name="id" value="<?=$cliente->getId();?>">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
          </form>
      </td>
      <td>
        <form method="post" id="form-remover">
          <input type="hidden" name="id" value="<?=$cliente->getId();?>">
          <button type="submit" class="btn btn-sm btn-danger" name="remover" value="remover" onclick="return confirmaRemover();" ><i class="fas fa-trash-alt"></i></button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</fieldset>
</div>
</div>
</body>
<script src="../assets/js/cadastro.js"></script>
</html>