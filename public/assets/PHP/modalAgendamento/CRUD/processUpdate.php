<?php
include_once __DIR__ . '/../../../src/buscarIdEmpresa.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
    exit();
}
$username = $_SESSION['username'];

include_once __DIR__ . '/../../conexao.php';

if (isset($_POST['edit_agendamento'])) {
    $id_empresa = buscarIdEmpresa($username);
    $id_agendamento = $_POST['id_agendamento'];
    $dataAgend = $_POST['data_agendamento_edit'];
    $valorAgend = $_POST['valor_agend_edit'];


    try {
        $estadoContaAgend = $_POST['estado_cont_agend_edit'];
        //Prepara a query MySQL para alterar os registros no banco
        $alteraAgend = $pdo->prepare('UPDATE agendamentos
        SET estado_conta = :estado_conta
        WHERE id = :id_agendamento
        ');

        //Executa a query passando os valores necessários
        $result = $alteraAgend->execute(array(
            ':estado_conta' => $estadoContaAgend,
            ':id_agendamento' => $id_agendamento
        ));
        //Testa se o update foi bem sucedido
        if ($result) {
            if ($estadoContaAgend == '2') {
                $insertFluxoCaixaEdit = $pdo->prepare("INSERT INTO fluxo_financeiro(id_empresa, descr, categoria, tipo ,dt, valor)
                VALUES (:id_empresa, :descr, 2, 0 ,:dataAgend, :valorAgend)");
                $insertFluxoCaixaEdit->execute(array(
                    ':id_empresa' => $id_empresa,
                    ':descr' => 'Agendamento de quadra',
                    ':dataAgend' => $dataAgend,
                    ':valorAgend' => $valorAgend
                ));
            }
            $_SESSION['message'] = 'Dados alterados com sucesso!';
            $_SESSION['message_type'] = 'warning';
            header('Location: ../PHP/Agendamentos.php');
            exit();
        } else {
            $_SESSION['message'] = 'Não foi possivel alterar os dados!';
            $_SESSION['message_type'] = 'danger';
            header('Location: ../PHP/Agendamentos.php');
            exit();
        }
    } catch (Exception $e) {
        echo "Erro ao inserir os dados" .
            "Número do erro: " . $e->getMessage();
    }
}
?>