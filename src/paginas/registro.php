<?php
// paginas/registro.php
require_once 'includes/db_connect.php'; // $pdo

$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $senha_confirm = $_POST['senha_confirm'] ?? '';

    // Validações do lado do servidor (essenciais, mesmo com JS)
    if (empty($nome) || empty($email) || empty($senha) || empty($senha_confirm)) {
        $erro = "Todos os campos são obrigatórios.";
    } elseif ($senha !== $senha_confirm) {
        $erro = "As senhas não coincidem.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Formato de e-mail inválido.";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter no mínimo 6 caracteres.";
    } else {
        try {
            // 1. Verifica se o e-mail já existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $erro = "Este e-mail já está cadastrado.";
            } else {
                // 2. Hash da senha (NUNCA salve senhas em texto puro)
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                
                // 3. Insere no banco
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $email, $senha_hash]);
                
                $sucesso = "Cadastro realizado com sucesso! Você já pode fazer o login.";
                // (Limpa o post para não repopular o form)
                $_POST = [];
            }
        } catch (PDOException $e) {
            $erro = "Erro ao registrar. Tente novamente.";
        }
    }
}
?>

<section class="pagina-registro">
    <h2>Registro de Nova Conta</h2>
    <p>Crie sua conta para uma experiência completa e personalizada.</p>

    <?php if (!empty($erro)): ?>
        <p class="alerta-erro"><?php echo $erro; ?></p>
    <?php endif; ?>
    <?php if (!empty($sucesso)): ?>
        <p class="alerta-sucesso"><?php echo $sucesso; ?> <a href="index.php?pagina=login">Fazer Login</a></p>
    <?php endif; ?>

    <form id="form-registro" action="index.php?pagina=registro" method="POST" novalidate>
        <div class="form-grupo">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>">
            <span class="erro-validacao" aria-live="polite"></span>
        </div>
        <div class="form-grupo">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            <span class="erro-validacao" aria-live="polite"></span>
        </div>
        <div class="form-grupo">
            <label for="senha">Senha (mín. 6 caracteres):</label>
            <input type="password" id="senha" name="senha" required minlength="6">
            <span class="erro-validacao" aria-live="polite"></span>
        </div>
        <div class="form-grupo">
            <label for="senha_confirm">Confirme a Senha:</label>
            <input type="password" id="senha_confirm" name="senha_confirm" required>
            <span class="erro-validacao" aria-live="polite"></span>
        </div>
        <button type="submit" class="botao">Registrar</button>
    </form>
    <p class="link-alternativo">Já tem uma conta? <a href="index.php?pagina=login">Faça login</a>.</p>
</section>