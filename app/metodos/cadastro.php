<?php 
session_start();
include '../../config/conexao.php'; // Conexão com o banco de dados

// Função para cadastrar um novo usuário
function cadastrar($login, $senha) {
    global $conn;

    // Verifica se o login já está cadastrado
    $query = $conn->prepare("SELECT id FROM usuario WHERE login = :login");
    $query->bindParam(':login', $login, PDO::PARAM_STR);

    $query->execute();

    if ($query->rowCount() > 0) {
        echo "<script>alert('Usuário já cadastrado.');</script>"; // Fazer dar resposta a página de cadastro
        header('Location: ../../');
        exit();
    }

    // Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir novo usuário no banco de dados
    $query = $conn->prepare("INSERT INTO usuario (login, senha) VALUES (:login, :senha)");
    $query->bindParam(':login', $login);
    $query->bindParam(':senha', $senhaHash);

    if ($query->execute()) {
        // Iniciar sessão após cadastro
        $usuario_id = $conn->lastInsertId();
        $_SESSION['usuario_id'] = $usuario_id;
        $_SESSION['usuario_login'] = $login;

        header('Location: ../pages/dashboard/dashboard.php');
        exit();
    } else {
        echo "<p>Erro ao cadastrar. Tente novamente.</p>";
    }
}

// Chama a função de cadastro passando os dados do formulário
cadastrar($_POST['login'], $_POST['senha']);
?>