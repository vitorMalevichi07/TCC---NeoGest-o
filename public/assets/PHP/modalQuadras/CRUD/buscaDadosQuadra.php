<?php
//Busca os dados do agendamento para preencher o formulário de edição
include_once __DIR__ . '/../../conexao.php';

header('Content-Type: application/json');

// Verifica se o ID do agendamento foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare('SELECT
            id_modalidade AS modalidade,
            descr,
            disponibilidade,
            valor_hora
            FROM quadras
            WHERE
            id = :id
        ');

        $stmt->execute(array(':id' => $id));
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($cliente);

    } catch (Exception $e) {
        echo '' . $e->getMessage() . '';
    }
} else {
    echo json_encode(['error' => 'ID do cliente não especificado.']);
}
?>