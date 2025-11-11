<?php
// index.php (Front Controller)

// 1. Incluir o cabeçalho (que já inicia a sessão)
// Define a página padrão
$pagina_padrao = 'home';

// Pega a página da URL (ex: index.php?pagina=login)
// Usa o operador '??' (null coalescing) para definir 'home' se 'pagina' não existir
$pagina = $_GET['pagina'] ?? $pagina_padrao;

// Lista de páginas permitidas (para segurança)
$paginas_permitidas = [
    'home',
    'sobre',
    'login',
    'registro',
    'contato',
    'logout',
];

// Valida a página antes de incluir o cabeçalho
if (!in_array($pagina, $paginas_permitidas)) {
    $pagina = $pagina_padrao;
}

// Agora inclui o cabeçalho com a página definida
require_once 'src/includes/cabecalho.php';

// 2. Lógica do Roteador Simples

// Constrói o caminho do arquivo da página
$caminho_pagina = "src/paginas/{$pagina}.php";

// 3. Carregar a Página
// Verifica se a página está na lista permitida E se o arquivo realmente existe
if (in_array($pagina, $paginas_permitidas) && file_exists($caminho_pagina)) {
    require_once $caminho_pagina;
} else {
    // Se a página não for encontrada ou não for permitida, carrega a home
    require_once "src/paginas/{$pagina_padrao}.php";
}

// 4. Incluir o rodapé
require_once 'src/includes/rodape.php';