<?php
require_once(__DIR__ . "/./classes/modelo/UnidadeFederativa.class.php");
require_once(__DIR__ . "/./classes/dao/UnidadeFederativaDAO.class.php");

$dao = new UnidadeFederativaDAO();
$ufs = $dao->findAll();

?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Endereços</title>
        <link rel="stylesheet" href="./assets/css/bootstrap.css">
        <link rel="stylesheet" href="./assets/css/all.css">
    </head>
    <body>
        <div class="container" style="margin-top: 50px;">
            <form>
                <div class="col-12 form-group" id="div_uf"><!-- select estado -->
                    <label for="uf">Estado</label>
                    <select class="form-control" name="uf" id="uf" onchange="show_cidades(this.value);">
                        <option value="0" selected disabled>--SELECIONE--</option>
                        <?php foreach($ufs as $uf): ?>
                            <option value="<?=$uf->getId();?>">
                                <?=$uf->getNome();?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 form-group" id="div_cidade"><!-- select cidade -->
                    <label for="cidade">Cidade</label>
                    <select class="form-control" name="cidade" id="cidade" onchange="show_bairros(this.value);">
                        <option value="0" selected disabled>--SELECIONE--</option>
                    </select>
                </div>
                <div class="col-12 form-group" id="div_bairro"><!-- select bairro -->
                    <label for="bairro">Bairro</label>
                    <select class="form-control" name="bairro" id="bairro">
                        <option value="0" selected disabled>--SELECIONE--</option>
                    </select>
                </div>
                <div class="col-12 form-group"><!-- select botao -->
                    <button type="submit" class="btn btn-danger btn-block">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
        <script src="assets/js/ajax_enderecos.js"></script>
    </body>
</html>
