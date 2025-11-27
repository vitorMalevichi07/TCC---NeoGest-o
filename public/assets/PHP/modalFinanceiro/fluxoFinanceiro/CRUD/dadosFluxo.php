<?php
include_once __DIR__ . '/../../../conexao.php';
header('Content-Type: application/json');
try {
    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM fluxo_financeiro WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $fluxo = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($fluxo) {
        echo json_encode($fluxo);
    } else {
        echo json_encode(['error' => 'Fluxo não encontrado']);
    }
}
 else {
    echo json_encode(['error' => 'ID do Fluxo não especificado.']);
}
} catch ( PDOException $e) {
    echo 'Erro ao buscar conta: ' . $e->getMessage();
}

?>