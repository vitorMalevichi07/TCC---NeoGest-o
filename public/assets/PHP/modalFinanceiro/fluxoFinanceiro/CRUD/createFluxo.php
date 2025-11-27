<?php
    if(!isset($_SESSION['username'])) {
        header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
        exit();
    }
    include_once __DIR__ . '/../../../conexao.php';
    include_once __DIR__ . '/../../../../src/buscarIdEmpresa.php';
        
    if (isset($_POST['adicionar_fluxo'])) {
        
        $username = $_SESSION['username'];
        $descr = $_POST['descr'];
        $categoria = $_POST['categoria'];
        $tipo = $_POST['tipo'];
        $dt = $_POST['dt'];
        $valor = $_POST['valor'];

        try {
            $id_empresa = buscarIdEmpresa($username);
            
            $cadastro = $pdo->prepare(
            "INSERT INTO fluxo_financeiro (id_empresa, descr, categoria, tipo, dt, valor)
            VALUES (:id_empresa, :descr, :categoria, :tipo, :dt, :valor)");
            
            $resultCadastro = $cadastro->execute(array(
                ':id_empresa' => $id_empresa,
                ':descr' => $descr,
                ':categoria' => $categoria,
                ':tipo' => $tipo,
                ':dt' => $dt,
                'valor' => $valor
            ));

            if(!$resultCadastro){
                $_SESSION['message'] = 'Erro ao Inserir os dados';
                $_SESSION['message_type'] = 'danger';
                header('Location: ../PHP/FluxoFinanceiro.php');
                exit;
            }else {
                $_SESSION['message'] = 'Dados inseridos com sucesso';
                $_SESSION['message_type'] = 'success' ;
                header("Location: ../PHP/FluxoFinanceiro.php");
                exit;
            }

        } catch (PDOException $e) {
            echo 'erro ao fazer o cadastro dos dados' . $e;
        }
        }
?>