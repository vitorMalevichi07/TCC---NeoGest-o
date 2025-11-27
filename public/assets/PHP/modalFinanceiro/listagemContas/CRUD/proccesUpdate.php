<?php 
include_once __DIR__ . '/../../../conexao.php';
if (isset($_POST['update_conta'])) {
    $id_conta = $_POST['id_conta'];

    $descrConta = $_POST['descr_conta'];
    $categoria = $_POST['categoria'];
    $recorrencia = $_POST['recorrencia'];
    $valorConta = $_POST['valor_conta'];
    $dataVencimentoConta = $_POST['data_vencimento'];
    $tipo = $_POST['tipo'];
    $cpfCnpjConta = $_POST['cpf_cnpj'];
    $observacoesConta = $_POST ['observacoes_conta'];
    $username = $_SESSION['username'];
    
    try {
        $stmt = $pdo->prepare(
        'UPDATE contas
        SET
        descricao = :descrConta,
        categoria = :categoria,
        recorrencia = :recorrencia,
        valor = :valorConta,
        data_vencimento = :dataVencimentoConta,
        tipo = :tipo,
        cpf_cnpj = :cpfCnpjConta,
        observacao = :observacoesConta
        WHERE
        id = :id_conta
        '
        );

        $result = $stmt->execute(array(
            ':id_conta' => $id_conta,
            ':descrConta' => $descrConta,
            ':categoria' => $categoria,
            ':recorrencia' => $recorrencia,
            ':valorConta' => $valorConta,
            ':dataVencimentoConta' => $dataVencimentoConta,
            ':tipo' => $tipo,
            ':cpfCnpjConta' => $cpfCnpjConta,
            ':observacoesConta' => $observacoesConta
        ));

        echo json_encode($result);
        //Testa se o update foi bem sucedido
        if ($result) {
            $_SESSION['message'] = 'Dados alterados com sucesso!';
            $_SESSION['message_type'] = 'warning';
            header("Location: ../PHP/ListagemContas.php");
            exit();
        } else {
            $_SESSION['message'] = 'Erro ao alterar os dados!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../PHP/ListagemContas.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao alterar os dados: ' . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
        header("Location: ../ListagemContas.php");
        exit();
    }
}

?>