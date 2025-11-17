<?php

// Configurações do banco de dados
define('DB_HOST', 'localhost'); // Localização do banco
define('DB_NAME', 'petshop'); // O nome do banco
define('DB_USER', 'root'); // Usuário do MySQL
define('DB_PASS', ''); // Senha do MySQL

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