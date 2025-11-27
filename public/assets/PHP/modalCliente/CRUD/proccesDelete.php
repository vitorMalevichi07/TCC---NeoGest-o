<?php
include_once __DIR__ . '/../../conexao.php';

if (isset($_POST['delete_cliente'])) {

    $id_cliente = $_POST['id_cliente'];
    try {
        $stmt = $pdo->prepare('DELETE FROM clientes WHERE id = :id_cliente');
        $result = $stmt->execute(array(':id_cliente' => $id_cliente));
        
        if ($result) {
            $_SESSION['message'] = 'Dados excluídos com sucesso!';
            $_SESSION['message_type'] = 'warning';
            header("Location: ../PHP/Clientes.php");
            exit;
            
        } else {
            $_SESSION['message'] = 'Não foi possivel excluir os dados!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../PHP/Clientes.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "'Erro ao deletar dados, Número do erro: " . $e->getMessage();
    }
}
?>