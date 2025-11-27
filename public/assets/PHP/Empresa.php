<?php
include_once __DIR__ . '/../../assets/PHP/CRUD-Empresa/createEmpresa.php'
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/empresa.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/fontawesome.min.css">
    <script type="module" src="../JS/bootstrap.bundle.min.js"></script>
    <title>Cadastro de Empresa</title>
</head>
<body>

        <main>
        <div class="container">
            <div class="empresa-container">
                <div class="top-empresa">
                    <h2>SEJA BEM VINDO</h2>
                    <h4>Cadastre sua Empresa</h4>
                </div>
            <form class="row g-3" action="" method="POST">
                <div class="col-md-6">
                    <label for="razaoSocial" class="form-label">Razão social</label>
                    <input type="text" class="form-control" id="razaoSocial" name="razaoSocial">
                </div>
                <div class="col-md-6">
                    <label for="emailEmpresa" class="form-label">Email</label>
                    <input type="text" class="form-control" id="emailEmpresa" name="emailEmpresa">
                </div>
                <div class="col-md-6">
                    <label for="telefoneEmpresa" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefoneEmpresa" name="telefoneEmpresa">
                </div>
                <div class="col-md-6">
                    <label for="cnpjEmpresa" class="form-label">CNPJ</label>
                    <input type="text" class="form-control" id="cnpjEmpresa" name="cnpjEmpresa">
                </div>
                <div class="col-md-6">
                    <label for="cepEmpresa" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cepEmpresa" name="cepEmpresa">
                </div>
                <div class="col-md-6">
                    <label for="numeroEmpresa" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numeroEmpresa" name="numeroEmpresa">
                </div>
                <div class="col-md-5">
                    <label for="cidadeEmpresa" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidadeEmpresa" name="cidadeEmpresa">
                </div>
                <div class="col-md-5">
                    <label for="ruaEmpresa" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="ruaEmpresa" name="ruaEmpresa">
                </div>
                <div class="col-md-2">
                    <label for="ufEmpresa" class="form-label">UF</label>
                    <input type="text" class="form-control" id="ufEmpresa" name="ufEmpresa">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="cadastrar">Adicionar Empresa</button>
                </div>
                </form>
            </div>
        </div> 
        </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>