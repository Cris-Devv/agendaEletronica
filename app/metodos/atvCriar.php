<?php
session_start();
include '../../config/conexao.php'; // Conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../');
    exit();
}

function criarAtividade($titulo, $usuario_id, $descricao, $dataInicio, $horaInicio, $dataTermino, $horaTermino) {
    global $conn;

    // Inserir nova atividade no banco de dados
    $query = $conn->prepare("INSERT INTO atividades (titulo, usuario_id, descricao, data_inicio, hora_inicio, data_termino, hora_termino) VALUES (:titulo, :usuario_id, :descricao, :data_inicio, :hora_inicio, :data_termino, :hora_termino)");

    // Bind dos parâmetros
    $query->bindParam(':titulo', $titulo);
    $query->bindParam(':usuario_id', $usuario_id);
    $query->bindParam(':descricao', $descricao);
    $query->bindParam(':data_inicio', $dataInicio);
    $query->bindParam(':hora_inicio', $horaInicio);
    $query->bindParam(':data_termino', $dataTermino);
    $query->bindParam(':hora_termino', $horaTermino);

    if ($query->execute()) {
        header('Location: ../pages/dashboard/dashboard.php');
        exit();
    } else {
        echo "<p>Erro ao criar atividade. Tente novamente.</p>";
    }
}

// Chama a função de criação de atividade passando os dados do formulário
criarAtividade($_POST['titulo'], $_SESSION['usuario_id'], $_POST['descricao'], $_POST['dataInicio'], $_POST['horaInicio'], $_POST['dataTermino'], $_POST['horaTermino']);
?>

