<?php
// Arquivo de Conexão com o Banco (PDO)

// Configurações do banco de dados
define('DB_HOST', 'localhost'); // Onde o banco está
define('DB_NAME', 'petshop'); // O nome do banco que criamos
define('DB_USER', 'root'); // Seu usuário do MySQL
define('DB_PASS', ''); // Sua senha do MySQL (deixe vazio se não tiver)

try {
    // Cria a conexão PDO
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4",DB_USER, DB_PASS);
    
    // Define o modo de erro do PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Define o modo de busca padrão para associativo
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // Se a conexão falhar, exibe o erro
    die("ERRO: Não foi possível conectar ao banco de dados. " . $e->getMessage());
}