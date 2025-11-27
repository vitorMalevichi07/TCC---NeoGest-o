<?php
//Busca os dados do agendamento para preencher o formulário de edição
include_once __DIR__ . '/../../conexao.php';

header('Content-Type: application/json');

// Verifica se o ID do agendamento foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare('SELECT
            nome, 
            sobrenome,
            dt_nascimento,
            data_cadastro,
            email,
            cpf,
            cnpj,
            celular,
            cep,
            uf,
            cidade, 
            rua, 
            nCasa,
            complemento
            FROM clientes
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