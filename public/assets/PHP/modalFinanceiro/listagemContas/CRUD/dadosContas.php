<?php
include_once __DIR__ . '/../../../conexao.php';
header('Content-Type: application/json');
try {
    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM contas WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $conta = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($conta) {
        echo json_encode($conta);
    } else {
        echo json_encode(['error' => 'Conta não encontrada']);
    }
}
 else {
    echo json_encode(['error' => 'ID da conta não especificado.']);
}
} catch ( PDOException $e) {
    echo 'Erro ao buscar conta: ' . $e->getMessage();
}

?>