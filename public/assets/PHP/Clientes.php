<?php
session_start();

include_once __DIR__ . '../../src/buscarIdEmpresa.php';

include_once 'conexao.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once './modalCliente/CRUD/createCliente.php';
    include_once './modalCliente/CRUD/proccesDelete.php';
    include_once './modalCliente/CRUD/proccesUpdate.php';
}
$username = $_SESSION['username'];
$id_empresa = buscarIdEmpresa($username);
?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/financeiro.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/clientes.css">
    <link rel="stylesheet" href="../components/mensagem.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/sidebar.css">
    <link rel="stylesheet" href="../CSS/PopUp.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/all.css">
    <script type="module" src="../JS/PopUpBuscar.js"></script>
    <script type="module" src="../JS/PopUpEditar.js"></script>
    <script type="module" src="../JS/PopUpExcluir.js"></script>
    <script type="module" src="../JS/PopUpInfo.js"></script>
    <title>Neo Gestão - Clientes</title>
</head>

<body>
    <div class="full-content">
        <?php require '../components/sidebar.php'; ?>
        <div id="main-content">
            <?php require '../components/header.php'; ?>
            <!-- PopUps -->
            <!-- cadastrar cli/modalClienteente -->
            <?php include_once "./modalCliente/cadastroCli.php"; ?>
            <!-- editar cliente -->
            <?php include_once "./modalCliente/editarCli.php"; ?>
            <!-- excluir cliente -->
            <?php include_once "./modalCliente/excluirCli.php"; ?>
            <!-- iformação cliente -->
            <?php include_once "./modalCliente/infoCli.php"; ?>

            <!-- PopUps -->

            <main>
                <?php
                if (isset($_SESSION['message'])):
                    $type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'info';
                    ?>
                    <div class="alert alert-<?= $type ?> alert-dismissible fade show alert-top-fixed" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                endif;

                $queryClientes = $pdo->prepare(
                    "SELECT
            count(*) AS total_clientes
            FROM
            clientes
            WHERE
            id_empresa = :id_empresa
            "
                );
                $queryClientes->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                $queryClientes->execute();
                $resultClientes = $queryClientes->fetchAll(PDO::FETCH_ASSOC);
                $total_clientes = [];
                foreach ($resultClientes as $cliente) {
                    $total_clientes[] = $cliente['total_clientes'];
                }

                ?>
                <div class="container">
                    <section class="top-area">
                        <div class="titulo">
                            <h3><strong>GERENCIAMENTO DE CLIENTES</strong></h3>
                        </div>
                        <div class="adicionar">
                            <button id='openPopUpCadastro' class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalCadastro">+ Novo Cliente</button>
                        </div>
                    </section>
                    <div class="mid-area">
                        <div class="pesquisar">
                            <div class="title-pesquisar">
                                <i class="fas fa-filter fa-xl"></i>
                                <h4> Filtros</h4>
                            </div>
                            <div class="main-pesquisar">
                                <form action="" method="get">
                                    <div class="group">
                                        <input type="text" name="nomeCli" id="nomeCli" placeholder="Buscar por Nome">
                                    </div>
                                    <div class="group">
                                        <input type="text" name="cpfCli" id="cpfCli" placeholder="Buscar por CPF">
                                    </div>
                                    <div class="group">
                                        <input type="text" name="telefoneCli" id="telefoneCli"
                                            placeholder="Buscar por Telefone">
                                    </div>
                                    <div class="button">
                                        <button name="filtrar" type="submit">Filtrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="total-clientes">
                            <div class="grupo">
                                <h6>TOTAL DE CLIENTES</h6>
                                <div class="main-total-clientes">
                                    <h1><label for="totalCli"><?= $total_clientes[0]; ?></label></h1>
                                    <div class="icone-total">
                                        <i class="fa-solid fa-users fa-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $clientes = [];
                    try {
                        $itensPorPagina = 10;
                        $paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                        if ($paginaAtual < 1)
                            $paginaAtual = 1;
                        $offset = ($paginaAtual - 1) * $itensPorPagina;

                        $stmtTotal = $pdo->prepare(
                            "SELECT COUNT(*) AS total
                        FROM clientes
                        WHERE id_empresa = :id_empresa
                        "
                        );
                        $stmtTotal->execute(array(":id_empresa" => $id_empresa));
                        $totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
                        $totalPaginas = ceil($totalRegistros / $itensPorPagina);


                        if (isset($_GET['filtrar'])) {
                            $nome = $_GET['nomeCli'] ?? '';
                            $cpf = $_GET['cpfCli'] ?? '';
                            $telefone = $_GET['telefoneCli'] ?? '';

                            $stmt = "SELECT * FROM clientes WHERE id_empresa = :id_empresa";
                            $params = [':id_empresa' => $id_empresa];

                            if (!empty($nome)) {
                                $stmt .= " AND nome LIKE :nome COLLATE utf8mb4_general_ci";
                                $params[':nome'] = "%$nome%";
                            }

                            if (!empty($cpf)) {
                                $stmt .= " AND cpf LIKE :cpf COLLATE utf8mb4_general_ci";
                                $params[':cpf'] = "%$cpf%";
                            }

                            if (!empty($telefone)) {
                                $stmt .= " AND telefone LIKE :telefone COLLATE utf8mb4_general_ci";
                                $params[':telefone'] = "%$telefone%";
                            }
                            $stmt .= ' ORDER BY nome ASC LIMIT :limit OFFSET :offset';

                            $query = $pdo->prepare($stmt);
                            unset($params[':limit'], $params[':offset']);
                            foreach ($params as $key => $value) {
                                $query->bindValue($key, $value);
                            }
                            $query->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                            $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $query->execute();
                            $clientes = $query->fetchAll(PDO::FETCH_ASSOC);

                        } else {
                            $query = $pdo->prepare("SELECT * FROM clientes WHERE id_empresa = :id_empresa 
                        ORDER BY nome ASC LIMIT :limit OFFSET :offset");

                            $query->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                            $query->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                            $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $query->execute();
                            $clientes = $query->fetchAll(PDO::FETCH_ASSOC);
                        }
                    } catch (PDOException $e) {
                        echo 'Erro na tentativa de buscas dados: ' . $e->getMessage();
                    }
                    if (count($clientes) == 0):
                        ?>
                        <div class='sem-cliente'>
                            <i class="fa-solid fa-users fa-2xl"></i>
                            <h2>Nenhum Cliente Cadastrado</h2>
                            <small>Adicione seu primeiro Cliente</small>
                        </div>
                        <?php
                    else:
                        ?>
                        <!-- start tableCli  -->
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-align-center text-center">
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Contato</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col">Endereço</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <tr class="text-center text-align-center">
                                            <input type='hidden' id='idCliente' value=<?= $cliente['id'] ?> />
                                            <td><label><?= $cliente['nome'] . " " . $cliente['sobrenome'] ?></label>
                                            </td>
                                            <td><label><?= $cliente['celular'] ?></label></td>
                                            <td><label><?= $cliente['email'] ?></label></td>
                                            <td><label><?= isset($cliente['cpf']) ? $cliente['cpf'] : '<span>CPF Vazio</span>' ?></label>
                                            </td>
                                            <td><label><?= isset($cliente['rua']) ? $cliente['rua'] . ", Nº " . $cliente['nCasa'] : '<span>Endereço Vazio</span>' ?></label>
                                            </td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#modalEditar"
                                                    data-id="<?= $cliente['id']; ?>" class="btn btn-primary btn-sm">
                                                    <i class='fa-solid fa-pen-to-square first'></i></button>

                                                <!-- botão de Excluir -->
                                                <button data-bs-toggle="modal" data-bs-target="#modalExcluir"
                                                    data-id="<?= $cliente['id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class='fa-solid fa-trash second'></i></button>

                                                <!-- botão de Info -->
                                                <button data-bs-toggle="modal" data-bs-target="#modalInfo"
                                                    data-id="<?= $cliente['id']; ?>" class="btn btn-secondary btn-sm">
                                                    <i class='fa-solid fa-info-circle third'></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php endforeach; ?>
                                <tfoot>
                                    <tr class="ms-2">
                                        <td colspan="12" class="">
                                            <nav aria-label="Navegação de página">
                                                <ul class="pagination d-flex justify-content-between">
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Página:</span>
                                                    </li>
                                                    <div class="paginacao-info d-flex">
                                                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                                            <li class="page-item <?= ($i == $paginaAtual) ? 'active' : '' ?>">
                                                                <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </div>
                                                </ul>
                                            </nav>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
        </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="./modalCliente/CRUD/updateCliente.js"></script>
    <script src="./modalCliente/CRUD/deleteCliente.js"></script>
    <script src="./modalCliente/CRUD/infoCliente.js"></script>
    <script src="../components/sidebar.js"></script>
    <script src="../src/consultaCep.js"></script>
    <script src="../src/consultaCel.js"></script>
    <script src="../src/consultaRG.js"></script>
    <script src="../src/consultaCPF.js"></script>
    <script src="../src/consultaCNPJ.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script>
        $('#modalCadastro').on('shown.bs.modal', function () {
            $('#nomeCli').focus();
        });
    </script>

    </div>
</body>

</html>