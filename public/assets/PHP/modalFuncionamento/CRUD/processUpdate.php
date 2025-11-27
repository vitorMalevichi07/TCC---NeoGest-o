<?php
session_start();
include_once __DIR__ . '/../../../src/buscarIdEmpresa.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
    exit();
}
include_once __DIR__ . '/../../conexao.php';

$username = $_SESSION['username'];
$id_empresa = buscarIdEmpresa($username);
try {
    if (isset($_POST['alteracoes'])) {
        /* Pega os dados digitados no popUp */
        $aberturaFuncio = $_POST['aberturaFuncio'];
        $fechamentoFuncio = $_POST['fechamentoFuncio'];
        $intervaloTempo = $_POST['intervaloTempo'];

        /* prepara a query de update */
        $updateFuncio = $pdo->prepare("UPDATE horarios
        SET
        h_abertura = :aberturaFuncio,
        h_fechamento = :fechamentoFuncio,
        intervalo_tempo = :intervaloTempo
        WHERE
        id_empresa = :id_empresa
        ");

        /* Executa a query de update com os parâmetros */
        $result = $updateFuncio->execute(array(
            ':id_empresa' => $id_empresa,
            ':aberturaFuncio' => $aberturaFuncio,
            ':fechamentoFuncio' => $fechamentoFuncio,
            ':intervaloTempo' => $intervaloTempo,
        ));
        if ($result) {
            $_SESSION['message'] = 'Dados alterados com sucesso!';
            $_SESSION['message_type'] = 'success'; // Bootstrap: verde
            header("Location: ../../Funcionamento.php");
            exit;
        } else {
            $_SESSION['message'] = 'Não foi possível alterar!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../../Funcionamento.php");
            exit;
        }
    }
} catch (PDOException $e) {
    echo "Erro ao inserir os dados" .
        "Número do erro: " . $e->getMessage();
}
?>