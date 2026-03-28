<!-- Arquivo de conexão com o banco de dados. -->
<?php
// Configurações da conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'agenda';
$port = 3306;

// Faz uma tentativa de conexão com o banco de dados usando PDO
try {
    $conn = new PDO("mysql:host=$host; port=$port; dbname=" . $dbname, $user, $pass);
} catch(PDOException $err){
    echo "Erro: Conexão com banco de dados falhou. Erro gerado ".$err->getMessage();
}
?>