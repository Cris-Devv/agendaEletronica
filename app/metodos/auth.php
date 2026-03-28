<?php
session_start();
include '../../config/conexao.php'; // Conexão com o banco de dados

// Função para autenticar usuário
function autenticar($login, $senha) {
    global $conn;

    // Buscar usuário pelo login
    $query = $conn->prepare("SELECT id, senha FROM usuario WHERE login = :login");
    $query->bindParam(':login', $login, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        // Verificar senha
        if (password_verify($senha, $usuario['senha'])) {
            // Iniciar sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_login'] = $login;

            // Redirecionar para dashboard
            header('Location: ../pages/dashboard/dashboard.php');
            exit();
        } else {
            echo "<p>Senha incorreta.</p>";
        }
    } else {
        echo "<p>Login não encontrado.</p>";
    }
}

// Chama a função de autenticação passando os dados do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    autenticar($_POST['login'], $_POST['senha']);
}
?></content>
<parameter name="filePath">c:\xampp\htdocs\agenda\app\metodos\auth.php