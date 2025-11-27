<?php
    session_start();

    require_once __DIR__ . '/../../conexao.php';
    require_once __DIR__ . '/../../../src/buscarIdEmpresa.php';

    $id_empresa = buscarIdEmpresa($_SESSION['username']);
    
    if($id_empresa){
        if(isset($_POST['filtrar'])){
            
                $descricao = $_POST['descricao'] ?? '';
                $categoria = $_POST['categoria'] ?? '';
                $tipo = $_POST['tipo'] ?? '';
                $dataFiltro = $_POST['data'] ?? '';
                try {
                $query = "SELECT * FROM contas WHERE id_empresa = :id_empresa";
                $params = [':id_empresa' => $id_empresa];
                // Filtro por descrição
                if (!empty($descricao)) {
                    $query .= " AND descricao LIKE :descricao";
                    $params[':descricao'] = "%" . $descricao . "%";
                }

                // Filtro por categoria 
                if (!empty($categoria)) {
                    $query .= " AND categoria = :categoria";
                    $params[':categoria'] = $categoria;
                }

                // Filtro por tipo de conta
                if (!empty($tipo)) {
                    $query .= " AND tipo LIKE :tipo";
                    $params[':tipo'] = $tipo;
                } 

                // Filtro por data de vencimento
                if (!empty($dataFiltro)) {
                    $query .= " AND data_vencimento = :data";
                    $params[':data'] = $dataFiltro;
                }
                $sql = $pdo->prepare($query);
                $sql->execute($params);
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                if (!$data) $data = [];
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                exit;
            }catch (PDOException $e) {
                echo 'erro:' . $e->getMessage();
                exit;
                
            }
        }else{
            echo "não foi possível encontrar os dados";
        }
    }else {
        echo 'Empresa não encontrada';
        exit;
    }
?>
