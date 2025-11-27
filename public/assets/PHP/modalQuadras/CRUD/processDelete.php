<?php
include_once __DIR__ . '/../../conexao.php';
if (isset($_POST['delete_quadra'])) {
    $id_quadra = $_POST['id_quadra'];
    try {
        $stmt = $pdo->prepare('DELETE FROM quadras WHERE id = :id_quadra');

        $result = $stmt->execute(array(':id_quadra' => $id_quadra));
        //Testa se o update foi bem sucedido
        if ($result) {
            $_SESSION['message'] = 'Dados excluídos com sucesso!';
            $_SESSION['message_type'] = 'warning';
            header("Location: ../PHP/Quadras.php");
            exit;
        } else {
            $_SESSION['message'] = 'Não foi possivel excluir os dados!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../PHP/Quadras.php");
            exit;
        }
    } catch (Exception $e) {
        "Número do erro: " . $e->getMessage();
    }
}
?>