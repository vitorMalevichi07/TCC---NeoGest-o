<?php 
    if(!isset($_SESSION['username'])) {
        header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
        exit();
    }
    include_once __DIR__ . '/../../../conexao.php';
    include_once __DIR__ . '/../../../../src/buscarIdEmpresa.php';

    if (isset($_POST['create_conta'])) {

        $descrConta = $_POST['descrConta'];
        $categoria = $_POST['categoria'];
        $recorrencia = $_POST['recorrencia'];
        $valorConta = $_POST['valorConta'];
        $dataVencimentoConta = $_POST['dataVencimentoConta'];
        $tipo = $_POST['tipo'];
        $cpfCnpjConta = $_POST['cpfCnpjConta'];
        $observacoesConta = $_POST ['observacoesConta'];
        $username = $_SESSION['username'];

        try {
            $id_empresa = buscarIdEmpresa($username);
        
            /* caso já exista uma conta com esse nome */
            $queryDescricao = $pdo->prepare("SELECT COUNT(*) FROM contas WHERE descricao = :descrConta AND id_empresa = :id_empresa");
            
            $queryDescricao->bindValue(':descrConta', $descrConta);
            $queryDescricao->bindValue(':id_empresa', $id_empresa);
            $queryDescricao->execute();

            $countDescricao = $queryDescricao->fetchColumn();
            if($countDescricao > 0) {
                $_SESSION['message'] = 'Já existe uma conta com essa descrição!';
                $_SESSION['message_type'] = 'warning';
                header("Location: ../PHP/ListagemContas.php");
                exit;
            }
            
            /* caso não exista uma conta com esse nome */
            else{      
                $cadastroConta = $pdo->prepare(
                "INSERT INTO contas (id_empresa, descricao, categoria, recorrencia, valor, data_vencimento, tipo, cpf_cnpj, observacao) 
                VALUES (:id_empresa, :descrConta, :categoria, :recorrencia, :valorConta, :dataVencimentoConta, :tipo,:cpfCnpjConta, :observacoesConta)");

            $queryConta = $cadastroConta->execute(array(
                ':id_empresa' => $id_empresa,
                ':descrConta' => $descrConta,
                ':categoria' => $categoria,
                ':recorrencia' => $recorrencia,
                ':valorConta' => $valorConta,
                ':dataVencimentoConta' => $dataVencimentoConta,
                ':tipo' => $tipo,
                ':cpfCnpjConta' => $cpfCnpjConta,
                ':observacoesConta' => $observacoesConta
            ));

            if (!$queryConta) {
                $_SESSION['message'] = 'Erro ao inserir os dados!';
                $_SESSION['message_type'] = 'danger';
                header("Location: ../PHP/ListagemContas.php");
                exit;
            } else {
                $_SESSION['message'] = 'Dados inseridos com sucesso!';
                $_SESSION['message_type'] = 'success';
                header("Location: ../PHP/ListagemContas.php");
                exit;
            }
        }
    }
    catch (PDOException $e) {
            echo "Erro ao inserir os dados, Erro: " . $e;
    }
}

?>