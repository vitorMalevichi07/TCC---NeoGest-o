<?php
    include_once 'conexao.php';
    session_start();
    // Verifica se o formulário foi enviado
    if(isset($_POST['entrar'])){
        //Pega os dados do formulário
        $username = $_POST['username'];
        $password = $_POST['password'];
       
        try{

            $buscaUsuario = $pdo->prepare("SELECT username, senha FROM usuario WHERE username = :username");
            $buscaUsuario->execute(array(
                ':username' => $username
            ));
            
            $dadosUsuario = $buscaUsuario->fetch(PDO::FETCH_ASSOC);//armazena os dados do usuario
            
            if(password_verify($password,$dadosUsuario['senha'])){
                //Se a senha estiver correta, inicia a sessão
                $_SESSION['username'] = $dadosUsuario['username'];
                $mensagem = "Bem-vindo, " . htmlspecialchars($dadosUsuario['username']) . "!";
                header("Location: dashboard.php?sucess=" . urldecode($mensagem));
                exit;
            } else {
                
                //Se o usuario ou senha estiverem incorretos, redireciona com erro
                $mensagem = "Nome de usuário ou senha incorretos!";
                header("Location: login.php?error=" . urlencode($mensagem));
                exit;
            }
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            header("Location: login.php?error=" . urlencode("Erro ao conectar ao banco de dados."));
            exit;
        }
    }
?>