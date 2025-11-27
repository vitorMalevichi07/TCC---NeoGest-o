<?php
session_start();
include_once __DIR__ . '/../conexao.php';
if (isset($_POST['Cadastrar'])) {
    //post dados empresa
    $razaoSocial = $_POST['razaoSocial'];
    $emailEmpresa = $_POST['emailEmpresa'];
    $telefoneEmpresa = $_POST['telefoneEmpresa'];
    $cnpjEmpresa = $_POST['cnpjEmpresa'];
    $cepEmpresa = $_POST['cepEmpresa'];
    $numeroEmpresa = $_POST['numeroEmpresa'];
    $cidadeEmpresa = $_POST['cidadeEmpresa'];
    $ruaEmpresa = $_POST['ruaEmpresa'];
    $ufEmpresa = $_POST['ufEmpresa'];
    //post dados usuario
    $nomeUsuario = $_POST['nomeUsuario'];
    $senhaUsuario = $_POST['senhaUsuario'];
    try {
        echo 'a';
        //Sql Empresa
        $cadastraEmpresa = $pdo->prepare("INSERT into empresa(razão_social,email,telefone,cnpj,cep,uf,cidade,rua,numero)
        values(:razaoSocial,:emailEmpresa,:telefoneEmpresa,:cnpjEmpresa,:cepEmpresa,:ufEmpresa,:cidadeEmpresa,:ruaEmpresa,:numeroEmpresa)");

        // Passa os parametros da empresa para inserir no banco de dados e executa
        $resultEmpresa = $cadastraEmpresa->execute(array(
            ':razaoSocial' => $razaoSocial,
            ':emailEmpresa' => $emailEmpresa,
            ':telefoneEmpresa' => $telefoneEmpresa,
            ':cnpjEmpresa' => $cnpjEmpresa,
            ':cepEmpresa' => $cepEmpresa,
            ':ufEmpresa' => $ufEmpresa,
            ':cidadeEmpresa' => $cidadeEmpresa,
            ':ruaEmpresa' => $ruaEmpresa,
            ':numeroEmpresa' => $numeroEmpresa
        ));

        if (!$resultEmpresa) { //Caso o cadastro da empresa falhe
            $_SESSION['message'] = 'Erro ao cadastrar a empresa!';
            $_SESSION['message_type'] = 'danger'; // Bootstrap: vermelho
            header("Location: ../Cadastro.php");
            exit;
        } else {
            //buscaEmpresaRecemCadastrada
            $buscaEmpresa = $pdo->prepare("SELECT id FROM empresa ORDER BY id DESC LIMIT 1");
            $buscaEmpresa->execute();
            $ultimaEmpresa = $buscaEmpresa->fetchAll(PDO::FETCH_ASSOC);
            $idEmpresa = $ultimaEmpresa[0]['id'];//Guarda o id da empresa recem cadastrada

            /* Inico do cadastro do default Horario */
            $insertHorario = $pdo->prepare("INSERT INTO horarios
            (id_empresa, h_abertura, h_fechamento, intervalo_tempo)
            VALUES
            (:id_empresa, :hAbertura, :hFechamento, :intervaloTempo)
            ");
            $insertHorario->execute(array(
                ':id_empresa' => $idEmpresa,
                ':hAbertura' => '10:00:00',
                ':hFechamento' => '22:00:00',
                ':intervaloTempo' => 0
            ));
            /* Fim do cadastro do default Horario */

            //Sql Usuario
            $cadastroUsuario = $pdo->prepare("INSERT INTO usuario (id_empresa, username, senha) VALUES (:id_empresa,:nomeUsuario,:senhaUsuario)");

            //Passa os parametros do usuario para inserir no banco de dados e executa
            $resultUsuario = $cadastroUsuario->execute(array(
                ':id_empresa' => $idEmpresa,
                ':nomeUsuario' => $nomeUsuario,
                ':senhaUsuario' => password_hash($senhaUsuario, PASSWORD_BCRYPT)
            ));
            if (!$resultUsuario) {
                $_SESSION['message'] = 'Erro ao cadastrar o usuário!';
                $_SESSION['message_type'] = 'danger'; // Bootstrap: vermelho
                header("Location: ../Cadastro.php");
                exit;
            } else {
                $_SESSION['message'] = 'Dados inseridos com sucesso!';
                $_SESSION['message_type'] = 'success'; // Bootstrap: verde
                header("Location: ../login.php");
                exit;
            }
        }
    } catch (PDOException $e) {
        echo "Erro ao inserir os dados: " . $e->getMessage();
        $_SESSION['message'] = 'Erro ao inserir os dados!';
        $_SESSION['message_type'] = 'danger'; // Bootstrap: vermelho
        header("Location: ../Cadastro.php");
        exit;
    }
}
?>