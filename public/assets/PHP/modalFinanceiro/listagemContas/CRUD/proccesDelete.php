<?php
include_once __DIR__ . '/../../../conexao.php';

if (isset($_POST['delete_conta'])) {

    $id_conta = $_POST['id_conta'];
    try {
        $stmt = $pdo->prepare('DELETE FROM contas WHERE id = :id_conta');
        $result = $stmt->execute(array(':id_conta' => $id_conta));
        if ($result) {
            $_SESSION['message'] = 'Dados excluídos com sucesso!';
            $_SESSION['message_type'] = 'warning';
            header("Location: ../PHP/ListagemContas.php");
            exit;
        } else {
            $_SESSION['message'] = 'Não foi possivel excluir os dados!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../PHP/ListagemContas.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erro ao inserir os dados" .
        "Número do erro: " . $e->getMessage();
    }
}
?>