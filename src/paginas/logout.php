<?php
// paginas/logout.php
// Este script é chamado diretamente pelo link no cabeçalho

// 1. Inicia a sessão para poder manipulá-la
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. Limpa todas as variáveis da sessão
$_SESSION = [];

// 3. Destrói a sessão
session_destroy();

/* * 4. Redireciona de volta para o index.php
 * Usamos '../index.php' porque este arquivo está na pasta 'paginas'
 * e o index.php está um nível acima (na pasta 'src')
 */
header("Location: ../index.php?pagina=home");
exit; // Garante que o script pare aqui
?>