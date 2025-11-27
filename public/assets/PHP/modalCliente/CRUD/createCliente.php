<?php
include_once __DIR__ . '/../../conexao.php';
include_once __DIR__ . '/../../../src/buscarIdEmpresa.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
    exit();
}


if (isset($_POST['create_cliente'])) {
    // Guardar em variaveis os dados do formulário
    $nomeCli = $_POST['nomeCli'];
    $sobrenomeCli = $_POST['sobrenomeCli'];
    $dataNascCli = $_POST['dataNascCli'];
    $cpfCli = $_POST['cpfCli'];
    $cnpjCli = $_POST['cnpjCli'];
    $rgCli = $_POST['rgCli'];
    $cepCli = $_POST['cepCli'];
    $cidadeCli = $_POST['cidadeCli'];
    $ruaCli = $_POST['ruaCli'];
    $ufCli = $_POST['ufCli'];
    $ncasaCli = $_POST['ncasaCli'];
    $celularCli = $_POST['celularCli'];
    $emailCli = $_POST['emailCli'];
    $complementocasaCli = $_POST['complementocasaCli'];

    //variavel para teste
    $username = $_SESSION['username'];

    try {
        $id_empresa = buscarIdEmpresa($username);

        $cadastraCli = $pdo->prepare("INSERT INTO clientes (id_empresa, nome, sobrenome, dt_nascimento, email, cpf, cnpj, rg, celular, cep, uf, cidade, rua, nCasa, complemento) 
            VALUES (:id_empresa, :nomeCli, :sobrenomeCli, :dataNascCli, :emailCli, :cpfCli, :cnpjCli, :rgCli, :celularCli, :cepCli, :ufCli, :cidadeCli, :ruaCli, :ncasaCli, :complementocasaCli)");

        $result = $cadastraCli->execute(array(
            ':id_empresa' => $id_empresa,
            ':nomeCli' => $nomeCli,
            ':sobrenomeCli' => $sobrenomeCli,
            ':dataNascCli' => $dataNascCli,
            ':emailCli' => $emailCli,
            ':cpfCli' => $cpfCli,
            ':cnpjCli' => $cnpjCli,
            ':rgCli' => $rgCli,
            ':celularCli' => $celularCli,
            ':cepCli' => $cepCli,
            ':ufCli' => $ufCli,
            ':cidadeCli' => $cidadeCli,
            ':ruaCli' => $ruaCli,
            ':ncasaCli' => $ncasaCli,
            ':complementocasaCli' => $complementocasaCli
        ));
        if (!$result) {
            $_SESSION['message'] = 'Erro ao inserir os dados!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../PHP/Clientes.php");
            exit;
        } else {
            $_SESSION['message'] = 'Dados inseridos com sucesso!';
            $_SESSION['message_type'] = 'success';
            header("Location: ../PHP/Clientes.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erro ao inserir os dados" .
            "Número do erro: " . $e->getMessage();
    }
}
?>