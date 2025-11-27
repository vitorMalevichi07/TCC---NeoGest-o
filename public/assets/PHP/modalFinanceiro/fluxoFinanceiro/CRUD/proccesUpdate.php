<?php 
include_once __DIR__ . '/../../../conexao.php';
if (isset($_POST['editar_fluxo'])) {
    $id_fluxo = $_POST['id_fluxo'];
    //Pegar novos dados do form
    $descr = $_POST['descr_edit'];
    $categoria = $_POST['categoria_edit'];
    $tipo = $_POST['tipo_edit'];
    $valor = $_POST['valor_edit'];
    $data = $_POST['dt_edit'];
    try {
        $stmt = $pdo->prepare(
        'UPDATE fluxo_financeiro
        SET
        descr = :descr,
        categoria = :categoria,
        tipo = :tipo,
        valor = :valor,
        dt = :dt
        WHERE
        id = :id_fluxo
        '
        );

        $result = $stmt->execute(array(
            ':id_fluxo' => $id_fluxo,
            ':descr' => $descr,
            ':categoria' => $categoria,
            ':tipo' => $tipo,
            ':valor' => $valor,
            ':dt' => $data
        ));
        //Testa se o update foi bem sucedido
        if ($result) {
            $_SESSION['message'] = 'Dados alterados com sucesso!';
            $_SESSION['message_type'] = 'warning';
            header('Location: ../PHP/fluxoFinanceiro.php');
            exit();
        } else {
            $_SESSION['message'] = 'Erro ao alterar os dados.';
            $_SESSION['message_type'] = 'danger';
            header('Location: ../PHP/fluxoFinanceiro.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao alterar os dados: ' . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
        header('Location: ../PHP/fluxoFinanceiro.php');
        exit();
    }
}