<?php

// Inicia a sessão em todas as páginas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
$usuario_logado = isset($_SESSION['usuario_id']);
$nome_usuario = $_SESSION['usuario_nome'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop Online</title>

    <link rel="stylesheet" href="/Petshop/src/assets/css/styles.css">
    <?php
        // Incluir CSS específico da página caso exista
        if (isset($pagina)) {
            $css_pagina = __DIR__ . "/../assets/css/paginas/{$pagina}.css";
            if (file_exists($css_pagina)) {
                echo '<link rel="stylesheet" href="/Petshop/src/assets/css/paginas/' . htmlspecialchars($pagina) . '.css">';
            }
        }
    ?>
</head>
<body>
    <header class="navbar">
        <div class="container">
            <a href="index.php?pagina=home" class="logo"><strong>LePet</strong></a>
            
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php?pagina=home">Home</a></li>
                    <li><a href="index.php?pagina=sobre">Sobre</a></li>
                    <li><a href="index.php?pagina=contato">Contato</a></li>

                    <?php if ($usuario_logado): ?>
                        <li><a href="#">Minha Conta</a></li>
                        <li><a href="/Petshop/index.php?pagina=logout" class="nav-botao">
                            Sair (<?php echo htmlspecialchars($nome_usuario); ?>)
                        </a></li>
                    <?php else: ?>
                        <li><a href="index.php?pagina=login" class="nav-botao">Login</a></li>
                        <li><a href="index.php?pagina=registro" class="nav-botao-outline">Registrar</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <button id="theme-toggle" title="Mudar tema">⏾</button>
        </div>
    </header>

    <main class="container page-content">
