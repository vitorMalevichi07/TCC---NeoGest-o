<?php
include_once __DIR__ . '/../../conexao.php';

if (isset($_POST['delete_agendamento'])) {
    
    $id_agendamento = $_POST['id_agendamento'];
    try {
        //Prepara a query MySQL para excluir os registros no banco
        $excluiAgend = $pdo->prepare('DELETE FROM agendamentos WHERE id = :id_agendamento');

        //Executa a query passando o id
        $result = $excluiAgend->execute(array(':id_agendamento' => $id_agendamento));

        //Testa se o update foi bem sucedido
        if ($result) {
            $_SESSION['message'] = 'Agendamento excluído com sucesso!';
            $_SESSION['message_type'] = 'warning';
            header("Location: ../PHP/Agendamentos.php");
            exit;
        } else {
            $_SESSION['message'] = 'Erro ao excluir o agendamento!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../PHP/Agendamentos.php");
            exit;
        }


    } catch (Exception $e) {
        echo "Erro ao inserir os dados" .
            "Número do erro: " . $e->getMessage();
    }
}
?>