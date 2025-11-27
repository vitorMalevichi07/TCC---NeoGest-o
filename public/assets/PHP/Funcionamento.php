<?php
session_start();
include_once __DIR__ . '../../src/buscarIdEmpresa.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=Você precisa fazer login para acessar esta página.");
    exit;
}
include_once 'conexao.php';
$username = $_SESSION['username'];
$id_empresa = buscarIdEmpresa($username);

/* Query cards */
$buscaFuncionamento = $pdo->prepare('SELECT 
id,
h_abertura,
h_fechamento,
intervalo_tempo
FROM
horarios
WHERE
id_empresa = :id_empresa
');

$buscaFuncionamento->execute(array(
    ':id_empresa' => $id_empresa
));

$resultFuncionamento = $buscaFuncionamento->fetchAll(PDO::FETCH_ASSOC);
$idFuncionamento = isset($resultFuncionamento[0]['id']) ? $resultFuncionamento[0]['id'] : null;
$intervaloTempo = isset($resultFuncionamento[0]['intervalo_tempo']) ? $resultFuncionamento[0]['intervalo_tempo'] : null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/financeiro.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/funcionamento.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/sidebar.css">
    <link rel="stylesheet" href="../CSS/PopUp.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/fontawesome.min.css">
    <title>Neo Gestão - Funcionamento</title>

</head>

<body>
    <script>
        localStorage.setItem('activeItem', 'funcionamento');
    </script>
    <div class="full-content">
        <?php require '../components/sidebar.php'; ?>
        <div id="main-content">
            <?php require '../components/header.php'; ?>

            <?php include_once "./modalFuncionamento/editarFuncionamento.php"; ?>
            <main>
                <div class="container">
                    <section class="top-area">
                        <div class="titulo">
                            <h3><strong>GERENCIAMENTO DE FUNCIONAMENTO</strong></h3>
                        </div>
                        <div class="editar">
                            <button data-bs-toggle="modal" data-bs-target="#modalEditar"
                                data-id="<?= htmlspecialchars($idFuncionamento) ?>"
                                class="btn btn-primary">EDITAR</button>
                        </div>
                    </section>

                    <div class="cards">
                        <div class="card">
                            <h3>HORÁRIO DE ABERTURA :</h3>
                            <div class="time">
                                <?= isset($resultFuncionamento[0]['h_abertura']) ? htmlspecialchars($resultFuncionamento[0]['h_abertura']) : '--:--' ?>
                            </div>
                            <div class="icone-total">
                                <i class="fa-solid fa-school-circle-check fa-xl"></i>
                            </div>
                        </div>

                        <div class="card">
                            <h3>INTERVALO DE TEMPO:</h3>
                            <div class="time">
                                <?= $intervaloTempo ? 30 : 15 ?>
                                <span class="minutos">minutos</span>
                            </div>
                            <div class="icone-total">
                                <i class="fa-solid fa-clock fa-xl"></i>
                            </div>
                        </div>

                        <div class="card">
                            <h3>HORÁRIO DE FECHAMENTO :</h3>
                            <div class="time">
                                <?= isset($resultFuncionamento[0]['h_fechamento']) ? htmlspecialchars($resultFuncionamento[0]['h_fechamento']) : '--:--' ?>
                            </div>
                            <div class="icone-total">
                                <i class="fa-solid fa-school-circle-xmark fa-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

</body>

</html>

</main>
</div>
</div>
<script src="../components/sidebar.js"></script>
<script src="./modalFuncionamento/CRUD/updateFuncionamento.js"></script>
<script src="../src/stepTimeAgendamento.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>

</html>