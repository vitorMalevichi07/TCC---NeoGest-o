<?php
session_start();
include_once __DIR__ . '../../src/buscarIdEmpresa.php';
include_once 'conexao.php';
include_once './modalAgendamento/CRUD/createAgendamento.php';
include_once './modalAgendamento/CRUD/processDelete.php';
include_once './modalAgendamento/CRUD/processUpdate.php';

$id_empresa = buscarIdEmpresa($_SESSION['username']);
?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/financeiro.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/agendamentos.css">
    <link rel="stylesheet" href="../components/mensagem.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/sidebar.css">
    <link rel="stylesheet" href="../CSS/PopUp.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/all.css">

    <title>Neo Gestão - Agendamentos</title>
</head>

<body>
    <div class="full-content">
        <?php include '../components/sidebar.php'; ?>
        <div id="main-content">
            <header><?php require '../components/header.php'; ?> </header>

            <!-- PopUps -->

            <!-- cadastrar cliente -->
            <?php include_once "./modalAgendamento/cadastroAgend.php"; ?>
            <!-- editar cliente -->
            <?php include_once "./modalAgendamento/editarAgend.php"; ?>
            <!-- excluir cliente -->
            <?php include_once "./modalAgendamento/excluirAgend.php"; ?>
            <!-- iformação cliente -->
            <?php include_once "./modalAgendamento/infoAgend.php"; ?>
            <!-- PopUps -->

            <!-- start main -->
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

                $query = $pdo->prepare(
                    "SELECT
                count(*) AS total_agendamentos
                FROM
                agendamentos
                WHERE
                id_empresa = :id_empresa"
                );
                $query->bindParam(':id_empresa', $id_empresa);
                $query->execute();
                $resultAgendamentos = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalAgendamentos = [];
                foreach ($resultAgendamentos as $resultAgendamento) {
                    $totalAgendamentos[] = $resultAgendamento['total_agendamentos'];
                }
                ?>
                <div class="container">
                    <section class="top-area">
                        <div class="titulo">
                            <h3><strong>GERENCIAMENTO DE AGENDAMENTOS</strong></h3>
                        </div>
                        <div class="adicionar">
                            <button id='openPopUpCadastro' class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalCadastro">+ Novo Agendamento</button>
                        </div>
                    </section>
                    <div class="mid-area">
                        <div class="pesquisar">
                            <h6>BUSCAR</h6>
                            <div class="main-pesquisar">
                                <form action="" method="get">
                                    <div class="group">
                                        <input type="text" name="nomeCliFiltro" id="nomeCli"
                                            placeholder="Nome do Cliente">
                                    </div>
                                    <div class="group">
                                        <select class="form-select" name="quadraFiltro" aria-placeholder="estadoConta">
                                            <option value="" selected disabled>Quadra</option>
                                            <?php
                                            try {
                                                $query = $pdo->prepare("SELECT id, descr  FROM quadras WHERE id_empresa = :id_empresa");
                                                $query->bindParam(':id_empresa', $id_empresa);
                                                $query->execute();
                                                $quadras = $query->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($quadras as $quadra) {
                                                    echo "<option value=\"{$quadra['id']}\">{$quadra['descr']}</option>";
                                                }
                                            } catch (PDOException $e) {
                                                echo "Erro: " . $e->getMessage();
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="group">
                                        <select class="form-select" name="estadoContaFiltro"
                                            aria-placeholder="estadoConta">
                                            <option value="" selected disabled>Estado da Conta</option>
                                            <option value="1">Pendente</option>
                                            <option value="2">Pago</option>
                                            <option value="3">Cancelado</option>
                                        </select>
                                    </div>
                                    <div class="button">
                                        <button name="filtrar" type="submit">Filtrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="total-agendamentos">
                            <div class="grupo">
                                <h6>TOTAL DE AGENDAMENTOS</h6>
                                <div class="main-total-agendamentos">
                                    <h3><label for="totalAgend"><?= $totalAgendamentos[0] ?></label></h3>
                                    <div class="icone-total">
                                        <i class="fa-solid fa-calendar fa-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $agendamentos = [];
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
                        FROM agendamentos
                        WHERE id_empresa = :id_empresa"
                        );

                        $stmtTotal->execute(array(":id_empresa" => $id_empresa));
                        $totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
                        $totalPaginas = ceil($totalRegistros / $itensPorPagina);

                        /* filtrar */
                        if (isset($_GET['filtrar'])) {
                            $nomeCliFiltro = $_GET['nomeCliFiltro'] ?? '';
                            $estadoContaFiltro = $_GET['estadoContaFiltro'] ?? '';
                            $quadraFiltro = $_GET['quadraFiltro'] ?? '';

                            $stmt = "SELECT ag.*, 
                            cli.nome AS nome_cliente,
                            cli.sobrenome AS sobrenome_cliente,
                            q.descr AS quadra_nome
                            FROM agendamentos ag
                            JOIN clientes cli ON ag.id_cliente = cli.id
                            JOIN quadras q ON ag.id_quadra = q.id
                            WHERE ag.id_empresa = :id_empresa";
                            $params = [':id_empresa' => $id_empresa];

                            if (!empty($nomeCliFiltro)) {
                                $stmt .= " AND cli.nome LIKE :nomeCli COLLATE utf8mb4_general_ci";
                                $params[':nomeCli'] = "%$nomeCliFiltro%";
                            }

                            if (!empty($estadoContaFiltro)) {
                                $stmt .= " AND ag.estado_conta = :estado_conta";
                                $params[':estado_conta'] = $estadoContaFiltro;
                            }

                            if (!empty($quadraFiltro)) {
                                $stmt .= " AND q.id = :quadra";
                                $params[':quadra'] = $quadraFiltro;
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
                            $agendamentos = $queryTable->fetchAll(PDO::FETCH_ASSOC);
                        } else {
                            $queryTable = $pdo->prepare(
                                "SELECT ag.*,
                            cli.nome AS nome_cliente,
                            cli.sobrenome AS sobrenome_cliente,
                            q.descr AS quadra_nome
                            FROM agendamentos ag
                            JOIN clientes cli ON ag.id_cliente = cli.id
                            JOIN quadras q ON ag.id_quadra = q.id
                            WHERE ag.id_empresa = :id_empresa
                            ORDER BY dt DESC LIMIT :limit OFFSET :offset
                            "
                            );
                            $queryTable->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                            $queryTable->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                            $queryTable->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $queryTable->execute();
                            $agendamentos = $queryTable->fetchAll(PDO::FETCH_ASSOC);
                        }
                    } catch (PDOException $e) {
                        echo 'erro ' . $e->getMessage();
                    }
                    if (count($agendamentos) == 0):
                        ?>
                        <div class='sem-agendamento'>
                            <i class="fa-solid fa-calendar fa-2xl"></i>
                            <h2>Nenhum Agendamento Encontrado</h2>
                            <small>Adicione seu primeiro Agendamento</small>
                        </div>
                        <?php
                    else:
                        ?>
                        <!-- start tableCli  -->
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-align-center text-center">
                                        <th scope="col">Nome Cliente</th>
                                        <th scope="col">Quadra</th>
                                        <th scope="col">Data</th>
                                        <th scope="col">Horário Início</th>
                                        <th scope="col">Horário de Termino</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Estado da Conta</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <?php


                                ?>
                                <tbody>
                                    <?php
                                    foreach ($agendamentos as $agendamento):
                                        ?>
                                        <tr class="text-center text-align-center">
                                            <td><label>
                                                    <?= empty($agendamento['nome_cliente']) ? '<span>Vazio</span>' :
                                                        $agendamento['nome_cliente'] . ' ' . $agendamento['sobrenome_cliente'] ?>
                                                </label></td>

                                            <td><label>
                                                    <?= empty($agendamento['quadra_nome']) ? '<span>Vazio</span>' :
                                                        $agendamento['quadra_nome'] ?>
                                                </label></td>

                                            <td><label>
                                                    <?= empty($agendamento['dt']) ? '<span>Vazio</span>' :
                                                        date('d/m/y', strtotime($agendamento['dt'])) ?>
                                                </label></td>

                                            <td><label>
                                                    <?= empty($agendamento['horario_agendado']) ? '<span>Vazio</span>' :
                                                        $agendamento['horario_agendado'] ?>
                                                </label></td>

                                            <td><label>
                                                    <?= empty($agendamento['tempo_alocado']) ? '<span>Vazio</span>' :
                                                        $agendamento['tempo_alocado'] ?>
                                                </label></td>

                                            <td><label>
                                                    <?= empty($agendamento['valor']) ? '<span>Vazio</span>' :
                                                        'R$ ' . number_format($agendamento['valor'], 2, ',', '.') ?>
                                                </label></td>
                                            <?php
                                            if ($agendamento['estado_conta'] == 1): ?>
                                                <td class="text-warning">Pendente</td>
                                            <?php elseif ($agendamento['estado_conta'] == 2): ?>
                                                <td class="text-success">Pago</td>
                                            <?php elseif ($agendamento['estado_conta'] == 3): ?>
                                                <td class="text-danger">Cancelado</td>
                                            <?php else: ?>
                                                <td class="text-muted">Vazio</td>
                                            <?php endif; ?>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#modalEditar"
                                                    data-id="<?= $agendamento['id']; ?>" class="btn btn-primary btn-sm">
                                                    <i class='fa-solid fa-pen-to-square first'></i></button>

                                                <!-- botão de Excluir -->
                                                <button data-bs-toggle="modal" data-bs-target="#modalExcluir"
                                                    data-id="<?= $agendamento['id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class='fa-solid fa-trash second'></i></button>

                                                <!-- botão de Info -->
                                                <button data-bs-toggle="modal" data-bs-target="#modalInfo"
                                                    data-id="<?= $agendamento['id']; ?>" class="btn btn-secondary btn-sm">
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
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_GET['editar'])): ?>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var modal = document.getElementById('modalEditar');
                                if (modal) {
                                    modal.addEventListener('hidden.bs.modal', function () {
                                        if (window.location.search.includes('editar=')) {
                                            // Remove o parâmetro editar da URL sem recarregar a página
                                            const url = new URL(window.location);
                                            url.searchParams.delete('editar');
                                            window.history.replaceState({}, document.title, url.pathname + url.search);
                                        }
                                    });
                                    // Abre o modal automaticamente
                                    var bsModal = new bootstrap.Modal(modal);
                                    bsModal.show();
                                }
                            });
                        </script>
                    <?php endif; ?>
                </div>
        </div>
    </div>
    </main>
    </div>
    </div>
    </div>
    <script src="./modalAgendamento/CRUD/updateAgendamento.js"></script>
    <script src="./modalAgendamento/CRUD/deleteAgendamento.js"></script>
    <script src="./modalAgendamento/CRUD/infoAgendamento.js"></script>
    <script src="../src/stepTimeAgendamento.js"></script>
    <script src="../JS/bootstrap.bundle.min.js"></script>
    <script src="../components/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>