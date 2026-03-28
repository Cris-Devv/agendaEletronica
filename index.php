<!-- Página inicial do projeto -->
<?php
session_start(); // Inicia a sessão
require_once 'config/setup.php'; // Requisição do arquivo "setup.php" para utilização da função executarSetup()
executarSetup(); // Executa o setup para garantir que o banco de dados e as tabelas sejam criados assim que o projeto for aberto pela primeira vez

// Verificação de login do usuário utilizando ID passado pela sessão
if (isset($_SESSION['usuario_id'])) {
    header('Location: app/pages/dashboard/dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Eletrônica</title>

    <!-- Link de adição do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link da Fonte "Indie Flower" para os textos da página -->
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">

    <!-- Link CSS da página -->
    <link rel="stylesheet" href="./app/src/css/index.css">
</head>
<body>

    <!-- Container principal envolvendo toda a tela inicial e seus componentes - Estilização feita com Bootstrap e CSS puro -->
    <div class="container-fluid min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center gap-4">

                <!-- Coluna da esquerda contendo o título e o subtítulo -->
                <div class="col-lg-5">
                    
                    <!-- Título principal -->
                    <h1 class="titulo-principal">Agenda Eletrônica</h1>
                    
                    <!-- Subtítulo -->
                    <p class="subtitulo">Sua agenda digital para organizar sua vida</p>
                </div>

                <!-- Coluna da direita contendo o Card de login e cadastro - Estilização feita com Bootstrap e CSS puro -->
                <div class="col-lg-6">

                    <!-- Card com o formulário de login/cadastro -->
                    <div class="card-modal">
                        <div class="card-body">

                            <!-- Formulário de Login -->
                            <div id="form-login" class="form-conteudo">
                                <h2 class="card-title">Login</h2>
                                <form action="./app/metodos/auth.php" method="POST">
                                    <div>
                                        <label for="loginInput" class="form-label">Login</label>
                                        <input type="text" class="form-control input-custom" id="loginInput" name="login" required>
                                    </div>
                                    <div>
                                        <label for="senhaInput" class="form-label">Senha</label>
                                        <input type="password" class="form-control input-custom" id="senhaInput" name="senha" required>
                                    </div>
                                    <button type="submit" class="btn-login w-100 mt-3">Entrar</button>
                                </form>
                                <p class="texto-pequeno">
                                    Sem conta? <a onclick="mostrarForm('cadastro')" class="link-cadastro">Faça seu cadastro</a>
                                </p>
                            </div>

                            <!-- Formulário de cadastro -->
                            <div id="form-cadastro" class="form-conteudo d-none">
                                <h2 class="card-title mb-4">Cadastro</h2>
                                <form action="./app/metodos/cadastro.php" method="POST">
                                    <div>
                                        <label for="cadastroInput" class="form-label">Login</label>
                                        <input type="text" class="form-control input-custom" id="cadastroLoginInput" name="login" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="cadastroSenhaInput" class="form-label">Senha</label>
                                        <input type="password" class="form-control input-custom" id="cadastroSenhaInput" name="senha" required>
                                    </div>
                                    <button type="submit" class="btn-login w-100 mb-3">Cadastrar</button>
                                </form>
                                <p class="text-center texto-pequeno">
                                    Já tem conta? <a onclick="mostrarForm('login')" class="link-cadastro">Faça login aqui</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Função para alteração entre os formulários de login e cadastro em JavaScript -->
    <script>
        function mostrarForm(nomeForm) {

            // Oculta todas os formulários adicionando classe 'd-none'
            document.getElementById('form-login').classList.add('d-none');
            document.getElementById('form-cadastro').classList.add('d-none');

            // Mostra a form que foi clicada (remove classe 'd-none')
            document.getElementById('form-' + nomeForm).classList.remove('d-none');
        }
    </script>

    <!-- BOOTSTRAP JS (necessário para alguns componentes) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>