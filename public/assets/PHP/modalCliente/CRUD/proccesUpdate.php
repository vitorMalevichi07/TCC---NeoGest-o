<?php
include_once __DIR__ . '/../../conexao.php';
if (isset($_POST['edit_cliente'])) {
    $id_cliente = $_POST['id_cliente'];

    //Pegar novos dados do form
    $nomeCli = $_POST['name_cli_edit'];
    $sobrenomeCli = $_POST['lastname_cli_edit'];
    $dtNasc = $_POST['dataNasc_cli_edit'];
    $emailCli = $_POST['email_cli_edit'];
    $cpfCli = $_POST['cpf_cli_edit'];
    $cnpjCli = $_POST['cnpj_cli_edit'];
    $celCli = $_POST['cel_cli_edit'];
    $cepCli = $_POST['cep_cli_edit'];
    $cidadeCli = $_POST['cidade_cli_edit'];
    $ufCli = $_POST['uf_cli_edit'];
    $ruaCli = $_POST['rua_cli_edit'];
    $numCasaCli = $_POST['numCasa_cli_edit'];
    $complementocasaCli = $_POST['complementos_cli_edit'];
    try {
        $stmt = $pdo->prepare(
        'UPDATE clientes
        SET
        nome = :nome,
        sobrenome = :sobrenome,
        dt_nascimento = :dt,
        email = :email,
        cpf = :cpf,
        cnpj = :cnpj,
        celular = :celular,
        cep = :cep,
        uf = :uf,
        cidade = :cidade,
        rua = :rua,
        nCasa = :nCasa,
        complemento = :complemento
        WHERE
        id = :id_cli
        '
        );

        $result = $stmt->execute(array(
            ':id_cli' => $id_cliente,
            ':nome' => $nomeCli,
            ':sobrenome' => $sobrenomeCli,
            ':dt' => $dtNasc,
            ':email' => $emailCli,
            ':cpf' => $cpfCli,
            ':cnpj' => $cnpjCli,
            ':celular' => $celCli,
            ':cep' => $cepCli,
            ':cidade' => $cidadeCli,
            ':uf' => $ufCli,
            ':rua' => $ruaCli,
            ':nCasa' => $numCasaCli,
            ':complemento' => $complementocasaCli
        ));
        //Testa se o update foi bem sucedido
        if ($result) {
            $_SESSION['message'] = 'Dados alterados com sucesso!';
            $_SESSION['message_type'] = 'success';
            header("Location: ../PHP/Clientes.php");
            exit;
        } else {
            $_SESSION['message'] = 'Não foi possivel alterar os dados!';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../PHP/Clientes.php");
            exit;
        }
    } catch (Exception $e) {
        echo "Erro ao inserir os dados" .
            "Número do erro: " . $e->getMessage();
    }
}
?>