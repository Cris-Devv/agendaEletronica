<!-- Arquivo para criação de banco de dados e tabelas para a primeira vez que o projeto é aberto. -->
<?php
// Função para criar o banco de dados e as tabelas assim que o projeto for aberto pela primeira vez
function executarSetup() {
    // Configurações para conexao com o host
    $host = "localhost";
    $user = "root";
    $pass = "";

    try {
            // Inicialmente conecta com o host sem selecionar um banco específico para poder criá-lo depois
            $conn = new PDO(
                "mysql:host=$host; charset=utf8mb4", $user, $pass);

            // Executa o arquivo schema.sql que cria o banco de dados
            $sqlBanco = file_get_contents(__DIR__ . '/../database/schema.sql');
            $conn->exec($sqlBanco);

            // Seleciona o banco de dados criado
            $conn->exec("USE agenda"); 

            // Executa o arquivo tabelas.sql que cria as tabelas dentro do banco de dados
            $sqlBanco = file_get_contents(__DIR__ . '/../database/tabelas.sql');
            $conn->exec($sqlBanco);

        // Caso um erro ocorra, o catch captura a exceção e exibe uma mensagem de erro.
        } catch (PDOException $err) {
            die("Erro: Falha na criação do banco de dados" . $err->getMessage());
        }
}
?>