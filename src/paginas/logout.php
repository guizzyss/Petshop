<?php

// Inicia a sessão para poder manipulá-la
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Limpa todas as variáveis da sessão
$_SESSION = [];

// Destrói a sessão
session_destroy();

// Redireciona para a home (sem cabeçalho/rodapé pois já foram inclusos)
header('Location: index.php?pagina=home');
exit;
?>