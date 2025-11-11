<?php
// paginas/logout.php

// 1. Inicia a sessão para poder manipulá-la
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. Limpa todas as variáveis da sessão
$_SESSION = [];

// 3. Destrói a sessão
session_destroy();

// 4. Redireciona para a home (sem cabeçalho/rodapé pois já foram inclusos)
header('Location: index.php?pagina=home');
exit;
?>