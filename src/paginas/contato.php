<?php

$sucesso = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Possível nova funcionalidade: salvar os dados em um banco ou enviar a um email
    $sucesso = true;
}
?>

<section class="pagina-contato">
    <h2>Entre em Contato</h2>
    <p>Tem dúvidas, sugestões ou reclamações? Fale conosco!</p>

    <?php if ($sucesso): ?>
        <p class="alerta-sucesso">Obrigado! Sua mensagem foi enviada.</p>
    <?php endif; ?>

    <form id="form-contato" action="index.php?pagina=contato" method="POST">
        <div class="form-grupo">
            <label for="nome">Seu Nome:</label>
            <input type="text" id="nome-contato" name="nome" required>

            <label for="email">Seu E-mail:</label>
            <input type="email" id="email-contato" name="email" required>

            <label for="assunto">Assunto:</label>
            <input type="text" id="assunto-contato" name="assunto" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem-contato" name="mensagem" rows="5" required></textarea>
        </div>
        <button type="submit" class="botao">Enviar Mensagem</button>
    </form>
</section>