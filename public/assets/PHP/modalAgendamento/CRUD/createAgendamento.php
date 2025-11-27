<?php
include_once __DIR__ . '/../../../src/buscarIdEmpresa.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
    exit();
}
include_once __DIR__ . '/../../conexao.php';

$username = $_SESSION['username'];
try {
    if (isset($_POST["create_agendamento"])) {

        /* passagem de parametros*/
        $id_empresa = buscarIdEmpresa($username);
        $id_cliente = $_POST["id_cliente"];
        $id_quadra = $_POST["id_quadra"];
        $dataAgend = $_POST["dataAgend"];
        $horarioAgend = $_POST["horarioAgend"];
        $horarioFimAgend = $_POST["horarioFimAgend"];
        $valorAgend = $_POST["valorAgend"];
        $estadoContaAgend = $_POST["estadoContaAgend"];

        $queryValorQuadra = $pdo->prepare("SELECT
        valor_hora
        FROM
        quadras
        WHERE
        id = :id_quadra
        ");
        $queryValorQuadra->execute(array(
            ':id_quadra' => $id_quadra
        ));
        $valorQuadra = $queryValorQuadra->fetch(PDO::FETCH_ASSOC);

        /* Soma dos valores da quadra e agendamento */
        $valorFinalAgendamento = $valorAgend + $valorQuadra['valor_hora'];

        /*  teste para verificar se algum agendamento coincide com oq vai ser inserido */
        $queryDoTeste = $pdo->prepare("SELECT
        id 
        FROM agendamentos
        WHERE id_empresa = :id_empresa 
        AND dt = :dataAgend
        AND id_quadra = :id_quadra
        AND horario_agendado < :horarioFimAgend
        AND tempo_alocado > :horarioAgend
        ");
        $queryDoTeste->execute(array(
            ':id_empresa' => $id_empresa,
            ':id_quadra' => $id_quadra,
            ':dataAgend' => $dataAgend,
            ':horarioAgend' => $horarioAgend,
            ':horarioFimAgend' => $horarioFimAgend
        ));
        //Se esse teste gerar o 0 ele executa a inserção
        if ($queryDoTeste->rowCount() == 0) { //sem comflito
            $insertAgendamento = $pdo->prepare("INSERT INTO agendamentos
            ( id_empresa, id_cliente, id_quadra, dt, horario_agendado, tempo_alocado, valor, estado_conta )
            VALUES
            ( :id_empresa, :id_cliente, :id_quadra, :dataAgend, :horarioAgend, :horarioFimAgend, :valorAgend, :estadoContaAgend )
            ");
            $resultAgendamento = $insertAgendamento->execute(array(
                ':id_empresa' => $id_empresa,
                ':id_cliente' => $id_cliente,
                ':id_quadra' => $id_quadra,
                ':dataAgend' => $dataAgend,
                ':horarioAgend' => $horarioAgend,
                ':horarioFimAgend' => $horarioFimAgend,
                ':valorAgend' => $valorFinalAgendamento,
                ':estadoContaAgend' => $estadoContaAgend
            ));
            if ($resultAgendamento) {
                if ($estadoContaAgend == '2') {
                    $insertFluxoCaixa = $pdo->prepare("INSERT INTO fluxo_financeiro(id_empresa, descr, categoria, tipo ,dt, valor)
                    VALUES (:id_empresa, :descr, 2, 0 ,:dataAgend, :valorAgend)");
                    $insertFluxoCaixa->execute(array(
                        ':id_empresa' => $id_empresa,
                        ':descr' => 'Agendamento de quadra',
                        ':dataAgend' => $dataAgend,
                        ':valorAgend' => $valorFinalAgendamento
                    ));
                    $_SESSION['message'] = 'Dados inseridos com sucesso!';
                    $_SESSION['message_type'] = 'success'; // Bootstrap: verde
                    header("Location: ../PHP/Agendamentos.php");
                    exit;
                }
            } else {
                $_SESSION['message'] = 'Erro ao inserir os dados!';
                $_SESSION['message_type'] = 'danger'; // Bootstrap: vermelho
                header("Location: ../PHP/Agendamentos.php");
                exit;
            }
        } else {
            $_SESSION['message'] = 'Já existe um agendamento nesse horário!';
            $_SESSION['message_type'] = 'warning'; // Bootstrap: amarelo
            header("Location: ../PHP/Agendamentos.php");
            exit;
        }
    }
} catch (PDOException $e) {
    echo "Erro ao inserir os dados" .
        "Número do erro: " . $e->getMessage();
}
?>