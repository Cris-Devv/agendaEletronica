<!-- Dashboard do usuário -->
<?php
session_start(); // Inicia a sessão
include '../../../config/conexao.php'; // Conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../../');
    exit();
}

// Inclui função de listagem das atividades
include '../../metodos/atvListar.php';
$atividades = listarAtividades($_SESSION['usuario_id']);

// Prepara eventos para o calendário usando os dados das atividades pego do banco de dados
$eventos = [];
foreach ($atividades as $atividade) {
    $eventos[] = [
        'id' => $atividade['id'],
        'title' => $atividade['titulo'],
        'start' => $atividade['data_inicio'] . 'T' . $atividade['hora_inicio'],
        'end' => $atividade['data_termino'] . 'T' . $atividade['hora_termino'],
        'description' => $atividade['descricao'],
        'status' => $atividade['status'],
        'backgroundColor' => $atividade['status'] == 'concluida' ? '#28a745' : ($atividade['status'] == 'cancelada' ? '#dc3545' : '#007bff'),
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <!-- Link CSS da página -->
    <link rel="stylesheet" href="../../src/css/dashboard.css">

    <!-- Link da Fonte "Indie Flower" para os textos da página -->
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
</head>

<body class="dashboard-layout">

    <!-- ===== SIDEBAR (Menu Esquerdo) ===== -->
    <aside class="sidebar">
        <div class="sidebar-title">Olá, <?php echo htmlspecialchars($_SESSION['usuario_login']); ?>!</div>
        
        <nav class="sidebar-menu">
            <a href="../atividades/atividadesCriar.php" class="menu-item">
                <span class="menu-icon">+</span>
                <span class="menu-text">Adicionar atividades</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="sidebar-footer">
            <a href="../../metodos/logout.php" class="btn-logout">Logout</a >
        </div>
    </aside>

    <!-- ===== CONTEÚDO PRINCIPAL ===== -->
    <main class="main-content">
        <section class="calendar-container">
            <div id='calendar'></div>
        </section>
    </main>

    <!-- ===== MODAL dando detalhes da atividade selecionada ===== -->
    <div id="eventModal">
        <h4 id="modalTitle"></h4>
        <p id="modalDescription"></p>
        <p><strong>Início:</strong> <span id="modalStart"></span></p>
        <p><strong>Término:</strong> <span id="modalEnd"></span></p>
        <p><strong>Status:</strong> <span id="modalStatus"></span></p>
        <button id="editButton">Editar</button>
        <form action="../../metodos/atvDeletar.php" method="POST" style="display: inline;">
            <input type="hidden" id="deleteId" name="id" value="">
            <button class="btn-delete" type="submit">Deletar</button>
        </form>
        <button class='btn-fechar' onclick="closeModal()">Fechar</button>
    </div>
    <div id="modalOverlay" onclick="closeModal()"></div>

    <!-- Utilização da biblioteca FullCalendar JS para criação do calendário -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM carregado, iniciando calendário');
            let calendarEl = document.getElementById('calendar');

            if (!calendarEl) {
                console.error('Elemento Calendar encontrado');
                return;
            }
            console.log('Elemento Calendar não encontrado');

            try {
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: <?php echo json_encode($eventos); ?>,
                    eventClick: function(info) {
                        console.log('Evento clicado:', info.event.title);

                        // Preenche modal com as informações da atividade
                        document.getElementById('modalTitle').textContent = info.event.title;
                        document.getElementById('modalDescription').textContent = info.event.extendedProps.description;
                        document.getElementById('modalStart').textContent = info.event.start.toLocaleString('pt-BR');
                        document.getElementById('modalEnd').textContent = info.event.end ? info.event.end.toLocaleString('pt-BR') : 'N/A';
                        document.getElementById('modalStatus').textContent = info.event.extendedProps.status;

                        // Configura o redirecionamento do botão de edição
                        document.getElementById('editButton').onclick = function() {
                            window.location.href = '../atividades/atividadesEditar.php?id=' + info.event.id;
                        };

                        // Define o ID para deletar a atividade escolhida
                        document.getElementById('deleteId').value = info.event.id;

                        // Mostra os detalhes da atividade escolhida no calendário e em um overlay
                        document.getElementById('eventModal').style.display = 'block';
                        document.getElementById('modalOverlay').style.display = 'block';
                    }
                });
                calendar.render();
                console.log('Calendário renderizado com sucesso');
            } catch (error) {
                console.error('Erro ao iniciar o calendário:', error);
            }
        });

        // Função para fechar o overlay de detalhes
        function closeModal() {
            document.getElementById('eventModal').style.display = 'none';
            document.getElementById('modalOverlay').style.display = 'none';
        }
    </script>
</body>
</html>