<?php
    //Busca o id da empresa a partir do nome do session, que é o nome do usuario
    function buscarIdEmpresa($username){
        global $pdo; // Acessa a variável $pdo definida no arquivo de conexão
        $buscaEmpresa = $pdo->prepare("SELECT id_empresa FROM usuario WHERE username = :username");
        $buscaEmpresa->execute(array(
            ':username' => $username
        ));
        if($buscaEmpresa->rowCount() > 0) {
            $row = $buscaEmpresa->fetch(PDO::FETCH_ASSOC);
            $id_empresa = $row['id_empresa'];
            return $id_empresa;
        } else {
            echo "<script>alert('Não é possével encontrar a empresa.');</script>";
        }
    }
?>