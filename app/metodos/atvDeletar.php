<?php
session_start();
include '../../config/conexao.php'; // Conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../');
    exit();
}

function deletarAtividade($id, $usuario_id) {
    global $conn;

    // Deletar atividade do banco de dados (apenas se pertencer ao usuário)
    $query = $conn->prepare("DELETE FROM atividades WHERE id = :id AND usuario_id = :usuario_id");
    $query->bindParam(':id', $id);
    $query->bindParam(':usuario_id', $usuario_id);

    if ($query->execute()) {
        $rowsAffected = $query->rowCount();
            header('Location: ../pages/dashboard/dashboard.php');
            exit();
        } else {
           
            echo "<script>alert('Atividade não encontrada ou você não tem permissão para deletá-la.');</script>";
        }
}

// Chama a função de deletar atividade passando os dados do formulário
    deletarAtividade($_POST['id'], $_SESSION['usuario_id']);
?>