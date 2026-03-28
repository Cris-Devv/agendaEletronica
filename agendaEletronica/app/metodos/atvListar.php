<?php
// session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../');
    exit();
}

function listarAtividades($usuario_id) {
    global $conn;

    // Buscar atividades do usuário
    $query = $conn->prepare("SELECT * FROM atividades WHERE usuario_id = :usuario_id ORDER BY data_inicio ASC");
    $query->bindParam(':usuario_id', $usuario_id);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Retornar atividades como JSON se for uma requisição AJAX
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode(listarAtividades($_SESSION['usuario_id']));
    exit();
}

// Caso contrário, pode ser usado para incluir em outras páginas
?>