<?php 
include_once __DIR__ . '/../../../conexao.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM contas WHERE id = :id");
        $stmt->execute(array(':id' => $id,));
        $contas = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($contas);

    } catch (PDOException $e) {
        echo "Erro ao atualizar os dados, número do erro " . $e;
    }
}else{
    echo 'Não foi possível acha o id da conta';
}

?>