<?php
include_once __DIR__ . '/../../conexao.php';

header('Content-Type: application/json');

// Verifica se o ID do agendamento foi passado via GET
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    try {

        $stmt = $pdo->prepare(
            "SELECT
            cli.nome AS nome_cliente,
            cli.sobrenome AS sobrenome_cliente

            FROM agendamentos ag
            
            LEFT JOIN clientes cli ON ag.id_cliente = cli.id
                
            WHERE ag.id = :id"
        );

        $stmt->execute([':id' => $id]);
        $agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

        json_encode($agendamento);
        die(json_encode($agendamento));
    } catch (PDOException $e) {
        echo 'Erro ao buscar agendamento: ' . $e->getMessage();
    }
} else {
    echo json_encode(['error' => 'ID do agendamento não especificado.']);
}
?>