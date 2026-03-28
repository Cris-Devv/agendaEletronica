<?php
session_start();
include '../../config/conexao.php'; // Conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../');
    exit();
}

function editarAtividade($id, $titulo, $usuario_id, $descricao, $data_inicio, $hora_inicio, $data_termino, $hora_termino, $status) {
    global $conn;

    // Atualizar atividade no banco de dados
    $query = $conn->prepare("UPDATE atividades SET titulo = :titulo, descricao = :descricao, data_inicio = :data_inicio, hora_inicio = :hora_inicio, data_termino = :data_termino, hora_termino = :hora_termino, status = :status WHERE id = :id AND usuario_id = :usuario_id");
    $query->bindParam(':id', $id);
    $query->bindParam(':titulo', $titulo);
    $query->bindParam(':usuario_id', $usuario_id);
    $query->bindParam(':descricao', $descricao);
    $query->bindParam(':data_inicio', $data_inicio);
    $query->bindParam(':hora_inicio', $hora_inicio);
    $query->bindParam(':data_termino', $data_termino);
    $query->bindParam(':hora_termino', $hora_termino);
    $query->bindParam(':status', $status);

    if ($query->execute()) {
        header('Location: ../pages/dashboard/dashboard.php');
        exit();
    } else {
        echo "<p>Erro ao editar atividade. Tente novamente.</p>";
    }
}

// Chama a função de edição de atividade passando os dados do formulário
editarAtividade($_POST['id'], $_POST['titulo'], $_SESSION['usuario_id'], $_POST['descricao'], $_POST['data_inicio'], $_POST['hora_inicio'], $_POST['data_termino'], $_POST['hora_termino'], $_POST['status']);
?>