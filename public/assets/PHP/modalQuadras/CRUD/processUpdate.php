<?php
include_once __DIR__ . '/../../conexao.php';
if (isset($_POST['edit_quadra'])) {
    $id_quadra = $_POST['id_quadra'];

    //Pegar novos dados do form
    $descrQuadra = $_POST['descr_quadra_edit'];
    $dispQuadra = $_POST['disp_quadra_edit'];
    $modQuadra = $_POST['mod_quadra_edit'];
    $valorQuadra = $_POST['valor_quadra_edit'];
    try {
        $stmt = $pdo->prepare(
        'UPDATE quadras
        SET
        descr = :descrQuadra,
        disponibilidade = :dispQuadra,
        id_modalidade = :modQuadra,
        valor_hora = :valorQuadra
        WHERE
        id = :id_quadra
        '
        );

        $result = $stmt->execute(array(
            ':id_quadra' => $id_quadra,
            ':descrQuadra' => $descrQuadra,
            ':dispQuadra' => $dispQuadra,
            ':modQuadra' => $modQuadra,
            ':valorQuadra' => $valorQuadra
        ));
        //Testa se o update foi bem sucedido
        if ($result) {
            $_SESSION['message'] = 'Dados alterados com sucesso!';
            $_SESSION['message_type'] = 'warning';
            header("Location: ../PHP/Quadras.php");
            exit;
        } else {
            $_SESSION['message'] = 'Não foi possivel alterar os dados!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../PHP/Quadras.php");
            exit;
        }
    } catch (Exception $e) {
        "Número do erro: " . $e->getMessage();
    }
}
?>