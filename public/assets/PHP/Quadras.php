<?php
session_start();
include_once __DIR__ . '../../src/buscarIdEmpresa.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=Você precisa fazer login para acessar esta página.");
    exit;
}
include_once 'conexao.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once './modalQuadras/CRUD/createQuadras.php';
    include_once './modalQuadras/CRUD/processUpdate.php';
    include_once './modalQuadras/CRUD/processDelete.php';
}
$username = $_SESSION['username'];
$id_empresa = buscarIdEmpresa($username);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/financeiro.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/quadras.css">
    <link rel="stylesheet" href="../components/mensagem.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/sidebar.css">
    <link rel="stylesheet" href="../CSS/PopUp.css">
    <link rel="stylesheet" href="../CSS/PopUpExcluir.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/all.css">
    <title>Neo Gestão - Quadras</title>
</head>

<body>
    <div class="full-content">
        <?php include '../components/sidebar.php'; ?>
        <div id="main-content">
            <?php include '../components/header.php'; ?>

            <!-- PopUps -->
            <!-- cadastrar quadra -->
            <?php include_once "./modalQuadras/cadastroQuadra.php"; ?>
            <!-- editar quadra -->
            <?php include_once "./modalQuadras/editarQuadra.php"; ?>
            <!-- excluir quadra -->
            <?php include_once "./modalQuadras/excluirQuadra.php"; ?>
            <!-- iformação quadra -->
            <?php include_once "./modalQuadras/infoQuadra.php"; ?>
            <!-- PopUps -->

            <main>
                <?php
                /* mensagem de sucesso */
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

                /* card total quadras */
                $queryTotal = $pdo->prepare(
                    "SELECT
                count(*) AS total_quadras
                FROM
                quadras
                WHERE
                id_empresa = :id_empresa"
                );
                $queryTotal->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                $queryTotal->execute();
                $resultQuadras = $queryTotal->fetchAll(PDO::FETCH_ASSOC);

                $totalQuadras = [];
                foreach ($resultQuadras as $quadraCount) {
                    $totalQuadras[] = $quadraCount['total_quadras'];
                }
                ?>
                <div class="container">
                    <section class="top-area">
                        <div class="titulo">
                            <h3><strong>GERENCIAMENTO DE QUADRAS</strong></h3>
                        </div>
                        <div class="adicionar">
                            <button id='openPopUpCadastro' class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalCadastro">+ Nova Quadra</button>
                        </div>
                    </section>
                    <div class="mid-area">
                        <div class="pesquisar">
                            <h6>BUSCAR</h6>
                            <div class="main-pesquisar">
                                <form action="" method="get">
                                    <div class="group">
                                        <input type="text" name="nomeQuadraFiltro" id="nomeQuadra"
                                            placeholder="Nome da Quadra">
                                    </div>
                                    <div class="group">
                                        <select class="form-select" aria-label="Default select example"
                                            name="modalidadeQuadraFiltro">
                                            <option value="" selected disabled>Opções</option>
                                            <?php
                                            $stmtMod = $pdo->prepare("SELECT id, descr FROM modalidade_quadra");
                                            $stmtMod->execute();
                                            $modalidades = $stmtMod->fetchAll();
                                            foreach ($modalidades as $modalidade) {
                                                echo "<option value='{$modalidade['id']}'>{$modalidade['descr']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="group">
                                        <select class="form-select" name="disponibilidadeFiltro" id="disponibilidade">
                                            <option value="" select disabled>Selecione uma Opção</option>
                                            <option value="1">Disponível</option>
                                            <option value="0">Indisponível</option>
                                        </select>
                                    </div>
                                    <div class="button">
                                        <button name="filtrar" type="submit">Filtrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="total-quadras">
                            <div class="grupo">
                                <h6>TOTAL DE QUADRAS</h6>
                                <div class="main-total-quadras">
                                    <h1><label for="totalQuadras"><?= $totalQuadras[0] ?></label></h1>
                                    <div class="icone-total">
                                        <i class="fa-solid fa-futbol fa-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $quadras = [];
                    try {
                        /* paginação */
                        $itensPorPagina = 10;
                        $paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                        if ($paginaAtual < 1)
                            $paginaAtual = 1;
                        $offset = ($paginaAtual - 1) * $itensPorPagina;
                        /* total de registros */
                        $stmtTotal = $pdo->prepare(
                            "SELECT COUNT(*) AS total
                        FROM quadras
                        WHERE id_empresa = :id_empresa"
                        );

                        $stmtTotal->execute(array(":id_empresa" => $id_empresa));
                        $totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
                        $totalPaginas = ceil($totalRegistros / $itensPorPagina);

                        /* filtrar */
                        if (isset($_GET['filtrar'])) {
                            $nomeQuadraFiltro = $_GET['nomeQuadraFiltro'] ?? '';
                            $modalidadeQuadraFiltro = $_GET['modalidadeQuadraFiltro'] ?? '';
                            $disponibilidadeFiltro = $_GET['disponibilidadeFiltro'] ?? '';

                            $stmt = "SELECT q.*, 
                        modalidade_quadra.descr AS modalidade_descr

                        FROM quadras q
                        JOIN modalidade_quadra ON q.id_modalidade = modalidade_quadra.id

                        WHERE q.id_empresa = :id_empresa";
                            $params = [':id_empresa' => $id_empresa];

                            if (!empty($nomeQuadraFiltro)) {
                                $stmt .= " AND q.descr LIKE :nomeQuadraFiltro COLLATE utf8mb4_general_ci";
                                $params[':nomeQuadraFiltro'] = "%$nomeQuadraFiltro%";
                            }

                            if (!empty($modalidadeQuadraFiltro)) {
                                $stmt .= " AND modalidade_quadra.descr = :modalidadeQuadraFiltro";
                                $params[':modalidadeQuadraFiltro'] = $modalidadeQuadraFiltro;
                            }

                            if (!empty($disponibilidadeFiltro)) {
                                $stmt .= " AND q.disponibilidade = :disponibilidadeFiltro";
                                $params[':disponibilidadeFiltro'] = $disponibilidadeFiltro;
                            }
                            $stmt .= ' ORDER BY q.descr ASC LIMIT :limit OFFSET :offset';

                            $queryTable = $pdo->prepare($stmt);
                            unset($params[':limit'], $params[':offset']);
                            foreach ($params as $key => $value) {
                                $queryTable->bindValue($key, $value);
                            }
                            $queryTable->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                            $queryTable->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $queryTable->execute();
                            $quadras = $queryTable->fetchAll(PDO::FETCH_ASSOC);
                            /* caso não seje aplicado o filtro */
                        } else {
                            $queryTable = $pdo->prepare(
                                "SELECT q.*, 
                        modalidade_quadra.descr AS modalidade_descr
                        FROM quadras q
                        JOIN modalidade_quadra ON q.id_modalidade = modalidade_quadra.id
                        WHERE q.id_empresa = :id_empresa
                        ORDER BY q.descr ASC LIMIT :limit OFFSET :offset"
                            );
                            $queryTable->bindParam(':id_empresa', $id_empresa);
                            $queryTable->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                            $queryTable->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $queryTable->execute();
                            $quadras = $queryTable->fetchAll(PDO::FETCH_ASSOC);
                        }
                    } catch (PDOException $e) {
                        echo 'erro ' . $e->getMessage();
                    }
                    if (count($quadras) == 0):
                        ?>
                        <div class='sem-quadra'>
                            <i class="fa-solid fa-futbol fa-2xl"></i>
                            <h2>Nenhuma Quadra Encontrada</h2>
                            <small>Adicione sua primeira Quadra</small>
                        </div>
                        <?php
                    else:
                        ?>
                        <!-- start tableCli  -->
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-align-center text-center">
                                        <th scope="col">Quadra</th>
                                        <th scope="col">Modalidade</th>
                                        <th scope="col">Disponibilidade</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($quadras as $quadra): ?>
                                        <tr class="text-center text-align-center">
                                            <td><label for='nomeQuadra'><?= $quadra['descr'] ?></label></td>
                                            <td><label for='modalidadeQuadra'><?= $quadra['modalidade_descr'] ?></label></td>
                                            <td><label for='disponibilidadeQuadra'><?php if ($quadra['disponibilidade'] == 1) {
                                                echo "Disponível";
                                            } else {
                                                echo "Indisponível";
                                            }
                                            ?></label></td>
                                            <td><label for='valoragendQuadra'>R$
                                                    <?= number_format($quadra['valor_hora'], 2, ',', '.') ?></label></td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#modalEditar"
                                                    data-id="<?= $quadra['id']; ?>" class="btn btn-primary btn-sm">
                                                    <i class='fa-solid fa-pen-to-square first'></i></button>

                                                <!-- botão de Excluir -->
                                                <button data-bs-toggle="modal" data-bs-target="#modalExcluir"
                                                    data-id="<?= $quadra['id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class='fa-solid fa-trash second'></i></button>

                                                <!-- botão de Info -->
                                                <button data-bs-toggle="modal" data-bs-target="#modalInfo"
                                                    data-id="<?= $quadra['id']; ?>" class="btn btn-secondary btn-sm">
                                                    <i class='fa-solid fa-info-circle third'></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
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
                        <?php endif ?>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    <script src="./modalQuadras/CRUD/updateQuadra.js"></script>
    <script src="./modalQuadras/CRUD/deleteQuadra.js"></script>
    <script src="./modalQuadras/CRUD/infoQuadra.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../components/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>