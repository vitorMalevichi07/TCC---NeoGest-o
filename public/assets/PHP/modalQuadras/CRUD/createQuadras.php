<?php 
    if(!isset($_SESSION['username'])) {
        header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
        exit();
    }
    include_once __DIR__ . '/../../conexao.php';
    include_once __DIR__ . '/../../../src/buscarIdEmpresa.php';


    if (isset($_POST['create_quadra'])) {

        $username = $_SESSION['username'];
        $id_empresa = buscarIdEmpresa($username);
        $descr = $_POST['descr'];
        $disponibilidadeQuadra = $_POST['disponibilidadeQuadra'];
        $modalidadeQuadra = $_POST['modalidadeQuadra'];
        $valoragendQuadra = $_POST['valoragendQuadra'];
        
        try {
            $sql = $pdo->prepare("INSERT INTO
            quadras(id_empresa, id_modalidade, descr,disponibilidade, valor_hora)
            values (:id_empresa, :modalidadeQuadra, :descr, :disponibilidadeQuadra, :valoragendQuadra)");
            
            $result = $sql -> execute(array(
                ':id_empresa' => $id_empresa,
                ':descr'=> $descr,
                ':disponibilidadeQuadra'=> $disponibilidadeQuadra,
                ':modalidadeQuadra'=> $modalidadeQuadra,
                ':valoragendQuadra'=> $valoragendQuadra,
            ));
            if (!$result) {
                $_SESSION['message'] = 'Erro ao inserir os dados!';
                $_SESSION['message_type'] = 'danger';
                header("Location: ../PHP/Quadras.php");
                exit;

            } else {
                $_SESSION['message'] = 'Dados inseridos com sucesso!';
                $_SESSION['message_type'] = 'success';
                header("Location: ../PHP/Quadras.php");
                exit;
            }
        } catch (PDOException $e) {
            echo "Erro ao inserir os dados" .
            "Número do erro: " . $e -> getMessage() ;
        }
        
        }
?>