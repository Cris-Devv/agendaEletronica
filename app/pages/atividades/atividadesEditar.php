<?php
session_start(); // Inicia a sessão
include '../../../config/conexao.php'; // Conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../../');
    exit();
}

// Verifica se o ID foi passado via GET
if (!isset($_GET['id'])) {
    header('Location: ../../pages/dashboard/dashboard.php');
    exit();
}

// Pega o ID da atividade passado da dashboard
$atividade_id = $_GET['id'];

// Busca a atividade no banco de dados
$query = $conn->prepare("SELECT * FROM atividades WHERE id = :id AND usuario_id = :usuario_id");
$query->bindParam(':id', $atividade_id, PDO::PARAM_INT);
$query->bindParam(':usuario_id', $_SESSION['usuario_id'], PDO::PARAM_INT);
$query->execute();

// Verifica se a atividade existe
if ($query->rowCount() == 0) {
    header('Location: ../../pages/dashboard/dashboard.php');
    exit();
}

// Armazena as informações da atividade na variável $atividade
$atividade = $query->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades - Editar</title>
    <link rel="stylesheet" href="../../src/css/atvEditar.css">
</head>
<body>
    <!-- Formulário de atualização com os campos mostrando os valores atuais -->
    <form action="../../metodos/atvEditar.php" method="post">
        <h1>Editar Atividade</h1>
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($atividade['id']); ?>">
        
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($atividade['titulo']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($atividade['descricao']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="dataInicio">Data de início:</label>
            <input type="date" id="dataInicio" name="data_inicio" value="<?php echo htmlspecialchars($atividade['data_inicio']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="horaInicio">Hora de início:</label>
            <input type="time" id="horaInicio" name="hora_inicio" value="<?php echo htmlspecialchars($atividade['hora_inicio']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="dataTermino">Data de término:</label>
            <input type="date" id="dataTermino" name="data_termino" value="<?php echo htmlspecialchars($atividade['data_termino']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="horaTermino">Hora de término:</label>
            <input type="time" id="horaTermino" name="hora_termino" value="<?php echo htmlspecialchars($atividade['hora_termino']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="pendente" <?php echo ($atividade['status'] == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
                <option value="concluida" <?php echo ($atividade['status'] == 'concluida') ? 'selected' : ''; ?>>Concluída</option>
                <option value="cancelada" <?php echo ($atividade['status'] == 'cancelada') ? 'selected' : ''; ?>>Cancelada</option>
            </select>
        </div>
        
        <button type="submit">Editar atividade</button>
        
        <div class="link-voltar">
            <a href="../../pages/dashboard/dashboard.php">← Voltar ao dashboard</a>
        </div>
    </form>

    <script>
        // Função para atualizar a data mínima do campo de término
        function atualizarDataMinimaTermino() {
            const dataInicio = document.getElementById('dataInicio').value;
            const dataTermino = document.getElementById('dataTermino');
            
            if (dataInicio) {
                dataTermino.min = dataInicio;
                // Se a data de término for anterior à nova data de início, limpa o campo
                if (dataTermino.value && dataTermino.value < dataInicio) {
                    dataTermino.value = '';
                }
            } else {
                dataTermino.removeAttribute('min');
            }
        }

        // Adiciona event listener ao campo de data de início
        document.getElementById('dataInicio').addEventListener('change', atualizarDataMinimaTermino);

        // Define a data mínima inicialmente se houver valor preenchido
        document.addEventListener('DOMContentLoaded', function() {
            atualizarDataMinimaTermino();
        });
    </script>
</body>
</html>