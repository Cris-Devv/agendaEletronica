<?php
session_start(); // Inicia a sessão

// Verificação de login do usuário utilizando ID passado pela sessão
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../../');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar atividades</title>

    <!-- Link CSS da página -->
    <link rel="stylesheet" href="../../src/css/atvCriar.css">
</head>

<body>
    <!-- Formulário de criação de atividades -->
    <div class='forms-container'>
        <h1>Criar Atividade</h1>
        <form action="../../metodos/atvCriar.php" method="post">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="dataInicio">Data de início:</label>
                <input type="date" id="dataInicio" name="dataInicio" required>
            </div>
            
            <div class="form-group">
                <label for="horaInicio">Hora de início:</label>
                <input type="time" id="horaInicio" name="horaInicio" required>
            </div>
            
            <div class="form-group">
                <label for="dataTermino">Data de término:</label>
                <input type="date" id="dataTermino" name="dataTermino" required>
            </div>
            
            <div class="form-group">
                <label for="horaTermino">Hora de término:</label>
                <input type="time" id="horaTermino" name="horaTermino" required>
            </div>
            
            <button type="submit">Criar atividade</button>
        </form>
        
        <div class="link-voltar">
            <a href="../../pages/dashboard/dashboard.php">← Voltar ao dashboard</a>
        </div>
    </div>

    <!-- // Função para atualizar a data mínima do campo de término -->
    <script>
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
    </script>
</body>
</html>