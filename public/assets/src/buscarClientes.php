<?php
    require  '../../../conexao.php';

    $termo = $_GET['q'] ?? '';
    $stmt = $pdo->prepare("SELECT id, nome FROM clientes WHERE nome LIKE :termo LIMIT 10");
    $stmt->execute([':termo' => $termo . '%']);
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($clientes);
?>