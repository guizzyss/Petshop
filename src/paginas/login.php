<?php
// paginas/login.php
// (A sessão já foi iniciada no cabecalho.php)

// Se o usuário já está logado, redireciona para a home
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php?pagina=home");
    exit;
}

// Inclui a conexão com o banco (necessário para processar o form)
// O caminho é relativo ao index.php, que é quem "chama" este arquivo.
require_once 'includes/db_connect.php'; 

$erro = '';

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        try {
            // Busca o usuário pelo e-mail
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch();

            // Verifica se o usuário existe E se a senha está correta
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                // Sucesso! Armazena dados na sessão
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                
                // Redireciona para a home
                header("Location: index.php?pagina=home");
                exit; // Termina o script
            } else {
                // Erro de credenciais
                $erro = "E-mail ou senha inválidos.";
            }
        } catch (PDOException $e) {
            $erro = "Erro ao tentar fazer login. Tente novamente mais tarde.";
        }
    }
}
?>

<section class="pagina-login">
    <h2>Login</h2>
    <p>Acesse sua conta para ver seus pedidos e pets.</p>

    <?php if (!empty($erro)): ?>
        <p class="alerta-erro"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form id="form-login" action="index.php?pagina=login" method="POST">
        <div class="form-grupo">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-grupo">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit" class="botao">Entrar</button>
    </form>
    <p class="link-alternativo">Não tem uma conta? <a href="index.php?pagina=registro">Registre-se aqui</a>.</p>
</section>